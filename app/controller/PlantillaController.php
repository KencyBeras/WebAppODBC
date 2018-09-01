<?php

@session_start();

require_once '../../sugpa/app/model/datos/Login.php';
require_once '../../sugpa/app/model/datos/Usuario.php';
require_once '../../sugpa/app/model/datos/Tipos.php';
require_once '../../sugpa/app/model/dao/LoginDao.php';
require_once '../../sugpa/app/model/dao/UsuarioDao.php'; 
require_once '../../sugpa/app/model/dao/TiposDao.php';


//SI LAS VARIABLES SESSION DE INICIAR SESION ESTÁN DEFINIDAS, LAS BORRAMOS.
if( isset($_SESSION['mensajeEmail']) ) {
    unset($_SESSION['mensajeEmail']); }
if( isset($_SESSION['mensajeEmailError']) ) {
    unset($_SESSION['mensajeEmailError']); }
if( isset($_SESSION['mensajeError']) ) {
    unset($_SESSION['mensajeError']); }


$useer = $_POST['useer'];
$pass = $_POST['pass'];

$log = new Login();
$logDao = new LoginDao();
$sesDao = new SesionDao();

$log = $logDao->traerLoginUseer($useer);                //BUSCAMOS LOGIN POR USEER. SI NO LO TRAE, NO EXISTE*

$passEncriptada = $logDao->encriptar($pass);

if(($log != null) && ($log->getPass() == $passEncriptada)) {      //SI EL LOGIN EXISTE Y SE VERIFICA EL PASS SE CREA LA SESION
    
    $idLog = $log->getIdlogin();
    $ses = new Sesion($idLog);                          //CREAMOS LA SESION CON LA ID DEL LOGIN
    
    $idTipoLogin = $log->getTipologin()->getIdtipologin();     //GUARDO EL TIPO DEL LOGIN
    
    $exists = null;
    $exists = $sesDao->traerSesionLogin($idLog);          //COMPROBAMOS SI YA EXISTE BUSCANDOLO POR LA MISMA ID LOGIN
    
    if($exists =! null) {                                 //SI EXISTE, LA BORRAMOS Y CREAMOS UNA NUEVA
        $sesDao->deleteSesionLog($idLog);
        $sesDao->insertSesion($ses);        
    }
    else {                                                //SI NO EXISTE, SOLO CREAMOS UNA NUEVA
        $sesDao->insertSesion($ses);        
    }
    
    $sesDB = $sesDao->traerSesionLogin($idLog);         //TRAEMOS LA SESION QUE ACABAMOS DE CREAR POR ID DEL LOGIN
    
    
    $_SESSION['idSesion'] = $sesDB->getIdsesion();      //GUARDAMOS LA ID DE LA SESION PARA VERIFICARLA CON CADA PETICION
    $_SESSION['idTipoLogin'] = $idTipoLogin;                        //GUARDAMOS LA ID DEL TIPO DE LOGIN & EL TIPO LOGIN
    $_SESSION['tipoLogin'] = $log->getTipologin()->getTipologin();
    
    $_SESSION['nombre'] = $log->getUsuario()->getNombre();          //GUARDAMOS DATOS DEL USUARIO
    $_SESSION['apellido'] = $log->getUsuario()->getApellido();
    $_SESSION['dni'] = $log->getUsuario()->getDni();
    $_SESSION['email'] = $log->getUsuario()->getEmail();
    
    $_SESSION['useer'] = $log->getUseer();
    
    
    //REDIRECCIONAR A LA VISTA DEPENDIENDO EL TIPO DE LOGIN
    if($idTipoLogin == 1) {
        echo "<meta http-equiv=Refresh content=\"0.5 ; url=../../../sugpa/app/index.php?sugpa=BienvenidoAgente\">";
        
    }
    else if($idTipoLogin == 2) {
        echo "<meta http-equiv=Refresh content=\"0.5 ; url=../../../sugpa/app/index.php?sugpa=AdmBienvenido\">";
        
    } 
    else if($idTipoLogin == 3) {
        echo "<meta http-equiv=Refresh content=\"0.5 ; url=../../../sugpa/app/index.php?sugpa=Dashboard\">";
    }
    
}
else {                                                  //SI NO EXISTE: MENSAJE DE ERROR Y REDIRECCIONA A iniciarSesion.php
    $_SESSION['mensajeError'] = "...";
    echo "<meta http-equiv=Refresh content=\"0.2 ; url=../../sugpa/app/index.php?sugpa=IniciarSesion\">"; 
}

?>
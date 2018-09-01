<?php

@session_start();

require_once 'app/model/datos/Sesion.php';
require_once 'app/model/dao/SesionDao.php';
require_once 'app/model/dao/DataSource.php';


if( isset($_SESSION['idSesion']) ) {              //SI ESTA DEFINIDA idSesion, VERIFICAMOS QUE SE ENCUENTRE EN LA BD
    $sesDao = new SesionDao();
    $ses = new Sesion();
    
    $ses = $sesDao->traerSesionId( $_SESSION['idSesion'] );
    
    if($ses == null) {                          //SI NO ESTA, LIMPIAMOS LAS VARIABLES TIPO $_SESSION
        session_unset();
    }
}

if( !isset($_SESSION['idSesion']) ) {         //SI idSesion NO ESTA DEFINIDO EN EL NAVEGADOR MUESTRA LA PANTALLA DE LOGIN
    
    require_once 'app/view/iniciarSesion.php';
    
}
else {                                  //SI YA ESTA DEFINIDA REDIRECCIONAR A UNA VISTA PRINCIPAL SEGUN EL TIPO DE LOGIN
    $tipo = $_SESSION['idTipoLogin'];
    
    if($tipo == 1) {
        echo "<meta http-equiv=Refresh content=\"0.2 ; url=../../sugpa/app/index.php?sugpa=BienvenidoAgente\">";
    }
    else if($tipo == 2) {
        echo "<meta http-equiv=Refresh content=\"0.2 ; url=../../sugpa/app/index.php?sugpa=AdmBienvenido\">";
    }
    else if($tipo == 3) {
        echo "<meta http-equiv=Refresh content=\"0.2 ; url=../../sugpa/app/index.php?sugpa=Dashboard\">";
    }
}

?>
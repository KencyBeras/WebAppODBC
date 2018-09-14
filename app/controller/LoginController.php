<?php

require_once 'model/datos/Socio.php';
require_once 'model/dao/SocioDao.php';
require_once 'model/datos/Filial.php';
require_once 'model/dao/FilialDao.php';
require_once 'model/dao/DataSource.php';

//Declaraciones
$socioDao = new SocioDao();
$user = $_POST["user"];
$pass = $_POST["pass"];

//Se limpian mensajes de error para que no aparezcan repetidos
if(isset($_SESSION["errorLogin"])){
    unset($_SESSION["errorLogin"]);
}

//Lógica de autenticación
$socio = $socioDao->loginSocio($user, $pass);
if(isset($socio)){ //Si coincide un socio con el solicitado en el login
	$_SESSION["datosSesion"] = json_encode($socio); //Lo agrego como una variable de sesión para utilizar en el resto de la misma
	$_SESSION["tipoSesion"] = "socio";
	//Seteo el tiempo de sesión en 30 minutos (60*30 = 1800), que se refresca mediante cada @session_start()
	ini_set("session.cookie_lifetime","1800");
	ini_set("session.gc_maxlifetime","1800");

  $filialDao = new FilialDao();
  $filiales = $filialDao->selectFiliales();

  $_SESSION['filiales'] = $filiales;


  require_once '../app/model/dao/CanchaDao.php';

  if(!isset($_SESSION["updated"])){
    $canchaDao = new CanchaDao();

    foreach ($filiales as $filial) {
      $_SESSION[$filial->getIdFilial() . "_deportes"] = $canchaDao->selectDeportes($filial->getIdFilial());
      $_SESSION['updated'] = True;
    }
  }



}
else $_SESSION["errorLogin"] = "Usuario o contraseña incorrectos";
header("Location: ../"); //Redirecciono al index.php que maneja las sesiones

?>

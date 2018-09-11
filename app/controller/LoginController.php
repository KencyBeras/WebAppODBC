<?php

require_once 'model/datos/Socio.php';
require_once 'model/dao/SocioDao.php';
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
}
else $_SESSION["errorLogin"] = "Usuario o contraseña incorrectos";
header("Location: ../"); //Redirecciono al index.php que maneja las sesiones

?>

<?php

require_once 'model/datos/Socio.php';
require_once 'model/dao/SocioDao.php';
require_once 'model/dao/DataSource.php'; 

//Declaraciones
$socioDao = new SocioDao();
$user = $_POST["user"];
$pass = $_POST["pass"];

//Lógica de autenticación
$socio = $socioDao->loginSocio($user, $pass);
if(isset($socio)){ //Si coincide un socio con el solicitado en el login
	$_SESSION["datosSesion"] = $socio; //Lo agrego como una variable de sesión para utilizar en el resto de la misma
	$_SESSION["tipoSesion"] = "socio";
	header("Location: ../public/mainView.php"); //Redirecciono a la vista principal del socio
}
else echo "Usuario incorrecto";

?>

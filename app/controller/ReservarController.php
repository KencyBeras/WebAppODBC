<?php

require_once '../model/datos/Socio.php';
require_once '../model/dao/SocioDao.php';
require_once '../model/datos/Filial.php';
require_once '../model/dao/FilialDao.php';
require_once '../model/dao/DataSource.php';
require_once '../model/dao/TurnoDao.php';


// Se necesita idFilial, idCAncha, idSocio, fechahora

$idFilial = $_POST["idFilial"];
$deporte = $_POST["deporte"];
$numcancha = $_POST["cancha"];
$fechaHora = $_POST["fechaHora"];
$numafiliado = $_POST["numAfiliado"];

echo "filial: " . $idFilial . "<br>";
echo "numCancha: " . $numcancha . "<br>";
echo "deporte: " . $deporte . "<br>";
echo "afiliado: " . $numafiliado . "<br>";
echo "fechahora: " . $fechaHora . "<br>";


$turnoDao = new TurnoDao();

$resultado =  $turnoDao->insertReserva($idFilial, $numcancha, $deporte, $numafiliado, $fechaHora);

echo $resultado;

/*
//Lógica de autenticación
$socio = $socioDao->loginSocio($user, $pass);
if(isset($socio)){ //Si coincide un socio con el solicitado en el login
	$_SESSION["datosSesion"] = json_encode($socio); //Lo agrego como una variable de sesión para utilizar en el resto de la misma
	$_SESSION["tipoSesion"] = "socio";
	//Seteo el tiempo de sesión en 30 minutos (60*30 = 1800), que se refresca mediante cada @session_start()
	ini_set("session.cookie_lifetime","1800");
	ini_set("session.gc_maxlifetime","1800");
}
else $_SESSION["errorLogin"] = "Usuario o contraseña incorrectos";
header("Location: ../"); //Redirecciono al index.php que maneja las sesiones
*/


?>

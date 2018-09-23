<?php

require_once '../model/datos/Socio.php';
require_once '../model/dao/SocioDao.php';
require_once '../model/datos/Filial.php';
require_once '../model/dao/FilialDao.php';
require_once '../model/dao/DataSource.php';
require_once '../model/dao/TurnoDao.php';

@session_start();

if(isset($_SESSION["mensajesReserva"])){
    unset($_SESSION["mensajesReserva"]);
}

unset($_SESSION["turnos"]);

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

//Enviando el resultado según corresponda
$_SESSION["mensajesReserva"] = array();
if($resultado==1){
	array_push($_SESSION["mensajesReserva"], 1, "Reserva registrada correctamente");
}
else{
	array_push($_SESSION["mensajesReserva"], 0, "Hubo un error al registrar la reserva");
}

header('Location: ../../');


?>

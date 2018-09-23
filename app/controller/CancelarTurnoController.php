<?php

require_once '../model/datos/Socio.php';
require_once '../model/dao/SocioDao.php';
require_once '../model/datos/Filial.php';
require_once '../model/dao/FilialDao.php';
require_once '../model/dao/DataSource.php';
require_once '../model/dao/TurnoDao.php';


@session_start();

// Se necesita idFilial, idCAncha, idSocio, fechahora

$idTurno = $_POST["idTurnoACancelar"];

$turnoDao = new TurnoDao();

$resultado =  $turnoDao->cancelarReserva($idTurno);

unset($_SESSION["turnos"]);

echo $resultado;

//Enviando el resultado según corresponda
$_SESSION["mensajesCancelacion"] = array();
if($resultado==1){
	array_push($_SESSION["mensajesCancelacion"], 1, "La reserva fue cancelada");
}
else{
	array_push($_SESSION["mensajesCancelacion"], 0, "No se ha podido cancelar la reserva");
}

header('Location: ../view/misReservas.php');


?>

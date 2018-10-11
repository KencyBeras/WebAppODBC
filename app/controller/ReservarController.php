<?php

require_once '../model/datos/Socio.php';
require_once '../model/dao/SocioDao.php';
require_once '../model/datos/Filial.php';
require_once '../model/dao/FilialDao.php';
require_once '../model/dao/DataSource.php';
require_once '../model/dao/TurnoDao.php';

@session_start();

$turnoDao = new TurnoDao();

if(isset($_POST["idTurnoAModificar"]) && $_POST["idTurnoAModificar"]!="0"){
	$_SESSION["datosMod"] = array();
	array_push($_SESSION["datosMod"], $_POST["idTurnoAModificar"], $_POST["idFechaAModificar"], 
		$_POST["idCanchaAModificar"]);
	//Redireccion con el id de la filial sobre la cual se va a modificar el turno
	header('Location: ../view/reservar.php?id=' . $_POST["idFilialAModificar"]);
}
else if(isset($_POST["esModificacion"]) && $_POST["esModificacion"] != "0"){
	$resultado = $turnoDao->updateReserva($_POST["turnoUpdate"], $_POST["fechaHora"]);
	//Alerta sobre el estado de la modificacion
	$_SESSION["mensajesModificacion"] = array();
	if($resultado==1){
		array_push($_SESSION["mensajesModificacion"], 1, "Reserva modificada correctamente");
	}
	else{
		array_push($_SESSION["mensajesModificacion"], 0, "Hubo un error al modificar la reserva");
	}

	unset($_SESSION["turnos"]); //Quito la variable de sesion turnos para que impacten los cambios al volver a setearla
	header('Location: ../view/misReservas.php');
}
else{
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
}

?>

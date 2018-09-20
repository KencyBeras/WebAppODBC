<?php
require_once '../model/dao/DataSource.php';
require_once '../model/datos/Filial.php';
require_once '../model/dao/FilialDao.php';
require_once '../model/datos/Turno.php';
require_once '../model/dao/TurnoDao.php';

  //Definición de variables
  $filialDao = new FilialDao();
  $turnoDao = new TurnoDao();
  $idfilial = $_GET['idfilial'];
  $fechaReserva = $_GET['fechaReserva'];
  $turnos =  array();

  $filial = $filialDao->selectFilial($idfilial);

  $turnos = $turnoDao->selectTurnosByFilialAndFecha($idfilial, $fechaReserva, 
  $filial->getHorario_apertura(), $filial->getHorario_cierre());
  echo json_encode($turnos);
?>
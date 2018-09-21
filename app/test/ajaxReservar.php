<?php
require_once '../model/dao/DataSource.php';
require_once '../model/datos/Filial.php';
require_once '../model/dao/FilialDao.php';
require_once '../model/datos/Turno.php';
require_once '../model/dao/TurnoDao.php';
require_once '../model/datos/Cancha.php';
require_once '../model/dao/CanchaDao.php';

  //Definición de variables
  $filialDao = new FilialDao();
  $turnoDao = new TurnoDao();
  $canchaDao = new CanchaDao();
  $turnos =  array();
  $canchas = array();
  //Capturos datos que me vienen desde el Ajax
  $idfilial = $_GET['idfilial'];
  $deporte = $_GET['deporte'];
  $fechaReserva = $_GET['fechaReserva'];
  //Trayendo filial y cancha, obtengo los parametros necesarios para traer el turno
  $filial = $filialDao->selectFilial($idfilial);
  $cancha = $canchaDao->selectCanchasByFilialAndDeporte($idfilial, $deporte);
  //Insertando el turno
  $turnos = $turnoDao->selectTurnosByFilialAndFecha($idfilial, $deporte, $fechaReserva,  
  $filial->getHorario_apertura(), $filial->getHorario_cierre());
  echo json_encode($turnos);
?>
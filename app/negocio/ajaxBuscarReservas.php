<?php
require_once '../model/dao/DataSource.php';
require_once '../model/datos/Filial.php';
require_once '../model/dao/FilialDao.php';
require_once '../model/datos/Turno.php';
require_once '../model/dao/TurnoDao.php';
require_once '../model/datos/Cancha.php';
require_once '../model/dao/CanchaDao.php';

  //Definición de variables

  $turnoDao = new TurnoDao();
  $turnos =  array();

  //Capturos datos que me vienen desde el Ajax
  $fechaDesde = $_GET['fechaDesde'];
  $fechaHasta = $_GET['fechaHasta'];
  //Trayendo filial y cancha, obtengo los parametros necesarios para traer el turno
 
  $turnos = $turnoDao->selectTurnosBetween($fechaDesde, $fechaHasta);

  echo json_encode($turnos);
?>
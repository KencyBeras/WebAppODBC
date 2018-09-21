<?php
require_once '../model/dao/DataSource.php';
require_once '../model/datos/Filial.php';
require_once '../model/dao/FilialDao.php';

require_once '../model/datos/Cancha.php';
require_once '../model/dao/CanchaDao.php';

  //Definición de variables
  $filialDao = new FilialDao();
  $canchaDao = new CanchaDao();
  $canchas = array();
  //Capturos datos que me vienen desde el Ajax
  $idfilial = $_GET['idfilial'];
  $deporte = $_GET['deporte'];

  $canchas = $canchaDao->selectCanchasByFilialAndDeporte($idfilial, $deporte);

  echo json_encode($canchas);
?>
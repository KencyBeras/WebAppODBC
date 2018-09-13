<?php

require_once('../model/dao/DataSource.php');
require_once('../model/dao/FilialDao.php');
require_once('../model/datos/Filial.php');

$filialDao = new FilialDao();

foreach ($filialDao->selectFiliales() as &$filial){
	echo "Localidad: " . $filial->getLocalidad() . "<br>";
}

?>
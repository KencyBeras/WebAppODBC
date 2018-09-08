<?php
require_once('../model/dao/DataSource.php');
require_once('../model/dao/SocioDao.php');
require_once('../model/datos/Socio.php');

$socioDao = new SocioDao();

$socio = $socioDao->selectSocio(1);

echo $socio->getNumAfiliado();

?>

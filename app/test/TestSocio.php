<?php
require_once('../model/dao/DataSource.php');
require_once('../model/dao/SocioDao.php');
require_once('../model/datos/Socio.php');

$socioDao = new SocioDao();

$socio = $socioDao->selectSocio(1);

echo "<strong> Numero de afiliado del socio numero " . $socio->getIdSocio() . "</strong>: " . $socio->getNumAfiliado();

echo "<br><strong>Mostrando todos los socios </strong><br>";
foreach ($socioDao->listSocio() as &$socioIndex){
	echo "Apellido: " . $socioIndex->getApellido() . "<br>";
}

echo "listo";

?>

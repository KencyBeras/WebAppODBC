<?php

require_once 'model/datos/Socio.php';
require_once 'model/dao/SocioDao.php';
require_once 'model/dao/DataSource.php';

//Se limpian mensajes de error para que no aparezcan repetidos
if(isset($_SESSION["mensajeRegistro"])){
    unset($_SESSION["mensajeRegistro"]);
}

//Declaraciones
$socioDao = new SocioDao();
$user = $_POST['user'];
$pass = $_POST['pass'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];

//Lógica de registro
$resultado = $socioDao->registroSocio($user, $pass, $nombre, $apellido, $direccion, $telefono, $email);
//Enviando el resultado según corresponda
$_SESSION["mensajeRegistro"] = array();
if($resultado==1){
	array_push($_SESSION["mensajeRegistro"], 1, "Usuario registrado correctamente");
}
else{
	array_push($_SESSION["mensajeRegistro"], 0, "Registro fallido: datos inválidos");
}

header('Location: ../');

?>
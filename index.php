<?php

@session_start();

require_once 'app/model/dao/DataSource.php';

//Redirecciones para cualquier sesión

if(!isset($_SESSION['datosSesion'])){ //Si la sesión no está definida
    if(isset($_SESSION['mensajeRegistro']) && ($_SESSION['mensajeRegistro'][0] == 0)){ //Si el usuario intentó registrarse
        header("Location: app/view/register.php"); //Registro fallido
        exit();
    }
    else header("Location: app/view/login.php"); //Registro exitoso o redirección normal
}
else {                                  //Si ya está definida se redirige a la pantalla principal según corresponda
    $tipo = $_SESSION['tipoSesion'];

    if(strcmp($tipo, "socio") == 0) { //Si hay coincidencia con el tipo de sesión 'socio'
        header("Location: app/view/inicioSocio.php");
    }
    else if(strcmp($tipo, "admin") == 0) { //Si hay coincidencia con el tipo de sesión 'admin'
        header("Location: app/view/inicioAdmin.php");
    }
    else if($tipo == 3) {
        echo "<meta http-equiv=Refresh content=\"0.2 ; url=../../club/app/index.php?club=Pantalla\">";
    }
}

?>
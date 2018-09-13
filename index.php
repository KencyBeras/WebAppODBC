<?php

@session_start();

require_once 'app/model/dao/DataSource.php';

if( !isset($_SESSION['datosSesion']) ) {         //Si la sesión no está definida se redirige al login
    header("Location: public/login.php");
}
else {                                  //Si ya está definida se redirige a la pantalla principal según corresponda
    $tipo = $_SESSION['tipoSesion'];
    if(strcmp($tipo, "socio") == 0) { //Si hay coincidencia con el tipo de sesión 'socio'
        header("Location: public/inicioSocio.php");
    }
    else if(strcmp($tipo, "admin") == 0) { //Si hay coincidencia con el tipo de sesión 'admin'
        header("Location: public/inicioAdmin.php");
    }
    else if($tipo == 3) {
        echo "<meta http-equiv=Refresh content=\"0.2 ; url=../../sugpa/app/index.php?sugpa=Dashboard\">";
    }
}

?>

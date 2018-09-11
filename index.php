<?php

@session_start();

require_once 'app/model/dao/DataSource.php';

if( !isset($_SESSION['idSesion']) ) {         //Si la sesión no está definida se redirige al login
    require_once 'app/view/iniciarSesion.php';
    header("Location: public/login.php");
}
else {                                  //Si ya está definida se redirige a la pantalla principal según corresponda
    $tipo = $_SESSION['tipoSesion'];
    if(strcmp($tipo, "socio") == 0) { //Si hay coincidencia con el tipo de sesión 'socio'
        header("Location: public/mainView.php");
    }
    else if($tipo == 2) {
        echo "<meta http-equiv=Refresh content=\"0.2 ; url=../../sugpa/app/index.php?sugpa=AdmBienvenido\">";
    }
    else if($tipo == 3) {
        echo "<meta http-equiv=Refresh content=\"0.2 ; url=../../sugpa/app/index.php?sugpa=Dashboard\">";
    }
}

?>
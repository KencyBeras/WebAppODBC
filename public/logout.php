<?php


@session_start();

if(isset($_SESSION["datosSesion"])){


unset($_SESSION["datosSesion"]);
header("Location: ../index.php");


}
else header("Location: ../index.php");
?>

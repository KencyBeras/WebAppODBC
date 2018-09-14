<?php

//require_once '../../sugpa/app/model/datos/Sesion.php';
//require_once '../../sugpa/app/model/dao/SesionDao.php';
require_once 'model/dao/DataSource.php';

@session_start();

/**
 * Si el navegador se cierra se pierde la sesion.
 **/

if( isset($_REQUEST['sesion']) ) {       //CONDICION UNICA PARA MANEJAR EL LOGIN Y LOGOUT
    switch($_REQUEST['sesion']) {
        case 'login': {
            require_once 'controller/LoginController.php';
            unset($_REQUEST['sesion']);
        };break;
        case 'logout': {
            if( isset($_SESSION["datosSesion"]) ) {
                unset($_SESSION["datosSesion"]);
                unset($_SESSION["tipoSesion"]);
            }
            session_unset();
            unset($_REQUEST['sesion']);
            header("Location: ../");
        };break;
        case 'registro': {
            //Redirige al controlador y realiza la logica necesaria
            require_once 'controller/RegistroController.php';
            //Vuelve y redirige a donde sea necesario
        };break;
        case 'reserva': {
            require_once 'controller/ReservarController.php';
            unset($_REQUEST['sesion']);
        };break;
        default: require_once 'view/404.php';
    }
}

if( isset($_SESSION['idSesion']) ) {                              //VERIFICAMOS QUE LA SESION ESTÉ DEFINIDA EN EL NAVEGADOR
    $sesDao = new SesionDao();
    $ses = new Sesion();
    $ses = $sesDao->traerSesionId( $_SESSION['idSesion'] );     //BUSCAMOS LA SESION EN LA BD

    if ( ($ses != null) ) {                                     //VERIFICAMOS QUE SI EXISTA
        if ( isset($_REQUEST['sistemaclub']) ) {                          //VERIFICAMOS QUE EXISTA UNA PETICION 'sistemaclub'

            switch ( $_REQUEST['sistemaclub'] ) {

                /** VISTAS */
                case 'IngresarSede': {
                    require_once 'view/IngresarSede.php';
                };break;

                /** CONTROLADORES */
                case 'ingresoSede': {
                	require_once 'controller/IngresarSedeController.php';
                };break;
                /** VISTA/CONTROLADOR NO CONTROLADO */
				default: require_once 'view/404.php';
            }
        }
    }
    else {
        unset( $_SESSION['idSesion'] );             //COMO NO ESTA LA SESION EN LA DB, BORRAMOS LA VARIABLE $_SESSION
        require_once 'view/iniciarSesion.php';      //SI NO EXISTE LA SESION EN LA BD, VUELVE A iniciarSesion.php
    }
}
else {                                              //SI LA SESION NO ESTA DEFINIDA EN EL NAVEGADOR, VUELVE A iniciarSesion.php
    //require_once 'view/iniciarSesion.php';
}


?>

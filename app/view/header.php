<?php 

require_once '../model/dao/DataSource.php';
require_once '../model/datos/Filial.php';
require_once '../model/dao/FilialDao.php';

@session_start();

if(!isset($_SESSION["allFiliales"])){
  $filialDao = new FilialDao();
  $_SESSION["allFiliales"] = $filialDao->selectFiliales();

}
  $filiales = $_SESSION["allFiliales"];
?>


<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <div class="navbar-header">
            <a class="navbar-brand" href="../../">
                <b>
                    <img src="../../public/img/home.svg" width="30" height="30" alt="homepage" class="light-logo" />
                </b>
            </a>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto mt-md-0">
            </ul>
            <ul class="navbar-nav my-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <div class="user-img">
                        <span class="round">
                          <?php
                                echo substr($socio->nombre, 0, 1 ) . substr($socio->apellido, 0, 1);
                          ?>
                        </span>
                        <span class="profile-status away pull-right"></span>
                      </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right scale-up">
                        <ul class="dropdown-user">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-text">
                                        <h4>
                                          <?php
                                                echo $socio->nombre . " " . $socio->apellido;
                                          ?>
                                        </h4>
                                    </div>
                                </div>
                            </li>
                            <li><a href="micuenta.php"><i class="ti-user"></i> Mi cuenta</a></li>
                            <li><a href="misreservas.php"><i class="ti-calendar"></i> Mis reservas</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="../index.php?sesion=logout"><i class="fa fa-power-off"></i> Salir</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
<aside class="left-sidebar">
    <nav class="sidebar-nav">
        <ul id="sidebarnav">
            <li>
                <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-map-marker"></i><span class="hide-menu">Sedes </span></a>
                <ul aria-expanded="false" class="collapse">
                        <?php 
                        foreach($filiales as $filial){
                            $id = $filial->getIdFilial();
                            $nombreSede = $filial->getLocalidad();
                    ?>
                            <li><a href="verSede.php?id=<?php echo $id;?>&sede=<?php echo $nombreSede ?>"><?php echo $nombreSede ?></a></li>
                    <?php
                        }
                     ?>
                </ul>
            </li>
            <li>
                <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-calendar"></i><span class="hide-menu">Mis reservas</span></a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="../../">Realizar reserva</a></li>
                    <li><a href="misReservas.php">Ver mis reservas</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">Contacto</span></a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="contacto.php">Contacto</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</aside>

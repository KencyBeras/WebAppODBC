<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="mainView.html">
                <!-- Logo icon -->
                <b>
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="img/favicon.png" width="45" height="40" alt="homepage" class="light-logo" />
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span>

                 <!-- Light Logo text -->
                C S L A</a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto mt-md-0">

            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">
                <!-- ============================================================== -->
                <!-- Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <div class="user-img">
                        <span class="round">
                          <?php
                          echo  substr($socio->nombre, 0, 1 ) . substr($socio->apellido, 0, 1);
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
                                          echo  $socio->nombre . " " . $socio->apellido;
                                          ?>

                                        </h4>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="ti-user"></i> Perfil</a></li>
                            <li><a href="#"><i class="ti-calendar"></i> Mis reservas</a></li>
                            <li><a href="micuenta.php"><i class="ti-settings"></i> Mi cuenta</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="fa fa-power-off"></i> Salir</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-map-marker"></i><span class="hide-menu">Sedes </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="viewLanus.php">Lanús</a></li>
                        <li><a href="viewLomas.php">Lomas de Zamora</a></li>
                        <li><a href="viewBanfield.php">Banfield</a></li>
                        <li><a href="viewTurdera.php">Turdera</a></li>
                        <li><a href="viewTemperley.php">Temperley</a></li>
                        <li><a href="viewAdrogue.php">Adrogué</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-calendar"></i><span class="hide-menu">Mis reservas</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="reservar.html">Realizar reserva</a></li>
                        <li><a href="misReservas.html">Ver mis reservas</a></li>
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
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->

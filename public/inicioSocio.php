<?php

@session_start();

if(isset($_SESSION["datosSesion"]) && (strcmp($_SESSION["tipoSesion"], "socio") == 0)){
$socio = json_decode($_SESSION["datosSesion"]);

$filiales = ($_SESSION["filiales"]);

?>


<!DOCTYPE html>
<html lang="ES">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">
    <title>Club Social Los Amigos</title>
    <!-- Bootstrap Core CSS -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/green-dark.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">





      <?php
          require('header.php');



       ?>





        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Reservar cancha</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
                            <li class="breadcrumb-item active">Reservar cancha</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div id="code1" class="collapse">
                            <div class="highlight">
                                <pre>
    <code><span class="nt">&lt;div</span> <span class="na">class=</span><span class="s">"card"</span> <span class="na">style=</span><span class="s">"width: 20rem;"</span><span class="nt">&gt;</span>
      <span class="nt">&lt;img</span> <span class="na">class=</span><span class="s">"card-img-top"</span> <span class="na">src=</span><span class="s">"..."</span> <span class="na">alt=</span><span class="s">"Card image cap"</span><span class="nt">&gt;</span>
      <span class="nt">&lt;div</span> <span class="na">class=</span><span class="s">"card-body"</span><span class="nt">&gt;</span>
        <span class="nt">&lt;h4</span> <span class="na">class=</span><span class="s">"card-title"</span><span class="nt">&gt;</span>Card title<span class="nt">&lt;/h4&gt;</span>
        <span class="nt">&lt;p</span> <span class="na">class=</span><span class="s">"card-text"</span><span class="nt">&gt;</span>Some quick example text to build on the card title and make up the bulk of the card's content.<span class="nt">&lt;/p&gt;</span>
        <span class="nt">&lt;a</span> <span class="na">href=</span><span class="s">"#"</span> <span class="na">class=</span><span class="s">"btn btn-primary"</span><span class="nt">&gt;</span>Go somewhere<span class="nt">&lt;/a&gt;</span>
      <span class="nt">&lt;/div&gt;</span>
    <span class="nt">&lt;/div&gt;</span></code>
</pre>
                            </div>
                        </div>
                        <!-- Row -->
                        <div class="row">
                          <!-- column -->
                          <div class="col-lg-3 col-md-6">
                              <!-- Card -->
                              <div class="card">
                                  <img class="card-img-top img-responsive" src="img/banfieldFutbol.jpg" alt="Card image cap">
                                  <div class="card-body">
                                      <h4 class="card-title"><?php ?></h4>
                                      <p class="card-text"><b>Horarios: </b><?php  ?> a <?php ?>
                                        <ul>
                                          <li>
                                            <?php
                                            echo $filiales[0]->localidad;

                                            foreach ($filiales as $filial) {
                                                echo $filial->localidad;
                                            }

                                             ?>
                                          </li>
                                          <li>
                                            Tenis
                                          </li>
                                        </ul>
                                      </p>
                                      <a href="reservar.html" class="btn btn-primary">Reservar</a>
                                  </div>
                              </div>
                              <!-- Card -->
                          </div>
                          <!-- column -->
                          <!-- column -->
                          <div class="col-lg-3 col-md-6">
                              <!-- Card -->
                              <div class="card">
                                  <img class="card-img-top img-responsive" src="img/lomasFutbol.jpg" alt="Card image cap">
                                  <div class="card-body">
                                      <h4 class="card-title"><?php ?></h4>
                                      <p class="card-text">Dorrego 546
                                        <ul>
                                          <li>
                                            Futbol
                                          </li>
                                          <li>
                                            Tenis
                                          </li>
                                        </ul>
                                      </p>
                                      </p>
                                      <a href="reservar.html" class="btn btn-primary">Reservar</a>
                                  </div>
                              </div>
                              <!-- Card -->
                          </div>
                          <!-- column -->
                            <!-- column -->
                            <div class="col-lg-3 col-md-6">
                                <!-- Card -->
                                <div class="card">
                                    <img class="card-img-top img-responsive" src="img/temperleyFutbol.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Temperley</h4>
                                        <p class="card-text">Meeks 322
                                          <ul>
                                            <li>
                                              Futbol
                                            </li>
                                            <br>
                                          </ul>
                                        </p>
                                        <a href="reservar.html" class="btn btn-primary">Reservar</a>
                                    </div>
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- column -->
                            <!-- column -->
                            <div class="col-lg-3 col-md-6 img-responsive">
                                <!-- Card -->
                                <div class="card">
                                    <img class="card-img-top img-responsive" src="img/adrogueFutbol.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Adrogue</h4>
                                        <p class="card-text">Alem 1040
                                          <ul>
                                            <li>
                                              Futbol
                                            </li>
                                            <li>
                                              Tenis
                                            </li>
                                          </ul>
                                        </p>
                                        <a href="reservar.html" class="btn btn-primary">Reservar</a>
                                    </div>
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- column -->
                            <!-- column -->
                            <div class="col-lg-3 col-md-6 img-responsive">
                                <!-- Card -->
                                <div class="card">
                                    <img class="card-img-top img-responsive" src="img/lanusFutbol.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Lanus</h4>
                                        <p class="card-text">9 de Julio 56
                                          <ul>
                                            <li>
                                              Futbol
                                            </li>
                                            <br>
                                          </ul>
                                        </p>
                                        <a href="reservar.html" class="btn btn-primary">Reservar</a>
                                    </div>
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- column -->
                        </div>
                        <!-- Row -->
                    </div>
                </div>
                <!-- End Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->


                        <?php
                          require('footer.php')
                         ?>

        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>

<?php
    }
    else header("Location: ../index.php");
?>

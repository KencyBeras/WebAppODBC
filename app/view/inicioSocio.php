<?php

require_once '../model/dao/DataSource.php';
require_once '../model/datos/Filial.php';
require_once '../model/datos/Cancha.php';


@session_start();

if(isset($_SESSION["datosSesion"]) && (strcmp($_SESSION["tipoSesion"], "socio") == 0)){
$socio = json_decode($_SESSION["datosSesion"]);

$filiales = $_SESSION['filiales'];

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
    <link rel="icon" type="image/png" sizes="16x16" href="../../public/img/favicon.png">
    <title>Club Social Los Amigos</title>
    <!-- Bootstrap Core CSS -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../public/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="../../public/css/colors/green-dark.css" id="theme" rel="stylesheet">



    <style type="text/css">
    #panelsedes {
      word-wrap: normal;
    }
    </style>
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
                    <div class="col-md-8 col-10 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Reservar cancha</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../../">Inicio</a></li>
                            <li class="breadcrumb-item active">Reservar cancha</li>
                        </ol>
                    </div>
                    <div class="col-md-4 col-md-offset text-nowrap" style="height: 30px;">
                        <?php
                        if(isset($_SESSION["mensajesReserva"])){
                          if($_SESSION["mensajesReserva"][0] == 1){
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><center>';
                            echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                  </button>";
                            echo $_SESSION["mensajesReserva"][1];
                            echo "</center>";
                            echo '</div>';
                          }else{
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><center>';
                            echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                  </button>";
                            echo $_SESSION["mensajesReserva"][1];
                            echo '</center>';
                            echo '</div>';
                          }
                          unset($_SESSION["mensajesReserva"]);
                        }

                        ?>
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
                        <!-- Row -->
                        <div class="row">
                          <!-- column -->
                        <?php
                          foreach ($filiales as $filial){
                            $localidad = explode(' ', $filial->getLocalidad())[0]; //Primera palabra de la localidad
                            $idFilial = $filial->getIdFilial();
                        ?>
                          <div class="col-lg-3 col-md-6">
                              <!-- Card -->
                              <div class="card">
                                  <img class="card-img-top img-responsive"
                                  src='../../public/img/<?php echo $localidad . 'Futbol.jpg';?>' alt="Card image cap">
                                  <div id="panelsedes" class="card-body">
                                      <h4 class="card-title">
                                          <?php 
                                              echo $filial->getLocalidad();
                                          ?>
                                      </h4>
                                      <p class="card-text"><b>Horarios: </b>
                                          <?php 
                                              echo $filial->getHorario_apertura(); 
                                          ?>
                                          a 
                                          <?php 
                                              echo $filial->getHorario_cierre(); 
                                          ?>
                                      </p>
                                      <div class="row text-center justify-content-md-center">
                                          <?php
                                              foreach ($_SESSION[$filial->getIdFilial() . "_deportes"] as $deporte) {
                                          ?>
                                          <div class="col-4"><i class="fa fa-check"></i> 
                                              <font class="font-medium">  
                                                  <?php 
                                                      echo $deporte; 
                                                  ?>
                                              </font>
                                          </div>
                                          <?php 
                                              } 
                                          ?>
                                      </div>
                                      <br>
                                      <a href="reservar.php?id=<?php echo $idFilial;?>" class="btn btn-primary">Reservar</a>
                                  </div>
                              </div>
                              <!-- Card -->
                          </div>
                        <?php
                          }
                        ?>
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
    <script src="../../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../../public/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="../../public/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../public/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="../../public/js/custom.min.js"></script>
</body>

</html>

<?php
    }
    else header("Location: ../../index.php");
?>

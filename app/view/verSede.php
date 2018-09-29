<?php

require_once '../model/dao/DataSource.php';
require_once '../model/datos/Filial.php';
require_once '../model/dao/FilialDao.php';


@session_start();

if(isset($_SESSION["datosSesion"]) && (strcmp($_SESSION["tipoSesion"], "socio") == 0)){
$socio = json_decode($_SESSION["datosSesion"]);


$idFilial = $_GET["id"];
$sede = $_GET["sede"];

$filialDao = new FilialDao();
$filialView = $filialDao->selectFilial($idFilial);

$localidad = explode(' ', $sede)[0]; //Primera palabra de la localidad

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
    <title><?php echo $filialView->getLocalidad(); ?></title>
    <!-- Bootstrap Core CSS -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Page plugins css -->
    <link href="../../assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

    <!-- Custom CSS -->
    <link href="../../public/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="../../public/css/colors/green-dark.css" id="theme" rel="stylesheet">
</head>

<body class="fix-header card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== 
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
                        <h3 class="text-themecolor m-b-0 m-t-0"><?php echo $filialView->getLocalidad(); ?></h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../../">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="../../">Reservar cancha</a></li>
                            <li class="breadcrumb-item active"><?php echo $filialView->getLocalidad(); ?></li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- row -->
                <div class="row">
                      <div class="col-lg-12">
                            <div class="card ">
                                <div class="card-body">
                                  <div class="row">

                                    <div id="carouselExampleSlidesOnly" class="carousel slide col-md-4 col-lg-6" data-ride="carousel">
                                        <div class="carousel-inner" role="listbox">
                                            <div class="carousel-item active"> <img class="img-responsive" src='../../public/img/<?php echo $localidad . 'Futbol.jpg';?>' alt="First slide"> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                      <medium class="text-muted">Direccion </medium>
                                      <h6><?php echo $filialView->getLocalidad(); ?></h6>
                                      <br>
                                      <medium class="text-muted ">Horario</medium>
                                      <h6>De <?php echo $filialView->getHorario_apertura(); ?> a <?php echo $filialView->getHorario_cierre(); ?></h6>
                                      <br>


                                        <div class="map-box">
                                          
                                          <?php require('../../public/maps/' . $sede . 'Map.html') ?>

                                        
                                          
                                    </div>

                                  </div>
                                    <br>
                                  <a href="reservar.php?id=<?php echo $idFilial;?>&sede=<?php echo $localidad ?>" class="btn btn-primary">Reservar</a>


                                </div>

                            </div>

                      </div>

                </div>
                <!-- End row -->




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
    <!-- Clock Plugin JavaScript -->


    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <script src="../../assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>





</body>

</html>



<?php
    }
    else header("Location: ../../index.php");
?>

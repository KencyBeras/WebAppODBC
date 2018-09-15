<?php

@session_start();

if(isset($_SESSION["datosSesion"]) && (strcmp($_SESSION["tipoSesion"], "socio") == 0)){
$socio = json_decode($_SESSION["datosSesion"]);

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
    <title>Mi cuenta</title>
    <!-- Bootstrap Core CSS -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../public/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="../../public/css/colors/green-dark.css" id="theme" rel="stylesheet">
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
                        <h3 class="text-themecolor m-b-0 m-t-0">Mi cuenta</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../">Inicio</a></li>
                            <li class="breadcrumb-item active">Mi cuenta</li>
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
                  <!-- Column -->
                  <div class="col-lg-8 col-xlg-9 col-md-7">
                      <div class="card">
                          <!-- Nav tabs -->
                          <ul class="nav nav-tabs profile-tab" role="tablist">
                              <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#settings" role="tab">Mis datos</a> </li>
                          </ul>
                          <!-- Tab panes -->
                          <div class="tab-content">
                              <div class="tab-pane active" id="settings" role="tabpanel">
                                  <div class="card-body">
                                      <form class="form-horizontal form-material">
                                          <div class="form-group">
                                              <label class="col-md-12">Nombre</label>
                                              <div class="col-md-12">
                                                  <input type="text" placeholder="<?php echo  $socio->nombre  ?>" class="form-control form-control-line">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-12">Apellido</label>
                                              <div class="col-md-12">
                                                  <input type="text" placeholder="<?php echo  $socio->apellido  ?>" class="form-control form-control-line">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label for="example-email" class="col-md-12">Email</label>
                                              <div class="col-md-12">
                                                  <input type="email" placeholder="<?php echo  $socio->email  ?>" class="form-control form-control-line" name="example-email" id="example-email">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-12">Password</label>
                                              <div class="col-md-12">
                                                  <input type="password" value="password" class="form-control form-control-line">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-12">Direccion</label>
                                              <div class="col-md-12">
                                                  <input type="text" placeholder="<?php echo  $socio->direccion  ?>" class="form-control form-control-line">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-12">Telefono</label>
                                              <div class="col-md-12">
                                                  <input type="text" placeholder="<?php echo  $socio->telefono  ?>" class="form-control form-control-line">
                                              </div>
                                          </div>

                                          <div class="form-group">
                                              <div class="col-sm-12">
                                                  <button class="btn btn-success">Actualizar</button>
                                              </div>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- Column -->
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <?php
                require('footer.php');
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
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>

<?php
    }
    else header("Location: ../../index.php");
?>

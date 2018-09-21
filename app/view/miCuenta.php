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
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Mi cuenta</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../../">Inicio</a></li>
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
                                                  <input type="text" value="<?php echo  $socio->nombre  ?>" class="form-control form-control-line">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-12">Apellido</label>
                                              <div class="col-md-12">
                                                  <input type="text" value="<?php echo  $socio->apellido  ?>" class="form-control form-control-line">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label for="example-email" class="col-md-12">Email</label>
                                              <div class="col-md-12">
                                                  <input type="email" value="<?php echo  $socio->email  ?>" class="form-control form-control-line">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-12">Direccion</label>
                                              <div class="col-md-12">
                                                  <input type="text" value="<?php echo  $socio->direccion  ?>" class="form-control form-control-line">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-12">Telefono</label>
                                              <div class="col-md-12">
                                                  <input type="text" value="<?php echo  $socio->telefono  ?>" class="form-control form-control-line">
                                              </div>
                                          </div>

                                          <div class="form-group">
                                              <div class="col-sm-12">
                                                  <button class="btn btn-success">Actualizar</button>
                                                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cambiarPassword">Cambiar contraseña</button>
                                              </div>

                                          </div>
                                      </form>


                                      <!-- sample modal content -->
                                      <div id="cambiarPassword" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                          <div class="modal-dialog">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                      <h4 class="modal-title">Cambiar contraseña</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    <div class="form-group">

                                                      <div class="col-lg-12">
                                                          <div class="input-group">
                                                              <input id="password-field1" type="password" class="form-control" placeholder="Contraseña actual">
                                                              <span class="input-group-btn">
                                                              <button class="btn btn-info" type="button"><span toggle="#password-field1" class="fa fa-fw fa-eye field-icon toggle-password1"></span></button>
                                                            </span>
                                                          </div>
                                                      </div>
                                                      <br>

                                                      <div class="col-lg-12">
                                                          <div class="input-group">
                                                              <input id="password-field2" type="password" class="form-control" placeholder="Contraseña nueva">
                                                              <span class="input-group-btn">
                                                              <button class="btn btn-info" type="button"><span toggle="#password-field2" class="fa fa-fw fa-eye field-icon toggle-password2"></span></button>
                                                            </span>
                                                          </div>
                                                      </div>
                                                      <br>
                                                      <div class="col-lg-12">
                                                          <div class="input-group">
                                                              <input id="password-field3" type="password" class="form-control" placeholder="Confirmar contraseña">
                                                              <span class="input-group-btn">
                                                              <button class="btn btn-info" type="button"><span toggle="#password-field3" class="fa fa-fw fa-eye field-icon toggle-password3"></span></button>
                                                            </span>
                                                          </div>
                                                      </div>


                                                    </div>



                                                  </div>
                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancelar</button>
                                                      <button type="button" class="btn btn-info waves-effect waves-light">Actualizar</button>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>



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
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

    <!-- Scripts para ver la password en formulario de recuperacion de password -->
    <script type="text/javascript">
    $(".toggle-password1").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
      input.attr("type", "text");
      } else {
      input.attr("type", "password");
      }
      });
    </script>

    <script type="text/javascript">
    $(".toggle-password2").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
      input.attr("type", "text");
      } else {
      input.attr("type", "password");
      }
      });
    </script>

    <script type="text/javascript">
    $(".toggle-password3").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
      input.attr("type", "text");
      } else {
      input.attr("type", "password");
      }
      });
    </script>
    <!-- Fin scripts -->

</body>

</html>

<?php
    }
    else header("Location: ../../index.php");
?>

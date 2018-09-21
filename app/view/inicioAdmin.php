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
                        <h3 class="text-themecolor m-b-0 m-t-0">Administración</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../../">Home</a></li>
                            <li class="breadcrumb-item active">Administración</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                        <div class="col-md-12">
                        <div class="card">
                            <div class="card-body p-b-0">
                            <ul class="nav nav-tabs customtab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#AdministrarSedes" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Administrar Sedes</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#BuscarReservas" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Buscar reserva</span></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                            <div class="tab-pane active" id="AdministrarSedes" role="tabpanel">
                                    <div class="col-lg-12">
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table class="table stylish-table">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Horario</th>
                                                <th>Día mantenimiento</th>
                                                <th>Modificar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><h6>Banfield</h6></td>
                                                <td>13:00 a 20:00</td>
                                                <td>14</td>
                                                <td class="text-nowrap">
                                                  <button class="btn btn-outline-success waves-effect waves-light" data-toggle="modal" data-target="#editarSede"> <i class="fa fa-pencil text-inverse "></i> </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><h6>Lomas de Zamora</h6></td>
                                                <td>13:00 a 21:00</td>
                                                <td>29</td>
                                                <td class="text-nowrap">
                                                  <button class="btn btn-outline-success waves-effect waves-light" data-toggle="modal" data-target="#editarSede"> <i class="fa fa-pencil text-inverse "></i> </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><h6>Lanús</h6></td>
                                                <td>18:00 a 23:00</td>
                                                <td>13</td>
                                                <td class="text-nowrap">
                                                  <button class="btn btn-outline-success waves-effect waves-light" data-toggle="modal" data-target="#editarSede"> <i class="fa fa-pencil text-inverse "></i> </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><h6>Adrogue</h6></td>
                                                <td>20:00 a 01:00</td>
                                                <td>29</td>
                                                <td class="text-nowrap">
                                                  <button class="btn btn-outline-success waves-effect waves-light" data-toggle="modal" data-target="#editarSede"> <i class="fa fa-pencil text-inverse "></i> </button>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                        <div class="text-right">
                                            <button class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target="#agregarSede">Agregar Sede</button>
                                        </div>
                            </div>
                                    </div>         
                                </div>
                                <div class="tab-pane" id="BuscarReservas" role="tabpanel">
                                    <div class="p-20">
                                        <div class="col-lg-6">
                                <form action="#" class="form-horizontal">
                                    <div class="form-body">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="control-label text-right col-md-3">Nombre</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="control-label text-right col-md-3">Apellido</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="control-label text-right col-md-3">Teléfono</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="control-label text-right col-md-3">Email</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button id="buscarReservas" name="buscarReservas" type="submit" class="btn btn-success">Buscar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                            </div>
                            </div> <!-- end tabs -->
                        </div>
                    </div>
                </div>
                </div>
                <!-- Row -->
                
                <!-- Row -->
                <div class="row" id="resultados">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-body">
                                <form action="#" class="form-horizontal">
                                    <div class="form-body">
                                            <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered table-striped">
                                      <thead>
                                          <tr>
                                              <th>#</th>
                                              <th>Sede</th>
                                              <th>Cancha</th>
                                              <th>Fecha</th>
                                              <th>Tipo</th>
                                              <th>Estado</th>
                                              <th class="text-nowrap">Cancelar</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td>1</td>
                                              <td>Lanus</td>
                                              <td>Cancha 3 - Futbol</td>
                                              <td><span class="text-muted"><i class="fa fa-clock-o"></i> 12/10/2018 19:00</span> </td>
                                              <td>Sintetico</td>
                                              <td>
                                                  <div class="label label-table label-success">Reservada</div>
                                              </td>
                                              <td class="text-nowrap">
                                                  <button class="btn btn-outline-danger waves-effect waves-light" data-toggle="modal" data-target="#eliminarTurno"> <i class="fa fa-close text-danger "></i> </button>

                                                </td>
                                          </tr>
                                          <tr>
                                              <td>2</td>
                                              <td>Banfield</td>
                                              <td>Cancha 1 - Futbol</td>
                                              <td><span class="text-muted"><i class="fa fa-clock-o"></i> 17/10/2018 20:00</span> </td>
                                              <td>Cemento</td>
                                              <td>
                                                  <div class="label label-table label-success">Reservada</div>
                                              </td>
                                              <td class="text-nowrap">
                                                  <button class="btn btn-outline-danger waves-effect waves-light" data-toggle="modal" data-target="#eliminarTurno"> <i class="fa fa-close text-danger "></i> </button>

                                                </td>
                                          </tr>
                                          <tr>
                                              <td>3</td>
                                              <td>Lomas de Zamora</td>
                                              <td>Cancha 1 - Tenis</td>
                                              <td><span class="text-muted"><i class="fa fa-clock-o"></i> 18/10/2018 18:00</span> </td>
                                              <td>Polvo de ladrillo</td>
                                              <td>
                                                  <div class="label label-table label-danger">Cancelada</div>
                                              </td>
                                              <td class="text-nowrap">
                                                  <button class="btn btn-outline-danger waves-effect waves-light" data-toggle="modal" data-target="#eliminarTurno"> <i class="fa fa-close text-danger "></i> </button>

                                                </td>
                                          </tr>
                                          <tr>
                                              <td>4</td>
                                              <td>Temperley</td>
                                              <td>Cancha 5 - Futbol</td>
                                              <td><span class="text-muted"><i class="fa fa-clock-o"></i> 12/10/2018 22:00</span> </td>
                                              <td>Sintetico</td>
                                              <td>
                                                  <div class="label label-table label-success">Reservada</div>
                                              </td>
                                              <td class="text-nowrap">
                                                  <button class="btn btn-outline-danger waves-effect waves-light" data-toggle="modal" data-target="#eliminarTurno"> <i class="fa fa-close text-danger "></i> </button>

                                                </td>
                                          </tr>
                                      </tbody>
                                  </table>
                                </div>
                                       
                                        
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->


                                      <div id="editarSede" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                          <div class="modal-dialog">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                      <h4 class="modal-title">Editar sede</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    <div class="form-group">

                                                      <div class="col-lg-12">
                                                        <div class="form-group row">
                                                                <div class="col-md-9">
                                                                <input type="text" class="form-control" value="NombreSede">
                                                                <small class="form-control-feedback"> Sede</small> </div>
                                                        </div>
                                                      </div>
                                                      <div class="col-lg-12">
                                                        <div class="form-group row">
                                                                <div class="col-md-9">
                                                                <div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
                                                         <input type="text" class="form-control" value="18:00">
                                                         
                                                            </div>
                                                            <small class="form-control-feedback"> Horario apertura </small>
                                                                </div>
                                                        </div>
                                                      </div>
                                                      <div class="col-lg-12">
                                                        <div class="form-group row">
                                                                <div class="col-md-9">
                                                                <div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
                                                         <input type="text" class="form-control" value="23:00">
                                                         
                                                            </div>
                                                            <small class="form-control-feedback"> Horario cierre </small>
                                                                </div>
                                                        </div>
                                                      </div>
                                                      <div class="col-lg-12">
                                                        <div class="form-group row">
                                                                <div class="col-md-9">
                                                                <input type="text" class="form-control" value="28">
                                                                <small class="form-control-feedback"> Día de mantenimiento</small> </div>
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

                                      <div id="agregarSede" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                          <div class="modal-dialog">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                      <h4 class="modal-title">Agregar sede</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    <div class="form-group">

                                                      <div class="col-lg-12">
                                                        <div class="form-group row">
                                                                <div class="col-md-9">
                                                                <input type="text" class="form-control">
                                                                <small class="form-control-feedback"> Sede</small> </div>
                                                        </div>
                                                      </div>
                                                      <div class="col-lg-12">
                                                        <div class="form-group row">
                                                                <div class="col-md-9">
                                                                <div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
                                                         <input type="text" class="form-control">
                                                         
                                                            </div>
                                                            <small class="form-control-feedback"> Horario apertura </small>
                                                                </div>
                                                        </div>
                                                      </div>
                                                      <div class="col-lg-12">
                                                        <div class="form-group row">
                                                                <div class="col-md-9">
                                                                <div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
                                                         <input type="text" class="form-control">
                                                         
                                                            </div>
                                                            <small class="form-control-feedback"> Horario cierre </small>
                                                                </div>
                                                        </div>
                                                      </div>
                                                      <div class="col-lg-12">
                                                        <div class="form-group row">
                                                                <div class="col-md-9">
                                                                <input type="text" class="form-control">
                                                                <small class="form-control-feedback"> Día de mantenimiento</small> </div>
                                                        </div>
                                                      </div>

                                                    </div>

                                                  </div>
                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancelar</button>
                                                      <button type="button" class="btn btn-info waves-effect waves-light">Agregar</button>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>

                                      <div id="eliminarTurno" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                          <div class="modal-dialog">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                      <h4 class="modal-title">Eliminar Turno</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    <h4 class="modal-title">¿Seguro quieres cancelar la reserva?</h4>
                                                    <p>Vamos a notificar al socio de que se canceló su reserva</p>
                                                  </div>
                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Volver</button>
                                                      <button type="button" class="btn btn-danger waves-effect waves-light">Cancelar Reserva</button>
                                                  </div>
                                              </div>
                                          </div>
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
</body>

</html>

<?php
    }
    else header("Location: ../../index.php");
?>

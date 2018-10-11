<?php

require_once '../model/dao/DataSource.php';

require_once '../model/datos/Turno.php';
require_once '../model/dao/TurnoDao.php';
require_once '../model/datos/Filial.php';
require_once '../model/dao/FilialDao.php';
require_once '../model/datos/Cancha.php';
require_once '../model/dao/CanchaDao.php';

@session_start();

if(isset($_SESSION["datosSesion"]) && (strcmp($_SESSION["tipoSesion"], "socio") == 0)){
$socio = json_decode($_SESSION["datosSesion"]);


if(!isset($_SESSION["turnos"])){
  $turnoDao = new TurnoDao();
  $_SESSION["turnos"] = $turnoDao->selectTurnosBySocio($socio->idsocio);
}
  $turnos = $_SESSION["turnos"];

if(!isset($_SESSION["allFiliales"])){
  $filialDao = new FilialDao();
  $_SESSION["allFiliales"] = $filialDao->selectFiliales();

}
  $filiales = $_SESSION["allFiliales"];

if(!isset($_SESSION["canchasAll"])){
  $CanchaDao = new CanchaDao();
  $_SESSION["allCanchas"] = $CanchaDao->selectCanchas();

}
  $canchas = $_SESSION["allCanchas"];

foreach ($canchas as $cancha) {
  $idCancha = $cancha->getIdCancha();
  $numCancha = $cancha->getNumCancha();
  $deporte = $cancha->getDeporte();
  $categoria = $cancha->getCategoria();

  $numCanchas[$idCancha] = $numCancha;
  $depCanchas[$idCancha] = $deporte;
  $catCanchas[$idCancha] = $categoria;
}

foreach ($filiales as $filial) {
  $idFilial = $filial->getIdFilial();
  $localidad = $filial->getLocalidad();

  $localidades[$idFilial] = $localidad;
}



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
    <title>Mis reservas</title>
    <!-- Bootstrap Core CSS -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <!-- Page plugins css -->
    <!-- Custom CSS -->
    <link href="../../public/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="../../public/css/colors/green-dark.css" id="theme" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="../../assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker plugins css -->
    <link href="../../assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
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

        <?php require( 'header.php'); ?>

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
                        <h3 class="text-themecolor m-b-0 m-t-0">Reservas</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../../">Inicio</a>
                            </li>
                            <li class="breadcrumb-item active">Mis reservas</li>
                        </ol>
                    </div>
                    <div class="col-md-4 col-md-offset text-nowrap" style="height: 30px;">
                        <?php
                        if(isset($_SESSION["mensajesCancelacion"])){
                          if($_SESSION["mensajesCancelacion"][0] == 1){
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><center>';
                            echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                  </button>";
                            echo $_SESSION["mensajesCancelacion"][1];
                            echo '</center>';
                            echo '</center></div>';
                          }else{
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><center>';
                            echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                  </button>";
                            echo $_SESSION["mensajesCancelacion"][1];
                            echo '</center>';
                            echo '</div>';
                          }
                          unset($_SESSION["mensajesCancelacion"]);
                        }
                        if(isset($_SESSION["mensajesModificacion"])){
                          if($_SESSION["mensajesModificacion"][0] == 1){
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><center>';
                            echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                  </button>";
                            echo $_SESSION["mensajesModificacion"][1];
                            echo '</center>';
                            echo '</center></div>';
                          }else{
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><center>';
                            echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                  </button>";
                            echo $_SESSION["mensajesModificacion"][1];
                            echo '</center>';
                            echo '</div>';
                          }
                          unset($_SESSION["mensajesModificacion"]);
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
                <form action="../controller/CancelarTurnoController.php" method="POST">
                  <input type="hidden" id="idTurnoACancelar" name="idTurnoACancelar" value="0">
                  <input type="hidden" id="idFilialAModificar" name="idFilialAModificar" value="0">
                  <input type="hidden" id="idTurnoAModificar" name="idTurnoAModificar" value="0">
                  <input type="hidden" id="idFechaAModificar" name="idFechaAModificar" value="0">
                  <input type="hidden" id="idCanchaAModificar" name="idCanchaAModificar" value="0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body p-b-0">
                                <ul class="nav nav-tabs customtab" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#AdministrarSedes" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Todas las reservas</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#BuscarReservas" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Buscar reserva</span></a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="AdministrarSedes" role="tabpanel">
                                        <div class="col-lg-12">
                                            <div class="card-body">
                                              
                                                  
                                                <div class="table-responsive">
                                                    <table id="myTable" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th class="text-center">Sede</th>
                                                                <th class="text-center">Cancha</th>
                                                                <th class="text-center">Fecha</th>
                                                                <th class="text-center">Categoría</th>
                                                                <th class="text-center">Estado</th>
                                                                <th class="text-nowrap text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $count=1 ; foreach($turnos as $turno){ ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $count; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $localidades[$turno->getIdFilial()]; ?></td>
                                                                <td class="text-nowrap" align="center">
                                                                    <?php echo "Cancha " . $numCanchas[$turno->getIdCancha()] . " - " . $depCanchas[$turno->getIdCancha()]; ?>
                                                                    </td>
                                                                <td align="center">
                                                                    
                                                                    <span style="display:none"> <?php echo date_format(date_create($turno->getFechahora()), 'Y/m/d H:i'); ?></span>

                                                                    <span class="text-muted"><i class="fa fa-clock-o"></i> <?php echo $turno->getFechahoraFormat(); ?></span> 
                                                                 </td>
                                                                <td align="center">
                                                                    <?php echo $catCanchas[$turno->getIdCancha()]; ?></td>
                                                                <td align="center">
                                                                    <?php if ($turno->getEstado() == "reservada"){ 

                                                                        date_default_timezone_set('America/Argentina/Buenos_Aires');
                                                                            
                                                                            $fecha_actual = date_create();
                                                                            $fecha_reserva = date_create($turno->getFechahora());

                                                                            if (date_format($fecha_actual, 'Y/m/d H:i') < date_format($fecha_reserva, 'Y/m/d H:i')){
                                                                                echo '<div class="label label-table label-success">'. "Reservada" .'</div>';
                                                                            }else{
                                                                                echo '<div class="label label-table label-warning">'. "Cumplida" .'</div>';
                                                                            }
                                                                        }elseif($turno->getEstado() == "cancelada"){ 
                                                                            echo '<div class="label label-table label-danger">'. "Cancelada" .'</div>'; 
                                                                        } ?>
                                                                </td>
                                                                <td align="center">

                                                                    <?php 

                                                                    if ($turno->getEstado() == "reservada"){ 

                                                                            date_default_timezone_set('America/Argentina/Buenos_Aires');
                                                                            
                                                                            $fecha_actual = date_create();
                                                                            $fecha_reserva = date_create($turno->getFechahora());

                                                                            //Si es el mismo día y restan entre 2 horas y 0 horas para la reserva de la cancha (si la resta es negativa quiere decir que ya expiró)
                                                                            if (date_format($fecha_actual, 'Y/m/d')==date_format($fecha_reserva, 'Y/m/d') && 
                                                                                ((int)date_format($fecha_reserva, 'H')-
                                                                                (int)date_format($fecha_actual, 'H'))<=2 && 
                                                                                ((int)date_format($fecha_reserva, 'H')-
                                                                                (int)date_format($fecha_actual, 'H'))>0
                                                                            ){
                                                                                echo "Menos de 2 horas para la reserva";
                                                                            }
                                                                            //Si la reserva todavia no ocurrió y faltan mas de 2 horas para que ocurra
                                                                            else if (date_format($fecha_actual, 'Y/m/d H:i') < date_format($fecha_reserva, 'Y/m/d H:i')){
                                                                                echo '<button type="button" class="modificarTurno btn btn-outline-primary waves-effect waves-light" data-toggle="modal" data-id="'. $turno->getIdTurno() .'" data-fecha="'. $turno->getFechahora() .'" data-filial="'. $turno->getIdFilial() .'" data-cancha="'. $turno->getIdCancha() .'" data-target="#modificarTurno"> <i class="fa fa-pencil text-primary "></i> </button>';
                                                                                echo '<button type="button" class="eliminarTurno btn btn-outline-danger waves-effect waves-light" data-toggle="modal" data-id="'. $turno->getIdTurno() .'" data-fecha="'. $turno->getFechahoraFormat() .'" data-target="#eliminarTurno"> <i class="fa fa-close text-danger "></i> </button>';
                                                                            }
                                                                            //Si la reserva ya ocurrió
                                                                            else{
                                                                                // Nothing to do.
                                                                            }
                                                                        }
                                                                     ?>
                                                                </td>
                                                            </tr>
                                                            <?php $count ++; } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="BuscarReservas" role="tabpanel">
                                        <div class="p-20">
                                            <h3 class="box-title">Buscar reservas entre fechas</h3>
                                            <hr class="m-t-0 m-b-40">
                                            <div class="form-body">
                                                <div class="col-lg-6">
                                                    <div class="input-daterange input-group" id="date-range">
                                                        <input type="text" class="form-control" name="fechaDesde" placeholder="Desde"/>
                                                        <span class="input-group-addon bg-info b-0 text-white">></span>
                                                        <input type="text" class="form-control" name="fechaHasta" placeholder="hasta"/>

                                                        <div class="ml-2">
                                                            <button id="buscarReservas" name="buscarReservas" type="button" class="btn btn-success">Buscar</button>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- end tabs -->

                                      <script>
                                      $(function () {
                                        $('.buscarReservas').on('click', function () {
                                          $.ajax({
                                            alert("entra")
                                            url: "../negocio/ajaxReservar.php?",
                                            data: {
                                              fechaDesde: $("input[name=fechaDesde]").val(),
                                              fechaHasta: $("input[name=fechaHasta]").val(),
                                            },
                                            type: 'GET', //{POST, GET}
                                            dataType: "JSON", //{JSON, XML, TEXT, SCRIPT, HTML}
                                            success: function(data) {
                                                alert(data);
                                            },

                                            error : function (xhr, ajaxOptions, thrownError){  
                                              console.log(xhr.status);          
                                              console.log(thrownError);
                                            } 
                                          });
                                        });
                                      });

                                      </script>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->

              



                <div id="eliminarTurno" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Eliminar Turno</h4>
                            </div>
                            <div class="modal-body text-center">
                              
                                <h4 class="modal-title">¿Seguro quieres cancelar la reserva?</h4>
                                <i class="fa fa-clock-o"></i> <span id="modal-fecha"></span>
                                <br><br>
                                <div class="modal-footer">
                                    
                                      <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Volver</button>
                                      <button type="submit" class="btn btn-danger waves-effect waves-light">Cancelar Reserva</button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="modificarTurno" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Modificar turno</h4>
                            </div>
                            <div class="modal-body text-center">
                              
                                <h4 class="modal-title">¿Seguro quieres modificar la reserva?</h4>
                                <i class="fa fa-clock-o"></i> <span id="modal-fechaM"></span>
                                <br><br>
                                <div class="modal-footer">
                                    
                                      <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Volver</button>
                                      <button id="modificar" type="submit" formaction="../controller/ReservarController.php" class="btn btn-danger waves-effect waves-light">Modificar Reserva</button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </form>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <?php require( 'footer.php') ?>
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
    <!-- This is data table -->
    <script src="../../assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <!-- ============================================================== -->
    <!-- Plugins for this page -->
    <!-- ============================================================== -->
    <!-- Plugin JavaScript -->
    <script src="../../assets/plugins/moment/moment.js"></script>
    <script src="../../assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="../../assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="../../assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

    <script type="text/javascript">
        $('.eliminarTurno').on('click', function() {
            var dataId = $(this).attr("data-id");
            var dataFecha = $(this).attr("data-fecha");
            $("#modal-turno").html(dataId);
            $("#modal-fecha").html(dataFecha);
            $("input[name='idTurnoACancelar']").val(dataId);
        });
    </script>

    <script type="text/javascript">
        $('.modificarTurno').on('click', function() {
            var dataId = $(this).attr("data-id");
            var dataFechaHora = $(this).attr("data-fecha");
            var dataFecha = dataFechaHora.substr(0,10);
            var dataFilial = $(this).attr("data-filial");
            var dataCancha = $(this).attr("data-cancha");
            $("#modal-turnoM").html(dataId);
            $("#modal-fechaM").html(dataFechaHora);
            $("input[name='idTurnoAModificar']").val(dataId);
            $("input[name='idFilialAModificar']").val(dataFilial);
            $("input[name='idFechaAModificar']").val(dataFecha);
            $("input[name='idCanchaAModificar']").val(dataCancha);
        });

    </script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            $(document).ready(function() {
                var table = $('#example').DataTable({
                    "columnDefs": [{
                        "visible": false,
                        "targets": 2
                    }],
                    "order": [
                        [2, 'asc']
                    ],
                    "displayLength": 25,
                    "drawCallback": function(settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;
                        api.column(2, {
                            page: 'current'
                        }).data().each(function(group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                                last = group;
                            }
                        });
                    }
                });

            });
        });
    </script>
    <script type="text/javascript">
        $('#myTable').DataTable({
            "columnDefs": [{
                "orderable": false,
                "targets": 6
            }]
        });
    </script>
    <script>

        $('#mdate').bootstrapMaterialDatePicker({
            weekStart: 0,
            time: false
        });
        $('#timepicker').bootstrapMaterialDatePicker({
            format: 'HH:mm',
            time: true,
            date: false
        });
        $('#date-format').bootstrapMaterialDatePicker({
            format: 'dddd YYYY MM DD - HH:mm'
        });

        $('#min-date').bootstrapMaterialDatePicker({
            format: 'YYYY/MM/DD HH:mm',
            minDate: new Date()
        });

        // Date Picker
        jQuery('.mydatepicker, #datepicker').datepicker();
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        jQuery('#date-range').datepicker({
            toggleActive: true
        });
        jQuery('#datepicker-inline').datepicker({
            todayHighlight: true
        });
        // Daterange picker
        $('.input-daterange-datepicker').daterangepicker({
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-danger',
            cancelClass: 'btn-inverse'
        });
        $('.input-daterange-timepicker').daterangepicker({
            timePicker: true,
            format: 'YYYY/MM/DD h:mm A',
            timePickerIncrement: 30,
            timePicker12Hour: true,
            timePickerSeconds: false,
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-danger',
            cancelClass: 'btn-inverse'
        });
        $('.input-limit-datepicker').daterangepicker({
            format: 'YYYY/MM/DD',
            minDate: '06/01/2015',
            maxDate: '06/30/2015',
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-danger',
            cancelClass: 'btn-inverse',
            dateLimit: {
                days: 6
            }
        });
    </script>

</body>

</html>

<?php } else header( "Location: ../../index.php"); ?>
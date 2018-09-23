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
    <link href="../../assets/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <link href="../../assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet" />
    <link href="../../assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="../../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="../../assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="../../assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
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
    <!-- ============================================================== 
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
                    <div class="col-md-9 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Reservas</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../../">Inicio</a>
                            </li>
                            <li class="breadcrumb-item active">Mis reservas</li>
                        </ol>
                    </div>
                    <div class="col-md-3 col-3 align-self-right">
                        <?php
                        if(isset($_SESSION["mensajesCancelacion"])){
                          if($_SESSION["mensajesCancelacion"][0] == 1){
                            echo '<div class="alert alert-success" role="alert"><center>';
                            echo $_SESSION["mensajesCancelacion"][1];
                            echo '</center></div>';
                          }else{
                            echo '<div class="alert alert-danger" role="alert">';
                            echo $_SESSION["mensajesCancelacion"][1];
                            echo '</div>';
                          }
                          unset($_SESSION["mensajesCancelacion"]);
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
                  <input type="hidden" id="idTurnoACancelar" name="idTurnoACancelar" value=""> 
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
                                                                <th>Sede</th>
                                                                <th>Cancha</th>
                                                                <th>Fecha</th>
                                                                <th>Precio</th>
                                                                <th>Estado</th>
                                                                <th class="text-nowrap">Cancelar reserva</th>
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
                                                                <td>
                                                                    <?php echo "Cancha " . $numCanchas[$turno->getIdCancha()] . " - " . $depCanchas[$turno->getIdCancha()]; ?></td>
                                                                <td><span class="text-muted"><i class="fa fa-clock-o"></i> <?php echo $turno->getFechahoraFormat(); ?></span> </td>
                                                                <td>
                                                                    <?php echo $catCanchas[$turno->getIdCancha()]; ?></td>
                                                                <td>
                                                                    <?php if ($turno->getEstado() == "reservada"){ 

                                                                        date_default_timezone_set('America/Argentina/Buenos_Aires');
                                                                            
                                                                            $fecha_actual = date_create();
                                                                            $fecha_reserva = $turno->getFechahoraFormat();

                                                                            if (date_format($fecha_actual, 'd/m/Y H:i') < $fecha_reserva){
                                                                                echo '<div class="label label-table label-success">'. "Reservada" .'</div>';
                                                                            }else{
                                                                                echo '<div class="label label-table label-warning">'. "Reservada" .'</div>';
                                                                            }
                                                                        }elseif($turno->getEstado() == "cancelada"){ 
                                                                            echo '<div class="label label-table label-danger">'. "Cancelada" .'</div>'; 
                                                                        } ?>
                                                                </td>
                                                                <td class="text-nowrap">

                                                                    <?php 

                                                                    if ($turno->getEstado() == "reservada"){ 

                                                                            date_default_timezone_set('America/Argentina/Buenos_Aires');
                                                                            
                                                                            $fecha_actual = date_create();
                                                                            $fecha_reserva = $turno->getFechahoraFormat();

                                                                            if (date_format($fecha_actual, 'd/m/Y H:i') < $fecha_reserva){
                                                                                echo '<button type="button" class="eliminarTurno btn btn-outline-danger waves-effect waves-light" data-toggle="modal" data-id="'. $turno->getIdTurno() .'" data-fecha="'. $turno->getFechahoraFormat() .'" data-target="#eliminarTurno"> <i class="fa fa-close text-danger "></i> </button>';
                                                                            }else{
                                                                                echo "Reserva expirada";
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
                                                        <input type="text" class="form-control" name="start" placeholder="Desde" />
                                                        <span class="input-group-addon bg-info b-0 text-white">></span>
                                                        <input type="text" class="form-control" name="end" placeholder="hasta" />

                                                        <div class="ml-2">
                                                            <button id="buscarReservas" name="buscarReservas" type="submit" class="btn btn-success">Buscar</button>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end tabs -->
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
                            <div class="modal-body">
                              
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
    <!-- Clock Plugin JavaScript -->
    <script src="../../assets/plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="../../assets/plugins/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
    <script src="../../assets/plugins/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
    <script src="../../assets/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="../../assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="../../assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- ============================================================== -->
    <script src="../../assets/plugins/switchery/dist/switchery.min.js"></script>
    <script src="../../assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="../../assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="../../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="../../assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../assets/plugins/multiselect/js/jquery.multi-select.js"></script>


    <script type="text/javascript">
        $('.eliminarTurno').on('click', function() {
            var dataId = $(this).attr("data-id");
            var dataFecha = $(this).attr("data-fecha");
            $("#modal-turno").html(dataId);
            $("#modal-fecha").html(dataFecha);
            $("input[name='idTurnoACancelar']").val(dataId);
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
        // MAterial Date picker


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
        // Clock pickers
        $('#single-input').clockpicker({
            placement: 'bottom',
            align: 'left',
            autoclose: true,
            'default': 'now'
        });
        $('.clockpicker').clockpicker({
            donetext: 'Done',
        }).find('input').change(function() {
            console.log(this.value);
        });
        $('#check-minutes').click(function(e) {
            // Have to stop propagation here
            e.stopPropagation();
            input.clockpicker('show').clockpicker('toggleView', 'minutes');
        });
        if (/mobile/i.test(navigator.userAgent)) {
            $('input').prop('readOnly', true);
        }
        // Colorpicker
        $(".colorpicker").asColorPicker();
        $(".complex-colorpicker").asColorPicker({
            mode: 'complex'
        });
        $(".gradient-colorpicker").asColorPicker({
            mode: 'gradient'
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

    <script>
        jQuery(document).ready(function() {
            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });
            // For select 2
            $(".select2").select2();
            $('.selectpicker').selectpicker();
            //Bootstrap-TouchSpin
            $(".vertical-spin").TouchSpin({
                verticalbuttons: true,
                verticalupclass: 'ti-plus',
                verticaldownclass: 'ti-minus'
            });
            var vspinTrue = $(".vertical-spin").TouchSpin({
                verticalbuttons: true
            });
            if (vspinTrue) {
                $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
            }
            $("input[name='tch1']").TouchSpin({
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
                postfix: '%'
            });
            $("input[name='tch2']").TouchSpin({
                min: -1000000000,
                max: 1000000000,
                stepinterval: 50,
                maxboostedstep: 10000000,
                prefix: '$'
            });
            $("input[name='tch3']").TouchSpin();
            $("input[name='tch3_22']").TouchSpin({
                initval: 40
            });
            $("input[name='tch5']").TouchSpin({
                prefix: "pre",
                postfix: "post"
            });
            // For multiselect
            $('#pre-selected-options').multiSelect();
            $('#optgroup').multiSelect({
                selectableOptgroup: true
            });
            $('#public-methods').multiSelect();
            $('#select-all').click(function() {
                $('#public-methods').multiSelect('select_all');
                return false;
            });
            $('#deselect-all').click(function() {
                $('#public-methods').multiSelect('deselect_all');
                return false;
            });
            $('#refresh').on('click', function() {
                $('#public-methods').multiSelect('refresh');
                return false;
            });
            $('#add-option').on('click', function() {
                $('#public-methods').multiSelect('addOption', {
                    value: 42,
                    text: 'test 42',
                    index: 0
                });
                return false;
            });
            $(".ajax").select2({
                ajax: {
                    url: "https://api.github.com/search/repositories",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;
                        return {
                            results: data.items,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                escapeMarkup: function(markup) {
                    return markup;
                }, // let our custom formatter work
                minimumInputLength: 1,
                templateResult: formatRepo, // omitted for brevity, see the source of this page
                templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
            });
        });
    </script>

</body>

</html>

<?php } else header( "Location: ../../index.php"); ?>
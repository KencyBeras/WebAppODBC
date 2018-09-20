<?php

require_once '../model/dao/DataSource.php';
require_once '../model/datos/Cancha.php';
require_once '../model/dao/CanchaDao.php';


require_once '../model/datos/Filial.php';
require_once '../model/dao/FilialDao.php';
require_once '../model/datos/Turno.php';
require_once '../model/dao/TurnoDao.php';


@session_start();

if(isset($_SESSION["datosSesion"]) && (strcmp($_SESSION["tipoSesion"], "socio") == 0)){
$socio = json_decode($_SESSION["datosSesion"]);

$idFilial = $_GET["id"];
$sede = $_GET["sede"];

$filialDao = new FilialDao();
$turnoDao = new TurnoDao();

$filial = $filialDao->selectFilial($idFilial);

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
    <title>Reservar cancha en <?php echo $sede ?></title>
    <!-- ============================================================== -->
    <!-- This page plugins -->
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
     <!--============================================================== -->
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
                        <h3 class="text-themecolor m-b-0 m-t-0"><?php echo $sede ?></h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../../">Inicio</a></li>
                            <li class="breadcrumb-item">Reservar cancha</li>
                            <li class="breadcrumb-item active"><?php echo $sede ?></li>
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
                    <div class="col-md-12 col-12">
                      <div class="card">
                          <div class="card-body">
                              <h4 class="card-title">Canchas de <?php echo $sede ?></h4>
                              <div class="row">
                                  <div class="col-sm-4">
                                    <select id="deporte" class="selectpicker m-b-20 m-r-10" data-style="btn-info btn-outline-info">
                                        <option value="" selected disabled>Seleccionar</option>
                                      <?php foreach ($_SESSION[$idFilial . "_deportes"] as $deporte){   ?>
                                        <option data-id="<?php echo $deporte ?>"><?php   echo $deporte ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>

                              </div>
                          </div>
                      </div>

                      <script>
                      $(function () {
                        $('#consultarHorarios').on('click', function () {
                          $.ajax({
                            url: "../test/ajaxReservar.php?",
                            data: {
                              idfilial: <?php echo $idFilial; ?>,
                              fechaReserva: $("input[name=fecha]").val(),
                            },
                            type: 'GET', //{POST, GET}
                            dataType: "JSON", //{JSON, XML, TEXT, SCRIPT, HTML}
                            beforeSend: function(){
                              $('#horarios').css("visibility", "hidden");
                              $('.ajax-loader').css("visibility", "visible");
                            },
                            success: function(data) {
                                //on success return data here
                                var horaInicio = '<?php echo $filial->getHorario_apertura(); ?>'.substr(0,2);
                                var horaCierre = '<?php echo $filial->getHorario_cierre(); ?>'.substr(0,2);
                                var horaTurno; //Se instancia en cada turno según el valor en el for

                                //Modifique el boton con data-hora y data-cancha. la funcion javascript esta abajo del footer y envia los parametros al modal. No funciona!
                                for(var i=horaInicio ; i<horaCierre ; i++){
                                  $("#horas").append( "<button type='button' class='btn waves-effect waves-light btn-info' data-toggle='modal' data-target='#confirmarHorario' id='hora"+i+"' data-cancha='tipoCancha'>"+i+":00</button>   ");
                                }
                                $.each(data, function(i, turno) {
                                  horaTurno = turno.fechahora.substr(11, 2);
                                  for(var i=horaInicio ; i<horaCierre ; i++){
                                    if(i==horaTurno){
                                      //$("input[id='hora"+i+"']").attr("disabled","disabled");
                                      $("#hora"+i).addClass("btn btn-info disabled"); //Cambio estilo del boton
                                      $("#hora"+i).attr("disabled", true); //Desactivo el boton
                                    }
                                  }
                                });
                            },
                            complete: function(){
                                $('.ajax-loader').css("visibility", "hidden");
                                $('#horarios').css("visibility", "visible");
                              },
                            error : function (xhr, ajaxOptions, thrownError){  
                              console.log(xhr.status);          
                              console.log(thrownError);
                            } 
                          });
                        });
                      });

                      /*$.get( "ajax/test.html", function( data ) {
                        $( ".result" ).html( data );
                        alert( "Load was performed." );
                      });*/

                      </script>
                      

                      <div class="card">
                          <div class="card-body">
                              <h4 class="card-title">Buscar horarios disponibles</h4>
                              <div class="row">
                                  <div class="col-sm-4">
                                        <div class="input-group">
                                            <input name="fecha" type="text" class="form-control" id="datepicker-autoclose" placeholder="dd/mm/aaaa">
                                            <span class="input-group-addon"><i class="icon-calender"></i></span>
                                        </div>
                                  </div>
                                  <div class="col-sm-4">
                                        <button id="consultarHorarios" name="consultarHorarios" type="button" class="btn waves-effect waves-light btn-info">Consultar</button>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="row" >
                          <div class="col-12" id="horarios">
                              <div class="ajax-loader"><img src="loading_balls.gif" class="img-responsive" /></div>
                          </div>
                      </div>
                      

              <!-- ESTE ES EL MODAL, QUE NO ESTA RECIBIENDO BIEN LOS PARAMETROS. EL JS ESTA ABAJO DEL FOOTER -->
                      <!-- sample modal content -->
                      <div id="confirmarHorario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                      <h4 class="modal-title">Confirmar Reserva</h4>
                                  </div>
                                  <div class="modal-body">
                                    <ul>
                                      <li>
                                        <i class="fa fa-map-marker"></i> <b> Sede:</b> <?php echo $sede ?>
                                      </li>
                                      <li>
                                        <i class="fa fa-calendar"></i><b> Dia y Hora:</b> 
                                        <span id="modal-hora"></span>

                                      </li>
                                      <li>
                                        <i class="mdi mdi-run"></i><b> Cancha:</b> <span id="modal-cancha"></span>
                                      </li>
                                      <li>
                                      <i class="fa fa-user"></i><b> Usuario:</b> <?php
                                                echo $socio->nombre . " " . $socio->apellido;
                                          ?>
                                      </li>
                                    </ul>


                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancelar</button>
                                      <button type="button" class="btn btn-info waves-effect waves-light">Reservar</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- /.modal -->

                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © 2018 Club Social Los Amigos
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->

    <!-- ESTE SCRIPT ES PARA TRAER LOS ATRIBUTOS DESDE EL BUTTON HACIA EL MODAL -->
                      <script type="text/javascript">
                        $('#confirmarHorario').on('show.bs.modal', function (event) {
                          $("#modal-hora").html($("[name='fecha']").val());
                          $("#modal-hora").append(" - " + $(event.relatedTarget).text());
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



    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

    <script>
    var query = 0;
    $("#consultarHorarios").click(function (e) {

      query ++;

      var fecha = document.getElementById("datepicker-autoclose").value;
      var deporte = document.getElementById("deporte").value;

      if(query == 2){
        $("#div1").remove();
        query = 1;
      }

      if(query == 1){
        $("#horarios").append('<div id="div1" class="card"> <div class="card-body"><h4 class="card-title">Horarios disponibles el '+ fecha + " para canchas de " + deporte +'</h4>' +
                 '<div class="row"><div class="col-sm-10">' +
                 '<div id=horas>' +
                 '</div>' +
                 '</div></div></div></div></div>'
        );
      }
    });
    </script>



                            
                          

</body>

</html>



<?php
    }
    else header("Location: ../../index.php");
?>

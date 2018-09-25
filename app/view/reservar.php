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

$filialDao = new FilialDao();
$turnoDao = new TurnoDao();

$sede = $filialDao->selectFilial($idFilial);

if(isset($sede)){

$horario_apertura = $sede->getHorario_apertura();
$horario_cierre = $sede->getHorario_cierre();
$diaMantenimiento = $sede->getDiames_mantenimiento();

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
    <title>Reservar cancha en <?php echo $sede->getLocalidad(); ?></title>
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
                        <h3 class="text-themecolor m-b-0 m-t-0"><?php echo $sede->getLocalidad(); ?></h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../../">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="../../">Reservar cancha</a></li>
                            <li class="breadcrumb-item active"><?php echo $sede->getLocalidad(); ?></li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->

                <form action="../controller/ReservarController.php" method="POST">

                    <input type="hidden" name="idFilial" value="<?php echo $idFilial; ?>">
                    <input type="hidden" name="numAfiliado" value="<?php echo $socio->num_afiliado; ?>">
                    <input type="hidden" id="fechaHora" name="fechaHora" value="">

                <div class="row">
                    <div class="col-md-12 col-12">
                      <div class="card">
                          <div class="card-body">
                              <h4 class="card-title">Canchas de <?php echo $sede->getLocalidad(); ?></h4>
                              <div class="row">
                                  <div class="col-sm-4">

                                    <select id="deporte" name="deporte" class="form-control custom-select">
                                        <option value="" selected disabled>Deporte</option>
                                      <?php foreach ($_SESSION[$idFilial . "_deportes"] as $deporte){   ?>
                                        <option data-id="<?php echo $deporte ?>"><?php   echo $deporte ?></option>
                                      <?php } ?>
                                    </select>

                                    <br><br>

                                        <select id="cancha" name="cancha" class="form-control custom-select" disabled>
                                          <option value="" selected disabled>Cancha</option>
                                      </select>

                                    

                                  </div>

                                   <div class="col-sm-6" id="divCanchas">
                                        <div class="ajax-loaderCanchas"><img src="../../public/img/loading_balls.gif" class="img-responsive" /></div>
                                     </div>

                              </div>
                          </div>
                      </div>

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
                                        <button id="consultarHorarios" name="consultarHorarios" type="button" class="btn waves-effect waves-light btn-info" disabled>Consultar</button>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="row" >
                          <div class="col-12" id="horarios">
                              <div class="ajax-loader"><img src="../../public/img/loading_balls.gif" class="img-responsive" /></div>
                          </div>
                      </div>
                      

              <!-- MODAL DE CONFIRMACIÓN DE RESERVA -->
                      <!-- sample modal content -->
                      <div id="confirmarHorario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                      <h4 class="modal-title">Confirmar Reserva</h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><i class="fa fa-map-marker"></td>
                                                <td></i><?php echo $sede->getLocalidad(); ?></td>

                                            </tr>
                                            <tr>
                                                <td><i class="fa fa-calendar"></i></td>
                                                <td><span id="modal-hora"></span></td>
                                            </tr>
                                            <tr>
                                                <td><i class="mdi mdi-run"> </i></td>
                                                <td><span id="modal-cancha"></span></td>

                                            </tr>
                                            <tr>
                                                <td><i class="fa fa-user"></td>
                                                <td><?php echo $socio->user;?></td>

                                            </tr>
                                            <tr>
                                                <td><i class="fa fa-send"> </i></td>
                                                <td><?php echo $socio->email;?></td>
                                            </tr>
                                        </tbody>
                                         
                                    </table>

                                </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancelar</button>
                                      <button type="submit" class="btn btn-info waves-effect waves-light">Reservar</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- /.modal -->

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

    <!-- ESTE SCRIPT ES PARA TRAER LOS ATRIBUTOS DESDE EL BUTTON HACIA EL MODAL -->
                      <script type="text/javascript">
                        $('#confirmarHorario').on('show.bs.modal', function (event) {
                          $("#modal-hora").html($("[name='fecha']").val());
                          $("#modal-hora").append(" " + $(event.relatedTarget).text());
                          $("#modal-cancha").html(document.getElementById("deporte").value);
                        });
                      </script>
                      <!-- SETEO DEL INPUT TYPE HIDDEN "fechaHora" -->
                      <script>
                        $( "form" ).submit(function() { //Al enviar seteo fechaHora en el hidden para poder usarlo por POST
                          $("input[name='fechaHora']").val($("#modal-hora").text());
                        });
                      </script>
                      <script>
                        $("input[name='fecha']").change(function () {
                          fechaHoy = new Date();
                          fechaHoy.setDate(fechaHoy.getDate() - 1); //Para que funcione con la fecha actual le resto 1 día
                          fechaSelect = $("input[name='fecha']").val();
                          if(new Date(fechaHoy) > new Date(fechaSelect)){
                            alert("No puede realizar una reserva en fechas anteriores");
                            $("input[name='fecha']").val("");
                          }
                        });
                      </script>

                        <script>
                          $("#deporte").change(function(){
                              $("#cancha").attr("disabled", false); //Desactivo el boton);

                              $.ajax({
                                url: "../negocio/ajaxCanchas.php?",
                                data: {
                                  idfilial: <?php echo $idFilial; ?>,
                                  deporte: $("select[id=deporte]").val(),
                                },
                                type: 'GET', //{POST, GET}
                                dataType: "JSON", //{JSON, XML, TEXT, SCRIPT, HTML}
                                beforeSend: function(){
                                  $('#divCanchas').css("visibility", "hidden");
                                  $('.ajax-loaderCanchas').css("visibility", "visible");
                                },
                                success: function(data) {

                                  $('#cancha').html('<option value="" selected disabled>Cancha</option>');

                                  $.each(data, function(i, cancha) {
                                  idCancha = cancha.idCancha;

                                  $('#cancha').append($('<option>', {
                                    name: "cancha",
                                    value: cancha.numcancha,
                                    text: cancha.numcancha + " - " + cancha.categoria
                                }));

                                  $("#idCancha").val(idCancha) // Seteo sobre el input hidden idCancha el idCancha

                                });   
                                },
                                complete: function(){
                                  $('.ajax-loaderCanchas').css("visibility", "hidden");
                                  $('#divCanchas').css("visibility", "visible");
                                },
                                error : function (xhr, ajaxOptions, thrownError){  
                                  console.log(xhr.status);          
                                  console.log(thrownError);
                                } 
                              });
                              
                          });

                          $("#cancha").change(function(){
                              $("#consultarHorarios").attr("disabled", false); //Desactivo el boton);

                              
                          });

                      </script>

                      <script>
                      $(function () {
                        $('#consultarHorarios').on('click', function () {
                          $.ajax({
                            url: "../negocio/ajaxReservar.php?",
                            data: {
                              idfilial: <?php echo $idFilial; ?>,
                              fechaReserva: $("input[name=fecha]").val(),
                              deporte: $("select[id=deporte]").val(),
                              numcancha: $("select[id=cancha]").val(),
                            },
                            type: 'GET', //{POST, GET}
                            dataType: "JSON", //{JSON, XML, TEXT, SCRIPT, HTML}
                            beforeSend: function(){
                              $('#horarios').css("visibility", "hidden");
                              $('.ajax-loader').css("visibility", "visible");
                            },
                            success: function(data) {
                                //on success return data here
                                var horaInicio = '<?php echo $horario_apertura; ?>'.substr(0,2);
                                var horaCierre = '<?php echo $horario_cierre; ?>'.substr(0,2);
                                var diaMantenimiento = "<?php echo $diaMantenimiento ?>";
                                var fechaReserva = new Date($("input[name=fecha]").val());
                                var diaReserva = $("input[name=fecha]").val().substr(8,2);
                                var fechaActual = new Date();
                                //Valido que el primer número no sea 0 (Ej 08, 09) - Si es 0 se toma solo el segundo dígito (Ej 8, 9)
                                if(diaReserva.substr(0,1)==0) diaReserva = diaReserva.substr(1,1);
                                var horaTurno; //Se instancia en cada turno según el valor en el for

                                //Se crean los botones con los horarios correspondientes
                                for(var i=horaInicio ; i<horaCierre ; i++){
                                  $("#horas").append( "<button type='button' class='btn waves-effect waves-light btn-info' data-toggle='modal' data-target='#confirmarHorario' id='hora"+i+"'>"+i+":00</button>   ");
                                  if(diaReserva==diaMantenimiento || (fechaActual.toLocaleDateString("en-US")==fechaReserva.toLocaleDateString("en-US") && i<=fechaActual.getHours())){ //Si es el dia de mantenimiento o es una hora del día de hoy que ya ocurrió (no se puede reservar)
                                    $("#hora"+i).addClass("btn btn-danger disabled"); //Cambio estilo del boton
                                    $("#hora"+i).attr("disabled", true); //Desactivo el boton
                                  }
                                }
                                //Se itera sobre los botones y se desactivan si ya existe algún turno en ese horario
                                $.each(data, function(i, turno) {
                                  horaTurno = turno.fechahora.substr(11, 2);
                                  for(var i=horaInicio ; i<horaCierre ; i++){
                                    if(i==horaTurno){
                                      $("#hora"+i).addClass("btn btn-danger disabled"); //Cambio estilo del boton
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
        minDate: 0,
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
        $("#datepicker-autoclose").datepicker({
          minDate: new Date()
        });
        /*$(".ajax").select2({
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
        });*/
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
    } // ifset selectFilial
    else{
      header("Location: 404.php");
    }

    } // ifset session
    else header("Location: ../../index.php");
?>

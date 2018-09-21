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
    <!-- Custom CSS -->
    <link href="../../public/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="../../public/css/colors/green-dark.css" id="theme" rel="stylesheet">
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
                        <h3 class="text-themecolor m-b-0 m-t-0">Reservas</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../../">Inicio</a></li>
                            <li class="breadcrumb-item active">Mis reservas</li>
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
                        <div class="card">
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
                                              <th class="text-nowrap">Modificar</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php 
                                                $count = 1;
                                                foreach($turnos as $turno){
                                                
                                          ?>
                                          <tr>
                                              <td><?php echo $count; ?></td>
                                              <td><?php echo $localidades[$turno->getIdFilial()]; ?></td>
                                              <td><?php echo "Cancha " . $numCanchas[$turno->getIdCancha()] . " - " . $depCanchas[$turno->getIdCancha()];   ?></td>
                                              <td><span class="text-muted"><i class="fa fa-clock-o"></i> <?php echo $turno->getFechahoraFormat(); ?></span> </td>
                                              <td><?php echo $catCanchas[$turno->getIdCancha()]; ?></td>
                                              <td>
                                                  <div class="label label-table label-success"><?php echo $turno->getEstado(); ?></div>
                                              </td>
                                              <td class="text-nowrap">
                                                  <a href="#" data-toggle="tooltip" data-original-title="Modificar"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                  <a href="#" data-toggle="tooltip" data-original-title="Cancelar"> <i class="fa fa-close text-danger"></i> </a>
                                              </td>
                                          </tr>
                                            <?php
                                                $count ++;
                                                }
                                            ?>
                                      </tbody>
                                  </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row -->
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
    <!-- This is data table -->
    <script src="../../assets/plugins/datatables/jquery.dataTables.min.js"></script>
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
        $('#myTable').DataTable( {
        "columnDefs": [
            { "orderable": false, "targets": 6 }
          ]
          });
    </script>
</body>

</html>

<?php
    }
    else header("Location: ../../index.php");
?>

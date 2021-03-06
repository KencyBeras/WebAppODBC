<?php @session_start(); ?>

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
    <link href="../../public/css/colors/default-dark.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
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
    <section id="wrapper" class="login-register login-sidebar"  style="background-image:url(../../public/img/backgroundTenis.jpg);">
  <div class="login-box card">
    <div class="card-body">
      <form class="form-horizontal form-material" id="loginform" action="../index.php?sesion=registro" method="post">
        <span href="javascript:void(0)" class="text-center db"><i class="fa fa-users fa-2x"></i><br/><h2>Club Social Los Amigos</h2></span>
        <?php
        if(isset($_SESSION["mensajeRegistro"])){
          if($_SESSION["mensajeRegistro"][0] == 0){
            echo '<div class="alert alert-danger" role="alert">';
            echo $_SESSION["mensajeRegistro"][1];
            echo '</div>';
          }
          unset($_SESSION["mensajeRegistro"]);
        }
        ?>
        <h3 class="box-title m-t-20 m-b-0">Registrate ahora</h3><small>Crea tu cuenta y empezá a reservar tus canchas fácil</small>
        <div class="form-group m-t-20" style="margin-bottom: 8px;" >
          <div class="col-xs-12">
            <input class="form-control" type="text" required="" name="user" placeholder="Usuario">
          </div>
        </div>
        <div class="form-group " style="margin-bottom: 8px;" >
          <div class="col-xs-12">
            <input class="form-control" type="password" required="" name="pass" placeholder="Contraseña">
          </div>
        </div>
        <div class="form-group " style="margin-bottom: 8px;" >
          <div class="col-xs-12">
            <input class="form-control" type="text" required="" name="nombre" placeholder="Nombre">
          </div>
        </div>
        <div class="form-group" style="margin-bottom: 8px;" >
          <div class="col-xs-12">
            <input class="form-control" type="text" required="" name="apellido" placeholder="Apellido">
          </div>
        </div>
        <div class="form-group" style="margin-bottom: 8px;" >
          <div class="col-xs-12">
            <input class="form-control" type="text" required="" name="direccion" placeholder="Dirección">
          </div>
        </div>
        <div class="form-group" style="margin-bottom: 8px;" >
          <div class="col-xs-12">
            <input class="form-control" type="text" required="" name="telefono" placeholder="Teléfono">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="text" required="" name="email" placeholder="Correo electrónico">
          </div>
        </div>
        <div class="form-group text-center m-t-15 m-b-0">
          <div class="col-12">
            <button class="btn btn-info btn-md btn-block text-uppercase waves-effect waves-light" type="submit">Registrarse</button>
          </div>
        </div>
        <div class="form-group m-b-0">
          <div class="col-sm-12 text-center">
            <p>Ya tenés una cuenta? <a href="login.php" class="text-info m-l-5"><b>Iniciar sesión</b></a></p>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
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

<div class="row page-titles">
	<div class="col-md-5 col-8 align-self-center">
		<h3 class="text-themecolor m-b-0 m-t-0"><?php echo $sede->getLocalidad(); ?></h3>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="../../">Inicio</a></li>
			<li class="breadcrumb-item"><a href="misReservas.php">Modificar reserva</a></li>
			<li class="breadcrumb-item active"><?php echo $sede->getLocalidad(); ?></li>
		</ol>
	</div>
</div>

<?php
	$canchaDao = new CanchaDao();
	$canchaMod = $canchaDao->selectCanchaById($_SESSION['datosMod'][2]);
	$deporteMod = $canchaMod->getDeporte();
	$numCanchaMod =  $canchaMod->getNumCancha();
?>

<script type="text/javascript">
	$(document).ready(function(){	//Al cargar la pagina selecciona los datos de la cancha a modificar
		$("#esModificacion").val("1");
		$("#turnoUpdate").val("<?php echo $_SESSION['datosMod'][0]; ?>"); //Carga el ID de turno seleccionado en el hidden
		$("input[name='fecha']").val("<?php echo $_SESSION['datosMod'][1]; ?>"); //Carga la fecha seleccionada

		$("#deporte").val("<?php echo $deporteMod; ?>");
		$('#deporte').trigger('change');

		setTimeout(function() { //Espera 1 segundo para asegurarse de que cargue el AJAX
     		$("#cancha").val("<?php echo $numCanchaMod; ?>");
     		$('#cancha').trigger('change');
     		$("#consultarHorarios").trigger('click');
    	}, 1000);
	});
</script>

<?php 
	unset($_SESSION['datosMod']);
?>
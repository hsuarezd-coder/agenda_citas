<?php
session_start();
if (!isset($_SESSION['usuario'])) {
	header( 'Location: login.php' ) ;
}

$clave_personal=$_SESSION['clave_personal'];
?>
<!DOCTYPE html> 
<html>
	<head>
	<meta charset="utf-8">
	<title>Sistema de Citas</title> 
	<link rel="stylesheet"  href="css/style.css" />  
	<link rel="stylesheet"  href="css/modal.css" />  
	<link rel="stylesheet"  href="css/jquery-ui.css" />  
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/jquery.form.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/general.js"></script>
	<script>
	$(document).ready(function(){
		var ids = [];		
		var clave_personal = <?php echo $clave_personal; ?>;		
		$.getJSON('servicios/consultarPermisos.php?clave_personal='+clave_personal, function(data) {			
			for(var i = 0; i < data.length; i++) { 	
				ids.push(data[i].clave_operacion_permiso);							
			}
			if($.inArray("8", ids)==-1){
				$("#p8").hide();
			}
			if($.inArray("7", ids)==-1){
				$("#p7").hide();
			}
			if($.inArray("5", ids)==-1){
				$("#p5").hide();
			}
			if($.inArray("6", ids)==-1){
				$("#p6").hide();
			}
			if($.inArray("1", ids)==-1){
				$("#p1").hide();
			}
			if($.inArray("2", ids)==-1){
				$("#p2").hide();
			}
			if($.inArray("9", ids)==-1){
				$("#p9").hide();
			}
			if($.inArray("10", ids)==-1){
				$("#p10").hide();
			}
			if($.inArray("11", ids)==-1){
				$("#p11").hide();
			}
			if($.inArray("12", ids)==-1){
				$("#p12").hide();
			}
		});
	});
	
	
	</script>
</head> 
<body>
	<div class="page">
        <header>
			<div id="fondoEncabezadoAut"></div>
			<div id="logindisplay">
                <a href="logout.php">Salir</a>
			</div>
			<!--div id="cambiarContrasena">
                <a href="cambiarcontrasena.php">Cambiar Contraseña</a>   
            </div--> 
			<div id="menu">
                <ul id="nav"> 
					<li><a href="principal.php">Inicio</a></li>   
					<li id="p11"><a href="#">Citas</a>
						<ul>
							<a href="citasadministrar.php" id="p5">Administrar</a>
							<a href="citasadministrarestudio.php" id="p6">Por Estudio</a>							
							<a href="miagenda.php" id="p8">Mi Agenda</a>
							<a href="consultarcitaspaciente1.php" id="p7">Por Paciente</a>
							<a href="consultarcitaspaciente3.php" id="p12">Reportes</a>
						</ul>
					</li> 
					<li id="p9"><a href="#">Pacientes</a>
						<ul>
							<a href="pacientesadministrar.php" id="p1">Administrar Pacientes</a>							
						</ul>
					</li>
									
					<li id="p10"><a href="#">Estudios</a>
						<ul>
							<a href="resonanciamagneticaregistrarpaciente.php" id="p2">Resonancia Magnética</a>							
						</ul>
					</li>
					<li id="p10"><a href="#">Consultas</a>
						<ul>
							<a href="citasadministrarestudiocve.php" id="p6">Citas Neuropediatría</a>
							<a href="citasadministrarestudiores.php" id="p6">Citas Resonancia</a>
							<a href="pacientesregistrados.php" id="p6">Pacientes Nuevo Ingreso</a>
							<a href="contarCitasNoAsistidas.php" id="p6">Citas No Asistidas</a>
							<a href="exportarEstudios.php" id="p6">Exportar Estudios</a>
							
						</ul>						
					</li>
					<li id="p9"><a href="#">Reportes</a>
						<ul>
							<a href="cistasPorEstudio.php" id="p1">Citas por Estudio</a>
							<a href="estadoCitas.php" id="p1">Estado de Citas</a>
							<a href="cuentasEstudiosMes.php" id="p1">Estudios por mes</a>
							
						</ul>						
					</li>

					
					
					
				</ul>
			</div>
	    </header>
		<section id="main">
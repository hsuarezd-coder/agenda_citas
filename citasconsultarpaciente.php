<?php include("header.php"); ?>	
<?php 
	$clave_paciente=$_GET['clave_paciente'];
	$nombre_paciente=$_GET['nombre_paciente'];	
?>
<?php		
	echo '<h2 style="text-align:center;">Citas registradas para:  </br>'.$nombre_paciente.'</h2>';
	
?>	
	<script src="js/jquery.eventCalendar.js" type="text/javascript"></script>
	<link rel="shortcut icon" href="images/favicon.ico" />
	<link rel="stylesheet" href="css/eventCalendar.css">
	<link rel="stylesheet" href="css/eventCalendar_theme_responsive.css">
	<fieldset class="contenedorFormulario">
        <legend>Fecha y Hora de la Cita</legend>
			<div class="container">
			
			<input type="hidden" id="clave_paciente" value="<?php echo $clave_paciente;?>">			
			<input type="hidden" id="fecha_cita" value="">
			<input type="hidden" id="clave_horario_cita" value="">
			<input type="hidden" id="dia" value="">
			<input type="hidden" id="mes" value="">
			<input type="hidden" id="anio" value="">			
		<div class="row">
			<div class="g6">
&nbsp;			
				<div id="eventCalendarHumanDate"></div>
				<script>
					$(document).ready(function() {
						
						$("#eventCalendarHumanDate").eventCalendar({
							eventsjson: 'servicios/consultarCitasPaciente.php?clave_paciente=<?php echo $clave_paciente;?>',
							monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
										"Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
							dayNames: [ 'Domingo','Lunes','Martes','Miércoles',
										'Jueves','Viernes','Sabado' ],
							dayNamesShort: [ 'Dom','Lun','Mar','Mie', 'Jue','Vie','Sab' ],
							txt_NextEvents:'Proximas Citas',
							txt_operacion:'consultar',
							txt_noEvents:'No hay citas registradas el día seleccionado',
							txt_SpecificEvents_after: ' - Citas',
							jsonDateFormat: 'human'  // 'YYYY-MM-DD HH:MM:SS'
						});											
												
					});									
										
					
				</script>				
			</div>
		</div>
		<div style="width:100%;height:20px;display:inline-block;"></div>
		<div style="text-align:center;">
			<input type="button" class="button" id="btnTerminar" value="Terminar">
		</div>
		</div>
	</fieldset>
<?php include("footer.php"); ?>					
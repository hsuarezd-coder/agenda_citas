<?php include("header.php"); ?>	
<?php 
	$clave_paciente=$_GET['clave_paciente'];
	$nombre_paciente=$_GET['nombre_paciente'];
	$clave_estudio=$_GET['clave_estudio'];
	$nombre_estudio=$_GET['nombre_estudio'];
	$clave_equipo=$_GET['clave_equipo'];
	$nombre_equipo=$_GET['nombre_equipo'];
	$clave_personal=$_GET['clave_personal'];
	$nombre_personal=$_GET['nombre_personal'];
?>
<?php		
	echo '<h2 style="text-align:center;">Registro de una cita para:  </br>'.$nombre_paciente.'</h2>';
	echo '<div class="display-form"><h3 style="text-align:center;">Nombre del Estudio:  </br>'.$nombre_estudio.'</h3></div>';
	echo '<div class="display-form"><h3 style="text-align:center;">Nombre del Equipo:  </br>'.$nombre_equipo.'</h3></div>';
	echo '<div class="display-form"><h3 style="text-align:center;">Nombre del Personal:  </br>'.$nombre_personal.'</h3></div>';
		echo '<div class="display-form"></div>';
		echo '<div class="display-form"></div>';
?>	
	<script src="js/jquery.eventCalendar.js" type="text/javascript"></script>
	<link rel="shortcut icon" href="images/favicon.ico" />
	<link rel="stylesheet" href="css/eventCalendar.css">
	<link rel="stylesheet" href="css/eventCalendar_theme_responsive.css">
	<fieldset class="contenedorFormulario">
        <legend>Fecha y Hora de la Cita</legend>
			<div class="container">
			<input type="hidden" id="clave_estudio" value="<?php echo $clave_estudio;?>">
			<input type="hidden" id="clave_paciente" value="<?php echo $clave_paciente;?>">
			<input type="hidden" id="clave_equipo" value="<?php echo $clave_equipo;?>">
			<input type="hidden" id="clave_personal" value="<?php echo $clave_personal;?>">
			<input type="hidden" id="fecha_cita" value="">
			<input type="hidden" id="clave_horario_cita" value="">
			<input type="hidden" id="dia" value="">
			<input type="hidden" id="mes" value="">
			<input type="hidden" id="anio" value="">
			<input type="hidden" id="cantidadhorarios">
		<div class="row">
			<div class="g6">
&nbsp;			
				<div id="eventCalendarHumanDate"></div>
				<script>
					$(document).ready(function() {
						$.getJSON('servicios/cuentaHorariosEstudio.php?clave_estudio=<?php echo $clave_estudio;?>', function(data) {
							$("#cantidadhorarios").val(data[0].cantidad);								
						});
						$("#eventCalendarHumanDate").eventCalendar({
							eventsjson: 'servicios/consultarCitasEstudioPaciente.php?clave_estudio=<?php echo $clave_estudio;?>&clave_paciente=<?php echo $clave_paciente;?>',
							monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
										"Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
							dayNames: [ 'Domingo','Lunes','Martes','Miércoles',
										'Jueves','Viernes','Sabado' ],
							dayNamesShort: [ 'Dom','Lun','Mar','Mie', 'Jue','Vie','Sab' ],
							txt_NextEvents:'Proximas Citas',
							txt_operacion:'registrar',							
							txt_noEvents:'No hay citas registradas el día seleccionado',
							txt_SpecificEvents_after: ' - Citas',
							jsonDateFormat: 'human'  // 'YYYY-MM-DD HH:MM:SS'
						});
											
					});									
					
					function asignarCita(horario){
						var clave_equipo=$("#clave_equipo").val();
						var clave_personal=$("#clave_personal").val();
						var clave_estudio=$("#clave_estudio").val();
						var clave_estado_cita=1;
						var clave_paciente=$("#clave_paciente").val();
						var fecha_cita=$("#fecha_cita").val();
						$.getJSON('servicios/registrarCita.php?clave_equipo='+clave_equipo+'&clave_personal='+clave_personal+'&clave_estudio='+clave_estudio+'&clave_horario_cita='+horario+'&clave_estado_cita='+clave_estado_cita+'&clave_paciente='+clave_paciente+'&fecha_cita='+fecha_cita, function(data) {							
							// var dia=$("#dia").val();
							// var mes=$("#mes").val();
							// var anio=$("#anio").val();	
								$('html,body').scrollTop(0);
							if(data[0].resultado=="1"){
							mostrarMensajeOK("Se registró correctamente la cita",5,"refresh");
								//location.reload();
							 }else if(data[0].resultado=="2"){
								mostrarMensajePreventivoRef("Ya hay una cita registrada en este horario, selecciona otro por favor.",5,"refresh");
							}else{
								 mostrarMensajeError("Hubo un error al registrar, favor de contactar al administrador",5);
							 }
						});
					}
					
					function asignarNombre(clave_cita){
						
							$("#operacionCitaContenido"+clave_cita).html("");	
							$("#operacionCitaContenido"+clave_cita).append('Nombre del Paciente: <input type="text" name="nom'+clave_cita+'" id="nom'+clave_cita+'"  ><input type="button" name="boton'+clave_cita+'" id="boton'+clave_cita+'" value="Guardar" onclick="cambiarNombre('+clave_cita+')"><input type="button" name="boton'+clave_cita+'" id="boton'+clave_cita+'" value="Cancelar" onclick="cancelarNombre('+clave_cita+')">');
												
					}
					function cambiarNombre(clave_cita){
						//alert($("#nom"+clave_cita).val());
						$.getJSON('servicios/asignaNombre.php?clave_cita='+clave_cita+'&nombre='+$("#nom"+clave_cita).val(), function(data) {
							mostrarMensajeOK("Se actualizó correctamente la cita",5,"refresh");
						});
					}
					function cancelarNombre(clave_cita){
						$("#operacionCitaContenido"+clave_cita).html("");
					}
					
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
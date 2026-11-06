<?php include("header.php"); ?>	
<?php 
	$usuario=$_SESSION['usuario'];
	$clave_personal=$_SESSION['clave_personal'];
	if (!isset($usuario)) {
		header( 'Location: login.php' ) ;
	}
?>
<?php		
	echo '<h2 style="text-align:center;">Citas registradas de:  </br></br>'.$usuario.'</h2>';
	
?>	
	<script src="js/jquery.eventCalendar.js" type="text/javascript"></script>
	<link rel="shortcut icon" href="images/favicon.ico" />
	<link rel="stylesheet" href="css/eventCalendar.css">
	<link rel="stylesheet" href="css/eventCalendar_theme_responsive.css">


	<fieldset class="contenedorFormulario">
        <legend>Fecha y Hora de la Cita</legend>
			<div class="container">
			
			<input type="hidden" id="clave_personal" value="<?php echo $clave_personal;?>">			
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
							eventsjson: 'servicios/consultarCitasPersonal.php?clave_personal=<?php echo $clave_personal;?>',
							monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
										"Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
							dayNames: [ 'Domingo','Lunes','Martes','Miércoles',
										'Jueves','Viernes','Sabado' ],
							dayNamesShort: [ 'Dom','Lun','Mar','Mie', 'Jue','Vie','Sab' ],
							txt_NextEvents:'Proximas Citas',
							txt_operacion:'asistir',
							txt_noEvents:'No hay citas registradas el día seleccionado',
							txt_SpecificEvents_after: ' - Citas',
							jsonDateFormat: 'human'  // 'YYYY-MM-DD HH:MM:SS'
						});							
												
					});	
						
					function cancelarEliminarCita(clave_cita){
						$("#operacionCitaContenido"+clave_cita).html("");	
					}
					
					function asistirChange(clave_cita){
						$("#opEdoCita"+clave_cita).html("");
						$("#opEdoCita"+clave_cita).html("<br><div>Observación:<textarea name='observacion"+clave_cita+"' id='observacion"+clave_cita+"' style='width:700px;'></textarea><div>");
						if($("#estadocita"+clave_cita).val()==="6"){
							$("#opEdoCita"+clave_cita).append("<br><div>Adjuntar Reporte de Estudio:<input type='file' name='reporte' id='reporte'><div>");
						}						
						$("#opEdoCita"+clave_cita).append('<br><div><img src="images/guardar.png" class="manita vertical" onclick="realizarAsistirCita('+clave_cita+')">&nbsp&nbsp<img src="images/cancelar.png" class="manita vertical" onclick="cancelarEliminarCita('+clave_cita+')"></div>');
						
					}
					
					function asistirCita(clave_cita){
						$.getJSON('servicios/consultarEstadosCita.php', function(data) {
							$("#operacionCitaContenido"+clave_cita).html("");	
							$("#operacionCitaContenido"+clave_cita).append('Estado Cita: <select id="estadocita'+clave_cita+'" onchange="asistirChange('+clave_cita+')"><option value="" selected="selected">Selecciona un Estado</option></select>');							
							for(var i = 0; i < data.length; i++) { 					
									$("#estadocita"+clave_cita).append('<option value="'+data[i].clave_estado_cita+'">'+data[i].descripcion_estado_cita+'</option>');
								}
							$("#operacionCitaContenido"+clave_cita).append("<div id='opEdoCita"+clave_cita+"'></div>");
							});
							
					}
					
					
					
					function realizarAsistirCita(clave_cita){	
						if($("#estadocita"+clave_cita).val()==="6"){
							var archivo=document.getElementById("reporte").value;							
							if(archivo != "") {								
								var extensiones_permitidas = new Array(".docx",".doc"); 
								var extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase(); 
								var permitida=false;
								for (var i = 0; i < extensiones_permitidas.length; i++) { 
									if (extensiones_permitidas[i] == extension) { 
										permitida = true; 									
										break; 
									} 
								}
								if(!permitida){
									$('html,body').scrollTop(0);	
									mostrarMensajeError("El tipo de archivo no esta permitido. Debe ser extensión .docx o .doc",5);
									return;
								}
								var m_data = new FormData(); 
								m_data.append( 'reporte', $('input[name=reporte]')[0].files[0]);
								m_data.append( 'nombre_archivo', clave_cita);
								$.ajax({
									url: 'subirArchivo.php',
									data: m_data,
									contentType: false,
									processData: false,
									type: 'POST',
									dataType:'json',
									success: function(data){
										if(data.id==="1"){
											var observacion=$("#observacion"+clave_cita).val();
											var estadocita=$("#estadocita"+clave_cita).val();
											$.getJSON('servicios/asistirCita.php?clave_cita='+clave_cita+'&estadocita='+estadocita+'&observacion='+observacion+'&reporte=1&extension='+data.extension, function(data) {
												$('html,body').scrollTop(0);							
												mostrarMensajeOK("Se actualizó correctamente la cita",5,"refresh");
											});									
										}else{
											$('html,body').scrollTop(0);
											mostrarMensajeError("Hubo un error al actualizar la cita",5);
										}	
											
									},
									error:function (err){
										$('html,body').scrollTop(0);
										mostrarMensajeError("Hubo un error al actualizar la cita...",5);
									}
								});
							}	else{
								var observacion=$("#observacion"+clave_cita).val();
							var estadocita=$("#estadocita"+clave_cita).val();
							$.getJSON('servicios/asistirCita.php?clave_cita='+clave_cita+'&estadocita='+estadocita+'&observacion='+observacion+'&reporte=0&extension=', function(data) {
								$('html,body').scrollTop(0);							
								mostrarMensajeOK("Se actualizó correctamente la cita",5,"refresh");
							});
							}						
						}else{
							var observacion=$("#observacion"+clave_cita).val();
							var estadocita=$("#estadocita"+clave_cita).val();
							$.getJSON('servicios/asistirCita.php?clave_cita='+clave_cita+'&estadocita='+estadocita+'&observacion='+observacion+'&reporte=0&extension=', function(data) {
								$('html,body').scrollTop(0);							
								mostrarMensajeOK("Se actualizó correctamente la cita",5,"refresh");
							});							
						}
						
						/*$.getJSON('servicios/cancelarCita.php?clave_cita='+clave_cita+'&clave_cancelacion='+clave_cancelacion, function(data) {														
							if(data[0].resultado=="1"){
							mostrarMensajeOK("Se cancelo correctamente la cita",5,"refresh");
								//location.reload();
							 }else{
								 mostrarMensajeError("Hubo un error al cancelar la cita, favor de contactar al administrador",5);
							 }
						});*/					
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
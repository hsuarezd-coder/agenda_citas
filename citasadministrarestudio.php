<?php include("header.php"); ?>	

<script src="js/jquery.validate.min.js"></script>
<script src="js/additional-methods.min.js"></script>

	<script>
	$(document).ready(function(){
		$( "#fecha_inicio" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#fecha_fin" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$.getJSON('servicios/consultarEstudios.php', function(data) {
			$("#estudios").html("");
			if(data.length>8){
				$("#estudios").append('<option value="0" selected="selected">TODOS</option>');
			}
			for(var i = 0; i < data.length; i++) { 					
				$("#estudios").append('<option value="'+data[i].clave_estudio+'">'+data[i].nombre_estudio+'</option>');
			}
		});
		
		$.getJSON('servicios/consultarEstadosCitaTodos.php', function(data) {
			$("#estados").html("");	
			$("#estados").append('<option value="0" selected="selected">TODOS</option>');
			for(var i = 0; i < data.length; i++) { 					
				$("#estados").append('<option value="'+data[i].clave_estado_cita+'">'+data[i].descripcion_estado_cita+'</option>');
			}
		});
			
	});
	</script>
	<h2>Administración de Citas</h2>
		<fieldset>
			<legend>Buscar Paciente</legend>
				<form id="formulario">
				<div class="display-form">
					<div class="editor-label">
						Estudio:
					</div>
					<div class="editor-field">
						<select id="estudios" name="estudios" class="mitad" required>
							<option value="0">Selecciona un Estudio</option>
						</select>
					</div> 
				</div>
				<div class="display-form">
					<div class="editor-label">
						Estado:
					</div>
					<div class="editor-field">
						<select id="estados" name="estados" class="mitad" required>
							<option value="0">Selecciona un Estado</option>
						</select>
					</div> 
				</div>
				<div class="display-form">
					<div class="editor-label">
						Fecha Inicio:
					</div>
					<div class="editor-field">
						<input type="text" id="fecha_inicio" name="fecha_inicio" required>
					</div> 
				</div>
				<div class="display-form">
					<div class="editor-label">
						Fecha Fin:
					</div>
					<div class="editor-field">
						<input type="text" id="fecha_fin" name="fecha_fin" required>
					</div> 
				</div>
				<div class="display-form">
					<div class="editor-label">	
						&nbsp;
					</div>
					<div class="editor-field">
						<input type="button" value="" class="buscar vertical" id="btnBuscarCitasEstudio"/>
					</div> 					
				</div>	
				</form>
			<div style="width:100%;height:20px;display:inline-block;"></div>				
			<table>
				<thead>
					<tr>
						<th>Paciente</th>
						<th>Estudio</th>
						<th>Fecha Cita</th>
						<th>Estado Cita</th>  
						<th>Hora Cita</th>  
						<th>Personal</th>  						
					</tr>
				</thead>
				<tbody id="resultado">
									 
				</tbody>
			</table>			
		</fieldset>    
        				
<?php include("footer.php"); ?>
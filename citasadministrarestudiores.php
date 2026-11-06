<?php include("header.php"); ?>	

<script src="js/jquery.validate.min.js"></script>
<script src="js/additional-methods.min.js"></script>

	<script>
	$(document).ready(function(){
		$( "#fecha_inicio" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#fecha_fin" ).datepicker({ dateFormat: 'yy-mm-dd' });
		/*$.getJSON('servicios/consultarEstudios.php', function(data) {
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
		});*/
		
		$('#btnBuscarCitasEstudioReso').on('click', function(){			
			var form = $( "#formulario" );
			if(!form.valid()){
				$('html,body').scrollTop(0);
				mostrarMensajePreventivo("Favor de Capturar los campos requeridos.",5);
				return;
			}
			var estudios=$("#estudios").val();
			var estados=$("#estados").val();
			var fecha_inicio=$("#fecha_inicio").val();			
			var fecha_fin=$("#fecha_fin").val();
			$.getJSON('servicios/citasPorEstudioReso.php?fecha_inicio='+fecha_inicio+'&fecha_fin='+fecha_fin, function(data) {
				$("#resultado").html("");				
				for(var i = 0; i < data.length; i++) { 					
					var cadena='<tr><td>'+data[i].codigo_paciente+'</td>';
					cadena=cadena+'<td>'+data[i].paciente+'</td>';	
					cadena=cadena+'<td>'+data[i].fecha_nacimiento_paciente+'</td>';	
					cadena=cadena+'<td>'+data[i].semanas_gestacion+'</td>';	
					cadena=cadena+'<td>'+data[i].anos+' años, '+data[i].meses+' meses, '+data[i].dias+' dias</td>';					
					cadena=cadena+'<td>'+data[i].nombre_estudio+'</td>';					
					cadena=cadena+'<td>'+data[i].fecha_cita+'</td>';
					cadena=cadena+'<td>'+data[i].descripcion_estado_cita+'</td>';
					cadena=cadena+'<td>'+data[i].hora+'</td>';
					cadena=cadena+'<td>'+data[i].personal+'</td></tr>';					
					$("#resultado").append(cadena);
				 }
			});
		});
		
		 $("#btnExport").click(function(e) {
			e.preventDefault();

			//getting data from our table
			var data_type = 'data:application/vnd.ms-excel';
			var table_div = document.getElementById('table_wrapper');
			var table_html = table_div.outerHTML.replace(/ /g, '%20');

			var a = document.createElement('a');
			a.href = data_type + ', ' + table_html;
			a.download = 'Citas de Resonancia ' + document.getElementById('fecha_inicio').value +' al ' + document.getElementById('fecha_fin').value +'.xls';
			a.click();
		  });
			
	});
	

	</script>
	<h2>Citas de Resonancia </h2>
		<fieldset>
			<legend>Buscar</legend>
				<form id="formulario">
				<!--div class="display-form">
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
				</div-->
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
						<input type="button" value="" class="buscar vertical" id="btnBuscarCitasEstudioReso"/>
					</div> 					
				</div>	
				</form>
			<div style="width:100%;height:20px;display:inline-block;"></div>	
			<button id="btnExport">Exportar a Excel</button>
				<div style="width:100%;height:20px;display:inline-block;"></div>
<div id="table_wrapper">			
			<table>
				<thead>
					<tr>
						<th>Codigo Paciente</th>
						<th>Paciente</th>
						<th>Fecha de Nac.</th>
						<th>SDG</th>
						<th>Edad Cronológica</th>
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
				
</div>			
		</fieldset>    
        				
<?php include("footer.php"); ?>
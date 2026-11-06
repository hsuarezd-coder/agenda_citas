<?php include("header.php"); ?>	

<script src="js/jquery.validate.min.js"></script>
<script src="js/additional-methods.min.js"></script>

	<script>
	$(document).ready(function(){
		$( "#fecha_inicio" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#fecha_fin" ).datepicker({ dateFormat: 'yy-mm-dd' });
		
		$('#btnBuscarPacientesNuevos').on('click', function(){
			var form = $( "#formulario" );
			if(!form.valid()){
				$('html,body').scrollTop(0);
				mostrarMensajePreventivo("Favor de Capturar los campos requeridos..	",5);
				return;
			}
			var estudios=$("#estudios").val();
			var estados=$("#estados").val();
			var fecha_inicio=$("#fecha_inicio").val();			
			var fecha_fin=$("#fecha_fin").val();
			$.getJSON('servicios/consultarPacienteNuevo.php?fecha_inicio='+fecha_inicio+'&fecha_fin='+fecha_fin, function(data) {
				$("#resultado").html("");				
				for(var i = 0; i < data.length; i++) { 					
					var cadena='<tr><td>'+data[i].codigo_paciente+'</td>';
					cadena=cadena+'<td>'+data[i].nombre_paciente+' '+data[i].apellido_paterno_paciente+' '+data[i].apellido_materno_paciente+'</td>';
					cadena=cadena+'<td>'+data[i].fecha_nacimiento_paciente+'</td>';
					cadena=cadena+'<td>'+data[i].estado+'</td>';
					cadena=cadena+'<td>'+data[i].semanas_gestacion+'</td>';
					cadena=cadena+'<td>'+data[i].fecha_registro+'</td>';					
					cadena=cadena+'</tr>'
					$("#resultado").append(cadena);
				 }
			});
		});
		
			
		
		
	});
	
	var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
	</script>
	<h2>Pacientes Nuevo Ingreso</h2>
		<fieldset>
			<legend>Buscar</legend>
				<form id="formulario">				
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
						<input type="button" value="" class="buscar vertical" id="btnBuscarPacientesNuevos"/>
					</div> 					
				</div>	
				<div class="display-form">
					
					<div class="editor-field">
						<input type="button" onclick="tableToExcel('tabla', 'Lista de Pacientes')" value="Exportar a Excel">
					</div> 					
				</div>	
				
				</form>
			<div style="width:100%;height:20px;display:inline-block;"></div>				
			<table id="tabla">
				<thead>
					<tr>
						<th>Código</th>
						<th>Nombre</th>
						<th>Fecha de Nacimiento</th>
						<th>Estado</th>  
						<th>SG</th>  
						<th>Fecha Registro</th>  						
					</tr>
				</thead>
				<tbody id="resultado">
									 
				</tbody>
			</table>			
		</fieldset>    
        				
<?php include("footer.php"); ?>
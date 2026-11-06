<?php include("header.php"); ?>	
	<h2>Administración de Citas</h2>
	
	

		<fieldset>
			<legend>Buscar Paciente</legend>			       
				<p>
					Nombre o Apellidos del Paciente:
					<input type="text" name="paciente" id="paciente" value=""/>
					<input type="button" value="" class="buscar vertical" id="btnBuscarPacienteAdm"/>
				</p>			
			<table>
				<thead>
					<tr>
						<th>Codigo</th>
						<th>Nombre</th>
						<th style='width:150px;'>Apellido Paterno</th>
						<th>Apellido Materno</th>  
						<th>Estado</th>  
						<th>Faltas</th> 
						<th></th>
					</tr>
				</thead>
				<tbody id="resultado">
									 
				</tbody>
			</table>			
		</fieldset>   				
        				
<?php include("footer.php"); ?>
<script>

	function muestraModal(id,nombre){
		$("#modal-header").html("Detalle de faltas: "+nombre);
		//$(".modal-body").html("");
		$.getJSON("servicios/detalleFaltas.php?clave_paciente="+id,function(data){
			var cadena="<table style='width:630px;'><tr>";
			cadena=cadena+"<th>Estudio</th>";
			cadena=cadena+"<th>Personal</th>";
			cadena=cadena+"<th>Fecha</th>";
			cadena=cadena+"</tr>";
			for(var i=0;i<data.length;i++){
				cadena=cadena+"<tr>";
				cadena=cadena+"<td>"+data[i].nombre_estudio+"</td>";
				cadena=cadena+"<td>"+data[i].nombre_personal+" "+data[i].apellido_paterno_personal+" "+data[i].apellido_materno_personal+"</td>";
				cadena=cadena+"<td>"+data[i].fecha_cita+"</td>";
				cadena=cadena+"</tr>";
			}
			cadena=cadena+"</tr></table>";
			$(".modal-body").html(cadena);
		});
		modal.style.display = "block";
	}
</script>
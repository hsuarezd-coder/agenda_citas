<?php include("header.php"); ?>	
<?php
$clave_paciente=$_GET['clave_paciente'];
$nombre_paciente=$_GET['nombre_paciente'];
 ?>		
	<?php		
		echo '<h2 style="text-align:center;">Registro de una cita para:  </br>'.$nombre_paciente.'</h2>';
	?>
	
	<script>
	$(document).ready(function(){
		$.getJSON('servicios/consultarEstudios.php', function(data) {
			$("#estudios").html("");	
			$("#estudios").append('<option value="" selected="selected">Selecciona un Estudio</option>');
			for(var i = 0; i < data.length; i++) { 					
				$("#estudios").append('<option value="'+data[i].clave_estudio+'">'+data[i].nombre_estudio+'</option>');
			}
		});
			
		$('#estudios').on('change', function(){				
			$.getJSON('servicios/consultarEquiposEstudio.php?clave_estudio='+$("#estudios").val(), function(data) {				
				$("#equipos").html("");	
				$("#equipos").append('<option value="" selected="selected">Selecciona un Equipo</option>');
				for(var i = 0; i < data.length; i++) { 					
					$("#equipos").append('<option value="'+data[i].clave_equipo+'">'+data[i].nombre_equipo+'</option>');
				}					
			});
		});

		$('#equipos').on('change', function(){				
			$.getJSON('servicios/consultarPersonalEquipo.php?clave_equipo='+$("#equipos").val(), function(data) {				
				$("#personal").html("");	
				$("#personal").append('<option value="" selected="selected">Selecciona una Persona</option>');
				for(var i = 0; i < data.length; i++) { 	
					var persona=data[i].nombre_personal+" "+data[i].apellido_paterno_personal+" "+data[i].apellido_materno_personal;
					$("#personal").append('<option value="'+data[i].clave_personal+'">'+persona+'</option>');
				}					
			});
		});	

		$('#btnContinuar').on('click', function(){
			var clave_equipo=$("#equipos").val();
			var nombre_equipo=$("#equipos option:selected").text();								
			var clave_estudio=$("#estudios").val();
			var nombre_estudio=$("#estudios option:selected").text();	
			var clave_personal=$("#personal").val();
			var nombre_personal=$("#personal option:selected").text();	
			var url="citasregistrar2.php?clave_paciente=<?php echo $clave_paciente;?>";
			url=url+"&nombre_paciente=<?php echo $nombre_paciente;?>";
			url=url+"&clave_estudio="+clave_estudio;
			url=url+"&clave_equipo="+clave_equipo;
			url=url+"&clave_personal="+clave_personal;
			url=url+"&nombre_estudio="+nombre_estudio;
			url=url+"&nombre_equipo="+nombre_equipo;
			url=url+"&nombre_personal="+nombre_personal;
			window.open(url,"_self")
		});	
	});
	</script>
	<fieldset class="contenedorFormulario">
        <legend>Datos de la Cita</legend>
		<div class="display-form">
			<div class="editor-label">
				Estudio:
			</div>
			<div class="editor-field">
				<select id="estudios" class="mitad" required>
					<option value="">Selecciona un Estudio</option>
				</select>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Equipo:
			</div>
			<div class="editor-field">
				<select id="equipos" class="mitad">
					<option value="">Selecciona un Equipo</option>
				</select>
			</div>
		</div>
		<div class="display-form">
			<div class="editor-label">
				Personal:
			</div>
			<div class="editor-field">
				<select id="personal" class="mitad">
					<option value="">Selecciona una Persona</option>
				</select>
			</div>
		</div>
		<div style="width:100%;height:20px;display:inline-block;"></div>
		<div style="text-align:center;">
			<input type="button" class="button" id="btnContinuar" value="Continuar">
		</div>
	</fieldset>
	
	
			
<?php include("footer.php"); ?>
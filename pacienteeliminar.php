<?php include("header.php"); 
$clave_paciente=$_GET['clave_paciente'];
$nombre_paciente=$_GET['nombre_paciente'];
?>	
		
<h2>Dar de baja al paciente: <?php echo $nombre_paciente;?></h2>
<script src="js/jquery.validate.min.js"></script>
<script src="js/additional-methods.min.js"></script>
<input type="hidden" id="clave_paciente" value="<?php echo $clave_paciente;?>">
	<script>
	$(document).ready(function(){
		var form = $( "#formulario" );
		
		
		
	
		$( "#fecha_nacimiento_paciente" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#fum" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#fecha_nacimiento_madre" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#fecha_ingreso_paciente" ).datepicker({ dateFormat: 'yy-mm-dd' });
		
		$.getJSON('servicios/consultarPacientePorClave.php?clave_paciente='+$("#clave_paciente").val(), function(data) {
			$("#codigo_paciente").val(data[0].codigo_paciente);
			$("#nombre_paciente").val(data[0].nombre_paciente);
			$("#apellido_paterno_paciente").val(data[0].apellido_paterno_paciente);
			$("#apellido_materno_paciente").val(data[0].apellido_materno_paciente);
			$("#fecha_nacimiento_paciente").val(data[0].fecha_nacimiento_paciente);
			$("#nombre_padre_paciente").val(data[0].nombre_padre_paciente);
			$("#nombre_madre_paciente").val(data[0].nombre_madre_paciente);			
			$("#fecha_ingreso_paciente").val(data[0].fecha_ingreso_paciente);

			
		}).error(function() { 
			mostrarMensajeError("Hubo un error al consultar el paciente, favor de contactar al administrador",5); 
			$(".contenedorFormulario").hide();
		});
		
		$('#btnEliminarPaciente').on('click', function(){										
			if(!form.valid()){
				$('html,body').scrollTop(0);
				mostrarMensajePreventivo("Favor de Capturar los campos requeridos.",5);
				return;
			}
			var url="servicios/eliminarPaciente.php?clave_paciente="+$("#clave_paciente").val();
			url=url+"&motivo_baja="+$("#motivo_baja").val();
			$.getJSON(url, function(data) {	
				$('html,body').scrollTop(0);
				if(data[0].resultado=="1"){					
					mostrarMensajeOK("Se dió de baja correctamente el paciente",5,"principal.php");
					//location.reload();
				}else{
					 mostrarMensajeError("Hubo un error al dar de baja el paciente, favor de contactar al administrador",5);
				}
			});
		});
				
			
	});
	</script>
	<form id="formulario">
	<fieldset class="contenedorFormulario">
        <legend>Datos del Paciente</legend>
		<div class="display-form">
			<div class="editor-label">
				Código:
			</div>
			<div class="editor-field">
				<input type="text" name="codigo_paciente" id="codigo_paciente" required style="border:none;" readonly="readonly"//>
				<input type="hidden" name="clave_paciente" id="clave_paciente" value="<?php echo $clave_paciente;?>" required/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Nombre:
			</div>
			<div class="editor-field">
				<input type="text" name="nombre_paciente" id="nombre_paciente"  style="border:none;" readonly="readonly"/>				
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Apellido Paterno:
			</div>
			<div class="editor-field">
				<input type="text" name="apellido_paterno_paciente" id="apellido_paterno_paciente"  style="border:none;" readonly="readonly"/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Apellido Materno:
			</div>
			<div class="editor-field">
				<input type="text" name="apellido_materno_paciente" id="apellido_materno_paciente"  style="border:none;" readonly="readonly"/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Fecha de Nacimiento:
			</div>
			<div class="editor-field">
				<input type="text" id="fecha_nacimiento_paciente"  style="border:none;" readonly="readonly"/>
			</div> 
		</div>		
		<div class="display-form">
			<div class="editor-label">
				Fecha de Ingreso:
			</div>
			<div class="editor-field">
				<input type="text" id="fecha_ingreso_paciente"  style="border:none;" readonly="readonly"/>
			</div> 
		</div>
		
		<div style="width:100%;height:20px;display:inline-block;"></div>
		<div class="display-form">
			<div class="editor-label">
				Motivo de Baja:
			</div>
			<div class="editor-field">
				<textarea name="motivo_baja" id="motivo_baja" style="width:800px;" required></textarea>
			</div> 
		</div>
		<div style="width:100%;height:20px;display:inline-block;"></div>
		<div style="text-align:center;">
			<input type="button" class="button" id="btnEliminarPaciente" value="Eliminar">
		</div>
	</fieldset>
	</form>
	
			
<?php include("footer.php"); ?>
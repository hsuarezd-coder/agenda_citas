<?php include("header.php"); ?>	
		
<h2>Registrar Paciente</h2>
<script src="js/jquery.validate.min.js"></script>
<script src="js/additional-methods.min.js"></script>
	<script>	
	
	$(document).ready(function(){
		var form = $( "#formulario" );
		/*form.validate();*/
		

		$( "#fecha_nacimiento_paciente" ).datepicker({ dateFormat: 'yy-mm-dd',changeYear: true, yearRange:'-90:+0'});
		$( "#fum" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#fecha_nacimiento_madre" ).datepicker({ dateFormat: 'yy-mm-dd',changeYear: true, yearRange:'-90:+0' });
		$( "#fecha_ingreso_paciente" ).datepicker({ dateFormat: 'yy-mm-dd',changeYear: true, yearRange:'-90:+0' });
		
		$.getJSON('servicios/consultaEntidadesFederativas.php', function(data) {
			$("#entidades_federativas").html("");
			$("#entidades_federativas").append('<option value="0">Selecciona una Entidad Federativa</option>');			
			for(var i = 0; i < data.length; i++) { 					
				$("#entidades_federativas").append('<option value="'+data[i].clave_entidad_federativa+'">'+data[i].nombre+'</option>');
			}
		});
		
		$('#entidades_federativas').on('change', function(){				
			var valor=$("#entidades_federativas").val();
			$("#municipios").html("");
			$("#municipios").append('<option value="0">Selecciona un Municipio</option>');			
			$.getJSON('servicios/consultaMunicipiosPorEF.php?clave_entidad_federativa='+valor, function(data) {			
				for(var i = 0; i < data.length; i++) { 					
					$("#municipios").append('<option value="'+data[i].clave_municipio+'">'+data[i].nombre+'</option>');
				}
			});
		});
		
		

		$('#btnRegistrarPaciente').on('click', function(){										
			if(!form.valid()){
				$('html,body').scrollTop(0);
				mostrarMensajePreventivo("Favor de Capturar los campos requeridos.",5);
				return;
			}
			var url="servicios/registrarPaciente.php?codigo_paciente="+$("#codigo_paciente").val();
			url=url+"&nombre_paciente="+$("#nombre_paciente").val();
			url=url+"&apellido_paterno_paciente="+$("#apellido_paterno_paciente").val();
			url=url+"&apellido_materno_paciente="+$("#apellido_materno_paciente").val();
			url=url+"&fecha_nacimiento_paciente="+$("#fecha_nacimiento_paciente").val();
			url=url+"&nombre_padre_paciente="+$("#nombre_padre_paciente").val();
			url=url+"&nombre_madre_paciente="+$("#nombre_madre_paciente").val();
			url=url+"&direccion_paciente="+$("#direccion_paciente").val();
			url=url+"&colonia_paciente="+$("#colonia_paciente").val();
			url=url+"&entidad_federativa_paciente="+$("#entidades_federativas option:selected").val();	
			url=url+"&municipio_paciente="+$("#municipios option:selected").val();	
			//url=url+"&municipio_paciente="+$("#municipios option:selected").text();	
			url=url+"&cp_paciente="+$("#cp_paciente").val();
			url=url+"&instituto_procedencia_paciente="+$("#instituto_procedencia_paciente").val();
			url=url+"&telefono_paciente="+$("#telefono_paciente").val();
			url=url+"&semanas_gestacion="+$("#semanas_gestacion").val();
			url=url+"&sexo_paciente="+$("#sexo_paciente").val();
			url=url+"&celular_paciente="+$("#celular_paciente").val();
			url=url+"&peso_paciente="+$("#peso_paciente").val();
			url=url+"&talla_paciente="+$("#talla_paciente").val();
			url=url+"&fum="+$("#fum").val();
			url=url+"&fecha_nacimiento_madre="+$("#fecha_nacimiento_madre").val();
			url=url+"&correo_contacto_paciente="+$("#correo_contacto_paciente").val();
			url=url+"&apgar_paciente="+$("#apgar_paciente").val();
			url=url+"&fecha_ingreso_paciente="+$("#fecha_ingreso_paciente").val();
			url=url+"&protocolo_paciente="+$("#protocolo_paciente").val();
			url=url+"&escolaridad_materna="+$("#escolaridad_materna").val();
			url=url+"&escolaridad_paterna="+$("#escolaridad_paterna").val();
			url=url+"&nivel_socioeconomico="+$("#nivel_socioeconomico").val();
			url=url+"&ocupacion_materna="+$("#ocupacion_materna").val();
			url=url+"&ocupacion_paterna="+$("#ocupacion_paterna").val();
			url=url+"&seguridad_social="+$("#seguridad_social").val();
			url=url+"&numero_integrantes="+$("#numero_integrantes").val();
			
			$.getJSON(url, function(data) {	
				$('html,body').scrollTop(0);
				if(data[0].resultado=="1"){					
					mostrarMensajeOK("Se registró correctamente el paciente",5,"principal.php");
					//location.reload();
				}else{
					 mostrarMensajeError("Hubo un error al registrar, favor de contactar al administrador",5);
				}
			});
		});	
	});
	</script>
	<style>
		
		
		
		

	</style>
	<form id="formulario">
	<fieldset class="contenedorFormulario">
        <legend>Datos del Paciente</legend>
		<div class="display-form">
			<div class="editor-label">
				Código:
			</div>
			<div class="editor-field">
				<input type="text" name="codigo_paciente" id="codigo_paciente" />				
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Nombre:
			</div>
			<div class="editor-field">
				<input type="text" name="nombre_paciente" id="nombre_paciente" required/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Apellido Paterno:
			</div>
			<div class="editor-field">
				<input type="text" name="apellido_paterno_paciente" id="apellido_paterno_paciente" required/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Apellido Materno:
			</div>
			<div class="editor-field">
				<input type="text" name="apellido_materno_paciente" id="apellido_materno_paciente" required/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Fecha de Nacimiento:
			</div>
			<div class="editor-field">
				<input type="text" id="fecha_nacimiento_paciente" required>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Semanas de Gestación:
			</div>
			<div class="editor-field">
				<input type="text" name="semanas_gestacion" id="semanas_gestacion" required/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Sexo:
			</div>
			<div class="editor-field">
				<select id="sexo_paciente" class="mitad" required>
					<option value="">Selecciona una Sexo</option>
					<option value="M">Masculino</option>
					<option value="F">Femenino</option>
				</select>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Fecha de Ingreso:
			</div>
			<div class="editor-field">
				<input type="text" id="fecha_ingreso_paciente" required>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Nombre del Padre:
			</div>
			<div class="editor-field">
				<input type="text" name="nombre_padre_paciente" id="nombre_padre_paciente"/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Nombre de la Madre:
			</div>
			<div class="editor-field">
				<input type="text" name="nombre_madre_paciente" id="nombre_madre_paciente" required/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Fecha de Nacimineto de la Madre:
			</div>
			<div class="editor-field">
				<input type="text" id="fecha_nacimiento_madre" required>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Dirección:
			</div>
			<div class="editor-field">
				<input type="text" name="direccion_paciente" id="direccion_paciente"/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Colonia:
			</div>
			<div class="editor-field">
				<input type="text" name="colonia_paciente" id="colonia_paciente"/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Entidad Federativa:
			</div>
			<div class="editor-field">
				<select id="entidades_federativas" required>
					<option value="0">Selecciona una Entidad Federativa</option>
				 </select>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Municipio:
			</div>
			<div class="editor-field">
				 <select id="municipios" required>
					<option value="0">Selecciona un Municipio</option>
				 </select>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Código Postal:
			</div>
			<div class="editor-field">
				<input type="text" name="cp_paciente" id="cp_paciente"/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Teléfono Fijo:
			</div>
			<div class="editor-field">
				<input type="text" name="telefono_paciente" id="telefono_paciente" required/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Teléfono Movil:
			</div>
			<div class="editor-field">
				<input type="text" name="celular_paciente" id="celular_paciente" required/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Instituto de Procedencia:
			</div>
			<div class="editor-field">
				<input type="text" name="instituto_procedencia_paciente" id="instituto_procedencia_paciente"/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				F U M:
			</div>
			<div class="editor-field">
				<input type="text" id="fum" required/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Correo Electrónico:
			</div>
			<div class="editor-field">
				<input type="text" name="correo_contacto_paciente" id="correo_contacto_paciente"/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				A P G A R:
			</div>
			<div class="editor-field">
				<input type="text" name="apgar_paciente" id="apgar_paciente" required/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Peso:
			</div>
			<div class="editor-field">
				<input type="text" name="peso_paciente" id="peso_paciente" required/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Talla:
			</div>
			<div class="editor-field">
				<input type="text" name="talla_paciente" id="talla_paciente" required/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Tipo de Protocólo:
			</div>
			<div class="editor-field">
				<input type="text" name="protocolo_paciente" id="protocolo_paciente" required/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Escolaridad Materna:
			</div>
			<div class="editor-field">
				<input type="text" name="escolaridad_materna" id="escolaridad_materna" required/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Escolaridad Paterna:
			</div>
			<div class="editor-field">
				<input type="text" name="escolaridad_paterna" id="escolaridad_paterna" required/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Nivel Socieconómico:
			</div>
			<div class="editor-field">
				<input type="text" name="nivel_socioeconomico" id="nivel_socioeconomico" required/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Ocupación Materna:
			</div>
			<div class="editor-field">
				<input type="text" name="ocupacion_materna" id="ocupacion_materna" required/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Ocupación Paterna:
			</div>
			<div class="editor-field">
				<input type="text" name="ocupacion_paterna" id="ocupacion_paterna" required/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Seguridad Social:
			</div>
			<div class="editor-field">
				<input type="text" name="seguridad_social" id="seguridad_social" required/>
			</div> 
		</div>
		<div class="display-form">
			<div class="editor-label">
				Número de Integrantes:
			</div>
			<div class="editor-field">
				<input type="text" name="numero_integrantes" id="numero_integrantes" required/>
			</div> 
		</div>
		<div style="width:100%;height:20px;display:inline-block;"></div>
		<div style="text-align:center;">
			<input type="button" class="button" id="btnRegistrarPaciente" value="Registrar">
		</div>
	</fieldset>
	</form>
	
			
<?php include("footer.php"); ?>
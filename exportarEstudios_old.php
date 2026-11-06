<?php include("header.php"); ?>	

<script src="js/jquery.validate.min.js"></script>
<script src="js/additional-methods.min.js"></script>

	<script>
	$(document).ready(function(){
		
	/*	$.getJSON('servicios/consultarEstudios.php', function(data) {
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
		
		$('#btnBuscarEstudio').on('click', function(){			
			var form = $( "#formulario" );
			if(!form.valid()){
				$('html,body').scrollTop(0);
				mostrarMensajePreventivo("Favor de Capturar los campos requeridos.",5);
				return;
			}else{
				$.getJSON('servicios/'+$("#estudios").val(), function(data) {
					$("#resultadoResonancias").html("");
					var cadena="";
					for(var i = 0; i < data.length; i++) { 	
						cadena="";				
						cadena=cadena +"<tr>";
						cadena=cadena +"<td>"+data[i].nombre_paciente+" "+data[i].apellido_paterno_paciente+" "+data[i].apellido_materno_paciente+"</td>";
						cadena=cadena +"<td>"+data[i].fecha_nacimiento_paciente+"</td>";
						cadena=cadena +"<td>"+data[i].fecha_registro+"</td>";
						cadena=cadena +"<td>"+data[i].fecha_estudio+"</td>";
						cadena=cadena +"<td>"+data[i].semanas_gestacion+"</td>";
						cadena=cadena +"<td>"+data[i].numero_estudio+"</td>";
						cadena=cadena +"<td>"+data[i].id_equipo+"</td>";
						cadena=cadena +"<td>"+data[i].cc+"</td>";
						cadena=cadena +"<td>"+data[i].vld+"</td>";
						cadena=cadena +"<td>"+data[i].vli+"</td>";
						cadena=cadena +"<td>"+data[i].esa+"</td>";
						cadena=cadena +"<td>"+data[i].observaciones+"</td>";
						cadena=cadena +"</tr>";
						$("#resultadoResonancias").append(cadena);
					//	$("#estados").append('<option value="'+data[i].clave_estado_cita+'">'+data[i].descripcion_estado_cita+'</option>');
					}
				});				
			}
		});	

 $("#btnExport").click(function(e) {
			e.preventDefault();

			//getting data from our table
			var data_type = 'data:application/vnd.ms-excel; charset=iso-8859-1';
			var table_div = document.getElementById('table_wrapper');
			var table_html = table_div.outerHTML.replace(/ /g, '%20');

			var a = document.createElement('a');
			a.href = data_type + ', ' + table_html;
			a.download = 'Resonancia Magnetica.xls';
			a.click();
		  });		
			
	});
	</script>
	<h2>Exportar Información de Estudios</h2>
		<fieldset>
			
				<form id="formulario">
				<div class="display-form">
					<div class="editor-label">
						Nombre del Estudio:
					</div>
					<div class="editor-field">
						<select id="estudios" name="estudios" class="mitad" required>
							
							<option value="consultarResonanciaMagnetica.php">Resonancia Magnética</option>							
						</select>
					</div> 
				</div>
				
				<div class="display-form">
					<div class="editor-label">	
						&nbsp;
					</div>
					<div class="editor-field">
						<input type="button" value="" class="buscar vertical" id="btnBuscarEstudio"/>
					</div> 					
				</div>	
				</form>
			<div style="width:100%;height:20px;display:inline-block;"></div>	
			<button id="btnExport">Exportar a Excel</button>
				<div style="width:100%;height:20px;display:inline-block;"></div>
			<!--style>
				.wmd-view-topscroll, .wmd-view {
					overflow-x: scroll;
					overflow-y: hidden;
					width: 900px;
					border: none 0px RED;
				}

				.wmd-view-topscroll { height: 20px; }
				
				.scroll-div1 { 
					width: 2000px; 
					overflow-x: scroll;
					overflow-y: hidden;
				}
				.scroll-div2 { 
					width: 2000px; 
					height:20px;
				}
				
				.scroll-div2 table{
					width: 2000px;
				}
			</style>
			<script>
				$(function(){
					$(".wmd-view-topscroll").scroll(function(){
						$(".wmd-view")
							.scrollLeft($(".wmd-view-topscroll").scrollLeft());
					});
					$(".wmd-view").scroll(function(){
						$(".wmd-view-topscroll")
							.scrollLeft($(".wmd-view").scrollLeft());
					});
				});
			</script>
			<div class="wmd-view-topscroll">
				<div class="scroll-div1">
				</div>
			</div>
			<div class="wmd-view">
				<div class="scroll-div2"-->
			<div id="table_wrapper">
				<table>
					<thead>
						<tr>
							<th>Paciente</th>
							<th>Fecha de Nacimiento</th>
							<th>Fecha de Registro</th>
							<th>Fecha de Estudio</th>												
							<th>Semanas de Gestación</th>
							<th>Número de Estudio</th> 	 
							<th>Equipo</th>  
							<th>Cuerpo calloso</th>  
							<th>Ventrículo lateral derecho</th>  
							<th>Ventrículo lateral izquierdo</th>  
							<th>Espacio subaracnoideo dimensiones</th>  							
							<th>Observaciones Generales</th>  							
						</tr>
					</thead>
					<tbody id="resultadoResonancias">
										 
					</tbody>
				</table>
			</div>
				<!--/div>
			</div-->				
		</fieldset>    
        				
<?php include("footer.php"); ?>
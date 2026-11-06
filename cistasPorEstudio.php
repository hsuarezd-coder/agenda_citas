<?php include("header.php"); ?>	

<script src="js/jquery.validate.min.js"></script>
<script src="js/additional-methods.min.js"></script>

<script type="text/javascript" src="js/jquery.jqplot.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.jqplot.css" />	
<script language="javascript" type="text/javascript" src="js/plugins/jqplot.categoryAxisRenderer.js"></script>
<script language="javascript" type="text/javascript" src="js/plugins/jqplot.barRenderer.js"></script>	
<script type="text/javascript" src="js/plugins/jqplot.cursor.js"></script>
<script type="text/javascript" src="js/plugins/jqplot.pointLabels.js"></script>
<script type="text/javascript" src="js/plugins/jqplot.dateAxisRenderer.js"></script>
<script type="text/javascript" src="js/plugins/jqplot.canvasTextRenderer.js"></script>
<script type="text/javascript" src="js/plugins/jqplot.canvasAxisTickRenderer.js"></script>


	
	

	<script>
	$(document).ready(function(){
		$( "#fecha_inicio" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#fecha_fin" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$.getJSON('servicios/consultarEstadosCitaTodos.php', function(data) {
			$("#estados").html("");	
			$("#estados").append('<option value="0" selected="selected">TODOS</option>');
			for(var i = 0; i < data.length; i++) { 					
				$("#estados").append('<option value="'+data[i].clave_estado_cita+'">'+data[i].descripcion_estado_cita+'</option>');
			}
		});
		
		
		$('#btnBuscarCitasPorEstudio').on('click', function(){			
			var form = $( "#formulario" );
			if(!form.valid()){
				$('html,body').scrollTop(0);
				mostrarMensajePreventivo("Favor de Capturar los campos requeridos.",5);
				return;
			}			
			
			var ret=null;
			var fecha_inicio=$("#fecha_inicio").val();			
			var fecha_fin=$("#fecha_fin").val();
			$.ajax({            
				async: false,
				url: 'graficas/citasPorEstudio.php?fecha_inicio='+fecha_inicio+'&fecha_fin='+fecha_fin+"&estado="+$("#estados").val(),
				dataType: "json",
				success: function (data) {
					ret = data;
				}
			});
			
		
			var estudios=[];
			var mayor=0;
			for(var i = 0; i < ret.length; i++) { 	
				estudios.push([ret[i].nombre_estudio,parseInt(ret[i].Cantidad)]);
				if(parseInt(ret[i].Cantidad)>mayor){
					mayor=parseInt(ret[i].Cantidad)*1.1;
				}
			}
			
			$("#chart1").html("");
 
		
			$('#chart1').jqplot([estudios], {
				title:'Citas por Estudio',
				seriesDefaults:{
					renderer:$.jqplot.BarRenderer,
					rendererOptions: {
						// Set the varyBarColor option to true to use different colors for each bar.
						// The default series colors are used.
						varyBarColor: true,
						showDataLabels: true
					},					 
					pointLabels: { show: true }
				},	
				axesDefaults: {
						tickRenderer: $.jqplot.CanvasAxisTickRenderer,
						tickOptions: {
						  angle: -90
						}
					},				
				axes:{
					xaxis:{
						renderer: $.jqplot.CategoryAxisRenderer
					},
					yaxis: {
						tickOptions: {
							formatString: '%d'
						},
						max: mayor,
						min: 0
					}
				},
				cursor:{
					show: true,
					zoom: true
				} 
			});
			
			
			
			 
		});
		
		
		
		
		
	});
	

	</script>
	<h2>Citas por Estudio</h2>
		<fieldset>
			<legend>Buscar</legend>
				<form id="formulario">
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
						Fecha Inicio Cita:
					</div>
					<div class="editor-field">
						<input type="text" id="fecha_inicio" name="fecha_inicio" required>
					</div> 
				</div>
				<div class="display-form">
					<div class="editor-label">
						Fecha Fin Cita:
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
						<input type="button" value="" class="grafica vertical" id="btnBuscarCitasPorEstudio"/>
					</div> 					
				</div>	
				</form>
			<div style="width:100%;height:20px;display:inline-block;"></div>	
			
			<div id="chart1" style="height:800px; width:950px;"></div>
				
</div>			
		</fieldset>   


        				
<?php include("footer.php"); ?>
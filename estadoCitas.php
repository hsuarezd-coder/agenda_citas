<?php include("header.php"); ?>	

<script src="js/jquery.validate.min.js"></script>
<script src="js/additional-methods.min.js"></script>

 <link class="include" rel="stylesheet" type="text/css" href="css/jquery.jqplot.css" />
 <script class="include" type="text/javascript" src="js/jquery.jqplot.js"></script>
  <script class="include" type="text/javascript" src="js/plugins/jqplot.pieRenderer.js"></script>

  <style>
	table {
    width: 100px;
}
  </style>
  

	
	

	<script>
	$(document).ready(function(){
			$( "#fecha_inicio" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#fecha_fin" ).datepicker({ dateFormat: 'yy-mm-dd' });
		
		
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
				url: 'graficas/estadoCitas.php?fecha_inicio='+fecha_inicio+'&fecha_fin='+fecha_fin,
				dataType: "json",
				success: function (data) {
					ret = data;
				}
			});
			
		
			var estudios=[];
			
			for(var i = 0; i < ret.length; i++) { 	
				estudios.push([ret[i].nombre,parseInt(ret[i].cantidad)]);
			}			 
			$("#chart1").html("");
			 plot1 = $.jqplot('chart1',[estudios],{
				title: 'Citas por Estudio',
				seriesDefaults:{
					renderer: $.jqplot.PieRenderer,
					rendererOptions: {
						 showDataLabels: true
					},
					shadow: true,
					shadowAlpha: 0.05
				},
				legend:{
					show:true					
				}  
			}); 
			
			 
		});
		
		
	
   
		
	});
	

	</script>
	<h2>Citas por Estado</h2>
		<fieldset>
			<legend>Buscar</legend>
				<form id="formulario">
				
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
			
			  <div id="chart1" style="margin-top:20px; margin-left:20px; width:660px; height:400px;"></div>
    <pre class="code brush:js"></pre>
	
	<div id="load"></div>				
</div>			
		</fieldset>   


        				
<?php include("footer.php"); ?>
<?php include("header.php"); ?>	

<?php

include 'conexion.php';
$clave_paciente=$_GET['clave_paciente'];
$nombre_paciente=$_GET['nombre_paciente'];
 ?>		
	<?php		
		echo '<h2 style="text-align:center;">Consulta de Citas para el paciente:  </br>'.$nombre_paciente.'</h2>';
	?>
	
	<script>
	
	</script>
	
	<?php 
	if (!$db_selected) {
		die ('No se puede seleccionar la base de datos : ' . mysql_error());
	}else{
		
		mysql_query('SET NAMES utf8;');
	?>
	<fieldset class="contenedorFormulario">
        <legend>Datos del Paciente</legend>
		
		<?php
			$sql = "SELECT p.*,ep.descripcion_estado_paciente 
			from paciente p inner join estado_paciente ep on p.clave_estado_paciente=ep.clave_estado_paciente 
			where p.clave_paciente=$clave_paciente";
			$retorno = mysql_query( $sql, $conn );
			if($row=mysql_fetch_array($retorno, MYSQL_ASSOC)) {
				echo 'Fecha de Nacimiento: '.$row["fecha_nacimiento_paciente"].'<br>';
				echo 'Semanas de Gestación: '.$row["semanas_gestacion"].'<br>';
				echo 'Nombre de la Madre: '.$row["nombre_madre_paciente"].'<br>';
				echo 'Nombre del Padre: '.$row["nombre_padre_paciente"].'<br>';
				echo 'Estado Actual: '.$row["descripcion_estado_paciente"].'<br>';
				echo 'Dirección: '.$row["direccion_paciente"].', '.$row["colonia_paciente"].'<br>';				
				echo 'Teléfono: '.$row["telefono_paciente"].', Celular: '.$row["celular_paciente"].'<br>';
				if($row["correo_contacto_paciente"]!=''){
					echo 'Correo: '.$row["correo_contacto_paciente"].'<a href="mailto:'.$row["correo_contacto_paciente"].'"> Enviar correo</a><br>';
				}
			}
		?>
		
	</fieldset>
	<fieldset class="contenedorFormulario">
        <legend>Citas del Paciente</legend>
			<table>
				<thead>
					<tr>						
						<th>Estudio</th>
						<th>Fecha Cita</th>
						<th>Estado Cita</th>  
						<th>Hora Cita</th>  
						<th>Personal</th>  	
						<th>Observaciones</th>  							
						<th></th>  						
					</tr>
				</thead>
				<tbody id="resultado">
					<?php
					
					
						$sql = "SELECT c.*,concat(p.nombre_paciente,' ',p.apellido_paterno_paciente,' ',p.apellido_materno_paciente) as paciente,
								e.nombre_estudio,c.fecha_cita,ec.descripcion_estado_cita,h.hora,
								concat(per.nombre_personal,' ',per.apellido_paterno_personal,' ',per.apellido_materno_personal) as personal,c.extension
								FROM cita c
								inner join paciente p on c.clave_paciente=p.clave_paciente
								inner join estudio e on c.clave_estudio=e.clave_estudio
								inner join estado_cita ec on c.clave_estado_cita=ec.clave_estado_cita
								inner join horario_cita hc on c.clave_horario_cita=hc.clave_horario_cita
								inner join horario h on hc.clave_horario=h.clave_horario
								inner join personal per on c.clave_personal=per.clave_personal
								where p.clave_paciente=$clave_paciente";
								
						if (isset($_SESSION['clave_personal'])) {
							$clave_personal=$_SESSION['clave_personal'];
							$sql=$sql." and c.clave_estudio in (select e1.clave_estudio from estudio e1
									inner join estudio_equipo ee1 on e1.clave_estudio=ee1.clave_estudio
									inner join operador_equipo oe1 on ee1.clave_equipo=oe1.clave_equipo
									where e1.estado_estudio='AC' and oe1.clave_personal=$clave_personal) ";
						}								
						$sql=$sql." order by c.fecha_cita";
											
						$retorno = mysql_query( $sql, $conn );
						while($row=mysql_fetch_array($retorno, MYSQL_ASSOC)) {
							echo '<tr>';
							echo '<td>'.$row["nombre_estudio"].'</td>';
							echo '<td>'.$row["fecha_cita"].'</td>';
							echo '<td>'.$row["descripcion_estado_cita"].'</td>';
							echo '<td>'.$row["hora"].'</td>';
							echo '<td>'.$row["personal"].'</td>';
							echo '<td>'.$row["observacion"].'</td>';
							if(($row["clave_estado_cita"]=="6" || $row["clave_estado_cita"]=="3") && $row["reporte"]==1){
								echo '<td><a href="uploads/'.$row["clave_cita"].'.'.$row["extension"].'" target="_blank"><img src="images/'.$row["extension"].'.png"></a></td>';
							}else if($row["clave_estado_cita"]=="6" || $row["clave_estado_cita"]=="3"){
								echo '<td><a href="#" onclick="abrirAdjuntarReporte('.$row["clave_cita"].')"><img src="images/icono_word_add.png"></a></td>';
							}else{
								echo '<td></td>';
							}
							echo '</tr>';
						}
					?>					
				</tbody>
			</table>
	</fieldset>
	<script>
  $(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 1000
      },
	  modal: true,
	  height: 200,
      width: 350,
      hide: {
        effect: "explode",
        duration: 1000
      }
    });
    
  });
  
  function abrirAdjuntarReporte(cita){
	  $("#id_cita").val(cita);
      $( "#dialog" ).dialog( "open" );
    }
	
	function adjuntarReporte(){		
		var archivo=document.getElementById("reporte").value;
		var extensiones_permitidas = new Array(".docx",".doc",".pdf"); 
		var extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase(); 
		var permitida=false;
		for (var i = 0; i < extensiones_permitidas.length; i++) { 
			if (extensiones_permitidas[i] == extension) { 
				permitida = true; 									
				break; 
			} 
		}
		if(!permitida){
			$('html,body').scrollTop(0);	
			mostrarMensajeError("El tipo de archivo no esta permitido. Debe ser extensión .docx, .doc o .pdf",5);
			return;
		}
		var m_data = new FormData(); 
		m_data.append( 'reporte', $('input[name=reporte]')[0].files[0]);
		m_data.append( 'nombre_archivo', $("#id_cita").val());
		$.ajax({
			url: 'subirArchivo.php',
			data: m_data,
			contentType: false,
			processData: false,
			type: 'POST',
			dataType:'json',
			success: function(data){
				if(data.id==="1"){							
					$.getJSON('servicios/asistirCitaReporte.php?clave_cita='+$("#id_cita").val()+'&reporte=1&extension='+data.extension, function(data) {
						$( "#dialog" ).dialog( "open" );
						$('html,body').scrollTop(0);							
						mostrarMensajeOK("Se actualizó correctamente la cita",5,"refresh");
						$( "#dialog" ).dialog( "close" );
					});									
				}else{
					$( "#dialog" ).dialog( "open" );
					$('html,body').scrollTop(0);
					mostrarMensajeError("Hubo un error al actualizar la cita",5);
				}	
					
			},
			error:function (err){
				$( "#dialog" ).dialog( "open" );
				$('html,body').scrollTop(0);
				mostrarMensajeError("Hubo un error al actualizar la cita...",5);
			}
		});
	}
  </script>
	<div id="dialog" title="Adjuntar reporte">
	  <p>Adjuntar el archivo con extensión docx, doc o pdf</p>
	  <input type="hidden" id="id_cita">
	  <input type="file" name="reporte" id="reporte"><br><br>
	  <input type="button" onclick="adjuntarReporte()" value="Aceptar">
	</div>	
	<?php
	}
	
	mysql_close($conn);
	?>
	
			
<?php include("footer.php"); ?>

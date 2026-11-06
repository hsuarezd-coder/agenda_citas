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
				if($row["clave_estado_paciente"]=='3'){
					echo 'Motivo Baja: '.$row["motivo_baja"].'<br>';
				}

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
								concat(per.nombre_personal,' ',per.apellido_paterno_personal,' ',per.apellido_materno_personal) as personal
								FROM cita c
								inner join paciente p on c.clave_paciente=p.clave_paciente
								inner join estudio e on c.clave_estudio=e.clave_estudio
								inner join estado_cita ec on c.clave_estado_cita=ec.clave_estado_cita
								inner join horario_cita hc on c.clave_horario_cita=hc.clave_horario_cita
								inner join horario h on hc.clave_horario=h.clave_horario
								inner join personal per on c.clave_personal=per.clave_personal
								where p.clave_paciente=$clave_paciente";
								
						/*if (isset($_SESSION['clave_personal'])) {
							$clave_personal=$_SESSION['clave_personal'];
							$sql=$sql." and c.clave_estudio in (select e1.clave_estudio from estudio e1
									inner join estudio_equipo ee1 on e1.clave_estudio=ee1.clave_estudio
									inner join operador_equipo oe1 on ee1.clave_equipo=oe1.clave_equipo
									where e1.estado_estudio='AC' and oe1.clave_personal=$clave_personal) ";
						}*/								
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
							}else{
								echo '<td></td>';
							}
							echo '</tr>';
						}
					?>					
				</tbody>
			</table>
	</fieldset>
	<?php
	}
	
	mysql_close($conn);
	?>
	
			
<?php include("footer.php"); ?>

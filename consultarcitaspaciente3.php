<?php include("header.php"); ?>	
	
	<h2>Buscar Citas por Paciente</h2>
		<fieldset>
			<legend>Buscar Paciente</legend>			       
				<p>
					Nombre o Apellidos del Paciente:
					<input type="text" name="paciente" id="paciente" value=""/>
					<input type="button" value="" class="buscar vertical" id="btnBuscarPacienteCC2"/>
				</p>			
			<table>
				<thead>
					<tr>
						<th>Codigo</th>
						<th>Nombre</th>
						<th>Apellido Paterno</th>
						<th>Apellido Materno</th>  
						<th></th>
					</tr>
				</thead>
				<tbody id="resultado">
									 
				</tbody>
			</table>			
		</fieldset>    
        				
<?php include("footer.php"); ?>
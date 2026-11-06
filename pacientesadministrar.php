<?php include("header.php"); ?>	
	
	<h2>Administración de Pacientes</h2>
		<fieldset>
			<legend>Buscar Paciente</legend>			       
				<p>
					Nombre o Apellidos del Paciente:
					<input type="text" name="paciente" id="paciente" value=""/>
					<input type="button" value="" class="buscar vertical" id="btnBuscarPacienteAdmP"/>
					<a href="#" class="buscar vertical" id="btnBuscarPacienteAdmP"></a>
					<a href="pacienteregistrar.php" class="agregar vertical" id="btnAgregarPaciente"></a>
				</p>			
			<table>
				<thead>
					<tr>
						<th>Codigo</th>
						<th>Nombre</th>
						<th>Apellido Paterno</th>
						<th>Apellido Materno</th>  	
						<th>Estado</th>
						<th style="width:160px;"></th>
					</tr>
				</thead>
				<tbody id="resultado">
									 
				</tbody>
			</table>			
		</fieldset>    
        				
<?php include("footer.php"); ?>
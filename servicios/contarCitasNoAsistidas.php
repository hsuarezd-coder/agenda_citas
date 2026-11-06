<?php
session_start();

include '../conexion.php';

if (!$db_selected) {
    die ('No se puede seleccionar la base de datos : ' . mysql_error());
}else{
	$var = array();
	mysql_query('SET NAMES utf8;');
	$palabra=$_GET['palabra'];
	$sql = "SELECT 
			  paciente.codigo_paciente,
			  paciente.clave_paciente,
			  paciente.nombre_paciente,
			  paciente.apellido_paterno_paciente,
			  paciente.apellido_materno_paciente,
			  count(*) as total
			FROM
			  cita
			  INNER JOIN  paciente ON (paciente.clave_paciente = cita.clave_paciente)
			  
			WHERE 
			  cita.clave_estado_cita = 5 and paciente.clave_paciente not in (876,912,976,986) and
			  (nombre_paciente like '%$palabra%' or apellido_paterno_paciente like '%$palabra%' 
				or apellido_materno_paciente like '%$palabra%' 
				or concat(nombre_paciente,' ',apellido_paterno_paciente,' ',apellido_materno_paciente) like '%$palabra%'
				or concat(apellido_paterno_paciente,' ',apellido_materno_paciente,' ',nombre_paciente) like '%$palabra%')
			  group by  paciente.codigo_paciente,
			  paciente.clave_paciente,
			  paciente.nombre_paciente,
			  paciente.apellido_paterno_paciente,
			  paciente.apellido_materno_paciente";
	$retorno = mysql_query( $sql, $conn );
	while($row=mysql_fetch_array($retorno, MYSQL_ASSOC)) {
		$var[] = $row;
	}
	mysql_close($conn);
	echo json_encode($var);
}
?>
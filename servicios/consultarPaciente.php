<?php
session_start();

include '../conexion.php';

if (!$db_selected) {
    die ('No se puede seleccionar la base de datos : ' . mysql_error());
}else{
	$var = array();
	mysql_query('SET NAMES utf8;');
	$palabra=$_GET['palabra'];
	$sql = "SELECT p.*,ep.descripcion_estado_paciente,(select count(*) from cita c where c.clave_paciente=p.clave_paciente and c.clave_estado_cita=5 ) as faltas
	FROM paciente p inner join estado_paciente ep on p.clave_estado_paciente=ep.clave_estado_paciente 
	where nombre_paciente like '%$palabra%' or apellido_paterno_paciente like '%$palabra%' 
	or apellido_materno_paciente like '%$palabra%' 
	or concat(nombre_paciente,' ',apellido_paterno_paciente,' ',apellido_materno_paciente) like '%$palabra%'
	or concat(apellido_paterno_paciente,' ',apellido_materno_paciente,' ',nombre_paciente) like '%$palabra%'
	and p.clave_estado_paciente in (1,2)
	order by apellido_paterno_paciente,apellido_materno_paciente,nombre_paciente asc";
	$retorno = mysql_query( $sql, $conn );
	while($row=mysql_fetch_array($retorno, MYSQL_ASSOC)) {
		$var[] = $row;
	}
	mysql_close($conn);
	echo json_encode($var);
}
?>
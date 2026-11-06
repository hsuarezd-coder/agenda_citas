<?php
session_start();

include '../conexion.php';

if (!$db_selected) {
    die ('No se puede seleccionar la base de datos : ' . mysql_error());
}else{
	$var = array();
	mysql_query('SET NAMES utf8;');
	$clave_paciente=$_GET['clave_paciente'];
	$sql = "select estudio.nombre_estudio,personal.nombre_personal,personal.apellido_paterno_personal,personal.apellido_materno_personal,cita.fecha_cita from cita
		inner join estudio on cita.clave_estudio=estudio.clave_estudio
		inner join personal on cita.clave_personal=personal.clave_personal
		where  cita.clave_estado_cita = 5 and cita.clave_paciente not in (876,912,976,986)
		and cita.clave_paciente=$clave_paciente order by cita.fecha_cita asc";
	$retorno = mysql_query( $sql, $conn );
	while($row=mysql_fetch_array($retorno, MYSQL_ASSOC)) {
		$var[] = $row;
	}
	mysql_close($conn);
	echo json_encode($var);
}
?>
<?php
session_start();

include '../conexion.php';

if (!$db_selected) {
    die ('No se puede seleccionar la base de datos : ' . mysql_error());
}else{
	$var = array();
	mysql_query('SET NAMES utf8;');
	$fecha_inicio=$_GET['fecha_inicio'];
		$fecha_fin=$_GET['fecha_fin'];
	$sql = "SELECT *,case clave_estado_paciente when 1 then 'Activo' when 2 then 'Inacivo' when 3 then 'Baja' else 'Defunsión' end estado from paciente where fecha_registro>='$fecha_inicio' and fecha_registro<='$fecha_fin'
	order by apellido_paterno_paciente,apellido_materno_paciente,nombre_paciente asc";
	$retorno = mysql_query( $sql, $conn );
	while($row=mysql_fetch_array($retorno, MYSQL_ASSOC)) {
		$var[] = $row;
	}
	echo json_encode($var);
}
?>
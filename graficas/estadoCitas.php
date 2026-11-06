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
	
	$sql = "select ec.descripcion_estado_cita as nombre,count(*) as cantidad from cita c
			inner join estado_cita ec
			on c.clave_estado_cita=ec.clave_estado_cita
			where c.fecha_cita between '$fecha_inicio' and '$fecha_fin'
			group by c.clave_estado_cita";
			
			
	
	$retorno = mysql_query( $sql, $conn );
	while($row=mysql_fetch_array($retorno, MYSQL_ASSOC)) {
		$var[] = $row;
	}
	mysql_close($conn);
	echo json_encode($var);
}
?>
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
	$estado=$_GET['estado'];
	
	$sql = "SELECT
			  estudio.clave_estudio,
			  estudio.nombre_estudio,
			  estudio.abreviatura_estudio,
			  COUNT(cita.clave_paciente) AS Cantidad
			FROM
			  estudio
			  INNER JOIN cita ON (estudio.clave_estudio = cita.clave_estudio)
			  INNER JOIN paciente ON (cita.clave_paciente = paciente.clave_paciente)
			WHERE
			cita.fecha_cita between '$fecha_inicio' AND '$fecha_fin' ";		  
	if($estado!=0){
		$sql=$sql." and cita.clave_estado_cita=$estado	";
	}	
			
	$sql=$sql."GROUP BY
			  estudio.clave_estudio,
			  estudio.nombre_estudio,
			  estudio.abreviatura_estudio";
	
	$retorno = mysql_query( $sql, $conn );
	while($row=mysql_fetch_array($retorno, MYSQL_ASSOC)) {
		$var[] = $row;
	}
	mysql_close($conn);
	echo json_encode($var);
}
?>
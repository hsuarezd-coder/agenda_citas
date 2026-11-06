<?php
session_start();

include '../conexion.php';

if (!$db_selected) {
    die ('No se puede seleccionar la base de datos : ' . mysql_error());
}else{
	$var = array();
	mysql_query('SET NAMES utf8;');
	$fecha_inicio=$_GET['anio']."-01-01";
	$fecha_fin=$_GET['anio']."-12-31";	
	$estado=$_GET['estado'];
	$estudio=$_GET['estudio'];
	
	$sql = "SELECT meses.id,
			meses.nombre, ifnull(citas.cantidad,0) cantidad
				FROM meses
				left join
				(select month(fecha_cita) as mes,count(*) as cantidad from cita
				WHERE fecha_cita between '$fecha_inicio' and '$fecha_fin'";
				
			if($estudio!=0){	
				$sql=$sql." and clave_estudio=$estudio";
			}
			if($estado!=0){	
				$sql=$sql." and clave_estado_cita=$estado";
			}
				
				$sql=$sql." group by month(fecha_cita)) citas
				on meses.id=citas.mes
				GROUP BY meses.id";		  
	
	
	$retorno = mysql_query( $sql, $conn );
	while($row=mysql_fetch_array($retorno, MYSQL_ASSOC)) {
		$var[] = $row;
	}
	mysql_close($conn);
	echo json_encode($var);
}
?>
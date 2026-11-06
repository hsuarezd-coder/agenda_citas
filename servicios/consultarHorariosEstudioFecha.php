<?php
session_start();

include '../conexion.php';

if (!$db_selected) {
    die ('No se puede seleccionar la base de datos : ' . mysql_error());
}else{
	$var = array();
	mysql_query('SET NAMES utf8;');
	$clave_estudio=$_GET['clave_estudio'];
	$clave_paciente=$_GET['clave_paciente'];
	$fecha_cita= $_GET['fecha_cita'];
	
	$sql = "SELECT * FROM horario_cita hc 
	        inner join horario h on h.clave_horario=hc.clave_horario
			where hc.clave_estudio=$clave_estudio and hc.estado_horario_cita=1
			and hc.clave_horario not in (select clave_horario from horario_cita where clave_horario_cita in (select clave_horario_cita from cita c where c.clave_estado_cita=1 and (c.clave_estudio=$clave_estudio or c.clave_paciente=$clave_paciente) and c.fecha_cita='$fecha_cita')) 					
			order by h.hora asc";
	$retorno = mysql_query( $sql, $conn );
	while($row=mysql_fetch_array($retorno, MYSQL_ASSOC)) {
		$var[] = $row;
	}	
	mysql_close($conn);
	echo json_encode($var);
}
?>
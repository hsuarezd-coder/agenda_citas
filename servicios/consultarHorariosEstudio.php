<?php
session_start();

include '../conexion.php';

if (!$db_selected) {
    die ('No se puede seleccionar la base de datos : ' . mysql_error());
}else{
	$var = array();
	mysql_query('SET NAMES utf8;');
	$clave_estudio=$_GET['clave_estudio'];
	$sql = "SELECT * FROM horario_cita hc 
	        inner join horario h on h.clave_horario=hc.clave_horario
			where clave_estudio=$clave_estudio and estado_horario_cita=1 order by hora_entrada_horario_cita asc";
	$retorno = mysql_query( $sql, $conn );
	while($row=mysql_fetch_array($retorno, MYSQL_ASSOC)) {
		$var[] = $row;
	}
	mysql_close($conn);
	echo json_encode($var);
}
?>
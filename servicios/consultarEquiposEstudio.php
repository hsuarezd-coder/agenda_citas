<?php
session_start();

include '../conexion.php';

if (!$db_selected) {
    die ('No se puede seleccionar la base de datos : ' . mysql_error());
}else{
	$var = array();
	mysql_query('SET NAMES utf8;');
	$clave_estudio=$_GET['clave_estudio'];
	$sql = "select * from equipo e inner join estudio_equipo ee on e.clave_equipo=ee.clave_equipo 
			where clave_estado_equipo=1 and clave_estudio=$clave_estudio";
	$retorno = mysql_query( $sql, $conn );
	while($row=mysql_fetch_array($retorno, MYSQL_ASSOC)) {
		$var[] = $row;
	}
	mysql_close($conn);
	echo json_encode($var);
}
?>
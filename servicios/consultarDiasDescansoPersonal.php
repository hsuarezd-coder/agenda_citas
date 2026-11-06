<?php

session_start();

include '../conexion.php';

if (!$db_selected) {
    die ('No se puede seleccionar la base de datos : ' . mysql_error());
}else{
	$var = array();
	$personal=$_GET['personal'];
	mysql_query('SET NAMES utf8;');	
	$sql = "SELECT year(fecha) as anio,month(fecha) as mes,day(fecha) as dia FROM dias_descanso_personal where fecha>=now() and clave_personal=$personal";
	$retorno = mysql_query( $sql, $conn );
	while($row=mysql_fetch_array($retorno, MYSQL_ASSOC)) {
		$var[] = $row;
	}
	mysql_close($conn);
	echo json_encode($var);	
				
}
?>
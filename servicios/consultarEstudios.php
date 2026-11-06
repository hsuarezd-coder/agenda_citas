<?php

session_start();

include '../conexion.php';

if (!$db_selected) {
    die ('No se puede seleccionar la base de datos : ' . mysql_error());
}else{
	$var = array();
	mysql_query('SET NAMES utf8;');	
	$numRes=0;
	try {
		$clave_personal=$_SESSION['clave_personal'];
		$sql1="select distinct e.* from estudio e
			inner join estudio_equipo ee on e.clave_estudio=ee.clave_estudio
			inner join operador_equipo oe on ee.clave_equipo=oe.clave_equipo
			where e.estado_estudio='AC' and oe.clave_personal=$clave_personal";
			
		$retorno1 = mysql_query( $sql1, $conn );
		$numRes = mysql_num_rows($retorno1);
	}catch (Exception $e) {
	}
	if($numRes > 0){
		while($row1=mysql_fetch_array($retorno1, MYSQL_ASSOC)) {
			$var[] = $row1;
		}
		echo json_encode($var);
	}else{
		$sql = "SELECT * FROM estudio where estado_estudio='AC' order by nombre_estudio asc";
		$retorno = mysql_query( $sql, $conn );
		while($row=mysql_fetch_array($retorno, MYSQL_ASSOC)) {
			$var[] = $row;
		}
		echo json_encode($var);
	}
	mysql_close($conn);
				
}
?>
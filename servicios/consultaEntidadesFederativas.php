<?php 
	include '../conexion.php';
	
	if (!$db_selected) {
		die ('No se puede seleccionar la base de datos : ' . mysql_error());
	}else{
		$var = array();
		$sql = "SELECT * FROM entidad_federativa";
		mysql_query('SET NAMES utf8;');
		$retorno = mysql_query( $sql, $conn );
		while($row=mysql_fetch_array($retorno, MYSQL_ASSOC)) {			
			$var[] = $row;
		}
		mysql_close($conn);
		echo json_encode($var);
	}
	
?>
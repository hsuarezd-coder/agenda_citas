<?php 
	include '../conexion.php';
	
	if (!$db_selected) {
		die ('No se puede seleccionar la base de datos : ' . mysql_error());
	}else{
		$var = array();
		mysql_query('SET NAMES utf8;');
		$clave_entidad_federativa=$_GET['clave_entidad_federativa'];
		$sql = "SELECT * FROM municipio where clave_entidad_federativa=$clave_entidad_federativa";
		$retorno = mysql_query( $sql, $conn );
		while($row=mysql_fetch_array($retorno, MYSQL_ASSOC)) {			
			$var[] = $row;
		}
		mysql_close($conn);
		echo json_encode($var);
	}
?>
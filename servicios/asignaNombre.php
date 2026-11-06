<?php
session_start();
$usuario=$_SESSION['usuario'];
if (!isset($usuario)) {
	header( 'Location: login.php' ) ;
}
include '../conexion.php';

if (!$db_selected) {
    die ('No se puede seleccionar la base de datos : ' . mysql_error());
}else{
	$clave_cita=$_GET['clave_cita'];	
	$nombre=$_GET['nombre'];
	
	mysql_query('SET NAMES utf8;');
	$sql = "update cita set nombre_primera_vez='$nombre' where clave_cita=$clave_cita";
	header('Content-type: text/json');
	$retval = mysql_query( $sql, $conn );
	if(! $retval )
	{
		echo '[{"resultado": "0"}]'; 
	} else {
		echo '[{"resultado": "1"}]'; 
	}
	mysql_close($conn);
		
}
?>

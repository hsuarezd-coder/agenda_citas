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
	$reporte=$_GET['reporte'];
	$extension=$_GET['extension'];	
	
	mysql_query('SET NAMES utf8;');
	$sql = "update cita set reporte=$reporte,fecha_actualizacion=now(),usuario_actualizacion='$usuario',extension='$extension' where clave_cita=$clave_cita";
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

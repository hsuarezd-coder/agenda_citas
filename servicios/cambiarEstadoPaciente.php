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
	$clave_paciente=$_GET['clave_paciente'];	
	$clave_estado_paciente=$_GET['clave_estado_paciente'];		
	
	
	mysql_query('SET NAMES utf8;');
	$sql = "update paciente set clave_estado_paciente='$clave_estado_paciente',usuario_actualizacion='$usuario',
			fecha_actualizacion=now() where clave_paciente=$clave_paciente";
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
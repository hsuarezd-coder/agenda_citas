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
	$motivo_baja=$_GET['motivo_baja'];		
	
	
	mysql_query('SET NAMES utf8;');
	$sql = "update paciente set motivo_baja='$motivo_baja',clave_estado_paciente=3,usuario_actualizacion='$usuario',
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
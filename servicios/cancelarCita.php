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
	$clave_cancelacion=$_GET['clave_cancelacion'];	
	
	
	
	$sql = "update cita set clave_estado_cita=4,usuario_cancelacion='$usuario',fecha_cancelacion=now(),clave_cancelacion=$clave_cancelacion
			where clave_cita=$clave_cita";
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
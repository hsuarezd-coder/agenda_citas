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
	$clave_estudio=$_GET['clave_estudio'];	
	$clave_equipo=$_GET['clave_equipo'];	
	$clave_personal=$_GET['clave_personal'];	
	$clave_horario_cita=$_GET['clave_horario_cita'];
	$clave_estado_cita=$_GET['clave_estado_cita'];
	$fecha_cita= $_GET['fecha_cita'];
	
	$sql1 = "SELECT * FROM cita where clave_estado_cita not in (4) and clave_equipo = $clave_equipo and clave_personal=$clave_personal and clave_estudio=$clave_estudio and clave_horario_cita=$clave_horario_cita and fecha_cita='$fecha_cita'";
	$retorno1 = mysql_query( $sql1, $conn );
	if($row1=mysql_fetch_array($retorno1, MYSQL_ASSOC)) {
		echo '[{"resultado": "2"}]'; 
	}else{	
		mysql_query('SET NAMES utf8;');
		$sql = "insert into cita
				(clave_equipo,clave_personal,clave_estudio,clave_horario_cita,clave_estado_cita,clave_paciente,fecha_cita,usuario_registro,fecha_registro)
				values ($clave_equipo,$clave_personal,$clave_estudio,$clave_horario_cita,$clave_estado_cita,$clave_paciente,'$fecha_cita','$usuario',now())";
		header('Content-type: text/json');
		$retval = mysql_query( $sql, $conn );
		if(! $retval )
		{
			echo '[{"resultado": "0"}]'; 
		} else {
			echo '[{"resultado": "1"}]'; 
		}
	}
	mysql_close($conn);
		
}
?>
<?php
session_start();
$usuario=$_POST["usuario"];
$contrasena=$_POST["contrasena"];

include 'conexion.php';

if (!$db_selected) {
    die ('No se puede seleccionar la base de datos : ' . mysql_error());
}else{
	$sql="select * from personal where nombre_usuario_personal='".$usuario."' and  clave_estado_personal=1";
	$retorno = mysql_query( $sql, $conn );
	if($row=mysql_fetch_array($retorno, MYSQL_ASSOC)){
		if($contrasena==$row['contrasena_personal']){
			session_regenerate_id();
			$_SESSION['usuario'] = $row['nombre_personal']." ".$row['apellido_paterno_personal']." ".$row['apellido_materno_personal'];			
			$_SESSION['clave_personal'] = $row['clave_personal'];			
			session_write_close();
			header( 'Location: principal.php' ) ;
			exit();			
		}
		else{
			header( 'Location: login.php' ) ;
		}
	}
	else{
		header( 'Location: login.php' ) ;
	}
	mysql_close($conn);
}
?>
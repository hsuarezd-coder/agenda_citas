<?php
session_start();

include '../conexion.php';

if (!$db_selected) {
    die ('No se puede seleccionar la base de datos : ' . mysql_error());
}else{
	$var = array();
	mysql_query('SET NAMES utf8;');
	$clave_equipo=$_GET['clave_equipo'];
	$sql = "SELECT * FROM personal p inner join operador_equipo op
		on p.clave_personal=op.clave_personal
		where p.clave_estado_personal=1 and op.clave_equipo=$clave_equipo";
	$retorno = mysql_query( $sql, $conn );
	while($row=mysql_fetch_array($retorno, MYSQL_ASSOC)) {
		$var[] = $row;
	}
	mysql_close($conn);
	echo json_encode($var);
}
?>
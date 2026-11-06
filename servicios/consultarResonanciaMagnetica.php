<?php
session_start();

include '../conexionINB.php';

if (!$db_selected) {
    die ('No se puede seleccionar la base de datos : ' . mysql_error());
}else{
	$var = array();
	mysql_query('SET NAMES utf8;');
	
	$sql = "SELECT 
			  paciente.clave_paciente,
			  paciente.nombre_paciente,
			  paciente.apellido_paterno_paciente,
			  paciente.apellido_materno_paciente,
			  paciente.fecha_nacimiento_paciente,
			  paciente.semanas_gestacion,
			  paciente.fecha_registro,
			  paciente.clave_estado_paciente,
			  paciente.codigo_paciente,
			  resonancia_magnetica.fecha_registro,
			  resonancia_magnetica.edad_corregida,
			  resonancia_magnetica.numero_estudio,
			  resonancia_magnetica.id_equipo,
			  resonancia_magnetica.cc,
			  resonancia_magnetica.vld,
			  resonancia_magnetica.vli,
			  resonancia_magnetica.esa,
			  resonancia_magnetica.cdaa,
			  resonancia_magnetica.cdac,
			  resonancia_magnetica.cdap,
			  resonancia_magnetica.faa,
			  resonancia_magnetica.fac,
			  resonancia_magnetica.fap,
			  resonancia_magnetica.faderecho,
			  resonancia_magnetica.faizquierdo,
			  resonancia_magnetica.adcderecho,
			  resonancia_magnetica.adcizquierdo,
			  resonancia_magnetica.fosfocreat,
			  resonancia_magnetica.naa,
			  resonancia_magnetica.chol,
			  resonancia_magnetica.isbfi,
			  resonancia_magnetica.isbfd,
			  resonancia_magnetica.isboi,
			  resonancia_magnetica.isbod,
			  resonancia_magnetica.adcsbfi,
			  resonancia_magnetica.adcsbfd,
			  resonancia_magnetica.adcsboi,
			  resonancia_magnetica.adcsbod,
			  resonancia_magnetica.observaciones,
			  resonancia_magnetica.diagnostico,
			  resonancia_magnetica.fecha_estudio,
			  resonancia_magnetica.clave_paciente
			FROM
			  resonancia_magnetica
			  LEFT OUTER JOIN paciente ON (resonancia_magnetica.clave_paciente = paciente.clave_paciente)";
	$retorno = mysql_query( $sql, $conn );
	while($row=mysql_fetch_array($retorno, MYSQL_ASSOC)) {
		$var[] = $row;
	}
	mysql_close($conn);
	echo json_encode($var);
}
?>
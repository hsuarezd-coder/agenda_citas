<?php
session_start();

include '../conexion.php';

if (!$db_selected) {
    die ('No se puede seleccionar la base de datos : ' . mysql_error());
}else{
	$var = array();
	mysql_query('SET NAMES utf8;');
	$fecha_inicio=$_GET['fecha_inicio'];
	$fecha_fin=$_GET['fecha_fin'];	
	$sql = "SELECT p.codigo_paciente,c.clave_cita,c.clave_estado_cita,concat(p.nombre_paciente,' ',p.apellido_paterno_paciente,' ',p.apellido_materno_paciente) as paciente,
			e.nombre_estudio,c.fecha_cita,ec.descripcion_estado_cita,h.hora,
			concat(per.nombre_personal,' ',per.apellido_paterno_personal,' ',per.apellido_materno_personal) as personal,c.reporte,
			(SELECT max(fecha_cita) as fecha_electro FROM cita where clave_paciente=p.clave_paciente and clave_estudio=3 and clave_estado_cita=6) as fecha_electro
			FROM cita c
			inner join paciente p on c.clave_paciente=p.clave_paciente
			inner join estudio e on c.clave_estudio=e.clave_estudio
			inner join estado_cita ec on c.clave_estado_cita=ec.clave_estado_cita
			inner join horario_cita hc on c.clave_horario_cita=hc.clave_horario_cita
			inner join horario h on hc.clave_horario=h.clave_horario
			inner join personal per on c.clave_personal=per.clave_personal
			where fecha_cita between '$fecha_inicio' and '$fecha_fin' and c.clave_estudio in (4,17) and c.clave_estado_cita=1";
	
	$sql=$sql." order by c.fecha_cita,h.hora asc";	
	$retorno = mysql_query( $sql, $conn );
	while($row=mysql_fetch_array($retorno, MYSQL_ASSOC)) {
		$var[] = $row;
	}
	mysql_close($conn);
	echo json_encode($var);
}
?>
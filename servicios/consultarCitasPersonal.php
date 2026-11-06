<?php
session_start();

include '../conexion.php';

if (!$db_selected) {
    die ('No se puede seleccionar la base de datos : ' . mysql_error());
}else{
	$json_response = array();
	mysql_query('SET NAMES utf8;');
	$clave_personal=$_GET['clave_personal'];
	$sql = "SELECT (select count(*) FROM cita cs
			inner join paciente ps on cs.clave_paciente=ps.clave_paciente
			inner join estudio es on cs.clave_estudio=es.clave_estudio
			inner join horario_cita hcs on cs.clave_horario_cita=hcs.clave_horario_cita
			inner join horario hs on hcs.clave_horario=hs.clave_horario
			inner join personal pes on cs.clave_personal=pes.clave_personal
			where cs.clave_estado_cita=1 and cs.clave_personal=$clave_personal
			and cs.fecha_cita=c.fecha_cita
			group by cs.fecha_cita)
			as total,c.fecha_cita,c.clave_estado_cita,c.fecha_cita,c.clave_cita,c.nombre_primera_vez,
			p.clave_paciente,p.nombre_paciente,p.apellido_paterno_paciente,p.apellido_materno_paciente,
			e.clave_estudio,e.nombre_estudio,
			hc.clave_horario_cita,h.hora,
			pe.clave_personal,pe.nombre_personal,pe.apellido_paterno_personal,pe.apellido_materno_personal
			FROM cita c
			inner join paciente p on c.clave_paciente=p.clave_paciente
			inner join estudio e on c.clave_estudio=e.clave_estudio
			inner join horario_cita hc on c.clave_horario_cita=hc.clave_horario_cita
			inner join horario h on hc.clave_horario=h.clave_horario
			inner join personal pe on c.clave_personal=pe.clave_personal
			where c.clave_estado_cita=1 and c.clave_personal=$clave_personal
			and c.fecha_cita>='2021-01-01'";
			/* para fechas anteriores '2021-01-01'* ajustetemporal debe ser CURDATE()*/
	$retorno = mysql_query( $sql, $conn );


	while($row=mysql_fetch_array($retorno, MYSQL_ASSOC)) {
		$row_array["date"] = date("Y-m-d H:i:00",strtotime($row["fecha_cita"]." ".$row["hora"]));
		$row_array["type"] = "meeting";
		$row_array["title"] = $row["nombre_paciente"]." ".$row["apellido_paterno_paciente"]." ".$row["apellido_materno_paciente"];
		$row_array["description"] = "Cita para el estudio: ".$row["nombre_estudio"];
		$row_array["url"] = "";
		$row_array["total"] = $row["total"];
		$row_array["clave_cita"] = $row["clave_cita"];
		$row_array["nombre_primera_vez"] = $row["nombre_primera_vez"];
		array_push($json_response,$row_array);
	}
	mysql_close($conn);
	echo json_encode($json_response);	


}
?>
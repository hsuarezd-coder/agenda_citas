<?php
session_start();

include '../conexion.php';

if (!$db_selected) {
    die ('No se puede seleccionar la base de datos : ' . mysql_error());
}else{
	$json_response = array();
	mysql_query('SET NAMES utf8;');
	$clave_paciente=$_GET['clave_paciente'];
	$sql = "SELECT c.clave_cita,c.fecha_cita,c.clave_estado_cita,c.fecha_cita,
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
			where c.clave_estado_cita=1 and p.clave_paciente=$clave_paciente
			and c.fecha_cita>'2021-01-01'";
			/* para fechas anteriores '2021-01-01'* ajustetemporal debe ser CURDATE()*/
	$retorno = mysql_query( $sql, $conn );


	while($row=mysql_fetch_array($retorno, MYSQL_ASSOC)) {
		$row_array["date"] = date("Y-m-d H:i:00",strtotime($row["fecha_cita"]." ".$row["hora"]));
		$row_array["type"] = "meeting";
		$row_array["title"] = $row["nombre_paciente"]." ".$row["apellido_paterno_paciente"]." ".$row["apellido_materno_paciente"];
		$row_array["description"] = "Cita para el estudio: ".$row["nombre_estudio"];
		$row_array["url"] = "";
		$row_array["clave_cita"] = $row["clave_cita"];
		array_push($json_response,$row_array);
	}
	mysql_close($conn);
	echo json_encode($json_response);	


}
?>
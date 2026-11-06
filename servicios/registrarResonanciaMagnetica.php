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
	//$edad_cronologica=$_GET['edad_cronologica'];	
	//$edad_corregida=$_GET['edad_corregida'];
	$nombre_paciente=$_GET['nombre_paciente'];
	$clave_personal=$_GET['clave_personal'];
	
	$fecha_estudio=$_GET['fecha_estudio'];
	$edad_en_estudio=$_GET['edad_en_estudio'];
	$edad_corregida_estudio=$_GET['edad_corregida_estudio'];
	$numero_estudio=$_GET['numero_estudio'];
	$estudio=$_GET['estudio'];
	$equipo=$_GET['equipo'];	
	$ven_lat_der=$_GET['ven_lat_der'];
	$morfolo_vent_lat_der=$_GET['morfolo_vent_lat_der'];
	$dimensiones_vent_lat_der=$_GET['dimensiones_vent_lat_der'];
	$vol_cuerpo_calloso=$_GET['vol_cuerpo_calloso'];
	$morfolo_cuerpo_calloso=$_GET['morfolo_cuerpo_calloso'];
	$dimensiones_cuerpo_calloso=$_GET['dimensiones_cuerpo_calloso'];
	$ven_lat_izq=$_GET['ven_lat_izq'];
	$morfolo_vent_lat_izq=$_GET['morfolo_vent_lat_izq'];
	$dimensiones_vent_lat_izq=$_GET['dimensiones_vent_lat_izq'];
	$dimensiones_espacio_subaracno=$_GET['dimensiones_espacio_subaracno'];
	$region_espacio_subaracno=$_GET['region_espacio_subaracno'];
	$Jestrucctura_osea=$_GET['Jestrucctura_osea'];
	$Jestrucctura_osea_observaciones=$_GET['Jestrucctura_osea_observaciones'];
	$angioresonancia=$_GET['angioresonancia'];
	$angioresonancia_observaciones=$_GET['angioresonancia_observaciones'];
	$encefalopatia_prematuro=$_GET['encefalopatia_prematuro'];
	$observaciones_generales=$_GET['observaciones_generales'];
	$regio_infratent_iv_ventric=$_GET['regio_infratent_iv_ventric'];
	$regio_infratent_cerebelo=$_GET['regio_infratent_cerebelo'];
	$regio_infratent_angul_puntocerebe=$_GET['regio_infratent_angul_puntocerebe'];
	$regio_infratent_descrip_lesion=$_GET['regio_infratent_descrip_lesion'];
	$conclusiones=$_GET['conclusiones'];
	$senos_paranasales=$_GET['senos_paranasales'];
	$impacto_neurologico=$_GET['impacto_neurologico'];
	$analisis_tractograf=$_GET['analisis_tractograf'];	
	$eopdoi=$_GET['secuencias'];
	$morfolog_dif_sustan_blancgris=$_GET['morfolog_dif_sustan_blancgris'];
	$observ_dif_sustan_blancgris=$_GET['observ_dif_sustan_blancgris'];
	
	
	
	
	
	mysql_query('SET NAMES utf8;');
	$sql = "insert into paciente
			(clave_estado_paciente,nombre_paciente,apellido_paterno_paciente,apellido_materno_paciente,fecha_nacimiento_paciente,
			nombre_padre_paciente,nombre_madre_paciente,direccion_paciente,colonia_paciente,entidad_federativa_paciente,
			municipio_paciente,cp_paciente,telefono_paciente,instituto_procedencia_paciente,codigo_paciente,semanas_gestacion,
			sexo_paciente,fecha_registro,celular_paciente,peso_paciente,talla_paciente,fum,fecha_nacimiento_madre,
			correo_contacto_paciente,apgar_paciente,usuario_registro,fecha_ingreso_paciente,protocolo_paciente)
			values (1,'$nombre_paciente','$apellido_paterno_paciente','$apellido_materno_paciente','$fecha_nacimiento_paciente',
			'$nombre_padre_paciente','$nombre_madre_paciente','$direccion_paciente','$colonia_paciente','$entidad_federativa_paciente',
			'$municipio_paciente','$cp_paciente','$telefono_paciente','$instituto_procedencia_paciente','$codigo_paciente',$semanas_gestacion,
			'$sexo_paciente',now(),'$celular_paciente','$peso_paciente','$talla_paciente','$fum','$fecha_nacimiento_madre',
			'$correo_contacto_paciente','$apgar_paciente','$usuario','$fecha_ingreso_paciente','$protocolo_paciente')";
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
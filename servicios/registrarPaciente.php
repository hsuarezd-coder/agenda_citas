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
	$nombre_paciente=$_GET['nombre_paciente'];	
	$apellido_paterno_paciente=$_GET['apellido_paterno_paciente'];	
	$apellido_materno_paciente=$_GET['apellido_materno_paciente'];	
	$fecha_nacimiento_paciente=$_GET['fecha_nacimiento_paciente'];	
	$nombre_padre_paciente=$_GET['nombre_padre_paciente'];
	$nombre_madre_paciente=$_GET['nombre_madre_paciente'];
	$direccion_paciente= $_GET['direccion_paciente'];
	$colonia_paciente= $_GET['colonia_paciente'];
	$entidad_federativa_paciente= $_GET['entidad_federativa_paciente'];
	$municipio_paciente= $_GET['municipio_paciente'];
	$cp_paciente= $_GET['cp_paciente'];
	$instituto_procedencia_paciente= $_GET['instituto_procedencia_paciente'];
	$telefono_paciente= $_GET['telefono_paciente'];
	$codigo_paciente= $_GET['codigo_paciente'];
	$semanas_gestacion= $_GET['semanas_gestacion'];
	$sexo_paciente= $_GET['sexo_paciente'];
	$celular_paciente= $_GET['celular_paciente'];
	$peso_paciente= $_GET['peso_paciente'];
	$talla_paciente= $_GET['talla_paciente'];
	$fum= $_GET['fum'];
	$fecha_nacimiento_madre= $_GET['fecha_nacimiento_madre'];
	$correo_contacto_paciente= $_GET['correo_contacto_paciente'];
	$apgar_paciente= $_GET['apgar_paciente'];
	$fecha_ingreso_paciente= $_GET['fecha_ingreso_paciente'];
	$protocolo_paciente= $_GET['protocolo_paciente'];
	$escolaridad_materna= $_GET['escolaridad_materna'];
	$escolaridad_paterna= $_GET['escolaridad_paterna'];
	$nivel_socioeconomico= $_GET['nivel_socioeconomico'];
	$ocupacion_materna= $_GET['ocupacion_materna'];
	$ocupacion_paterna= $_GET['ocupacion_paterna'];
	$seguridad_social= $_GET['seguridad_social'];
	$numero_integrantes= $_GET['numero_integrantes'];
	
	
	
	
	mysql_query('SET NAMES utf8;');
	$sql = "insert into paciente
			(clave_estado_paciente,nombre_paciente,apellido_paterno_paciente,apellido_materno_paciente,fecha_nacimiento_paciente,
			nombre_padre_paciente,nombre_madre_paciente,direccion_paciente,colonia_paciente,entidad_federativa_paciente,
			municipio_paciente,cp_paciente,telefono_paciente,instituto_procedencia_paciente,codigo_paciente,semanas_gestacion,
			sexo_paciente,fecha_registro,celular_paciente,peso_paciente,talla_paciente,fum,fecha_nacimiento_madre,
			correo_contacto_paciente,apgar_paciente,usuario_registro,fecha_ingreso_paciente,protocolo_paciente,escolaridad_materna,
			escolaridad_paterna,nivel_socioeconomico,ocupacion_materna,ocupacion_paterna,seguridad_social,numero_integrantes)
			values (1,'$nombre_paciente','$apellido_paterno_paciente','$apellido_materno_paciente','$fecha_nacimiento_paciente',
			'$nombre_padre_paciente','$nombre_madre_paciente','$direccion_paciente','$colonia_paciente','$entidad_federativa_paciente',
			'$municipio_paciente','$cp_paciente','$telefono_paciente','$instituto_procedencia_paciente','$codigo_paciente',$semanas_gestacion,
			'$sexo_paciente',now(),'$celular_paciente','$peso_paciente','$talla_paciente','$fum','$fecha_nacimiento_madre',
			'$correo_contacto_paciente','$apgar_paciente','$usuario','$fecha_ingreso_paciente','$protocolo_paciente','$escolaridad_materna',
			'$escolaridad_paterna','$nivel_socioeconomico','$ocupacion_materna','$ocupacion_paterna','$seguridad_social',$numero_integrantes)";
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
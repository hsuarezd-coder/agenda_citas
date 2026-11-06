<?php
session_start();

include '../conexionINB.php';

if (!$db_selected) {
    die ('No se puede seleccionar la base de datos : ' . mysql_error());
}else{
	$var = array();
	mysql_query('SET NAMES utf8;');
	
	$sql = "SELECT
  paciente.nombre_paciente,
  paciente.apellido_paterno_paciente,
  paciente.apellido_materno_paciente,
  paciente.fecha_nacimiento_paciente,
  paciente.semanas_gestacion,
  paciente.codigo_paciente,
  paciente.clave_estado_paciente,
  terapia_neurohabilitatoria.id_terapia_neurohabilitatoria,
  terapia_neurohabilitatoria.clave_paciente,
  terapia_neurohabilitatoria.nombre_pacinete,
  terapia_neurohabilitatoria.clave_personal,
  terapia_neurohabilitatoria.fecha_registro,
  terapia_neurohabilitatoria.edad_corregida,
  terapia_neurohabilitatoria.edad_cronologica,
  terapia_neurohabilitatoria.dat_ter_tipo_terapia,
  terapia_neurohabilitatoria.dat_ter_fec_ini_tratam_terap,
  terapia_neurohabilitatoria.dat_ter_fech_nac_edad_correg,
  terapia_neurohabilitatoria.dat_ter_edad_ini_trat_sem,
  terapia_neurohabilitatoria.dat_ter_edad_cronologica_al_ingr_sem,
  terapia_neurohabilitatoria.dat_ter_edad_correg_al_ingr_sem,
  terapia_neurohabilitatoria.dat_ter_peso_,
  terapia_neurohabilitatoria.dat_ter_talla,
  terapia_neurohabilitatoria.dat_ter_PC,
  terapia_neurohabilitatoria.dat_tera_eval_terap,
  terapia_neurohabilitatoria.dat_tera_tono_mus_norm,
  terapia_neurohabilitatoria.dat_tera_ton_mus_hipo,
  terapia_neurohabilitatoria.dat_tera_ton_mus_hiper,
  terapia_neurohabilitatoria.dat_tera_ton_mus_mix,
  terapia_neurohabilitatoria.dat_tera_ton_mus_fluc,
  terapia_neurohabilitatoria.dat_tera_post_norm,
  terapia_neurohabilitatoria.dat_tera_post_asime,
  terapia_neurohabilitatoria.eval_subs,
  terapia_neurohabilitatoria.eval_subs_num_eval,
  terapia_neurohabilitatoria.eval_subs_fec_eval,
  terapia_neurohabilitatoria.eval_subs_eda_sem,
  terapia_neurohabilitatoria.pat_des_mot_gru_punt_obt,
  terapia_neurohabilitatoria.pat_des_mot_gru_porcen,
  terapia_neurohabilitatoria.pat_des_mot_fin_punt_obt,
  terapia_neurohabilitatoria.pat_des_mot_fin_porc,
  terapia_neurohabilitatoria.pat_des_cog_punt_obt,
  terapia_neurohabilitatoria.pat_des_cog_porc,
  terapia_neurohabilitatoria.pat_des_leng_pun_obt,
  terapia_neurohabilitatoria.pat_des_leng_porc,
  terapia_neurohabilitatoria.pat_des_per_soc_pun_soc,
  terapia_neurohabilitatoria.pat_des_per_soc_porc,
  terapia_neurohabilitatoria.eval_ini,
  terapia_neurohabilitatoria.eval_ini_ton_musc_norm,
  terapia_neurohabilitatoria.eval_ini_ton_musc_hipo,
  terapia_neurohabilitatoria.eval_ini_ton_musc_hiper,
  terapia_neurohabilitatoria.eval_ini_ton_musc_mixt,
  terapia_neurohabilitatoria.eval_ini_ton_musc_fluc,
  terapia_neurohabilitatoria.eval_ini_post_norm,
  terapia_neurohabilitatoria.eval_ini_post_asim,
  terapia_neurohabilitatoria.num_sec_por_mes,
  terapia_neurohabilitatoria.sign_alarma,
  terapia_neurohabilitatoria.hit_mot_gru_cont_cef_fec_cons,
  terapia_neurohabilitatoria.cont_cef_sem_cons,
  terapia_neurohabilitatoria.hit_mot_gru_sed_fec_cons,
  terapia_neurohabilitatoria.hit_mot_gru_sed_sem_cons,
  terapia_neurohabilitatoria.hit_mot_gru_rea_pro_fec_cons,
  terapia_neurohabilitatoria.hit_mot_gru_rea_pro_sem_cons,
  terapia_neurohabilitatoria.hit_mot_gru_arra_fec_cons,
  terapia_neurohabilitatoria.hit_mot_gru_arra_sem_cons,
  terapia_neurohabilitatoria.hit_mot_gru_gat_fec_cons,
  terapia_neurohabilitatoria.hit_mot_gru_gat_sem_cons,
  terapia_neurohabilitatoria.hit_mot_gru_movpost_aut_fec_cons,
  terapia_neurohabilitatoria.hit_mot_gru_movpost_aut_sem_cons,
  terapia_neurohabilitatoria.hit_mot_gru_mar_inde_fec_cons,
  terapia_neurohabilitatoria.hit_mot_gru_mar_inde_sem_cons,
  terapia_neurohabilitatoria.hit_mot_fin_fijocu_fec_con,
  terapia_neurohabilitatoria.hit_mot_fin_fijocu_sem_con,
  terapia_neurohabilitatoria.hit_mot_fin_cubpal_fec_con,
  terapia_neurohabilitatoria.hit_mot_fin_cubpal_sem_con,
  terapia_neurohabilitatoria.hit_mot_fin_preras_fec_con,
  terapia_neurohabilitatoria.hit_mot_fin_preras_sem_con,
  terapia_neurohabilitatoria.hit_mot_fin_pininf_fec_con,
  terapia_neurohabilitatoria.hit_mot_fin_pininf_sem_con,
  terapia_neurohabilitatoria.hit_mot_fin_pinfin_fec_con,
  terapia_neurohabilitatoria.hit_mot_fin_pinfin_sem_con,
  terapia_neurohabilitatoria.hit_mot_fin_aflovol_fec_con,
  terapia_neurohabilitatoria.hit_mot_fin_aflovol_sem_con,
  terapia_neurohabilitatoria.hit_mot_fin_coorocu_fec_con,
  terapia_neurohabilitatoria.hit_mot_fin_coorocu_sem_con,
  paciente.sexo_paciente
FROM
  paciente
  INNER JOIN terapia_neurohabilitatoria ON (paciente.clave_paciente = terapia_neurohabilitatoria.clave_paciente)";
	$retorno = mysql_query( $sql, $conn );
	while($row=mysql_fetch_array($retorno, MYSQL_ASSOC)) {
		$var[] = $row;
	}
	mysql_close($conn);
	echo json_encode($var);
}
?>
<meta charset="UTF-8"/>
<?php
	$curso_fk = $_REQUEST['curso_fk'];
	$vol_info_1 = $_REQUEST['vol_info_1'];
	$pres_info_2 = $_REQUEST['pres_info_2'];
	$time_asign_3 = $_REQUEST['time_asign_3'];
	$cap_exp_4 = $_REQUEST['cap_exp_4'];
	$teo_pract_5 = $_REQUEST['teo_pract_5'];
	$org_time_6 = $_REQUEST['org_time_6'];
	$resp_cons_7 = $_REQUEST['resp_cons_7'];
	$calif_docente = $_REQUEST['calif_docente'];
	$aten_per_seu_8 = $_REQUEST['aten_per_seu_8'];
	$equip_aula_9 = $_REQUEST['equip_aula_9'];
	$cali_mat_10 = $_REQUEST['cali_mat_10'];
	$calif_curso = $_REQUEST['calif_curso'];
	$observa = trim(ucfirst($_REQUEST['observa']));
	$fecreg = date(Ymd);
	$idAlumno = $_REQUEST['idAlumno'];

	echo 'curso: '.$curso_fk.'<br>';
	echo 'p1: '.$vol_info_1.'<br>';
	echo 'p3: '.$pres_info_2.'<br>';
	echo 'p4: '.$time_asign_3.'<br>';
	echo 'p5: '.$cap_exp_4.'<br>';
	echo 'p6: '.$teo_pract_5.'<br>';
	echo 'p7: '.$org_time_6.'<br>';
	echo 'p8: '.$resp_cons_7.'<br>';
	echo 'p9: '.$calif_docente.'<br>';
	echo 'p10: '.$aten_per_seu_8.'<br>';
	echo 'p11: '.$equip_aula_9.'<br>';
	echo 'p12: '.$cali_mat_10.'<br>';
	echo 'p13: '.$calif_curso.'<br>';
	echo 'p14: '.$observa.'<br>';
	echo 'p15: '.$fecreg.'<br>';
	echo 'idAlumno: '.$idAlumno.'<br>';


include_once "conexionCursosExtension.php";
include_once "libreria.php";

/*------------------ VALORES ------------------*/
/*
	1_ EXCELENTE
	2_ MUY BUENO
	3_ BUENO
	4_ REGULAR

*/
/*---------------------------------------------*/
	$sql = "INSERT INTO encuesta (curso_fk, vol_info_1, pres_info_2, time_asign_3, cap_exp_4, teo_pract_5, org_time_6, resp_cons_7, calif_docente, aten_per_seu_8, equip_aula_9, cali_mat_10, calif_curso, observa, fecreg) VALUES ('$curso_fk', '$vol_info_1', '$pres_info_2', '$time_asign_3', $cap_exp_4, '$teo_pract_5', '$org_time_6', $resp_cons_7, '$calif_docente', '$aten_per_seu_8', '$equip_aula_9', '$cali_mat_10', '$calif_curso', '$observa', '$fecreg');";
	$sql .= "UPDATE inscriptosxcurso SET enc_hecha = 'TRUE' WHERE fk_inscriptos = $idAlumno AND fk_curso = $curso_fk;";
	$error = guardarSql($sql);

	if ($error == 1) {
		include_once "cerrar_conexion.php";
		echo '<script> window.location = "validarEncuesta.php?error=1";</script>';
	}else{
		include_once "cerrar_conexion.php";
		echo '<script> window.location = "validarEncuesta.php?ok=1";</script>';
	}

?>
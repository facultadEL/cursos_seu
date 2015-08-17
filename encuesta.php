<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" sizes="14x16 16x14 16x16 32x32 48x48 64x64" type="image/x-icon" href="images/favicon.png" />
	<title>Encuesta</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.css">
	<link rel="stylesheet" href="bootstrap/css/estilos.css">
	<script src="bootstrap/js/jquery-1.11.3.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script defer>
		function pregunta1(){

		  cont_tildes1 = 0;

		  if($('#vol_info_a').is(':checked')) cont_tildes1++;
		  if($('#vol_info_b').is(':checked')) cont_tildes1++;
		  if($('#vol_info_c').is(':checked')) cont_tildes1++;
		  if($('#vol_info_d').is(':checked')) cont_tildes1++;
		  
		  return cont_tildes1;
		}

		function pregunta2(){

		  cont_tildes2 = 0;

		  if($('#pres_info_a').is(':checked')) cont_tildes2++;
		  if($('#pres_info_b').is(':checked')) cont_tildes2++;
		  if($('#pres_info_c').is(':checked')) cont_tildes2++;
		  if($('#pres_info_d').is(':checked')) cont_tildes2++;
		  
		  return cont_tildes2;
		}

		function pregunta3(){

		  cont_tildes3 = 0;

		  if($('#time_asign_a').is(':checked')) cont_tildes3++;
		  if($('#time_asign_b').is(':checked')) cont_tildes3++;
		  if($('#time_asign_c').is(':checked')) cont_tildes3++;
		  if($('#time_asign_d').is(':checked')) cont_tildes3++;
		  
		  return cont_tildes3;
		}

		function pregunta4(){

		  cont_tildes4 = 0;

		  if($('#cap_exp_a').is(':checked')) cont_tildes4++;
		  if($('#cap_exp_b').is(':checked')) cont_tildes4++;
		  if($('#cap_exp_c').is(':checked')) cont_tildes4++;
		  if($('#cap_exp_d').is(':checked')) cont_tildes4++;
		  
		  return cont_tildes4;
		}

		function pregunta5(){

		  cont_tildes5 = 0;

		  if($('#teo_pract_a').is(':checked')) cont_tildes5++;
		  if($('#teo_pract_b').is(':checked')) cont_tildes5++;
		  if($('#teo_pract_c').is(':checked')) cont_tildes5++;
		  if($('#teo_pract_d').is(':checked')) cont_tildes5++;
		  
		  return cont_tildes5;
		}

		function pregunta6(){

		  cont_tildes6 = 0;

		  if($('#org_time_a').is(':checked')) cont_tildes6++;
		  if($('#org_time_b').is(':checked')) cont_tildes6++;
		  if($('#org_time_c').is(':checked')) cont_tildes6++;
		  if($('#org_time_d').is(':checked')) cont_tildes6++;
		  
		  return cont_tildes6;
		}

		function pregunta7(){

		  cont_tildes7 = 0;

		  if($('#resp_cons_a').is(':checked')) cont_tildes7++;
		  if($('#resp_cons_b').is(':checked')) cont_tildes7++;
		  if($('#resp_cons_c').is(':checked')) cont_tildes7++;
		  if($('#resp_cons_d').is(':checked')) cont_tildes7++;
		  
		  return cont_tildes7;
		}

		function pregunta8(){

		  cont_tildes8 = 0;

		  if($('#aten_per_seu_a').is(':checked')) cont_tildes8++;
		  if($('#aten_per_seu_b').is(':checked')) cont_tildes8++;
		  if($('#aten_per_seu_c').is(':checked')) cont_tildes8++;
		  if($('#aten_per_seu_d').is(':checked')) cont_tildes8++;
		  
		  return cont_tildes8;
		}

		function pregunta9(){

		  cont_tildes9 = 0;

		  if($('#equip_aula_a').is(':checked')) cont_tildes9++;
		  if($('#equip_aula_b').is(':checked')) cont_tildes9++;
		  if($('#equip_aula_c').is(':checked')) cont_tildes9++;
		  if($('#equip_aula_d').is(':checked')) cont_tildes9++;
		  
		  return cont_tildes9;
		}

		function pregunta10(){

		  cont_tildes10 = 0;

		  if($('#cali_mat_a').is(':checked')) cont_tildes10++;
		  if($('#cali_mat_b').is(':checked')) cont_tildes10++;
		  if($('#cali_mat_c').is(':checked')) cont_tildes10++;
		  if($('#cali_mat_d').is(':checked')) cont_tildes10++;
		  
		  return cont_tildes10;
		}

		function cbo_control(){
			if($('#cbo').val() == 0) return false;
		}

		function control_tildes(){
			if(pregunta1() == 0){
				ponerColor('lbl_error1','alerta1','vol_info_a');
				return false;
			}
			if(pregunta2() == 0){
				ponerColor('lbl_error2','alerta1','pres_info_a');
				return false;
			}
			if(pregunta3() == 0){
				ponerColor('lbl_error3','alerta1','time_asign_a');
				return false;
			}
			if(pregunta4() == 0){
				ponerColor('lbl_error4','alerta2','cap_exp_a');
				return false;
			}
			if(pregunta5() == 0){
				ponerColor('lbl_error5','alerta2','teo_pract_a');
				return false;
			}
			if(pregunta6() == 0){
				ponerColor('lbl_error6','alerta2','org_time_a');
				return false;
			}
			if(pregunta7() == 0){
				ponerColor('lbl_error7','alerta2','resp_cons_a');
				return false;
			}
			if(pregunta8() == 0){
				ponerColor('lbl_error8','alerta3','aten_per_seu_a');
				return false;
			}
			if(pregunta9() == 0){
				ponerColor('lbl_error9','alerta3','equip_aula_a');
				return false;
			}
			if(pregunta10() == 0){
				ponerColor('lbl_error10','alerta3','cali_mat_a');
				return false;
			}
			if($('#cbo').val() == 0){
				ponerColor('cbo','alerta4','cbo');
				return false;
			}
			if($('#calif_docente').val() > 10){
				ponerColor('calif_docente','alerta5','calif_docente');
				return false;
			}
			if($('#calif_docente').val() < 1){
				ponerColor('calif_docente','alerta5','calif_docente');
				return false;
			}
			if($('#calif_curso').val() > 10){
				ponerColor('calif_curso','alerta6','calif_curso');
				return false;
			}
			if($('#calif_curso').val() < 1){
				ponerColor('calif_curso','alerta6','calif_curso');
				return false;
			}
			return true;
		}

		function ponerColor(lbl,id,idFoco){
		    $('.'+lbl).css('color','#f24d4d');
		    $('#'+id).attr('hidden', false);
		    $('#'+idFoco).focus();
		}

		function sacarColor(lbl,id){
		    $('.'+lbl).css('color','#333');
		    $('#'+id).attr('hidden', true);
		}

		function loadScreen(){
		  $('#alerta1').attr('hidden', true);
		  $('#alerta2').attr('hidden', true);
		  $('#alerta3').attr('hidden', true);
		  $('#alerta4').attr('hidden', true);
		  $('#alerta5').attr('hidden', true);
		  $('#alerta6').attr('hidden', true);
		}
	</script>
</head>
<body class="container" onload="loadScreen()">
<?php

include_once "conexionCursosExtension.php";
include_once "libreria.php";

$idAlumno = $_REQUEST['idAlumno'];
//echo 'dni: '.$idAlumno;

?>
<div class="container">
	<form name="encuesta" action="guardarEncuesta.php" method="post" id="encuesta" class="form-horizontal" onSubmit="return control_tildes()">
		<div class="panel panel-body">
			<div class="page-header superior"></div>
				<header>
					<div class="row">
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
							<div class="alert alert-danger text-center" id="alerta4">
								<strong>Atenci&oacute;n:</strong> debe seleccionar un curso.
							</div>
						</div>
					</div>
					<input name="idAlumno" type="hidden" id="idAlumno" value="<?php echo $idAlumno; ?>" />
					<div class="row">
						<div class="col-xs-10 col-sm-10 col-md-8 col-lg-8 col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2 cbo">
							<h3 class="text-center">
								<select name="curso_fk" class="form-control" id="cbo" onchange="sacarColor('cbo','alerta4')" title="Seleccione el curso para realizar la encuesta" required autofocus>
									<option value="0">Seleccione un curso...</option>
									<?php
										//anio='.$anio.' AND
										$anio=date(Y);
										$cursos = traerSql('id_cursos,cursos.nombre,docente,anio,activado','cursos INNER JOIN inscriptosxcurso ON cursos.id_cursos = inscriptosxcurso.fk_curso INNER JOIN inscripto ON inscripto.id_inscripto = inscriptosxcurso.fk_inscriptos','fk_inscriptos ='.$idAlumno.' AND enc_hecha = \'f\' ORDER BY id_cursos');
										while($rowCursos=pg_fetch_array($cursos)){
											echo '<option value="'.$rowCursos['id_cursos'].'" class="text-center">'.$rowCursos['nombre'].'</option>';
										}
									?>
								</select>
							</h3>
						</div>
					</div>
				</header>
			<div class="page-header inferior"></div>

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<legend class="text-left"><h4 class="text-left">Desempe&ntilde;o relativo al curso</h4></legend>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
					<div class="alert alert-danger text-center" id="alerta1">
						<strong>Atenci&oacute;n:</strong> debe tildar alguna de las opciones.
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form-group">
					<label for="vol_info_1" class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 lbl_error1">Volumen de la informaci&oacute;n:</label>
					<div class="checkbox">
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="vol_info_1" type="radio" id="vol_info_a" onclick="sacarColor('lbl_error1','alerta1')" value="1"/>Excelente</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="vol_info_1" type="radio" id="vol_info_b" onclick="sacarColor('lbl_error1','alerta1')" value="2"/>Muy Bueno</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="vol_info_1" type="radio" id="vol_info_c" onclick="sacarColor('lbl_error1','alerta1')" value="3"/>Bueno</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="vol_info_1" type="radio" id="vol_info_d" onclick="sacarColor('lbl_error1','alerta1')" value="4"/>Regular</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form-group">
					<label for="pres_info_2" class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 lbl_error2">Presentaci&oacute;n de la informaci&oacute;n:</label>
					<div class="checkbox">
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="pres_info_2" type="radio" id="pres_info_a" onclick="sacarColor('lbl_error2','alerta1')" value="1"/>Excelente</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="pres_info_2" type="radio" id="pres_info_b" onclick="sacarColor('lbl_error2','alerta1')" value="2"/>Muy Bueno</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="pres_info_2" type="radio" id="pres_info_c" onclick="sacarColor('lbl_error2','alerta1')" value="3"/>Bueno</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="pres_info_2" type="radio" id="pres_info_d" onclick="sacarColor('lbl_error2','alerta1')" value="4"/>Regular</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form-group">
					<label for="time_asign_3" class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 lbl_error3">Tiempo asignado</label>
					<div class="checkbox">
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="time_asign_3" type="radio" id="time_asign_a" onclick="sacarColor('lbl_error3','alerta1')" value="1"/>Excelente</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="time_asign_3" type="radio" id="time_asign_b" onclick="sacarColor('lbl_error3','alerta1')" value="2"/>Muy Bueno</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="time_asign_3" type="radio" id="time_asign_c" onclick="sacarColor('lbl_error3','alerta1')" value="3"/>Bueno</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="time_asign_3" type="radio" id="time_asign_d" onclick="sacarColor('lbl_error3','alerta1')" value="4"/>Regular</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<legend><h4 class="text-left">Desempe&ntilde;o relativo al docente</h4></legend>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
					<div class="alert alert-danger text-center" id="alerta2">
						<strong>Atenci&oacute;n:</strong> debe tildar alguna de las opciones.
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form-group">
					<label for="cap_exp_4" class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 lbl_error4">Capacidad de exposici&oacute;n:</label>
					<div class="checkbox">
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="cap_exp_4" type="radio" id="cap_exp_a" onclick="sacarColor('lbl_error4','alerta2')" value="1"/>Excelente</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="cap_exp_4" type="radio" id="cap_exp_b" onclick="sacarColor('lbl_error4','alerta2')" value="2"/>Muy Bueno</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="cap_exp_4" type="radio" id="cap_exp_c" onclick="sacarColor('lbl_error4','alerta2')" value="3"/>Bueno</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="cap_exp_4" type="radio" id="cap_exp_d" onclick="sacarColor('lbl_error4','alerta2')" value="4"/>Regular</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form-group">
					<label for="teo_pract_5" class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 lbl_error5">Integraci&oacute;n de la teor&iacute;a y la pr&aacute;ctica:</label>
					<div class="checkbox">
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="teo_pract_5" type="radio" id="teo_pract_a" onclick="sacarColor('lbl_error5','alerta2')" value="1"/>Excelente</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="teo_pract_5" type="radio" id="teo_pract_b" onclick="sacarColor('lbl_error5','alerta2')" value="2"/>Muy Bueno</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="teo_pract_5" type="radio" id="teo_pract_c" onclick="sacarColor('lbl_error5','alerta2')" value="3"/>Bueno</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="teo_pract_5" type="radio" id="teo_pract_d" onclick="sacarColor('lbl_error5','alerta2')" value="4"/>Regular</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form-group">
					<label for="org_time_6" class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 lbl_error6">Organizaci&oacute;n del tiempo:</label>
					<div class="checkbox">
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="org_time_6" type="radio" id="org_time_a" onclick="sacarColor('lbl_error6','alerta2')" value="1"/>Excelente</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="org_time_6" type="radio" id="org_time_b" onclick="sacarColor('lbl_error6','alerta2')" value="2"/>Muy Bueno</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="org_time_6" type="radio" id="org_time_c" onclick="sacarColor('lbl_error6','alerta2')" value="3"/>Bueno</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="org_time_6" type="radio" id="org_time_d" onclick="sacarColor('lbl_error6','alerta2')" value="4"/>Regular</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form-group">
					<label for="resp_cons_7" class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 lbl_error7">Respuesta a consultas:</label>
					<div class="checkbox">
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="resp_cons_7" type="radio" id="resp_cons_a" onclick="sacarColor('lbl_error7','alerta2')" value="1"/>Excelente</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="resp_cons_7" type="radio" id="resp_cons_b" onclick="sacarColor('lbl_error7','alerta2')" value="2"/>Muy Bueno</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="resp_cons_7" type="radio" id="resp_cons_c" onclick="sacarColor('lbl_error7','alerta2')" value="3"/>Bueno</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="resp_cons_7" type="radio" id="resp_cons_d" onclick="sacarColor('lbl_error7','alerta2')" value="4"/>Regular</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<legend><h4 class="text-left">Desempe&ntilde;o general del docente</h4></legend>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
					<div class="alert alert-danger text-center" id="alerta5">
						<strong>Atenci&oacute;n:</strong> debe ingresar una calificaci&oacute;n entre 1 y 10.
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form-group">
					<label for="calif_docente" class="control-label col-xs-9 col-sm-6 col-md-4 col-lg-4 text-left calif_docente">Califique al docente <small>(del 1 al 10)</small>:</label>
					<div class="col-xs-3 col-sm-2 col-md-2 col-lg-1"><input class="form-control" name="calif_docente" type="text" pattern="[0-9]{1,2}" id="calif_docente" onchange="sacarColor('calif_docente','alerta5')" value="" maxlength="2" minlength="1" required title="Ingrese un puntaje del 1 al 10"/></div>
					<div class="clearfix visible-xs-block"></div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<legend><h4 class="text-left">Desempe&ntilde;o relativo a la organizaci&oacute;n del curso</h4></legend>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
					<div class="alert alert-danger text-center" id="alerta3">
						<strong>Atenci&oacute;n:</strong> debe tildar alguna de las opciones.
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form-group">
					<label for="aten_per_seu_8" class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 lbl_error8">Atenci&oacute;n del personal de la Secretar&iacute;a de Extensi&oacute;n:</label>
					<div class="checkbox">
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="aten_per_seu_8" type="radio" id="aten_per_seu_a" onclick="sacarColor('lbl_error8','alerta3')" value="1"/>Excelente</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="aten_per_seu_8" type="radio" id="aten_per_seu_b" onclick="sacarColor('lbl_error8','alerta3')" value="2"/>Muy Bueno</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="aten_per_seu_8" type="radio" id="aten_per_seu_c" onclick="sacarColor('lbl_error8','alerta3')" value="3"/>Bueno</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="aten_per_seu_8" type="radio" id="aten_per_seu_d" onclick="sacarColor('lbl_error8','alerta3')" value="4"/>Regular</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form-group">
					<label for="equip_aula_9" class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 lbl_error9">Ambientaci&oacute;n y equipamiento del aula:</label>
					<div class="checkbox">
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="equip_aula_9" type="radio" id="equip_aula_a" onclick="sacarColor('lbl_error9','alerta3')" value="1"/>Excelente</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="equip_aula_9" type="radio" id="equip_aula_b" onclick="sacarColor('lbl_error9','alerta3')" value="2"/>Muy Bueno</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="equip_aula_9" type="radio" id="equip_aula_c" onclick="sacarColor('lbl_error9','alerta3')" value="3"/>Bueno</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="equip_aula_9" type="radio" id="equip_aula_d" onclick="sacarColor('lbl_error9','alerta3')" value="4"/>Regular</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form-group">
					<label for="cali_mat_10" class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4 lbl_error10">Calidad del material:</label>
					<div class="checkbox">
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="cali_mat_10" type="radio" id="cali_mat_a" onclick="sacarColor('lbl_error10','alerta3')" value="1"/>Excelente</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="cali_mat_10" type="radio" id="cali_mat_b" onclick="sacarColor('lbl_error10','alerta3')" value="2"/>Muy Bueno</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="cali_mat_10" type="radio" id="cali_mat_c" onclick="sacarColor('lbl_error10','alerta3')" value="3"/>Bueno</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><input name="cali_mat_10" type="radio" id="cali_mat_d" onclick="sacarColor('lbl_error10','alerta3')" value="4"/>Regular</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<legend><h4 class="text-left">Desempe&ntilde;o global del curso</h4></legend>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
					<div class="alert alert-danger text-center" id="alerta6">
						<strong>Atenci&oacute;n:</strong> debe ingresar una calificaci&oacute;n entre 1 y 10.
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form-group">
					<label for="calif_curso" class="control-label col-xs-9 col-sm-6 col-md-4 col-lg-4 text-left calif_curso">Califique al curso <small>(del 1 al 10)</small>:</label>
					<div class="col-xs-3 col-sm-2 col-md-2 col-lg-1"><input class="form-control" name="calif_curso" type="text" pattern="[0-9]{1,2}" id="calif_curso" onchange="sacarColor('calif_curso','alerta5')" value="<?php echo ""; ?>" maxlength="2" minlength="1" required title="Ingrese un puntaje del 1 al 10"/></div>
					<div class="clearfix visible-xs-block"></div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<legend><h4 class="text-left">Sugerencias / Observaciones</h4></legend>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<textarea class="form-control" name="observa" rows="3" title="Sugerencias que desee realizar para mejorar el dictado de los cursos"></textarea>
					</div>
				</div>
			</div>

			<div class="page-header superior2"></div>
				<footer><div class="container"><h3 class="text-center">Muchas gracias por el tiempo dedicado a responder la presente encuesta!!</h3></div></footer>
			<div class="page-header inferior2"></div>

			<div class="row">
				<div class="form-group">
					<p>
						<center><button type="submit" class="btn btn-default" title="Enviar encuesta">Enviar</button></center>
					</p>
				</div>
			</div>
		
	</form>
		</div>
	</div>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="jquery-latest.js"></script>
<script type="text/javascript" src="jquery.validate.js"></script>
	<title>Registro Necesarios</title>
	<style type="text/css">
		{font-family: Arial }		
		form {padding: 20px; border: 1px Solid #D8D8D8;background: #F2F2F2; font-size: 0.9em;}
		label {color: #336699; font-family: Arial;}
    </style>

		<script>
			$(document).ready(function(){
			$('form').validate();
			
			
		});
		
		function evaluaring(academico){
			document.f1.submit(); 
		}
		
		
		</script>

</head>

<body>
<?php
$curso1 = $_REQUEST['cursoF'];
$curso2 = $_REQUEST['cursoF1'];

if ($curso1 == NULL && $curso2 != NULL){
	$curso_fk = $curso2;
}
if ($curso2 == NULL && $curso1 != NULL){
	$curso_fk = $curso1;
}
include_once "conexionCursosExtension.php";

		$sqlLRN = pg_query("SELECT * FROM listado_registros_necesarios WHERE curso_fk = $curso_fk");
		$rowLRN = pg_fetch_array($sqlLRN);
			//$cursoF = $rowLRN['curso_fk'];
			$temario_general_curso = $rowLRN['temario_general_curso'];
			$planificacion_curso = $rowLRN['planificacion_curso'];
			$cotizacion_curso = $rowLRN['cotizacion_curso'];
			$no_esta_cotizacion_curso = $rowLRN['no_esta_cotizacion_curso'];
			$convenio_curso = $rowLRN['convenio_curso'];
			$no_esta_convenio_curso = $rowLRN['no_esta_convenio_curso'];
			$convenio_docente_curso = $rowLRN['convenio_docente_curso'];
			$no_esta_convenio_docente_curso = $rowLRN['no_esta_convenio_docente_curso'];
			$planilla_inscripcion_curso = $rowLRN['planilla_inscripcion_curso'];
			$planilla_asistencia = $rowLRN['planilla_asistencia'];
			$encuesta_satisfaccion = $rowLRN['encuesta_satisfaccion'];
			$acta_examen = $rowLRN['acta_examen'];
			$planilla_entrega_certificados = $rowLRN['planilla_entrega_certificados'];
			$validacion_curso_jornada = $rowLRN['validacion_curso_jornada'];
			$certificado_aprobacion = $rowLRN['certificado_aprobacion'];
			$certificado_asistencia = $rowLRN['certificado_asistencia'];
			$certificado_reconocimiento_docente = $rowLRN['certificado_reconocimiento_docente'];
			
?>


<form class="formRegistros" name="f1" id="form" action="" method="post">
<fieldset id="tabla">
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Seleccione un curso</FONT></legend>
<table width="100%">
	<tr>
		<td>
			<label for="cTemario">Curso: </label>
			<select name="cursoF1" size="1" class="myTextField" id="cursoF" onChange="evaluaring()"  onkeyup=fn(this.form,this)>
            <option value="0" selected="selected">Seleccione el Curso</option>
				<?php
					include_once "conexionCursosExtension.php";
					$cursoA = date('Y');
					$consultaCurso=pg_query("SELECT id_cursos,nombre,anio FROM cursos WHERE activado='t' AND anio='$cursoA' ORDER BY nombre");
					while($rowCurso=pg_fetch_array($consultaCurso)){
						if ($curso_fk == $rowCurso['id_cursos']){
							echo "<option value=".$rowCurso['id_cursos']." selected>".$rowCurso['nombre']."</option>";
						}else{
							echo "<option value=".$rowCurso['id_cursos'].">".$rowCurso['nombre']."</option>";
						}
					}
				?>	
			</select>
		</td>
	</tr>
</table>
</fieldset>
</form>
<form class="formRegistros" name="f2" id="form" action="registrarDatos.php?cursoF=<?php echo $curso_fk; ?>" method="post">
<fieldset id="tabla">
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Seleccione los registros del curso</FONT></legend>
<table width="100%">
<tbody valign="middle">
	<tr>
		<td width="60%">
			<label for="cTemario">Temario general del Curso y/o Jornada: </label>
		</td>
		<td align="center">
			<?php
				if ($temario_general_curso == "on"){
					echo '<input id="ctemario_general_curso" name="temario_general_curso" type="checkbox" checked/>';
				}else{
					echo '<input id="ctemario_general_curso" name="temario_general_curso" type="checkbox"/>';
				}
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cPlanificacionC">Planificaci&oacute;n de Cursos y Jornadas: </label>
		</td>
		<td align="center">
			<?php
				if ($planificacion_curso == "on"){
					echo '<input id="cplanificacion_curso" name="planificacion_curso"  type="checkbox" checked/>';
				}else{
					echo '<input id="cplanificacion_curso" name="planificacion_curso"  type="checkbox"/>';
				}
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cCotizacionC">Cotizaci&oacute; Curso o Jornada: </label>
		</td>
		<td align="center">
			<?php
				if ($cotizacion_curso == "on"){
					echo '<input id="ccotizacion_curso" name="cotizacion_curso"  type="checkbox" checked/>';
				}else{
					echo '<input id="ccotizacion_curso" name="cotizacion_curso"  type="checkbox"/>';
				}
			?>
		</td>
		<td>
			<label for="cNoVaC">No va: </label>
			<?php
				if ($no_esta_cotizacion_curso == "on"){
					echo '<input id="cno_esta_cotizacion_curso" name="no_esta_cotizacion_curso"  type="checkbox" checked/>';
				}else{
					echo '<input id="cno_esta_cotizacion_curso" name="no_esta_cotizacion_curso"  type="checkbox"/>';
				}
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cConvenioC">Convenio Curso o Jornada: </label>
		</td>
		<td align="center">
			<?php
				if ($convenio_curso == "on"){
					echo '<input id="cconvenio_curso" name="convenio_curso"  type="checkbox" checked/>';
				}else{
					echo '<input id="cconvenio_curso" name="convenio_curso"  type="checkbox"/>';
				}
			?>
		</td>
		<td>
			<label for="cNoVaConvenio">No va: </label>
			<?php
				if ($no_esta_convenio_curso == "on"){
					echo '<input id="cno_esta_convenio_curso" name="no_esta_convenio_curso"  type="checkbox" checked/>';
				}else{
					echo '<input id="cno_esta_convenio_curso" name="no_esta_convenio_curso"  type="checkbox"/>';
				}
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cConvenioD">Convenio docente Curso o Jornada: </label>
		</td>
		<td align="center">
			<?php
				if ($convenio_docente_curso == "on"){
					echo '<input id="cconvenio_docente_curso" name="convenio_docente_curso"  type="checkbox" checked/>';
				}else{
					echo '<input id="cconvenio_docente_curso" name="convenio_docente_curso"  type="checkbox"/>';
				}
			?>
		</td>
		<td>
			<label for="cNoVaConvenioD">No va: </label>
			<?php
				if ($no_esta_convenio_docente_curso == "on"){
					echo '<input id="cno_esta_convenio_docente_curso" name="no_esta_convenio_docente_curso"  type="checkbox" checked/>';
				}else{
					echo '<input id="cno_esta_convenio_docente_curso" name="no_esta_convenio_docente_curso"  type="checkbox"/>';
				}
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cPlantillaI">Plantilla de inscripci&oacute;n Curso o Jornada: </label>
		</td>
		<td align="center">
			<?php
				if ($planilla_inscripcion_curso == "on"){
					echo '<input id="cplanilla_inscripcion_curso" name="planilla_inscripcion_curso"  type="checkbox" checked/>';
				}else{
					echo '<input id="cplanilla_inscripcion_curso" name="planilla_inscripcion_curso"  type="checkbox"/>';
				}
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cPlantillaA">Plantilla de asistencia: </label>
		</td>
		<td align="center">
			<?php
				if ($planilla_asistencia == "on"){
					echo '<input id="cplanilla_asistencia" name="planilla_asistencia"  type="checkbox" checked/>';
				}else{
					echo '<input id="cplanilla_asistencia" name="planilla_asistencia"  type="checkbox"/>';
				}
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cEncuestaS">Encuesta de satisfacci&oacute;n: </label>
		</td>
		<td align="center">
			<?php
				if ($encuesta_satisfaccion == "on"){
					echo '<input id="cencuesta_satisfaccion" name="encuesta_satisfaccion"  type="checkbox" checked/>';
				}else{
					echo '<input id="cencuesta_satisfaccion" name="encuesta_satisfaccion"  type="checkbox"/>';
				}
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cActaE">Acta de examen: </label>
		</td>
		<td align="center">
			<?php
				if ($acta_examen == "on"){
					echo '<input id="cacta_examen" name="acta_examen"  type="checkbox" checked/>';
				}else{
					echo '<input id="cacta_examen" name="acta_examen"  type="checkbox"/>';
				}
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cPlanillaE">Planilla de entrega de certificados: </label>
		</td>
		<td align="center">
			<?php
				if ($planilla_entrega_certificados == "on"){
					echo '<input id="cplanilla_entrega_certificados" name="planilla_entrega_certificados"  type="checkbox" checked/>';
				}else{
					echo '<input id="cplanilla_entrega_certificados" name="planilla_entrega_certificados"  type="checkbox"/>';
				}
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cValidacionC">Validaci&oacute;n del Curso o Jornada: </label>
		</td>
		<td align="center">
			<?php
				if ($validacion_curso_jornada == "on"){
					echo '<input id="cvalidacion_curso_jornada" name="validacion_curso_jornada"  type="checkbox" checked/>';
				}else{
					echo '<input id="cvalidacion_curso_jornada" name="validacion_curso_jornada"  type="checkbox"/>';
				}
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cCertificadoA">Certificado de Aprobaci&oacute;n: </label>
		</td>
		<td align="center">
			<?php
				if ($certificado_aprobacion == "on"){
					echo '<input id="ccertificado_aprobacion" name="certificado_aprobacion"  type="checkbox" checked/>';
				}else{
					echo '<input id="ccertificado_aprobacion" name="certificado_aprobacion"  type="checkbox"/>';
				}
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cCertificadoAsist">Certificado de Asistencia: </label>
		</td>
		<td align="center">
			<?php
				if ($certificado_asistencia == "on"){
					echo '<input id="ccertificado_asistencia" name="certificado_asistencia"  type="checkbox" checked/>';
				}else{
					echo '<input id="ccertificado_asistencia" name="certificado_asistencia"  type="checkbox"/>';
				}
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cCertificadoR">Certificado de reconocimiento al Docente: </label>
		</td>
		<td align="center">
			<?php
				if ($certificado_reconocimiento_docente == "on"){
					echo '<input id="ccertificado_reconocimiento_docente" name="certificado_reconocimiento_docente"  type="checkbox" checked/>';
				}else{
					echo '<input id="ccertificado_reconocimiento_docente" name="certificado_reconocimiento_docente"  type="checkbox"/>';
				}
			?>
		</td>
	</tr>
	</tbody>
</table>
		<p>
			<input class="submit" type="submit" value="Guardar"/>
			<a href="listadodecursos.php"><input type="button" value="Atr&aacute;s"/></a>
		</p>
</form>
</fieldset>
</body>
</html>
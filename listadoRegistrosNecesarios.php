<html>
<head>
<title> Listado de Registros </title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<style type="text/css">
	label {font-family: Arial; text-transform: capitalize; padding: .5em; color: #0080FF;}
	leer {font-family: Arial; padding: .5em; font-size: 0.9em;}
	#tabla {background: #F2F2F2;}
	#titulo3 { border-top: 2px solid #BDBDBD;border-bottom: 2px solid #BDBDBD;padding: 3px;}
	l1 {font-family: Arial;color: #0B615E; text-transform: capitalize; font-size: 1.5em;}
	l2 {font-family: Arial;color: #424242; text-transform: capitalize; padding: .12em;}
</style>
</head>
<body link="#000000" vlink="#000000" alink="#FFFFFF">
<table align="center" cellspacing="1" cellpadding="4" border="1" bgcolor=#585858 id="tabla">
	<tr bgcolor="#FFFFFF">
		<td id="titulo3" colspan="2" align="center"><l1>Listado de Registros Necesarios de los Cursos</l1></td>
	</tr>
	<tr>
		<td align="center"><strong><leer>RE1-PE1-02-01</leer></strong></td>
		<td align="center"><leer>Temario general del curso y/o jornada</leer></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td align="center"><strong><leer>RE1-PE1-02-02</leer></strong></td>
		<td align="center"><leer>Planificac&iacute;n de cursos y/o jornadas</leer></td>
	</tr>
	<tr>
		<td align="center"><strong><leer>RE1-PE1-02-03</leer></strong></td>
		<td align="center"><leer>Cotizaci&oacute;n curso o jornada</leer></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td align="center"><strong><leer>RE1-PE1-02-04</leer></strong></td>
		<td align="center"><leer>Convenio curso o jornada</leer></td>
	</tr>
	<tr>
		<td align="center"><strong><leer>RE1-PE1-02-05</leer></strong></td>
		<td align="center"><leer>Convenio docente curso o jornada</leer></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td align="center"><strong><leer>RE1-PE1-02-06</leer></strong></td>
		<td align="center"><leer>Planilla de inscripci&oacute;n curso o jornada</leer></td>
	</tr>
	<tr>
		<td align="center"><strong><leer>RE1-PE1-02-07</leer></strong></td>
		<td align="center"><leer>Planilla de asistencia</leer></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td align="center"><strong><leer>RE1-PE1-02-08</leer></strong></td>
		<td align="center"><leer>Encuesta de satisfacci&oacute;n</leer></td>
	</tr>
	<tr>
		<td align="center"><strong><leer>RE1-PE1-02-09</leer></strong></td>
		<td align="center"><leer>Acta de examen</leer></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td align="center"><strong><leer>RE1-PE1-02-10</leer></strong></td>
		<td align="center"><leer>Planilla de entrega de certificados</leer></td>
	</tr>
	<tr>
		<td align="center"><strong><leer>RE1-PE1-02-11</leer></strong></td>
		<td align="center"><leer>Validaci&oacute;n del Curso o Jornada</leer></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td align="center"><strong><leer>Cert. Aprob.</leer></strong></td>
		<td align="center"><leer>Certificado de aprobaci&oacute;n</leer></td>
	</tr>
	<tr>
		<td align="center"><strong><leer>Cert. Asist.</leer></strong></td>
		<td align="center"><leer>Certificado de asistencia</leer></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td align="center"><strong><leer>Cert. Rec. Doc.</leer></strong></td>
		<td align="center"><leer>Certificado de reconocimiento al docente</leer></td>
	</tr>
</table>
<br>
<?php
include_once "conexionCursosExtension.php";
$val = pg_query("SELECT id_listado_registros_necesarios,curso_fk,temario_general_curso,planificacion_curso,cotizacion_curso,no_esta_cotizacion_curso,convenio_curso,no_esta_convenio_curso,convenio_docente_curso,no_esta_convenio_docente_curso,planilla_inscripcion_curso,planilla_asistencia,encuesta_satisfaccion,acta_examen,planilla_entrega_certificados,validacion_curso_jornada,certificado_aprobacion,certificado_asistencia,certificado_reconocimiento_docente,nombre,id_cursos FROM listado_registros_necesarios INNER JOIN cursos ON(cursos.id_cursos = listado_registros_necesarios.curso_fk) ORDER BY nombre,id_cursos ASC");
echo '<table align="center" cellspacing="1" cellpadding="4" border="1" width="100%" bgcolor=#585858 id="tabla">';
	echo '<tr bgcolor="#FFFFFF" width="100%">';
		echo '<td id="titulo3" colspan="15" align="center" width="100%"><l1>Listado de Registros Necesarios de los Cursos</l1></td>';
	echo '</tr>';
	echo '<tr bgcolor="#000000" width="100%">';
		echo '<td align="center" width="30%"><strong><label>Curso</label></strong></td>';
		echo '<td align="center" width="5%"><strong><label>RE1-PE1-02-01</label></strong></td>';
		echo '<td align="center" width="5%"><strong><label>RE1-PE1-02-02</label></strong></td>';
		echo '<td align="center" width="5%"><strong><label>RE1-PE1-02-03</label></strong></td>';
		echo '<td align="center" width="5%"><strong><label>RE1-PE1-02-04</label></strong></td>';
		echo '<td align="center" width="5%"><strong><label>RE1-PE1-02-05</label></strong></td>';
		echo '<td align="center" width="5%"><strong><label>RE1-PE1-02-06</label></strong></td>';
		echo '<td align="center" width="5%"><strong><label>RE1-PE1-02-07</label></strong></td>';
		echo '<td align="center" width="5%"><strong><label>RE1-PE1-02-08</label></strong></td>';
		echo '<td align="center" width="5%"><strong><label>RE1-PE1-02-09</label></strong></td>';
		echo '<td align="center" width="5%"><strong><label>RE1-PE1-02-10</label></strong></td>';
		echo '<td align="center" width="5%"><strong><label>RE1-PE1-02-11</label></strong></td>';
		echo '<td align="center" width="5%"><strong><label>Cert. Aprob.</label></strong></td>';
		echo '<td align="center" width="5%"><strong><label>Cert. Asist.</label></strong></td>';
		echo '<td align="center" width="5%"><strong><label>Cert. Rec. Doc.</label></strong></td>';
	echo '</tr>';
while($row=pg_fetch_array($val,NULL,PGSQL_ASSOC)){
	$on = 'on';
	echo '<tr>';
		echo '<td align="center"><a href="registrosNecesarios.php?cursoF='.$row['id_cursos'].'"style="text-decoration:none"><l2>'.$row['nombre'].'</l2></a></td>';
		if ($row['temario_general_curso'] == $on){
			echo '<td align="center"><l2>Si</l2></td>';
		}else{
			echo '<td align="center"><l2>Falta</l2></td>';
		}
		if ($row['planificacion_curso'] == $on){
			echo '<td align="center"><l2>Si</l2></td>';
		}else{
			echo '<td align="center"><l2>Falta</l2></td>';
		}
		if ($row['no_esta_cotizacion_curso'] == $on){
				echo '<td align="center"><l2>No va</l2></td>';
		}else{
			if ($row['cotizacion_curso'] == $on){
				echo '<td align="center"><l2>Si</l2></td>';
			}else{
				echo '<td align="center"><l2>Falta</l2></td>';
			}
		}
		if ($row['no_esta_convenio_curso'] == $on){
				echo '<td align="center"><l2>No va</l2></td>';
		}else{
			if ($row['convenio_curso'] == $on){
				echo '<td align="center"><l2>Si</l2></td>';
			}else{
				echo '<td align="center"><l2>Falta</l2></td>';
			}
		}
		if ($row['no_esta_convenio_docente_curso'] == $on){
				echo '<td align="center"><l2>No va</l2></td>';
		}else{
			if ($row['convenio_docente_curso'] == $on){
				echo '<td align="center"><l2>Si</l2></td>';
			}else{
				echo '<td align="center"><l2>Falta</l2></td>';
			}
		}
		if ($row['planilla_inscripcion_curso'] == $on){
			echo '<td align="center"><l2>Si</l2></td>';
		}else{
			echo '<td align="center"><l2>Falta</l2></td>';
		}
		if ($row['planilla_asistencia'] == $on){
			echo '<td align="center"><l2>Si</l2></td>';
		}else{
			echo '<td align="center"><l2>Falta</l2></td>';
		}
		if ($row['encuesta_satisfaccion'] == $on){
			echo '<td align="center"><l2>Si</l2></td>';
		}else{
			echo '<td align="center"><l2>Falta</l2></td>';
		}
		if ($row['acta_examen'] == $on){
			echo '<td align="center"><l2>Si</l2></td>';
		}else{
			echo '<td align="center"><l2>Falta</l2></td>';
		}
		if ($row['planilla_entrega_certificados'] == $on){
			echo '<td align="center"><l2>Si</l2></td>';
		}else{
			echo '<td align="center"><l2>Falta</l2></td>';
		}
		if ($row['validacion_curso_jornada'] == $on){
			echo '<td align="center"><l2>Si</l2></td>';
		}else{
			echo '<td align="center"><l2>Falta</l2></td>';
		}
		if ($row['certificado_aprobacion'] == $on){
			echo '<td align="center"><l2>Si</l2></td>';
		}else{
			echo '<td align="center"><l2>Falta</l2></td>';
		}
		if ($row['certificado_asistencia'] == $on){
			echo '<td align="center"><l2>Si</l2></td>';
		}else{
			echo '<td align="center"><l2>Falta</l2></td>';
		}
		if ($row['certificado_reconocimiento_docente'] == $on){
			echo '<td align="center"><l2>Si</l2></td>';
		}else{
			echo '<td align="center"><l2>Falta</l2></td>';
		}
	echo '</tr>';
}
echo '</table>';
?>
<br>
<center>
<table>
	<tr>
		<td><a href="registrosNecesarios.php"><center><input type="button" value="Atr&aacute;s"></center></a></td>
		<td>&nbsp;</td>
		<td><a href="listadoRegistrosNecesariosExcel.php"><input type="button" value="Generar Excel"/></a></td>
	</tr>
</table>
</center>
</body>
</html>
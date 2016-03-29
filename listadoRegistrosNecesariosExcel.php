<?
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=listadoRegistrosNecesarios.xls");

?>
<html>
<head>
<title> Listado de Registros </title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
</head>
<body link="#000000" vlink="#000000" alink="#FFFFFF">
<basefont color="#424242" size="4" face="Arial">
<table align="center" cellspacing="1" cellpadding="4" width="100%" border="1" bgcolor="#E6E6E6">
	<tr bgcolor="#FFFFFF" width="100%">
		<td id="titulo3" colspan="2" align="center"><FONT size="5" color="#0B615E"><b>Listado de Registros Necesarios de los Cursos</b></FONT></td>
	</tr>
	<tr width="100%">
		<td align="center" width="30%"><FONT size="3" face="Arial"><b>RE1-PE1-02-01</b></FONT></td>
		<td align="center" width="70%"><FONT size="3" face="Arial">Temario general del curso y/o jornada</FONT></td>
	</tr>
	<tr bgcolor="#FFFFFF" width="100%">
		<td align="center" width="30%"><FONT size="3" face="Arial"><b>RE1-PE1-02-02</b></FONT></td>
		<td align="center" width="70%"><FONT size="3" face="Arial">Planificaci&oacute;n de cursos y/o jornadas</FONT></td>
	</tr>
	<tr width="100%">
		<td align="center" width="30%"><FONT size="3" face="Arial"><b>RE1-PE1-02-03</b></FONT></td>
		<td align="center" width="70%"><FONT size="3" face="Arial">Cotizaci&oacute;n curso o jornada</FONT></td>
	</tr>
	<tr bgcolor="#FFFFFF" width="100%">
		<td align="center" width="30%"><FONT size="3" face="Arial"><b>RE1-PE1-02-04</b></FONT></td>
		<td align="center" width="70%"><FONT size="3" face="Arial">Convenio curso o jornada</FONT></td>
	</tr>
	<tr width="100%">
		<td align="center" width="30%"><FONT size="3" face="Arial"><b>RE1-PE1-02-05</b></FONT></td>
		<td align="center" width="70%"><FONT size="3" face="Arial">Convenio docente curso o jornada</FONT></td>
	</tr>
	<tr bgcolor="#FFFFFF" width="100%">
		<td align="center" width="30%"><FONT size="3" face="Arial"><b>RE1-PE1-02-06</b></FONT></td>
		<td align="center" width="70%"><FONT size="3" face="Arial">Planilla de inscripci&oacute;n curso o jornada</FONT></td>
	</tr>
	<tr width="100%">
		<td align="center" width="30%"><FONT size="3" face="Arial"><b>RE1-PE1-02-07</b></FONT></td>
		<td align="center" width="70%"><FONT size="3" face="Arial">Planilla de asistencia</FONT></td>
	</tr>
	<tr bgcolor="#FFFFFF" width="100%">
		<td align="center" width="30%"><FONT size="3" face="Arial"><b>RE1-PE1-02-08</b></FONT></td>
		<td align="center" width="70%"><FONT size="3" face="Arial">Encuesta de satisfacci&oacute;n</FONT></td>
	</tr>
	<tr width="100%">
		<td align="center" width="30%"><FONT size="3" face="Arial"><b>RE1-PE1-02-09</b></FONT></td>
		<td align="center" width="70%"><FONT size="3" face="Arial">Acta de examen</FONT></td>
	</tr>
	<tr bgcolor="#FFFFFF" width="100%">
		<td align="center" width="30%"><FONT size="3" face="Arial"><b>RE1-PE1-02-10</b></FONT></td>
		<td align="center" width="70%"><FONT size="3" face="Arial">Planilla de entrega de certificados</FONT></td>
	</tr>
	<tr width="100%">
		<td align="center" width="30%"><FONT size="3" face="Arial"><b>RE1-PE1-02-11</b></FONT></td>
		<td align="center" width="70%"><FONT size="3" face="Arial">Validaci&oacute;n del Curso o Jornada</FONT></td>
	</tr>
	<tr bgcolor="#FFFFFF" width="100%">
		<td align="center" width="30%"><FONT size="3" face="Arial"><b>Cert. Aprob.</b></FONT></td>
		<td align="center" width="70%"><FONT size="3" face="Arial">Certificado de aprobaci&oacute;n</FONT></td>
	</tr>
	<tr width="100%">
		<td align="center" width="30%"><FONT size="3" face="Arial"><b>Cert. Asist.</b></FONT></td>
		<td align="center" width="70%"><FONT size="3" face="Arial">Certificado de asistencia</FONT></td>
	</tr>
	<tr bgcolor="#FFFFFF" width="100%">
		<td align="center" width="30%"><FONT size="3" face="Arial"><b>Cert. Rec. Doc.</b></FONT></td>
		<td align="center" width="70%"><FONT size="3" face="Arial">Certificado de reconocimiento al docente</FONT></td>
	</tr>
</table>
<br>
<?php
include_once "conexionCursosExtension.php";
$val = pg_query("SELECT id_listado_registros_necesarios,curso_fk,temario_general_curso,planificacion_curso,cotizacion_curso,no_esta_cotizacion_curso,convenio_curso,no_esta_convenio_curso,convenio_docente_curso,no_esta_convenio_docente_curso,planilla_inscripcion_curso,planilla_asistencia,encuesta_satisfaccion,acta_examen,planilla_entrega_certificados,validacion_curso_jornada,certificado_aprobacion,certificado_asistencia,certificado_reconocimiento_docente,nombre,id_cursos FROM listado_registros_necesarios INNER JOIN cursos ON(cursos.id_cursos = listado_registros_necesarios.curso_fk) ORDER BY nombre,id_cursos ASC");
echo '<table align="center" cellspacing="1" cellpadding="2" border="1" width="100%">';
	echo '<tr bgcolor="#E6E6E6" width="100%">';
		echo '<td align="center" width="30%"><FONT size="3" color="#000000" face="Arial"><b>Curso</b></FONT></td>';
		echo '<td align="center" width="5%"><FONT size="3" color="#000000" face="Arial"><b>RE1-PE1-02-01</b></FONT></td>';
		echo '<td align="center" width="5%"><FONT size="3" color="#000000" face="Arial"><b>RE1-PE1-02-02</b></FONT></td>';
		echo '<td align="center" width="5%"><FONT size="3" color="#000000" face="Arial"><b>RE1-PE1-02-03</b></FONT></td>';
		echo '<td align="center" width="5%"><FONT size="3" color="#000000" face="Arial"><b>RE1-PE1-02-04</b></FONT></td>';
		echo '<td align="center" width="5%"><FONT size="3" color="#000000" face="Arial"><b>RE1-PE1-02-05</b></FONT></td>';
		echo '<td align="center" width="5%"><FONT size="3" color="#000000" face="Arial"><b>RE1-PE1-02-06</b></FONT></td>';
		echo '<td align="center" width="5%"><FONT size="3" color="#000000" face="Arial"><b>RE1-PE1-02-07</b></FONT></td>';
		echo '<td align="center" width="5%"><FONT size="3" color="#000000" face="Arial"><b>RE1-PE1-02-08</b></FONT></td>';
		echo '<td align="center" width="5%"><FONT size="3" color="#000000" face="Arial"><b>RE1-PE1-02-09</b></FONT></td>';
		echo '<td align="center" width="5%"><FONT size="3" color="#000000" face="Arial"><b>RE1-PE1-02-10</b></FONT></td>';
		echo '<td align="center" width="5%"><FONT size="3" color="#000000" face="Arial"><b>RE1-PE1-02-11</b></FONT></td>';
		echo '<td align="center" width="5%"><FONT size="3" color="#000000" face="Arial"><b>Cert. Aprob.</b></FONT></td>';
		echo '<td align="center" width="5%"><FONT size="3" color="#000000" face="Arial"><b>Cert. Asist.</b></FONT></td>';
		echo '<td align="center" width="5%"><FONT size="3" color="#000000" face="Arial"><b>Cert. Rec. Doc.</b></FONT></td>';
	echo '</tr>';
while($row=pg_fetch_array($val,NULL,PGSQL_ASSOC)){
	$on = 'on';
	echo '<tr>';
		echo '<td align="left">'.$row['nombre'].'</a></td>';
		if ($row['temario_general_curso'] == $on){
			echo '<td align="center">Si</td>';
		}else{
			echo '<td align="center">Falta</td>';
		}
		if ($row['planificacion_curso'] == $on){
			echo '<td align="center">Si</td>';
		}else{
			echo '<td align="center">Falta</td>';
		}
		if ($row['no_esta_cotizacion_curso'] == $on){
				echo '<td align="center">No va</td>';
		}else{
			if ($row['cotizacion_curso'] == $on){
				echo '<td align="center">Si</td>';
			}else{
				echo '<td align="center">Falta</td>';
			}
		}
		if ($row['no_esta_convenio_curso'] == $on){
				echo '<td align="center">No va</td>';
		}else{
			if ($row['convenio_curso'] == $on){
				echo '<td align="center">Si</td>';
			}else{
				echo '<td align="center">Falta</td>';
			}
		}
		if ($row['no_esta_convenio_docente_curso'] == $on){
				echo '<td align="center">No va</td>';
		}else{
			if ($row['convenio_docente_curso'] == $on){
				echo '<td align="center">Si</td>';
			}else{
				echo '<td align="center">Falta</td>';
			}
		}
		if ($row['planilla_inscripcion_curso'] == $on){
			echo '<td align="center">Si</td>';
		}else{
			echo '<td align="center">Falta</td>';
		}
		if ($row['planilla_asistencia'] == $on){
			echo '<td align="center">Si</td>';
		}else{
			echo '<td align="center">Falta</td>';
		}
		if ($row['encuesta_satisfaccion'] == $on){
			echo '<td align="center">Si</td>';
		}else{
			echo '<td align="center">Falta</td>';
		}
		if ($row['acta_examen'] == $on){
			echo '<td align="center">Si</td>';
		}else{
			echo '<td align="center">Falta</td>';
		}
		if ($row['planilla_entrega_certificados'] == $on){
			echo '<td align="center">Si</td>';
		}else{
			echo '<td align="center">Falta</td>';
		}
		if ($row['validacion_curso_jornada'] == $on){
			echo '<td align="center">Si</td>';
		}else{
			echo '<td align="center">Falta</td>';
		}
		if ($row['certificado_aprobacion'] == $on){
			echo '<td align="center">Si</td>';
		}else{
			echo '<td align="center">Falta</td>';
		}
		if ($row['certificado_asistencia'] == $on){
			echo '<td align="center">Si</td>';
		}else{
			echo '<td align="center">Falta</td>';
		}
		if ($row['certificado_reconocimiento_docente'] == $on){
			echo '<td align="center">Si</td>';
		}else{
			echo '<td align="center">Falta</td>';
		}
	echo '</tr>';
}
echo '</table>';
?>
</body>
</html>
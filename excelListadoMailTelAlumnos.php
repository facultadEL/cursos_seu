<?
header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-disposition: attachment;filename=TotalCobradoPorAño.xls");
?>
<script>
function NO_letra(e){
	key=(document.all) ? e.keyCode : e.which;
	if( e.which == 0 ){return true;}
	if ((key > 47 && key < 58 ) || (key == 8)){
	  return true;
	}
	return false;
}//fin funcion
function NO_letra2(e){
	key=(document.all) ? e.keyCode : e.which;
	if( e.which == 0 ){return true;}
	if (key > 47 && key < 58 ) {	
		return false;
	}
	return true;
}
function evaluaring(academico){
	document.form1.submit(); 
}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script src="jquery-latest.js"></script>
	<script type="text/javascript" src="jquery.validate.js"></script>
	<title>Correos electr&oacute;nicos y Tel&eacute;fonos</title>
	<style type="text/css">
		{font-family: Cambria }
			form {padding: 20px; border: 1px Solid #D8D8D8;background: #F2F2F2;}
			label {width: 10em;color: #336699; float: left;margin-right: 30px; align:center; font-family: Cambria; padding-left: .5em;}
			label.error {font-family: Cambria;float: none;vertical-align: top;color: red;padding-left: .5em;}
    </style>
</head>
<body onLoad="tunCalendario();">
<table width="100%"  border="1" align="center">
<form id="form1" name="form1" method="post" action="">
	<tr>
		<td height="23" align="center" colspan="4"><label for="correosytel">Correos electr&oacute;nico y Tel&eacute;fonos de Alumnos por Curso</label></td>
	</tr>
<?
include "conexionCursosExtension.php";
$cursoA = $_REQUEST['anio'];
$cursoF = $_REQUEST['curso'];
				
	if 	(( $cursoF!=0 && $cursoA !=0)){
		$sqlInscriptos =  pg_query("SELECT id_inscripto, inscripto.nombre, apellido, telfijo, mail, telcel FROM inscripto FULL OUTER JOIN inscriptosxcurso ON(inscriptosxcurso.fk_inscriptos = inscripto.id_inscripto) FULL OUTER JOIN cursos ON(cursos.id_cursos = inscriptosxcurso.fk_curso) WHERE cursos.id_cursos=$cursoF AND cursos.anio=$cursoA AND activado='t' ORDER BY inscripto.nombre ASC;");
	}
?>
</form>
<form id="form1" name="form2" method="post" action="">
    <table width="100%" border="1">
		<tr>
			<td width="10%" align="center" bgcolor="#666666"><label for="correosytel">Alumno</label></td>
			<td width="10%" align="center" bgcolor="#666666"><label for="correosytel">Tel&eacute;fono Fijo</label></td>
			<td width="10%" align="center" bgcolor="#666666"><label for="correosytel">Tel&eacute;fono Celular</label></td>
			<td width="10%" align="center" bgcolor="#666666"><label for="correosytel">Mail</label></td>
		</tr>
<?php
$var=0;
if (($cursoF!=0)){
while($row29 = pg_fetch_array($sqlInscriptos)){
	$nombre_alumno = $row29['nombre'];
	$apellido_alumno = $row29['apellido'];
	$tel_fijo_alumno = $row29['telfijo'];
	$tel_cel_alumno = $row29['telcel'];
	$mail_alumno = $row29['mail'];	

	if ($var==0){
		$color='bgcolor="#FFFFFF"';
		$var=1;
	}else{
		$color='bgcolor="#CCCCCC"';
		$var=0;
	}
	echo '<tr>'	;
		echo '<td '.$color.'>';
			echo $nombre_alumno.' '.$apellido_alumno;
		echo '</td>';
		echo '<td '.$color.'>';
			echo $tel_fijo_alumno;
		echo '</td>';
		echo '<td '.$color.'>';
			echo $tel_cel_alumno;
		echo '</td>';
		echo '<td '.$color.'>';
			echo $mail_alumno;
		echo '</td>';
	echo '</tr>';
	}
}
?>
</table>
</form>
</table>
</body>
</html>
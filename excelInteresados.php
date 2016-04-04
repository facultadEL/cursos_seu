<?

header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-disposition: attachment;filename=ListadoInteresados.xls");

?>
<html>
<head>
<title> Seguimiento del alumno </title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<style type="text/css">
	label {font-family: Cambria; text-transform: capitalize; padding: .5em; color: #0080FF;}
	#tabla {background: #F2F2F2;}
	#titulo3 { border-top: 2px solid #BDBDBD;border-bottom: 2px solid #BDBDBD;padding: 3px;}
	#titulo2 { border-top: 2px solid #BDBDBD;border-bottom: 2px solid #BDBDBD;padding: 3px;}
	l1 {font-family: Cambria;color: #0B615E; text-transform: capitalize; font-size: 1.5em;}
	l3 {font-family: Cambria;color: #0040FF; text-transform: capitalize; font-size: 1.5em;}
	l2 {font-family: Cambria;color: #424242; text-transform: capitalize; padding: .12em;}
	a { text-decoration:none }
</style>
</head>
<?php

$data = $_REQUEST['d'];
$vData = explode('/-/-/', $data)

?>
<body link="#000000" vlink="#000000" alink="#FFFFFF">
<?php
echo '<table align="center" cellspacing="1" cellpadding="4" border="1" bgcolor=#585858 id="tabla">';
	echo '<tr bgcolor="#FAFAFA">';
		echo '<td id="titulo3" colspan="7" align="center"><l1>Listado Interesados</l1></td>';
	echo '</tr>';
	echo '<tr bgcolor="#C3C3C3">';
		echo '<td align="center"><strong><label>Nombre</label></strong></td>';
		echo '<td align="center"><strong><label>Telefono 1</label></strong></td>';
		echo '<td align="center"><strong><label>Telefono 2</label></strong></td>';
		echo '<td align="center"><strong><label>Mail</label></strong></td>';
		echo '<td align="center"><strong><label>Localidad</label></strong></td>';
		echo '<td align="center"><strong><label>Cursos</label></strong></td>';
		echo '<td align="center"><strong><label>Fecha Registro</label></strong></td>';
	echo '</tr>';
	for($i = 0; $i < count($vData);$i++)
	{
		echo '<tr>';
		$vA = explode('/-/',$vData[$i]);
		for($j = 0; $j < count($vA);$j++)
		{
			echo '<td align="center"><l2>'.$vA[$j].'</l2></td>';
		}
		echo '</tr>';
	}
echo '</table>';
?>
</body>
</html>
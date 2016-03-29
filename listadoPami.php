<html>
<head>
<title> Listado de Alumnos Cursos PAMI </title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<style type="text/css">
	label {font-family: Arial; text-transform: capitalize; padding: .5em; color: #0080FF;}
	#tabla {background: #F2F2F2;}
	#titulo3 { border-top: 2px solid #BDBDBD;border-bottom: 2px solid #BDBDBD;padding: 3px;}
	l1 {font-family: Arial;color: #0B615E; text-transform: capitalize; font-size: 0.9em;}
	l2 {font-family: Arial;color: #424242; text-transform: capitalize; padding: .12em;}
</style>
	<script>
		$(document).ready(function(){
		
		$.validator.addClassRules("rango", {range:[0,6]});
		$.validator.addClassRules("min", {minlength: 8});
		$.validator.addClassRules("minimo", {minlength: 2});
		$.validator.addClassRules("numCuil", {minlength: 7});
		$.validator.addClassRules("digitoCuil", {minlength: 1});
		$.validator.addClassRules("anio", {minlength: 4});
		$.validator.addClassRules("caracteristica", {minlength: 3});
		$.validator.addClassRules("telFijo", {minlength: 6});
		
		$('form').validate();
		$("#form1").validate();
		$("#form2").validate();
		
		
	});
	
	function evaluaring(academico){
		document.buscador.submit(); 
	}
	</script>
</head>
<body link="#000000" vlink="#000000" alink="#FFFFFF">
<?php
$cursoF = $_REQUEST['cursoF'];
include_once "conexionCursosExtension.php";
?>
<form class="buscador" id="buscador" name="buscador" action="" method="post">
<fieldset id="tabla">
<legend><FONT face="Arial" size="4" color="#6E6E6E">Elegir un curso</FONT></legend>
<center>
	<table align="center" cellspacing="1" width="100%" cellpadding="4" bgcolor="#585858" id="tabla1">
		<tr width="100%">
			<td width="10%"><label>Curso: </label></td>
			<td width="90%">
				<select name="cursoF" size="1" class="myTextField" id="cgrupoBuscar" onChange="evaluaring()"  onkeyup=fn(this.form,this)>
				<option value="0">Seleccione un curso</option>
				<?php
					
					$sqlCursos = pg_query("SELECT id_cursos,nombre FROM cursos WHERE UPPER(nombre) LIKE UPPER('%PAMI%') AND activado IS TRUE ORDER BY nombre");
					while($rowCursos = pg_fetch_array($sqlCursos)){
						$idCurso = $rowCursos['id_cursos'];
						if ($cursoF == $idCurso){
							echo "<option value=".$idCurso." selected>".$rowCursos['nombre']."</option>";
						}else{
							echo "<option value=".$idCurso.">".$rowCursos['nombre']."</option>";
						}
					}
				?>
				</select>
			</td>
		</tr>
	</table>
</center>
</fieldset>
</form>
<fieldset id="tabla">
<legend><FONT face="Arial" size="4" color="#6E6E6E">Alumnos de cursos PAMI</FONT></legend>
<?php
$sqlCantAlumnos = pg_query('SELECT count(id_inscripto) AS "CONTAR" FROM inscriptosxcurso INNER JOIN inscripto ON(inscripto.id_inscripto = inscriptosxcurso.fk_inscriptos) INNER JOIN tipodocumento ON(inscripto.fk_tipodoc = tipodocumento.id_tipodocumento) WHERE fk_curso = '."'".$cursoF."'");
$rowCantidad = pg_fetch_array($sqlCantAlumnos);
$cantidad = $rowCantidad['CONTAR'];
$sqlAlumnos = pg_query("SELECT * FROM inscriptosxcurso INNER JOIN inscripto ON(inscripto.id_inscripto = inscriptosxcurso.fk_inscriptos) INNER JOIN tipodocumento ON(inscripto.fk_tipodoc = tipodocumento.id_tipodocumento) WHERE fk_curso = '$cursoF'  ORDER BY apellido,nombre ASC");
echo '<table align="center" cellspacing="1" width="100%" cellpadding="4" border="1" bgcolor="#585858" id="tabla">';
	echo '<tr bgcolor="#FFFFFF" width="100%">';
		echo '<td id="titulo3" colspan="7" align="center"><l1>Cantidad de alumnos: '.$cantidad.'</l1></td>';
	echo '</tr>';
	echo '<tr bgcolor="#000000" width="100%">';
		echo '<td align="center" width="25%"><strong><label>Apellido y Nombre</label></strong></td>';
		//echo '<td align="center" width="22%"><strong><label>Nombre</label></strong></td>';		
		echo '<td align="center" width="13%"><strong><label>N&deg; Documento</label></strong></td>';
		echo '<td align="center" width="10%"><strong><label>Telefono Fijo</label></strong></td>';
		echo '<td align="center" width="10%"><strong><label>Celular</label></strong></td>';
		echo '<td align="center" width="20%"><strong><label>E-mail</label></strong></td>';
	echo '<tr>';
	$i=1;
while($rowAlumnos=pg_fetch_array($sqlAlumnos,NULL,PGSQL_ASSOC)){
	echo '<tr>';
		echo '<td align="left"><l2><a href="modInscriptoPami.php?idPami='.$rowAlumnos['id_inscripto'].'&cursoF='.$cursoF.'" style="text-decoration:none">'.$rowAlumnos['apellido'].', '.$rowAlumnos['nombre'].'</a></l2></td>';
		//echo '<td align="left"><l2>'.$rowAlumnos['nombre'].'</l2></td>';
		echo '<td align="left"><l2>'.$rowAlumnos['nombretipo'].' '.$rowAlumnos['dni'].'</l2></td>';
		echo '<td align="left"><l2>'.$rowAlumnos['telfijo'].'</l2></td>';
		echo '<td align="left"><l2>'.$rowAlumnos['telcel'].'</l2></td>';
		echo '<td align="left"><l2>'.$rowAlumnos['mail'].'</l2></td>';
	echo '<tr>';
}
echo '</table>';
?>
</fieldset>
</body>
</html>
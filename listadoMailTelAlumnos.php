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
	<title>Correos electr&oacute;nicos y Tel&eacute;fonos</title>
</head>
<body onLoad="tunCalendario();">
<table width="100%"  border="1" align="center">
<form id="form1" name="form1" method="post" action="">
	<tr>
		<td height="23" align="center"><p><strong>Correos electr&oacute;nico y Tel&eacute;fonos de Alumnos por Curso</strong> </p>
		<table width="42%" border="1">
		<tr>
			<td width="25%">Filtrar A&ntilde;o</td>
			<td width="75%">
			<select name="cursoA" size="1" class="myTextField" id="cursoA" onChange="evaluaring()" onkeyup=fn(this.form,this)>
			<option value="0" selected="selected">Seleccione A&ntilde;o</option>
				<?php
					include_once "conexionCursosExtension.php";
					$anio=0;
					$tip2 = pg_query($conn,"SELECT id_cursos, anio FROM cursos ORDER BY anio ASC;");
					while($row2 = pg_fetch_array($tip2)){
						if(strcmp($row2["anio"],$cursoA)==0){
							$seleccionado = " selected";
						}else{
							$seleccionado = "";
						}
						if ($row2["anio"]!=$anio){
							$anio=$row2["anio"];
							echo "<option value=".$row2["anio"]." $seleccionado>".$row2["anio"]."</option>";
						}
					}
				?>	
			</select>
			</td>
		</tr>
        <tr>
			<td width="25%">Filtrar Curso</td>
			<td width="75%">
			<select name="cursoF" size="1" class="myTextField" id="cursoF" onChange="evaluaring()"  onkeyup=fn(this.form,this)>
            <option value="0" selected="selected">Seleccione el Curso</option>
				<?php
					include_once "conexionCursosExtension.php";
					//volver a descomentar la linea y comentar la linea de abajo que es la original
					//$tip1 = pg_query($conn,"SELECT id_cursos,nombre,anio FROM cursos where activado='t' AND anio=$cursoA ORDER BY nombre;");
					//cuando se descomente la linea de arriba, comentar la de abajo
					$tip1 = pg_query($conn,"SELECT id_cursos,nombre,anio FROM cursos where anio=$cursoA ORDER BY nombre;");
					while($row1 = pg_fetch_array($tip1)){
						if(strcmp($row1["id_cursos"],$cursoF)==0)
							$seleccionado = " selected";
						else
							$seleccionado = "";
						echo "<option value=".$row1["id_cursos"]." $seleccionado>".$row1["nombre"]."</option>";
						
					}
				?>	
			</select>
			</td>
        </tr>		
		</table>
		</td>
	</tr>
<?
include "conexionCursosExtension.php";				
	if 	(( $cursoF!=0 && $cursoA !=0)){
    //descomentar la de abajo que es la original
		//$sqlInscriptos =  pg_query("SELECT id_inscripto, inscripto.nombre, apellido, telfijo, mail, telcel FROM inscripto FULL OUTER JOIN inscriptosxcurso ON(inscriptosxcurso.fk_inscriptos = inscripto.id_inscripto) FULL OUTER JOIN cursos ON(cursos.id_cursos = inscriptosxcurso.fk_curso) WHERE cursos.id_cursos=$cursoF AND cursos.anio=$cursoA AND activado='t' ORDER BY inscripto.nombre ASC;");
		//comentar la de abajo cuando se descomente la linea de arriba
		$sqlInscriptos =  pg_query("SELECT id_inscripto, inscripto.nombre, apellido, telfijo, mail, telcel FROM inscripto FULL OUTER JOIN inscriptosxcurso ON(inscriptosxcurso.fk_inscriptos = inscripto.id_inscripto) FULL OUTER JOIN cursos ON(cursos.id_cursos = inscriptosxcurso.fk_curso) WHERE cursos.id_cursos=$cursoF AND cursos.anio=$cursoA  ORDER BY inscripto.nombre ASC;");
	}
?>
</form>
<form id="form1" name="form2" method="post" action="">
    <table width="100%" border="1">
		<tr>
			<td width="10%" bgcolor="#666666">Alumno</td>
			<td width="10%" bgcolor="#666666">Tel&eacute;fono Fijo</td>
			<td width="10%" bgcolor="#666666">Tel&eacute;fono Celular</td>
			<td width="10%" bgcolor="#666666">Mail</td>
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
<table width="100%" border="1">
	<tr>
		<td width="100%"  align="center">
		<p>
			<input type="text" id="dato" name="dato" value="<?=$cursoF?>" style="display:none"/>
			<input type="text" id="dato2" name="dato2" value="<?=$cursoI?>" style="display:none"/>
		</p>
		<p>
			<?php echo '<a href="excelListadoMailTelAlumnos.php?anio='.$cursoA.'&curso='.$cursoF.'"><input type="button" value="Generar Excel"/></a>';?>
		</p>
		</td>
	</tr>
</table>
</form>
</table>
</body>
</html>
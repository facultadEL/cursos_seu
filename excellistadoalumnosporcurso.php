<?

header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-disposition: attachment;filename=ListadoAlumnosPorCurso.xls");

?>
<script>
function NO_letra(e){
   key=(document.all) ? e.keyCode : e.which;
   if( e.which == 0 ){return true;}
   if ((key > 47 && key < 58 ) || (key == 8)) 
   {
      return true;
   }
   return false;
   }//fin funcion
 function NO_letra2(e){
   key=(document.all) ? e.keyCode : e.which;
   if( e.which == 0 ){return true;}
   if (key > 47 && key < 58 ) 
   {	
	  return false;
   }
      return true;
   }  
   function evaluaring(academico)
	{
		document.form1.submit(); 
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Total de alumnos por a&ntilde;o</title>
</head>
<body onLoad="tunCalendario();">
<table width="100%"  border="1" align="center">
<form id="form1" name="form1" method="post" action="">
  
    <td>
    <?
	$cursoA = $_REQUEST['anio'];
    include "conexionCursosExtension.php";	
		if 	(( $cursoA!=0)){
			$sqlCursos = pg_query($conn,"SELECT id_cursos,nombre,activado,cant_inscriptos,anio FROM cursos where anio='$cursoA' AND activado='t' ORDER BY cant_inscriptos ASC;");
		}
 ?>
</form>
<form id="form1" name="form2" method="post" action="">
<?php
$cursoA = $_REQUEST['anio'];
include "conexionCursosExtension.php";	
$contador = 0;
$color = 0;
$totalAlumnos = 0;
//$cursos = pg_query("SELECT id_cursos,nombre,activado,cant_inscriptos,anio FROM cursos where anio='$cursoA' AND activado='t' ORDER BY cant_inscriptos ASC;");
$cursos = pg_query("SELECT id_cursos,nombre,activado,cant_inscriptos,anio FROM cursos where anio='$cursoA' ORDER BY cant_inscriptos ASC;");//descomentar la de arriba y comentar la actual
echo '<table align="center" border="1">';
	echo '<tr bgcolor="#FFFFFF">';
		echo '<td colspan="2" width="100%" align="center"><FONT size="5" color="#0B615E"><b>Total de inscriptos por curso</b></FONT></td>';
	echo '</tr>';
	echo '<tr width="100%">';
		echo '<td align="center" width="60%" bgcolor="#000000"><FONT size="4" color="#0080FF" face="Cambria">Cursos</FONT></td>';
		echo '<td align="center" width="40%" bgcolor="#000000"><FONT size="4" color="#0080FF" face="Cambria">Alumnos</FONT></td>';
	echo '</tr>';
	$i = 1;
	$j = 1;
while($rowCurso=pg_fetch_array($cursos,NULL,PGSQL_ASSOC)){
	$id_Curso = $rowCurso['id_cursos'];
	$nombre_curso[$i] = $rowCurso['nombre'];
	$cant_inscriptos = $rowCurso['cant_inscriptos'];
	echo '<tr>';
		echo '<td align="center" width="60%"><l2>'.$nombre_curso[$i].'</l2></td>';
		echo '<td align="right" width="40%">Total: '.$cant_inscriptos.'</td>';
	echo '</tr>';
	$totalAlumnos = $totalAlumnos + $cant_inscriptos;
	$contador = 0;
$Alumnos = pg_query("SELECT * FROM inscriptosxcurso INNER JOIN inscripto ON(inscriptosxcurso.fk_inscriptos = inscripto.id_inscripto) WHERE inscriptosxcurso.fk_curso='$id_Curso' ORDER BY apellido, nombre ASC");
while($rowAlumnos=pg_fetch_array($Alumnos,NULL,PGSQL_ASSOC)){
	$nombre_alumno = $rowAlumnos['apellido'].', '.$rowAlumnos['nombre'];
	$fk_curso = $rowAlumnos['fk_curso'];
		$contador = $contador + 1;

	echo '<tr>';
		if ($color == 0){
			echo '<td align="right" width="60%">'.$contador.'</td>';
			echo '<td align="left" width="40%" bgcolor="#F2F2F2">'.$nombre_alumno.'</td>';
			$color = 1;
		}else{
			echo '<td align="right" width="60%">'.$contador.'</td>';
			echo '<td align="left" width="40%">'.$nombre_alumno.'</td>';
			$color = 0;
		}
	echo '</tr>';
	}
	$i++;
}
echo '<tr>';
		echo '<td align="center" width="100%" colspan="2"><FONT size="4" color="#0B615E">Total de alumnos por cursos del año '.$cursoA.': '.$totalAlumnos.' inscriptos</FONT></td>';
echo '</tr>';
echo '</table>';
?>

</form>
    </td>
  </tr>
  </table>
</body>
</html>

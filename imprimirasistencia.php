<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head  >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cursos y Jornadas - Secretaria de Extension Universitaria</title>
</head>
<body>
<?
include "conexionCursosExtension.php";
$tip = pg_query($conn , "SELECT COUNT(id_inscripto) as contar FROM  inscripto full outer join inscriptosxcurso on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where fk_curso='".$_POST["dato"]."';");
	$row = pg_fetch_array($tip);
	$tip0=$row["contar"]+$row["contar"];
	$cont=0;

?>
    <table border="1" width="100%" cellspacing="0" cellpadding="1">
        <tr>
            <td align="center">
                <img src="images/logoutn.jpg" height="50px" width="50px"/>
                <br>
                    Facultad Regional<br>
                        Villa Maria
                        <br>
            </td>
            <td align="center" valing="center">
                <b>PLANILLA DE ASISTENCIA</b>
            </td>
            <td align="center">
                <b>RE1-PE1-02-07</b><br>
                Rev. 0<br>
                P&aacute;g 1 de 1
            </td>
        </tr>
    </table>
<table width="100%" border="0" align="left">
  <tr>
    <td><? include "conexionCursosExtension.php";
$tip2 = pg_query($conn , "SELECT nombre as curso, anio FROM  cursos where cursos.id_cursos='".$_POST["dato"]."';");
	$row2 = pg_fetch_array($tip2);
        echo "<br>";
   echo '<b><u>Curso:</u></b> '.$row2["curso"]; 
   echo '<br>';
   echo '<br>';
   ?>
   
    </td>
  </tr>  
</table>
 <? 
 $sqlFechas = pg_query("select distinct fecha from asistencia where fk_alumno in(select id_inscriptosxcurso from inscriptosxcurso where fk_curso='".$_POST['dato']."') order by fecha asc");
 
	 ?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td ><strong>Apellido/Nombre</strong></td>
    <?
    $cantidadFechas = 0;
  	while($rowFechas = pg_fetch_array($sqlFechas)){
  		$cantidadFechas += 1;
  		$vectorFecha[$cantidadFechas]=$rowFechas['fecha'];
  	?>
    <td align="center"><label style="font-size: 11pt"><?= $rowFechas["fecha"]?></label></td>
    <? }?>
    </tr>
 <?
 
 $sqlInscriptos = pg_query("select inscriptosxcurso.id_inscriptosxcurso as id, inscripto.nombre, apellido from inscriptosxcurso full outer join inscripto on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where inscriptosxcurso.fk_curso='".$_POST["dato"]."' order by apellido,inscripto.nombre");
 while($rowInscriptos = pg_fetch_array($sqlInscriptos))
 {
 	echo '<tr><td width="233">'.$rowInscriptos["apellido"].', '.$rowInscriptos["nombre"].'</td>';
 	$idInscriptoAsistencia = $rowInscriptos['id'];
 	$sqlAsistencia = pg_query("select distinct fecha, asistencia from asistencia where fk_alumno=$idInscriptoAsistencia order by fecha asc");
 	$contador = 0;
 	//$vFechaAlumno = [];
 	//$vAsistenciaAlumno = [];
 	while($rowAsistencia = pg_fetch_array($sqlAsistencia))
 	{
 		$contador += 1;
 		$vFechaAlumno[$contador] = $rowAsistencia['fecha'];
 		$vAsistenciaAlumno[$contador] = $rowAsistencia['asistencia'];
 	}

	/*
 	echo '<br>'.$vFechaAlumno[0].'<br>';
 	echo $vFechaAlumno[1].'<br>';
 	if(array_search($vectorFecha[1], $vFechaAlumno) == false)
	{
		echo 'Hace cualquier cosa';
	}
	*/
 	for($i = 1; $i <= count($vectorFecha); $i++)
 	{
 		//echo $vectorFecha[$i];
 		if(array_search($vectorFecha[$i], $vFechaAlumno) != false)
 		{
 			//echo 'entro <br>';
 			$posAsistencia = array_search($vectorFecha[$i], $vFechaAlumno);
 			if($vAsistenciaAlumno[$posAsistencia] == 't')
 			{
 				echo '<td width="587" align="center"><b>P</b></td>';
 			}
 			else
 			{
 				echo '<td width="587" align="center"><b>A</b></td>';
 			}
 		}
 		else
 		{
 			echo '<td width="587" align="center"><b>-</b></td>';
 		}
 	}
 	
 	echo '</tr>';
 	unset($vFechaAlumno);
 	unset($vAsistenciaAlumno);
 }
?>
</table>
<script>
window.print();
</script>
</body>
</html>
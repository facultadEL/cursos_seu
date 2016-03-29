<?

header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-disposition: attachment;filename=PlanillaAsistencia.xls");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head  >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cursos y Jornadas - Secretaria de Extension Universitaria</title>
</head>
<body>
<?
include "conexionCursosExtension.php";
$tip = pg_query($conn , "SELECT COUNT(id_inscripto) as contar FROM  inscripto full outer join inscriptosxcurso on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where fk_curso='".$_REQUEST["curso"]."';");
	$row = pg_fetch_array($tip);
	$tip0=$row["contar"]+$row["contar"];
	$cont=0;
	//echo "Post dato: ".$_POST['dato'];
//FUNCION PARA LEER ARCHIVOS DE TEXTO
/*function leef($fichero)
	{
	$texto=file($fichero);
	$tamleef=sizeof($texto);
	for ($n=0;$n<$tamleef;$n++)
		{
		$todo=$todo.$texto[$n];
		}
	return $todo;
	}*/
//FUNCION QUE GENERA UN RTF
/*function rtf($equi,$plantilla,$fsalida,$equi,$ing)
	{
	$pre=$ing;
	$fsalida="fichas/".$pre.".rtf";
	include "conexionpg.php";
	//leer plantilla
	$txtplantilla=leef($plantilla);
	$matriz=explode("sectd",$txtplantilla);
	$cabecera=$matriz[0]."sectd";
	$inicio=strlen($cabecera);
	$final=strrpos($txtplantilla,"}");
	$largo=$final+1-$inicio;
	$cuerpo=substr($txtplantilla,$inicio,$largo);
	//escrobo fichero
	$punt=fopen($fsalida, "w");
	fputs($punt,$cabecera);
		$despues=$cuerpo;
		$i=0;*/



/*	while($row2 = pg_fetch_array($sql2)){
			if ($i==0){
			$datosql=$equi[$i][1];
			$datortf=$equi[$i][0];
			$i=$i+1;
			$despues=str_replace($datortf,$datosql,$despues);
			$datosql=$equi[$i][1];
			$datortf=$equi[$i][0];
			$i=$i+1;
			$despues=str_replace($datortf,$datosql,$despues);
			}
			$datosql=$equi[$i][1];
			$datortf=$equi[$i][0];
			$i=$i+1;
			$despues=str_replace($datortf,$datosql,$despues);
			$datosql=$equi[$i][1];
			$datortf=$equi[$i][0];
			$i=$i+1;
			$despues=str_replace($datortf,$datosql,$despues);
}
			for($j=$i+1; $j<=41; $j++){
			$datosql=$equi[$j][1];
			$datortf=$equi[$j][0];
			$despues=str_replace($datortf,$datosql,$despues);
			$j=$j+1;
			$datosql=$equi[$j][1];
			$datortf=$equi[$j][0];
			$despues=str_replace($datortf,$datosql,$despues);
			}
			fputs($punt,$despues);
		$saltopag="\par \page \par";
		fputs($punt,$saltopag);
	fputs($punt,"}");
	fclose($punt);
	return $fsalida;
	}	
$plantilla= "/template.rtf";
$ing="ficha";
$i=0;
$sql= pg_query($conn,"select anio, inscripto.nombre, apellido from cursos, inscripto where cursos.id='".$_POST[dato]."' and fk_curso='".$_POST[dato]."' order by apellido;");
	while($row4 = pg_fetch_array($sql)){
		$cont=$cont+1;
		if ($i==0) {
		$equi[$i][0]="#*anio*#";   
		$equi[$i][1]=$row4["anio"];
		$i=$i+1;
		$equi[$i][0]="#*Curso*#";   
		$equi[$i][1]=$_POST["dato2"];
		$i=$i+1;
		}
		$equi[$i][0]="#*Nombre".$cont."*#";   
		$equi[$i][1]=$row4["nombre"]; 
		$i=$i+1;
		$equi[$i][0]="#*Apellido".$cont."*#";   
		$equi[$i][1]=$row4["apellido"];
		$i=$i+1;

}
			for($j=$i+1; $j<=41; $j++){
			$cont=$cont+1;
			$equi[$j][0]="#*Nombre".$cont."*#";   
			$equi[$j][1]=" "; 
			$j=$j+1;
			$equi[$j][0]="#*Apellido".$cont."*#";   
			$equi[$j][1]=" ";
			}
//echo $sql;
//echo pg_num_rows($sql);
$salida=rtf($equi,$plantilla,"certificado.rtf",$equi,$ing);

//echo $salida;

$salida= "<a href='$salida' onclick=window.open($salida) >obtener</a>";
echo "<p>$salida</p>";
*/
?>
<!--
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
	-->
<table width="100%" border="0" align="left">
  <tr>
    <td><? include "conexionCursosExtension.php";
$tip2 = pg_query($conn , "SELECT nombre as curso, anio FROM  cursos where cursos.id_cursos='".$_REQUEST["curso"]."';");
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
 $cantInscriptos=0;
 $inscriptos = pg_query("select inscriptosxcurso.id_inscriptosxcurso from inscriptosxcurso full outer join inscripto on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where inscriptosxcurso.fk_curso='".$_REQUEST["curso"]."' order by apellido,inscripto.nombre");
 while($rowIds=pg_fetch_array($inscriptos,NULL,PGSQL_ASSOC)){
	$cantInscriptos++;
	$vectorInscriptos[$cantInscriptos]=$rowIds['id_inscriptosxcurso'];
 }
 $sql2= pg_query($conn,"select fecha from asistencia full outer join inscriptosxcurso on(inscriptosxcurso.id_inscriptosxcurso=asistencia.fk_alumno) full outer join inscripto on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where inscriptosxcurso.fk_curso='".$_REQUEST["curso"]."' group by fecha order by fecha");
 
	 ?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td ><strong>Apellido/Nombre</strong></td>
    <? $cantidadfechas=0;
  while($row12 = pg_fetch_array($sql2)){
  $cantidadfechas++;
  $vectorFecha[$cantidadfechas]=$row12['fecha'];?>
    <td align="center"><label style="font-size: 11pt"><?= $row12["fecha"]?></label></td>
    <? }?>
    </tr>
 <?
 
 for($i=1;$i<$cantInscriptos+1;$i++){
	$idTrabajar = $vectorInscriptos[$i];
	$contador = 0;
	$contarFecha = 0;
	$sql1= pg_query($conn,"select asistencia.fk_alumno as inscriptoasis,fecha, asistencia.asistencia, telcel, telfijo, inscripto.nombre, apellido
 from asistencia full outer join inscriptosxcurso on(inscriptosxcurso.id_inscriptosxcurso=asistencia.fk_alumno) full outer join inscripto on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where  inscriptosxcurso.fk_curso='".$_REQUEST["curso"]."' order by apellido,nombre,fecha");
	echo '<tr>';
	//echo "Id trabajar ".$i.": ".$idTrabajar.'<br>';
	while($rowTrabajar=pg_fetch_array($sql1,NULL,PGSQL_ASSOC)){
		$entro = 0;
		//echo "Row Trabajar: ".$rowTrabajar['inscriptoasis'].'<br>';
		if($idTrabajar == $rowTrabajar['inscriptoasis']){
			if($contador == 0){
				echo '<td width="233">'.$rowTrabajar["apellido"].', '.$rowTrabajar["nombre"].'</td>';
				$contador = 1;
			}
			for($j=1;$j<$cantidadfechas+1;$j++){			
				if($vectorFecha[$j]==$rowTrabajar['fecha']){
					$contarFecha++;
					$entro = 1;					
					$valorAsistencia[$contarFecha] = $rowTrabajar['asistencia'];					
					$valorAsistencia[$contarFecha] = strtoupper($valorAsistencia[$contarFecha]);
					
				}
			}
			//echo '<td width="587">';
				//if($entro==0){
					//echo '-';
				//}else{
					//echo $valorAsistencia;
				//}
			//echo '</td>';
			
		}
		
	}
	$resultado = $cantidadfechas - $contarFecha;
	$contador=0;
	for($k=1;$k<$cantidadfechas+1;$k++){
		$contador++;
		echo '<td width="587" align="center"><b>';
		if($resultado<>0){
			echo '-';
			$resultado--;
		}else{
			//echo $valorAsistencia[$k];
                        if($valorAsistencia[$k]=='T'){
                            echo 'P';
                        }else{
                          echo 'A';
                        }
		}
		echo '</b></td>';
	}	
	echo '</tr>';
 }
?>
</table>
</body>
</html>
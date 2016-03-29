<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head  >
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Documento sin ttulo</title>
</head>
<body>
<?
include "conexionCursosExtension.php";
$c='cargaHoraria';
$n='nResolucion';
$f1='fechaResolucion';
$f2='fechaHoy';
$i='id';
$b="' '";
 if ($_POST[$c]=="" or $_POST[$n]=="" or $_POST[$f1]=="" or $_POST[$f2]==""){
}
else{
$tip2 = "UPDATE cursos SET carga_horaria='$_POST[$c]' , num_resolucion='$_POST[$n]' , fecha_resolucion='$_POST[$f1]', fecha_impresion='$_POST[$f2]' where carga_horaria is null and num_resolucion is null and fecha_resolucion is null and fecha_impresion is null and cursos.id_cursos=$_POST[$i] ";
	pg_query($conn, $tip2) or die(pg_last_error($conn));
	
	}

$error=0;

	if (!pg_query($conn, $tip2)) 
	 {
     $errorpg = pg_last_error($conn);
     $termino = "ROLLBACK";
     $error=1;
	 }
     else
     {
     $termino = "COMMIT";
     }
   pg_query($termino);
   
$i=0;
function elimina_acentos($cadena){
$tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
$replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";
return(strtr($cadena,$tofind,$replac));
}

$nomcur=elimina_acentos($_POST["nombre"]);

 
$nombreCarpeta="archivos/certificados/".$nomcur."-".$_POST[id]."-".$_POST[anio];

if (file_exists($nombreCarpeta)) {
} else {
mkdir("/archivos/certificados/".$nomcur."-".$_POST[id]."-".$_POST[anio],0777);
}


//FUNCION PARA LEER ARCHIVOS DE TEXTO
	function leef($fichero)
	{
	$texto=file($fichero);
	$tamleef=sizeof($texto);
	for ($n=0;$n<$tamleef;$n++)
		{
		$todo=$todo.$texto[$n];
		}
	return $todo;
	}
	
	function leef2($fichero2)
	{
	$texto2=file($fichero2);
	$tamleef2=sizeof($texto2);
	for ($l=0;$l<$tamleef2;$l++)
		{
		$todo2=$todo2.$texto2[$l];
		}
	return $todo2;
	}
	

	function rtf($equi,$plantilla,$fsalida,$equi,$ing)
	{
	$pre=$ing;
	$nomcur=elimina_acentos($_POST["nombre"]);
	$fsalida="archivos/certificados/".$nomcur."-".$_POST[id]."-".$_POST[anio]."/".$pre.".rtf";
	include "conexionCursosExtension.php";
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
			$datosql=$equi[0][1];
			$datortf=$equi[0][0];
			$despues=str_replace($datortf,$datosql,$despues);
			$datosql=$equi[1][1];
			$datortf=$equi[1][0];
			$despues=str_replace($datortf,$datosql,$despues);
			$datosql=$equi[2][1];
			$datortf=$equi[2][0];
			$despues=str_replace($datortf,$datosql,$despues);
			$datosql=$equi[3][1];
			$datortf=$equi[3][0];
			$despues=str_replace($datortf,$datosql,$despues);
			$datosql=$equi[4][1];
			$datortf=$equi[4][0];
			$despues=str_replace($datortf,$datosql,$despues);
			$datosql=$equi[5][1];
			$datortf=$equi[5][0];
			$despues=str_replace($datortf,$datosql,$despues);
			$datosql=$equi[6][1];
			$datortf=$equi[6][0];
			$despues=str_replace($datortf,$datosql,$despues);
			fputs($punt,$despues);
	fclose($punt);
	return $fsalida;
	}	
$sql= pg_query($conn,"select inscripto.nombre, apellido, dni from cursos full outer join inscriptosxcurso on(inscriptosxcurso.fk_curso = cursos.id_cursos)full outer join inscripto on(inscriptosxcurso.fk_inscriptos = inscripto.id_inscripto) where cursos.id_cursos='".$_POST[id]."' order by apellido,inscripto.nombre;");
	while($row4 = pg_fetch_array($sql)){
		$dni=$row4["dni"];
		if (strlen($dni)==8)
			{$dniconpunto=$dni[0].$dni[1].".".$dni[2].$dni[3].$dni[4].".".$dni[5].$dni[6].$dni[7];}
			else{$dniconpunto=$dni[0].".".$dni[1].$dni[2].$dni[3].".".$dni[4].$dni[5].$dni[6];}
				
//FUNCION QUE GENERA UN RTF

$plantilla= "certificado.rtf";
$ing=$row4["apellido"]." ".$row4["nombre"]." ".$row4["dni"];
if ($i==0){
$source = "archivos/certificados/".$nomcur."-".$_POST[id]."-".$_POST[anio]."/".$ing.".rtf";
$i=1;
}
		$equi[0][0]="#*Alumno*#";   
		$equi[0][1]=$row4["apellido"]." ".$row4["nombre"];
		$equi[1][0]="#*DNI*#";   
		$equi[1][1]=$dniconpunto;
		$equi[2][0]="#*Curso*#";   
		$equi[2][1]=$_POST["nombre"];
		$equi[3][0]="#*horas*#";   
		$equi[3][1]=$_POST["cargaHoraria"];
		$equi[4][0]="#*Res*#";   
		$equi[4][1]=$_POST["nResolucion"];
		$equi[5][0]="#*fecha*#";   
		$equi[5][1]=$_POST["fechaDictado"];
		$equi[6][0]="#*fecha2*#";   
		$equi[6][1]=$_POST["fechaHoy"];
//echo $sql;
//echo pg_num_rows($sql);
$salida= rtf($equi,$plantilla,"certificado.rtf",$equi,$ing);
//echo $salida;
$salida= "<a href='$salida' onclick=window.open($salida) >$ing</a>";
echo "<p>$salida</p>";
$data = file_get_contents($source);
}

$local = "archivos/certificados/".$nomcur."-".$_POST[id]."-".$_POST[anio]."/".$nomcur.$_POST[id].".rtf";
$fp = fopen($local, 'w');
include "conexionCursosExtension.php";
$sql2= pg_query($conn,"select inscripto.nombre, apellido, dni from cursos full outer join inscriptosxcurso on(inscriptosxcurso.fk_curso = cursos.id_cursos)full outer join inscripto on(inscriptosxcurso.fk_inscriptos = inscripto.id_inscripto)  where cursos.id='".$_POST[id]."' order by apellido,inscripto.nombre;");
	while($row42 = pg_fetch_array($sql2)){
 if ($i==0){
$ing2=$row42["apellido"]." ".$row42["nombre"]." ".$row42["dni"];
$source1 = "archivos/certificados/".$nomcur."-".$_POST[id]."-".$_POST[anio]."/".$ing2.".rtf";
$data1=file_get_contents($source1);
$data=str_replace("\sbkpage",$data1,$data);
 }
 else{
	 $i=0;
	 }
}
fwrite($fp, $data);
fclose($fp);
	$salida2= "<a href='$local' onclick=window.open($salida2) >".$nomcur."-".$_POST[id]."-".$_POST[anio].".rtf</a>";
echo "<p>$salida2</p>";

?>
</body>
</html>
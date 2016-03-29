<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head  >
<title>Cursos y Jornadas - Secretaria de Extension Universitaria</title>
<style type="text/css">
<!--
.s {
	text-align: center;
}
.s {
	font-weight: bold;
}
-->
</style>
</head>
<body>
<?
include "conexionpg.php";
$tip2 = pg_query($conn , "SELECT COUNT(id) as contar FROM  inscripto where fk_curso='".$_POST["dato"]."';");
	$row2 = pg_fetch_array($tip2);
	$tip0=$row2["contar"]+$row2["contar"];
	$cont=0;
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
$sql2= pg_query($conn,"select anio, inscripto.nombre, apellido, dni, cursos.nombre as curso from cursos, inscripto where cursos.id='".$_POST["dato"]."' and fk_curso='".$_POST["dato"]."' order by apellido;");


?>
<table width="902" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="142" valign="bottom"><p align="center"><img src="imprimirconstanciaentrega_clip_image002.gif" alt="" width="50" height="47" /><br />
      Facultad Regional<br />
      Villa Mar&iacute;a </p></td>
    <td width="598"><p>PLANILLA DE ENTREGA DE CERTIFICADOS</p></td>
    <td width="148"><p align="center"><strong>RE1-PE1-02-10</strong><br />
      Rev. 0<br />
      P&aacute;g. 1 de 1 </p></td>
  </tr>
</table>
<table width="56%" border="0" align="center">
  <tr>
    <td><? include "conexionpg.php";
$tip2 = pg_query($conn , "SELECT nombre as curso, anio FROM  cursos where cursos.id='".$_POST["dato"]."';");
	$row2 = pg_fetch_array($tip2);?>
      <strong><?= $row2["curso"].", ".$row2["anio"] ?>
    </strong>
    </td>
  </tr>
</table>
<table width="900" border="2" cellpadding="0" cellspacing="0">
  <tr>
    <td ><strong>Apellido/Nombre</strong></td>
    <td width="277" class="s">DNI</td>
    <td width="263" class="s">Firma</td>
    <td width="121" class="s">Fecha de Entrega</td>
  </tr>
 <? while($row2 = pg_fetch_array($sql2)){?> <tr>
    <td width="227" height="10"><?= $row2["apellido"].", ".$row2["nombre"]; ?></td>
       <td height="10"><?= $row2["dni"]; ?></td>
    <td height="10">&nbsp;</td>
    <td height="10">&nbsp;</td>
    </tr><? }?>
</table>
<script>
window.print();
</script>
</body>
</html>
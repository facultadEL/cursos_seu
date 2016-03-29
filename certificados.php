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
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>
<body onLoad="tunCalendario();">
<table width="100%"  border="1" align="center">
<form id="form1" name="form1" method="post" action="">
  <tr>
    <td height="30" align="center"><p><strong>CERTIFICADOS CURSOS</strong></p>
      <table width="41%" border="1">
        <tr>
          <td width="25%">Filtrar Curso</td>
          <td width="75%"><select name="cursoF" size="1" class="myTextField" id="cursoF" >
            <option value="0" selected="selected">Seleccione el Curso</option>
            <?php
                                         include_once "conexionCursosExtension.php";
                                                  $tip1 = pg_query($conn,"SELECT id_cursos,nombre FROM cursos;");
                                                  while($row1 = pg_fetch_array($tip1)){
                                 if(strcmp($row1["id_cursos"],$cursoF)==0)
                                            $seleccionado = " selected";
                                       else
                                       $seleccionado = "";
                                  echo "<option value=".$row1["id_cursos"]." $seleccionado>".$row1["nombre"]."</option>";
                                       }
                                                 ?>
          </select></td>
        </tr>
    </table>
      <p>
        <input type="submit" name="button" id="button" value="Buscar"  />
      </p></td>
  </tr>
    <?
    include "conexionCursosExtension.php";	
		if ($cursoF!='' or $cursoF!=0){
		$tip29 = pg_query($conn,"select nombre,docente,anio,carga_horaria,num_resolucion,fecha_resolucion,fecha_impresion from cursos where cursos.id_cursos=$cursoF ");
		
 ?>
 <tr>
 <td>
</form>
<form id="form1" name="form2" method="post" action="imprimircertificado.php">
    <table width="100%" border="1">
      <tr>
        <td width="10%" bgcolor="#666666">Nombre del Curso</td>
        <td width="10%" bgcolor="#666666">Nombre del Docente </td>
        <td width="10%" bgcolor="#666666">Carga Horaria </td>
        <td width="10%" bgcolor="#666666">N&deg; Resoluci&oacute;n </td>
        <td width="10%" bgcolor="#666666">Fecha Dictado </td>
        <td width="10%" bgcolor="#666666">Fecha Resoluci&oacute;n</td>
        <td width="10%" bgcolor="#666666">Fecha Hoy o impresi&oacute;n</td>
      </tr>
       <? $var=0;
	   	  $cont=0;
	   while($row29 = pg_fetch_array($tip29)){
	   		$cont=$cont+1;
		   if ($var==0)
		   		{
				$color='bgcolor="#FFFFFF"';
				$var=1;
				}else{
				$color='bgcolor="#CCCCCC"';
				$var=0;
					}
	
		   ?>
      <tr>
        <td <?=$color?>><?=$row29["nombre"]?></td>
        <td <?=$color?>><?=$row29["docente"]?></td>
        <td <?=$color?>><input type="text" id="cargaHoraria" name="cargaHoraria" value="<?=$row29["carga_horaria"]?>"/></td>
        <td <?=$color?>><input type="text" id="nResolucion" name="nResolucion" value="<?=$row29["num_resolucion"]?>"/></td>
        <td <?=$color?>><input type="text" id="fechaResolucion" name="fechaResolucion" value="<?=$row29["fecha_resolucion"]?>"/></td>
        <td <?=$color?>><input type="text" id="fechaDictado" name="fechaDictado" value=" "/></td>
        <td <?=$color?>><input type="text" id="fechaHoy" name="fechaHoy" value="<?=$row29["fecha_impresion"]?>"/></td>
      </tr>
      <input type="text" id="nombre" name="nombre" value="<?=$row29["nombre"]?>" style="display:none"/>
      <input type="text" id="anio" name="anio" value="<?=$row29["anio"]?>" style="display:none"/>
        <? ;}?>
       
    </table>
     <p>
     Formato Carga horaria: 96
      <p>
     Formato de Fecha Dictado: 30 de Noviembre de 2010
     <p>
     Formato de Otras Fecha: 24/06/2011
	<table width="100%" border="1">
  <tr>
    <td width="100%"  align="center">
      <p>
        <input type="text" id="id" name="id" value="<?=$cursoF?>" style="display:none"/>
      <p>
        <input type="submit" name="button22" id="button22" value="Enviar" align="middle"/>
      </p></td>
  </tr>
</table>
</form>
<? } ?>
    </td>
  </tr>
  </table>
  
</body>
</html>

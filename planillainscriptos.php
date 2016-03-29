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
		document.form2.submit(); 
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body onLoad="tunCalendario();">    
<table width="100%"  border="1" align="center">
<form id="form2" name="form2" method="post" action="">
  <tr>
    <td height="30" align="center"><p><strong>PLANILLA DE ENTREGA DE CERTIFICADOS</strong> </p>
      <table width="42%" border="1">
        <tr>
          <td width="25%">A&ntilde;o :</td>
          <td width="75%"><select name="anio" size="1" class="myTextField" id="anio" onchange="evaluaring()" onkeyup="fn(this.form,this)" >
            <option value="0" selected="selected">Seleccione el  a&ntilde;o</option>
            <?php
			
                                         include_once "conexionCursosExtension.php";										 		
                                                 $tip1 = pg_query($conn,"SELECT anio FROM cursos group by anio;");
                                                  while($row1 = pg_fetch_array($tip1)){
													  if(strcmp($row1["anio"],$anio)==0){
                                            $seleccionado = " selected";}
                                       else{
                                       $seleccionado = "";}
                                  		echo "<option value=".$row1["anio"]." $seleccionado>".$row1["anio"]."</option>";
									}
                                           ?>
          </select></td>
        </tr>
        <tr>
          <td>Curso :</td>
          <td width="75%"><select name="cursoF" size="1" class="myTextField" id="cursoF" onchange="evaluaring()" onkeyup="fn(this.form,this)" >
            <option value="0" selected="selected">Seleccione el Curso</option>
            <?php
			
                                         include_once "conexionCursosExtension.php";										 		
                                                 $tip1 = pg_query($conn,"SELECT id_cursos,nombre,duracion_desde,duracion_hasta FROM cursos where activado='t' AND anio=$anio ORDER BY nombre;");
                                                  while($row1 = pg_fetch_array($tip1)){
													  if(strcmp($row1["id_cursos"],$cursoF)==0){
                                            $seleccionado = " selected";}
                                       else{
                                       $seleccionado = "";}
                                  		echo "<option value=".$row1["id_cursos"]." $seleccionado>".$row1["nombre"]."</option>";
									}
                                           ?>
          </select>
            <br /></td>
        </tr>
        <tr>
          <td colspan="2"><strong>Cantidad de Alumnos Inscriptos:
            <? 
		  include_once "conexionCursosExtension.php";
		  	if ($cursoF!='' or $cursoF!=0 ){
		  $tip29 = pg_query($conn,"select  count(inscripto.id_inscripto) as contador from inscripto full outer join inscriptosxcurso on(inscriptosxcurso.fk_inscriptos = inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where cursos.id_cursos=$cursoF");
		  $row29 = pg_fetch_array($tip29);
		  
		  }
		  ?>
          </strong></td>
        </tr>
      </table>
      <p>
        <input type="submit" name="button" id="button" value="Buscar"  />
      </p></td>
  </tr>
    <?
    include "conexionCursosExtension.php";	
		if ($cursoF!='' or $cursoF!=0){
		$tip29 = pg_query($conn,"select nombre,docente from cursos where cursos.id_cursos=$cursoF ");
		
 ?>
 <tr>
 <td>
</form>
<form id="form1" name="form2" method="post" target="_blank" action="imprimirinscripto.php"> 
<? //<form id="form1" name="form2" method="post" target="_blank" action="/extension/asistencia.php">  ?>
    <table width="100%" border="1">
      <tr>
        <td width="10%" bgcolor="#666666">Nombre del Curso</td>
        <td width="10%" bgcolor="#666666">Nombre del Docente </td>
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
      </tr>
      <input type="text" id="dato2" name="dato2" value="<?=$row29["nombre"]?>" style="display:none"/>
        <? ;}?>
    </table>
	<table width="100%" border="1">
  <tr>
    <td width="100%"  align="center">
      <p>
        <input type="text" id="dato" name="dato" value="<?=$cursoF?>" style="display:none"/>
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

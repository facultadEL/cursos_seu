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
   
   function validarpaso(form1)
	{
		if (document.form1.curso.value==0){	alert("Por favor seleccione un curso");	document.form1.curso.focus();	return false;	}
		if (document.form1.nombre.value==""){	alert("Por favor ingrese su nombre");	document.form1.nombre.focus();	return false;	}
		if (document.form1.apellido.value==""){	alert("Por favor ingrese su apellido");	document.form1.apellido.focus();	return false;	}
		if (document.form1.numdoc.value==""){	alert("Por favor ingrese su numero de documento");	document.form1.numdoc.focus();	return false;	}
		if (document.form1.numdoc.value==22415920 || document.form1.numdoc.value==22864060  || document.form1.numdoc.value==20804558 ){	alert("El Cupo de Alumnos Fue Superado. NO ES POSIBLE INSCRIBIR AL ALUMNO");	document.form1.numdoc.focus();	return false;	}
		if (document.form1.direccion.value==""){	alert("Por favor ingrese su direccion");	document.form1.direccion.focus();	return false;	}
		if (document.form1.numero.value==""){	alert("Por favor ingrese el numero de su direccion");	document.form1.numero.focus();	return false;	}
		if (document.form1.localidad.value==""){	alert("Por favor ingrese su localidad");	document.form1.localidad.focus();	return false;	}
		if (document.form1.mail.value=="")
		{ 	alert("Por favor ingrese su E-Mail");	document.form1.mail.focus();		return false;	}
	if(document.form1.mail.value.indexOf('@',0)==-1 || document.form1.mail.value.indexOf('.',0)==-1)
		{	alert("Por favor ingrese un E-Mail válido");	document.form1.mail.focus();	return false;	}		
	}
function evaluaring(academico)
	{
		document.form2.submit(); 
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?
 include_once "conexionCursosExtension.php";
		  	if ($cursoF!='' or $cursoF!=0 ){
		  $tip29 = pg_query($conn,"select  nombre from  cursos where cursos.id_cursos=$cursoF ORDER BY nombre");
		  $row29 = pg_fetch_array($tip29);
		  echo $row29["nombre"];	
		  }else{
			  
			  echo "www.frvm.utn.edu.ar";}
?></title>

<style type="text/css">
<!--
-->
</style></head>

<body>
<form id="form2" name="form2" method="post" action="">
<table width="98%" height="132" border="0" align="center">
  <tr>
    <td height="23" align="center"><strong>Alumnos Asignados al Curso</strong>
      <table width="42%" border="1">
        <tr>
          <td width="25%">A&ntilde;o :</td>
          <td width="75%"><select name="anio" size="1" class="myTextField" id="anio" onChange="evaluaring()" onkeyup="fn(this.form,this)" >
            <option value="0" selected="selected">Seleccione el Curso</option>
            <?php
			
                                         include_once "conexionCursosExetnsion.php";										 		
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
          <td width="75%"><select name="cursoF" size="1" class="myTextField" id="cursoF" onChange="evaluaring()" onkeyup=fn(this.form,this) >
            <option value="0" selected="selected">Seleccione el Curso</option>
            <?php
			
                                         include_once "conexionCursosExtension.php";										 		
                                                 //$tip1 = pg_query($conn,"SELECT id_cursos,nombre,duracion_desde,duracion_hasta FROM cursos where anio_activado = 't' AND activado='t' AND anio=$anio;");
                                                 $tip1 = pg_query($conn,"SELECT id_cursos,nombre,duracion_desde,duracion_hasta FROM cursos where anio=$anio;");
                                                  while($row1 = pg_fetch_array($tip1)){
													  if(strcmp($row1["id"],$cursoF)==0){
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
		  $tip29 = pg_query($conn,"select  count(inscripto.id_inscripto) as contador from inscripto full outer join inscriptosxcurso on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on(cursos.id_cursos=inscriptosxcurso.fk_curso) where cursos.id_cursos=$cursoF");
		  $row29 = pg_fetch_array($tip29);
		  echo $row29["contador"];	
		  }
		  ?>
          </strong></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center">
    
    <?
    include "conexionCursosExtension.php";	
	if ($cursoF!='' or $cursoF!=0 )
	
//$tip29 = pg_query($conn,"select cursos.nombre as nombrecurso, inscripto.nombre as nombre,apellido,tipodoc,dni ,direccion, localidad, mail, telfijo, telcel from inscripto, cursos where fk_curso=cursos.id");

//	else
$tip29 = pg_query($conn,"select cursos.nombre as nombrecurso, inscripto.localidad, inscripto.nombre as nombre,apellido,dni ,direccion, localidad, mail, telfijo, telcel, porcdescuento, motivodescuento from inscripto full outer join inscriptosxcurso on(inscriptosxcurso.fk_inscriptos = inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where cursos.id_cursos=$cursoF order by inscripto.apellido ");
 if($cursoF!='' or $cursoF!=0 ){?>

   
    <table width="100%" border="1">
      <tr>
        <td width="18%" bgcolor="#666666"><strong>Apellido</strong></td>
        <td width="34%" bgcolor="#666666"><strong>Nombre</strong></td>
        <td width="12%" bgcolor="#666666"><strong>Documento</strong></td>
        <td width="11%" bgcolor="#666666"><strong>E-Mail</strong></td>
        <td width="6%" bgcolor="#666666"><strong>Telefono Fijo</strong></td>
        <td width="6%" bgcolor="#666666"><strong>Telefono Celular</strong></td>
        <td width="3%" bgcolor="#666666"><strong>% Desc</strong></td>
        <td width="3%" bgcolor="#666666"><strong>Motivo Descuento</strong></td>
        <td width="7%" bgcolor="#666666"><strong>Localidad</strong></td>
        </tr>
       <? $var=0;
	   while($row29 = pg_fetch_array($tip29)){
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
        <td <?=$color?>><strong>
          <?=$row29["apellido"] ?>
        </strong></td>
        <td <?=$color?>><strong>
          <?=$row29["nombre"]?>
        </strong></td>
        <td <?=$color?>><?=$row29["dni"]?></td>
        <td <?=$color?>><?=$row29["mail"] ?></td>
        <td <?=$color?>><?=$row29["telfijo"] ?></td>
        <td <?=$color?>><?=$row29["telcel"] ?></td>
        <td <?=$color?>><?=$row29["porcdescuento"] ?></td>
        <td <?=$color?>><?=$row29["motivodescuento"] ?></td>
        <td <?=$color?>><?=$row29["localidad"] ?></td>
        </tr>
        <? }?>
    </table>
    <? }?>
    </td>
  </tr>
</table>
<? 
if ($imp==0){
/*<script language="JavaScript">
window.print();
</script>
 */}?>
</body>
</html>
<?
if ($cursoF!=0){
?>
<!-- <a href="listainscriptos.php?cursoF=<?=$cursoF?>&imp=0">Imprimir Listado</a> -->
<a href="excelListaAlumnos.php?cursoF=<?=$cursoF?>&imp=0">Imprimir Listado</a>
<?
}
?>
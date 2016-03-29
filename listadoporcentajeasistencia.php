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
			  
			  echo "extension.frvm.utn.edu.ar";}
?></title>

<style type="text/css">
<!--
-->
</style></head>

<body>
<form id="form2" name="form2" method="get" action="">
<table width="98%" height="132" border="0" align="center">
  <tr>
    <td height="23" align="center"><strong>Porcentaje de Asistencia</strong>
      <table width="42%" border="1">
        <tr>
          <td width="25%">A&ntilde;o :</td>
		 <? $anio=$_get["anio"];?> 
          <td width="75%"><select name="anio" size="1" class="myTextField" id="anio" onChange="evaluaring()" onkeyup="fn(this.form,this)" >
            <option value="0" selected="selected">Seleccione el A&ntilde;o</option>
            <?php
			
                                         include_once "conexionCursosExtension.php";										 		
                                                 $tip1 = pg_query($conn,"SELECT anio FROM cursos group by anio;");
                                                  while($row1 = pg_fetch_array($tip1)){
													  if(strcmp($row1["anio"],$_REQUEST["anio"])==0){
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
                                                 $tip1 = pg_query($conn,"SELECT id_cursos,nombre,duracion_desde,duracion_hasta FROM cursos where activado='t' AND anio=".$_REQUEST["anio"].";");
                                                  while($row1 = pg_fetch_array($tip1)){
													  if(strcmp($row1["id_cursos"],$_REQUEST["cursoF"])==0){
                                            $seleccionado = " selected";}
                                       else{
                                       $seleccionado = "";}
                                  		echo "<option value=".$row1["id_cursos"]." $seleccionado>".$row1["nombre"]."</option>";
									}
                                           ?>
          </select>
            <br /></td>
        </tr>       
    </table></td>
  </tr>
  <tr>
    <td align="center">
    
    <?
    include "conexionCursosExtension.php";	
	if ($cursoF!='' or $cursoF!=0 )
	$cantInscriptos=0;
	$inscriptos = pg_query("select inscriptosxcurso.id_inscriptosxcurso,cursos.nombre,inscripto.nombre as nombreinsc,inscripto.apellido from inscriptosxcurso full outer join inscripto on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where inscriptosxcurso.fk_curso=$cursoF order by apellido,inscripto.nombre ASC");
	while($rowIds=pg_fetch_array($inscriptos,NULL,PGSQL_ASSOC)){		
		$curso = $rowIds['nombre'];
		$cantInscriptos++;
		$vectorNombres[$cantInscriptos] = $rowIds['nombreinsc'];
		$vectorApellidos[$cantInscriptos] = $rowIds['apellido'];
		$vectorInscriptos[$cantInscriptos]=$rowIds['id_inscriptosxcurso'];
	}
//$tip29 = pg_query($conn,"select cursos.nombre as nombrecurso, inscripto.nombre as nombre,apellido,tipodoc,dni ,direccion, localidad, mail, telfijo, telcel from inscripto, cursos where fk_curso=cursos.id");
$sql2= pg_query($conn,"select fecha from asistencia full outer join inscriptosxcurso on(inscriptosxcurso.id_inscriptosxcurso=asistencia.fk_alumno) full outer join inscripto on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where cursos.id_cursos=$cursoF group by fecha order by fecha");
$cantidadfechas=0;
  while($row12 = pg_fetch_array($sql2)){
  $cantidadfechas++;
  }
//	else
for($i=1;$i<$cantInscriptos+1;$i++){
	$contarAsistencia = 0;
	$idInscAsis = $vectorInscriptos[$i];
	$sqlAsis= pg_query($conn,"select asistencia.fk_alumno as inscriptoasis,fecha, asistencia.asistencia, telcel, telfijo, inscripto.nombre, apellido
	from asistencia full outer join inscriptosxcurso on(inscriptosxcurso.id_inscriptosxcurso=asistencia.fk_alumno) full outer join inscripto on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where  inscriptosxcurso.fk_curso=$cursoF and asistencia.fk_alumno=$idInscAsis order by apellido,nombre,fecha");
	while($rowContarAsis = pg_fetch_array($sqlAsis)){
		if($rowContarAsis['asistencia']=="t"){
			$contarAsistencia++;			
		}
	}
	$porcentajeAsis = round(($contarAsistencia * 100)/$cantidadfechas);
	$vectorPorcAsis[$i] = $porcentajeAsis.' %';
}

$tip29 = pg_query($conn,"select inscriptosxcurso.id_inscriptosxcurso,cursos.nombre as nombrecurso,inscripto.id_inscripto, inscripto.localidad, inscripto.nombre as nombre,apellido,dni ,direccion, localidad, mail, telfijo, telcel from inscripto full outer join inscriptosxcurso on (inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on (inscriptosxcurso.fk_curso=cursos.id_cursos) full outer join asistencia on(inscriptosxcurso.id_inscriptosxcurso = asistencia.fk_alumno) where cursos.id_cursos=$cursoF order by inscripto.apellido,inscripto.nombre ASC ");
 if($cursoF!='' or $cursoF!=0 ){?>

   
    <table width="100%" border="1">
      <tr>
		<td bgcolor="#666666"><strong>Curso</strong></td>
        <td bgcolor="#666666"><strong>Apellido</strong></td>
        <td bgcolor="#666666"><strong>Nombre</strong></td>		
		<td bgcolor="#666666"><strong>Porcentaje de Asistencia</strong></td>		
        </tr>
       <? $var=0;
	   for($i=1;$i<$cantInscriptos+1;$i++){
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
          <?=$curso ?>
        </strong></td>
        <td <?=$color?>><strong>
          <?=$vectorApellidos[$i]?>
        </strong></td>
		 <td <?=$color?>><strong>
          <?=$vectorNombres[$i] ?>
        </strong></td> 
		<td align="center" <?=$color?>><strong>
          <?=$vectorPorcAsis[$i] ?>
        </strong></td>
		         
        </tr>
        <? }?>
    </table>
    <? }?>
    </td>
  </tr>
</table>
</body>
</html>
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
$cursoF = $_REQUEST['id_curso'];
 include_once "conexionCursosExtension.php";
		  	if ($cursoF!='' or $cursoF!=0 ){
		  $tip29 = pg_query($conn,"select  nombre from  cursos where cursos.id_cursos='$cursoF'");
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
<p><?
include_once "conexionCursosExtension.php";
		$id=$_REQUEST['id'];
		  $tip29 = pg_query($conn,"select * from  inscripto where id_inscripto=$id");
		  $row29 = pg_fetch_array($tip29);
	

		$sqlMotivoDescuento = pg_query("SELECT * FROM inscriptosxcurso where fk_inscriptos='$id' AND fk_curso='$cursoF'");
		$rowMotivoDescuento = pg_fetch_array($sqlMotivoDescuento);
		$motivoDescuento = $rowMotivoDescuento['motivodescuento'] ;
		
?>

	
</p>
<form id="form1" name="form1" method="post" onSubmit="return validarpaso(this)" action="guardarmodifincripto.php" >
<table width="100%" border="0" align="center">
  <tr>
    <td colspan="2" align="center"><strong>Inscripcion a Cursos y Seminarios - Secretaria de Extension Universitaria</strong></td>
    </tr>  
<tr>
    <td width="48%" align="right">Curso :</td>
    <td width="52%"><select name="curso"  class="myTextField" id="curso" >
      <option value="0" selected="selected">Seleccione el Curso</option>
      <?php
                                        										 		
                                                $tip1 = pg_query($conn,"SELECT id_cursos,cursos.nombre as curso,duracion_desde,duracion_hasta FROM cursos WHERE activado='t';");
                                                  while($row1 = pg_fetch_array($tip1)){
   /* $arrayotrafecha=split("/",$row1['duracion_desde']);
	$arrayotrafecha2=split("/",$row1["duracion_hasta"]);
    $timehoy=mktime(0,0,0,date("n"),date("d")-7,date("Y"));
    $timeotrafecha=mktime(0,0,0,$arrayotrafecha[1],$arrayotrafecha[0],$arrayotrafecha[2]);
    $timeotrafecha2=mktime(0,0,0,$arrayotrafecha2[1],$arrayotrafecha2[0],$arrayotrafecha2[2]);
   // if($timehoy<=$timeotrafecha){
//	if($timehoy<=$timeotrafecha2){*/
										 if($cursoF==$row1['id_cursos']){
												$seleccionado = " selected";
										}else{
												$seleccionado = "";										
										}
									   echo "<option value=".$row1["id_cursos"]." $seleccionado>".$row1['curso']."</option>";
                                  		}  ?>
    </select>
   
    </td>
  </tr>
  <tr>
    <td align="right">Nombre  </td>
    <td><input name="nombre" type="text" id="nombre" onKeyPress="return NO_letra2(event)" value="<?=$row29["nombre"]?>" size="30" maxlength="70"/>
	</td>
	
  </tr>
  	
  <tr>
    <td align="right">Apellido:</td>
    <td><input name="apellido" type="text" id="nombre2" onKeyPress="return NO_letra2(event)" value="<?=$row29["apellido"]?>" size="30" maxlength="70" /></td>
  </tr>
  <tr>
    <td align="right">Tipo de Documento :</td>
    <td><label>
      <select name="tipodoc" id="tipodoc">
	  <?php
	  $tipoDoc = pg_query("SELECT * FROM tipodocumento");
	  while($rowTipoDoc = pg_fetch_array($tipoDoc,NULL,PGSQL_ASSOC)){
		echo '<option value="'.$rowTipoDoc['id_tipodocumento'].'">'.$rowTipoDoc['nombretipo'].'</option>';
	  }	  
      ?>	  
      </select>
    </label></td>
  </tr>
  <tr>
    <td align="right">Numero de documento :</td>
    <td><input name="numdoc" type="text" id="numdoc" onKeyPress="return NO_letra(event)" value="<?=$row29["dni"]?>" size="11" maxlength="10" /></td>
  </tr>
  <tr>
    <td align="right">Direccion :</td>
    <td><input name="direccion" type="text" id="direccion" onKeyPress="return NO_letra2(event)" value="<?=$row29["direccion"]?>" size="30" maxlength="60"/></td>
  </tr>
  <tr>
    <td align="right">Numero</td>
    <td><input name="numero" type="text" id="direccion2" onKeyPress="return NO_letra(event)" value="<?=$row29["numero"]?>" size="30" maxlength="60"/></td>
  </tr>
  <tr>
    <td align="right">Localidad :</td>
    <td><input name="localidad" type="text" id="localidad" onKeyPress="return NO_letra2(event)" value="<?=$row29["localidad"]?>" size="30" maxlength="60"/></td>
  </tr>
  <tr>
    <td align="right">E-Mail :</td>
    <td><input name="mail" type="text" id="mail" value="<?=$row29["mail"]?>" size="30" maxlength="70" /></td>
  </tr>
  <tr>
    <td align="right">Telefono Fijo :</td>
    <td><input name="telfijo" type="text" id="telfijo" onKeyPress="return NO_letra(event)" value="<?=$row29["telfijo"]?>" size="30" maxlength="30"/></td>
  </tr>
  <tr>
    <td align="right">Telefono Celular :</td>
    <td><input name="telcel" type="text" id="telcel" onKeyPress="return NO_letra(event)" value="<?=$row29["telcel"]?>" size="30" maxlength="70" />
      <input name="id" type="hidden" id="id" value="<?=$row29["id_inscripto"]?>" />
	  <input name="cursoF" type="hidden" id="cursoF" value="<?=$cursoF;?>"/></td>
  </tr>
  <tr>
    <td align="right">Motivo Descuento :</td>
    <td><input name="motivodescuento" type="text" id="motivodescuento" onKeyPress="return NO_letra2(event)" value="<?=$motivoDescuento?>" size="30" maxlength="60"/></td>
  </tr>
<tr>
    <td colspan="2" align="center"><input type="submit" name="Submit" id="Submit" value="Enviar" /></td>
  </tr>
</table>
</form>
</body>
</html>
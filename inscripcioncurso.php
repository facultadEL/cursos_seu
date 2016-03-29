


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
function validarNum(event, element, _float){
	var charCode = (document.all)?e.keyCode:e.which;
	if (charCode == 8 || charCode == 13 || (_float ? (element.value.indexOf('.') == -1 ? charCode == 46 : false) : false))
		return true;
	else if ((charCode < 48) || (charCode > 57))
		return false;
	return true;
}
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
if (document.form1.descuento.value==""){	alert("Por favor ingrese una descuento, cero si no posee");	document.form1.descuento.focus();	return false;	}
if (document.form1.descuento.value>0 && document.form1.motivodescuento.value=="" ){alert("Por favor indique el motivo del descuento.");	document.form1.motivodescuento.focus();	return false;	}
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
.centro {
	text-align: center;
}
.justder {
	text-align: center;
}
.jus {
	text-align: right;
}
</style>
</head>

<body>

<p>
  <?
 include_once "conexionCursosExtension.php";
		  $dni=$_POST["numdoc"];
		  $tip29 = pg_query($conn,"select count(id_inscripto) as cantidad from  inscripto where dni=$dni");
		  $row29 = pg_fetch_array($tip29);
		  if ($row29["cantidad"]>0)
		  	{
				$variableControl = 1;
				$tip3 = pg_query($conn,"select inscriptosxcurso.id_inscriptosxcurso,inscripto.id_inscripto,  inscripto.nombre as nom,apellido, telfijo,mail,direccion,  numero ,dni,tipodocumento.nombretipo,localidad ,telcel, cursos.nombre as nomcurso from  inscriptosxcurso full outer join inscripto on(inscriptosxcurso.fk_inscriptos = inscripto.id_inscripto) full outer join tipodocumento on(inscripto.fk_tipodoc = tipodocumento.id_tipodocumento) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where dni=$dni");
			  	 while($row3 = pg_fetch_array($tip3)){
					echo '<table width="100%" border="1">
 						 <tr>
    			<td colspan="2" class="centro"><strong>'.$row3["nomcurso"].'</strong></td>
				  </tr>';
					$cont = 0;
					//full outer join inscriptosxcurso on(pagosencoop.fk_inscriptosxcursos=inscriptosxcurso.id_inscriptosxcurso) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) 
					$tip4 = pg_query($conn,"select * from  pagosencoop  where fk_inscriptosxcursos=".$row3["id_inscriptosxcurso"]." order by codigo_barras;");
			  	    while($row4 = pg_fetch_array($tip4)){
						$cont = $cont + 1;
						
							echo '
							<tr>
    <td width="50%" class="jus">Numero de Cuota:</td>
    <td width="50%">'.$cont.'</td>
  </tr>
  <tr>
    <td class="jus">Estado:</td>
    <td>';
	if ($row4["fechapago"]=="")
		{
			echo '<strong>No Pagado</strong>';
		}else
		{
			echo 'Pagado';
			}
	echo '</td>
  </tr>
  <tr>
    <td class="jus">Monto:</td>
    <td>'.$row4["monto"].'</td>
  </tr>
  <tr>
    <td class="jus">Fecha de Pago:</td>
    <td>'.$row4["fechapago"].'</td>
  </tr>';
						}
				echo '</table>';
				
						//	inscripto.id,   ,apellido, telfijo,mail,direccion,  numero ,dni,tipodoc,localidad ,telcel, fk_curso, cursos.nombre as nomcurso
					$nombre=$row3["nom"];
					$apellido=$row3["apellido"];
					$numdoc=$row3["dni"];
					$direccion=$row3["direccion"];
					$numero=$row3["numero"];
					$localidad=$row3["localidad"];
					$mail=$row3["mail"];
					$telfijo=$row3["telfijo"];
					$telcel=$row3["telcel"];
					//poner todas las variables
					}
			
			  }else{
					$variableControl = 0;
				echo "no existe el alumno";
				  }
		  
		  	?>
</p>
<form id="form1" name="form1" method="post" onSubmit="return validarpaso(this)" action="guardarincripto.php" >
<input type="hidden" name="variableControl" value="<?php echo $variableControl;?>"/>
<table width="52%" border="0" align="center">
  <tr>  
    <td colspan="2" align="center"><strong>Inscripcion a Cursos y Seminarios - Secretaria de Extension Universitaria</strong></td>
    </tr>
  <tr>
    <td width="50%" align="right">Curso :</td>
    <td width="50%"><select name="curso"  class="myTextField" id="curso" >		
      <option value="0" selected="selected">Seleccione el Curso</option>
      <?php
                                          include_once "conexionCursosExtension.php";
												$anioActual = date("Y");
                                                 $tip1 = pg_query($conn,"SELECT id_cursos,nombre,duracion_desde,duracion_hasta FROM cursos where anio=$anioActual ORDER BY nombre;");
                                                  while($row1 = pg_fetch_array($tip1)){
    $arrayotrafecha=split("/",$row1['duracion_desde']);
	$arrayotrafecha2=split("/",$row1["duracion_hasta"]);
    $timehoy=mktime(0,0,0,date("n"),date("d")-7,date("Y"));
    $timeotrafecha=mktime(0,0,0,$arrayotrafecha[1],$arrayotrafecha[0],$arrayotrafecha[2]);
    $timeotrafecha2=mktime(0,0,0,$arrayotrafecha2[1],$arrayotrafecha2[0],$arrayotrafecha2[2]);
   // if($timehoy<=$timeotrafecha){
//	if($timehoy<=$timeotrafecha2){
                                  		echo "<option value=".$row1["id_cursos"]." $seleccionado>".$row1["nombre"]."</option>";
									}//}}  ?>
    </select></td>
  </tr>
  <tr>
    <td align="right">Nombre  </td>
    <td><input name="nombre" type="text" id="nombre" onKeyPress="return NO_letra2(event)" value="<?=$nombre?>" size="30" maxlength="70"/></td>
  </tr>
  <tr>
    <td align="right">Apellido:</td>
    <td><input name="apellido" type="text" id="nombre2" onKeyPress="return NO_letra2(event)" value="<?=$apellido?>" size="30" maxlength="70" /></td>
  </tr>
  <tr>
    <td align="right">Tipo de Documento :</td>
    <td><label>
      <select size="1" name="tipoDocumento" >
			<?php

                            include_once 'conexionCursosExtension.php';                            
                            $valores2 = pg_query("SELECT * FROM tipodocumento");                            
                            while($row=pg_fetch_array($valores2,NULL,PGSQL_ASSOC)){
                                $idCat = $row['id_tipodocumento'];
                                $idCat = '"'.$idCat.'"';
                                echo "<option value=".$idCat.">".$row['nombretipo']."</option>"; 
                            }
                        ?>
			</select>
    </label></td>
  </tr>
  <tr>
    <td align="right">Numero de documento :</td>
    <td><input name="numdoc" type="text" id="numdoc" onKeyPress="return NO_letra(event)" value="<?=$numdoc?>" size="11" maxlength="10" /></td>
  </tr>
  <tr>
    <td align="right">Direccion :</td>
    <td><input name="direccion" type="text" id="direccion" onKeyPress="return NO_letra2(event)" value="<?=$direccion?>" size="30" maxlength="60"/></td>
  </tr>
  <tr>
    <td align="right">Numero :</td>
    <td><input name="numero" type="text" id="direccion2" onKeyPress="return NO_letra(event)" value="<?=$numero?>" size="30" maxlength="60"/></td>
  </tr>
  <tr>
    <td align="right">Localidad :</td>
    <td><input name="localidad" type="text" id="localidad" onKeyPress="return NO_letra2(event)" value="<?=$localidad?>" size="30" maxlength="60"/></td>
  </tr>
  <tr>
    <td align="right">E-Mail :</td>
    <td><input name="mail" type="text" id="mail" value="<?=$mail?>" size="30" maxlength="70" /></td>
  </tr>
  <tr>
    <td align="right">Telefono Fijo :</td>
    <td><input name="telfijo" type="text" id="telfijo" onKeyPress="return NO_letra(event)" value="<?=$telfijo?>" size="30" maxlength="30"/></td>
  </tr>
  <tr>
    <td align="right">Telefono Celular :</td>
    <td><input name="telcel" type="text" id="telcel" onKeyPress="return NO_letra(event)" value="<?=$telcel?>" size="30" maxlength="70" /></td>
  </tr>
  <tr>
    <td align="right">Paga el   :</td>
    <td><input name="descuento" type="text" id="descuento" size="5" maxlength="3" onKeyPress="return NO_letra(event)" /> 
      % - Ej: 100(0 % de descuento)</td>
  </tr>
  <tr>
    <td align="right">Motivo del descuento :</td>
    <td><input name="motivodescuento" type="text" id="motivodescuento" size="30" maxlength="70" /></td>
  </tr>
<tr>
    <td colspan="2" align="center"><input type="submit" name="Submit" id="Submit" value="Enviar" /></td>
  </tr>
</table>
</form>
</body>
</html>
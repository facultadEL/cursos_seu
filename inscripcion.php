<script language="JavaScript"> 

// FUNCION CONTROL DE LETRAS (para que no escriban letras)
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
function validarpaso(interesados)
	{
	if (document.interesados.nombre.value=="")
		{	alert("Por favor ingrese su Nombre");	document.interesados.nombre.focus();	return false;	}
	if (document.interesados.apellido.value=="")
		{	alert("Por favor ingrese su Apellido");	document.interesados.apellido.focus();	return false;	}
	if (document.interesados.direccion.value=="")
		{	alert("Por favor ingrese su Direccion");	document.interesados.direccion.focus();	return false;	}
	if (document.interesados.numero.value=="")
		{	alert("Por favor ingrese el numero de su Direccion");	document.interesados.numero.focus();	return false;	}
	if (document.interesados.mail.value=="")
		{ 	alert("Por favor ingrese su E-Mail");	document.interesados.mail.focus();		return false;	}
	if(document.interesados.mail.value.indexOf('@',0)==-1 || document.interesados.mail.value.indexOf('.',0)==-1)
		{	alert("Por favor ingrese un E-Mail válido");	document.interesados.mail.focus();	return false;	}
	if (document.interesados.codigo.value=="")
		{	alert("Por favor ingrese un Codigo de Area");	document.interesados.codigo.focus();	return false;	}
	if (document.interesados.telefono.value=="")
		{	alert("Por favor ingrese Numero de Telefono");	document.interesados.telefono.focus();	return false;	}
	}

</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>extensi&oacute;n</title></head>

<body><form id="form1" name="interesados" method="post" action="guardarinteresado.php"  onSubmit="return validarpaso(this.form)" >
<table width="80%" border="0" align="center">
  <tr>
    <td colspan="2" bgcolor="#CCCCCC"><div align="center"><strong>Datos del Interesado </strong></div></td>
    </tr>
  <tr>
    <td width="37%"><div align="right">Nombre : </div></td>
    <td width="63%"><div align="left">
      <input name="nombre" type="text" id="nombre" onKeyPress="return NO_letra2(event)" size="20" maxlength="30" />
    </div></td>
  </tr>
  <tr>
    <td><div align="right">Apellido : </div></td>
    <td><div align="left">
      <input name="apellido" type="text" id="apellido" size="20" onKeyPress="return NO_letra2(event)" maxlength="30" />
    </div></td>
  </tr>
  <tr>
    <td><div align="right">Direcci&oacute;n : </div></td>
    <td><div align="left">
      <input name="direccion" type="text" id="direccion" size="15" maxlength="35" onKeyPress="return NO_letra2(event)"/>
Numero :
      <input name="numero" type="text" id="numero"  onKeyPress="return NO_letra(event)" size="6" maxlength="6" />
    </div></td>
    </tr>
  <tr>
    <td><div align="right">E-Mail : </div></td>
    <td><div align="left">
      <input name="mail" type="text" id="mail" size="20" maxlength="50" />
    </div></td>
  </tr>
  <tr>
    <td><div align="right">Telefono : </div></td>
    <td><div align="left">
      <input name="codigo" type="text" id="codigo" onKeyPress="return NO_letra(event)" size="7" maxlength="6" />
     - 
     <input name="telefono" type="text" id="telefono" onKeyPress="return NO_letra(event)" size="15" maxlength="15" />
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><hr /></td>
    </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC"><div align="center"><strong>Tipos de Cursos </strong></div></td>
  </tr>
  <tr>
    <td colspan="2"><hr /></td>
  </tr>
  <tr>
    <td colspan="2"><table width="90%" border="0" align="center">
      <tr>
        <td><div align="center">
          <?php
	include_once "conexionpg.php";
	echo'<table width="100%" border="0">';
	$cont=1;
		$tip = pg_query($conn,"SELECT id, nombre from tipo_curso;");
		  while($row = pg_fetch_array($tip)){
				$tipocurso=$row["nombre"];
		    	$id=$row["id"];
		 if ($cont==1){
		      echo ' <tr>';
		       }
		echo'
        <td ><div align="right">'.$tipocurso.' : </div></td>
        <td><div align="left">
          <label>
          <input type="checkbox" name="tipocur[]" value="'.$id.'" />
          </label>
        </div><td>
     ';
	 
	 if ($cont==2){
	    echo '</tr>';
		$cont=0;
		}
		$cont++;
	    }
	 echo '</table>';
	  

?>
        </div></td>
      </tr>
    </table>
      <table width="90%" border="0" align="center">
        <tr>
          <td width="46%"><div align="center">Otros: 
            <label></label>
          </div></td>
          <td width="54%"><textarea name="descripcion" cols="20" rows="2" id="descripcion"></textarea></td>
        </tr>
      </table></td>
    </tr>
  <tr>
    <td colspan="2">
      <div align="center"><input name="cont" type="hidden" value="<? echo $cont;?>" />
        <input type="submit" name="enviar" value="Enviar"/>
        </div>
    </td>
  </tr>
</table>
</form>
</body>
</html>

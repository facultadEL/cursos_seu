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
		document.form1.submit(); 
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
<form id="form1" name="form1" method="post" action="">
  <tr>
    <td height="23" align="center"><p><strong>Estado de pago de alumnos cursantes</strong> </p>
      <table width="42%" border="1">
      <tr>
          <td width="25%">Filtrar Año</td>
          <td width="75%"><select name="cursoA" size="1" class="myTextField" id="cursoA" onChange="evaluaring()" onkeyup=fn(this.form,this)>
            <option value="0" selected="selected">Seleccione Año</option>
            <?php
                                        include_once "conexionCursosExtension.php";
										$anio=0;
                                        $tip2 = pg_query($conn,"SELECT id_cursos,anio FROM cursos order by anio;");
                                        while($row2 = pg_fetch_array($tip2)){
										if(strcmp($row2["anio"],$cursoA)==0){
                                            $seleccionado = " selected";}
                                       else{
                                       $seleccionado = "";}
                                      	if ($row2["anio"]!=$anio){
									  	$anio=$row2["anio"];
                                  		echo "<option value=".$row2["anio"]." $seleccionado>".$row2["anio"]."</option>";
									  }}
                                                 ?>
          </select></td>
        </tr>
        <tr>
          <td width="25%">Filtrar Curso</td>
          <td width="75%"><select name="cursoF" size="1" class="myTextField" id="cursoF" onChange="evaluaring()"  onkeyup=fn(this.form,this)>
            <option value="0" selected="selected">Seleccione el Curso</option>
            <?php
                                         include_once "conexionCursosExtension.php";
                                                  $tip1 = pg_query($conn,"SELECT id_cursos,nombre,anio FROM cursos where anio=$cursoA ORDER BY nombre;");
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
      <table width="42%" border="1">
      <tr>
        <td width="25%">Filtrar inscripto </td>
        <td width="75%"><select name="cursoI" size="1" class="myTextField" id="cursoI" onChange="evaluaring()"  onkeyup=fn(this.form,this)  >
            <option value="0" selected="selected">Seleccione el inscripto</option>
            <?php
                                         include_once "conexionCursosExtension.php";
                                                  $tip4 = pg_query($conn,"SELECT id_inscriptosxcurso,inscripto.nombre,apellido FROM inscripto full outer join inscriptosxcurso on(inscriptosxcurso.fk_inscriptos = inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) WHERE cursos.id_cursos=$cursoF ORDER BY apellido,inscripto.nombre;");
                                                  while($row4 = pg_fetch_array($tip4)){
                                 if(strcmp($row4["id_inscripto"],$cursoI)==0)
                                            $seleccionado = " selected";
                                       else
                                       $seleccionado = "";
                                  echo "<option value=".$row4["id_inscriptosxcurso"]." $seleccionado>".$row4["apellido"].' '.$row4["nombre"]."</option>";
                                       }
                                                 ?>
          </select></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
    <?
    include "conexionCursosExtension.php";	
/*	if (($cursoF=='' or $cursoF==0) and ($cursoI=='' or $cursoI==0)){
		$tip29 = pg_query($conn,"select pagocuota.id,inscripto.nombre,apellido, cantcuota, nrocuota, montoxcuota,fechapago,estado,fk_inscripto, pagocuota.descripcion from inscripto,cursos,pagocuota  where fk_curso=cursos.id and pagocuota.fk_inscripto=inscripto.id Order By pagocuota.id, apellido");
	}
	else{*/
		/*if (($cursoF!='' or $cursoF!=0) and ($cursoI!='' or $cursoI!=0)){
		$tip29 = pg_query($conn,"select pagocuota.id,inscripto.nombre,apellido, cantcuota, nrocuota, montoxcuota,fechapago,estado,fk_inscripto, pagocuota.descripcion from inscripto,cursos,pagocuota where pagocuota.fk_inscripto=inscripto.id and cursos.id=$cursoF and fk_curso=$cursoF  Order By pagocuota.id, apellido");}
		else{
			/*if 	(($cursoF=='' or $cursoF==0) and ($cursoI!='' or $cursoI!=0)){
			$tip29 = pg_query($conn,"select pagocuota.id,inscripto.nombre,apellido, cantcuota, nrocuota, montoxcuota,fechapago,estado,fk_inscripto, pagocuota.descripcion from inscripto,cursos,pagocuota where pagocuota.fk_inscripto=$cursoI and inscripto.id=$cursoI and fk_curso=cursos.id  Order By pagocuota.id, apellido");}
			else{*/
		
				if 	(( $cursoF!=0) and ( $cursoI!=0)){
				
					$tip29 = pg_query($conn,"select * from pagosencoop full outer join inscriptosxcurso on(pagosencoop.fk_inscriptosxcursos=inscriptosxcurso.id_inscriptosxcurso) full outer join inscripto on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where cursos.id_cursos=$cursoF and pagosencoop.fk_inscriptosxcursos=$cursoI  Order By apellido, inscripto.nombre, pagosencoop.id_pagosencoop");
					
					}
		//		}
		//	}
		//}
 ?>
</form>
<form id="form1" name="form2" method="post" action="cursosExtension.php?pInterna=guardarpagocuotas.php">
    <table width="100%" border="1">
      <tr>
        <td width="10%" bgcolor="#666666">Apellido</td>
        <td width="10%" bgcolor="#666666">Nombre</td>
        <td width="12%" bgcolor="#666666">Cantida cuotas </td>
        <td width="6%" bgcolor="#666666">N&deg; Cuota</td>
        <td width="7%" bgcolor="#666666">Monto</td>
        <td width="10%" bgcolor="#666666">Fecha de pago </td>
        <td width="10%" bgcolor="#666666">Estado</td>        
      </tr>
       <? $var=0;
	   	  $cont=0;
		  if 	(($cursoF!=0) and ( $cursoI!=0)){
	   while($row29 = pg_fetch_array($tip29)){
	   		$cont=$cont+1;
			$codigoBarra = $row29['codigo_barras'];
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
		
        <td <?=$color?>><?=$row29["apellido"]?></td>
        <td <?=$color?>><?=$row29["nombre"]?></td>
        <td <?=$color?>><?=$codigoBarras[5]?></td>
        <td <?=$color?>><?=$codigoBarras[4]?></td>
        <td <?=$color?>><input type="text" id="m<?=$row29["id_pagosencoop"]?>" name="m-<?=$row29["id_pagosencoop"]?>" value="<?=$row29["monto"]?>" onKeyPress="return NO_letra(event)"/> </td>
        <td <?=$color?>><input type="text" id="miCalendario" name="f-<?=$row29["id_pagosencoop"]?>" value="<?=$row29["fechapago"]?>"  onclick="window.open('popup.html?destino=form2.f-<?=$row29["id_pagosencoop"]?>', '_blank', 'width=300,height=230')" /></td>
        <td <?=$color?>><select name="s-<?=$row29["id_pagosencoop"]?>" size="1" class="myTextField" id="curso"  >
		<?php
			if($row29['num_recibo']<>NULL){
				echo '<option value="Pagado" selected="selected" >Pagado</option>';
				echo '<option value="No Pagado">No pagado</option>';
			}else{
				echo '<option value="Pagado" >Pagado</option>';
				echo '<option value="No Pagado" selected="selected" >No Pagado</option>';
			}
		?>
			<option value="Pendiente" $seleccionado>Pendiente</option></select></td>
              </tr>
        <? ;}}?>
    </table>
	<table width="100%" border="1">
  <tr>
    <td width="100%"  align="center">
      <p>
        <input type="text" id="dato" name="dato" value="<?=$cursoF?>" style="display:none"/>
        <input type="text" id="dato2" name="dato2" value="<?=$cursoI?>" style="display:none"/>
        </p>
      <p>
    <? //    <input type="submit" name="button22" id="button22" value="Enviar" align="middle"/> ?>
      </p></td>
  </tr>
	</table>
</form>
    </td>
  </tr>
  </table>
</body>
</html>

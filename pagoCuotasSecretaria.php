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
<title>Pago de cuotas en Secretaria</title>
</head>
<body>
<?php
include_once "conexionCursosExtension.php";
$cursoF = $_REQUEST['cursoF'];
$cursoA = date("Y");
$cursoI = $_REQUEST['cursoI'];

?>
<table width="100%"  border="1" align="center">
<form id="form1" name="form1" method="post" action="">
  <tr>
    <td height="23" align="center"><p><strong>Pago de cuotas en Secretaria</strong> </p>
      <table width="42%" border="1">
      <tr>
          <td width="25%">Filtrar A&ntilde;o</td>
          <td width="75%"><select name="cursoA" size="1" class="myTextField" id="cursoA" onChange="evaluaring()" onkeyup=fn(this.form,this)>
            <option value="0" selected="selected">Seleccione A&ntilde;o</option>
            <?php
                                        
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
                                 if(strcmp($row4["id_inscriptosxcurso"],$cursoI)==0)
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
				
					$tip29 = pg_query($conn,'select codigo_barras,apellido,inscripto.nombre AS "nombreInscripto",id_pagosencoop,pagosencoop.monto,num_recibo,monto_pagado from pagosencoop full outer join inscriptosxcurso on(pagosencoop.fk_inscriptosxcursos=inscriptosxcurso.id_inscriptosxcurso) full outer join inscripto on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where cursos.id_cursos='.$cursoF.' and pagosencoop.fk_inscriptosxcursos='.$cursoI.'  Order By apellido, inscripto.nombre, pagosencoop.id_pagosencoop');
					
					}
		//		}
		//	}
		//}
 ?>
</form>

    <table width="100%" border="1">
      <tr>
        <td width="10%" bgcolor="#666666">Apellido</td>
        <td width="10%" bgcolor="#666666">Nombre</td>
        <td width="12%" bgcolor="#666666">Cantida cuotas </td>
        <td width="6%" bgcolor="#666666">N&deg; Cuota</td>
        <td width="7%" bgcolor="#666666">Monto</td>
        <td width="10%" bgcolor="#666666">Estado</td>
		<td width="10%" bgcolor="#666666">Pagar </td>        
      </tr>
       <? $var=0;
	   	  $cont=0;
		  if 	(($cursoF!=0) and ( $cursoI!=0)){
	   while($row29 = pg_fetch_array($tip29)){
			$controlBoton = 0;
	   		$cont=$cont+1;
			$codigoBarras = $row29['codigo_barras'];
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
        <td <?=$color?>><?=$row29["nombreInscripto"]?></td>
        <td <?=$color?>><?=$codigoBarras[5]?></td>
        <td <?=$color?>><?=$codigoBarras[4]?></td>
		<form action="controlPago.php" method="post">
        <td <?=$color?>><input type="text" id="m<?=$row29["id_pagosencoop"]?>" name="monto" value="<?=$row29["monto"]?>" onKeyPress="return NO_letra(event)"/> </td>
        <td <?=$color?>><?php 
		$idPasar = $row29['id_pagosencoop'];			
		echo '<input type="hidden" value="'.$idPasar.'" name="idPasar"/>';
		echo '<input type="hidden" value="'.$cursoI.'" name="cursoI"/>';
		echo '<input type="hidden" value="'.$cursoF.'" name="cursoF"/>';
		
			$numRecibo = $row29['num_recibo'];
			if($numRecibo != NULL){
				echo 'Pagado';
				$controlBoton = 0;
			}else{
				$montoPagado = $row29['monto_pagado'];
				if($montoPagado != NULL){
					echo 'Pagado por Secretaria';
					$controlBoton = 0;
				}else{
					echo 'No pagado';
					$controlBoton = 1;
				}
			}
		?></td>
        <td <?=$color?> align="center">
		<?
		if($controlBoton == 0){
			echo '<input type="button" value="Pagar" disabled />';
		}else{
			
			echo '<input type="submit" value="Pagar"/>';
			//pagar('.$row29['id_pagosencoop'].'
		}
		?>
		</td>
		</form>
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

    </td>
  </tr>
  </table>
</body>
</html>

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
   if (key < 47 && key > 58 ) 
   {	
	  return false;
   }
      return true;
   }  
   function ValidaSoloNumeros() {
    if ((event.keyCode < 48) || (event.keyCode > 57)) 
    event.returnValue = false;
    }
   function evaluaring(academico)
	{
		document.form1.submit(); 
	}
	function evaluaring2(f)
	{
		document.form2.submit(); 
	}
	function evaluaring3(f)
	{
		document.form3.submit(); 
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Pago a docentes</title>
</head>
<?php
@$control = $_REQUEST['control'];
if($control == 1){
	$cuota = $_REQUEST['cuota'];
	$cursoF = $_REQUEST['cursoF'];
	$cursoA = $_REQUEST['cursoA'];
	$materiales = $_REQUEST['materiales'];
}else{
	$materiales = 0;

}
if($control == 2){
		$cuota = $_REQUEST['cuota'];
		$cursoF = $_REQUEST['cursoF'];
		$cursoA = $_REQUEST['cursoA'];
		$materiales = $_REQUEST['materiales'];
		$porcOEfect = $_REQUEST['porcOEfect'];
		$descuento = $_REQUEST['descuento'];
}else{
	$porcOEfect = 0;
	$descuento = 0;
}
?>
<body onLoad="tunCalendario();">
<table width="100%"  border="1" align="center">
<form id="form1" name="form1" method="post" action="">
  <tr>
    <td height="23" align="center"><p><strong>Estado pago cuotas por alumnos</strong> </p>
      <table width="42%" border="1">
      <tr>
          <td width="25%">Filtrar A&ntilde;o</td>
          <td width="75%"><select name="cursoA" size="1" class="myTextField" id="cursoA" onChange="evaluaring()" onkeyup=fn(this.form,this)>
            <option value="0" selected="selected">Seleccione A&ntilde;o</option>
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
                                                  $tip1 = pg_query($conn,"SELECT id_cursos,nombre,anio FROM cursos where activado='t' AND anio=$cursoA ORDER BY nombre;");
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
		<tr>
          <td width="25%">Filtrar Cuota</td>
          <td width="75%"><select name="cuota" size="1" class="myTextField" id="cuota" onChange="evaluaring()"  onkeyup=fn(this.form,this)>
            <option value="0" selected="selected">Seleccione Cuota</option>
            <?php
										$contadorCuota = 0;
                                         include_once "conexionCursosExtension.php";
												//Trae todos las cuotas que se generaron pago a profesores del curso
												$sqlControlCuotas = pg_query("SELECT * FROM pagodocente WHERE curso_pagodocente=$cursoF");
												
												
												$tip1 = pg_query($conn,"SELECT cantcuota FROM cursos where id_cursos=$cursoF;");
                                                $row1 = pg_fetch_array($tip1);
												$cantCuotas = $row1['cantcuota'];
												for($i=1;$i<$cantCuotas+1;$i++){
													$controlCuota = 0;
													while($rowControlCuotas = pg_fetch_array($sqlControlCuotas)){
														if($rowControlCuotas['nrocuota_pagodocente'] == $i){
															$controlCuota = 1;
														}
													}
													
													if($controlCuota == 0){
														if(strcmp($i,$cuota)==0){
															$seleccionado = " selected";
														}else{
															$seleccionado = "";
														}
														echo "<option value=".$i." $seleccionado>Cuota ".$i."</option>";
													}
												}
                                                 ?>
          </select></td>
        </tr>
    </table>
  </td>
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
		
				if 	(( $cursoF!=0) and ( $cuota!=0)){					
					$tip29 = pg_query($conn,"select apellido,inscripto.nombre as nombreinsc,pagosencoop.monto_pagado as montoinsc,pagosencoop.fechapago,codigo_barras,num_recibo,cursos.nombre from pagosencoop full outer join inscriptosxcurso on(pagosencoop.fk_inscriptosxcursos=inscriptosxcurso.id_inscriptosxcurso) full outer join inscripto on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where cursos.id_cursos=$cursoF and codigo_barras like '____".$cuota."_______'  Order By apellido,inscripto.nombre,num_recibo,apellido");
					}
		//		}
		//	}
		//}
 ?>
</form>
<form id="form1" name="form2" method="post" action="?control=1">
    <table width="50%" border="1" align="center">
      <tr>
        <td width="85%" bgcolor="#666666">Alumno</td>        
        <td width="15%" bgcolor="#666666">Monto</td>
      </tr>
       <? $var=0;
	   	  $cont=0;
		  $contTotal = 0;
			$contNoPag = 0;
		  if (($cursoF!=0) and ( $cuota!=0)){
	   while($row29 = pg_fetch_array($tip29)){
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
		
        <td <?=$color?>><?=$row29["apellido"].', '.$row29["nombreinsc"]?></td>        
        <?php 
		if($row29['num_recibo']<>NULL){
			echo '<td '.$color.' align="right">$ '.$row29["montoinsc"].'</td>';
			$contTotal = $contTotal + $row29['montoinsc'];
		}else{
			echo '<td '.$color.' align="right">$ 0</td>';
		}
		}
		}?>
    </table>
	
	<table width="50%" border="1" align="center">
		<tr>
			<td width="85%">
				Subtotal: 
			</td>
			<td width="15%" align="right">
				<?php echo '$ '.$contTotal; ?>
			</td>
		</tr>		
	<!--</table>
	
	<table width="50%" border="1" align="center">-->
		<tr>
			<td width="85%">
				Materiales: 
			</td>
			<td width="15%" align="right">
				$ <input type="text" name="materiales" style="text-align:right" value="<?php echo $materiales;?>" onKeyPress="ValidaSoloNumeros()" onchange="evaluaring2(this)" size="2"/>
				<input type="hidden" name="cursoA" value="<?php echo $cursoA?>" />
				<input type="hidden" name="cursoF" value="<?php echo $cursoF?>" />
				<input type="hidden" name="cuota" value="<?php echo $cuota?>" />
			</td>
		</tr>		
	<!--</table>-->
	</form>
	<form name="form3" method="post" action="?control=2">
	<!--<table width="50%" border="1" align="center">-->
		<tr>
			<td width="70%">
				Descuento: 
			</td>
			<td width="30%" align="right">
				<?php
				if($porcOEfect == 1){
					echo '<input type="radio" value="1" name="porcOEfect" checked>Porcentaje</input> &nbsp;&nbsp;<input type="radio" value="2" name="porcOEfect">Efectivo</input> <br>';					
				}else{
					echo '<input type="radio" value="1" name="porcOEfect">Porcentaje</input> &nbsp;&nbsp;<input type="radio" value="2" name="porcOEfect" checked>Efectivo</input> <br>$';
				}
				?>
				<input type="text" name="descuento" style="text-align:right" value="<?php echo $descuento;?>" onKeyPress="ValidaSoloNumeros()" onchange="evaluaring3(this)" size="2"/>
				<input type="hidden" name="cursoA" value="<?php echo $cursoA?>" />
				<input type="hidden" name="cursoF" value="<?php echo $cursoF?>" />
				<input type="hidden" name="cuota" value="<?php echo $cuota?>" />
				<input type="hidden" name="materiales" value="<?php echo $materiales?>" />
			</td>
		</tr>		
	<!--</table>-->
	</form>
	<form name="form4" method="post" action="guardarPagoDocentes.php">
	<!--<table width="50%" border="1" align="center">-->
		<tr>
			<td width="85%">
				Total a pagar: 
			</td>
			<td width="15%" align="right">
			<?php
			$total = $contTotal - $materiales;
			if($porcOEfect == 1){
				$valorDescuento = ($descuento * $total) / 100;
			}else{
				$valorDescuento = $descuento;				
			}
			$totalAPagar = $total - $valorDescuento;
			?>
				$ <input type="text" name="total" style="text-align:right" value="<?php echo $totalAPagar;?>" onKeyPress="ValidaSoloNumeros()" onchange="evaluaring2(this)" size="2" disabled/>
				<input type="hidden" name="cursoA" value="<?php echo $cursoA?>" />
				<input type="hidden" name="cursoF" value="<?php echo $cursoF?>" />
				<input type="hidden" name="cuota" value="<?php echo $cuota?>" />
				<input type="hidden" name="porcOEfect" value="<?php echo $porcOEfect?>" />
				<input type="hidden" name="descuento" value="<?php echo $descuento?>" />
				<input type="hidden" name="totalPago" value="<?php echo $totalAPagar?>" />
				<input type="hidden" name="materiales" value="<?php echo $materiales?>" />
				<input type="hidden" name="valorDescuento" value="<?php echo $valorDescuento?>" />
			</td>
		</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="Generar Pago"/>
				</td>
			</tr>
	<!--</table>-->
	</form>
	<!--
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
	-->

    </td>
  </tr>
  </table>
</body>
</html>

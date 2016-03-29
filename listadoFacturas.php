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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Listado pago de cuotas en Secretaria</title>
</head>
<body onLoad="tunCalendario();">
<?php
function buscarComa($n){
	$pD = str_replace(',','.',$n);
	return $pD;
}
function buscarPunto($n){
	$pD = str_replace('.',',',$n);
	return $pD;
}

$control = $_REQUEST['control'];
if($control==2){
	$cursoA = $_REQUEST['cursoA'];
}else{
	$cursoA = date("Y");
}
?>
<table width="100%"  border="1" align="center">
<form id="form1" name="form1" method="post" action="?control=2">
  <tr>
    <td height="23" align="center"><p><strong>Listado de cuotas pagadas por secretaria</strong> </p>
      <table width="42%" border="1">
      <tr>
          <td width="25%">Filtrar A&ntilde;o</td>
          <td width="75%">
		  <select name="cursoA" size="1" class="myTextField" id="cursoA" onChange="evaluaring()" onkeyup=fn(this.form,this)>
            <option value="0" selected="selected">Seleccione A&ntilde;o</option>
            <?php
                                        include_once "conexionCursosExtension.php";
										$anio=0;
                                        $tip2 = pg_query($conn,"SELECT anio FROM cursos GROUP BY anio order by anio ASC;");
                                        while($row2 = pg_fetch_array($tip2)){
										if(strcmp($row2["anio"],$cursoA)==0){
                                            $seleccionado = " selected";}
                                       else{
                                       $seleccionado = "";}
                                  		echo "<option value=".$row2["anio"]." $seleccionado>".$row2["anio"]."</option>";
									  }
                                                 ?>
          </select>
		  </td>
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
				
				if 	(( $cursoA!=0)){
					
					//$sqlCursos = pg_query($conn,'SELECT nombreyapellido,cursos.nombre AS "NOMBRECURSO",monto_pagado,fechapago,codigo_barras FROM pagosencoop INNER JOIN inscriptosxcurso ON(inscriptosxcurso.id_inscriptosxcurso = pagosencoop.fk_inscriptosxcursos) INNER JOIN cursos ON(inscriptosxcurso.fk_curso = cursos.id_cursos) WHERE num_recibo IS NULL AND monto_pagado IS NOT NULL AND cursos.anio='.$cursoA.';');
						
						
					//$tip29 = pg_query($conn,"select apellido,inscripto.nombre as nombreinsc,pagosencoop.monto_pagado as montoinsc,pagosencoop.fechapago,codigo_barras,num_recibo,cursos.nombre from pagosencoop full outer join inscriptosxcurso on(pagosencoop.fk_inscriptosxcursos=inscriptosxcurso.id_inscriptosxcurso) full outer join inscripto on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where cursos.id_cursos=$cursoF Order By num_recibo,apellido, inscripto.nombre");
										
					}
		//		}
		//	}
		//}
 ?>
</form>
<form id="form1" name="form2" method="post" action="">
    <table width="100%" border="1" cellspacing="0" cellpadding="2">
      <tr align="center">
        <td width="10%" bgcolor="#666666"><font color="white">Factura Nro</font></td>
        <td width="10%" bgcolor="#666666"><font color="white">Proveedor</font></td>
		<td width="10%" bgcolor="#666666"><font color="white">Curso</font></td>
		<td width="10%" bgcolor="#666666"><font color="white">Material</font></td>
		<td width="10%" bgcolor="#666666"><font color="white">Cantidad</font></td>
		<td width="10%" bgcolor="#666666"><font color="white">Precio Unitario</font></td>
		<td width="10%" bgcolor="#666666"><font color="white">Subtotal</font></td>
      </tr>
	  
       <? 
	   if($cursoA!=0){
	   
			$var=0;
			
	   
			$consultaFactura = pg_query("SELECT * FROM factura INNER JOIN proveedor ON(factura.proveedor_factura = proveedor.id_proveedor)");
			while($rowFactura=pg_fetch_array($consultaFactura)){
				$totalFactura = 0;
			   if ($var==0){
					$color='bgcolor="#FFFFFF"';
					$var=1;
				}else{
					$color='bgcolor="#CCCCCC"';
					$var=0;
				}
				$color2 = 'bgcolor="#CCCCCC"';
				$idFactura = $rowFactura['id_factura'];
				$fechaFactura = $rowFactura['fecha_factura'];
				
				$vFechaFactura = explode('-',$fechaFactura);				
				if($vFechaFactura[0]==$cursoA){
					echo '<tr '.$color2.'>';
						echo '<td>';
							echo $rowFactura['nro_factura'];
						echo '</td>';
						echo '<td>';
							echo $rowFactura['nombre_proveedor'];
						echo '</td>';
						for($i=1;$i<6;$i++){
							echo '<td>';
								echo '&nbsp;';
							echo '</td>';
						}
					echo '</tr>';
					$consultaDatosFactura = pg_query("SELECT * FROM materialesxcurso INNER JOIN cursos ON(materialesxcurso.curso_materialesxcurso = cursos.id_cursos) WHERE factura_materialesxcurso=$idFactura");
					while($rowDatosFactura=pg_fetch_array($consultaDatosFactura)){
						echo '<tr>';
							echo '<td colspan="2">';
								echo '&nbsp;';
							echo '</td>';							
							echo '<td>';
								echo $rowDatosFactura['nombre'];
							echo '</td>';
							echo '<td>';
								echo $rowDatosFactura['descripcion_materialesxcurso'];
							echo '</td>';
							echo '<td>';
								echo '&nbsp;'.$rowDatosFactura['cantidad_materialesxcurso'];
							echo '</td>';
							echo '<td align="right">';
								echo '$ '.buscarPunto($rowDatosFactura['preciounitario_materialesxcurso']);
							echo '</td>';
							$subtotal = $rowDatosFactura['cantidad_materialesxcurso'] * $rowDatosFactura['preciounitario_materialesxcurso'];
							echo '<td align="right">';
								echo '$ '.buscarPunto($subtotal);
							echo '</td>';
							$totalFactura = $totalFactura + $subtotal;
						echo '</tr>';
					}
					echo '<tr>';
						echo '<td colspan="6">';
							echo 'Total:';
						echo '</td>';
						echo '<td align="right">';
							echo '$ '.buscarPunto($totalFactura);
						echo '</td>';
					echo '</tr>';
				}
	
		}
	}
		   ?>
    </table>	
	<table width="100%" border="1">
  <tr>
	<td align="center">  
          
	<?php echo '<a href="excelFacturas.php?anio='.$cursoA.'"><input type="button" value="Excel"/></a>';?>
      </td>
  </tr>
	</table>
</form>
    </td>
  </tr>
  </table>
</body>
</html>

<?

header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-disposition: attachment;filename=ListadoFacturas.xls");

?>
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

?>
<table width="100%"  border="1" align="center">
  <tr>
    <td>
    <?
    include "conexionCursosExtension.php";	
	$cursoA = $_REQUEST['anio'];
 ?>

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
</form>
    </td>
  </tr>
  </table>
</body>
</html>

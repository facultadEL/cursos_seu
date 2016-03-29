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
   function ValidaSoloNumeros(){
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
<title>Cargar materiales</title>
</head>
<?php
include "conexionCursosExtension.php";	
function buscarComa($n){
	$pD = str_replace(',','.',$n);
	return $pD;
}

@$control = $_REQUEST['control'];

if($control == 2){
	
	//$cursoF = $_REQUEST['cursoF'];
	//$cursoA = $_REQUEST['cursoA'];
	$nroFactura = $_REQUEST['nroFactura'];
	$diaF = $_REQUEST['diaF'];
	$mesF = $_REQUEST['mesF'];
	$anioF = $_REQUEST['anioF'];
	$fechaPasar = $anioF.'-'.$mesF.'-'.$diaF;
	$proveedor = $_REQUEST['proveedor'];
	if($proveedor == 0){
		$proveedorNoCreado = $_REQUEST['proveedorNoCreado'];
	}
	for($i=1;$i<16;$i++){
		$cant = 'cant'.$i;
		$desc = 'desc'.$i;
		$prec = 'prec'.$i;		
		$curso = 'curs'.$i;

		$cantidad = $_REQUEST[$cant];
		$descripcion = $_REQUEST[$desc];
		$precioCC = $_REQUEST[$prec];
		//$cursos = $_REQUEST[$curso];

		$vCant[$i] = $_REQUEST[$cant];
		$vDesc[$i] = $_REQUEST[$desc];
		$vPrec[$i] = $_REQUEST[$prec];
		$vCurso[$i] = $_REQUEST[$curso];
		//echo $_REQUEST[$curso];

		$precio = buscarComa($precioCC);

		if($precio != NULL){
			if($cantidad != NULL){
				$precioTotal = $precio * $cantidad;			
			}else{
				$cantidad = 1;
				$precioTotal = $precio * $cantidad;
			}
			$vPrecTotal[$i] = $precioTotal;
			$totalSumado = $totalSumado + $precioTotal;
		}
		
	}

}else{
	for($i=1;$i<16;$i++){
		
		$vCant[$i] = "";
		$vDesc[$i] = "";
		$vPrec[$i] = "";
		$vCurso[$i] = "";

		
	}	
	$anioF = date("Y");	
}
?>
<body onLoad="tunCalendario();">
<table width="100%"  border="1" align="center">
  <tr>
    <td height="23" align="center"><p><strong>Cargar materiales</strong> </p>      
  </td>
  </tr>
  <tr>
  <td height="23" align="center"><p><strong><a href="listadoFacturas.php">Listado Facturas</a></strong> </p>    
  </td>
  </tr>
  <tr>
    <td>
    <?
    

 ?>
<form id="form1" name="form2" method="post" action="?control=2">
    <table width="100%" border="1" align="left">
		<tr>
			<td colspan="5" align="center">
				N&deg; Factura: <input type="text" style="text-align:right" name="nroFactura" value="<?php echo $nroFactura;?>"/>
			</td>
		</tr>
		<tr>
			<td colspan="5" align="center">
				Proveedor: 
				<select size="1" name="proveedor">
				<?php
				
					$sqlProveedores = pg_query("SELECT * FROM proveedor");
					while($rowProveedores = pg_fetch_array($sqlProveedores)){
						$idProveedor = $rowProveedores['id_proveedor'];
						if($idProveedor = $proveedor){
							$select = "selected";
						}else{
							$select = "";
						}
						
						echo '<option value="'.$idProveedor.'" '.$select.' >'.$rowProveedores['nombre_proveedor'].'</option>';
					}
				?>
				<option value="0">Otro</option>
				</select>
				
				
				
			</td>
		</tr>
		<tr>
			<td colspan="5" align="center">
			<i>En caso de que la opcion de arriba sea Otro</i>
			<br>
			Proveedor Nuevo: <input type="text" name="proveedorNoCreado" value="<?php echo $proveedorNoCreado;?>"/>
			
			</td>
		</tr>
		<tr>
			<td colspan="5" align="center">
				Fecha: <input type="text" name="diaF" placeholder="dd" size="2" maxlength="2" onKeyPress="ValidaSoloNumeros()" value="<?php echo $diaF;?>"/>/<input type="text" placeholder="mm" name="mesF" size="2" maxlength="2" onKeyPress="ValidaSoloNumeros()" value="<?php echo $mesF;?>"/>/<input type="text" placeholder="aaaa" name="anioF" size="4" onKeyPress="ValidaSoloNumeros()" maxlength="4" value="<?php echo $anioF;?>"/>
			</td>
		</tr>
      <tr>      	
        <td width="5%" bgcolor="#666666"><font color="white">Cantidad</font></td>        
		<td width="40%" bgcolor="#666666"><font color="white">Descripci&oacute;n</font></td>
		<td width="7%" bgcolor="#666666"><font color="white">Precio Unitario</font></td>
		<td width="7%" bgcolor="#666666"><font color="white">Precio Total</font></td>
		<td width="7%" bgcolor="#666666"><font color="white">Curso</font></td>		
      </tr>
	  <?php
	  $controlRow = 0;
	  for($i=1;$i<16;$i++){
	  echo '<tr>';
		$cant = 'cant'.$i;
		$desc = 'desc'.$i;
		$prec = 'prec'.$i;
		$precTotal = 'precTotal'.$i;
		$curso = 'curs'.$i;
		echo '<td><input type="text" style="text-align:right" name="'.$cant.'" value="'.$vCant[$i].'" size="4" onKeyPress="ValidaSoloNumeros()" /></td>';		
		echo '<td><input type="text" name="'.$desc.'" value="'.$vDesc[$i].'" size="90"/></td>';
		echo '<td align="right">$<input type="text" style="text-align:right" name="'.$prec.'" value="'.$vPrec[$i].'" size="3" /></td>';
		echo '<td align="right">$<input type="text" style="text-align:right" name="'.$precTotal.'" value="'.$vPrecTotal[$i].'" size="3"  disabled /></td>';
		echo '<td>';
		
			echo '<select name="'.$curso.'" size="1">';
			echo '<option value="0">-Seleccionar Curso'.$curso.'-</option>';
			$anioCurso = date("Y");
			$sqlCursos = pg_query("SELECT * FROM cursos WHERE anio=$anioCurso ORDER BY nombre");
			while($rowCursos = pg_fetch_array($sqlCursos)){
				//echo '<option value="algo">'.$vCurso[$i].' - '.$rowCursos['id_cursos'].'</option>';
				$idCursosControl = $rowCursos['id_cursos'];
				if($vCurso[$i] == $idCursosControl){
					echo '<option value="'.$rowCursos['id_cursos'].'" selected >'.$rowCursos['nombre'].'</option>';
				}else{
					echo '<option value="'.$rowCursos['id_cursos'].'">'.$rowCursos['nombre'].'</option>';
				}
				
			}
			echo '</select>';
		
		/*
		echo '<input type="text" name="'.$curso.'" size="3" value="'.$vCurso[$i].'" onKeyPress="ValidaSoloNumeros()" />';
		*/
		echo '</td>';		
		echo '</tr>';
		
	  }
	  ?>
	  <tr>
		<td colspan="3" align="right">
			<input type="button" value="Calcular" onClick="evaluaring2()" />
		</td>
		</form>
		<form action="guardarMateriales.php" method="post" name="formGuardar">
		<td align="right">
			$<input type="text" style="text-align:right" name="calculadoTotal" size="5" value="<?php echo $totalSumado;?>" disabled />
			
		</td>
		<td colspan="1">
		 &nbsp;
		</td>
		<?php
	  for($i=1;$i<16;$i++){
	  
		$cant = 'cant'.$i;
		$desc = 'desc'.$i;
		$prec = 'prec'.$i;
		$curso = 'curs'.$i;
		
		echo '<input type="hidden" name="'.$desc.'" value="'.$vDesc[$i].'" size="90"/>';
		echo '<input type="hidden" style="text-align:right" name="'.$cant.'" value="'.$vCant[$i].'" size="4" onKeyPress="ValidaSoloNumeros()" />';		
		echo '<input type="hidden" style="text-align:right" name="'.$prec.'" value="'.$vPrec[$i].'" size="4" onKeyPress="ValidaSoloNumeros()" />';
		echo '<input type="hidden" style="text-align:right" name="'.$curso.'" value="'.$vCurso[$i].'" size="4" onKeyPress="ValidaSoloNumeros()" />';

		
	  }	  
	  ?>
	  </tr>
	  <tr>
		<td colspan="5" align="center">
			<input type="hidden" name="cursoF" value="<?php echo $cursoF;?>" />
			<input type="hidden" name="nroFactura" value="<?php echo $nroFactura;?>" />
			<input type="hidden" name="fechaPasar" value="<?php echo $fechaPasar;?>" />
			<input type="hidden" name="proveedor" value="<?php echo $proveedor;?>" />
			<input type="hidden" name="proveedorNoCreado" value="<?php echo $proveedorNoCreado?>" />
			<input type="submit" name="guardarMateriales" value="Guardar" />
		</td>
	  </tr>
	<!--</table>-->
	</form>

    </td>
  </tr>
  </table>
</body>
</html>
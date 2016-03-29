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
<title>Asignar gastos a docente</title>
</head>
<?php

function buscarComa($n){
	$pD = str_replace(',','.',$n);
	return $pD;
}

@$control = $_REQUEST['control'];

if($control == 1){
	$cuota = $_REQUEST['cuota'];
	$cursoF = $_REQUEST['cursoF'];
	$cursoA = $_REQUEST['cursoA'];	
}
if($control == 2){
	
	$cursoF = $_REQUEST['cursoF'];
	$cursoA = $_REQUEST['cursoA'];

	for($i=1;$i<16;$i++){
		$cant = 'cant'.$i;
		$desc = 'desc'.$i;
		$prec = 'prec'.$i;

		$cantidad = $_REQUEST[$cant];
		$descripcion = $_REQUEST[$desc];
		$precioCC = $_REQUEST[$prec];

		$vCant[$i] = $_REQUEST[$cant];
		$vDesc[$i] = $_REQUEST[$desc];
		$vPrec[$i] = $_REQUEST[$prec];		

		$precio = buscarComa($precioCC);

		if($precio != NULL){
			if($cantidad != NULL){
				$precioTotal = $precio * $cantidad;			
			}else{
				$cantidad = 1;
				$precioTotal = $precio * $cantidad;
			}
			$totalSumado = $totalSumado + $precioTotal;
		}
		
	}

}else{
	for($i=1;$i<16;$i++){
		
		$vCant[$i] = "";
		$vDesc[$i] = "";
		$vPrec[$i] = "";

		
	}	
	
}
?>
<body onLoad="tunCalendario();">
<table width="100%"  border="1" align="center">
<form id="form1" name="form1" method="post" action="?control=1">
  <tr>
    <td height="23" align="center"><p><strong>Asignar gastos a docente</strong> </p>
      <table width="42%" border="1">
      <!--
	  <tr>
          <td width="25%">Filtrar A&ntilde;o</td>
          <td width="75%"><select name="cursoA" size="1" class="myTextField" id="cursoA" onChange="evaluaring()" onkeyup=fn(this.form,this)>
            <option value="0" selected="selected">Seleccione A&ntilde;o</option>
            <?php
			$cursoA = date('Y');
			echo $cursoA;
			/*
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
									  */
                                                 ?>
          </select></td>
        </tr>
		-->
        <tr>
          <td width="25%">Filtrar Curso</td>
          <td width="75%">
		  <input type="hidden" name="cursoA" value="<?php echo $cursoA;?>" />
		  <select name="cursoF" size="1" class="myTextField" id="cursoF" onChange="evaluaring()"  onkeyup=fn(this.form,this)>
		  <option value="0" selected="selected">Seleccione el Curso</option>
            <?php
                                         include_once "conexionCursosExtension.php";
                                                  $tip1 = pg_query($conn,"SELECT id_cursos,nombre,anio FROM cursos where activado='t' AND anio=$cursoA ORDER BY nombre ASC;");
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
  </td>
  </tr>
  <tr>
    <td>
    <?
    include "conexionCursosExtension.php";	

 ?>
</form>
<form id="form1" name="form2" method="post" action="?control=2">
    <table width="30%" border="1" align="center">
    	<tr>
    		<td colspan="4" align="center">
    			Listado Materiales
    		</td>
		</tr>
      <tr>
      	<input type="hidden" name="cursoA" value="<?php echo $cursoA;?>" />
		<input type="hidden" name="cursoF" value="<?php echo $cursoF;?>" />
        <td width="65%" bgcolor="#666666"><font color="white">Descripci&oacute;n</font></td>
		<td width="5%" bgcolor="#666666" align="right"><font color="white">Cantidad</font></td>        
		<td width="15%" bgcolor="#666666" align="right"><font color="white">Precio Unitario</font></td>
		<td width="15%" bgcolor="#666666" align="right"><font color="white">Precio Total</font></td>
      </tr>
	  <?php
	  
  		$datosMateriales = pg_query("SELECT * FROM materialesxcurso WHERE curso_materialesxcurso='$cursoF'");
  		while($rowMateriales = pg_fetch_array($datosMateriales)){
  			echo '<tr>';
  				echo '<td>';
  					echo $rowMateriales['descripcion_materialesxcurso'];
				echo '</td>';
				echo '<td align="right">';
					echo $rowMateriales['cantidad_materialesxcurso'];
				echo '</td>';
				echo '<td align="right">';
					echo '$ '.$rowMateriales['preciounitario_materialesxcurso'];
				echo '</td>';
				echo '<td align="right">';
					$precioTotal = $rowMateriales['preciototal_materialesxcurso'];
					$sumaTotal = $sumaTotal + $precioTotal;
					echo '$ '.$precioTotal;
				echo '</td>';
  			echo '</tr>';
  		}

	  ?>
	  <tr>
	  	<td colspan="3" align="left">
	  		<b>Total</b>
	  	</td>
	  	<td align="right">
	  		<?php
	  			echo '$ '.$sumaTotal;
	  		?>
  		</td>
  		</tr>
	  <tr>
		<td colspan="3" align="right">
			<input type="button" value="Calcular" onClick="evaluaring2()" />
		</td>
		</form>
		<form action="guardarMateriales.php" method="post" name="formGuardar">
		<td align="right">
			$<input type="text" style="text-align:right" name="calculadoTotal" size="5" value="<?php echo $totalSumado;?>" disabled />
			
		</td>
		<?php
	  for($i=1;$i<16;$i++){
	  
		$cant = 'cant'.$i;
		$desc = 'desc'.$i;
		$prec = 'prec'.$i;
		
		echo '<input type="hidden" name="'.$desc.'" value="'.$vDesc[$i].'" size="90"/>';
		echo '<input type="hidden" style="text-align:right" name="'.$cant.'" value="'.$vCant[$i].'" size="4" onKeyPress="ValidaSoloNumeros()" />';		
		echo '<input type="hidden" style="text-align:right" name="'.$prec.'" value="'.$vPrec[$i].'" size="4" onKeyPress="ValidaSoloNumeros()" />';

		
	  }	  
	  ?>
	  </tr>
	  <tr>
		<td colspan="4" align="center">
			<input type="hidden" name="cursoF" value="<?php echo $cursoF;?>" />
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
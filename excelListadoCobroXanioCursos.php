<?
header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-disposition: attachment;filename=TotalCobradoPorAño.xls");
?>
<script>
	function NO_letra(e){
	key=(document.all) ? e.keyCode : e.which;
	if( e.which == 0 ){return true;}
	if ((key > 47 && key < 58 ) || (key == 8)){
		return true;
	}
	return false;
	}//fin funcion
	function NO_letra2(e){
	key=(document.all) ? e.keyCode : e.which;
	if( e.which == 0 ){return true;}
	if (key > 47 && key < 58 ){	
		return false;
	}
	return true;
	}  
	function evaluaring(academico){
		document.form1.submit(); 
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Total cobrado por a&ntilde;o</title>
</head>
<body onLoad="tunCalendario();">
	<table width="100%"  border="1" align="center">
	<form id="form1" name="form2" method="post" action="">
	<?
		$cursoA = $_REQUEST['anioSeleccionado'];
		include "conexionCursosExtension.php";
			if 	(( $cursoA!=0)){					
				$sqlCursos = pg_query($conn,"SELECT * FROM cursos where anio='$cursoA' AND activado='t' ORDER BY nombre ASC;");
			}
	?>
		<table width="100%" border="1">
		  <tr>
			<td width="10%" align="center" bgcolor="#666666">Curso</td>
			<td width="10%" align="center" bgcolor="#666666">Cantidad cobrada por curso</td>
		  </tr>
		  
		   <? 
		   if($cursoA!=0){
		   $var=0;
		   $totalCuotas = 0;
			while($rowCursos=pg_fetch_array($sqlCursos)){
			$cuotasxCurso = 0;
			   if ($var==0)
					{
					$color='bgcolor="#FFFFFF"';
					$var=1;
					}else{
					$color='bgcolor="#CCCCCC"';
					$var=0;
				}
			$idCursoL = $rowCursos['id_cursos'];
			$sqlInscriptos = pg_query("SELECT id_inscriptosxcurso FROM inscriptosxcurso WHERE fk_curso='$idCursoL'");
			while($rowInscriptos = pg_fetch_array($sqlInscriptos)){
				$idInscriptoxCurso = $rowInscriptos['id_inscriptosxcurso'];
				$sqlCuotas = pg_query("SELECT * FROM pagosencoop WHERE fk_inscriptosxcursos='$idInscriptoxCurso' ORDER BY codigo_barras");
				while($rowCuotas=pg_fetch_array($sqlCuotas)){
					$numRecibo = $rowCuotas['num_recibo'];
					if($numRecibo!=''){	
						if($rowCuotas['monto_c_descuento']!=NULL){
							$cuotasxCurso = $cuotasxCurso + $rowCuotas['monto_c_descuento'];
						}else{
							$cuotasxCurso = $cuotasxCurso + $rowCuotas['monto'];
						}
					}
				}
			}
			
			echo '<tr>';
				echo '<td '.$color.' >'.$rowCursos['nombre'].' - '.$idCursoL.'</td>';
				echo '<td '.$color.' align="right"> $ '.$cuotasxCurso.'</td>';
			echo '</tr>';
				$totalCuotas = $totalCuotas+$cuotasxCurso;
		
		}
		}
			   ?>
		</table>
		<table width="100%" border="1" align="center">
			<tr><td align="center">&nbsp;</td></tr>
			<tr>
				<td align="center">
					Total cobrado en el a&ntilde;o: 
				</td>
				<td align="rigth">
					<?php echo '$ '.$totalCuotas; ?>
				</td>
			</tr>
		</table>
	</form>
	  </table>
</body>
</html>
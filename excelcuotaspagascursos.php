<?

header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-disposition: attachment;filename=ListadoCuotasCursos.xls");

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
<title>Total de alumnos por a&ntilde;o</title>
</head>
<body onLoad="tunCalendario();">
<table width="100%"  border="1" align="center">
<form id="form1" name="form1" method="post" action="">
  
    <td>
    <?
	$cursoA = $_REQUEST['anio'];
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
					
					$sqlCursos = pg_query($conn,"SELECT * FROM cursos where anio='$cursoA' AND activado='t' ORDER BY nombre ASC");
						
						
					//$tip29 = pg_query($conn,"select apellido,inscripto.nombre as nombreinsc,pagosencoop.monto_pagado as montoinsc,pagosencoop.fechapago,codigo_barras,num_recibo,cursos.nombre from pagosencoop full outer join inscriptosxcurso on(pagosencoop.fk_inscriptosxcursos=inscriptosxcurso.id_inscriptosxcurso) full outer join inscripto on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where cursos.id_cursos=$cursoF Order By num_recibo,apellido, inscripto.nombre");
										
					}
		//		}
		//	}
		//}
 ?>
</form>
<form id="form1" name="form2" method="post" action="">
    <table width="100%" border="1">
      <!--<tr>
        <td width="10%" bgcolor="#666666">Curso</td>
        <td width="10%" bgcolor="#666666">Cantidad de alumnos</td>
      </tr>-->
	  <tr>
	<td align="center" width="30%">
		<font size="4">Cursos</font>
	</td>
	<td align="center" width="30%">
		<font size="4">Alumnos</font>
	</td>
	<td width="20%">
	<font size="4">Cuotas Pagadas</font>
	</td>
	<td width="20%">
	<font size="4">Cuotas No Pagadas</font>
	</td>
  </tr>
  
       <? 
	   if($cursoA!=0){
	   $totalPagado = 0;
	   $totalNoPagado = 0;
	   $contadorAlumnos = 0;
		while($rowCursos=pg_fetch_array($sqlCursos)){
		$var=0;
		echo '<tr>';
		echo '<td bgcolor="#666666">';
			echo '<font color="#FFFFFF">'.$rowCursos['nombre'].'</font>';
		echo '</td>';
		echo '<td>';
		echo '&nbsp;';
		echo '</td>';
		echo '<td>';
		echo '&nbsp;';
		echo '</td>';
		echo '<td>';
		echo '&nbsp;';
		echo '</td>';
		echo '</tr>';
		
		$idCursoL = $rowCursos['id_cursos'];
		$sqlAlumnos = pg_query("SELECT * FROM inscriptosxcurso INNER JOIN inscripto ON(inscriptosxcurso.fk_inscriptos = inscripto.id_inscripto) WHERE inscriptosxcurso.fk_curso='$idCursoL' ORDER BY apellido, nombre ASC");
		while($rowAlumnos=pg_fetch_array($sqlAlumnos)){
		
		$cuotasPagadas = '';
		$cuotasNoPagadas = '';
		
		$idIXC = $rowAlumnos['id_inscriptosxcurso'];
		$sqlCuotas = pg_query("SELECT * FROM pagosencoop WHERE fk_inscriptosxcursos=$idIXC ORDER BY codigo_barras ASC");
		while($rowCuotas=pg_fetch_array($sqlCuotas)){
			$cuotaNro = $rowCuotas['codigo_barras'];
			if($rowCuotas['num_recibo']!=NULL){
				$cuotasPagadas = $cuotasPagadas.$cuotaNro[4].' - ';
				if($rowCuotas['monto_c_descuento']==NULL){
						$totalPagado = $totalPagado + $rowCuotas['monto'];
				}else{
					$totalPagado = $totalPagado + $rowCuotas['monto_c_descuento'];
				}				
			}else{
				if($rowCuotas['num_recibo']==NULL){
				$cuotasNoPagadas = $cuotasNoPagadas.$cuotaNro[4].' - ';
				if($rowCuotas['monto_c_descuento']==NULL){
						$totalNoPagado = $totalNoPagado + $rowCuotas['monto'];
				}else{
					$totalNoPagado = $totalNoPagado + $rowCuotas['monto_c_descuento'];
				}
				}
			}

		}
			if ($var==0)
		   		{
				$color='bgcolor="#FFFFFF"';
				$var=1;
				}else{
				$color='bgcolor="#DDDDDD"';
				$var=0;
			}
		
		   echo '<tr>';
			echo '<td>';
			echo '<font color="#FFFFFF">'.$rowCursos['nombre'].'</font>';
			echo '</td>';
			echo '<td '.$color.' >'.$rowAlumnos['apellido'].', '.$rowAlumnos['nombre'].'</td>';
			echo '<td '.$color.' >'.$cuotasPagadas.'</td>';
			echo '<td '.$color.' >'.$cuotasNoPagadas.'</td>';
			echo '</tr>';
	
		}
	}
	}
		   ?>
    </table>
	<!--
	<table width="50%" border="1" align="center">
		<tr>
			<td>
				Total de Alumnos en el a&ntilde;o: 
			</td>
			<td align="right">
				
			</td>
		</tr>
	</table>
	-->

</form>
    </td>
  </tr>
  </table>
</body>
</html>

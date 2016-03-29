<?

header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-disposition: attachment;filename=AlumnoMorosos.xls");

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
<title>Untitled Document2</title>
</head>
<body onLoad="tunCalendario();">
<table width="100%"  border="1" align="center">
<form id="form1" name="form1" method="post" action="">
    <?
	$cursoA = $_REQUEST['anio'];
	$cursoF = $_REQUEST['curso'];
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
				
				if 	(( $cursoF!=0)){
					$tip1 = pg_query($conn,"SELECT cantcuota FROM cursos where id_cursos=$cursoF;");
						$row1 = pg_fetch_array($tip1);
						$cantCuotas = $row1['cantcuota'];				
					//$tip29 = pg_query($conn,"select apellido,inscripto.nombre as nombreinsc,pagosencoop.monto_pagado as montoinsc,pagosencoop.fechapago,codigo_barras,num_recibo,cursos.nombre from pagosencoop full outer join inscriptosxcurso on(pagosencoop.fk_inscriptosxcursos=inscriptosxcurso.id_inscriptosxcurso) full outer join inscripto on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where cursos.id_cursos=$cursoF Order By num_recibo,apellido, inscripto.nombre");
					$tipAlumnos = pg_query($conn,"select id_inscriptosxcurso,apellido,inscripto.nombre as nombreinsc from inscriptosxcurso full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) full outer join inscripto on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) where cursos.id_cursos=$cursoF AND activado='t' Order by inscripto.apellido,inscripto.nombre ASC");
					}
		//		}
		//	}
		//}
 ?>
</form>
<form id="form1" name="form2" method="post" action="">
    <table width="100%" border="1">
      <tr>
        <td width="10%" bgcolor="#666666">Apellido</td>
        <td width="10%" bgcolor="#666666">Nombre</td>
        <td width="6%" bgcolor="#666666">Cuotas adeudadas</td>
        <!--<td width="7%" bgcolor="#666666">Monto</td>
        <td width="10%" bgcolor="#666666">Fecha de pago </td>
        <td width="10%" bgcolor="#666666">Estado</td> -->
      </tr>
       <? $var=0;
	   	  $cont=0;
		  $totalDebe = 0;
			$contNoPag = 0;
		  if (($cursoF!=0)){
	   while($row29 = pg_fetch_array($tipAlumnos)){
	   
		$cuotasAdeudadas = "";
	   
		$idIxCLocal = $row29['id_inscriptosxcurso'];
		$consCuotaxAlumno = pg_query($conn,"select * from pagosencoop where fk_inscriptosxcursos=$idIxCLocal order by codigo_barras");		
		while($rowCuotas = pg_fetch_array($consCuotaxAlumno)){
		$cuotaNro = $rowCuotas['codigo_barras'];
			if($rowCuotas['num_recibo']==NULL){
				$cuotasAdeudadas = $cuotasAdeudadas.$cuotaNro[4].' - ';
				if($rowCuotas['monto_c_descuento']==NULL){
						$totalDebe = $totalDebe + $rowCuotas['monto'];
				}else{
					$totalDebe = $totalDebe + $rowCuotas['monto_c_descuento'];
				}
				
			}
		}
		
		if($cuotasAdeudadas == ''){
			$cuotasAdeudadas = 'No se deben cuotas';
		}
	   		$cont=$cont+1;
			$codigoBarra = $row29['codigo_barra'];
			$numeroCuota = $codigoBarra[4];
			
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
        <td <?=$color?>><?=$row29["nombreinsc"]?></td>
        <td <?=$color?>><?=$cuotasAdeudadas?></td>
        		
        <? ;}}?>
    </table>
	<table width="50%" border="1" align="center">
		<tr>
			<td>
				Total No Pagado: 
			</td>
			<td align="right">
				<?php echo '$ '.$totalDebe; ?>
			</td>
		</tr>
	</table>
</form>
    </td>
  </tr>
  </table>
</body>
</html>

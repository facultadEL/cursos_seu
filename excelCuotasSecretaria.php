<?

header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-disposition: attachment;filename=ListadoAlumnosPorCurso.xls");

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
<title>Pago de cuotas en Secretaria</title>
</head>
<body onLoad="tunCalendario();">
<?php
$cursoA = date("Y");
?>
<table width="100%"  border="1" align="center">
<form id="form1" name="form1" method="post" action="">
  
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
					
					$sqlCursos = pg_query($conn,'SELECT nombreyapellido,cursos.nombre AS "NOMBRECURSO",monto_pagado,fechapago,codigo_barras FROM pagosencoop INNER JOIN inscriptosxcurso ON(inscriptosxcurso.id_inscriptosxcurso = pagosencoop.fk_inscriptosxcursos) INNER JOIN cursos ON(inscriptosxcurso.fk_curso = cursos.id_cursos) WHERE num_recibo IS NULL AND monto_pagado IS NOT NULL AND cursos.anio='.$cursoA.';');
						
						
					//$tip29 = pg_query($conn,"select apellido,inscripto.nombre as nombreinsc,pagosencoop.monto_pagado as montoinsc,pagosencoop.fechapago,codigo_barras,num_recibo,cursos.nombre from pagosencoop full outer join inscriptosxcurso on(pagosencoop.fk_inscriptosxcursos=inscriptosxcurso.id_inscriptosxcurso) full outer join inscripto on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where cursos.id_cursos=$cursoF Order By num_recibo,apellido, inscripto.nombre");
										
					}
		//		}
		//	}
		//}
 ?>
</form>
<form id="form1" name="form2" method="post" action="">
    <table width="100%" border="1">
      <tr>
        <td width="10%" bgcolor="#666666">Curso</td>
        <td width="10%" bgcolor="#666666">Alumno</td>
		<td width="10%" bgcolor="#666666">Cuota N&deg;</td>
		<td width="10%" bgcolor="#666666">Fecha de pago</td>
		<td width="10%" bgcolor="#666666">Monto</td>
      </tr>
	  
       <? 
	   if($cursoA!=0){
	   $var=0;
	   $contadorAlumnos = 0;
		while($rowCursos=pg_fetch_array($sqlCursos)){
		   if ($var==0)
		   		{
				$color='bgcolor="#FFFFFF"';
				$var=1;
				}else{
				$color='bgcolor="#CCCCCC"';
				$var=0;
			}
		echo '<tr>';
			echo '<td '.$color.' >'.$rowCursos['NOMBRECURSO'].'</td>';
			echo '<td '.$color.' >'.$rowCursos['nombreyapellido'].'</td>';
			$codigoBarra = $rowCursos['codigo_barras'];
			echo '<td '.$color.' >'.$codigoBarra[4].'</td>';
			echo '<td '.$color.' >'.$rowCursos['fechapago'].'</td>';
			echo '<td '.$color.' >'.$rowCursos['monto_pagado'].'</td>';
		echo '</tr>';
			
	
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

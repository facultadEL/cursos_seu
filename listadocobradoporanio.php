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
<title>Total cobrado por a&ntilde;o</title>
</head>
<body onLoad="tunCalendario();">
<table width="100%"  border="1" align="center">
<form id="form1" name="form1" method="post" action="">
  <tr>
    <td height="23" align="center"><p><strong>Total cobrado por a&ntilde;o</strong> </p>
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
					
					$sqlCursos = pg_query($conn,"SELECT * FROM cursos where anio='$cursoA' AND activado='t' ORDER BY nombre ASC;");
						
						
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
        <td width="10%" bgcolor="#666666">Cantidad cobrada por curso</td>
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
	<table width="50%" border="1" align="center">
		<tr>
			<td>
				Total cobrado en el a&ntilde;o: 
			</td>
			<td align="right">
				<?php echo '$ '.$totalCuotas; ?>
			</td>
		</tr>
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
			 <a href="excelListadoCobroXanioCursos.php?anioSeleccionado=<?php echo $cursoA;?>"><input type="button" value="Generar Excel"/></a>
      </p></td>
  </tr>
	</table>
</form>
    </td>
  </tr>
  </table>
</body>
</html>

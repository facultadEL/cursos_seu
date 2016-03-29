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
<title>Untitled Document</title>
</head>
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
                                                  $tip1 = pg_query($conn,"SELECT id_cursos,nombre,anio FROM cursos where activado=TRUE and anio=$cursoA;");
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
    <?php
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
					$tip29 = pg_query($conn,"select apellido,inscripto.nombre as nombreinsc,pagosencoop.monto as montoinsc,pagosencoop.fechapago,codigo_barras,num_recibo,cursos.nombre,cursos.cantcuota from pagosencoop full outer join inscriptosxcurso on(pagosencoop.fk_inscriptosxcursos=inscriptosxcurso.id_inscriptosxcurso) full outer join inscripto on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where cursos.id_cursos=$cursoF  Order By pagosencoop.nombreyapellido,pagosencoop.codigo_barras ASC");
					
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
        <td width="6%" bgcolor="#666666">N&deg; Cuota</td>
        <td width="7%" bgcolor="#666666">Monto</td>
        <td width="10%" bgcolor="#666666">Fecha de pago </td>               
      </tr>
       <? $var=0;
	   	  $cont=0;
		  $contTotal = 0;
			$contNoPag = 0;
		if (($cursoF!=0)){
		$nroCuota = 0;
		$valorTotal = 0;
		while($row29 = pg_fetch_array($tip29,NULL,PGSQL_ASSOC)){
			$contTotalCuotas = $row29['cantcuota'];
			$nroCuota = $nroCuota + 1;
			
			if($row29['num_recibo']==NULL){
			
	   		$cont=$cont+1;
			$codigoBarras = $row29['codigo_barras'];
			$valorTotal = $valorTotal + $row29['montoinsc'];
			
			
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
        <td <?=$color?>><?=$nroCuota?></td>
        <td <?=$color?>><?='$ '.$row29["montoinsc"]?>  </td>
        <td <?=$color?>><?=$row29["fechapago"]?>  </td>
		</tr>
        
        <?}
		
		if($nroCuota==$contTotalCuotas){
			$nroCuota = 0;
		}
		}
		}
		?>
    </table>
	<table width="50%" border="1" align="center">
		<tr>
			<td width="70%">
				Total Cuotas No Pagas: 
			</td>
			<td width="30%" align="right">
				<?php echo '$ '.$valorTotal; ?>
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
      </p></td>
  </tr>
	</table>
</form>
    </td>
  </tr>
  </table>
</body>
</html>

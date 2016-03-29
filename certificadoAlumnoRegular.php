<script>
   function evaluaring(form1)
	{
		document.form1.submit(); 
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<form id="form1" name="form1" method="post" action="">
<table width="98%" height="2" border="1" align="center" >
  <tr>
    <td height="23" align="center"><p><strong>Certificado Alumno Regular</strong> </p>
      <table width="42%" border="1">
        <tr>
          <td width="25%">Filtrar Curso</td>
          <td width="75%"><select name="cursoF" size="1" class="myTextField" id="cursoF" onChange="evaluaring()"  onkeyup=fn(this.form,this)>
            <option value="0" selected="selected">Seleccione el Curso</option>
            <?php
                                         include_once "conexionpg.php";
                                                  $tip1 = pg_query($conn,"SELECT id,nombre FROM cursos;");
                                                  while($row1 = pg_fetch_array($tip1)){
                                 if(strcmp($row1["id"],$cursoF)==0)
                                            $seleccionado = " selected";
                                       else
                                       $seleccionado = "";
                                  echo "<option value=".$row1["id"]." $seleccionado>".$row1["nombre"]."</option>";
                                       }
                                                 ?>
          </select></td>
        </tr>
    </table>
      <table width="42%" border="1">
      <tr>
        <td width="25%">Filtrar inscripto </td>
        <td width="75%"><select name="cursoI" size="1" class="myTextField" id="cursoI" onChange="evaluaring()"  onkeyup=fn(this.form,this)  >
            <option value="0" selected="selected">Seleccione el inscripto</option>
            <?php
                                         include_once "conexionpg.php";
                                                  $tip4 = pg_query($conn,"SELECT id,nombre,apellido FROM inscripto WHERE fk_curso=$cursoF ORDER BY apellido;");
                                                  while($row4 = pg_fetch_array($tip4)){
                                 if(strcmp($row4["id"],$cursoI)==0)
                                            $seleccionado = " selected";
                                       else
                                       $seleccionado = "";
                                  echo "<option value=".$row4["id"]." $seleccionado>".$row4["apellido"].' '.$row4["nombre"]."</option>";
                                       }
                                                 ?>
          </select>        </td>
      </tr>
    </table>
    <?
    include "conexionpg.php";	
	if (($cursoF=='' or $cursoF==0) and ($cursoI=='' or $cursoI==0)){
		$tip29 = 1;
	}
	else{
		if (($cursoF!='' or $cursoF!=0) and ($cursoI!='' or $cursoI!=0)){
			$tip29 = pg_query($conn,"select inscripto.nombre,apellido, dni from inscripto,cursos where fk_curso=cursos.id and inscripto.id=$cursoI and cursos.id=$cursoF");
			$tip30 = pg_query($conn,"select cursos.nombre, dia1, dia2, hora_desde, hora_hasta, hora_desde2, hora_hasta2 from inscripto,cursos where fk_curso=cursos.id and inscripto.id=$cursoI and cursos.id=$cursoF");
	//	$tip29 = pg_query($conn,"select inscripto.nombre,apellido, cantcuota, nrocuota, montoxcuota,fechapago,estado,fk_inscripto, pagocuota.descripcion from inscripto,cursos,pagocuota where pagocuota.fk_inscripto=inscripto.id and cursos.id=$cursoF and fk_curso=$cursoF");//}
		/* else{}
			if 	(($cursoF!='' or $cursoF!=0) and ($cursoI=='' or $cursoI==0)){
			$tip29 = pg_query($conn,"select inscripto.nombre,apellido, cantcuota, nrocuota, montoxcuota,fechapago,estado,fk_inscripto, pagocuota.descripcion from inscripto,cursos,pagocuota where pagocuota.fk_inscripto=$cursoI and inscripto.id=$cursoI and fk_curso=cursos.id");
			*/}
		if 	(($cursoF!='' or $cursoF!=0) and ($cursoI=='' or $cursoI==0)){	
			$tip29 = 1;
			}
			/*
			else{
				if 	(($cursoF!='' or $cursoF!=0) and ($cursoI!='' or $cursoI!=0)){*/
					
					
		//		}
	//		}
	}
 ?>
</form>
 <p></p>
<? if ($tip29!= 1) {?>
 <form id="form" name="form" method="post" action="/extension/imprimircertifalumreg.php">
     <table width="100%" border="1">
      <tr>
        <td width="16%" bgcolor="#666666">Apellido</td>
        <td width="18%" bgcolor="#666666">Nombre</td>
        <td width="13%" bgcolor="#666666">DNI</td>
        <td width="12%" bgcolor="#666666">Curso</td>
        <td width="15%" bgcolor="#666666">Dias de curso</td>
        <td colspan="2" bgcolor="#666666">Horas de curso</td>
      </tr>
      <? $var=0;
	   while($row29 = pg_fetch_array($tip29)){
		    while($row30 = pg_fetch_array($tip30)){
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
        <td rowspan="2" <?=$color?>><?=$row29["apellido"]?></td>
        <input type="text" id="apellido" name="apellido" value="<?=$row29["apellido"]?>" style="display:none"/>
        <td rowspan="2" <?=$color?>><?=$row29["nombre"]?></td>
        <input type="text" id="nombre" name="nombre" value="<?=$row29["nombre"]?>" style="display:none"/>
        <td rowspan="2" <?=$color?>><?=$row29["dni"]?></td>
        <input type="text" id="dni" name="dni" value="<?=$row29["dni"]?>" style="display:none"/>
        <td rowspan="2" <?=$color?>><?=$row30["nombre"]?></td>
        <input type="text" id="nombre2" name="nombre2" value="<?=$row30["nombre"]?>" style="display:none"/>
        <td <?=$color?>><?=$row30["dia1"]?></td>
        <input type="text" id="dia1" name="dia1" value="<?=$row30["dia1"]?>" style="display:none"/>
        <td width="12%" <?=$color?>><?=$row30["hora_desde"]?></td>
        <input type="text" id="hora_desde" name="hora_desde" value="<?=$row30["hora_desde"]?>" style="display:none"/>
        <td width="14%" <?=$color?>><?=$row30["hora_hasta"]?></td>
        <input type="text" id="hora_hasta" name="hora_hasta" value="<?=$row30["hora_hasta"]?>" style="display:none"/>
      </tr>
      <tr>
        <td <?=$color?>><?=$row30["dia2"]?></td>
        <input type="text" id="dia2" name="dia2" value="<?=$row30["dia2"]?>" style="display:none"/>
        <td width="12%" <?=$color?>><?=$row30["hora_desde2"]?></td>
        <input type="text" id="hora_desde2" name="hora_desde2" value="<?=$row30["hora_desde2"]?>" style="display:none"/>
        <td width="14%" <?=$color?>><?=$row30["hora_hasta2"]?></td>
        <input type="text" id="hora_hasta2" name="hora_hasta2" value="<?=$row30["hora_hasta2"]?>" style="display:none"/>
      </tr>
      <? }}?>
    </table>
 <table border="0">
 <tr>
    <td height="39" align="center"><input name="Imprimir" type="submit" value="Imprimir" /></td>
  </tr>
  </table>
</form>

<? } ?>

</body>
</html>
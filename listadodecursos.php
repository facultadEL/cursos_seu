<script>
 function evaluaring(academico)
	{
		document.form2.submit(); 
	}
	</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo2 {color: #993333}
-->
</style>
</head>

<body>
<?php
$cursoA = $_REQUEST['cursoA'];
$tipo_curso = $_REQUEST['tipo_curso'];
//echo $cursoA;
//echo $tipo_curso;
?>
<form id="form2" name="form2" method="post" action="">
<table width="100%" border="1" align="center" cellspacing="0">
  <tr>
    <td colspan="2" align="center" valign="bottom"><div align="center"> Datos del Curso </div></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="right">Tipo de  Curso : </div></td>
    <td width="48%" bgcolor="#CCCCCC"><div align="left">
      <select name="tipo_curso" size="1" class="myTextField" id="tipo_curso" onChange="evaluaring()" >
        <option value="0" selected="selected">Seleccione un Tipo de Curso</option>
        <?php
                                         include_once "conexionCursosExtension.php";
                                                  $tip1 = pg_query($conn,"SELECT id_tipo_curso,nombre FROM tipo_curso ORDER BY nombre ASC;");
                                                  while($row1 = pg_fetch_array($tip1)){
                                 if(strcmp($row1["id_tipo_curso"],$tipo_curso)==0)
                                            $seleccionado = " selected";
                                       else
                                       $seleccionado = "";
                                  echo "<option value=".$row1["id_tipo_curso"]." $seleccionado>".$row1["nombre"]."</option>";
                                       }
                                                 ?>
      </select>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="right"> A&ntilde;o : </div></td>
    <td bgcolor="#CCCCCC"><div align="left">
      <select name="cursoA" size="1" class="myTextField" id="anio" onChange="evaluaring()" onkeyup="fn(this.form,this)" >
        <option value="0" selected="selected">Seleccione el a&ntilde;o</option>
        <?php
			
                                         include_once "conexionCursosExtension.php";										 		
                                                 $tip1 = pg_query($conn,"SELECT anio FROM cursos group by anio;");
                                                  while($row1 = pg_fetch_array($tip1)){
													  if(strcmp($row1["anio"],$cursoA)==0){
                                            $seleccionado = " selected";}
                                       else{
                                       $seleccionado = "";}
                                  		echo "<option value=".$row1["anio"]." $seleccionado>".$row1["anio"]."</option>";
									}
                                           ?>
      </select>
    </div></td>
  </tr>
  </form>
  <form>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="14%" rowspan="2" bgcolor="#666666"><strong>Tipo
          Curso</strong></td>
        <td width="25%" rowspan="2" bgcolor="#666666"><strong>Nombre</strong></td>
        <td width="22%" rowspan="2" bgcolor="#666666"><strong>Docente</strong></td>
        <td width="8%" rowspan="2" bgcolor="#666666"><strong>Monto</strong></td>
        <td width="7%" rowspan="2" bgcolor="#666666"><strong>Cantidad Cuotas</strong></td>
        <td colspan="3" align="center" bgcolor="#666666" ><strong>Cursado</strong></td>
		<td width="4%" rowspan="2" align="center" bgcolor="#666666" ><strong>Registros Necesarios</strong></td>
        <td width="4%" rowspan="2" align="center" bgcolor="#666666" ><strong>Ver Mas Datos</strong></td>
        <td width="4%" rowspan="2" align="center" bgcolor="#666666" ><strong>Programa</strong></td>
        <td width="4%" rowspan="2" align="center" bgcolor="#666666" ><strong>Planificaci&oacute;n</strong></td>
        <td width="4%" rowspan="2" align="center" bgcolor="#666666" ><strong>Curriculum</strong></td>
      </tr>
      <tr>
        <td width="8%" bgcolor="#666666"><strong>Desde</strong></td>
        <td width="8%" bgcolor="#666666"><strong>Hasta</strong></td>
        <td width="0%" bgcolor="#666666"><strong>D&iacute;a</strong></td>
        </tr>
      <?
	  if ($cursoA!=0 and $tipo_curso!=0){
           	$tip1 = pg_query($conn,"SELECT cursos.id_cursos, cursos.nombre, fk_programa, fk_planificacion, fk_curriculum, tipo_curso.nombre as tipo, anio, docente, monto,cantcuota, duracion_desde, duracion_hasta, dia1 FROM cursos INNER JOIN tipo_curso ON(cursos.fk_tipo = tipo_curso.id_tipo_curso) where anio=$cursoA and fk_tipo=$tipo_curso ORDER BY cursos.nombre ASC");  
	  }else{		   
			$tip1 = pg_query($conn,"SELECT cursos.id_cursos, cursos.nombre, fk_programa, fk_planificacion, fk_curriculum, tipo_curso.nombre as tipo, anio, docente, monto,cantcuota, duracion_desde, duracion_hasta, dia1 FROM cursos INNER JOIN tipo_curso ON(cursos.fk_tipo = tipo_curso.id_tipo_curso) where fk_tipo=$tipo_curso ORDER BY cursos.nombre ASC");  
		  }
			 $color=0;
		    while($row1 = pg_fetch_array($tip1)){
				if ($color==1) {$var='"#ffffff"'; $color=0;} else { $var='"#cccccc"';  $color=1;}
			
			$cursoF = $row1["id_cursos"];
			$nombre = $row1["nombre"];
			$anio = $row1["anio"];
			$tipo = $row1["tipo"];
			$docente = $row1["docente"];
			$monto = $row1["monto"];
			$cantCuota = $row1["cantcuota"];
			$duracionDesde = $row1["duracion_desde"];
			$duracionHasta = $row1["duracion_hasta"];
			$dia1 = $row1["dia1"];
			$fkPrograma = $row1["fk_programa"];
			$fkPlanificacion = $row1["fk_planificacion"];
			$fkCurriculum = $row1["fk_curriculum"];
			?>
      <tr>
        <td height="33" bgcolor=<?=$var?>><?=$tipo?></td>
        <td bgcolor=<?=$var?>><?=$nombre.' - '.$anio?></td>
        <td bgcolor=<?=$var?>><?=$docente?></td>
        <td bgcolor=<?=$var?>><?=$monto?></td>
        <td bgcolor=<?=$var?>><?=$cantCuota?></td>
        <td bgcolor=<?=$var?>><?=$duracionDesde?></td>
        <td bgcolor=<?=$var?>><?=$duracionHasta?></td>
        <td bgcolor=<?=$var?>><?=$dia1?></td>
		<td align="center" bgcolor=<?=$var?>><a href="registrosNecesarios.php?cursoF=<?=$cursoF?>"><img src="images/registros.png" width="19" height="19" /></a></td>
        <td align="center" bgcolor=<?=$var?>><a href="modifrcurso.php"><img src="images/nuevo.png" width="15" height="15" /></a></td>
        <td align="center" bgcolor=<?=$var?>><div align="center"><a href="noticiascurso/download1.php?idfoto=<?= $fkPrograma?>" target="_blank"><img src="images/impresora.jpg" width="15" height="15" /></a></div></td>
        <td align="center" bgcolor=<?=$var?>><div align="center"><a href="noticiascurso/download1.php?idfoto=<?= $fkPlanificacion?>" target="_blank"><img src="images/impresora.jpg" width="15" height="15" /></a></div></td>
        <td align="center" bgcolor=<?=$var?>><div align="center"><a href="noticiascurso/download1.php?idfoto=<?= $fkCurriculum?>" target="_blank"><img src="images/impresora.jpg" width="15" height="15" /></a></div></td>
      </tr>
      <?
			 }
			 ?>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#999999"><label>
      </label></td>
  </tr>
</table>
</form>
</body>
</html>

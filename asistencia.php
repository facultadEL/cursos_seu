<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--<meta name="viewport" content="width=device-width, initial-scale=0.9 ; charset=latin1"/>  -->

<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.a {
	text-align: center;
}
#form1 table {
	font-weight: bold;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
#form1 table tr td {
	font-size: 18px;
}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /></head>

<body>
<? 
include_once "conexionCursosExtension.php";	
 $tip1 = pg_query($conn,"select count(id_inscriptosxcurso) as cantidad from asistencia full outer join inscriptosxcurso on(asistencia.fk_alumno=inscriptosxcurso.id_inscriptosxcurso) where
  inscriptosxcurso.fk_curso='".$_POST["dato"]."' and asistencia.fecha= '".date("Y/m/d")."'");
 $row1 = pg_fetch_array($tip1);
 if ($row1["cantidad"]!=0)
 {
	 echo '<script language="JavaScript"> 
			alert("La asistencia ya fue guardada");</script>';
			
		echo '<script language="JavaScript"> 
		location ="asismobil.php";
		</script>';
	 } else{
				
?>
<form id="form1" name="form1" method="post" action="guardarasistencia.php">
<table width="45%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>Apellido y Nombre</td>
    <td width="134" class="a"><? echo date("d/m/Y");?></td>
  </tr>
  
 <?  
 				include_once "conexionCursosExtension.php";										 		
                $tip1 = pg_query($conn,"select inscriptosxcurso.id_inscriptosxcurso, inscriptosxcurso.porcdescuento, cursos.anio, inscripto.nombre, inscripto.apellido, cursos.nombre as curso from inscriptosxcurso full outer join inscripto on(inscriptosxcurso.fk_inscriptos = inscripto.id_inscripto) full outer join cursos on(cursos.id_cursos = inscriptosxcurso.fk_curso) where fk_curso='".$_POST["dato"]."' order by inscripto.apellido;");
				
				$cont=0;
				$cantidad=0;
                while($row1 = pg_fetch_array($tip1)){
					
                        if ($cont==0)
						  {
					  	  $var='bgcolor="#CCCCCC"';
						  $cont=1;
						  }else{
						  $var='bgcolor="#CCC999"';
						  $cont=0;
						  }
						  
				
				$cantidad++;
						  ?>
                        
     <tr> <td <?=$var?> width="334"><?= $row1["apellido"].", ".$row1["nombre"]; 
	 include_once "conexionCursosExtension.php";										 		
                $tip2 = pg_query($conn,"select count(id_pagosencoop) as cuota from pagosencoop where fk_inscriptosxcursos=".$row1["id_inscriptosxcurso"]." and fechapago IS NOT NULL;");
				$row2 = pg_fetch_array($tip2);
		echo " ".$row2["cuota"]." - ".$row1["porcdescuento"];	
	 ?></td>
		<td align="center" valign="middle" <?=$var?>class="a">
		  <label>
		    <input type="checkbox" name="<?=$row1["id_inscriptosxcurso"]?>" checked />
	    </label></td>
  </tr>
  <?  } 

  ?>
    <input name="cantidad" type="hidden" value="<?=$cantidad?>" />

     <input name="curso" type="hidden" value="<?=$_POST["dato"]?>" />
 
</table>
<p>
  <input type="submit" name="enviar" id="enviar" value="Enviar" />
</p>
</form>
<? }?>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<script src="./js/jquery.min.js"></script>
<script>

function actionPagosEnCoop(id,boolVal) {
	var param = {
		'id':id,
		'boolVal':boolVal,
	};

	$.ajax({
		data:param,
		type:'POST',
		url:'actionPagosEnCoop.php',
		success: function(response) {
			var r = JSON.parse(response);
			if(r.success) {
				document.form1.submit();
			} else {
				alert('No se pudo anular la cuota');
			}
		},
		error: function(msg) {
			console.log(msg);
		}
	});
}

</script>
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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Cambiar Fecha Vto</title>
</head>
<body>
<?php
$numAlumno = $_REQUEST['numAlumno'];
?>
<table width="100%"  border="1" align="center">
<form id="form1" name="form1" method="post" action="">
  <tr>
    <td width="100%" align="center"><p><strong>Cambiar Fecha Vto</strong> </p></td>
</tr>
</table>
<?php
include_once "conexionCursosExtension.php";

$nombreCompleto = "";
if($numAlumno != null)
{
	$alumnos = pg_query("SELECT * FROM inscriptosxcurso full outer join inscripto on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) WHERE id_inscriptosxcurso=$numAlumno");
	$row = pg_fetch_array($alumnos);
	$apellido = $row['apellido'];
	$nombre = $row['nombre'];	
	$nombreCompleto = $apellido.', '.$nombre;
}
//$alumnos = pg_query($conn,"select * from inscriptosxcurso full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) full outer join inscripto on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join pagosencoop on(pagosencoop.fk_inscriptosxcursos = inscriptosxcurso.id_inscriptosxcurso) WHERE fk_inscriptosxcursos=$numAlumno Order by pagosencoop.codigo_barras ASC");
?>
<table width="100%"  border="1" align="center">
      <tr>
          <td width="25%"><strong>Ingresar N&deg; del Alumno: </strong></td>
	  	<td width="75%"><input type="text" name="numAlumno" size="20" class="myTextField" id="numAlumno" value="<?php echo $numAlumno?>" onChange="evaluaring()" onblur=fn(this.form,this)/>
	  </tr>
	  <?php
	  if($numAlumno != null)
	  {
	  	?>
	  <tr>
          <td colspan="2" align="center"><strong><big><font color="Navy"><?php echo $nombreCompleto?></font></big></strong></td>
	  </tr>
	  <?php
	  }
	  ?>

</form>

<form id="formAnular" name="formAnular" method="post" action="#">
    <table width="100%" border="1">
      <tr>
        <!--<td width="10%" bgcolor="#666666" align="center"><span style="color:white">Apellido</span></td>
        <td width="10%" bgcolor="#666666"align="center"><span style="color:white">Nombre</span></td>-->
		<td width="10%" bgcolor="#C3C3C3"align="center"><span style="color:white">NroCuota</span></td>
        <td width="20%" bgcolor="#C3C3C3" align="center"><span style="color:white">Monto cuota</span></td>
        <td width="40%" bgcolor="#C3C3C3" align="center"><span style="color:white">Fecha Vto</span></td>        
		<td width="40%" bgcolor="#C3C3C3" align="center"><span style="color:white"></span></td>
      </tr>
	  
	  <?php
		$controlNombre = 0;
		$cuotas = pg_query("SELECT * from inscriptosxcurso full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) full outer join pagosencoop on(pagosencoop.fk_inscriptosxcursos = inscriptosxcurso.id_inscriptosxcurso) WHERE fk_inscriptosxcursos=$numAlumno AND num_recibo IS NOT NULL Order by pagosencoop.codigo_barras ASC");
		while($rowCuotas = pg_fetch_array($cuotas)){
		$codigoBarra = $rowCuotas['codigo_barras'];
		$fechaVenc = $rowCuotas['fecha_venc'];
		$anulada = $rowCuotas['anulada'];
		$vFechaVenc = split("-",$fechaVenc);
		$idPC = $rowCuotas['id_pagosencoop']; 
		$backAnulada = ($anulada == 't') ? 'style="background-color:red;color:white"' : '';

		echo '<tr '.$backAnulada.'>';
			echo '<td width="10%"><center>'.$codigoBarra[4].'</center></td>';
			if($rowCuotas['monto_c_descuento']==NULL){
				echo '<td width="20%"><input type="text" name="montoscuota'.$codigoBarra[4].'" value="'.$rowCuotas['monto'].'" /></td>';				
			}else{			
				echo '<td width="20%"><center>'.$rowCuotas['monto_c_descuento'].'</center></td>';
			}
			echo '<td width="40%" align="center">'.$vFechaVenc[2].'/'.$vFechaVenc[1].'/'.$vFechaVenc[0].'</td>';
			echo '<td width="40%" align="center">';
			if($anulada=='t'){
				echo '<input type="button" name="Activar" value="Activar" onclick="actionPagosEnCoop('.$idPC.',false);"/>';
			}else{
				echo '<input type="button" name="Anular" value="Anular" onclick="actionPagosEnCoop('.$idPC.',true);"/>';
			}
		echo '</td></tr>';
		}
		
	  ?>
    </table>
</form>

<form id="form1" name="form2" method="post" action="<?php echo 'guardarFechaVenc.php?numAlumno='.$numAlumno?>">
    <table width="100%" border="1">
      <tr>
        <!--<td width="10%" bgcolor="#666666" align="center"><span style="color:white">Apellido</span></td>
        <td width="10%" bgcolor="#666666"align="center"><span style="color:white">Nombre</span></td>-->
		<td width="10%" bgcolor="#666666"align="center"><span style="color:white">NroCuota</span></td>
        <td width="20%" bgcolor="#666666" align="center"><span style="color:white">Monto cuota</span></td>
        <td width="40%" bgcolor="#666666" align="center"><span style="color:white">Fecha Vto actual</span></td>        
		<td width="40%" bgcolor="#666666" align="center"><span style="color:white">Fecha Vto nueva</span></td>
      </tr>
	  
	  <?php
		$controlNombre = 0;
		$cuotas = pg_query("SELECT * from inscriptosxcurso full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) full outer join pagosencoop on(pagosencoop.fk_inscriptosxcursos = inscriptosxcurso.id_inscriptosxcurso) WHERE fk_inscriptosxcursos=$numAlumno AND num_recibo IS NULL Order by pagosencoop.codigo_barras ASC");
		while($rowCuotas = pg_fetch_array($cuotas)){
		$codigoBarra = $rowCuotas['codigo_barras'];
		$fechaVenc = $rowCuotas['fecha_venc'];
		$vFechaVenc = split("-",$fechaVenc);
		echo '<tr>';
			//if($controlNombre==0){
			//echo '<td width="10%" bgcolor="#FFFFFF">'.$apellido.'</td>';
			//echo '<td width="10%" bgcolor="#FFFFFF">'.$nombre.'</td>';
			//$controlNombre=1;
			//}else{
				//echo '<td width="10%" bgcolor="#FFFFFF">&nbsp;</td>';
				//echo '<td width="10%" bgcolor="#FFFFFF">&nbsp;</td>';
			//}
			echo '<td width="10%" bgcolor="#FFFFFF"><center>'.$codigoBarra[4].'</center></td>';
			if($rowCuotas['monto_c_descuento']==NULL){
				echo '<td width="20%" bgcolor="#FFFFFF"><input type="text" name="montoscuota'.$codigoBarra[4].'" value="'.$rowCuotas['monto'].'" /></td>';				
			}else{			
				echo '<td width="20%" bgcolor="#FFFFFF"><center>'.$rowCuotas['monto_c_descuento'].'</center></td>';
			}
			echo '<td width="40%" bgcolor="#FFFFFF">'.$vFechaVenc[2].'/'.$vFechaVenc[1].'/'.$vFechaVenc[0].'</td>';
			if($rowCuotas['monto_c_descuento']==NULL){
				echo '<td width="40%" bgcolor="#FFFFFF"><input type="text" name="cuotadia'.$codigoBarra[4].'" size="1" maxlength="2"/>'.'/'.'<input type="text" name="cuotames'.$codigoBarra[4].'" size = "1" maxlength="2" value="'.$vFechaVenc[1].'" />'.'/'.date('Y').'<input type="hidden" name="cuotaanio'.$codigoBarra[4].'" value ="'.date('Y').'"/></td>';						
				
			}else{
				echo '<td width="40%" bgcolor="#FFFFFF"><input type="text" name="cuotadia'.$codigoBarra[4].'" size="1" maxlength="2"/>'.'/'.'<input type="text" name="cuotames'.$codigoBarra[4].'" size = "1" maxlength="2" value="'.$vFechaVenc[1].'" />'.'/'.$vFechaVenc[0].'<input type="hidden" name="cuotaanio'.$codigoBarra[4].'" value ="'.$vFechaVenc[0].'"/></td>';						
			}
		echo '</tr>';
		}
		
	  ?>
	<tr>
	<td colspan="6" align="right">	
		<input type="submit" name="Guardar" value="Modificar"/>
	</td>
	</tr>
    </table>
</form>
		
	</table>
       
  
</body>
</html>

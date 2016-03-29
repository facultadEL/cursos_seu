<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=latin1" />
<script src="jquery-latest.js"></script>
<script type="text/javascript" src="jquery.validate.js"></script>
<script>
			$(document).ready(function(){
			
			$('form').validate();
			$("#form2").validate();
			
		});

		function evaluaring(academico)
	{
		document.form1.submit(); 
	}
		</script>
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
		{font-family: Cambria }
			label {
				font-family: Cambria;
			}
			label.error {
				color: red;
			}
    </style>
<style type="text/css">
<!--
.Estilo2 {color: #993333}
-->
</style>
</head>

<body>
<?php @$nombre_curso = $_REQUEST["nombre_curso"];?>
<table width="474" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#996633">
  <tr>
    <td width="466">
	<form name="form1" id="form1" action="" method="get">
	<table width="100%" border="0" align="center" cellspacing="0">
      <tr>
        <td colspan="2" align="center" valign="bottom"><div align="center"> Datos del Curso </div></td>
      </tr>
       <tr>
        <td bgcolor="#CCCCCC"><div align="right">Nombre del Curso: </div></td>
        <td bgcolor="#CCCCCC"><select name="nombre_curso" size="1" class="myTextField" id="nombre_curso" onChange="evaluaring()" >
          <option value="0" selected="selected">Seleccione el nombre del Curso</option>
          <?php
                                         include_once "conexionCursosExtension.php";
										 $anio= date("Y");
                                                  //$tip1 = pg_query($conn,"SELECT id_cursos, nombre, anio, fk_programa FROM cursos where activado='t' AND anio=$anio and fk_tipo=$tipo_curso ORDER BY id_cursos DESC");
                                                  $tip1 = pg_query($conn,"SELECT id_cursos, nombre, anio, fk_programa FROM cursos where activado='t' AND anio=$anio ORDER BY id_cursos DESC");
                                                  while($row1 = pg_fetch_array($tip1)){
                                 if(strcmp($row1["id_cursos"],$nombre_curso)==0)
                                            $seleccionado = " selected";
                                       else
                                       $seleccionado = "";
									   
                                  echo "<option value=".$row1["id_cursos"]." $seleccionado>".$row1["nombre"]."</option>";
                                       }
        ?>
        </select></td>
      </tr>	    
	</form>
	<form name="form2" id="form2" action="envioMail.php" method="get">
	<table width="474" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#996633">
		<tr>
			<td width="60%" bgcolor="#FFFFFF"align="center"><strong>Alumno</strong></td>
			<td width="40%" bgcolor="#FFFFFF"align="center"><strong>Seleccion</strong></td>
	<?php
		 if ($nombre_curso!=0){
		 	include_once "conexionCursosExtension.php";
             $tip2 = pg_query($conn,"SELECT id_inscriptosxcurso, inscripto.apellido,inscripto.nombre, id_cursos FROM inscriptosxcurso full outer join inscripto on (inscripto.id_inscripto = inscriptosxcurso.fk_inscriptos) full outer join cursos on (cursos.id_cursos = inscriptosxcurso.fk_curso) where id_cursos=$nombre_curso ORDER BY inscripto.apellido,inscripto.nombre ASC");
			 while ($row2 = pg_fetch_array($tip2)){
				echo '<tr>';
					echo '<td width="20%" bgcolor="#FFFFFF">';
						echo $row2["apellido"].' '.$row2["nombre"];
					echo '</td>';
					echo '<td width="20%" bgcolor="#FFFFFF"align="center">';
						echo '<input type="checkbox" name="alumno'.$row2["id_inscriptosxcurso"].'" checked />';
					echo '</td>';
				echo '</tr>';
			 }
		 }?>
	<tr>
		<td colspan="2"><u><label for="cAsunto">Asunto del mail:</label></u> 
			<input type="text" id="cAsunto" name="asunto" value="" size="60" class="required"/>
		</td>
	</tr>
      <tr>
	  <td colspan="2" bgcolor="#999999"><label>
          <div align="center">
		  <?php 
		  include_once "conexionCursosExtension.php";
             $tip3 = pg_query($conn,"SELECT * FROM cursos WHERE id_cursos=$nombre_curso");
			 while ($row3 = pg_fetch_array($tip3)){
				$fecha_inicio = $row3['duracion_desde'];
				$fecha_fin = $row3['duracion_hasta'];
				$montoSinVenc = $row3['monto_antes_venc'];
				$montoConVenc = $row3['monto'];
				$cantCuotas = $row3['cantcuota'];
				$diaVenc = $row3['dia_venc'];
		  }
		  $obtenerMesI = explode('/',$fecha_inicio);
				$mesInicio = $obtenerMesI[1];
		  $obtenerMesF = explode('/',$fecha_fin);
				$mesFin = $obtenerMesF[1];
				
		  $duracion = $mesFin - $mesInicio;		

//$tip4 = pg_query($conn,"select * from pagosencoop full outer join inscriptosxcurso on(pagosencoop.fk_inscriptosxcursos=inscriptosxcurso.id_inscriptosxcurso) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where cursos.id_cursos=$nombre_curso");		  
//while($row4 = pg_fetch_array($tip4)){
//			$codigoBarra = $row4['codigo_barras'];

		  ?>
            <textarea name="cuerpoMail" cols="100" rows="20" value="">La Universidad Tecnol&oacute;gica Nacional desea brindarle la mejor de las atenciones y la mas cordial Bienvenida a nuestro centro de capacitaci&oacute;n, donde sin lugar a dudas al profundizar sus conocimientos aprender&aacute; a desarrollarse como un verdadero profesional.<br>
			<br>
			
Mandatario del __________<br>
			<br>
Esta capacitaci&oacute;n ofrece a sus alumnos los siguientes beneficios:<br>
_______________________________________________________________________<br>
<br>
			
<u>Cronograma:</u><br>
<br>
<ul type = disk >
<li>Duraci&oacute;n: <?php echo $duracion;?> meses

<br><li>Fecha de inicio: <?php echo $fecha_inicio;?>

<br><li>Fecha de Finalizaci&oacute;n: <?php echo $fecha_fin;?>

<br><li>Fecha de Examen:

<br><li>Fecha de Gesti&oacute;n de Matr&iacute;cula:
</ul>
<br>
<u>Cronograma de Pagos:</u><br>
<br>
Para el 1&deg; d&iacute;a de clases bastar&aacute; que asista con lo necesario para tomar apuntes y posteriormente la instituci&oacute;n se encargar&aacute; de proporcionarles el material de estudios.
<br>
<br>Las cuotas se cancelar&aacute;n en el siguiente per&iacute;odo:<br>
<?php

for($i=1;$i<$cantCuotas+1;$i++){
	$mes = ($mesInicio + $i) - 1;
	$fechaInicial = $obtenerMesI[0].'-'.$obtenerMesI[1].'-'.$obtenerMesI[2];
	$mes1 = '0'.$mes;
	if (strlen($mes) == 1){
		$fechaCuota = $diaVenc.'-'.$mes1.'-'.$obtenerMesI[2];
	}else{
		$fechaCuota = $diaVenc.'-'.$mes.'-'.$obtenerMesI[2];
		}
	if ($i == 1){
		echo $i.'&deg; cuota '.$fechaInicial.' $'.$montoSinVenc.'<br>';
	}else{
		echo $i.'&deg; cuota '.$fechaCuota.' $'.$montoSinVenc.'<br>';
	}
}
?>


<br>Esperamos que mediante esta capacitaci&oacute;n nuestros alumnos logren alcanzar todos sus objetivos, por eso los animamos a mantener constancia en cada una de las lecciones sean estas te&oacute;ricas o pr&aacute;cticas.<br>
Si desea expresarnos sus dudas y/o comentarios respecto de esta capacitaci&oacute;n h&aacute;galo a la siguiente direccion s_extension@frvm.utn.edu.ar o bien a nuestro tel&eacute;fono 4537500 interno 124<br>


<br>Atentamente<br>
SEU - Secretar&iacute;a de Extensi&oacute;n Universitaria
</textarea>
            <input type="hidden" name="cursoF" value="<?php echo $nombre_curso?>" />
            </div>
        </label>
		</td>
		<tr>
        <td colspan="3" bgcolor="#999999"><label>
          <div align="center">
            <input type="submit" name="Submit" value="Enviar" />
            </div>
        </label>
		</td>
      </tr>
    </table>
	</form>
	</td>
  </tr>
</table>

</body>
</html>

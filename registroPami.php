<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="jquery-latest.js"></script>
<script type="text/javascript" src="jquery.validate.js"></script>
	<title>Registro a cursos - PAMI</title>
	<style type="text/css">
		{font-family: Cambria }
			{font-family: Cambria }			
			form {padding: 20px; border: 1px Solid #D8D8D8;background: #F2F2F2;}
			label {width: 10em;color: #336699; float: left;margin-right: 30px; font-family: Cambria; padding-left: .5em;}
			label.error {font-family: Cambria;float: none;vertical-align: top;color: #08298A;padding-left: .5em;}
    </style>

		<script>
			$(document).ready(function(){
			
			$.validator.addClassRules("rango", {range:[0,6]});
			$.validator.addClassRules("min", {minlength: 8});
			$.validator.addClassRules("minimo", {minlength: 2});
			$.validator.addClassRules("numCuil", {minlength: 7});
			$.validator.addClassRules("digitoCuil", {minlength: 1});
			$.validator.addClassRules("anio", {minlength: 4});
			$.validator.addClassRules("caracteristica", {minlength: 3});
			$.validator.addClassRules("telFijo", {minlength: 6});
			
			$('form').validate();
			$("#form1").validate();
			$("#form2").validate();
			
			
		});
		
		function evaluaring(academico)
	{
		document.f1.submit(); 
	}
		
		
		</script>

</head>

<body>
<?php
include_once "conexionCursosExtension.php";
$numDni = $_REQUEST['numdoc'];
$consultaDni = pg_query('SELECT count(id_inscripto) AS "cant" FROM inscripto WHERE dni='.$numDni);
$rowConsultaDni = pg_fetch_array($consultaDni);
$cantidad = $rowConsultaDni['cant'];
if($cantidad>0){
	//Traer datos del inscripto
	$variableControl = 1;
	$consultaDatosInscripto = pg_query("SELECT * FROM inscripto WHERE dni='$numDni'");
	while($rowDatosInscripto = pg_fetch_array($consultaDatosInscripto)){
	$idInscripto = $rowDatosInscripto['id_inscripto'];
	$nombreInscripto = $rowDatosInscripto['nombre'];
	$apellidoInscripto = $rowDatosInscripto['apellido'];
	$telfijoInscripto = $rowDatosInscripto['telfijo'];
	$mailInscripto = $rowDatosInscripto['mail'];
	$direccionInscripto = $rowDatosInscripto['direccion'];
	$numeroInscripto = $rowDatosInscripto['numero'];
	$numdniInscripto = $rowDatosInscripto['dni'];
	$tipodocInscripto = $rowDatosInscripto['fk_tipodoc'];
	$localidadInscripto = $rowDatosInscripto['localidad'];
	$telcelInscripto = $rowDatosInscripto['telcel'];
	}
	
	$sqlControlDatosExtra = pg_query('SELECT count(id_datosextra) AS "contar" FROM datosextra WHERE inscripto_datosextra='.$idInscripto);
	$rowControlDatosExtra = pg_fetch_array($sqlControlDatosExtra);
	if($rowControlDatosExtra['contar'] != 0){
		$consultaDatosExtraInscripto = pg_query("SELECT * FROM datosextra WHERE inscripto_datosextra='$idInscripto'");
		//De representa datos extra
		$rowDe = pg_fetch_array($consultaDatosExtraInscripto);
		$boolVisual = $rowDe['boolvisual_datosextra'];
		$txtVisual = $rowDe['txtvisual_datosextra'];
		$boolAuditiva = $rowDe['boolauditiva_datosextra'];
		$txtVisual = $rowDe['txtauditiva_datosextra'];
		$boolMotora = $rowDe['boolmotora_datosextra'];
		$txtMotora = $rowDe['txtmotora_datosextra'];
		$boolOtra = $rowDe['boolotra_datosextra'];
		$txtOtra = $rowDe['txtotra_datosextra'];
		$boolOtroCurso = $rowDe['boolotroscursos_datosextra'];
		$cuantosOtrosCursos = $rowDe['cuantosotroscursos_datosextra'];
		$txtOtrosCursos = $rowDe['txtotroscursos_datosextra'];
		$vOtrosCursos = explode('/--/',$txtOtrosCursos);
		$fechaNac = $rowDe['fechanac_datosextra'];
		$vFechaNac = explode('-',$fechaNac);
	}
	
	
	
	
	//variableControl toma un valor para saber si ya esta inscripto en el sistema y no duplicar datos
}else{
	$numdniInscripto = $numDni;
	$variableCotrol = 0;
	$idInscripto = 0;
	//variableControl toma un valor para saber si ya esta inscripto en el sistema y no duplicar datos
}	
?>


<form class="formNuevoAlumno" name="f1" id="form2" action="guardarInscriptoPami.php" method="post" enctype="multipart/form-data">
<fieldset id="tabla">
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Inscripcion a Cursos y Seminarios - Secretaria de Extension Universitaria - PAMI</FONT></legend>
<table>
	<tr>
		<td>
			<label for="cCurso">Curso: </label>
			<select id="cCurso" name="idCurso" size="1" >
			<option value="0">Seleccione el curso</option>
			<?php
				include_once "conexionCursosExtension.php";
				$anioActual = date("Y");
				$consultaCursos = pg_query($conn,"SELECT id_cursos,nombre,duracion_desde,duracion_hasta FROM cursos where anio=$anioActual ORDER BY nombre;");
				while($rowCursos = pg_fetch_array($consultaCursos)){
					$nombreCurso = $rowCursos['nombre'];
					$resultadoBusqueda = strripos($nombreCurso,'PAMI',0);
					if($resultadoBusqueda !== FALSE){
						echo "<option value=".$rowCursos["id_cursos"].">".$rowCursos["nombre"]."</option>";
					}
				}
			?>			
			</select>
		</td>
	</tr>
	<tr>
	<td>
			<label for="cNombre">Nombre: </label>
			<input id="cNombre" name="nombreInscripto" type="text" value="<?php echo $nombreInscripto; ?>" size="26" />
			<input name="variableControl" type="hidden" value="<?php echo $variableControl; ?>" size="22" />
			<input name="idInscripto" type="hidden" value="<?php echo $idInscripto; ?>" size="22" />
		</td>
	</tr>
	<tr>
		<td>
			<label for="cApellido">Apellido: </label>
			<input id="cApellido" name="apellidoInscripto" type="text" value="<?php echo $apellidoInscripto;?>" size="26" />
		</td>
	</tr>
	<tr>
		<td>
			<label for="cTipoDNI">Tipo de Documento: </label>
			<select id="cTipoDNI" name="tipoDocumentoInscripto" size="1" >
				<?php					
					$consultaTipoDNI=pg_query("select * FROM tipodocumento");
					while($rowTipoDNI=pg_fetch_array($consultaTipoDNI)){
						if ($tipodocInscripto == $rowTipoDNI['id_tipodocumento']){
							echo "<option value=".$rowTipoDNI['id_tipodocumento']." selected>".$rowTipoDNI['nombretipo']."</option>";
						}else{
							echo "<option value=".$rowTipoDNI['id_tipodocumento'].">".$rowTipoDNI['nombretipo']."</option>";
						}
					}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cNumeroDNI">N&uacute;mero de documento: </label>
			<input id="cNumeroDNI" name="numdocInscripto" type="text" value="<?php echo $numdniInscripto;?>" size="26" maxlength="8" class="number"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cFecha">Fecha de Nacimiento: </label>
			<input id="cDia" name="diaInscripto" type="text"  value="<?php echo $vFechaNac[2];?>" placeholder="dd" class="minimo" maxlength="2" size="3"/>/
			<input id="cMes" name="mesInscripto" type="text"  value="<?php echo $vFechaNac[1];?>" placeholder="mm" class="minimo" maxlength="2" size="3"/>/
			<input id="cAnio" name="anioInscripto" type="text"  value="<?php echo $vFechaNac[0];?>" placeholder="aaaa" class="anio" maxlength="4" size="5"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cDireccion">Direcci&oacute;n: </label>
			<input id="cDireccion" name="direccionInscripto" type="text" value="<?php echo $direccionInscripto;?>" size="26" maxlength="60"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cNumero">N&uacute;mero: </label>
			<input id="cNumero" name="numeroInscripto" type="text" value="<?php echo $numeroInscripto;?>" size="26" maxlength="10"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cLocalidad">Localidad: </label>
			<input id="cLocalidad" name="localidadInscripto" type="text" value="<?php echo $localidadInscripto;?>" size="26"/>
		</td>
	</tr>	
	<tr>
		<td>
			<label for="cMail">Direcci&oacute;n Correo Electronico: </label>
			<input id="cMail" name="mailInscripto" type="text" size="26" value="<?php echo $mailInscripto;?>" class="email"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cTelFijo">Telefono Fijo: </label>
			<input id="cTelFijo" name="telfijoInscripto" type="text" value="<?php echo $telfijoInscripto;?>" size="26" maxlength="30"/>
		</td>
	</tr>	
	<tr>
		<td>
			<label for="cTelCel">Telefono Celular: </label>
			<input id="cTelCel" name="telcelInscripto" type="text" value="<?php echo $telcelInscripto;?>" size="26" maxlength="30"/>
		</td>
	</tr>	
	<tr>
		<td>
			<label for="cDificultad">Posee alguna dificultad f&iacute;sica: </label>			
		</td>
	</tr>
	<tr>
		<td>
			<label for="cVisual">Visual: </label>
			<?php
			if($boolVisual=='t'){
				echo '<input id="cVisual" name="checkVisualInscripto" type="checkbox" checked />';
			}else{
				echo '<input id="cVisual" name="checkVisualInscripto" type="checkbox" />';
			}
			?>
			
			<input id="cVisual" name="visualInscripto" type="text" value="<?php echo $txtVisual;?>" size="22" maxlength="30"/>
		</td>
	</tr>		
	<tr>
		<td>
			<label for="cAudio">Auditiva: </label>
			<?php
			if($boolAuditiva=='t'){
				echo '<input id="cAudio" name="checkAuditivaInscripto" type="checkbox" checked />';
			}else{
				echo '<input id="cAudio" name="checkAuditivaInscripto" type="checkbox" />';
			}
			?>
			
			<input id="cAudio" name="auditivaInscripto" type="text" value="<?php echo $txtAuditiva;?>" size="22" maxlength="30"/>
		</td>
	</tr>		
	<tr>
		<td>
			<label for="cMotora">Motora: </label>
			<?php
			if($boolMotora=='t'){
				echo '<input id="cMotora" name="checkMotoraInscripto" type="checkbox" checked />';
			}else{
				echo '<input id="cMotora" name="checkMotoraInscripto" type="checkbox" />';
			}
			?>
			
			<input id="cMotora" name="motoraInscripto" type="text" value="<?php echo $txtMotora;?>" size="22" maxlength="30"/>
		</td>
	</tr>		
	<tr>
		<td>
			<label for="cOtra">Otra: </label>
			<?php
			if($boolOtra=='t'){
				echo '<input id="cOtra" name="checkOtraInscripto" type="checkbox" checked />';
			}else{
				echo '<input id="cOtra" name="checkOtraInscripto" type="checkbox" />';
			}
			?>
			
			<input id="cOtra" name="otraInscripto" type="text" value="<?php echo $txtOtra;?>" size="22" maxlength="30"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cOtroCursoP">Ha realizado otros cursos anteriormente? </label>
			<?php
			if($boolOtroCurso=='t'){
				echo '<input id="cOtroCursoP" name="otroCurso" type="radio" value="1" checked /><font face="cambria" color="#336699"> Si</font>';
				echo '<input id="cOtroCursoP" name="otroCurso" type="radio" value="0"/> <font face="cambria" color="#336699"> No</font>';
			}else{
				echo '<input id="cOtroCursoP" name="otroCurso" type="radio" value="1" /><font face="cambria" color="#336699"> Si</font>';
				echo '<input id="cOtroCursoP" name="otroCurso" type="radio" value="0"  checked /> <font face="cambria" color="#336699"> No</font>';
			}
			?>
		</td>	
	</tr>	
	<tr>
		<td>
			<label for="cCuantos">Cuantos: </label>
			<input id="cCuantos" name="cuantosCursos" type="text" value="<?php echo $cuantosOtrosCursos?>" size="26" maxlength="30" class="number"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cCuales1">Cuales: </label>
			<input id="cCuales1" name="cursoCuales1" type="text" value="<?php echo $vOtrosCursos[0]?>" size="26" maxlength="30"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cCuales2">Cuales: </label>
			<input id="cCuales2" name="cursoCuales2" type="text" value="<?php echo $vOtrosCursos[1]?>" size="26" maxlength="30"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cCuales3">Cuales: </label>
			<input id="cCuales3" name="cursoCuales3" type="text" value="<?php echo $vOtrosCursos[2]?>" size="26" maxlength="30"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cCuales4">Cuales: </label>
			<input id="cCuales4" name="cursoCuales4" type="text" value="<?php echo $vOtrosCursos[3]?>" size="26" maxlength="30"/>
		</td>
	</tr>		
	<tr>
		<td>
			<input class="submit" type="submit" value="Guardar"/>
			<a href="corroborarPami.php"><input type="button" value="Atr&aacute;s"></a>
		</td>
	</tr>	
</table>
</form>
</fieldset>
</body>
</html>
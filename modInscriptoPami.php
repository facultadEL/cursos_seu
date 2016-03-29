<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>Modificar PAMI</title>
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

$idPami = $_REQUEST['idPami'];

$sqlDatosPami = pg_query("SELECT * FROM inscripto INNER JOIN datosextra ON(datosextra.inscripto_datosextra = inscripto.id_inscripto) WHERE id_inscripto='$idPami'");
$rowDatosPami = pg_fetch_array($sqlDatosPami);
$nombrePami = $rowDatosPami['nombre'];
$apellidoPami = $rowDatosPami['apellido'];
$tipoDocPami = $rowDatosPami['fk_tipodoc'];
$numDocPami = $rowDatosPami['dni'];
$fechaNac = $rowDatosPami['fechanac_datosextra'];
$direccionPami = $rowDatosPami['direccion'];
$numDirPami = $rowDatosPami['numero'];
$localidadPami = $rowDatosPami['localidad'];
$mailPami = $rowDatosPami['mail'];
$telFijoPami = $rowDatosPami['telfijo'];
$telCelPami = $rowDatosPami['telcel'];
$boolVisual = $rowDatosPami['boolvisual_datosextra'];
$txtVisual = $rowDatosPami['txtvisual_datosextra'];
$boolAuditiva = $rowDatosPami['boolauditiva_datosextra'];
$txtAuditiva = $rowDatosPami['txtauditiva_datosextra'];
$boolMotora = $rowDatosPami['boolmotora_datosextra'];
$txtMotora = $rowDatosPami['txtmotora_datosextra'];
$boolOtra = $rowDatosPami['boolotra_datosextra'];
$txtOtra = $rowDatosPami['txtotra_datosextra'];
$boolOtrosCursos = $rowDatosPami['boolotroscursos_datosextra'];
$cuantosOtrosCursos = $rowDatosPami['cuantosotroscursos_datosextra'];
$txtOtrosCursos = $rowDatosPami['txtotroscursos_datosextra'];

//Creo el vector de la fecha de nacimiento
$vFechaNac = explode('-',$fechaNac);
//Creo el vector con los cursos que hizo
$vOtrosCursos = explode('/--/',$txtOtrosCursos);

?>
<script type="text/javascript">
		function confirmation($id,$cF) {
			var pregunta = confirm("Desea dar de baja este inscripto?")
			if (pregunta){
				window.location = "bajaInscriptoPami.php?idPami=<?php echo $idPami;?>&cursoF=<?php echo $cursoF;?>";
			}else{
				window.location = "listadoPami.php";
			}
		}
</script>
<form class="formModificarPami" id="commentForm" action="guardarModPami.php"  method="post" >
<fieldset>
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Complete todos los campos del formulario</FONT></legend>
<table>
		<tr>
		<td>
			<label for="cNombre">Nombre: </label>
			<input id="cNombre" name="nombrePami" type="text" value="<?php echo $nombrePami; ?>" size="26" />			
			<input name="idPami" type="hidden" value="<?php echo $idPami; ?>" size="22" />
		</td>
	</tr>
		<tr>
		<td>
			<label for="cApellido">Apellido: </label>
			<input id="cApellido" name="apellidoPami" type="text" value="<?php echo $apellidoPami;?>" size="26" />
		</td>
	</tr>
	<tr>
		<td>
			<label for="cTipoDNI">Tipo de Documento: </label>
			<select id="cTipoDNI" name="tipoDocPami" size="1" >
				<?php					
					$consultaTipoDNI=pg_query("select * FROM tipodocumento");
					while($rowTipoDNI=pg_fetch_array($consultaTipoDNI)){
						if ($tipoDocPami == $rowTipoDNI['id_tipodocumento']){
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
			<input id="cNumeroDNI" name="numDocPami" type="text" value="<?php echo $numDocPami;?>" size="26" maxlength="8" class="number"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cFecha">Fecha de Nacimiento: </label>
			<input id="cDia" name="diaPami" type="text"  value="<?php echo $vFechaNac[2];?>" placeholder="dd" class="minimo" maxlength="2" size="3"/>/
			<input id="cMes" name="mesPami" type="text"  value="<?php echo $vFechaNac[1];?>" placeholder="mm" class="minimo" maxlength="2" size="3"/>/
			<input id="cAnio" name="anioPami" type="text"  value="<?php echo $vFechaNac[0];?>" placeholder="aaaa" class="anio" maxlength="4" size="5"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cDireccion">Direcci&oacute;n: </label>
			<input id="cDireccion" name="direccionPami" type="text" value="<?php echo $direccionPami;?>" size="26" maxlength="60"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cNumero">N&uacute;mero: </label>
			<input id="cNumero" name="numDirPami" type="text" value="<?php echo $numDirPami;?>" size="26" maxlength="10"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cLocalidad">Localidad: </label>
			<input id="cLocalidad" name="localidadPami" type="text" value="<?php echo $localidadPami;?>" size="26"/>
		</td>
	</tr>	
	<tr>
		<td>
			<label for="cMail">Direcci&oacute;n Correo Electronico: </label>
			<input id="cMail" name="mailPami" type="text" size="26" value="<?php echo $mailPami;?>" class="email"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cTelFijo">Telefono Fijo: </label>
			<input id="cTelFijo" name="telFijoPami" type="text" value="<?php echo $telFijoPami;?>" size="26" maxlength="30"/>
		</td>
	</tr>	
	<tr>
		<td>
			<label for="cTelCel">Telefono Celular: </label>
			<input id="cTelCel" name="telCelPami" type="text" value="<?php echo $telCelPami;?>" size="26" maxlength="30"/>
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
				echo '<input id="cVisual" name="checkVisualPami" type="checkbox" checked />';
			}else{
				echo '<input id="cVisual" name="checkVisualPami" type="checkbox" />';
			}
			?>
			
			<input id="cVisual" name="visualPami" type="text" value="<?php echo $txtVisual;?>" size="22" maxlength="30"/>
		</td>
	</tr>		
	<tr>
		<td>
			<label for="cAudio">Auditiva: </label>
			<?php
			if($boolAuditiva=='t'){
				echo '<input id="cAudio" name="checkAuditivaPami" type="checkbox" checked />';
			}else{
				echo '<input id="cAudio" name="checkAuditivaPami" type="checkbox" />';
			}
			?>
			
			<input id="cAudio" name="auditivaPami" type="text" value="<?php echo $txtAuditiva;?>" size="22" maxlength="30"/>
		</td>
	</tr>		
	<tr>
		<td>
			<label for="cMotora">Motora: </label>
			<?php
			if($boolMotora=='t'){
				echo '<input id="cMotora" name="checkMotoraPami" type="checkbox" checked />';
			}else{
				echo '<input id="cMotora" name="checkMotoraPami" type="checkbox" />';
			}
			?>
			
			<input id="cMotora" name="motoraPami" type="text" value="<?php echo $txtMotora;?>" size="22" maxlength="30"/>
		</td>
	</tr>		
	<tr>
		<td>
			<label for="cOtra">Otra: </label>
			<?php
			if($boolOtra=='t'){
				echo '<input id="cOtra" name="checkOtraPami" type="checkbox" checked />';
			}else{
				echo '<input id="cOtra" name="checkOtraPami" type="checkbox" />';
			}
			?>
			
			<input id="cOtra" name="otraPami" type="text" value="<?php echo $txtOtra;?>" size="22" maxlength="30"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cOtroCursoP">Ha realizado otros cursos anteriormente? </label>
			<?php
			if($boolOtrosCursos=='t'){
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
			<input class="submit" type="submit" value="Modificar"/>
			<?php			
			$cursoF = $_REQUEST['cursoF'];
			
			echo '<a href="listadoPami.php?cursoF='.$cursoF.'"><input type="button" value="Atr&aacute;s"></a>';
			
			//echo '<a href="bajaInscriptoPami.php?idPami='.$idPami.'&cursoF='.$cursoF.'"><input type="button" value="Dar de baja"></a>'
			echo '<input type="button" value="Dar de baja" onclick="confirmation('.$idPami.','.$cursoF.')">'
			?>
		</td>
	</tr>
</table>
</form>
</fieldset>
</body>
</html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script src="jquery-latest.js"></script>
	<script type="text/javascript" src="jquery.validate.js"></script>
	<title>Alta de Curso</title>
	<style type="text/css">
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
		document.form1.submit(); 
	}
		
		
	</script>
</head>
<body>
<form class="formNuevoGrupo" name="form1" id="form1" action="guardarCursos.php" method="post" enctype="multipart/form-data">
<fieldset id="tabla">
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Complete todos los datos del Curso</FONT></legend>
<table width="100%">
	<tr width="100%">
		<td width="30%">
			<label for="cNombre">Nombre del Curso: </label>
		</td>
		<td width="70%">
			<input id="nombre_curso" name="nombre_curso" type="text" value="" size="30" maxlength="100"/>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="ctipo_curso">Tipo de Curso: </label>
		</td>
		<td width="70%">
			<select id="tipo_curso" name="tipo_curso" size="1" class="myTextField">
			<option value="0" selected>Seleccione un Tipo de Curso</option>
				<?php
					include_once "conexionCursosExtension.php";
					$tip1 = pg_query($conn,"SELECT id_tipo_curso,nombre FROM tipo_curso ORDER BY nombre;");
					while($row1 = pg_fetch_array($tip1)){
						if(strcmp($row1["id_tipo_curso"],$tipo_curso)==0){
							$seleccionado = " selected";
						}else{
							$seleccionado = "";
							echo "<option value=".$row1["id_tipo_curso"]." $seleccionado>".$row1["nombre"]."</option>";
						}
					}
				?>
			</select>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="cAnio">A&ntilde;o: </label>
		</td>
		<td width="70%">
			<input id="anio" name="anio" type="text" value="" size="30" maxlength="40"/>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="cAnio">Per&iacute;odo: </label>
		</td>
		<td width="70%">
			<select id="periodo_curso" name="periodo_curso" size="1" class="myTextField">
				<option value="0">Seleccione Per&iacute;odo del curso</option>
				<?php
				$sqlPeriodoCurso = pg_query("SELECT id_duracioncurso,nombre_duracioncurso FROM duracioncurso ORDER BY id_duracioncurso");
				while($rowPeriodoCurso = pg_fetch_array($sqlPeriodoCurso)){
					$idPeriodo = $rowPeriodoCurso['id_duracioncurso'];
					echo '<option value="'.$idPeriodo.'" >'.$rowPeriodoCurso['nombre_duracioncurso'].'</option>';
				}
				?>
			</select>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="cMonto">Monto: </label>
		</td>
		<td width="70%">
			<input id="Monto" name="Monto" type="text" value="" size="30" maxlength="40"/>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="cMontoAntesVenc">Monto 1/10: </label>
		</td>
		<td width="70%">
			<input id="MontoAntesVenc" name="MontoAntesVenc" type="text" value="" size="30" maxlength="40"/>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="cdiaVenc">D&iacute;a Vto: </label>
		</td>
		<td width="70%">
			<input id="diaVenc" name="diaVenc" type="text" value="" size="30" maxlength="2"/>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="cCantCuotas">Cantidad Cuotas: </label>
		</td>
		<td width="70%">
			<input id="CantCuotas" name="CantCuotas" type="text" value="" size="30" maxlength="40"/>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="cdocentecurso">Nombre Docente: </label>
		</td>
		<td width="70%">
			<input id="docentecurso" name="docentecurso" type="text" value="" size="30" maxlength="40"/>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="cporcOEfect">Forma de Pago Docente: </label>
		</td>
		<td width="70%">
			<input type="radio" value="1" name="porcOEfect" checked>Porcentaje</input> &nbsp;&nbsp;<input type="radio" value="0" name="porcOEfect">Efectivo</input> <br>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="cpagoDocente">Porcentaje Docente: </label>
		</td>
		<td width="70%">
			<input id="pagoDocente" name="pagoDocente" type="text" value="" size="30" maxlength="40"/>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="chorasMensualesDocente">Cant. horas mensuales: </label>
		</td>
		<td width="70%">
			<input id="horasMensualesDocente" name="cantHorasMensualesDocente" type="text" value="" size="30" maxlength="40"/>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="cprograma_curso">Programa: </label>
		</td>
		<td width="70%">
			<input name="programa_curso" type="file" id="programa_curso"/>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="cplanificacion">Planificaci&oacute;n: </label>
		</td>
		<td width="70%">
			<input name="planificacion" type="file" id="planificacion"  />
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="ccurriculum">Curriculum Docente: </label>
		</td>
		<td width="70%">
			<input name="curriculum" type="file" id="curriculum"  />
		</td>
	</tr>
</table>
</fieldset>
<fieldset id="tabla">
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Complete todos los datos del cursado</FONT></legend>
<table width="100%">
	<tr width="100%">
		<td width="30%">
			<label for="cdesde_fecha">Desde: </label>
		</td>
		<td width="70%">
			<input name="desde_fecha" type="text" id="desde_fecha" placeholder="dd/mm/aaaa" size="15" maxlength="10" />
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="chasta_fecha">Hasta: </label>
		</td>
		<td width="70%">
			<input name="hasta_fecha" type="text" id="hasta_fecha" placeholder="dd/mm/aaaa" size="15" maxlength="10" />
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="chasta_fecha">D&iacute;a 1: </label>
		</td>
		<td width="70%">
			<select name="dia1" id="dia1">
				<option>Lunes</option>
				<option>Martes</option>
				<option>Miercoles</option>
				<option>Jueves</option>
				<option>Viernes</option>
				<option>Sabado</option>
			</select>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="chora_desde1">Hora Desde 1: </label>
		</td>
		<td width="70%">
			<input name="hora_desde1" type="text" id="hora_desde1" size="3" maxlength="2"  /> :
			<input name="minutos_desde1" type="text" id="minutos_desde1" size="3" maxlength="2" /> Hs.
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="chora_hasta1">Hora Hasta 1: </label>
		</td>
		<td width="70%">
			<input name="hora_hasta1" type="text" id="hora_hasta1" size="3" maxlength="2"   /> :
			<input name="minutos_hasta1" type="text" id="minutos_hasta1" size="3" maxlength="2"  />	Hs.
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="chasta_fecha">D&iacute;a 2: </label>
		</td>
		<td width="70%">
			<select name="dia2" id="dia2">
				<option>Lunes</option>
				<option>Martes</option>
				<option>Miercoles</option>
				<option>Jueves</option>
				<option>Viernes</option>
				<option>Sabado</option>
			</select>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="chora_desde2">Hora Desde 2: </label>
		</td>
		<td width="70%">
			<input name="hora_desde2" type="text" id="hora_desde2" size="3" maxlength="2"  /> :
			<input name="minutos_desde2" type="text" id="minutos_desde2" size="3" maxlength="2"  />	Hs.
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="chora_hasta2">Hora Hasta 2: </label>
		</td>
		<td width="70%">
			<input name="hora_hasta2" type="text" id="hora_hasta2" size="3" maxlength="2"  /> :
			<input name="minutos_hasta2" type="text" id="minutos_hasta2" size="3" maxlength="2"  />	Hs.
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr width="100%">
		<td width="100%" colspan="2" align="center">
			<input class="submit" type="submit" value="Enviar"/>
		</td>
	</tr>
</table>
</fieldset>
</form>
</body>
</html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script src="jquery-latest.js"></script>
	<script type="text/javascript" src="jquery.validate.js"></script>
	<title>Modificar Curso</title>
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
		
		function evaluaring(academico){
			document.form1.submit(); 
		}
		
		
	</script>
</head>
<body>
<form class="formNuevoGrupo" name="form1" id="form1" action="" method="post" >
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Seleccione el curso a modificar</FONT></legend>
<fieldset id="tabla">
	<table width="100%">
		<tr>
			<td>
				<label for="cNombre">Curso: </label>
				<select name="nombre_curso" size="1" class="myTextField" id="nombre_curso" onChange="evaluaring()" onkeyup=fn(this.form,this)>
				<option value="0" selected="selected">Seleccione el nombre del Curso</option>
					<?php
					include_once "conexionCursosExtension.php";
						$anio = date('Y');
						$tip1 = pg_query($conn,"SELECT id_cursos, nombre, anio FROM cursos WHERE activado='t' AND anio=$anio ORDER BY nombre ASC");
						while($row1 = pg_fetch_array($tip1)){
							if(strcmp($row1["id_cursos"],$nombre_curso)==0)
								$seleccionado = " selected";
							else
								$seleccionado = "";
							echo "<option value=".$row1["id_cursos"]." $seleccionado>".$row1["nombre"]."</option>";
						}
					?>
				</select>
			</td>
		</tr>
	</table>
</fieldset>
</form>
<form class="formNuevoGrupo" name="form2" id="form2" action="guardarModCurso.php" method="post" enctype="multipart/form-data">
<fieldset id="tabla" width="100%">
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Complete todos los datos del Curso</FONT></legend>
<?php
include_once "conexionCursosExtension.php";
$id_cursos = $_REQUEST['nombre_curso'];
$cursoSql = pg_query("SELECT * FROM cursos WHERE id_cursos='$id_cursos' ORDER BY nombre");
$rowCurso = pg_fetch_array($cursoSql);
	$fk_tipo = $rowCurso['fk_tipo'];
	$anio = $rowCurso['anio'];
	$duracion_cursos = $rowCurso['duracion_cursos'];
	$monto = $rowCurso['monto'];
	$monto_antes_venc = $rowCurso['monto_antes_venc'];
	$dia_venc = $rowCurso['dia_venc'];
	$cantcuota = $rowCurso['cantcuota'];
	$docente = $rowCurso['docente'];
	$valor_a_cobrar = $rowCurso['valor_a_cobrar'];
	$horas_mensuales = $rowCurso['horas_mensuales'];
	$forma_cobro_docente = $rowCurso['forma_cobro_docente'];
	$duracion_desde = $rowCurso['duracion_desde'];
	$duracion_hasta = $rowCurso['duracion_hasta'];
	$dia1 = $rowCurso['dia1'];
	$hora_desde = $rowCurso['hora_desde'];
	$mostrar = explode(":",$hora_desde);
		$hora_desde = $mostrar[0];
		$min_desde = $mostrar[1];
	$hora_hasta = $rowCurso['hora_hasta'];
	$mostrar = explode(":",$hora_hasta);
		$hora_hasta = $mostrar[0];
		$min_hasta = $mostrar[1];
	$dia2 = $rowCurso['dia2'];
	$hora_desde2 = $rowCurso['hora_desde2'];
	$mostrar = explode(":",$hora_desde2);
		$hora_desde2 = $mostrar[0];
		$min_desde2 = $mostrar[1];
	$hora_hasta2 = $rowCurso['hora_hasta2'];
	$mostrar = explode(":",$hora_hasta2);
		$hora_hasta2 = $mostrar[0];
		$min_hasta2 = $mostrar[1];
		
	//Traigo el id del programa
	$fk_programa = $rowCurso['fk_programa'];
	$fk_planificacion = $rowCurso['fk_planificacion'];
	$fk_curriculum = $rowCurso['fk_curriculum'];
?>
<table width="100%">
	<tr width="100%">
		<td width="30%">
			<label for="ctipo_curso">Tipo de Curso: </label>
		</td>
		<td width="70%">
			<select id="tipo_curso" name="tipo_curso" size="1" class="myTextField">
			<option value="0" selected>Seleccione un Tipo de Curso</option>
				<?php
					$tip1 = pg_query($conn,"SELECT id_tipo_curso,nombre FROM tipo_curso WHERE id_tipo_curso='$fk_tipo' ORDER BY nombre;");
					while($row1 = pg_fetch_array($tip1)){
						if ($fk_tipo == $row1["id_tipo_curso"]){
							echo "<option value=".$row1['id_tipo_curso']." selected>".$row1['nombre']."</option>";
						}else{
							echo "<option value=".$row1['id_tipo_curso'].">".$row1['nombre']."</option>";
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
			<input id="anio" name="anio" type="text" value="<?php echo $anio; ?>" size="30" maxlength="40"/>
			<input id="anio" name="idCurso" type="hidden" value="<?php echo $id_cursos; ?>" size="30" maxlength="40"/>
			<input id="anio" name="fkPrograma" type="hidden" value="<?php echo $fk_programa; ?>" size="30" maxlength="40"/>
			<input id="anio" name="fkPlanificacion" type="hidden" value="<?php echo $fk_planificacion; ?>" size="30" maxlength="40"/>
			<input id="anio" name="fkCurriculum" type="hidden" value="<?php echo $fk_curriculum; ?>" size="30" maxlength="40"/>
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
					// $idPeriodo = $rowPeriodoCurso['id_duracioncurso'];
					// echo '<option value="'.$idPeriodo.'" >'.$rowPeriodoCurso['nombre_duracioncurso'].'</option>';
					if ($duracion_cursos == $rowPeriodoCurso["id_duracioncurso"]){
						echo "<option value=".$rowPeriodoCurso['id_duracioncurso']." selected>".$rowPeriodoCurso['nombre_duracioncurso']."</option>";
					}else{
						echo "<option value=".$rowPeriodoCurso['id_duracioncurso'].">".$rowPeriodoCurso['nombre_duracioncurso']."</option>";
					}
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
			<input id="Monto" name="Monto" type="text" value="<?php echo $monto; ?>" size="30" maxlength="40"/>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="cMontoAntesVenc">Monto 1/10: </label>
		</td>
		<td width="70%">
			<input id="MontoAntesVenc" name="MontoAntesVenc" type="text" value="<?php echo $monto_antes_venc; ?>" size="30" maxlength="40"/>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="cdiaVenc">D&iacute;a Vto: </label>
		</td>
		<td width="70%">
			<input id="diaVenc" name="diaVenc" type="text" value="<?php echo $dia_venc; ?>" size="30" maxlength="2"/>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="cCantCuotas">Cantidad Cuotas: </label>
		</td>
		<td width="70%">
			<input id="CantCuotas" name="CantCuotas" type="text" value="<?php echo $cantcuota; ?>" size="30" maxlength="40"/>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="cdocentecurso">Nombre Docente: </label>
		</td>
		<td width="70%">
			<input id="docentecurso" name="docentecurso" type="text" value="<?php echo $docente; ?>" size="30" maxlength="40"/>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="cporcOEfect">Forma de Pago Docente: </label>
		</td>
		<td width="70%">
			<?php
			if($forma_cobro_docente == 't'){
				echo '<input type="radio" value="1" name="porcOEfect" checked>Porcentaje</input> &nbsp;&nbsp;<input type="radio" value="0" name="porcOEfect">Efectivo</input> <br>';					
			}else{
				echo '<input type="radio" value="1" name="porcOEfect">Porcentaje</input> &nbsp;&nbsp;<input type="radio" value="0" name="porcOEfect" checked>Efectivo</input> <br>';
			}
			?>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="cpagoDocente">Porcentaje Docente: </label>
		</td>
		<td width="70%">
			<input id="pagoDocente" name="pagoDocente" type="text" value="<?php echo $valor_a_cobrar; ?>" size="30" maxlength="40"/>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="chorasMensualesDocente">Cant. horas mensuales: </label>
		</td>
		<td width="70%">
			<input id="horasMensualesDocente" name="cantHorasMensualesDocente" type="text" value="<?php echo $horas_mensuales; ?>" size="30" maxlength="40"/>
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
			<input name="planificacion_curso" type="file" id="planificacion"  />
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="ccurriculum">Curriculum Docente: </label>
		</td>
		<td width="70%">
			<input name="curriculum_curso" type="file" id="curriculum"  />
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
			<input name="desde_fecha" type="text" id="desde_fecha" placeholder="dd/mm/aaaa" value="<?php echo $duracion_desde; ?>" size="15" maxlength="10" />
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="chasta_fecha">Hasta: </label>
		</td>
		<td width="70%">
			<input name="hasta_fecha" type="text" id="hasta_fecha" placeholder="dd/mm/aaaa" value="<?php echo $duracion_hasta; ?>" size="15" maxlength="10" />
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="chasta_fecha">D&iacute;a 1: </label>
		</td>
		<td width="70%">
			<select name="dia1" id="dia1">
				<option<? if ($dia1=='Lunes') echo ' selected';?>>Lunes</option>
				<option<? if ($dia1=='Martes') echo ' selected';?>>Martes</option>
				<option<? if ($dia1=='Miercoles') echo ' selected';?>>Miercoles</option>
				<option<? if ($dia1=='Jueves') echo ' selected';?>>Jueves</option>
				<option<? if ($dia1=='Viernes') echo ' selected';?>>Viernes</option>
				<option<? if ($dia1=='Sabado') echo ' selected';?>>Sabado</option>
			</select>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="chora_desde1">Hora Desde 1: </label>
		</td>
		<td width="70%">
			<input name="hora_desde1" type="text" id="hora_desde1" value="<?php echo $hora_desde; ?>" size="3" maxlength="2"  /> :
			<input name="minutos_desde1" type="text" id="minutos_desde1" value="<?php echo $min_desde; ?>" size="3" maxlength="2" /> Hs.
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="chora_hasta1">Hora Hasta 1: </label>
		</td>
		<td width="70%">
			<input name="hora_hasta1" type="text" id="hora_hasta1" value="<?php echo $hora_hasta; ?>" size="3" maxlength="2"   /> :
			<input name="minutos_hasta1" type="text" id="minutos_hasta1" value="<?php echo $min_hasta; ?>" size="3" maxlength="2"  />	Hs.
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="chasta_fecha">D&iacute;a 2: </label>
		</td>
		<td width="70%">
			<select name="dia2" id="dia2">
				<option<? if ($dia2=='Lunes') echo ' selected';?>>Lunes</option>
				<option<? if ($dia2=='Martes') echo ' selected';?>>Martes</option>
				<option<? if ($dia2=='Miercoles') echo ' selected';?>>Miercoles</option>
				<option<? if ($dia2=='Jueves') echo ' selected';?>>Jueves</option>
				<option<? if ($dia2=='Viernes') echo ' selected';?>>Viernes</option>
				<option<? if ($dia2=='Sabado') echo ' selected';?>>Sabado</option>
			</select>
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="chora_desde2">Hora Desde 2: </label>
		</td>
		<td width="70%">
			<input name="hora_desde2" type="text" id="hora_desde2" value="<?php echo $hora_desde2; ?>" size="3" maxlength="2"  /> :
			<input name="minutos_desde2" type="text" id="minutos_desde2" value="<?php echo $min_desde2; ?>" size="3" maxlength="2"  />	Hs.
		</td>
	</tr>
	<tr width="100%">
		<td width="30%">
			<label for="chora_hasta2">Hora Hasta 2: </label>
		</td>
		<td width="70%">
			<input name="hora_hasta2" type="text" id="hora_hasta2" value="<?php echo $hora_hasta2; ?>" size="3" maxlength="2"  /> :
			<input name="minutos_hasta2" type="text" id="minutos_hasta2" value="<?php echo $min_hasta2; ?>" size="3" maxlength="2"  />	Hs.
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
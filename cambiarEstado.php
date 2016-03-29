<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--<meta name="viewport" content="width=device-width, initial-scale=0.9 ; charset=latin1"/>  -->

<title>Cambiar estado alumno</title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /></head>

<body>
<form id="form1" name="form1" method="post" action="guardarCambioEstado.php">
	<table width="100%" border="1" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="2" align="center">
				Cambiar todos <input type="checkbox" name="checkTodos"/>
				<select name="cambiarTodos">
					<option value="1">Seleccione un estado</option>
					<?php
					
					include_once "conexionCursosExtension.php";
					
					$estados = pg_query("SELECT * FROM estadoinscripto ORDER BY id_estadoinscripto");
					while($rowEstados = pg_fetch_array($estados)){
						echo '<option value="'.$rowEstados['id_estadoinscripto'].'">'.$rowEstados['nombre_estadoinscripto'].'</option>';
					}					
					?>
				</select>
			</td>		
		</tr>
		<?php
			$cursoF = $_REQUEST['dato'];			
			echo '<input type="hidden" name="dato" value="'.$cursoF.'" />';
			$consultaAlumnos = pg_query("SELECT * FROM inscriptosxcurso FULL OUTER JOIN inscripto ON(inscriptosxcurso.fk_inscriptos = inscripto.id_inscripto) FULL OUTER JOIN estadoinscripto ON(inscriptosxcurso.estadoinscripto_ixc = estadoinscripto.id_estadoinscripto) WHERE fk_curso=$cursoF ORDER BY inscripto.apellido;");
			
			while($rowEstadoAlumnos = pg_fetch_array($consultaAlumnos)){
				echo '<tr>';
					echo '<td align="left" width="80%">';
						echo $rowEstadoAlumnos['apellido'].', '.$rowEstadoAlumnos['nombre'];
					echo '</td>';
					echo '<td align="right">';
						$idAlumno = $rowEstadoAlumnos['id_inscripto'];
						$idEstado = $rowEstadoAlumnos['id_estadoinscripto'];
						$estadosAlumnos = pg_query("SELECT * FROM estadoinscripto ORDER BY id_estadoinscripto");
						echo '<select name="cambioEstado'.$idAlumno.'">';
						while($rowEstados = pg_fetch_array($estadosAlumnos)){
							if($idEstado == $rowEstados['id_estadoinscripto']){
								$select = "selected";
							}else{
								$select = "";
							}
							echo '<option value="'.$rowEstados['id_estadoinscripto'].'" '.$select.'>'.$rowEstados['nombre_estadoinscripto'].'</option>';
						}
						echo '</select>';
					echo '</td>';
				echo '</tr>';
			}			
		?>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" value="Guardar"/>
				&nbsp;&nbsp;
				<a href="cursoCambiarEstado.php"><input type="button" value="Atras"/></a>
			</td>
		</tr>
	</table>
</form>

</body>
</html>
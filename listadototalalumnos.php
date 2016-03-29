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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Total de alumnos por a&ntilde;o</title>
<style type="text/css">
	label {
		background: #eee;
		font-family: sans-serif;
		text-transform: capitalize;
		padding: 6px;
		text-align: right;
		-webkit-border-radius: 3px 3px 3px 3px; 
		-moz-border-radius: 3px 3px 3px 3px;
		border-radius: 3px 3px 3px 3px;
	   -webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.3);
	}
	#tabla {
		background: #F2F2F2;
		text-align: center;
		border: 2px solid #FFF;
		color: #585858;
		-webkit-border-radius: 13px 13px 13px 13px; 
		-moz-border-radius: 13px 13px 13px 13px;
		border-radius: 13px 13px 13px 13px;
		width: 100%;
	}
	#tablaTotal{
		background: #FFF;
		text-align: center;
		border: 1px solid #FFF;
		color: #585858;
		-webkit-border-radius: 3px 3px 3px 3px; 
		-moz-border-radius: 3px 3px 3px 3px;
		border-radius: 3px 3px 3px 3px;
		width: 50%;	
	}
	.total {
		background: #585858;
		text-align: center;
		border: 1px solid #585858;
		color: #A9E2F3;
		-webkit-border-radius: 8px 8px 8px 8px; 
		-moz-border-radius: 8px 8px 8px 8px;
		border-radius: 8px 8px 8px 8px;
	}
	#tablaCargada{
		border: 1px solid #FFF;
		-webkit-border-radius: 8px 8px 8px 8px; 
		-moz-border-radius: 8px 8px 8px 8px;
		border-radius: 8px 8px 8px 8px;
		width: 100%;	
	}
	.titTabla {
		background: #000000;
		text-align: center;
		border: 1px solid #585858;
		-webkit-border-radius: 8px 8px 0px 0px; 
		-moz-border-radius: 8px 8px 0px 0px;
		border-radius: 8px 8px 0px 0px;
		padding: 2px;
	}
	.tdTitTabla {
		background: #000000;
		text-align: center;
		border: 1px solid #585858;
		-webkit-border-radius: 8px 8px 0px 0px; 
		-moz-border-radius: 8px 8px 0px 0px;
		border-radius: 8px 8px 0px 0px;
		padding: 2px;
	}
	#titulo3 {
		padding: 3px;
		-webkit-border-radius: 13px 13px 0px 0px; 
		-moz-border-radius: 13px 13px 0px 0px;
		border-radius: 13px 13px 0px 0px;
	}
	l1 {
		font-family: Calibri;
		color: #0B615E;
		font-size: 26px;
	}
	l2 {
		font-family: Calibri;
		color: #0080FF;
		padding: 3px;
		text-align: center;
	}
	l3 {
		font-family: Calibri;
		color: #585858;
		padding: 4px;
		text-align: center;
		font-size: 20px;
	}
	l4 {
		font-family: Calibri;
		color: #2ECCFA;
		padding: 4px;
		text-align: center;
		font-size: 20px;
	}
	select{
	    background: #eee;
	   	padding: 5px;
	   	font-size: 16px;
	   	border: 0;
	   	-webkit-border-radius: 3px 3px 3px 3px; 
		-moz-border-radius: 3px 3px 3px 3px;
		border-radius: 3px 3px 3px 3px;
	   -webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.3);
	}
	select:hover{
		background-color: #ddd;
	}
	.excel {
		-moz-box-shadow:inset 0px 0px 0px 0px #ffffff;
		-webkit-box-shadow:inset 0px 0px 0px 0px #ffffff;
		box-shadow:inset 0px 0px 0px 0px #ffffff;
		background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #dfdfdf));
		background:-moz-linear-gradient(top, #ededed 5%, #dfdfdf 100%);
		background:-webkit-linear-gradient(top, #ededed 5%, #dfdfdf 100%);
		background:-o-linear-gradient(top, #ededed 5%, #dfdfdf 100%);
		background:-ms-linear-gradient(top, #ededed 5%, #dfdfdf 100%);
		background:linear-gradient(to bottom, #ededed 5%, #dfdfdf 100%);
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#dfdfdf',GradientType=0);
		background-color:#ededed;
		-moz-border-radius:8px;
		-webkit-border-radius:8px;
		border-radius:8px;
		border:2px solid #dcdcdc;
		display:inline-block;
		cursor:pointer;
		color:#777777;
		font-family:Arial;
		font-size:15px;
		font-weight:bold;
		padding:6px 24px;
		text-decoration:none;
		text-shadow:0px 1px 0px #ffffff;
	}
	.excel:hover {
		background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #dfdfdf), color-stop(1, #ededed));
		background:-moz-linear-gradient(top, #dfdfdf 5%, #ededed 100%);
		background:-webkit-linear-gradient(top, #dfdfdf 5%, #ededed 100%);
		background:-o-linear-gradient(top, #dfdfdf 5%, #ededed 100%);
		background:-ms-linear-gradient(top, #dfdfdf 5%, #ededed 100%);
		background:linear-gradient(to bottom, #dfdfdf 5%, #ededed 100%);
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#dfdfdf', endColorstr='#ededed',GradientType=0);
		background-color:#dfdfdf;
	}
	.excel:active {
		position:relative;
		top:1px;
	}
</style>
</head>
<body onLoad="tunCalendario();">
<?php
include_once "conexionCursosExtension.php";
?>
<table align="center" id="tabla">
<form id="form1" name="form1" method="post" action="">
	<tr bgcolor="#FFFFFF">
		<td id="titulo3" height="23" align="center"><l1>Cantidad de alumnos por a&ntilde;o</l1>
			<table width="100%" align="center">
				<tr>
					<td width="40%" align="right"><label>A&ntilde;o: </label></td>
					<td width="60%">
						<select name="cursoA" class="myTextField" id="cursoA" onChange="evaluaring()" onkeyup=fn(this.form,this)>
						<option value="0" selected="selected">Seleccione A&ntilde;o</option>
				            <?php
								$anio=0;
								$tip2 = pg_query($conn,"SELECT anio FROM cursos GROUP BY anio order by anio ASC;");
								while($row2 = pg_fetch_array($tip2)){
									if(strcmp($row2["anio"],$cursoA)==0){
										$seleccionado = " selected";}
									else{
										$seleccionado = "";
									}
									echo "<option value=".$row2["anio"]." $seleccionado>".$row2["anio"]."</option>";
								}
							?>
						</select>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
		    <?php
				if 	(( $cursoA!=0)){
					//$sqlCursos = pg_query($conn,"SELECT id_cursos,nombre,activado,cant_inscriptos,anio FROM cursos where anio='$cursoA' AND activado='t' ORDER BY cant_inscriptos ASC;");
					$sqlCursos = pg_query($conn,"SELECT id_cursos,nombre,activado,cant_inscriptos,anio FROM cursos where anio='$cursoA' ORDER BY nombre ASC;");//descomentar la de arriba y comentar la actual
				}
			?>
</form>
<form id="form1" name="form2" method="post" action="">
	<table align="center" id="tablaCargada">
		<tr class="titTabla">
			<td width="70%" class="tdTitTabla" align="center"><l2>Curso<l2></td>
			<td width="30%" class="tdTitTabla" align="center"><l2>Cantidad de alumnos<l2></td>
		</tr>
		<?php
		   	if($cursoA!=0){
		   	$var=0;
		   	$totalAlumnos = 0;
				while($rowCursos=pg_fetch_array($sqlCursos)){
					if ($var==0){
						$color='bgcolor="#FFFFFF"';
						$var=1;
					}else{
						$color='bgcolor="#CCCCCC"';
						$var=0;
					}
					$idCursoL = $rowCursos['id_cursos'];
					$contadorAlumnos = pg_query($conn,"SELECT count(id_inscriptosxcurso) as cant_inscriptos FROM inscriptosxcurso where fk_curso = $idCursoL;");
					$rowAlumnos = pg_fetch_array($contadorAlumnos);
						$cantAlumnos = $rowAlumnos['cant_inscriptos'];
					echo '<tr>';
						echo '<td '.$color.' >'.$rowCursos['nombre'].'</td>';
						echo '<td '.$color.' align="center">'.$cantAlumnos.'</td>';
					echo '</tr>';		
					$totalAlumnos = $totalAlumnos + $cantAlumnos;
				}
			}
		?>
	</table align="center">
	<table width="60%" align="center" class="tablaTotal">
		<tr>
			<td align="right" width="50%">
				<l3>Total de Alumnos en el a&ntilde;o: </l3>
			</td>
			<td align="left" class="total" width="10%">
				<l4><?php echo $totalAlumnos; ?></l4>
			</td>
		</tr>
	</table>
	
</form>
		</td>
	</tr>
</table>
<table align="center" width="100%">
		<tr>
			<td width="100%"  align="center">
				<p>
					<input type="text" id="dato" name="dato" value="<?=$cursoF?>" style="display:none"/>
					<input type="text" id="dato2" name="dato2" value="<?=$cursoI?>" style="display:none"/>
				</p>
				<p>
					<?php echo '<a href="excellistadoalumnosporcurso.php?anio='.$cursoA.'"><input type="button" class="excel" value="Excel"/></a>';?>
      			</p>
      		</td>
		</tr>
	</table>
</body>
</html>
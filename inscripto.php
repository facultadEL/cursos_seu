<html>
<head>
<title>
	Inscriptos
</title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<script src="jquery-latest.js"></script>
	<script type="text/javascript" src="jquery.validate.js"></script>
	<style type="text/css">
		{font-family: Cambria }
			label {
				width: 13em;
				float: left;
				font-family: Cambria;
				padding-left: .5em;
			}
			label.error {
				font-family: Cambria;
				float: none;
				vertical-align: top;
				color: red;
				padding-left: .5em;
			}
    </style>
		<script>
			$(document).ready(function(){
			
			$.validator.addClassRules("rango", {range:[1,6]});
			$.validator.addClassRules("min", {minlength: 8});
			$.validator.addClassRules("minimo", {minlength: 2});
			$.validator.addClassRules("numCuil", {minlength: 7});
			$.validator.addClassRules("digitoCuil", {minlength: 1});
			$.validator.addClassRules("anio", {minlength: 4});
			$.validator.addClassRules("caracteristica", {minlength: 3});
			$.validator.addClassRules("telFijo", {minlength: 6});
			
			$('form').validate();
			$("#regTutor").validate();

			//jQuery('#cFecha').focus(function(){
			//	if(jQuery(this).val() == 'mm-dd-aaaa'){
			//		jQuery(this).val('');
			//	}
			//});
			
			//jQuery('#cFecha').blur(function(){
			//	if(jQuery(this).val() == ''){
			//		jQuery(this).val('mm-dd-aaaa');
			//	}
			//});
		});
		function validarForm($form){
			if($form.curso.value=="0"){
				$form.curso.focus();
				alert("Falta seleccionar un curso");
				return false;
			}
			return true;
		}
		</script>
		
</head>

<body>
  <?
 include_once "conexionCursosExtension.php";
		  $dni=$_POST["numdoc"];
		  $tip29 = pg_query("select count(id_inscripto) as cantidad from inscripto where dni=$dni");
		  $row29 = pg_fetch_array($tip29);
		  if ($row29["cantidad"]>0)
		  	{
				$tip3 = pg_query("select inscripto.id_inscripto,  inscripto.nombre as nom,apellido, telfijo,mail,direccion,  numero ,dni,tipodoc,localidad ,telcel, fk_curso, cursos.nombre as nomcurso from  inscripto full outer join inscriptoxcurso on(inscriptoxcurso.fk_inscriptos = inscripto.id_inscripto) full outer join cursos on (inscriptosxcurso.fk_curso=cursos.id_cursos) where inscripto.dni=$dni");
			  	 while($row3 = pg_fetch_array($tip3))
					{
				echo '	<table width="100%" border="1">
 						 <tr>
    			<td colspan="2" class="centro"><strong>'.$row3["nomcurso"].'</strong></td>
				  </tr>';
					$tip4 = pg_query($conn,"select * from  pagocuota where fk_inscripto=".$row3["id_inscripto"]." order by nrocuota;");
			  	    while($row4 = pg_fetch_array($tip4))
						{
							echo '
							<tr>
    <td width="50%" class="jus">Numero de Cuota:</td>
    <td width="50%">'.$row4["nrocuota"].'</td>
  </tr>
  <tr>
    <td class="jus">Estado:</td>
    <td>';
	if ($row4["estado"]=="f")
		{
			echo '<strong>No pagado</strong>';
		}else
		{
			echo '<strong>Pagado</strong>';
			}
	echo '</td>
  </tr>
  <tr>
    <td class="jus">Monto:</td>
    <td>'.$row4["montoxcuota"].'</td>
  </tr>
  <tr>
    <td class="jus">Fecha de Pago:</td>
    <td>'.$row4["fechapago"].'</td>
  </tr>';
						}
				echo '</table>';
				
						//	inscripto.id,   ,apellido, telfijo,mail,direccion,  numero ,dni,tipodoc,localidad ,telcel, fk_curso, cursos.nombre as nomcurso
					$nombre=$row3["nom"];
					$apellido=$row3["apellido"];
					$numdoc=$row3["dni"];
					$direccion=$row3["direccion"];
					$numero=$row3["numero"];
					$localidad=$row3["localidad"];
					$mail=$row3["mail"];
					$telfijo=split("-",$row3["telfijo"]);
					$telcel=split("-",$row3["telcel"]);
					$variableControl = 1;
					//poner todas las variables
					}
			
			  }else{
					$nombre='';
					$apellido='';
					$numdoc='';
					$direccion='';
					$numero='';
					$localidad='';
					$mail='';
					$telfijo='';
					$telcel='';
					$variableControl = 0;
				    echo "no existe el alumno";
				  }
		  
		  	?>
<form class="formAltaInscripto" id="regInscripto" action="guardarDatosInscripto.php" method="get" onsubmit="return validarForm(this)">
<fieldset>
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Inscripcion a Cursos y Seminarios - Secretaria de Extension Universitaria</FONT></legend>
		<p>
		<label>Curso :</label>
		<select name="curso"  class="myTextField" id="curso" >
		<option value="0" selected="selected">Seleccione el Curso</option>
			<?php
			$anio = date("Y");
			include_once "conexionCursosExtension.php";										 		
				$tip1 = pg_query($conn,"SELECT id_cursos,nombre,duracion_desde,duracion_hasta FROM cursos where anio='$anio';");
				while($row1 = pg_fetch_array($tip1)){
					$arrayotrafecha=split("/",$row1['duracion_desde']);
					$arrayotrafecha2=split("/",$row1["duracion_hasta"]);
					$timehoy=mktime(0,0,0,date("n"),date("d")-7,date("Y"));
					$timeotrafecha=mktime(0,0,0,$arrayotrafecha[1],$arrayotrafecha[0],$arrayotrafecha[2]);
					$timeotrafecha2=mktime(0,0,0,$arrayotrafecha2[1],$arrayotrafecha2[0],$arrayotrafecha2[2]);
   // if($timehoy<=$timeotrafecha){
//	if($timehoy<=$timeotrafecha2){
                    echo "<option value=".$row1["id_cursos"]." $seleccionado>".$row1["nombre"]."</option>";
					}//}}  ?>
			</select>
		</p>
		<p>
			<label for="cname">Nombre: </label>
			<input id="cname" name="nombreInscripto" type="text" value="<?php echo $nombre;?>" class="required" size="22" maxlength="40"/>
			<input id="cvar" name="variableControl" type="hidden" value="<?php echo $variableControl;?>"/>
		</p>
		<p>
			<label for="capellido">Apellido: </label>
			<input id="capellido" name="apellidoInscripto" type="text" value="<?php echo $apellido;?>" class="required" size="22" maxlength="40"/>
		</p>
		<p>
			<label for="ctipoDocumento">Tipo: </label>
			<select size="1" name="tipoDocumento" >
			<?php

                            include_once 'conexionCursosExtension.php';                            
                            $valores2 = pg_query("SELECT * FROM tipodocumento");                            
                            while($row=pg_fetch_array($valores2,NULL,PGSQL_ASSOC)){
                                $idCat = $row['id_tipodocumento'];
                                $idCat = '"'.$idCat.'"';
                                echo "<option value=".$idCat.">".$row['nombretipo']."</option>"; 
                            }
                        ?>
			</select>
		</p>
		<p>
		<label for="cdni">N&uacute;mero: </label>
			<input id="cdni" name="dniInscripto" type="text" value="<?php echo $numdoc;?>" size="22" maxlength="8" class="required numCuil"/>
		</p>
		<p>
		<label for="ccalleInscipto">Calle: </label>
		<input id="ccalleInscripto" name="calleInscripto" type="text" size="22" value="<?php echo $direccion;?>" class="required"/>
		</p>
		<p>
		<label for="cnumCalleInscripto">N&uacute;mero: </label>
		<input id="cnumCalleInscripto" name="numCalleInscripto" type="text" size="22" value="<?php echo $numero;?>" maxlength="6" class="number"/>
		</p>
		<p>
		<label for="clocalidadInscripto">Localidad: </label>
			<input id="clocalidadInscripto" name="localidadInscripto" type="text" value="<?php echo $localidad;?>" size="22" class="required"/>
		</p>
		<p>
		<label for="ctelFijoInscripto">Tel&eacute;fono Fijo: </label>
			<input id="ctelFijoInscripto" name="caracteristicaFijo" type="text" value="<?php echo $telfijo[0];?>" size="3" maxlength="5" class="caracteristica"/>
			<input id="ctelFijoIncripto" name="fijo" type="text" value="<?php echo $telfijo[1];?>" size="12" maxlength="8" class="telFijo"/>
		</p>
		<p>
		<label for="ccelInscripto">Celular: </label>
			<input id="ccelInscripto" name="caracteristicaCel" type="text" value="<?php echo $telcel[0];?>" size="3" maxlength="5" class="caracteristica"/>
			<input id="ccelInscripto" name="celInscripto" type="text" value="<?php echo $telcel[1];?>" size="22" maxlength="9" class="required min"/>
		</p>
		<p>
		<label for="ccorreoInscripto">E-mail: </label>
			<input id="ccorreoInscripto" name="correoInscripto"  type="text" value="<?php echo $mail;?>"  size="22" class="email"/>
		</p>
		<p>
		<label for="ccorreoInscripto">¿C&oacute;mo te enteraste de la existencia del curso?: </label>
			<input id="cinfo" name="info"  type="text" value="<?php echo $info;?>"  size="22"/>
		</p>
		<p>
			<input class="submit" type="submit" value="Guardar"/>
			<a href=""><input type="button" value="Atr&aacute;s"></a>
		</p>
	</fieldset>
</form>
</body>
</html>
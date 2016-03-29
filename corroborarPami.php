<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="jquery-latest.js"></script>
<script type="text/javascript" src="jquery.validate.js"></script>
<title>Corroborar Inscripto</title>
<style type="text/css">
		{font-family: Cambria }
			{font-family: Cambria }			
			form {padding: 15px; border: 1px Solid #D8D8D8;background: #F2F2F2;}
			label {color: #336699; font-family: Cambria;}
			label.error {font-family: Cambria;float: none;vertical-align: top;color: red;padding-left: .5em;}
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
		</script>
</head>

<body>

<form id="form1" name="form1" method="post" action="registroPami.php">
<fieldset id="tabla">
<legend><FONT face="Arial" size="3" color="#6E6E6E">Ingrese el numero de DNI para corroborar que este alumno se encuentre en nuestra BD</FONT></legend>
<table width="100%">
	<tr width="100%">
		<td width="20%" align="right">
			<label for="cDNI">DNI: </label>
		</td>
		<td width="80%">
			<input id="cNumeroDNI" name="numdoc" type="text" value="" size="53" maxlength="10" class="number"/>
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td align="center" colspan="2">
			<input class="submit" type="submit" value="Buscar"/>
		</td>
	</tr>
</table>	
</form>

</body>
</html>
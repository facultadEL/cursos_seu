<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
#form1 p {
	text-align: center;
}
</style>
</head>

<body>
Ingrese el numero de DNI para corroborar que este alumno se encuentre en nuestra BD<br>
<form id="form1" name="form1" method="post" action="inscripcioncurso.php">
  <p>
    DNI: 
    <input name="numdoc" type="text" id="numdoc" size="11" maxlength="10"  />
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Enviar" />
  </p>
</form>
<p>&nbsp; </p>
</body>
</html>
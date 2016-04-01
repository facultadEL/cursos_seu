<?php
include "conexionCursosExtension.php";
$dni = empty($_POST['dni']) ? '' : $_POST['dni'];
$nombre = empty($_POST['nombre']) ? '' : ucwords(strtolower($_POST['nombre']));
$apellido = empty($_POST['apellido']) ? '' : ucwords(strtolower($_POST['apellido']));
$mail = empty($_POST['mail']) ? '' : $_POST['mail'];
$direccion = empty($_POST['direccion']) ? '' : ucwords(strtolower($_POST['direccion']));
$numero = empty($_POST['numero']) ? '' : $_POST['numero'];
$localidad = empty($_POST['localidad']) ? '' : ucwords(strtolower($_POST['localidad']));

$estaEnSistema = $_POST['estaEnSistema'];
$esInscripto = $_POST['esInscripto'];
$cantCursos = empty($_POST['cantCursos']) ? '' : $_POST['cantCursos'];
$caracteristicaCasa = empty($_POST['caracteristicaCasa']) ? '' : $_POST['caracteristicaCasa'];
$telefonoCasa = empty($_POST['telefonoCasa']) ? '' : $_POST['telefonoCasa'];
$caracteristicaCel = empty($_POST['caracteristicaCel']) ? '' : $_POST['caracteristicaCel'];
$telefonoCel = empty($_POST['telefonoCel']) ? '' : $_POST['telefonoCel'];

$otros = empty($_POST['otros']) ? '' : $_POST['otros'];

$fechaActual = date('Y-m-d');

//Si exites y es inscripto crear nuevo interesado
//Si no exites crear nuevo interesado
//Si existe y no es inscripto hacer un update
//Obtener id del interesado
//Traer los cursos
//Ver si otro tiene nombre y crear uno nuevo
//Agregar id cursos e id interesado a tabla intermedia

$idInt = 0;
if($esInscripto == "1")
{
	$cIdInt = "SELECT max(id_interesado) FROM interesado;";
	$sIdInt = pg_query($cIdInt);
	$rIdInt = pg_fetch_array($sIdInt);
	$idInt = $rIdInt['max'] + 1;

	$cCrearInt = "INSERT INTO interesado(id_interesado,nombre,apellido,direccion,numero,caracteristicaCasa,telefonoCasa,caracteristicaCel,telefonoCel,dni,localidad,fecharegistro) VALUES('$idInt','$nombre','$apellido','$direccion','$numero','$caracteristicaCasa','$telefonoCasa','$caracteristicaCel','$telefonoCel','$dni','$localidad','$fechaActual');";
}
else if($esInscripto == "0")
{
	$cIdInt = "SELECT id_interesado FROM interesado WHERE dni='$dni';";
	$sIdInt = pg_query($cIdInt);
	$rIdInt = pg_fetch_array($sIdInt);
	$idInt = $rIdInt['id_interesado'];

	$cCrearInt = "UPDATE interesado SET nombre='$nombre',apellido='$apellido',direccion='$direccion',numero='$numero',caracteristicaCasa='$caracteristicaCasa',telefonoCasa='$telefonoCasa',caracteristicaCel='$caracteristicaCel',telefonoCel='$telefonoCel',mail='$mail',localidad='$localidad',fecharegistro='$fechaActual' WHERE id_interesado='$idInt';";
}

$cCrearCurso = "";

//echo $cantCursos;
for($i = 1; $i <= $cantCursos; $i++)
{
	$nombreIdCurso = 'curso'.$i;
	$idCurso = $_POST[$nombreIdCurso];
	if($idCurso != "0")
	{
		$cCrearCurso .= "INSERT INTO interesadoxcurso(interesado_fk,curso_fk) (SELECT '$idInt','$idCurso' WHERE NOT EXISTS(SELECT 1 FROM interesadoxcurso WHERE interesado_fk='$idInt' AND curso_fk='$idCurso'));";
	}
}

if(trim($otros) != "")
{
	$otros = strtolower($otros);
	$nombreCursoCrear = ucwords($otros);
	$cCurso = "SELECT count(id) as contar, id FROM cursointeresado WHERE lower(nombre)='$otros' GROUP BY id;";
	$sCurso = pg_query($cCurso);
	$rCurso = pg_fetch_array($sCurso);
	if($rCurso['contar'] == 0)
	{
		$cIdCurso = "SELECT max(id) FROM cursointeresado;";
		$sIdCurso = pg_query($cIdCurso);
		$rIdCurso = pg_fetch_array($sIdCurso);
		$idCursoCrear = $rIdCurso['max'] + 1;

		$cCrearCurso .= "INSERT INTO cursointeresado(id,nombre) VALUES('$idCursoCrear','$nombreCursoCrear'); INSERT INTO interesadoxcurso(interesado_fk,curso_fk) VALUES('$idInt','$idCursoCrear');";
	}
	else
	{
		$idCursoAgregar = $rCurso['id'];
		$cCrearCurso .= "INSERT INTO interesadoxcurso(interesado_fk,curso_fk) (SELECT '$idInt','$idCursoAgregar' WHERE NOT EXISTS(SELECT 1 FROM interesadoxcurso WHERE interesado_fk='$idInt' AND curso_fk='$idCursoAgregar'));";
	}
}

$sqlGuardar = $cCrearInt.$cCrearCurso;
//echo $sqlGuardar;

$error = 0;
if (!pg_query($sqlGuardar)){
	$errorpg = pg_last_error($conn);
	$termino = "ROLLBACK";
	$error=1;
}else{
	$termino = "COMMIT";
}
pg_query($termino);

if ($error==1){
	echo '<script language="JavaScript"> alert("Los datos no se modificaron correctamente. Pongase en contacto con el administrador");window.location="interesado.html"</script>';
}else{
	echo '<script language="JavaScript"> alert("Los datos se actualizaron correctamente."); window.location = "interesado.html";</script>';
}

?>
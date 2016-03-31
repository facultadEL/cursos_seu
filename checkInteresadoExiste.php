<?php

include_once 'conexionCursosExtension.php';

$dni = $_REQUEST['dni'];

$c = "SELECT count(id_interesado) as contar FROM interesado WHERE dni='$dni';";
$s = pg_query($c);
$r = pg_fetch_array($s);

if($r['contar'] != 0)
{
	$esInscripto = 0;
	$enSistema = 1;
	$cInteresado = "SELECT * FROM interesado WHERE dni='$dni';";
	$sInteresado = pg_query($cInteresado);
	$rInteresado = pg_fetch_array($sInteresado);
	$nombre = empty($rInteresado['nombre']) ? "" : $rInteresado['nombre'];
	$apellido = empty($rInteresado['apellido']) ? "" : $rInteresado['apellido'];
	$direccion = empty($rInteresado['direccion']) ? "" : $rInteresado['direccion'];
	$numero = empty($rInteresado['numero']) ? "" : $rInteresado['numero'];
	$caracteristicaCasa = empty($rInteresado['caracteristicacasa']) ? "" : $rInteresado['caracteristicacasa'];
	$telefonoCasa = empty($rInteresado['telefonocasa']) ? "" : $rInteresado['telefonocasa'];
	$caracteristicaCel = empty($rInteresado['caracteristicacel']) ? "" : $rInteresado['caracteristicacel'];
	$telefonoCel = empty($rInteresado['telefonocel']) ? "" : $rInteresado['telefonocel'];
	$mail = empty($rInteresado['mail']) ? "" : $rInteresado['mail'];
}
else
{
	$c1 = "SELECT count(id_inscripto) as contar FROM inscripto WHERE dni='$dni';";
	$s1 = pg_query($c1);
	$r1 = pg_fetch_array($s1);
	if($r1['contar'] != 0)
	{
		$esInscripto = 1;
		$enSistema = 1;
		$cInscripto = "SELECT * FROM inscripto WHERE dni='$dni';";
		$sInscripto = pg_query($cInscripto);
		$rInscripto = pg_fetch_array($sInscripto);
		$nombre = empty($rInscripto['nombre']) ? "" : $rInscripto['nombre'];
		$apellido = empty($rInscripto['apellido']) ? "" : $rInscripto['apellido'];
		$direccion = empty($rInscripto['direccion']) ? "" : $rInscripto['direccion'];
		$numero = empty($rInscripto['numero']) ? "" : $rInscripto['numero'];
		$telCasaNoFormat = empty($rInscripto['telfijo']) ? "" : $rInscripto['telfijo'];
		$telCelNoFormat = empty($rInscripto['telcel']) ? "" : $rInscripto['telcel'];

		$caracteristicaCasa = "";
		$telefonoCasa = "";
		$caracteristicaCel = "";
		$telefonoCel = "";

		$mail = empty($rInscripto['mail']) ? "" : $rInscripto['mail'];
		/*
		nombre text,
		apellido text,
		telfijo text,
		mail text,
		direccion text,
		numero integer,
		dni integer,
		fechainscripto date,
		fk_tipodoc integer,
		localidad text,
		telcel text,
		*/
	}
	else
	{
		$esInscripto = 0;
		$enSistema = 0;
		$nombre = "";
		$apellido = "";
		$direccion = "";
		$numero = "";
		$caracteristicaCasa = "";
		$telefonoCasa = "";
		$caracteristicaCel = "";
		$telefonoCel = "";
		$mail = "";
	}
}

$outJson = '[{
		"esInscripto":"'.$esInscripto.'",
		"enSistema":"'.$enSistema.'",
		"nombre":"'.$nombre.'",
		"apellido":"'.$apellido.'",
		"direccion":"'.$direccion.'",
		"numero":"'.$numero.'",
		"caracteristicaCasa":"'.$caracteristicaCasa.'",
		"telefonoCasa":"'.$telefonoCasa.'",
		"caracteristicaCel":"'.$caracteristicaCel.'",
		"telefonoCel":"'.$telefonoCel.'",
		"mail":"'.$mail.'"
	}]';

echo $outJson;

?>
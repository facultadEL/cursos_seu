<?php

include_once 'conexionCursosExtension.php';

$dni = $_REQUEST['dni'];

$c = "SELECT count(id) as contar FROM interesado WHERE dni='$dni';";
$s = pg_query($c);
$r = pg_fetch_array($s);

if($r['contar'] != 0)
{
	$esInscripto = 0;
	$enSistema = 1;
	$cInteresado = "SELECT * FROM interesado WHERE dni='$dni';";
	$sInteresado = pg_query($cInteresado);
	$rInteresado = pg_fetch_array($sInteresado);
	$nombre = $rInteresado['nombre'];
	$apellido = $rInteresado['apellido'];
	$direccion = $rInteresado['direccion'];
	$numero = $rInteresado['numero'];
	$caracteristicaCasa = $rInteresado['caracteristicaCasa'];
	$telefonoCasa = $rInteresado['telefonoCasa'];
	$caracteristicaCel = $rInteresado['caracteristicaCel'];
	$telefonoCel = $rInteresado['telefonoCel'];
	$mail = $rInteresado['mail'];
}
else
{

}

/*
datos.enSistema
datos.esInscripto
datos.enSistema
datos.nombre
datos.apellido
datos.direccion
datos.numero
datos.caracteristica
datos.telefono
datos.mail
*/

?>
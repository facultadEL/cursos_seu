<?php

include_once 'conexionCursosExtension.php';

$html = '';

$sqlInteresado = pg_query('SELECT interesado.* FROM interesado ORDER BY interesado.apellido,interesado.nombre asc;');

$outJson = '[';
while($rowI = pg_fetch_array($sqlInteresado))
{
	if($outJson!= '[')
	{
		if($cantCursos > 0)
		{
			$outJson .= ',';	
		}
	}

	$id = $rowI['id_interesado'];
	$nombre = $rowI['nombre'];
	$apellido = $rowI['apellido'];
	$caracCel = $rowI['caracteristicacel'];
	$telCel = $rowI['telefonocel'];
	$caracCasa = $rowI['caracteristicaCasa'];
	$telCasa = $rowI['telefonocasa'];
	$mail = $rowI['mail'];
	$localidad = $rowI['localidad'];
	$fechaReg = $rowI['fecharegistro'];
	
	$cursos = "";

	$cC = "SELECT cursointeresado.* FROM cursointeresado INNER JOIN interesadoxcurso ON(interesadoxcurso.curso_fk = cursointeresado.id) WHERE interesadoxcurso.interesado_fk='$id' AND anulado IS FALSE;";
	$sC = pg_query($cC);
	$cantCursos = 0;
	while($rC = pg_fetch_array($sC))
	{
		$cantCursos++;
		$cursos .= ($cursos == "") ? "" : '<br />';
		$cursos .= ucwords(strtolower($rC['nombre']));
	}
	if($cantCursos > 0)
	{
		$outJson .= '{
			"id":"'.$id.'",
			"apellido":"'.$apellido.'",
			"nombre":"'.$nombre.'",
			"caracteristicaCel":"'.$caracCel.'",
			"telefonoCel":"'.$telCel.'",
			"caracteristicaCasa":"'.$caracCasa.'",
			"telefonoCasa":"'.$telCasa.'",
			"mail":"'.$mail.'",
			"localidad":"'.$localidad.'",
			"cursos":"'.$cursos.'",
			"fechaRegistro":"'.$fechaReg.'"
		}';
	}
}

$outJson .= ']';

pg_close($conn);

echo $outJson;

?>
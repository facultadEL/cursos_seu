<?php

include "conexionCursosExtension.php";

$outJson = '[';

$cA = "SELECT anio FROM cursos GROUP BY anio ORDER BY anio DESC;";
$sA = pg_query($cA);
while($r = pg_fetch_array($sA))
{
    $anio = $r['anio'];

    if($outJson!= '[')
	{
		$outJson .= ',';
	}
    $outJson .= '{
		"anio":'.$anio.',
        "data":';

    $cC = "SELECT id_cursos,nombre,anio,activado FROM cursos WHERE anio='$anio' ORDER BY nombre ASC;";
    $sC = pg_query($cC);
    $objCursos = '[';
    while($rC = pg_fetch_array($sC))
    {
        if($objCursos!= '[')
        {
            $objCursos .= ',';
        }

        $id = $rC['id_cursos'];
        $nombre = ucwords(strtolower($rC['nombre']));
        $an = $rC['anio'];
        $activado = $rC['activado'];
                
        $objCursos .= '{
            "id":'.$id.',
            "nombre":"'.$nombre.'",
            "anio":"'.$an.'",
            "activado":"'.$activado.'"
        }';
    }
    $objCursos .= ']';

    $outJson .= $objCursos.'}';
}

$outJson .= ']';

pg_close($conn);

echo $outJson;
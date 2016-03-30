<?php

include "conexionCursosExtension.php";

$consulta = "SELECT * FROM cursointeresado ORDER BY nombre ASC;";
$sql = pg_query($consulta);
$outJson = '[';
while($row = pg_fetch_array($sql))
{
	if($outJson!= '[')
	{
		$outJson .= ',';
	}

	$id = $row['id'];
	$nombre = $row['nombre'];
			
	$outJson .= '{
		"id":'.$id.',
		"nombre":"'.$nombre.'"
	}';
}

$outJson .= ']';

pg_close($conn);

echo $outJson;

?>
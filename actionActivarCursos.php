<?php

include "conexionCursosExtension.php";

$id = $_REQUEST['id'];
$activar = $_REQUEST['activar'];

$act = ($activar == 't') ? 'TRUE' : 'FALSE';
//$activar = ($activar == 't') ? 'f' : 't';
$c = "UPDATE cursos SET activado='$act' WHERE id_cursos='$id';";

$success = 't';
if (!pg_query($c)){
	$errorpg = pg_last_error($conn);
	$termino = "ROLLBACK";
	$success = 'f';
}else{
	$termino = "COMMIT";
}
pg_query($termino);

$outJson = '[{"success":"'.$success.'","id":"'.$id.'","activar":"'.$activar.'"}]';
echo $outJson;
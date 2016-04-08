<?php

include_once 'conexionCursosExtension.php';

$id = $_REQUEST['id'];
$cursos = explode('/--/', $_REQUEST['cursos']);

$sql = '';

for($i = 0; $i < count($cursos); $i++)
{
	$nC = $cursos[$i];
	$sql .= "UPDATE interesadoxcurso SET anulado='TRUE' WHERE interesado_fk='$id' AND curso_fk=(SELECT ci.id FROM cursointeresado ci WHERE ci.nombre='$nC');";
}

//echo $sql;
$error = 0;
if (!pg_query($sql)){
	$errorpg = pg_last_error($conn);
	$termino = "ROLLBACK";
	$error=1;
}else{
	$termino = "COMMIT";
}
pg_query($termino);

if ($error==1){
	echo '0';
}else{
	echo '1';
}

?>
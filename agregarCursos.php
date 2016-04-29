<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<?php

include "conexionCursosExtension.php";

$id = $_REQUEST['id'];
$cursos = $_REQUEST['cursos'];
$vCursos = explode('/--/', $cursos);

$cAgregarCurso = '';

for($i = 0; $i < (count($vCursos) - 1); $i++)
{
	$idCurso = $vCursos[$i];
	$cAgregarCurso .= "INSERT INTO interesadoxcurso(interesado_fk,curso_fk) (SELECT '$id','$idCurso' WHERE NOT EXISTS(SELECT 1 FROM interesadoxcurso WHERE interesado_fk='$id' AND curso_fk='$idCurso' AND anulado='FALSE'));";
}

$sqlGuardar = $cAgregarCurso;
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
	echo '0';
}else{
	echo '1';
}

?>
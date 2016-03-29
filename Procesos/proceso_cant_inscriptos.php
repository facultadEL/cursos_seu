<?php
include "conexionCursosExtension.php";

$cant_cursos = pg_query("SELECT COUNT(id_cursos) AS total_cursos FROM cursos");
$row_cant_cursos=pg_fetch_array($cant_cursos,NULL,PGSQL_ASSOC);
	$total_cursos = $row_cant_cursos['total_cursos'];


for ($i=1; $i <= $total_cursos ; $i++) {
	$cant_inscriptos = pg_query("SELECT COUNT(fk_inscriptos) AS total_inscriptos FROM inscriptosxcurso WHERE fk_curso = $i");
	$row_cant_inscriptos=pg_fetch_array($cant_inscriptos,NULL,PGSQL_ASSOC);
		$total_inscriptos = $row_cant_inscriptos['total_inscriptos'];
		pg_query("UPDATE cursos SET cant_inscriptos = $total_inscriptos WHERE id_cursos=$i");
}
echo 'Proceso Terminado';
?>
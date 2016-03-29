<?php
include_once('conexionCursoOriginal.php');
$asistencias = pg_query($cnx,"SELECT * FROM asistencia");
while($row6=pg_fetch_array($asistencias,NULL,PGSQL_ASSOC)){
	$idAsistencia = $row6['id'];
	$fecha = $row6['fecha'];
	$asistencia = $row6['asistencia'];
	$fk_alumno = $row6['fk_alumno'];
	$consultaAsistencia = $consultaAsistencia."INSERT INTO asistencia(id_asistencia,fecha,asistencia,fk_alumno) VALUES ('".$idAsistencia."','".$fecha."','".$asistencia."','".$fk_alumno."');<br>";
}
echo $consultaAsistencia;
?>

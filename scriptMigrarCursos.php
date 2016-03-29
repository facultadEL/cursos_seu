<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
include_once("conexionCursoOriginal.php");

$tiposCursos = pg_query($cnx,"SELECT * FROM tipo_curso");
while($row1=pg_fetch_array($tiposCursos,NULL,PGSQL_ASSOC)){
	$idTipoCurso = $row1['id'];
	$nombreCurso = $row1['nombre'];
	$consultaTipoCurso = $consultaTipoCurso."INSERT INTO tipo_curso(id_tipo_curso,nombre) VALUES('".$idTipoCurso."','".$nombreCurso."');<br>";
}

$imagen = pg_query($cnx,"SELECT * FROM imagen");
while($row3=pg_fetch_array($imagen,NULL,PGSQL_ASSOC)){
	$idImagen = $row3['id'];
	$nombre = $row3['nombre'];
	$mime = $row3['mime'];
	$size = $row3['size'];
	$img_archivo_oid = $row3['img_archivo_oid'];
	$consultaImagen = $consultaImagen."INSERT INTO imagen(id_imagen,nombre,mime,size,img_archivo_oid) VALUES ('".$idImagen."','".$nombre."','".$mime."','".$size."','".$img_archivo_oid."');<br>";
}

$cursos = pg_query($cnx,"SELECT * FROM cursos");
while($row2=pg_fetch_array($cursos,NULL,PGSQL_ASSOC)){
	$idCurso = $row2['id'];
	$nombre = $row2['nombre'];
	$anio = $row2['anio'];
	$duracion_desde = $row2['duracion_desde'];
	$duracion_hasta = $row2['duracion_hasta'];
	$docente = $row2['docente'];
	$descripcion = $row2['descripcion'];
	$fk_tipo = $row2['fk_tipo'];
	$publicidad_desde = $row2['publicidad_desde'];
	$publicidad_hasta = $row2['publicidad_hasta'];
	$fk_imagen = $row2['fk_imagen'];
	$fk_programa = $row2['fk_programa'];
	$hora_desde = $row2['hora_desde'];
	$hora_hasta = $row2['hora_hasta'];
	$dia1 = $row2['dia1'];
	$dia2 = $row2['dia2'];
	$hora_desde2 = $row2['hora_desde2'];
	$hora_hasta2 = $row2['hora_hasta2'];
	$monto = $row2['monto'];
	$cantcuota = $row2['cantcuota'];
	$cargahoraria = $row2['carga_horaria'];
	$num_resolucion = $row2['num_resolucion'];
	$fecha_resolucion = $row2['fecha_resolucion'];
	$fecha_impresion = $row2['fecha_impresion'];
	$publicar = $row2['publicar'];
	$fk_planificacion = $row2['fk_planificacion'];
	$fk_curriculum = $row2['fk_curriculum'];
	$consultaCurso = $consultaCurso."INSERT INTO cursos(id_cursos,nombre,anio,duracion_desde,duracion_hasta,docente,descripcion,fk_tipo,publicidad_desde,publicidad_hasta,fk_imagen,fk_programa,hora_desde,hora_hasta,dia1,dia2,hora_desde2,hora_hasta2,monto,cantcuota,carga_horaria,num_resolucion,fecha_resolucion,fecha_impresion,publicar,fk_planificacion,fk_curriculum) VALUES('".$idCurso."','".$nombre."','".$anio."','".$duracion_desde."','".$duracion_hasta."','".$docente."','".$descripcion."','".$fk_tipo."','".$publicidad_desde."','".$publicidad_hasta."','".$fk_imagen."','".$fk_programa."','".$hora_desde."','".$hora_hasta."','".$dia1."','".$dia2."','".$hora_desde2."','".$hora_hasta2."','".$monto."','".$cantcuota."','".$cargahoraria."','".$num_resolucion."','".$fecha_resolucion."','".$fecha_impresion."','".$publicar."','".$fk_planificacion."','".$fk_curriculum."');<br>";
}
//$tiposCursos = pg_query($cnx,"SELECT * FROM tipo_curso");
//while($row1=pg_fetch_array($tiposCursos,NULL,PGSQL_ASSOC)){
$inscripto = pg_query($cnx,"SELECT * FROM inscripto");
while($row4 = pg_fetch_array($inscripto,NULL,PGSQL_ASSOC)){
	$idInscripto = $row4['id'];
	$cont = $cont + 1;
	$idInscripto2[$cont] = $idInscripto;
	$nombre = $row4['nombre'];
	$apellido = $row4['apellido'];
	$telFijo = $row4['telfijo'];
	$mail = $row4['mail'];
	$direccion = $row4['direccion'];
	$numero = $row4['numero'];
	$dni = $row4['dni'];
	$tipoDoc = $row4['tipodoc'];
	$localidad = $row4['localidad'];
	$telCel = $row4['telcel'];
	$fk_curso = $row4['fk_curso'];
	$porcentajeDescuento = $row4['porcdescuento'];
	$motivoDescuento = $row4['motivodescuento'];
	$consultaInscripto = $consultaInscripto."INSERT INTO inscripto(id_inscripto,nombre,apellido,telfijo,mail,direccion,numero,dni,fk_tipodoc,localidad,telcel) VALUES ('".$idInscripto."','".$nombre."','".$apellido."','".$telFijo."','".$mail."','".$direccion."','".$numero."','".$dni."','1','".$localidad."','".$telCel."');<br>";
	$consultaInscriptoxCursos = $consultaInscriptoxCursos."INSERT INTO inscriptosxcurso(id_inscriptosxcurso,fk_inscriptos,fk_curso,porcdescuento,motivodescuento) VALUES ('".$idInscripto."','".$idInscripto."','".$fk_curso."','".$porcentajeDescuento."','".$motivoDescuento."');<br>";
}

$asistencias = pg_query($cnx,"SELECT * FROM asistencia");
while($row6=pg_fetch_array($asistencias,NULL,PGSQL_ASSOC)){
	$idAsistencia = $row6['id'];
	$fecha = $row6['fecha'];
	$asistencia = $row6['asistencia'];
	$fk_alumno = $row6['fk_alumno'];
	$consultaAsistencia = $consultaAsistencia."INSERT INTO asistencia(id_asistencia,fecha,asistencia,fk_alumno) VALUES ('".$idAsistencia."','".$fecha."','".$asistencia."','".$fk_alumno."');<br>";
}

$pagosencoop = pg_query($cnx,"SELECT * FROM pagosencoop");
while($row5 = pg_fetch_array($pagosencoop,NULL,PGSQL_ASSOC)){
	$idPagosenCoop = $row5['id'];
	$codBarras = $row5['codigo_barras'];
	$fechaPago = $row5['fechapago'];
	$monto = $row5['monto'];
	$numRecibo = $row5['num_recibo'];
	$nomyapellido = $row5['nombreyapellido'];
	$codAlumno = $codBarras[0].$codBarras[1].$codBarras[2].$codBarras[3];
	if ($codAlumno<1000){
		$codAlumno = $codBarras[1].$codBarras[2].$codBarras[3];
		if ($codAlumno<100){
			$codAlumno = $codBarras[2].$codBarras[3];
			if ($codAlumno<10){
				$codAlumno = $codBarras[3];
			}
		}
	}
	$consultaPagosEnCoop = $consultaPagosEnCoop."INSERT INTO pagosencoop(id_pagosencoop,codigo_barras,fechapago,monto,num_recibo,nombreyapellido,fk_inscriptosxcursos) VALUES ('".$idPagosenCoop."','".$codBarras."','".$fechaPago."','".$monto."','".$numRecibo."','".$nomyapellido."','".$codAlumno."');<br>";
}


//include_once("conexionCursoExtension.php");
$datos=$consultaTipoCurso.$consultaImagen.$consultaCurso.$consultaInscripto.$consultaInscriptoxCursos.$consultaPagosEnCoop.$consultaAsistencia;

echo $datos;

//$res=pg_query($conn,$datos);
		//$result2 = pg_query($conn,$inspar);
		//controlo que todo haya sido guardado correctamente
//$error=0;
//if (!$res) 
//{
	//$errorpg = pg_last_error($conn);
	//$termino = "ROLLBACK";
	//$error=1;
//}else{
	//$termino = "COMMIT";
//}
//pg_query($termino);




?>
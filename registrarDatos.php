<html>
<?php
include_once "conexionCursosExtension.php";

$curso_fk = $_REQUEST['cursoF'];

$CursoExistente = pg_query("SELECT * FROM listado_registros_necesarios WHERE curso_fk = $curso_fk");
$rowExistente = pg_fetch_array($CursoExistente);
	$cursoExistente = $rowExistente['curso_fk'];
if ( $curso_fk != NULL){
	if ($curso_fk != $cursoExistente){
	
		$temario_general_curso = $_REQUEST['temario_general_curso'];
		$planificacion_curso = $_REQUEST['planificacion_curso'];
		$cotizacion_curso = $_REQUEST['cotizacion_curso'];
		$no_esta_cotizacion_curso = $_REQUEST['no_esta_cotizacion_curso'];
		$convenio_curso = $_REQUEST['convenio_curso'];
		$no_esta_convenio_curso = $_REQUEST['no_esta_convenio_curso'];
		$convenio_docente_curso = $_REQUEST['convenio_docente_curso'];
		$no_esta_convenio_docente_curso = $_REQUEST['no_esta_convenio_docente_curso'];
		$planilla_inscripcion_curso = $_REQUEST['planilla_inscripcion_curso'];
		$planilla_asistencia = $_REQUEST['planilla_asistencia'];
		$encuesta_satisfaccion = $_REQUEST['encuesta_satisfaccion'];
		$acta_examen = $_REQUEST['acta_examen'];
		$planilla_entrega_certificados = $_REQUEST['planilla_entrega_certificados'];
		$validacion_curso_jornada = $_REQUEST['validacion_curso_jornada'];
		$certificado_aprobacion = $_REQUEST['certificado_aprobacion'];
		$certificado_asistencia = $_REQUEST['certificado_asistencia'];
		$certificado_reconocimiento_docente = $_REQUEST['certificado_reconocimiento_docente'];
		

		$newRegistros="INSERT INTO listado_registros_necesarios(curso_fk, temario_general_curso, planificacion_curso, cotizacion_curso, no_esta_cotizacion_curso, convenio_curso, no_esta_convenio_curso, convenio_docente_curso, no_esta_convenio_docente_curso, planilla_inscripcion_curso, planilla_asistencia, encuesta_satisfaccion, acta_examen, planilla_entrega_certificados, validacion_curso_jornada, certificado_aprobacion, certificado_asistencia, certificado_reconocimiento_docente)VALUES('$curso_fk','$temario_general_curso','$planificacion_curso','$cotizacion_curso','$no_esta_cotizacion_curso','$convenio_curso','$no_esta_convenio_curso','$convenio_docente_curso','$no_esta_convenio_docente_curso','$planilla_inscripcion_curso','$planilla_asistencia','$encuesta_satisfaccion','$acta_examen','$planilla_entrega_certificados','$validacion_curso_jornada','$certificado_aprobacion','$certificado_asistencia','$certificado_reconocimiento_docente')";


			$error=0;

			if (!pg_query($conn, $newRegistros)) 
			 {
			 $errorpg = pg_last_error($conn);
			 $termino = "ROLLBACK";
			 $error=1;
			 }
			 else
			 {
			 $termino = "COMMIT";
			 }
		   pg_query($termino);
				
		if ($error==1){
			echo '<script language="JavaScript"> 			alert("Los datos no se guardaron correctamente. Pongase en contacto con el administrador");</script>';
			echo $errorpg;
		}else{
			echo '<script language="JavaScript"> 
			alert("Los datos se guardaron correctamente."); window.location = "listadoRegistrosNecesarios.php";</script>';
		}
	}else{
		//aca va el update
		$temario_general_curso = $_REQUEST['temario_general_curso'];
		$planificacion_curso = $_REQUEST['planificacion_curso'];
		$cotizacion_curso = $_REQUEST['cotizacion_curso'];
		$no_esta_cotizacion_curso = $_REQUEST['no_esta_cotizacion_curso'];
		$convenio_curso = $_REQUEST['convenio_curso'];
		$no_esta_convenio_curso = $_REQUEST['no_esta_convenio_curso'];
		$convenio_docente_curso = $_REQUEST['convenio_docente_curso'];
		$no_esta_convenio_docente_curso = $_REQUEST['no_esta_convenio_docente_curso'];
		$planilla_inscripcion_curso = $_REQUEST['planilla_inscripcion_curso'];
		$planilla_asistencia = $_REQUEST['planilla_asistencia'];
		$encuesta_satisfaccion = $_REQUEST['encuesta_satisfaccion'];
		$acta_examen = $_REQUEST['acta_examen'];
		$planilla_entrega_certificados = $_REQUEST['planilla_entrega_certificados'];
		$validacion_curso_jornada = $_REQUEST['validacion_curso_jornada'];
		$certificado_aprobacion = $_REQUEST['certificado_aprobacion'];
		$certificado_asistencia = $_REQUEST['certificado_asistencia'];
		$certificado_reconocimiento_docente = $_REQUEST['certificado_reconocimiento_docente'];
			
		
		//update
		$modRegistrosNecesarios="UPDATE listado_registros_necesarios SET temario_general_curso='$temario_general_curso', planificacion_curso='$planificacion_curso', cotizacion_curso='$cotizacion_curso', no_esta_cotizacion_curso='$no_esta_cotizacion_curso', convenio_curso='$convenio_curso', no_esta_convenio_curso='$no_esta_convenio_curso', convenio_docente_curso='$convenio_docente_curso', no_esta_convenio_docente_curso='$no_esta_convenio_docente_curso', planilla_inscripcion_curso='$planilla_inscripcion_curso', planilla_asistencia='$planilla_asistencia', encuesta_satisfaccion='$encuesta_satisfaccion', acta_examen='$acta_examen', planilla_entrega_certificados='$planilla_entrega_certificados', validacion_curso_jornada='$validacion_curso_jornada', certificado_aprobacion='$certificado_aprobacion', certificado_asistencia='$certificado_asistencia', certificado_reconocimiento_docente='$certificado_reconocimiento_docente' WHERE curso_fk = $curso_fk;";

			$error=0;

			if (!pg_query($conn, $modRegistrosNecesarios)) 
			 {
			 $errorpg = pg_last_error($conn);
			 $termino = "ROLLBACK";
			 $error=1;
			 }
			 else
			 {
			 $termino = "COMMIT";
			 }
		   pg_query($termino);
				
		if ($error==1){
			echo '<script language="JavaScript"> 			alert("Los datos no se modificaron correctamente. Pongase en contacto con el administrador");</script>';
			echo $errorpg;
		}else{
			echo '<script language="JavaScript"> 
			alert("Los datos se modificaron correctamente."); window.location = "listadoRegistrosNecesarios.php";</script>';
		}
		
	}
}else{
	$cursoF = $_REQUEST['cursoF1'];
	$temario_general_curso = $_REQUEST['temario_general_curso'];
	$planificacion_curso = $_REQUEST['planificacion_curso'];
	$cotizacion_curso = $_REQUEST['cotizacion_curso'];
	$no_esta_cotizacion_curso = $_REQUEST['no_esta_cotizacion_curso'];
	$convenio_curso = $_REQUEST['convenio_curso'];
	$no_esta_convenio_curso = $_REQUEST['no_esta_convenio_curso'];
	$convenio_docente_curso = $_REQUEST['convenio_docente_curso'];
	$no_esta_convenio_docente_curso = $_REQUEST['no_esta_convenio_docente_curso'];
	$planilla_inscripcion_curso = $_REQUEST['planilla_inscripcion_curso'];
	$planilla_asistencia = $_REQUEST['planilla_asistencia'];
	$encuesta_satisfaccion = $_REQUEST['encuesta_satisfaccion'];
	$acta_examen = $_REQUEST['acta_examen'];
	$planilla_entrega_certificados = $_REQUEST['planilla_entrega_certificados'];
	$validacion_curso_jornada = $_REQUEST['validacion_curso_jornada'];
	$certificado_aprobacion = $_REQUEST['certificado_aprobacion'];
	$certificado_asistencia = $_REQUEST['certificado_asistencia'];
	$certificado_reconocimiento_docente = $_REQUEST['certificado_reconocimiento_docente'];
	

		$newRegistros="INSERT INTO listado_registros_necesarios(curso_fk, temario_general_curso, planificacion_curso, cotizacion_curso, no_esta_cotizacion_curso, convenio_curso, no_esta_convenio_curso, convenio_docente_curso, no_esta_convenio_docente_curso, planilla_inscripcion_curso, planilla_asistencia, encuesta_satisfaccion, acta_examen, planilla_entrega_certificados, validacion_curso_jornada, certificado_aprobacion, certificado_asistencia, certificado_reconocimiento_docente)VALUES('$cursoF','$temario_general_curso','$planificacion_curso','$cotizacion_curso','$no_esta_cotizacion_curso','$convenio_curso','$no_esta_convenio_curso','$convenio_docente_curso','$no_esta_convenio_docente_curso','$planilla_inscripcion_curso','$planilla_asistencia','$encuesta_satisfaccion','$acta_examen','$planilla_entrega_certificados','$validacion_curso_jornada','$certificado_aprobacion','$certificado_asistencia','$certificado_reconocimiento_docente')";


			$error=0;

			if (!pg_query($conn, $newRegistros)) 
			 {
			 $errorpg = pg_last_error($conn);
			 $termino = "ROLLBACK";
			 $error=1;
			 }
			 else
			 {
			 $termino = "COMMIT";
			 }
		   pg_query($termino);
				
		if ($error==1){
			echo '<script language="JavaScript"> 			alert("Los datos no se guardaron correctamente. Pongase en contacto con el administrador");</script>';
			echo $errorpg;
		}else{
			echo '<script language="JavaScript"> 
			alert("Los datos se guardaron correctamente."); window.location = "listadoRegistrosNecesarios.php";</script>';
		}

}
?>
<?php
include_once "conexionCursosExtension.php";
$id_cursos = $_REQUEST['idCurso'];
$nombre = $_POST["nombre_curso"];
$fk_tipo = $_POST["tipo_curso"];
$anio = $_POST["anio"];
$periodo_curso = $_POST["periodo_curso"];
$monto = $_POST["Monto"];
$monto_antes_venc = $_POST["MontoAntesVenc"];
$dia_venc = $_POST["diaVenc"];
$cantcuota = $_POST["CantCuotas"];
$docente = $_POST["docentecurso"];
$forma_cobro_docente = $_POST["porcOEfect"];
$valor_a_cobrar = $_POST["pagoDocente"];
$horas_mensuales = $_POST["cantHorasMensualesDocente"];
$duracion_desde = $_POST["desde_fecha"];
$duracion_hasta = $_POST["hasta_fecha"];
$dia1 = $_POST["dia1"];
if($_POST["hora_desde1"]==""){
	$hora_desde="00:00:00";
	$hora_hasta="00:00:00";
}else{
	$hora_desde = $_POST["hora_desde1"].":".$_POST["minutos_desde1"].":00";
	$hora_hasta=$_POST["hora_hasta1"].":".$_POST["minutos_hasta1"].":00";
}
$dia2=$_POST["dia2"];
if($_POST["hora_desde2"]==""){
	$hora_desde2="00:00:00";
	$hora_hasta2="00:00:00";
}else{
	$hora_desde2=$_POST["hora_desde2"].":".$_POST["minutos_desde2"].":00";
	$hora_hasta2=$_POST["hora_hasta2"].":".$_POST["minutos_hasta2"].":00";
}
//Trae el periodo del curso
$periodoCurso = $_POST['periodo_curso'];
if($periodoCurso == 0){
	$periodoCurso = 4;
}
$descripcion = "-";
$publicidad_desde = "-";
$publicidad_hasta = "-";
$num_resolucion = "";
$fecha_resolucion = "";
$fecha_impresion = "";
$fk_imagen = "";

$id_programa=$_REQUEST["fkPrograma"];
$id_planificacion=$_REQUEST["fkPlanificacion"];
$id_curriculum=$_REQUEST["fkCurriculum"];
echo 'Id Programa:'.$id_programa;


	$tipo="oid";
	$type_programa = $_FILES["programa_curso"]["type"];
	$tmp_name_programa = $_FILES["programa_curso"]["tmp_name"];
	$size_programa = $_FILES["programa_curso"]["size"];
	$nombre_programa = basename($_FILES["programa_curso"]["name"]);

 	if($tmp_name_programa!=""){
 			include_once "noticiascurso/sitedefs.php";

			# Conexi?n a la base de datos
			$link = pg_connect("host=$dbhost user=$dbuser password=$dbpwd dbname=$dbname") or die(pg_last_error($link));
				
			# Contenido del archivo
	  		$fp = fopen($tmp_name_programa, "rb");
  			$buffer = fread($fp, filesize($tmp_name_programa));
			fclose($fp);
			
			$isoid=$tipo=='oid'?true:false;
		
			# Inicia una transacci?n
			pg_query($link, "begin");
			# Crea un objeto blob y retorna el oid
			$oid=pg_lo_create($link);
				
			$sql = "UPDATE imagen SET nombre='$nombre_programa',  img_archivo_oid='$oid', mime='$type_programa', size='$size_programa' WHERE id_imagen='$id_programa'";
			//echo 'SQL:'.$sql;
			# Ejecuta la sentencia SQL
			pg_query($link, $sql) or die(pg_last_error($link));
				if($isoid)
					{
					# Abre el objeto blob
					$blob=pg_lo_open($link,$oid,"w");
					# Escribe el contenido del archivo
					pg_lo_write($blob,$buffer);
					# Cierra el objeto
					pg_lo_close($blob);
					# Compromete la transacci?n
					pg_query($link, "commit");
					}
			
	}
	
	
	$tipo="oid";
	$type_planificacion = $_FILES["planificacion_curso"]["type"];
	$tmp_name_planificacion = $_FILES["planificacion_curso"]["tmp_name"];
	$size_planificacion = $_FILES["planificacion_curso"]["size"];
	$nombre_planificacion = basename($_FILES["planificacion_curso"]["name"]);

 	if($tmp_name_planificacion!=""){
 			include_once "noticiascurso/sitedefs.php";

			# Conexi?n a la base de datos
			$link = pg_connect("host=$dbhost user=$dbuser password=$dbpwd dbname=$dbname") or die(pg_last_error($link));
				
			# Contenido del archivo
	  		$fp = fopen($tmp_name_planificacion, "rb");
  			$buffer = fread($fp, filesize($tmp_name_planificacion));
			fclose($fp);
			
			$isoid=$tipo=='oid'?true:false;
		
			# Inicia una transacci?n
			pg_query($link, "begin");
			# Crea un objeto blob y retorna el oid
			$oid=pg_lo_create($link);
				
			$sql = "UPDATE imagen SET nombre='$nombre_planificacion',  img_archivo_oid='$oid', mime='$type_planificacion', size='$size_planificacion' WHERE id_imagen='$id_planificacion'";
			//echo 'SQL:'.$sql;
			# Ejecuta la sentencia SQL
			pg_query($link, $sql) or die(pg_last_error($link));
				if($isoid)
					{
					# Abre el objeto blob
					$blob=pg_lo_open($link,$oid,"w");
					# Escribe el contenido del archivo
					pg_lo_write($blob,$buffer);
					# Cierra el objeto
					pg_lo_close($blob);
					# Compromete la transacci?n
					pg_query($link, "commit");
					}
			
	}
	
	
	$tipo="oid";
	$type_curriculum = $_FILES["curriculum_curso"]["type"];
	$tmp_name_curriculum = $_FILES["curriculum_curso"]["tmp_name"];
	$size_curriculum = $_FILES["curriculum_curso"]["size"];
	$nombre_curriculum = basename($_FILES["curriculum_curso"]["name"]);

 	if($tmp_name_curriculum!=""){
 			include_once "noticiascurso/sitedefs.php";

			# Conexi?n a la base de datos
			$link = pg_connect("host=$dbhost user=$dbuser password=$dbpwd dbname=$dbname") or die(pg_last_error($link));
				
			# Contenido del archivo
	  		$fp = fopen($tmp_name_curriculum, "rb");
  			$buffer = fread($fp, filesize($tmp_name_curriculum));
			fclose($fp);
			
			$isoid=$tipo=='oid'?true:false;
		
			# Inicia una transacci?n
			pg_query($link, "begin");
			# Crea un objeto blob y retorna el oid
			$oid=pg_lo_create($link);
				
			$sql = "UPDATE imagen SET nombre='$nombre_curriculum',  img_archivo_oid='$oid', mime='$type_curriculum', size='$size_curriculum' WHERE id_imagen='$id_curriculum'";
			//echo 'SQL:'.$sql;
			# Ejecuta la sentencia SQL
			pg_query($link, $sql) or die(pg_last_error($link));
				if($isoid)
					{
					# Abre el objeto blob
					$blob=pg_lo_open($link,$oid,"w");
					# Escribe el contenido del archivo
					pg_lo_write($blob,$buffer);
					# Cierra el objeto
					pg_lo_close($blob);
					# Compromete la transacci?n
					pg_query($link, "commit");
					}
			
	}

$curso="UPDATE cursos SET  fk_tipo = '$fk_tipo', anio = '$anio', duracion_cursos='$periodoCurso', monto = '$monto', monto_antes_venc = '$monto_antes_venc', dia_venc = '$dia_venc', cantcuota = '$cantcuota', docente = '$docente', forma_cobro_docente = '$forma_cobro_docente', valor_a_cobrar = '$valor_a_cobrar', horas_mensuales = '$horas_mensuales', duracion_desde = '$duracion_desde', duracion_hasta = '$duracion_hasta', dia1 = '$dia1', hora_desde = '$hora_desde', hora_hasta = '$hora_hasta', dia2 = '$dia2', hora_desde2 = '$hora_desde2',  hora_hasta2 = '$hora_hasta2', descripcion = '$descripcion', publicidad_desde = '$publicidad_desde',  publicidad_hasta = '$publicidad_hasta', num_resolucion = '$num_resolucion', fecha_resolucion = '$fecha_resolucion',  fecha_impresion = '$fecha_impresion' WHERE id_cursos = '$id_cursos' ";

//echo 'Curso SQL:'.$curso;

	$msg="Archivo guardado";
	$error=0;

	if (!pg_query($conn, $curso)) 
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
		
if ($error==1)
		{
		echo '<script language="JavaScript"> 
			alert("Los datos no se guardaron correctamente. Pongase en contacto con el administrador");</script>';
		}else
		{
		echo '<script language="JavaScript"> 
			alert("Los datos se guardaron correctamente.");</script>';
			
		echo '<script language="JavaScript"> 
		location ="modifrcurso.php";
		</script>';
		}

?>
<?php
	include_once "conexionCursosExtension.php";
	$tip2 = pg_query($conn , "SELECT COUNT(nombre) as contar FROM cursos where nombre='".$_POST['nombre_curso']."';");
	$row2 = pg_fetch_array($tip2);
if ($row2["contar"]==0){
	$msg="";
	$tipo="oid";

	$type_programa = $_FILES["programa_curso"]["type"];
	$tmp_name_programa = $_FILES["programa_curso"]["tmp_name"];
	$size_programa = $_FILES["programa_curso"]["size"];
	$nombre_programa = basename($_FILES["programa_curso"]["name"]);
 	if($tmp_name_programa!=""){
 			include_once "noticiascurso/sitedefs.php";

			# Conexión a la base de datos
			$link = pg_connect("host=$dbhost user=$dbuser password=$dbpwd dbname=$dbname") or die(pg_last_error($link));

			# Contenido del archivo
	  		$fp = fopen($tmp_name_programa, "rb");
  			$buffer = fread($fp, filesize($tmp_name_programa));
			fclose($fp);

			$isoid=$tipo=='oid'?true:false;

			# Inicia una transacción
			pg_query($link, "begin");
			# Crea un objeto blob y retorna el oid
			$oid=pg_lo_create($link);
			$tip29 = pg_query($link,"SELECT MAX(id_imagen) FROM imagen");
	    	$row29 = pg_fetch_array($tip29);
	    	$id_prog=$row29["max"];
	    	$id_programa=$id_prog + 1;
			$sql = "INSERT INTO imagen(id_imagen,nombre,  img_archivo_oid, mime, size)
							VALUES ('$id_programa','$nombre_programa', '$oid', '$type_programa', '$size_programa')";

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
					# Compromete la transacción
					pg_query($link, "commit");
					}

	}else{
		 	$id_programa=NULL;
		}

	$type_planificacion = $_FILES["planificacion"]["type"];
	$tmp_name_planificacion = $_FILES["planificacion"]["tmp_name"];
	$size_planificacion = $_FILES["planificacion"]["size"];
	$nombre_planificacion = basename($_FILES["planificacion"]["name"]);
 	if($tmp_name_planificacion!=""){
 			include_once "noticiascurso/sitedefs.php";

			# Conexión a la base de datos
			$link = pg_connect("host=$dbhost user=$dbuser password=$dbpwd dbname=$dbname") or die(pg_last_error($link));

			# Contenido del archivo
	  		$fp = fopen($tmp_name_planificacion, "rb");
  			$buffer = fread($fp, filesize($tmp_name_planificacion));
			fclose($fp);

			$isoid=$tipo=='oid'?true:false;

			# Inicia una transacción
			pg_query($link, "begin");
			# Crea un objeto blob y retorna el oid
			$oid=pg_lo_create($link);
			$tip29 = pg_query($link,"SELECT MAX(id_imagen) FROM imagen");
	    	$row29 = pg_fetch_array($tip29);
	    	$id_pla=$row29["max"];
	    	$id_planificacion=$id_pla + 1;
			$sql = "INSERT INTO imagen(id_imagen, nombre,  img_archivo_oid, mime, size)
							VALUES ('$id_planificacion', '$nombre_planificacion', '$oid', '$type_planificacion', '$size_planificacion')";


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
					# Compromete la transacción
					pg_query($link, "commit");
					}

	}else{
		 	$id_planificacion=NULL;
		}

		$type_curriculum = $_FILES["curriculum"]["type"];
	$tmp_name_curriculum = $_FILES["curriculum"]["tmp_name"];
	$size_curriculum = $_FILES["curriculum"]["size"];
	$nombre_curriculum = basename($_FILES["curriculum"]["name"]);
 	if($tmp_name_curriculum!=""){
 			include_once "noticiascurso/sitedefs.php";

			# Conexión a la base de datos
			$link = pg_connect("host=$dbhost user=$dbuser password=$dbpwd dbname=$dbname") or die(pg_last_error($link));

			# Contenido del archivo
	  		$fp = fopen($tmp_name_curriculum, "rb");
  			$buffer = fread($fp, filesize($tmp_name_curriculum));
			fclose($fp);

			$isoid=$tipo=='oid'?true:false;

			# Inicia una transacción
			pg_query($link, "begin");
			# Crea un objeto blob y retorna el oid
			$oid=pg_lo_create($link);
			$tip29 = pg_query($link,"SELECT MAX(id_imagen) FROM imagen");
	    	$row29 = pg_fetch_array($tip29);
	    	$id_curr=$row29["max"];
	    	$id_curriculum=$id_curr + 1;
			$sql = "INSERT INTO imagen(id_imagen, nombre,  img_archivo_oid, mime, size)
							VALUES ('$id_curriculum','$nombre_curriculum', '$oid', '$type_curriculum', '$size_curriculum')";


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
					# Compromete la transacción
					pg_query($link, "commit");
					}


	}else{
		 	$id_curriculum=NULL;
		}

// $type_publicidad = $_FILES["imagen_publicidad"]["type"];
// $tmp_name_publicidad = $_FILES["imagen_publicidad"]["tmp_name"];
// $size_publicidad = $_FILES["imagen_publicidad"]["size"];
// $nombre_publicidad = basename($_FILES["imagen_publicidad"]["name"]);
	 // if($tmp_name_publicidad!=""){
		// # Contenido del archivo
 // include_once "noticiascurso/sitedefs.php";

	// # Conexión a la base de datos
		// $link = pg_connect("host=$dbhost user=$dbuser password=$dbpwd dbname=$dbname") or die(pg_last_error($link));

			     // # Contenido del archivo
	  			// $fp = fopen($tmp_name_publicidad, "rb");
  				// $buffer = fread($fp, filesize($tmp_name_publicidad));
				// fclose($fp);

				// $isoid=$tipo=='oid'?true:false;


					// pg_query($link, "begin");
				// # Crea un objeto blob y retorna el oid
				// $oid=pg_lo_create($link);

			// $tip29 = pg_query($link,"SELECT MAX(id_imagen) FROM imagen");
			// $row29 = pg_fetch_array($tip29);
			// $id_ima=$row29["max"];
			// $id_imagen2=$id_ima + 1;

				// $sql = "INSERT INTO imagen(id_imagen, nombre,  img_archivo_oid, mime, size)
							// VALUES ('$id_imagen2','$nombre_publicidad', '$oid', '$type_publicidad', '$size_publicidad')";


				// # Ejecuta la sentencia SQL
				// pg_query($link, $sql) or die(pg_last_error($link));
				// if($isoid)
					// {
					// # Abre el objeto blob
					// $blob=pg_lo_open($link,$oid,"w");
					// # Escribe el contenido del archivo
					// pg_lo_write($blob,$buffer);
					// # Cierra el objeto
					// pg_lo_close($blob);
					// # Compromete la transacción
					// pg_query($link, "commit");
					// }

		// }else{		 	$id_imagen2=NULL;
		// }

		include_once "conexionCursosExtension.php";

$tipCurso = pg_query($link,"SELECT MAX(id_cursos) FROM cursos");
$rowCurso = pg_fetch_array($tipCurso);
$id_cur=$rowCurso["max"];
$id_curso=$id_cur + 1;

$nombre = $_POST["nombre_curso"];
$fk_tipo = $_POST["tipo_curso"];
$anio = $_POST["anio"];
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

//Trae el periodo del curso
$periodoCurso = $_REQUEST['periodo_curso'];
if($periodoCurso == 0){
	$periodoCurso = 4;
}


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
$descripcion = "-";
$publicidad_desde = "-";
$publicidad_hasta = "-";
$num_resolucion = "";
$fecha_resolucion = "";
$fecha_impresion = "";
$fk_imagen = "";



$curso="INSERT INTO cursos(id_cursos, nombre, fk_tipo, anio, monto, monto_antes_venc, dia_venc, cantcuota, docente, forma_cobro_docente, valor_a_cobrar, horas_mensuales, fk_programa, fk_planificacion, fk_curriculum, duracion_desde, duracion_hasta, dia1, hora_desde, hora_hasta, dia2, hora_desde2, hora_hasta2, descripcion, publicidad_desde, publicidad_hasta, num_resolucion, fecha_resolucion, fecha_impresion,duracion_cursos)
VALUES ('$id_curso','$nombre','$fk_tipo','$anio','$monto','$monto_antes_venc','$dia_venc','$cantcuota','$docente','$forma_cobro_docente','$valor_a_cobrar','$horas_mensuales','$id_programa','$id_planificacion','$id_curriculum','$duracion_desde','$duracion_hasta','$dia1','$hora_desde','$hora_hasta','$dia2','$hora_desde2','$hora_hasta2','$descripcion','$publicidad_desde','$publicidad_hasta','$num_resolucion','$fecha_resolucion','$fecha_impresion','$periodoCurso')";
//echo $curso;
//echo 'montoVenc: '.$montoAntesVenc;
//echo '$diaVenc: '.$diaVenc;
//echo "INSERT INTO cursos ( id_cursos,nombre, duracion_desde, duracion_hasta, hora_desde, hora_hasta, docente, descripcion, fk_tipo, anio, publicidad_desde, publicidad_hasta, fk_publicidad, fk_programa,hora_desde2, hora_hasta2,dia1,dia2,monto,cantcuota,publicar,fk_planificacion, fk_curriculum,monto_antes_venc,dia_venc)
//VALUES ('$id_curso','$nombre','$fechad','$fechah','$horad','$horah','$docente','$descripcion',$tipo,'$anio','$mesd','$mesh',$id_imagen2,$id_programa,'$horad2','$horah2','$dia1','$dia2','$monto','$cantcuota','$publica', $id_planificacion, $id_curriculum,'$montoAntesVenc','$diaVenc')";
//pg_query($conn, $curso) or die(pg_last_error($conn));
//		$msg="Archivo guardado";
	$error=0;

	if (!pg_query($conn, $curso))
	 {
     $error=1;
	 $termino = "ROLLBACK";
	 }
     else
     {
     $termino = "COMMIT";
     }
   pg_query($termino);

if ($error==1)

		{
		echo '<script language="JavaScript"> 			alert("Los datos no se guardaron correctamente. Pongase en contacto con el administrador");</script>';
		}else
		{
		echo '<script language="JavaScript">
			alert("Los datos se guardaron correctamente.");</script>';

		echo '<script language="JavaScript">
		location ="noticiacursosnuevos.php";
		</script>';
		}

}
  else
  {
  echo '<script language="JavaScript">
		alert("El curso ya existe.");

		</script>';
}
?>
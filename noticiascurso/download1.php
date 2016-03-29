<?php 
	/* # Recupera el id pasado como parámetro
	$id=isset($_REQUEST['id'])?$_REQUEST['id']:0;
	include_once "sitedefs.php";
	# Conexión a la base de datos
	$link = pg_connect("host=$dbhost user=$dbuser password=$dbpwd dbname=$dbname") or die(pg_last_error($link));
	# Recupera el archivo en base al ID
	$sql = "select ima_id, ima_nombre,  ima_mime, ima_size, coalesce(ima_archivo_oid,-1) as ima_archivo_oid
	 from imagen where ima_id=$id";
	$result=pg_query($link, $sql);
	# Si no existe, redirecciona a la página principal
	if(!$result || pg_num_rows($result)<1){
		header("Location: index.php");
		exit();
	}
	# Recupera los atributos del archivo
	$row=pg_fetch_array($result,0);
	pg_free_result($result);
	# Para determinar si archivo a bajar fue ingresado al campo archivo_oid (es de tipo "oid")
	
	if($row['ima_archivo_oid']==-1) $isoid=true;
	
		# Inicia la transacción
		pg_query($link, "begin");
		# Abre el objeto blob
		$file=pg_lo_open($link, $row['ima_archivo_oid'], "r");
	
		# Imprime el contenido del objeto blob
		pg_lo_read_all($file);
		# Cierra el objeto
		pg_lo_close($file);
		# Compromete la transacción
		pg_query($link, "commit");
		/*}
	else{
		# Imprime el contenido del archivo
		print $file;
		}
	pg_close($link); */
	
	# El parÃ¡metro f=1 indica que se va a forzar a bajar el archivo
	$f=isset($_REQUEST['f'])?$_REQUEST['f']:0;
	# Recupera el id pasado como parÃ¡metro
	$id=isset($_REQUEST['idfoto'])?$_REQUEST['idfoto']:0;
	$id=$idfoto;
	include_once "sitedefs.php";
	# ConexiÃ³n a la base de datos
	$link = pg_connect("host=$dbhost user=$dbuser password=$dbpwd dbname=$dbname") or die(pg_last_error($link));

	# Recupera el archivo en base al ID
	$sql = "select id_imagen, nombre,  mime, size, coalesce(img_archivo_oid,-1) as img_archivo_oid	 from imagen where id_imagen=$id";
	 
	
	$result=pg_query($link, $sql);
	# Si no existe, redirecciona a la pÃ¡gina principal
	if(!$result || pg_num_rows($result)<1){
		header("Location: index.php");
		exit();
	}
	# Recupera los atributos del archivo
	$row=pg_fetch_array($result,0);
	pg_free_result($result);
	# Para determinar si archivo a bajar fue ingresado al campo archivo_oid (es de tipo "oid")
	$isoid=true;
	if($row['img_archivo_oid']==-1) $isoid=true;
	if($isoid){

		# Inicia la transacciÃ³n
		pg_query($link, "begin");
		# Abre el objeto blob
		$file=pg_lo_open($link, $row['img_archivo_oid'], "r");
	}
	# EnvÃ­o de cabeceras
	 header("Cache-control: private");
	header("Content-type: $row[mime]");
	if($f==1)
		header("Content-Disposition: attachment; filename=$row[nombre]");
	header("Content-length: $row[size]");
	header("Expires: ".gmdate("D, d M Y H:i:s", mktime(date("H")+2, date("i"), date("s"), date("m"), date("d"), date("Y")))." GMT");
	header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache"); 

	if($isoid){
		# Imprime el contenido del objeto blob
		pg_lo_read_all($file);
		# Cierra el objeto
		pg_lo_close($file);
		# Compromete la transacciÃ³n
		pg_query($link, "commit");
	}
	else{
		# Imprime el contenido del archivo
		//print $file;
	/* 	$img2 = imagecreatefromjpeg($file);

// Obtenemos la mitad del tamaño de la imagen 
$w1 = intval(imagesx($img2)/2);
$h1 = intval(imagesy($img2)/2);

// Creamos una segunda imagen de la mitad de
// tamaño que el archivo jpeg 
$img1 = imagecreatetruecolor($w1,$h1);

// Escalamos la imagen jpeg sobre la imagen nueva 
imagecopyresized($img1,$img2,0,0,0,0,$w1,$h1,300,225);

// Damos salida a la imagen final 
imagejpeg($img1); */
	}
	pg_close($link);	
?>	
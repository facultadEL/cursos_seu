<?php
include "conexionCursosExtension.php";
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$codigo = $_POST['codigo'];
$telefono = $_POST['telefono'];
$mail = $_POST['mail'];
$direccion = $_POST['direccion'];
$numero = $_POST['numero'];
$descripcion = $_POST['descripcion'];
$tip2 = pg_query($conn , "SELECT COUNT(id_interesado) as contar FROM  interesado where interesado.mail='".$_POST['mail']."';");
	$row2 = pg_fetch_array($tip2);
//if ($row2["contar"]==0){	
    $tip29 = pg_query($conn,"SELECT MAX(id_interesado) FROM interesado;");
	$row29 = pg_fetch_array($tip29);
	$intmax=$row29["max"];
	$id_int=$intmax+1 ;
	$sql = "BEGIN TRANSACTION";
   	$result = pg_query($conn,$sql) or die("Error en el query: $query. " . pg_last_error($conn)); 	
	
//INGRESO LA TABLA "ingresante"		

	$insert="INSERT INTO interesado(id_interesado, nombre, apellido, telefono, mail, direccion, numero, anio,descripcion)
VALUES  ('$id_int','$nombre','$apellido','$codigo$telefono','$mail','$direccion',$numero,".date(Y).",'$descripcion');";
	
	//echo $insert;
	$datos=$insert;
	$res=pg_query($conn,$datos);
	
			//$result2 = pg_query($conn,$inspar);
		//controlo que todo haya sido guardado correctamente	
//}

foreach($_POST['tipocur'] as $v){
//	$tip56 = pg_query($conn , "SELECT COUNT(interesado.id) as contar FROM interesadoxcurso, interesado where interesado.mail='".$_POST['mail']."' and fk_tipocurso=$v and fk_interesado=interesado.id;");
//	$row56 = pg_fetch_array($tip56);
	//if ($row56["contar"]==0){	
	//	$tip = pg_query($conn,"SELECT id from interesado where interesado.mail='".$_POST['mail']."';");
		
		//while($row = pg_fetch_array($tip)){
			
		 		$id=$id_int;//$row["id"];
				$insert2="INSERT INTO interesadoxcurso(fk_interesado,fk_curso) VALUES ('$id','$v');";
				echo $insert2;
				$datos2=$insert2;
				$res2=pg_query($conn,$datos2);
//		 }	
//	}
}
$error=0;
	if (!$res & !res2){
     	$errorpg = pg_last_error($conn);
     	$termino = "ROLLBACK";
     	$error=1;
	}
    else{
     	$termino = "COMMIT";
    }
pg_query($termino);
if ($error==1){
	echo '<script language="JavaScript"> 
		alert("Los datos no se guardaron correctamente. Pongase en contacto con el administrador");</script>';
}
else{
	echo '<script language="JavaScript"> 
		alert("Los datos se guardaron correctamente.");</script>';
}
echo '<script language="JavaScript"> 	location ="inscripcion.php"	</script>';
?>
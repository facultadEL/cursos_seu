<?php
include "conexionCursosExtension.php";	

	$sql = "BEGIN TRANSACTION";
   	$result = pg_query($conn,$sql) or die("Error en el query: $query. " . pg_last_error($conn)); 	
	
//INGRESO LA TABLA "ingresante"		

	$cursoF = $_POST['cursoF'];

	$insert="UPDATE inscripto SET nombre='".$_POST['nombre']."',apellido='".$_POST['apellido']."', fk_tipodoc='".$_POST['tipodoc']."', dni='".$_POST['numdoc']."' ,direccion='".$_POST['direccion']."', numero='".$_POST['numero']."', localidad='".$_POST['localidad']."', mail='".$_POST['mail']."', telfijo='".$_POST['telfijo']."', telcel='".$_POST['telcel']."' WHERE id_inscripto=".$_POST['id'].";UPDATE inscriptosxcurso SET fk_curso='".$_POST['curso']."', motivodescuento='".$_POST['motivodescuento']."'	WHERE fk_inscriptos=".$_POST['id']." AND fk_curso=".$cursoF.";";
	


$datos=$insert;
	echo $datos;
	$res=pg_query($conn,$datos);
		
		//$result2 = pg_query($conn,$inspar);
		//controlo que todo haya sido guardado correctamente
	$error=0;
	if (!$res) 
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
	}

echo '<script language="JavaScript"> 
		location ="listadoinscriptos.php";
		</script>';

?>
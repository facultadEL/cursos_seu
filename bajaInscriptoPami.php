<?php

include "conexionCursosExtension.php";	
$idPami = $_REQUEST['idPami'];
$cursoF = $_REQUEST['cursoF'];

//echo $idPami.'-'.$cursoF;

$sqlBaja = "UPDATE inscriptosxcurso SET fk_curso=121 WHERE fk_inscriptos=$idPami AND fk_curso=$cursoF;";
//echo $sqlBaja;
$error=0;

if(!pg_query($sqlBaja)){
	$error = 1;
	$termino = "ROLLBACK";
}else{
	$termino = "COMMIT";
}
pg_query($termino);

if($error==0){
	echo '<script type="text/javascript"> alert("El inscripto ha sido dado de baja correctamente")
		location.href="listadoPami.php?cursoF='.$cursoF.'";
		</script>';
}else{
	echo '<script type="text/javascript"> alert("El inscripto no ha podido ser dado de baja. Contactese con su administrador")
		location.href="listadoPami.php?cursoF='.$cursoF.'";
		</script>';
}

?>
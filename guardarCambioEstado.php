<?php

include_once "conexionCursosExtension.php";

$cursoF = $_REQUEST['dato'];
//echo $cursoF;

$checkbox = $_REQUEST['checkTodos'];
//echo $checkbox;

$consultaAlumnos = pg_query("SELECT * FROM inscriptosxcurso FULL OUTER JOIN inscripto ON(inscriptosxcurso.fk_inscriptos = inscripto.id_inscripto) FULL OUTER JOIN estadoinscripto ON(inscriptosxcurso.estadoinscripto_ixc = estadoinscripto.id_estadoinscripto) WHERE fk_curso=$cursoF;");
$consultaCambio = "";

if($checkbox == "on"){
	//echo "CheckboxActivado";
	$variableTodos = $_REQUEST['cambiarTodos'];
	//echo $variableTodos;
	
	while($rowCambioEstado = pg_fetch_array($consultaAlumnos)){
		$idAlumnoCambiar = $rowCambioEstado['id_inscriptosxcurso'];
		$consultaCambio = $consultaCambio."UPDATE inscriptosxcurso SET estadoinscripto_ixc=$variableTodos WHERE id_inscriptosxcurso=$idAlumnoCambiar;";
	}
}else{
	while($rowCambioEstado = pg_fetch_array($consultaAlumnos)){
	
	$idAlumnoCambiar = $rowCambioEstado['id_inscriptosxcurso'];
	$variableUsar = "cambioEstado".$rowCambioEstado['id_inscripto'];
	//echo $variableUsar;
	$datoCambio = $_REQUEST[$variableUsar];
	//echo $datoCambio;
		$consultaCambio = $consultaCambio."UPDATE inscriptosxcurso SET estadoinscripto_ixc=$datoCambio WHERE id_inscriptosxcurso=$idAlumnoCambiar;";
	}
}

//echo $consultaCambio;
//echo '<br>';

$error=0;

if(!pg_query($consultaCambio)){
	$error=1;
	$termino = "ROLLBACK";
}else{
	$termino = "COMMIT";
}
pg_query($termino);

if ($error==1){
	echo '<script language="JavaScript"> 			alert("Los datos no se guardaron correctamente. Pongase en contacto con el administrador");</script>';
}else{
	echo '<script language="JavaScript">alert("Los datos se guardaron correctamente.");</script>';

	echo '<script language="JavaScript">
		location ="cambiarEstado.php?dato='.$cursoF.'";
		</script>';
		}


?>
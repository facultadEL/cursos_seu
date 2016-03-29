<?php
include "conexionCursosExtension.php";	
$variableControl = $_REQUEST['variableControl'];

if($variableControl == 1){
	$idInscripto = $_REQUEST['idInscripto'];
	$sqlNuevoInscripto = "";
}else{
	$sqlMaxId = pg_query("SELECT max(id_inscripto) FROM inscripto");
	$rowMaxId = pg_fetch_array($sqlMaxId);
	$idInscripto = $rowMaxId['max'] + 1;
	$nombreInscripto = $_REQUEST['nombreInscripto'];
	$apellidoInscripto = $_REQUEST['apellidoInscripto'];
	$tipoDocumentoInscripto = $_REQUEST['tipoDocumentoInscripto'];
	$numdocInscripto = $_REQUEST['numdocInscripto'];
	$direccionInscripto = $_REQUEST['direccionInscripto'];
	$numeroDirInscripto = $_REQUEST['numeroInscripto'];
	$localidadInscripto = $_REQUEST['localidadInscripto'];
	$mailInscripto = $_REQUEST['mailInscripto'];
	$telFijoInscripto = $_REQUEST['telfijoInscripto'];
	$telCelInscripto = $_REQUEST['telcelInscripto'];
	$fechaInscripcion = date("Y").'-'.date("m").'-'.date("d");
	$sqlNuevoInscripto = "INSERT INTO inscripto(id_inscripto,nombre,apellido,fk_tipodoc,dni,direccion,numero,localidad,mail,telfijo,telcel,fechainscripto) VALUES('$idInscripto','$nombreInscripto','$apellidoInscripto','$tipoDocumentoInscripto','$numdocInscripto','$direccionInscripto','$numeroDirInscripto','$localidadInscripto','$mailInscripto','$telFijoInscripto','$telCelInscripto','$fechaInscripcion');";	

}

//Datos Extras
$fechaNac = $_REQUEST['anioInscripto'].'-'.$_REQUEST['mesInscripto'].'-'.$_REQUEST['diaInscripto'];
if($_REQUEST['checkVisualInscripto'] == 'on'){
	$checkVisualInscripto = 1;
	$visualInscripto = "'".$_REQUEST['visualInscripto']."'";
}else{
	$checkVisualInscripto = 0;
	$visualInscripto = 'NULL';
}
if($_REQUEST['checkAuditivaInscripto'] == 'on'){
	$checkAuditivaInscripto = 1;
	$auditivaInscripto = "'".$_REQUEST['auditivaInscripto']."'";
}else{
	$checkAuditivaInscripto = 0;
	$auditivaInscripto = 'NULL';
}
if($_REQUEST['checkMotoraInscripto'] == 'on'){
	$checkMotoraInscripto = 1;
	$motoraInscripto = "'".$_REQUEST['motoraInscripto']."'";
}else{
	$checkMotoraInscripto = 0;
	$motoraInscripto = 'NULL';
}
if($_REQUEST['checkOtraInscripto'] == 'on'){
	$checkOtraInscripto = 1;
	$otraInscripto = "'".$_REQUEST['otraInscripto']."'";
}else{
	$checkOtraInscripto = 0;
	$otraInscripto = 'NULL';
}

if($_REQUEST['otroCurso']==1){
	$sep = '/--/';
	$boolOtrosCursos = $_REQUEST['otroCurso'];
	$cuantosOtrosCursos = $_REQUEST['cuantosCursos'];
	$otrosCursos = "'".$_REQUEST['cursoCuales1'].$sep.$_REQUEST['cursoCuales2'].$sep.$_REQUEST['cursoCuales3'].$sep.$_REQUEST['cursoCuales4']."'";		
}else{
	$cuantosOtrosCursos = 0;
	$otrosCursos = 'NULL';
	$boolOtrosCursos = 0;
}

//Control para que no se registre dos veces los datos extra para un inscripto
$sqlCantDatosExtra = pg_query('SELECT count(id_datosextra) AS "contar" FROM datosextra WHERE inscripto_datosextra='.$idInscripto.';');
$rowCantDatosExtra = pg_fetch_array($sqlCantDatosExtra);
if($rowCantDatosExtra['contar'] == 0){
$sqlMaxId = pg_query("SELECT max(id_datosextra) FROM datosextra");
$rowMaxId = pg_fetch_array($sqlMaxId);
$idDatosExtras = $rowMaxId['max'] + 1;
$sqlDatosExtras = "INSERT INTO datosextra(id_datosextra,boolvisual_datosextra,txtvisual_datosextra,boolauditiva_datosextra,txtauditiva_datosextra,boolmotora_datosextra,txtmotora_datosextra,boolotra_datosextra,txtotra_datosextra,boolotroscursos_datosextra,cuantosotroscursos_datosextra,txtotroscursos_datosextra,inscripto_datosextra,fechanac_datosextra) VALUES('$idDatosExtras','$checkVisualInscripto',$visualInscripto,'$checkAuditivaInscripto',$auditivaInscripto,'$checkMotoraInscripto',$motoraInscripto,'$checkOtraInscripto',$otraInscripto,'$boolOtrosCursos','$cuantosOtrosCursos',$otrosCursos,'$idInscripto','$fechaNac');";
}else{
$sqlIdDatosExtra = pg_query("SELECT id_datosextra FROM datosextra WHERE inscripto_datosextra=$idInscripto");
$rowIdDatosExtra = pg_fetch_array($sqlIdDatosExtra);
$idDatosExtra = $rowIdDatosExtra['id_datosextra'];
$sqlDatosExtras = "UPDATE datosextra SET boolvisual_datosextra = '$checkVisualInscripto',txtvisual_datosextra = $visualInscripto,boolauditiva_datosextra = '$checkAuditivaInscripto',txtauditiva_datosextra = $auditivaInscripto,boolmotora_datosextra = '$checkMotoraInscripto',txtmotora_datosextra = $motoraInscripto,boolotra_datosextra = '$checkOtraInscripto',txtotra_datosextra = $otraInscripto,boolotroscursos_datosextra = '$boolOtrosCursos',cuantosotroscursos_datosextra = '$cuantosOtrosCursos',txtotroscursos_datosextra = $otrosCursos,fechanac_datosextra = '$fechaNac' WHERE inscripto_datosextra='$idDatosExtra' ;";
}

$idCurso = $_REQUEST['idCurso'];


$consultaInscriptoEnCurso = pg_query('SELECT COUNT(id_inscriptosxcurso) as "contar" FROM inscriptosxcurso inner join inscripto on(inscriptosxcurso.fk_inscriptos = inscripto.id_inscripto) inner join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where inscripto.id_inscripto='.$idInscripto.' AND fk_curso='.$idCurso.';');
$rowInscriptoEnCurso = pg_fetch_array($consultaInscriptoEnCurso);
	
if ($rowInscriptoEnCurso["contar"]==0){	
	//Registro inscripto por curso
	$sqlMaxId = pg_query("SELECT max(id_inscriptosxcurso) FROM inscriptosxcurso;");
	$rowMaxId = pg_fetch_array($sqlMaxId);
	$idInscriptoxCurso = $rowMaxId['max'] + 1;
		
	$porcentajeDesc = 0;
	$motivoDesc = "Curso PAMI";
	$sqlIXC = "INSERT INTO inscriptosxcurso(id_inscriptosxcurso,fk_inscriptos,fk_curso,porcdescuento,motivodescuento,estadoinscripto_ixc) VALUES('$idInscriptoxCurso','$idInscripto','$idCurso','$porcentajeDesc','$motivoDesc',1)";	
	
	
	$sqlGuardar = $sqlNuevoInscripto.$sqlDatosExtras.$sqlIXC;
	//echo $sqlGuardar;
	
	$error = 0;
	if(!pg_query($sqlGuardar)){
		$error = 1;
		$termino = "ROLLBACK";
	}else{
		$termino = "COMMIT";
	}
	pg_query($termino);
	
	if($error==0){
		echo '<script type="text/javascript">alert("Los datos se guardaron correctamente")
		location.href="imprimircertinscripto.php?inscriptosxcurso='.$idInscriptoxCurso.'";
		</script>';
	}else{
		echo '<script type="text/javascript">alert("Los datos no se guardaron correctamente")
		location.href="corroborarPami.php";
		</script>';
	}
	
}else{
	echo '<script type="text/javaScript">alert("El inscripto ya pertenece a este curso.")
		location.href="corroborarPami.php";
		</script>';
}
	
?>

		
		
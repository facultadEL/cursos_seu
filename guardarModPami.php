<?php
include "conexionCursosExtension.php";	

	$idPami = $_REQUEST['idPami'];
	$sqlModPami = "";
	
	$nombrePami = $_REQUEST['nombrePami'];
	$apellidoPami = $_REQUEST['apellidoPami'];
	$tipoDocPami = $_REQUEST['tipoDocPami'];
	$numDocPami = $_REQUEST['numDocPami'];
	$direccionPami = $_REQUEST['direccionPami'];
	$numDirPami = $_REQUEST['numDirPami'];
	$localidadPami = $_REQUEST['localidadPami'];
	$mailPami = $_REQUEST['mailPami'];
	$telFijoPami = $_REQUEST['telFijoPami'];
	$telCelPami = $_REQUEST['telCelPami'];
	//$fechaInscripcion = date("Y").'-'.date("m").'-'.date("d");
	//$sqlNuevoPami = "INSERT INTO inscripto(id_Pami,nombre,apellido,fk_tipodoc,dni,direccion,numero,localidad,mail,telfijo,telcel,fechaPami) VALUES('$idPami','$nombrePami','$apellidoPami','$tipoDocumentoPami','$numdocPami','$direccionPami','$numeroDirPami','$localidadPami','$mailPami','$telFijoPami','$telCelPami','$fechaInscripcion');";	
	$sqlModPami = "UPDATE inscripto SET nombre='$nombrePami',apellido='$apellidoPami',fk_tipodoc='$tipoDocPami',dni='$numDocPami',direccion='$direccionPami',numero='$numDirPami',localidad='$localidadPami',mail='$mailPami',telfijo='$telFijoPami',telcel='$telCelPami' WHERE id_inscripto=$idPami;";

//Datos Extras
$fechaNac = $_REQUEST['anioPami'].'-'.$_REQUEST['mesPami'].'-'.$_REQUEST['diaPami'];
if($fechaNac == '--'){
	$fechaNac = 'NULL';
}else{
	$fechaNac = "'".$fechaNac."'";
}
if($_REQUEST['checkVisualPami'] == 'on'){
	$checkVisualPami = 1;
	$visualPami = "'".$_REQUEST['visualPami']."'";
}else{
	$checkVisualPami = 0;
	$visualPami = 'NULL';
}
if($_REQUEST['checkAuditivaPami'] == 'on'){
	$checkAuditivaPami = 1;
	$auditivaPami = "'".$_REQUEST['auditivaPami']."'";
}else{
	$checkAuditivaPami = 0;
	$auditivaPami = 'NULL';
}
if($_REQUEST['checkMotoraPami'] == 'on'){
	$checkMotoraPami = 1;
	$motoraPami = "'".$_REQUEST['motoraPami']."'";
}else{
	$checkMotoraPami = 0;
	$motoraPami = 'NULL';
}
if($_REQUEST['checkOtraPami'] == 'on'){
	$checkOtraPami = 1;
	$otraPami = "'".$_REQUEST['otraPami']."'";
}else{
	$checkOtraPami = 0;
	$otraPami = 'NULL';
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

//Control para que no se registre dos veces los datos extra para un Pami

$sqlDatosExtras = "UPDATE datosextra SET boolvisual_datosextra = '$checkVisualPami',txtvisual_datosextra = $visualPami,boolauditiva_datosextra = '$checkAuditivaPami',txtauditiva_datosextra = $auditivaPami,boolmotora_datosextra = '$checkMotoraPami',txtmotora_datosextra = $motoraPami,boolotra_datosextra = '$checkOtraPami',txtotra_datosextra = $otraPami,boolotroscursos_datosextra = '$boolOtrosCursos',cuantosotroscursos_datosextra = '$cuantosOtrosCursos',txtotroscursos_datosextra = $otrosCursos,fechanac_datosextra=$fechaNac WHERE inscripto_datosextra='$idPami' ;";


	
	$sqlGuardar = $sqlModPami.$sqlDatosExtras;
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
		location.href="listadoPami.php";
		</script>';
	}else{
		echo '<script type="text/javascript">alert("Los datos no se guardaron correctamente")
		location.href="listadoPami.php";
		</script>';
	}
	
?>
<script type="text/javascript">
alert("Se guardaron correctamente los datos");
//window.location="";
</script>
<?php
$curso = $_REQUEST['curso'];
$nombre = $_REQUEST['nombreInscripto'];
$apellido = $_REQUEST['apellidoInscripto'];
$tipodni = $_REQUEST['tipoDocumento'];
$numdni = $_REQUEST['dniInscripto'];
$calle = $_REQUEST['calleInscripto'];
$numero = $_REQUEST['numCalleInscripto'];
$piso = $_REQUEST['pisoCalle'];
$depto = $_REQUEST['deptoCalle'];
$localidad = $_REQUEST['localidadInscripto'];
$porcentajeDesc = $_REQUEST['descuento'];
$motivoDesc = $_REQUEST['motivo'];
$dia = date("D");
$mes = date("M");
$año = date("Y");
$mail = $_REQUEST['correoInscripto'];
$fechainscripto = $dia.'-'.$mes.'-'.$año;
$caracteristicaCel = $_REQUEST['caracteristicaTelInscripto'];
$caracteristicaFijo = $_REQUEST['caracteristicaFijo'];
$fijo = $_REQUEST['fijo'];
$celular = $_REQUEST['celInscripto'];

$telFijo = $caracteristicaFijo.'-'.$fijo;

$cel = $caracteristicaCel.'-'.$celular;
$variableControl = $_REQUEST['variableControl'];

include 'conexionCursosExtension.php';

if($variableControl==0){
pg_query("INSERT INTO inscripto(nombre, apellido, dni, fk_tipodoc, calle, numero, localidad, telfijo, telcel, mail,fechainscripto)
    VALUES('$nombre','$apellido','$numdni','$tipodni','$calle','$numero','$localidad','$telFijo','$cel','$mail','$fechainscripto')"); 
$idConsulta = pg_query("SELECT * FROM inscripto ORDER BY id_inscripto DESC LIMIT 1");
	while($rowId=pg_fetch_array($idConsulta,NULL,PGSQL_ASSOC)){
		$idInscripto = $rowId['id_inscripto'];
	}
	//Registro inscripto por curso
	pg_query("INSERT INTO inscriptosxcurso(fk_inscripto,fk_curso,porcdescuento,motivodescuento) VALUES('$idInscripto'.'$curso','$porcentajeDesc','$motivoDesc')")
	//Traigo id del ultimo inscripto por curso
	$consultaUltimoId = ("SELECT id_inscriptosxcurso FROM inscriptosxcurso ORDER BY id_inscriptosxcurso DESC LIMIT 1");
	while($rowUltimoId=pg_fetch_array($consultaUltimoId,NULL,PGSQL_ASSOC)){
		$ultimoId = $rowUltimoID['id_inscriptosxcurso'];
	}
	//Se incrementa la cantidad de inscriptos al curso
	$consultaCantInscriptos = pg_query("SELECT cant_inscriptos FROM cursos where id_cursos=$curso");
	$rowCantI=pg_fetch_array($consultaCantInscriptos,NULL,PGSQL_ASSOC);
		$cant_inscriptos = $rowCantI['cant_inscriptos'];
	
	$cant_inscriptos = $cant_inscriptos + 1;
	pg_query("UPDATE cursos SET cant_inscriptos = $cant_inscriptos WHERE id_cursos=$curso");

	//Traigo datos del curso
	$consultaCurso = pg_query("SELECT * FROM cursos where id_cursos=$curso");
	while($rowCurso=pg_fetch_array($consultaCurso,NULL,PGSQL_ASSOC)){
		$cantCoutas = $rowCurso['cantcuota'];
		$montoCuota = $rowCurso['monto'];
	}
	//Sacar porcentaje por cuotas
	$porcentaje = ($porcentajeDesc * $montoCuota)/100;
	//Calcula valor de cuota
	$cuota = $montoCuota - $porcentaje;
	//Registro los pagos de cuotas
	for($i=1;$i<=$cantCuotas;$i++){
		//estado = FALSE - NO PAGADO
		pg_query("INSERT INTO pagocuotas(nrocuota,fk_inscriptosxcurso,estado,montoxcuota) VALUES('$i','$ultimoId',FALSE,'$cuota')");
	}
}else{
	$idConsulta = pg_query("SELECT * FROM inscripto WHERE dni=$numdni");
	while($rowId=pg_fetch_array($idConsulta,NULL,PGSQL_ASSOC)){
		$idInscripto = $rowId['id_inscripto'];
	}
	pg_query("UPDATE inscripto SET nombre=$nombre,apellido=$apellido,dni=$numdni,fk_tipodoc=$tipodni,calle=$calle,numero=$numero,localidad=$localidad,telfijo=$telFijo,telcel=$cel,mail=$mail WHERE id_inscripto=$idInscripto");
	//Registro inscripto por curso
	pg_query("INSERT INTO inscriptosxcurso(fk_inscripto,fk_curso,porcdescuento,motivodescuento) VALUES('$idInscripto'.'$curso','$porcentajeDesc','$motivoDesc')")
	
	$consultaCantInscriptos = pg_query("SELECT cant_inscriptos FROM cursos where id_cursos=$curso");
	$rowCantI=pg_fetch_array($consultaCantInscriptos,NULL,PGSQL_ASSOC);
		$cant_inscriptos = $rowCantI['cant_inscriptos'];
	
	$cant_inscriptos = $cant_inscriptos + 1;
	pg_query("UPDATE cursos SET cant_inscriptos = $cant_inscriptos WHERE id_cursos=$curso");

	//Traigo id del ultimo inscripto por curso
	$consultaUltimoId = ("SELECT id_inscriptosxcurso FROM inscriptosxcurso ORDER BY id_inscriptosxcurso DESC LIMIT 1");
	while($rowUltimoId=pg_fetch_array($consultaUltimoId,NULL,PGSQL_ASSOC)){
		$ultimoId = $rowUltimoID['id_inscriptosxcurso'];
	}
	//Traigo datos del curso
	$consultaCurso = pg_query("SELECT * FROM cursos where id_cursos=$curso");
	while($rowCurso=pg_fetch_array($consultaCurso,NULL,PGSQL_ASSOC)){
		$cantCoutas = $rowCurso['cantcuota'];
		$montoCuota = $rowCurso['monto'];
	}
	//Sacar porcentaje por cuotas
	$porcentaje = ($porcentajeDesc * $montoCuota)/100;
	//Calcula valor de cuota
	$cuota = $montoCuota - $porcentaje;
	//Registro los pagos de cuotas
	for($i=1;$i<=$cantCuotas;$i++){
		//estado = FALSE - NO PAGADO
		pg_query("INSERT INTO pagocuotas(nrocuota,fk_inscriptosxcurso,estado,montoxcuota) VALUES('$i','$ultimoId',FALSE,'$cuota')");
	}
	
}

?>

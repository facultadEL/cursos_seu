<?php

//include_once "conexionpg.php";
//$conn = pg_connect("host=localhost port=5432 user=postgres password=postgres dbname=cursosweb") or die("Error de conexion.".pg_last_error());//conexion local
$conn = pg_connect("host=190.114.198.126 port=5432 user=extension password=newgenius dbname=cursosweb") or die("Error de conexion.".pg_last_error()); //conexion facu

//$htmlProvincias = '<option value="0">Seleccione la ciudad</option>';

$dniAlumno = $_POST['dniAlumno'];

//$sql = traerSql('*', 'localidad', 'fk_provincia='.$idProvincia);
//$sql = pg_query("SELECT id_inscriptosxcurso FROM inscripto INNER JOIN inscriptosxcurso ON inscripto.id_inscripto = inscriptosxcurso.fk_inscriptos WHERE dni LIKE UPPER({$dniAlumno})");
$sql = pg_query("SELECT id_inscripto FROM inscripto WHERE dni = '$dniAlumno'");
$idAlumno = 0;
while($rowID = pg_fetch_array($sql)){
	$id = $rowID['id_inscripto'];
	if (!empty($id)) {
		$idAlumno = $id;
	}
}
pg_close($conn);

//Con el echo devuelvo el dato al otro archivo
echo $idAlumno;
?>
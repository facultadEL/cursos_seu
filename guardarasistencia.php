<?
include_once "conexionCursosExtension.php";										 		
                $tip1 = pg_query($conn,"select inscriptosxcurso.id_inscriptosxcurso, cursos.anio, inscripto.nombre, inscripto.apellido, cursos.nombre as curso from inscriptosxcurso full outer join inscripto on(inscriptosxcurso.fk_inscriptos = inscripto.id_inscripto) full outer join cursos on(cursos.id_cursos = inscriptosxcurso.fk_curso) where fk_curso='".$_REQUEST["curso"]."' order by inscripto.apellido;");
				
				$sql = "BEGIN TRANSACTION";
  	$result = pg_query($conn,$sql) or die("Error en el query: $query. " . pg_last_error($conn)); 	

				$cont=0;
				$cantidad=0;
				$insert = "";
				$maximo = pg_query("select MAX(id_asistencia) FROM asistencia");
				$row2 = pg_fetch_array($maximo);
				$idmaximo = $row2["max"];
                while($row1 = pg_fetch_array($tip1)){
					$idmaximo = $idmaximo + 1;
				
//INGRESO LA TABLA "ingresante"	


					if($_POST[$row1["id_inscriptosxcurso"]]=="on"){
						$asist=1;
					}else{
						$asist=0;
					}

	$insert=$insert."INSERT INTO asistencia(id_asistencia,fecha, asistencia,fk_alumno)
 VALUES  ('".$idmaximo."','".date("Y/m/d")."','".$asist."','".$row1["id_inscriptosxcurso"]."');";
				}

$datos=$insert;

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
			echo $datos;
		}else
		{
		echo '<script language="JavaScript"> 
			alert("Los datos se guardaron correctamente.");</script>';
			
		echo '<script language="JavaScript"> 
		location ="asismobil.php";
		</script>';
		}
   ?>
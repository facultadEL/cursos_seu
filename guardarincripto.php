<?php
include "conexionCursosExtension.php";	
$variableControl = $_REQUEST['variableControl'];
$cursoControl = $_POST['curso'];

$tip2 = pg_query($conn , "SELECT COUNT(id_inscriptosxcurso) as contar FROM inscriptosxcurso full outer join inscripto on(inscriptosxcurso.fk_inscriptos = inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where dni='".$_POST['numdoc']."' AND fk_curso='$curso';");
	$row2 = pg_fetch_array($tip2);
	
if ($row2["contar"]==0){
$tip29 = pg_query($conn,"SELECT MAX(id_inscripto) FROM inscripto;");
	$row29 = pg_fetch_array($tip29);
	$intmax=$row29["max"];
	$id_int=$intmax+1 ;
	//echo $curso;
	
	$sql = "BEGIN TRANSACTION";
   	$result = pg_query($conn,$sql) or die("Error en el query: $query. " . pg_last_error($conn)); 	
	
//INGRESO LA TABLA "inscripto"		
if($variableControl == 0){
	$insert="INSERT INTO inscripto (id_inscripto,nombre,apellido,fk_tipodoc,dni ,direccion,numero, localidad, mail, telfijo, telcel, info)
 VALUES  ('".$id_int."','".$_POST['nombre']."','".$_POST['apellido']."','".$_POST['tipoDocumento']."','".$_POST['numdoc']."','".$_POST['direccion']."','".$_POST['numero']."','".$_POST['localidad']."','".$_POST['mail']."','".$_POST['telfijo']."','".$_POST['telcel']."','".$_POST['info']."');";
}else{
	$numdni = $_POST['numdoc'];
	$buscarId = pg_query("SELECT * FROM inscripto WHERE dni=$numdni");
	while($rowId=pg_fetch_array($buscarId,NULL,PGSQL_ASSOC)){
		$idInscriptoUnico = $rowId['id_inscripto'];
	}
	$insert="UPDATE inscripto SET nombre='".$_POST['nombre']."',apellido='".$_POST['apellido']."',dni='$numdni',fk_tipodoc='".$_POST['tipoDocumento']."',direccion='".$_POST['direccion']."',numero='".$_POST['numero']."',localidad='".$_POST['localidad']."',telfijo='".$_POST['telfijo']."',telcel='".$_POST['telcel']."',mail='".$_POST['mail']."',info='".$_POST['info']."' WHERE id_inscripto=$idInscriptoUnico"; 
}

	$datos=$insert;
	//echo $datos;
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
	if($variableControl==0){
	//$idConsulta = pg_query("SELECT * FROM inscripto ORDER BY id_inscripto DESC LIMIT 1");
		//while($rowId=pg_fetch_array($idConsulta,NULL,PGSQL_ASSOC)){
			$idInscripto = $id_int;
		//}
	}else{
		$idInscripto = $idInscriptoUnico;
	}
	//Registro inscripto por curso
	$tip29 = pg_query($conn,"SELECT MAX(id_inscriptosxcurso) FROM inscriptosxcurso;");
	$row29 = pg_fetch_array($tip29);
	$intmax=$row29["max"];
	$id_insxcur=$intmax+1 ;
	
	$curso=$_POST['curso'];
	$porcentajeDesc = $_POST['descuento'];
	$motivoDesc = $_POST['motivodescuento'];
	$consultaIXC = "INSERT INTO inscriptosxcurso(id_inscriptosxcurso,fk_inscriptos,fk_curso,porcdescuento,motivodescuento) VALUES('".$id_insxcur."','".$idInscripto."','".$curso."','".$porcentajeDesc."','".$motivoDesc."')";
	$datos=$consultaIXC;
	//echo $datos;
	$res=pg_query($conn,$datos);
		//$result2 = pg_query($conn,$inspar);
		//controlo que todo haya sido guardado correctamente
	$error=0;
	if (!$res){
     $errorpg = pg_last_error($conn);
     $termino = "ROLLBACK";
     $error=1;
	}else{
     $termino = "COMMIT";
    }
	pg_query($termino);

	if ($error == 0){
		//Se incrementa la cantidad de inscriptos al curso
		$consultaCantInscriptos = pg_query("SELECT cant_inscriptos FROM cursos where id_cursos=$curso");
		$rowCantI=pg_fetch_array($consultaCantInscriptos,NULL,PGSQL_ASSOC);
			$cant_inscriptos = $rowCantI['cant_inscriptos'];
		
		$cant_inscriptos = $cant_inscriptos + 1;
		pg_query("UPDATE cursos SET cant_inscriptos = $cant_inscriptos WHERE id_cursos=$curso");
	}
	
	//Traigo id del ultimo inscripto por curso
	//$consultaUltimoId = pg_query("SELECT * FROM inscriptosxcurso ORDER BY id_inscriptosxcurso DESC LIMIT 1");
	//while($rowUltimoId=pg_fetch_array($consultaUltimoId,NULL,PGSQL_ASSOC)){
		$ultimoId = $id_insxcur;
		$ultimoId2 = $id_insxcur;
	//}
	echo "Id:".$ultimoId;
	//Traigo datos del curso
	$curso = $_POST['curso'];
	echo "Curso: ".$curso;
	$consultaCurso = pg_query("SELECT * FROM cursos where id_cursos=$curso");
	while($rowCurso=pg_fetch_array($consultaCurso,NULL,PGSQL_ASSOC)){
		$cantCuotas = $rowCurso['cantcuota'];
		$montoCuota = $rowCurso['monto'];
		$montoCuotaAntesVenc = $rowCurso['monto_antes_venc'];
		$diaVenc = $rowCurso['dia_venc'];
		$mes=split("/",$rowCurso["duracion_desde"]);
		
	}
	//Sacar porcentaje por cuotas
	$porcentaje = ($porcentajeDesc * $montoCuota)/100;
	$porcentaje = round($porcentaje);
	//Calcula valor de cuota
	$cuota = $porcentaje;
	$montomostrar = $cuota;
	
	//Sacar porcentaje por cuotas
	$porcentaje2 = ($porcentajeDesc * $montoCuotaAntesVenc)/100;
	$porcentaje2 = round($porcentaje2);
	//Calcula valor de cuota
	$cuota2 = $porcentaje2;
	$montomostrar2 = $cuota2;
	echo 'ppp: '.$montomostrar2;
	
	
	//Seteo las variables para el codigo de barra
	if (strlen($ultimoId)==2) {$ultimoId="00".$ultimoId;}
		  	elseif (strlen($ultimoId)==3){$ultimoId="0".$ultimoId;}
	if (strlen($cuota)==2) {$cuota="00". $cuota;}
	elseif (strlen($cuota)==3) {$cuota="0". $cuota;}
	
	$nombreyapellido=$_POST["nombre"].", ".$_POST["apellido"]." ";
	$cursocoop = "";
	echo "Cant C:".$cantCuotas;
	
	$tip29 = pg_query($conn,"SELECT MAX(id_pagosencoop) FROM pagosencoop;");
	$row29 = pg_fetch_array($tip29);
	$intmax=$row29["max"];
	$id_pagosencoop=$intmax;
	
	for($i=0;$i<$cantCuotas;$i++){
		$anio = 0;
		if(($mes[1] + $i) > 12)
		{
			$vencmes = ($mes[1] + $i) - 12;
			$anio = date("Y") + 1;
			$anioCorto = date("y") + 1;
		}
		else
		{
			$vencmes=$mes[1]+$i;	
			$anio = date("Y");
			$anioCorto = date("y");
		}

		if (strlen($vencmes)==1) 
		{
			$vencmes="0".$vencmes;
		}
		 	
			$venc= $diaVenc."/".$vencmes."/".$anio;
		 	$contar++;
	
			if ($contar==5)
				{
				$contar=0;	?>
      			<? }
	  
			$contcuota=$i+1;
			$codigobarras=$ultimoId.$contcuota.$cantCuotas.$cuota.$anioCorto;
			
			echo "A: ".$codigobarras;
			echo "B: ".$montomostrar;
			echo "C: ".$nombreyapellido;
			echo "D: ".$ultimoId;
			$id_pagosencoop++;

			if($i == 0)
			{
				$cursocoop=$cursocoop."INSERT INTO pagosencoop (id_pagosencoop,codigo_barras, monto, nombreyapellido,fk_inscriptosxcursos,monto_c_descuento, fecha_venc) VALUES('$id_pagosencoop','$codigobarras','$montomostrar2','$nombreyapellido','$ultimoId','$montomostrar2','$venc');";
			}
			else
			{
				$cursocoop=$cursocoop."INSERT INTO pagosencoop (id_pagosencoop,codigo_barras, monto, nombreyapellido,fk_inscriptosxcursos,monto_c_descuento, fecha_venc) VALUES('$id_pagosencoop','$codigobarras','$montomostrar','$nombreyapellido','$ultimoId','$montomostrar2','$venc');";	
			}
	}
	
	echo $cursocoop;
	$msg="Archivo guardado";
	$error=0;
	if (!pg_query($conn, $cursocoop)) 
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
			//alert("Los datos no se guardaron correctamente / COOPERADORA. Pongase en contacto con el administrador  ");//</script>';
		}else
		{
		echo '<script language="JavaScript"> 
			alert("Los datos se guardaron correctamente / COOPERADORA.");</script>';
			   
			}

		echo '<script language="JavaScript"> 
		location ="imprimircertinscripto.php?inscriptosxcurso='.$ultimoId2.'";
		</script>';
		
}
  else
  {
  echo '<script language="JavaScript"> 
		alert("El inscripto ya pertenece a este curso.");
		location= "index.php";
		</script>';
}
	
	
	
									
	//echo $row1["cantcuota"];
	
	//for($i=1;$i<=$cantCuotas;$i++){
		//estado = FALSE - NO PAGADO
		//$insert2 = ("INSERT INTO pagocuotas(nrocuota,fk_inscriptosxcurso,estado,montoxcuota) VALUES('$i','$ultimoId',FALSE,'$cuota')");
	//}												  												

//$datos2=$insert2;
	//echo $datos2;
	//	$res2=pg_query($conn,$datos2);
												  
	//}				
												   
//if (!$res2) 
	// {
     //$errorpg = pg_last_error($conn);
     //$termino = "ROLLBACK";
     //$error=1;
	 //}
     //else
     //{
     //$termino = "COMMIT";
     //}
//if ($error==1)
	//{
	//echo '<script language="JavaScript"> 
		//alert("Los datos no se guardaron correctamente. Pongase en contacto con el administrador");</script>';
	//}else
	//{
	//echo '<script language="JavaScript"> 
		//alert("Los datos se guardaron correctamente.");</script>';
	//}


		
		
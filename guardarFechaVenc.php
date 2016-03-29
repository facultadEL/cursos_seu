<?php
include_once "conexionCursosExtension.php";
$numAlumno = $_REQUEST['numAlumno'];
echo $numAlumno;

//VER SI EL ALUMNO TIENE MONTO CON DESCUENTO
$controlDescuento = 0;

//TRAER CODIGO BARRA
$cuotas = pg_query("SELECT codigo_barras FROM pagosencoop FULL OUTER JOIN inscriptosxcurso ON(pagosencoop.fk_inscriptosxcursos = inscriptosxcurso.id_inscriptosxcurso) WHERE id_inscriptosxcurso=$numAlumno AND num_recibo IS NULL");
$rowCantCuotas = pg_fetch_array($cuotas);
$codigoB = $rowCantCuotas['codigo_barras'];
$cantCuotas = $codigoB[5];
for($i=1;$i<$cantCuotas+1;$i++){
	$controlDescuento = 0;
	$var = "cuotadia".$i;	
	$var2 = "cuotames".$i;
	$var3 = "cuotaanio".$i;
	$valorFechaMod = $_REQUEST[$var];
	$valorFechaModMes = $_REQUEST[$var2];
	$valorFechaModAnio = $_REQUEST[$var3];
	
	
	//echo $valorFechaMod;
	$sqlFechaAnt = pg_query("SELECT codigo_barras,fecha_venc,monto_c_descuento FROM pagosencoop WHERE fk_inscriptosxcursos=$numAlumno AND codigo_barras LIKE '____".$i."_______'");	
	$rowFechaAnt = pg_fetch_array($sqlFechaAnt);	
	$codigoBarraMod = $rowFechaAnt['codigo_barras'];
	$fechaAnt = $rowFechaAnt['fecha_venc'];	
	if($rowFechaAnt['monto_c_descuento']==NULL){
		$controlDescuento = 1;
	}
	if($controlDescuento == 1){
		$var4 = "montoscuota".$i;
		$valorMontoDescuento = $_REQUEST[$var4];
	}
	//echo $fechaAnt;
	$vFechaAnt = split("-",$fechaAnt);
	if($valorFechaMod!=NULL){		
		$nuevaFechaVenc = $valorFechaModAnio."-".$valorFechaModMes."-".$valorFechaMod;
		echo $nuevaFechaVenc;
		if($controlDescuento==1){
		echo "Entro";
		echo $valorMontoDescuento;
		echo $codigoBarraMod;
			pg_query("UPDATE pagosencoop SET fecha_venc='$nuevaFechaVenc',monto_c_descuento='$valorMontoDescuento' WHERE codigo_barras = '$codigoBarraMod'");
		}else{
			pg_query("UPDATE pagosencoop SET fecha_venc='$nuevaFechaVenc' WHERE codigo_barras = '$codigoBarraMod'");
		}
		
		
		//pg_query("UPDATE pagosencoop SET fecha_venc='$nuevaFechaVenc' WHERE codigo_barras = '$codigoBarraMod'");
		//echo $valorFechaMod."-".$vFechaAnt[1]."-".$vFechaAnt[0];
	}
	//if($valorFechaMod!=NULL){
		//$consultaMod = "UPDATE pagosencoop SET mod"
	//}
	
}
echo '<script language="JavaScript">
			alert("Los datos se guardaron correctamente.");</script>';

		echo '<script language="JavaScript">
		location ="cambiarFechaVencimiento.php?numAlumno='.$numAlumno.'";
		</script>';
?>
<?php

include_once "conexionCursosExtension.php";
$fechaHoy = date("Y").'-'.date("m").'-'.date('d');
$idPasar = $_REQUEST['idPasar'];
//echo $idPasar;
//$varMonto = 'm-'.$idPasar;
$monto = $_REQUEST['monto'];
$sqlPagar = "UPDATE pagosencoop SET fechapago='$fechaHoy',monto_pagado='$monto' WHERE id_pagosencoop='$idPasar';";
//echo $sqlPagar;

$error = 0;

if(!pg_query($sqlPagar)){
	$error = 1;
	$termino = "ROLLBACK";
}else{
	$termino = "COMMIT";
}
pg_query($termino);

if($error == 1){
	echo '<script type="text/javascript">alert("Los datos no se guardaron correctamente")
		location.href="pagoCuotasSecretaria.php";
		</script>';
}else{
	$cursoF = $_REQUEST['cursoF'];
	$cursoI = $_REQUEST['cursoI'];
	echo '<script type="text/javascript">alert("Los datos se guardaron correctamente")
		location.href="pagoCuotasSecretaria.php?cursoF='.$cursoF.'&cursoI='.$cursoI.'";
		</script>';
}

?>
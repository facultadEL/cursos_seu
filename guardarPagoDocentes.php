<?php
error_reporting(E_ALL);

include_once 'conexionCursosExtension.php';

$sqlMaxId = pg_query('SELECT max(id_pagodocente) FROM pagodocente');
$rowMaxId = pg_fetch_array($sqlMaxId);
$idGenerarPago = $rowMaxId['max'] + 1;
echo $idGenerarPago;

$idCurso = $_REQUEST['cursoF'];
$cuota = $_REQUEST['cuota'];
$descuento = $_REQUEST['descuento'];
$porcOEfect = $_REQUEST['porcOEfect'];
$total = $_REQUEST['totalPago'];
$valorDescuento = $_REQUEST['valorDescuento'];
$materiales = $_REQUEST['materiales'];


//echo $idcurso,$cuota,$descuento,$total,$valorDescuento;


$sqlGenerarPago = "INSERT INTO pagodocente(id_pagodocente,nrocuota_pagodocente,totalpagar_pagodocente,curso_pagodocente,descuento_pagodocente,materiales_pagodocente) VALUES('$idGenerarPago','$cuota','$total','$idCurso','$valorDescuento','$materiales')";
echo $sqlGenerarPago;

$error = 0;
if(!pg_query($conn,$sqlGenerarPago)){
	$error = 1;
	$termino = "ROLLBACK";
}else{
	$termino = "COMMIT";
}

pg_query($termino);

if($error == 1){
	echo '<script type="text/javascript">alert("Los datos no se guardaron correctamente")
	location.href ="pagoadocentes.php"</script>';
}else{
	echo '<script type="text/javascript">if(confirm("Desea generar otro pago?")){
			location.href="pagoadocentes.php";
		}else{
			location.href="listadoPagoDocentes.php"
		}</script>';
}


?>
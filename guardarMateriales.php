<?php
include_once "conexionCursosExtension.php";

function buscarComa($n){
	$pD = str_replace(',','.',$n);
	return $pD;
}
$sqlGuardarMateriales = "";
$cursoF = $_REQUEST['cursoF'];

$proveedor = $_REQUEST['proveedor'];
if($proveedor == 0){
	$proveedorNoCreado = $_REQUEST['proveedorNoCreado'];
	$sqlMaxId = pg_query("SELECT max(id_proveedor) FROM proveedor");
	$rowMaxId = pg_fetch_array($sqlMaxId);
	$idProveedor = $rowMaxId['max'] + 1;	
	
	$sqlNuevoProveedor = "INSERT INTO proveedor(id_proveedor,nombre_proveedor) VALUES('$idProveedor','$proveedorNoCreado');";
	
}else{
	$idProveedor = $proveedor;
	$sqlNuevoProveedor = "";
}

$sqlMaxId = pg_query("SELECT max(id_factura) FROM factura");
$rowMaxId = pg_fetch_array($sqlMaxId);
$idFactura = $rowMaxId['max'] + 1;

$nroFactura = $_REQUEST['nroFactura'];
$fechaFactura = $_REQUEST['fechaPasar'];
$sqlNuevaFactura = "INSERT INTO factura(id_factura,nro_factura,fecha_factura,proveedor_factura) VALUES('$idFactura','$nroFactura','$fechaFactura','$idProveedor');";


$sqlMaxId = pg_query("SELECT max(id_materialesxcurso) FROM materialesxcurso");
$rowMaxId = pg_fetch_array($sqlMaxId);
$idMateriales = $rowMaxId['max'];



for($i=1;$i<16;$i++){
	
	$cant = 'cant'.$i;
	$desc = 'desc'.$i;
	$prec = 'prec'.$i;
	$curs = 'curs'.$i;	
	
	$cantidad = $_REQUEST[$cant];
	$descripcion = $_REQUEST[$desc];
	$precioCC = $_REQUEST[$prec];
	$curso = $_REQUEST[$curs];
	$precio = buscarComa($precioCC);
	if($precio != NULL){
		if($cantidad != NULL){
			$precioTotal = $precio * $cantidad;			
		}else{
			$cantidad = 1;
			$precioTotal = $precio * $cantidad;
		}
		//echo $precioTotal;
		$idMateriales = $idMateriales + 1;
		
		$sqlGuardarMateriales = $sqlGuardarMateriales."INSERT INTO materialesxcurso(id_materialesxcurso,curso_materialesxcurso,cantidad_materialesxcurso,descripcion_materialesxcurso,preciounitario_materialesxcurso,preciototal_materialesxcurso,factura_materialesxcurso) VALUES('$idMateriales','$curso','$cantidad','$descripcion','$precio','$precioTotal','$idFactura');";
	}
	
	
	
}
//echo '<br>';
//echo $cursoF;
$sqlGuardar = $sqlNuevoProveedor.$sqlNuevaFactura.$sqlGuardarMateriales;
//echo $sqlGuardar;

$error = 0;
if(!pg_query($sqlGuardar)){
	$error = 1;
	$termino = "ROLLBACK";
}else{
	$termino = "COMMIT";
}
pg_query($termino);

if($error == 1){
	echo '<script type="text/javascript">alert("Los datos no se guardaron correctamente")
	location.href="cargarMateriales.php";</script>';
}else{
	echo '<script type="text/javascript">alert("Lo datos se guardaron correctamente")
	location.href="cargarMateriales.php";</script>';
}

?>

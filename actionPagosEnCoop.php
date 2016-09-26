<?php

include_once "conexionCursosExtension.php";

$id = $_REQUEST['id'];
$boolVal = $_REQUEST['boolVal'];

$sql = "UPDATE pagosencoop SET anulada='$boolVal' WHERE id_pagosencoop='$id';";

$result = true;
if(!pg_query($sql)){
    $termino = "ROLLBACK";
    $result = false;
}else{
    $termino = "COMMIT";
}

pg_query($termino);
    
$arr = array('success' => $result);

echo json_encode($arr);
?>
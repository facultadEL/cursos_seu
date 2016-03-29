<?php
include_once 'conexionCursosExtension.php';
$datosCursos = pg_query("SELECT anio,anio_activado FROM cursos ORDER BY anio");
$consulta = '';
while ($rowDatosCursos=  pg_fetch_array($datosCursos)){
    //$activado = $rowDatosCursos['activado'];
    $anio = $rowDatosCursos['anio'];
    $variable = 'ckAnio'.$anio;
    $valor = $_POST[$variable];
    //echo "anio: ".$valor.'<br>';
    if($valor=='on'){
        $consulta = $consulta."UPDATE cursos SET anio_activado='t' WHERE anio=".$anio.";";
        //hacer un update que modifique el campo activado y que sea = a 't'
    }else{
        $consulta = $consulta."UPDATE cursos SET anio_activado='f' WHERE anio=".$anio.";";
        //hacer un update que modifique el campo activado y que sea = a 'f'
    }    
}
$error = 0;

if(!pg_query($consulta)){
    $termino = "ROLLBACK";
    $error = 1;
}else{
    $termino = "COMMIT";
}
pg_query($termino);

if ($error==1){
    echo '<script language="JavaScript"> 			alert("Los datos no se guardaron correctamente. Pongase en contacto con el administrador");</script>';
}else{
    echo '<script language="JavaScript"> 
            alert("Los datos se guardaron correctamente.");</script>';    
            echo '<script language="JavaScript"> 
            location ="listadoMostrarAnios.php";
            </script>';
}
?>
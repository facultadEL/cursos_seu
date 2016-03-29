<?php
include_once 'conexionCursosExtension.php';
$datosCursos = pg_query("SELECT id_cursos FROM cursos ORDER BY id_cursos");
$consulta = '';
while ($rowDatosCursos=  pg_fetch_array($datosCursos)){
    $idCurso = $rowDatosCursos['id_cursos'];
    $variable = 'ckCurso'.$idCurso;
    $valor = $_POST[$variable];
    if($valor=='on'){
        $consulta = $consulta."UPDATE cursos SET activado='t' WHERE id_cursos=".$idCurso.";";
    }else{
        $consulta = $consulta."UPDATE cursos SET activado='f' WHERE id_cursos=".$idCurso.";";
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
            location ="listadomostrarcurso.php";
            </script>';
}
?>
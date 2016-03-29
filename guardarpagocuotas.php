<?php
include "conexionpg.php";	
$cursoF=$_POST['dato'];
$cursoI=$_POST['dato2'];
	if (($cursoF=='' or $cursoF==0) and ($cursoI=='' or $cursoI==0)){
		$tip29 = pg_query($conn,"select * from pagosencoop full outer join inscriptosxcurso on(pagosencoop.fk_inscriptosxcursos=inscriptosxcurso.id_inscriptosxcurso) full outer join inscripto on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where cursos.id_cursos=$cursoF and pagosencoop.fk_inscriptosxcursos=$cursoI  Order By  pagosencoop.id_pagosencoop,apellido");
	}
	else{
		if (($cursoF!='' or $cursoF!=0) and ($cursoI=='' or $cursoI==0)){
		$tip29 = pg_query($conn,"select * from pagosencoop full outer join inscriptosxcurso on(pagosencoop.fk_inscriptosxcursos=inscriptosxcurso.id_inscriptosxcurso) full outer join inscripto on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where cursos.id_cursos=$cursoF and pagosencoop.fk_inscriptosxcursos=$cursoI  Order By  pagosencoop.id_pagosencoop,apellido");}
		
		else{
			if 	(($cursoF=='' or $cursoF==0) and ($cursoI!='' or $cursoI!=0)){
			$tip29 = pg_query($conn,"select * from pagosencoop full outer join inscriptosxcurso on(pagosencoop.fk_inscriptosxcursos=inscriptosxcurso.id_inscriptosxcurso) full outer join inscripto on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where cursos.id_cursos=$cursoF and pagosencoop.fk_inscriptosxcursos=$cursoI  Order By  pagosencoop.id_pagosencoop,apellido");}
			
			else{
				if 	(($cursoF!='' or $cursoF!=0) and ($cursoI!='' or $cursoI!=0)){
					$tip29 = pg_query($conn,"select * from pagosencoop full outer join inscriptosxcurso on(pagosencoop.fk_inscriptosxcursos=inscriptosxcurso.id_inscriptosxcurso) full outer join inscripto on(inscriptosxcurso.fk_inscriptos=inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where cursos.id_cursos=$cursoF and pagosencoop.fk_inscriptosxcursos=$cursoI  Order By  pagosencoop.id_pagosencoop,apellido");
					}
				}
			}
		}
while($row29 = pg_fetch_array($tip29)){
 $m='m-'.$row29["id_pagosencoop"];
 $f='f-'.$row29["id_pagosencoop"];
 $s='s-'.$row29["id_pagosencoop"];
 $d='d-'.$row29["id_pagosencoop"];
 $id=$row29["id_pagosencoop"];
 if ($_POST[$f]=="" or $_POST[$m]=="" or $_POST[$d]==""){
}
else{
$tip2 = "UPDATE pagocuota SET montoxcuota='$_POST[$m]' , estado='$_POST[$s]' , descripcion ='$_POST[$d]', fechapago='$_POST[$f]' where $id=id";
	pg_query($conn, $tip2) or die(pg_last_error($conn));
	}
}
$error=0;

	if (!pg_query($conn, $tip2)) 
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
		}else
		{
		echo '<script language="JavaScript"> 
			alert("Los datos se guardaron correctamente.");</script>';
			
		}
echo '<script language="JavaScript"> 
	location ="pagosdecuotascooperadora.php"	</script>';
?>

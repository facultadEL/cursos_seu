<meta http-equiv="Content-Type" content="text/html; charset=latin1" />
<?php
$id_curso = $_REQUEST['cursoF'];
$cuerpo = $_REQUEST['cuerpoMail'];
$asunto = $_REQUEST['asunto'];
echo $id_curso;
echo $cuerpo;


include_once "conexionCursosExtension.php";
$correos = "";
$sqlAlumnos = pg_query("SELECT id_inscriptosxcurso, inscripto.apellido,inscripto.nombre, id_cursos,mail FROM inscriptosxcurso full outer join inscripto on (inscripto.id_inscripto = inscriptosxcurso.fk_inscriptos) full outer join cursos on (cursos.id_cursos = inscriptosxcurso.fk_curso) where id_cursos=$id_curso ORDER BY inscripto.apellido,inscripto.nombre ASC");
$contador=0;
while($rowAlumnos = pg_fetch_array($sqlAlumnos)){
	$controlCheck = "alumno".$rowAlumnos['id_inscriptosxcurso'];
	$check = $_REQUEST[$controlCheck];
	
	if($check == 'on'){
		$mail = $rowAlumnos['mail'];
		$vMail = explode('@',$mail);
		if($vMail[0]!='nada'){
			$contador++;
			$vectorMails[$contador] = $mail;
		}
	}
}

echo $correos;

require ("PHPMailer_5.2.1/class.phpmailer.php");



		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl"; 
		$mail->Host = "smtp.gmail.com"; // dirección del servidor
		$mail->Username = "extensionfrvm@gmail.com"; // Usuario
		
		$mail->Password = "4537500frvm"; // Contraseña
		
		$mail->Port = 465; // Puerto a utilizar
		$mail->From = "s_extension@frvm.utn.edu.ar"; // dirección remitente
		$mail->FromName = "Extension"; // nombre remitente
		
		for($i=1;$i<$contador+1;$i++){
			$mail->AddAddress($vectorMails[$i],''); // Esta es la dirección a donde enviamos
		}
		//$mail->AddCC("cuenta@dominio.com"); // Copia
		//$mail->AddBCC("cuenta@dominio.com"); // Copia oculta
		$mail->IsHTML(true); // El correo se envía como HTML
		$mail->Subject = $asunto; // Asunto
		$mail->Body = $cuerpo; // Mensaje a enviar
		//$mail->AltBody = "Hola mundo. Esta es la primer línean Acá continuo el mensaje"; // cuerpo alternativo del mensaje
		//$mail->AddAttachment("imagenes/imagen.jpg", "imagen.jpg");
		$exito = $mail->Send(); // Envía el correo.




if($exito){
	echo '<script language="JavaScript"> 
		alert("Verifique su casilla de correo, le hemos enviado un mail.");
		location ="enviarMail.php";
		</script>';	
}else{
	echo '<script language="JavaScript"> 
		alert("No se puedo enviar el correo, comuniquese con el administrador");
		location ="enviarMail.php";
		</script>';
}

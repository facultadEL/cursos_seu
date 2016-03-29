<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<style type="text/css">
			label1 {font-family: Calibri; text-transform: capitalize; padding: .5em; color: #0080FF;}
			#titulo3 {
				font-family: Calibri;
				border: 2px solid #BDBDBD;
				padding: 3px;
				-webkit-font-smoothing: antialiased;
				-webkit-border-radius: 13px 13px 0px 0px; 
				-moz-border-radius: 13px 13px 0px 0px;
				border-radius: 13px 13px 0px 0px;
			}
			l3 {font-family: Calibri;color: #0B615E; font-size: 1.5em;}
			l2 {font-family: Calibri;color: #424242; text-transform: capitalize; padding: .12em;}
			verde {font-family: Calibri;color: #31B404; text-transform: capitalize; padding: .12em;}
			rojo {font-family: Calibri;color: #DF0101; text-transform: capitalize; padding: .12em;}
			#tabla {
				background: #F2F2F2;
				text-align: center;
				border: 2px solid #FFF;
				color: #585858;
				-webkit-border-radius: 13px 13px 13px 13px; 
				-moz-border-radius: 13px 13px 13px 13px;
				border-radius: 13px 13px 13px 13px;
				width: 100%;
			}
			.boton {
				-moz-box-shadow:inset 0px 1px 1px -40px #dcecfb;
				-webkit-box-shadow:inset 0px 1px 1px -40px #dcecfb;
				box-shadow:inset 0px 1px 1px -40px #dcecfb;
				background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #bddbfa), color-stop(1, #80b5ea));
				background:-moz-linear-gradient(top, #bddbfa 5%, #80b5ea 100%);
				background:-webkit-linear-gradient(top, #bddbfa 5%, #80b5ea 100%);
				background:-o-linear-gradient(top, #bddbfa 5%, #80b5ea 100%);
				background:-ms-linear-gradient(top, #bddbfa 5%, #80b5ea 100%);
				background:linear-gradient(to bottom, #bddbfa 5%, #80b5ea 100%);
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#bddbfa', endColorstr='#80b5ea',GradientType=0);
				background-color:#bddbfa;
				-moz-border-radius:6px;
				-webkit-border-radius:6px;
				border-radius:6px;
				border:1px solid #84bbf3;
				display:inline-block;
				cursor:pointer;
				color:#ffffff;
				font-family:Arial;
				font-size:14px;
				font-weight:bold;
				padding:6px 24px;
				text-decoration:none;
				text-shadow:0px 1px 0px #528ecc;
			}
			.boton:hover {
				background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #80b5ea), color-stop(1, #bddbfa));
				background:-moz-linear-gradient(top, #80b5ea 5%, #bddbfa 100%);
				background:-webkit-linear-gradient(top, #80b5ea 5%, #bddbfa 100%);
				background:-o-linear-gradient(top, #80b5ea 5%, #bddbfa 100%);
				background:-ms-linear-gradient(top, #80b5ea 5%, #bddbfa 100%);
				background:linear-gradient(to bottom, #80b5ea 5%, #bddbfa 100%);
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#80b5ea', endColorstr='#bddbfa',GradientType=0);
				background-color:#80b5ea;
			}
			.boton:active {
				position:relative;
				top:1px;
			}
			#registro{
				padding: 5px;
				border-top: 1px solid #FFFFFF;
			}
			#renglon{
				border-top: 1px solid #FFFFFF;
			}
		</style>
	</head>
<body>
<form action="guardarEstadoCurso.php" method="post" name="estadoCursos">
<?php
include_once 'conexionCursosExtension.php';
$anio = date('Y');
$val = pg_query("SELECT id_cursos,nombre,docente,anio,activado FROM cursos WHERE anio=$anio ORDER BY id_cursos");
echo '<table align="center" cellspacing="0" cellpadding="2" width="100%" bgcolor=#585858 id="tabla">';
	echo '<tr bgcolor="#FFFFFF" width="100%">';
		echo '<td id="titulo3" colspan="4" align="center"><l3>Cursos del '.$anio.'</l3></td>';
	echo '</tr>';
	echo '<tr bgcolor="#000000" width="100%">';
		echo '<td align="center" width="50%"><strong><label1>Nombre</label1></strong></td>';
		echo '<td align="center" width="30%"><strong><label1>Docente</label1></strong></td>';
		echo '<td align="center" width="15%"><strong><label1>Estado</label1></strong></td>';
		echo '<td align="center" width="5%"><strong><label1>Mostrar</label1></strong></td>';
	echo '</tr>';
while($row=pg_fetch_array($val,NULL,PGSQL_ASSOC)){
	echo '<tr>';
		echo '<td align="left" id="renglon"><l2>'.$row['nombre'].'</l2></td>';
		echo '<td align="center" id="renglon"><l2>'.$row['docente'].'</l2></td>';
		if($row['activado']=='t'){
			//$variable = 'Activado';
			echo '<td align="center" id="renglon"><verde>Activado</verde></td>';
		}else{
			//$variable = 'No activado';
			echo '<td align="center" id="renglon"><rojo>No Activado</rojo></td>';
		}
		//echo '<td align="center"><l2>'.$variable.'</l2></td>';
		if($row['activado']=='t'){
			echo '<td align="center" id="registro">';
					echo '<input type="checkbox" name="ckCurso'.$row['id_cursos'].'" checked/>';
			echo '</td>';
		}else{
			echo '<td align="center" id="registro">';
					echo '<input type="checkbox" name="ckCurso'.$row['id_cursos'].'"/>';
			echo '</td>';
		}
	echo '<tr>';
}
echo '</table>';
echo '<table align="center" width="100%">';
echo '<tr>';
	echo '<td colspan="4" align="center">';
		echo '<input type="submit" name="boton" class="boton" value="Enviar"/>';
	echo '</td>';
echo '</tr>';
echo '</table>';
?>
</form>
</body>
</html>
  
<head>
		<link rel="stylesheet" href="jquerysolapas/tabs.css" type="text/css" media="all">
		<script src="jquerysolapas/prototype.js" type="text/javascript"></script>
		<script type="text/javascript" src="jquerysolapas/fabtabulous.js"></script>
	</head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />


<div align="center"> 


             <?
	function latin1($txt) {
 $encoding = mb_detect_encoding($txt, 'latin1');
 if ($encoding == "UTF-8") {
     $txt = utf8_decode($txt);
 }
 return $txt;
}
	include_once "conexionCursosExtension.php";
  $anio=date(Y);
     $tip2 = pg_query($conn,"SELECT * FROM cursos where anio=$anio and publicar=true ORDER BY id_cursos DESC");
							 ?>					  
										
         <div id="container">
			<div id="banner">&nbsp;</div>
	<div id="mainmenu">
  		<ul id="tabs">
          <?
			$cont=0;
            while($row = pg_fetch_array($tip2)){
			$cont++;
	  	 ?>

		<li>
		<a href="#curso<?=$cont?>"><?=$row["nombre"];?></a>
		</li>
		<? }?>
		</ul>
 	 <div>
		<div class="bar">&nbsp;</div>
           <?
		   include_once "conexionCursosExtension.php";
  $anio=date(Y);
     $tip2 = pg_query($conn,"SELECT * FROM cursos where anio=$anio and publicar=true ORDER BY id_cursos DESC");
			$cont=0;
			
            while($row = pg_fetch_array($tip2)){
			$cont++;
			?>
			<div class="panel" id="curso<?=$cont?>">
				
            
            
            
             <table width="94%" border="0" cellspacing="1" cellpadding="4">
      <tr>
        <td colspan="3" bgcolor="#000000"><div align="center">
          <?=$row["nombre"];?>
        </div></td>
      </tr>
      <tr>
        <td width="20%"><div align="right"><strong>Tipo de curso </strong></div></td>
        <td width="51%"><div align="left"><span class="verdana7">
          <?
				  //Mostrar imagenes
				  $id_not=$row["id"];
				  $id_tipcurso=$row["fk_tipo"];
				     include_once "conexionCursosExtension.php";
						$tip23 = pg_query($conn,"SELECT nombre FROM tipo_curso where id_tipo_curso=$id_tipcurso");
						$row23 = pg_fetch_array($tip23);
						echo $row23["nombre"];
								  ?>
        </span></div></td>
        <td width="29%" rowspan="8"><a href="noticiascurso/download1.php?idfoto=<?= $row["fk_publicidad"]?>"  target="_blank"><img src="noticiascurso/download1.php?idfoto=<?=$row["fk_publicidad"]?>" alt="Imagen desde Blob" width="151" height="151" border="0" align="center" /></a></td>
      </tr>
      <tr>
        <td ><div align="right"><strong>Inscripci&oacute;n </strong></div>
          <div align="right"></div></td>
        <? // $arrayotrafecha=split("/",$row1['duracion_desde']);
	$arrayotrafecha2=split("/",$row["duracion_hasta"]);
    $timehoy=mktime(0,0,0,date("n"),date("d"),date("Y"));
   // $timeotrafecha=mktime(0,0,0,$arrayotrafecha[1],$arrayotrafecha[0],$arrayotrafecha[2]);
    $timeotrafecha2=mktime(0,0,0,$arrayotrafecha2[1],$arrayotrafecha2[0],$arrayotrafecha2[2]);
    //if($timehoy<=$timeotrafecha){
	if($timehoy<=$timeotrafecha2){?>
        <td bgcolor="#CC0000"><?
	//}
	}else{	  ?>
        <td><?
	}
?>
          <div align="left"> <? echo $row["publicidad_desde"]." al ".$row["publicidad_hasta"];?> </div></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#000000"><div align="center"><strong>Cursado </strong></div>
          <div align="left"></div></td>
      </tr>
      <tr>
        <td><div align="right"><strong>Duraci&oacute;n </strong></div>
          <div align="right"></div></td>
        <td><div align="left">
          <?=$row["duracion_desde"]." al ".$row["duracion_hasta"]?>
        </div>
          <div align="left"></div></td>
      </tr>
      <tr>
        <td><div align="right"><strong>D&iacute;as </strong></div>
          <div align="left"></div></td>
        <td><div align="left"><? echo $row["dia1"]." de ".$row["hora_desde"]." a ". $row["hora_hasta"]." hs.<br>";
				  if ( $row["hora_desde2"]!="00:00:00")
				   echo $row["dia2"]." de ".$row["hora_desde2"]." a ".$row["hora_hasta2"]."hs.";?></div></td>
      </tr>
      <tr>
        <td valign="top"><div align="right"><strong>Descripci&oacute;n </strong></div></td>
        <td><table width="90%" border="0" align="left" cellpadding="0" cellspacing="0">
          <tr>
            <td><?=$row["descripcion"]?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center"><a href="noticiascurso/download1.php?idfoto=<?= $row["fk_programa"]?>" target="_blank">Temario</a></div></td>
      </tr>
    </table>
   
    </td>
    </tr>
    </table>

            
            
            
            
            
            
            
            
            
            
			</div>
			<? }?>
		</div>   
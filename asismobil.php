<script>
function NO_letra(e){
   key=(document.all) ? e.keyCode : e.which;
   if( e.which == 0 ){return true;}
   if ((key > 47 && key < 58 ) || (key == 8)) 
   {
      return true;
   }
   return false;
   }//fin funcion
 function NO_letra2(e){
   key=(document.all) ? e.keyCode : e.which;
   if( e.which == 0 ){return true;}
   if (key > 47 && key < 58 ) 
   {	
	  return false;
   }
      return true;
   }  
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=0.60"/>  
<!--<meta http-equiv="Content-Type" content="text/html; charset=latin1" /> -->

<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style></head>
<body onLoad="tunCalendario();">
<table width="100%"  border="1" align="center">
<?php
//include_once "conexionCursosExtension.php";
//$consultaFechas = pg_query("SELECT * FROM cursos WHERE activado='t' AND anio='2013'");
//$contadorFechas = 0;
//while($rowFechas = pg_fetch_array($consultaFechas)){
	//$fechaSeparada = explode('/',$rowFechas['duracion_desde']);
	//$contadorFechas++;	
	
	//$vIdFechas[$contadorFechas] = $rowFechas['id_cursos'];	
	//$vDiaFechas[$contadorFechas] = $fechaSeparada[0];
	//$vMesFechas[$contadorFechas] = $fechaSeparada[1];
	//$vAnioFechas[$contadorFechas] = $fechaSeparada[2];
//}

//for($i=1;$i<$contadorFechas+1;$i++){
	//echo 'Id: '.$vIdFechas[$i].' - Fecha: '.$vDiaFechas[$i].'/'.$vMesFechas[$i].'/'.$vAnioFechas[$i].'<br>';
//}

//echo '<br>';

//for($i=1;$i<$contadorFechas+1;$i++){
	//$salir = 0;
	//for($j=1;$j<$contadorFechas+1;$j++){
		//if($i!=$j){
			//echo 'Fecha I: '.$vDiaFechas[$i].'/'.$vMesFechas[$i].'/'.$vAnioFechas[$i].' - Fecha J: '.$vDiaFechas[$j].'/'.$vMesFechas[$j].'/'.$vAnioFechas[$j].'<br>';
			//if($vAnioFechas[$i]>=$vAnioFechas[$j]){
				//if($vMesFechas[$i]>$vMesFechas[$j]){
					
						//echo 'Entro <br>';
						//$auxD = $vDiaFechas[$i];
						//$auxM = $vMesFechas[$i];
						//$auxA = $vAnioFechas[$i];
						//$auxI = $vIdFechas[$i];
						
						//$vDiaFechas[$i] = $vDiaFechas[$j];
						//$vMesFechas[$i] = $vMesFechas[$j];
						//$vAnioFechas[$i] = $vAnioFechas[$j];
						//$vIdFechas[$i] = $vIdFechas[$j];
						
						//$vDiaFechas[$j] = $auxD;
						//$vMesFechas[$j] = $auxM;
						//$vAnioFechas[$j] = $auxA;
						//$vIdFechas[$j] = $auxI;
						
						//$salir = 1;
						
					
				//}else{
					//if($vMesFechas[$i]==$vMesFechas[$j]){
						//if($vDiaFechas[$i]>$vDiaFechas[$j]){
						//	echo 'Entro <br>';
						//$auxD = $vDiaFechas[$i];
						//$auxM = $vMesFechas[$i];
						//$auxA = $vAnioFechas[$i];
						//$auxI = $vIdFechas[$i];
						
						//$vDiaFechas[$i] = $vDiaFechas[$j];
						//$vMesFechas[$i] = $vMesFechas[$j];
						//$vAnioFechas[$i] = $vAnioFechas[$j];
						//$vIdFechas[$i] = $vIdFechas[$j];
						
						//$vDiaFechas[$j] = $auxD;
						//$vMesFechas[$j] = $auxM;
						//$vAnioFechas[$j] = $auxA;
						//$vIdFechas[$j] = $auxI;
						
						//$salir = 1;
						//}
					//}
				//}
			//}
		//}
		
		
	//}
//}

//for($i=1;$i<$contadorFechas+1;$i++){
	//echo 'Id: '.$vIdFechas[$i].' - Fecha: '.$vDiaFechas[$i].'/'.$vMesFechas[$i].'/'.$vAnioFechas[$i].'<br>';
//}
//$contadorF = 0;

//for($i=$contadorFechas;$i<0;$i--){
	//$contadorF++;
	//$vFechasAcom[$contadorF] = $vDiaFechas[$i].'/'.$vMesFechas[$i].'/'.$vAnioFechas[$i];
//	echo $vFechasAcom[$contadorF];
//}

//echo '<br>';
?>
<form id="form1" name="form1" method="post" action="">
  <tr>
    <td height="30" align="center"><p><strong>PLANILLA DE ASISTENCIA</strong> </p>
      <table width="29%" border="1">
        <tr>
          <td>Filtrar Curso </td>
          </tr>
        <tr>
          <td><select name="cursoF" size="1" class="myTextField" id="cursoF" >
            <option value="0" selected="selected">Seleccione el Curso</option>
            <?php
            $cursoF = $_REQUEST['cursoF'];
                                         include_once "conexionCursosExtension.php";
													$anio = date('Y');
                                                  $tip1 = pg_query($conn,"SELECT id_cursos,nombre FROM cursos where activado='t' AND anio=$anio ORDER BY nombre;");
                                                  while($row1 = pg_fetch_array($tip1)){
                                 if(strcmp($row1["id_cursos"],$cursoF)==0)
                                 {
                                            $seleccionado = " selected";
                                       }else{
                                       $seleccionado = "";
                                   }
                                  echo "<option value=".$row1["id_cursos"]." $seleccionado>".$row1["nombre"]."</option>";
                                       }
                                                 ?>
          </select></td>
          </tr>
      </table>
      <p>
        <input type="submit" name="button" id="button" value="Buscar"  />
      </p></td>
  </tr>
    <?
    include "conexionCursosExtension.php";	
		if ($cursoF!='' or $cursoF!=0){
		$tip29 = pg_query($conn,"select nombre,docente from cursos where cursos.id_cursos=$cursoF ");
		echo $cursoF;
		
 ?>
 <tr>
 <td>
</form>
<? //<form id="form1" name="form2" method="post" target="_blank" action="/extension/imprimirasistencia.php"> ?>
<form id="form2" name="form2" method="post"  action="asistencia.php">
    <table width="100%" border="1">
      <tr>
        <td width="10%" bgcolor="#666666">Nombre del Curso</td>
        <td width="10%" bgcolor="#666666">Nombre del Docente </td>
      </tr>
       <? $var=0;
	   	  $cont=0;
	   while($row29 = pg_fetch_array($tip29)){
	   		$cont=$cont+1;
		   if ($var==0)
		   		{
				$color='bgcolor="#FFFFFF"';
				$var=1;
				}else{
				$color='bgcolor="#CCCCCC"';
				$var=0;
					}
	
		   ?>
      <tr>
        <td <?=$color?>><?=$row29["nombre"]?></td>
        <td <?=$color?>><?=$row29["docente"]?></td>
      </tr>
      <input type="text" id="dato2" name="dato2" value="<?=$row29["nombre"]?>" style="display:none"/>
        <? ;}?>
    </table>
	<table width="100%" border="1">
  <tr>
    <td width="100%"  align="center">
      <p>
        <input type="text" id="dato" name="dato" value="<?=$cursoF?>" style="display:none"/>
      <p>
        <input type="submit" name="button22" id="button22" value="Enviar" align="middle"/>
      </p></td>
  </tr>
</table>
</form>
<? } ?>
    </td>
  </tr>
  </table>
</body>
</html>

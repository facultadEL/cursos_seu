<? $inscripto=$_REQUEST["inscripto"];?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=latin1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.s {
	font-size: 12px;
}
.q {
	font-size: 14px;
	text-align: center;
	font-family: Georgia, "Times New Roman", Times, serif;
	font-weight: bold;
}
.w {
	font-size: 24px;
}
.fuente {
	font-size: 12px;
}
.w .w {
	font-size: 8px;
}
.s {
	font-size: 10px;
}
.s .s {
	font-size: 9px;
}
.s .s {
	font-size: 8px;
}
.s {
	font-size: 9px;
}
.s {
	font-size: 8px;
	text-align: center;
}
.titulos {
	font-size: 10px;
}
.utn {
	font-size: 14px;
}
-->
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    <? 	
	include "conexionCursosExtension.php";
	$inscripto = $_REQUEST['inscriptosxcurso'];
$sql= pg_query($conn,"select cursos.cantcuota, cursos.monto, cursos.monto_antes_venc, cursos.dia_venc, inscriptosxcurso.porcdescuento,inscripto.id_inscripto, inscripto.nombre as nombre, apellido, cursos.nombre as curnom, cursos.duracion_desde from inscriptosxcurso full outer join inscripto on(inscriptosxcurso.fk_inscriptos = inscripto.id_inscripto) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where inscriptosxcurso.id_inscriptosxcurso=$inscripto");
	$row29 = pg_fetch_array($sql);
$contar=0;
$contarcuota=0;

for ($contarcuota=0; $contarcuota<$row29["cantcuota"]; $contarcuota++){
	 // $montoxcuota=($row29["monto"]*$row29["porcdescuento"])/100;
	 // $montomostrar=$row29["monto"]-$montoxcuota;
	 $diaVenc = $row29['dia_venc'];
	 $montoAntesVenc = $row29['monto_antes_venc'];
	 $montoxcuota = $row29['monto'];
	 $montomostrar = ($row29['monto'] * $row29['porcdescuento'])/100;
	 $montomostrar = round($montomostrar);
	 $montomostrar2 = round($montomostrar);
	 $montomostrardesc = ($row29['monto_antes_venc'] * $row29['porcdescuento'])/100;
	 $montomostrardesc = round($montomostrardesc);
	 $montomostrardesc2 = round($montomostrardesc);
	 $mes=split("/",$row29["duracion_desde"]);
	//echo $mes[1]+1;
		  if (strlen($inscripto)==2) {$inscripto="00".$inscripto;}
		  elseif (strlen($inscripto)==3){$inscripto="0".$inscripto;}
		  if (strlen($montomostrar)==2) {$montomostrar="00". $montomostrar;}
  		  elseif (strlen($montomostrar)==3) {$montomostrar="0". $montomostrar;}
		  $vencmes=$mes[1]+$contarcuota;
		   if (strlen($vencmes)==1) {$vencmes="0".$vencmes;}
		 $venc= $diaVenc."/".$vencmes."/".date("Y");
		 $contar++;
	if ($contar==5)
	{
	$contar=0;	?>
    <p>&nbsp;</p><p>&nbsp;</p>
    <? }?>
    <table width="100%" border="0" cellspacing="14" cellpadding="0">
      <tr>
        <td width="50%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="4" align="center" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="79%" align="center"><table cellspacing="0" cellpadding="0" hspace="0" vspace="0" align="center">
                  <tr>
                    <td valign="top" align="center"><p class="utn"><strong class="utn">Universidad Tecnol&oacute;gica Nacional</strong><br />
                      <strong>      </strong><strong>Facultad Regional    Villa Maria</strong><br />
                      <span class="s">Av. Universidad 450 &ndash; Villa    Maria &ndash; C&oacute;rdoba<br />
                        Tel. 0353-453-7500 s_extension@frvm.utn.edu.ar</span></p></td>
                    </tr>
                  </table></td>
                <td width="8%" align="center" valign="middle"><img src="images/logoutn.jpg" width="37" height="43" /></td>
                <td width="13%" align="center"><p><strong class="q">Talon </strong><strong class="q">Alumno</strong></p></td>
              </tr>
              </table></td>
            </tr>
          <tr class="titulos">
            <td width="23%" align="center"><strong><span class="fuente">N&deg; Alumno</span></strong></td>
            <td colspan="2" align="center"><strong><span class="fuente"> Nombre y Apellido</span></strong></td>
            <td width="19%" align="center"><strong><span class="fuente">Vencimiento</span></strong></td>
          </tr>
          <tr>
            <td align="center"><span class="fuente">
              <?=$row29['id_inscriptosxcurso'];?>
            </span></td>
            <td colspan="2" align="center"><span class="fuente">
              <?=$row29["nombre"]." ".$row29["apellido"]?>
            </span></td>
            <td><strong>
              <?=$venc?>
            </strong></td>
          </tr>
          <tr>
            <td><strong><span class="fuente">Curso :</span></strong></td>
            <td colspan="3"><span class="fuente">
              <?=$row29["curnom"]?>
            </span></td>
            </tr>
          <tr>
            <td><strong><span class="fuente">Cuota N&deg; :</span></strong></td>
            <td><span class="fuente">
              <?=$contcuota=$contarcuota+1?>
            </span></td>
            <td colspan="2" rowspan="3" align="center"><img src="generarcodbarra/barcode.php?code=<? echo $inscripto.$contcuota.$row29["cantcuota"].$montomostrar.date("y");?>&amp;scale=1" alt="" /></td>
            </tr>
          <tr>
            <td><strong><span class="fuente">Monto 1/10:</span></strong></td>
            <td width="42%"><span class="fuente">
              <?=$montomostrardesc2?>
            </span></td>
            </tr>
			<tr>
            <td><strong><span class="fuente">Monto 11/30:</span></strong></td>
            <td width="42%"><span class="fuente">
              <?=$montomostrar2?>
            </span></td>
            </tr>
          <tr>
            <td colspan="2" class="utn">Fecha de pago: __/__/____</td>
            </tr>
          <tr>
            <td colspan="4" align="right" class="w"><span class="w">No V&aacute;lido como Factura</span></td>
            </tr>
        </table></td>
        <td width="50%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="4" align="center" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="79%" align="center"><table cellspacing="0" cellpadding="0" hspace="0" vspace="0" align="center">
                  <tr>
                    <td valign="middle" align="center"><p class="utn"><strong>Universidad Tecnol&oacute;gica Nacional</strong><br />
                      <strong>      </strong><strong>Facultad Regional    Villa Maria</strong><br />
                      <span class="s">Av. Universidad 450 &ndash; Villa    Maria &ndash; C&oacute;rdoba<br />
                        Tel. 0353-453-7500 s_extension@frvm.utn.edu.ar</span></p></td>
                  </tr>
                </table></td>
                <td width="8%" align="center" valign="middle"><img src="images/logoutn.jpg" alt="" width="37" height="43" /></td>
                <td width="13%" align="center"><p><strong class="q">Talon UTN</strong></p></td>
              </tr>
            </table></td>
          </tr>
          <tr class="titulos">
            <td width="23%" align="center"><strong><span class="fuente">N&deg; Alumno</span></strong></td>
            <td colspan="2" align="center"><strong><span class="fuente"> Nombre y Apellido</span></strong></td>
            <td width="19%" align="center"><strong><span class="fuente">Vencimiento</span></strong></td>
          </tr>
          <tr>
            <td align="center"><span class="fuente">
              <?=$row29['id_inscriptosxcurso'];?>
            </span></td>
            <td colspan="2" align="center"><span class="fuente">
              <?=$row29["nombre"]." ".$row29["apellido"]?>
            </span></td>
            <td><strong>
              <?=$venc?>
            </strong></td>
          </tr>
          <tr>
            <td><strong><span class="fuente">Curso :</span></strong></td>
            <td colspan="3"><span class="fuente">
              <?=$row29["curnom"]?>
            </span></td>
          </tr>
          <tr>
            <td><strong><span class="fuente">Cuota N&deg; :</span></strong></td>
            <td><span class="fuente">
              <?=$contcuota=$contarcuota+1?>
            </span></td>
            <td colspan="2" rowspan="3" align="center"><img src="generarcodbarra/barcode.php?code=<? echo $inscripto.$contcuota.$row29["cantcuota"].$montomostrar.date("y");?>&amp;scale=1" alt="" /></td>
            </tr>
          <tr>
            <td><strong><span class="fuente">Monto 1/10:</span></strong></td>
            <td width="42%"><span class="fuente">
              <?=$montomostrardesc2?>
            </span></td>
            </tr>
			<tr>
            <td><strong><span class="fuente">Monto 11/30:</span></strong></td>
            <td width="44%"><span class="fuente">
              <?=$montomostrar2?>
            </span></td>
            </tr>
          <tr>
            <td colspan="2" class="utn">Fecha de pago: __/__/____</td>
            </tr>
          <tr>
            <td colspan="4" align="center" ><span class="s">Del 1 al 10 la cuota tendra un descuento, pasada la fecha se cobrar&aacute; el valor sin descuento </span></td>
          </tr>
        </table></td>
      </tr>
    </table>
    
    <? }?>
    
    </td>
  </tr>
</table>
</body>
</html>
<script language="JavaScript">
window.print();
</script>
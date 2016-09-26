<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?
include "conexionCursosExtension.php";
$inscripto=$_REQUEST["inscriptosxcurso"];
//$idalumno=39;


$sql= pg_query($conn,"select inscripto.nombre, inscripto.apellido, inscripto.telfijo, 
 inscripto.mail, inscripto.direccion, inscripto.numero, inscripto.dni, tipodocumento.nombretipo,
 inscripto.localidad, inscripto.telcel, cursos.nombre as nomcurso, cursos.duracion_desde,
 cursos.duracion_hasta, cursos.docente, cursos.descripcion,cursos.hora_desde, 
 cursos.hora_hasta, cursos.dia1, cursos.dia2, cursos.hora_desde2, cursos.hora_hasta2, 
 cursos.monto, cursos.cantcuota from inscriptosxcurso full outer join inscripto on(inscriptosxcurso.fk_inscriptos = inscripto.id_inscripto) full outer join tipodocumento on(inscripto.fk_tipodoc = tipodocumento.id_tipodocumento) full outer join cursos on(inscriptosxcurso.fk_curso = cursos.id_cursos) where inscriptosxcurso.id_inscriptosxcurso=$inscripto;");
$row4 = pg_fetch_array($sql);	
?>
<style type="text/css">
<!--
.a {font-size: 12px;}
.s {
	font-size: 18px;
}
.s strong {	font-size: 24px;}
.w {font-size: 9px;}
-->
</style>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="186" valign="bottom"><p align="center"><img src="imprimircertinscripto_clip_image002.gif" alt="" width="50" height="47" /> <br />
      Facultad    Regional<br />
      Villa    Mar&iacute;a </p></td>
    <td width="761"><p class="s"><strong>Curso:  
<?=$row4["nomcurso"]?>
    </strong> </p></td>
    <td width="127" align="center"> RE1-PE1-02-06</td>
  </tr>
  <tr>
    <td colspan="3" valign="bottom"><table width="100%" border="0" cellspacing="6" cellpadding="0">
      <tr>
        <td colspan="2" align="center"><strong><a href="imprimircuotas.php?inscriptosxcurso=<?=$inscripto?>" class="s">Talonario de Cuotas</a></strong></td>
        </tr>
      <tr>
        <td colspan="2" align="center"><hr /></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><strong>Datos del Alumno</strong></td>
      </tr>
      <tr>
        <td width="48%" align="right"><strong>Fecha de la Inscripci&oacute;n :</strong></td>
        <td width="52%" align="left"><?=date("d-m-Y");?></td>
      </tr>
      <tr>
        <td colspan="3" align="center"><table width="100%" border="0" cellspacing="6" cellpadding="0">
          <tr>
              <td width="48%" align="right"><strong>Apellido : </strong></td>
              <td width="52%"><?=$row4["apellido"]?></td>
              </tr>
            <tr>
              <td align="right"><strong>Nombre : </strong></td>
              <td><?=$row4["nombre"]?></td>
              </tr>
            <tr>
              <td align="right"><strong>Tipo y N&deg; de Documento : </strong></td>
              <td><?=$row4["nombretipo"]." - ".$row4["dni"]?></td>
              </tr>
            <tr>
              <td align="right"><strong>Direcci&oacute;n : </strong></td>
              <td><?=$row4["direccion"]." ".$row4["numero"];?></td>
              </tr>
            <tr>
              <td align="right"><strong>Localidad :</strong></td>
              <td><?=$row4["localidad"];?></td>
              </tr>
            <tr>
              <td align="right"><strong>Tel&eacute;fono Fijo :</strong></td>
              <td><?=$row4["telfijo"]?></td>
              </tr>
            <tr>
              <td align="right"><strong>Tel&eacute;fono Celular :</strong></td>
              <td><?=$row4["telcel"];?></td>
              </tr>
            <tr>
              <td align="right"><strong>E-Mail :</strong></td>
              <td><?=$row4["mail"];?></td>
              </tr>
            </table>
          <table width="100%" border="0" cellspacing="6" cellpadding="0">
            <tr>
              <td colspan="2" align="right"><hr /></td>
              </tr>
            <tr>
              <td colspan="2" align="center"><strong>Datos Del Curso</strong></td>
            </tr>
            <tr>
              <td width="48%" align="right"><strong>Fecha de Comienzo :</strong></td>
              <td width="52%"><?=$row4["duracion_desde"];?></td>
            </tr>
            <tr>
              <td align="right"><strong>Fecha de Finalizaci&oacute;n  :</strong></td>
              <td><?=$row4["duracion_hasta"];?></td>
              </tr>
            <tr>
              <td align="right"><strong>Horario de Cursado :</strong></td>
              <td><?
		echo $row4["dia1"] ." de ". $row4["hora_desde"] ." a ". $row4["hora_hasta"]." hs.";
   	if($row4["hora_desde2"]!='00:00:00' || $row4["hora_hasta2"]!='00:00:00')
		   {
			echo "<br> ".$row4["dia2"]." de ".$row4["hora_desde2"]." a ".$row4["hora_hasta2"]." hs.";
			}
		?></td>
              </tr>
            <tr>
              <td align="right"><strong>Aspectos Generales del Curso :</strong></td>
              <td valign="middle"><?=$row4["descripcion"];?>
                </td>
            </tr>
            <tr>
              <td colspan="2" align="right" class="w"><strong>Fecha de Comienzo</strong>, <strong>Fecha de Finalizaci&oacute;n</strong> y <strong>D&iacute;a de Cursado</strong> sujeto a posibles modificaciones por parte de la universidad</td>
            </tr>
            <tr>
              <td colspan="2" align="right" valign="middle" class="w"><p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>______________________________________</p>
                <p>Firma del Alumno</p></td>
            </tr>
            <tr>
              <td colspan="2" align="center" valign="middle" class="w"><p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>Universidad Tecnol&oacute;gica Nacional- Facultad Regional Villa Mar&iacute;a<br />
                  Secretar&iacute;a de Extensi&oacute;n Universitaria <br />
                Tel: 4537500 - E-Mail: s_extension@frvm.utn.edu.ar </p></td>
            </tr>
          </table></td>
        </tr>
     
    
    </table></td>
  </tr>
</table>
<p>
  <? $texto="000951324799";
echo strlen($texto);?>
</p>
<script language="JavaScript">
window.print();
</script>
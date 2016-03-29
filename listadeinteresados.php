<script>
 function evaluaring(form1)
	{
		document.form1.submit(); 
	}
	</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center">
        
		 <form id="form1" name="form1" method="post" action="">
	        <p>
	          <select name="moda" size="1" class="myTextField" id="moda" onchange="evaluaring()" onkeyup="fn(this.form,this)" >
	            <option value="0" selected="selected">Seleccione Tipo de Curso</option>
	            <?php
										 include_once "conexionCursosExtension.php";
                                               $tip1 = pg_query($conn,"SELECT id_tipo_curso,nombre FROM tipo_curso;");
                                                  while($row1 = pg_fetch_array($tip1)){
                                 if(strcmp($row1["id_tipo_curso"],$moda)==0)
                                            $seleccionado = " selected";
                                       else
                                       $seleccionado = "";
                                  echo "<option value=".$row1["id_tipo_curso"]." $seleccionado>".$row1["nombre"]."</option>";
                                       }
                                                 ?>
	            </select>
	          <br />
	          <select name="anio" size="1" class="myTextField" id="anio" onchange="evaluaring()" onkeyup="fn(this.form,this)" >
	            <option value="0" selected="selected">Seleccione el a&ntilde;o</option>
	            <?php
			
                                         include_once "conexionCursosExtension.php";										 		
                                                 $tip1 = pg_query($conn,"SELECT anio FROM cursos group by anio;");
                                                  while($row1 = pg_fetch_array($tip1)){
													  if(strcmp($row1["anio"],$anio)==0){
                                            $seleccionado = " selected";}
                                       else{
                                       $seleccionado = "";}
                                  		echo "<option value=".$row1["anio"]." $seleccionado>".$row1["anio"]."</option>";
									}
                                           ?>
	            </select>
            </p>
	        <div align="center">            
	          <input type="submit" name="Submit" value="Enviar" />
	          </div>
		 </form>
        </td>
      </tr>
      </table>
	  <?  if ($moda!=0){?>
      <table width="100%" border="1" cellspacing="1" cellpadding="1">
        <tr>
          <td bgcolor="#CCCCCC"><div align="center"><strong>Apellido</strong></div></td>
          <td bgcolor="#CCCCCC"><div align="center"><strong>Nombre</strong></div></td>
          <td bgcolor="#CCCCCC"><div align="center"><strong>Tel&eacute;fono</strong></div></td>
          <td bgcolor="#CCCCCC"><div align="center"><strong>E-Mail</strong></div></td>
          <td bgcolor="#CCCCCC"><div align="center"><strong>A&ntilde;o</strong></div></td>
	    </tr>
		<?
                                         include_once "conexionCursosExtension.php";
										 //$anio=date(Y);
                        $tip2 = pg_query($conn,"SELECT apellido,interesado.nombre,telefono,mail,direccion,anio, tipo_curso.nombre as tipocurso FROM interesado, tipo_curso, interesadoxcurso where tipo_curso.id_tipo_curso= interesadoxcurso.fk_tipocurso and  interesado.id_interesado=interesadoxcurso.fk_interesado and tipo_curso.id_tipo_curso=$moda and anio=$anio order by interesado.apellido ");
						
$contar=0;
                                        while($row = pg_fetch_array($tip2)){ 
										 $contar++;?>
        <tr>
          <td><? echo $row["apellido"]; ?></td>
          <td><? echo $row["nombre"]; ?></td>
          <td><? echo $row["telefono"]; ?></td>
          <td><? $mail=$row["mail"]; echo $row["mail"]; ?></td>
          <td><? echo $row["anio"]; ?></td>
	    </tr>
		<? }?>
      </table>      
    </td>
  </tr>
  <? }?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><p><strong>Cantidad Total de Interesados :</strong><? echo $contar;?></p>
    <p><a href="listadeinteresados.php?imprimir=1&moda=<?=$moda?>&anio=<?=$anio?>">Imprimir Interesados</a></p></td>
  </tr>
</table>
<?
if ($imprimir==1)
 echo '<script language="JavaScript">
window.print();
</script>';
?>
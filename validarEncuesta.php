<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" sizes="14x16 16x14 16x16 32x32 48x48 64x64" type="image/x-icon" href="images/favicon.png" />
	<title>Validar DNI</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.css">
	<link rel="stylesheet" href="bootstrap/css/estilos.css">
	<script src="bootstrap/js/jquery-1.11.3.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script defer>
		function validar(){
			//Acá le mando los parametros y lo leo con POST en el otro archivo
			var parametros = {
                "dniAlumno" : $('#dniAlumno').val()
        	};

			$.ajax({
				type: "POST",
				url: "validaciones.php", //Este es el archivo al que tiene que ir a buscar los datos
				data: parametros,
				success:  function (response) { //Funcion que ejecuta si todo pasa bien. El response es los datos que manda el otro archivo
                        $('#idAlumno').val(response);
                },
				error: function (msg) {
					ponerColor('alerta1','dniAlumno');
					return false;
				}
			});
		}

		function pulsar(e){
			if(e.keyCode == 13){
				$('#dniAlumno').blur();
			}
		}

		function control(){
			if($('#idAlumno').val() != 0){
				$('#encuesta').submit();
			}else{
				ponerColor('alerta1','dniAlumno');
				return false;
			}
			return true;
		}

		function ponerColor(id,idFoco){
		    $('#'+id).attr('hidden', false);
		    $('#'+idFoco).val("");
		    $('#'+idFoco).focus();
		}

		function sacarColor(id){
		    $('#'+id).attr('hidden', true);
		}

		function loadScreen(){
			$('#alerta1').attr('hidden', true);
		}
	</script>
</head>
<body onload="loadScreen()">
<div class="container">
	<form name="encuesta" action="encuesta.php" method="post" id="encuesta" class="form-horizontal" onSubmit="return control()">
		<div class="margen_sup"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Verificaci&oacute;n de inscripci&oacute;n</h3>
			</div>

			<div class="panel-body panel_body">
				<input name="idAlumno" type="hidden" id="idAlumno" value="" />

				<div class="row alerta_dni">
					<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
						<div class="alert alert-danger text-center" id="alerta1">
							<strong>Atenci&oacute;n:</strong> usted no se encuentra inscripto a ning&uacute;n curso.
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="form-group">
						<div class="col-xs-8 col-sm-6 col-md-6 col-lg-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3 col-lg-offset-3"><input class="form-control text-center txt_dni" name="numdoc" type="text" pattern="([0-9]{1}|[0-9]{2})[0-9]{3}[0-9]{3}" id="dniAlumno" onblur="if(this.value != ''){validar()};" onkeydown="sacarColor('alerta1');pulsar(event);" placeholder="INGRESE SU DNI" value="" maxlength="8" minlength="7" required title="Ingrese solo n&uacute;meros y 7 caracteres m&iacute;nimo" autocomplete="off" required autofocus tabindex="1" /></div>
					</div>
				</div>

				<div class="row">
					<p>
						<center><button type="submit" class="btn btn-default" title="Enviar encuesta" tabindex="2">Enviar</button></center>
					</p>
				</div>
			</div>
		</div>		
	</form>
</div>
</body>
</html>
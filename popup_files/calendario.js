function bisiesto(a)	{
	function centuriaNoBisiesta(x)	{
		return (x % 100 == 0) && (x % 400 > 0)
	}
	return (a % 4 == 0) && !centuriaNoBisiesta(a);
}

function dias(mes, aa)	{
	var n_dias = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
	incremento = (mes == 1 && bisiesto(aa)) ? 1 : 0;
	return n_dias[mes] + incremento;
}

var _dia = ["D", "L", "M", "X",	"J", "V", "S", "D"];

var mes = [
	"enero",
	"febrero",
	"marzo",
	"abril",
	"mayo",
	"junio",
	"julio",
	"agosto",
	"septiembre",
	"octubre",
	"noviembre",
	"diciembre"
];

function seleccionaFecha(dd, mm, aa)	{
	alert("año: " + aa + "\nmes: " + mm + "\ndia: " + dd);
	return false;
}

function seleccionaFecha2(e)	{
	if (document.all)	{
		dia = event.srcElement.value;
		f = event.srcElement.form;
	}
	else	{
		dia = e.target.value;
		f = e.target.form;
	}

//	alert(f.innerHTML);

//	with	(f)		seleccionaFecha(dia, mes.value, aaaa.value);
	with	(f) window[resultado.value](dia, mes.value, aaaa.value);

	//alert(f.resultado.getAttribute("value"));

//	window[f.resultado.value](dia, f.mes.value, f.aaaa.value)
//	seleccionaFecha(dia, f.mes.value, f.aaaa.value);
}

function mostrarDias(aa, mm, f)	{
	var nFecha = new Date();
	aaaaHoy = nFecha.getFullYear();
	mesHoy = nFecha.getMonth();
	diaHoy = nFecha.getDate();
	nFecha.setFullYear(aa);
	nFecha.setMonth(--mm);
	nFecha.setDate(1);

	var empieza = nFecha.getDay();
	empieza += (empieza == 0) ? 7 : 0;
	var totaldias = dias(mm, aa);
	var termina = empieza + totaldias;

	diaSemana = nFecha.getDay();
	//alert("año: " + aa + "\nmes: " + mm + "\ncomienza: " + _dia[diaSemana] + "\ndias:" + totaldias);
//	var fechas = document.getElementById("fechasCalendario");
//	var fechas = f.getElementsByTagName("tBody")[0];

	fechas = document.getElementById(f).getElementsByTagName("tBody")[0];
	with(fechas)	{
		while(fechas.hasChildNodes())	fechas.removeChild(fechas.firstChild);
		style.border = "2px solid gray";
		// añadimos la primera fila
		fila = document.createElement("tr");
		fechas.appendChild(fila);

		eldia = 1;
		for (var actual = 1; actual < termina; actual ++) {

			if ((actual % 7) == 1)	{
				fila = document.createElement("tr");
				fechas.appendChild(fila);	
			}

			if (actual < empieza) fila.appendChild(document.createElement("td"));

			else {	esHoy = ((eldia == diaHoy) && (mm == mesHoy) && (aa == aaaaHoy));
				//if (esHoy) alert("hoy");
				var celda = document.createElement("td");
				fila.appendChild(celda);
				celda.style.textAlign = "center";

				var boton = document.createElement("button");
				boton.setAttribute("type", "button");
				celda.appendChild(boton);
				with(boton)	{
					appendChild(document.createTextNode(eldia));
					//type = "button";
					value = eldia++;
					if (document.all)
						attachEvent("onclick", seleccionaFecha2);
					else
						addEventListener("click", seleccionaFecha2, false);
					className = (esHoy) ? "hoy" : (actual % 7 == 0) ? "domingo" : "normal";
				}
			}
		}
	}
}

function mesAnterior(e)	{


	if (document.all)	{
		f = event.srcElement.form;
	}
	else	{
		f = e.target.form;
	}
//	alert(f.name);
	antMes(f.aaaa.value, f.mes.value, f);
}




function mesSiguiente(e)	{


	if (document.all)	{
		f = event.srcElement.form;
	}
	else	{
		f = e.target.form;
	}
//	alert(f.name);
	sigMes(f.aaaa.value, f.mes.value, f);
}


function aaAnterior(e)	{


	if (document.all)	{
		f = event.srcElement.form;
	}
	else	{
		f = e.target.form;
	}
	f.aaaa.value--;
//	alert(f.name);
	mostrarDias(f.aaaa.value, f.mes.value, f.name);

	
}


function selMes(e)	{
	if (document.all)	{
		f = event.srcElement.form;
	}
	else	{
		f = e.target.form;
	}
	mostrarDias(f.aaaa.value, f.mes.value, f.name);
}

function aaSiguiente(e)	{


	if (document.all)	{
		f = event.srcElement.form;
	}
	else	{
		f = e.target.form;
	}

	f.aaaa.value++;
//	alert(f.name);
	mostrarDias(f.aaaa.value, f.mes.value, f.name);
}



function antMes(aa, mm, f)	{
	mes = parseInt(mm);
	if (--mm == 0)	{
		mm = 12;
		aa--;
		f.aaaa.value = aa;
	}
	//mm--;
	f.mes.value = mm;
	//alert(aa + "" + mm);
	mostrarDias(aa, mm, f.name);
}

function sigMes(aa, mm, f)	{
	mes = parseInt(mm);
	if (++mm == 13)	{
		mm = 1;
		aa++;
		f.aaaa.value = aa;
	}
	//mm--;
	f.mes.value = mm;
	//alert(aa + "" + mm);
	mostrarDias(aa, mm, f.name);
}

function calendario(elmes, aa, el_id, papi, como, resultado)	{
//alert(resultado);

var totaldias = dias(elmes, aa);
var empieza = new Date(aa, elmes, 1).getDay();
if (empieza == 0) empieza = 7;
var termina = empieza + totaldias;
var eldia = 1;
var celda = 100 / 7;
var _calendario = document.createElement("form");
_calendario.name = el_id;
////////////////////////////
_calendario.id = el_id;
////////////////////////////
_calendario.action = "";
_calendario.method = "get";
_calendario.enctype = "text/plain";

// campo con el resultado
_control = document.createElement("input");

_control.id = "resultado";
_control.setAttribute("type", "hidden");
_control.setAttribute("name", "resultado");
_control.setAttribute("value", resultado);

_calendario.appendChild(_control);


_tabla = document.createElement("table");
//_tabla.id = el_id;
_tabla.cellPadding = 0;
_tabla.cellSpacing = 0;

_cabeza = document.createElement("tHead");
_cabeza.id = el_id + "_thead";
_cuerpo = document.createElement("tBody");
_tabla.appendChild(_cabeza);
_tabla.appendChild(_cuerpo);
_calendario.appendChild(_tabla);

// estructura creada... creamos la cabecera...
_fila = document.createElement("tr");
_celda = document.createElement("td");
_celda.colSpan = 7;

// Insertamos los controles...
	// mes anterior
	_control = document.createElement("button");
	_control.appendChild(document.createTextNode("<"));
	_control.className = "flecha";
	_control.setAttribute("type", "button");
	if (document.all)
		_control.attachEvent("onclick", mesAnterior);
	else
		_control.addEventListener("click", mesAnterior, true);
	_celda.appendChild(_control);

	// meses
	_control = document.createElement("select");
	_control.setAttribute("NAME", "mes");
/////////////////////////////////////////////
	_control.setAttribute("id", "mes");
/////////////////////////////////////////////

	for (var i = 0, total = mes.length; i < total; i ++)
//		_control.options[_control.options.length] = new Option(mes[i], (i + 1), elmes == i);
		_control.options[_control.options.length] = new Option(mes[i], (i + 1));

	if (document.all)
		_control.attachEvent("onchange", selMes);
	else
		_control.addEventListener("change", selMes, true);

	_celda.appendChild(_control);
	_control.value = elmes + 1;

	// mes siguiente
	_control = document.createElement("button");
	_control.appendChild(document.createTextNode(">"));
	_control.className = "flecha";
	_control.setAttribute("type", "button");
	if (document.all)
		_control.attachEvent("onclick", mesSiguiente);
	else
		_control.addEventListener("click", mesSiguiente, true);
	_celda.appendChild(_control);

	_celda.appendChild(document.createTextNode("    "));

	// año anterior
	_control = document.createElement("button");
	_control.appendChild(document.createTextNode("<"));
	_control.className = "flecha";
	_control.setAttribute("type", "button");
	if (document.all)
		_control.attachEvent("onclick", aaAnterior);
	else
		_control.addEventListener("click", aaAnterior, true);
	_celda.appendChild(_control);

	_control = document.createElement("input");
	_control.setAttribute("type", "text");
//	_control.setAttribute("name", "aaaa");
//	_control.value = aa;
	_control.size = 2;
	_celda.appendChild(_control);
	_control.name = "aaaa";
/////////////////////////////////
	_control.id = "aaaa";
/////////////////////////////////
	_control.setAttribute("value", aa);
	_control.setAttribute("TYPE", "TEXT");


	// año siguiente
	_control = document.createElement("button");
	_control.appendChild(document.createTextNode(">"));
	_control.className = "flecha";
	_control.setAttribute("type", "button");
	if (document.all)
		_control.attachEvent("onclick", aaSiguiente);
	else
		_control.addEventListener("click", aaSiguiente, true);
	_celda.appendChild(_control);



_fila.appendChild(_celda);
_cabeza.appendChild(_fila);

_fila = document.createElement("tr");

/*
for (var i = 1; i < 8; i ++)
	_calendario += "<th class='dia' width=" + celda + "% >" + _dia[i] + "</th>";
*/

for (var i = 1; i < 8; i ++)	{
	_celda = document.createElement("th");
	_celda.className = "dia";
	_celda.style.width = (100 / 7) + "%";
	_celda.appendChild(document.createTextNode(_dia[i]));
	_fila.appendChild(_celda);
}

_cabeza.appendChild(_fila);

_papa = document.getElementById(papi);
if (como || !_papa.hasChildNodes())
	_papa.appendChild(_calendario);
else
	_papa.insertBefore(_calendario, _papa.firstChild)


//var l = "mostrarDias('" + aa + "', '" + (elmes + 1) + "', '" + el_id + "')";
//alert(l);
mostrarDias(aa, (elmes + 1), el_id);

//setTimeout(l, 100);

}

function calendar (elmes, aa, el_id, resultado)	{
var totaldias = dias(elmes, aa);
var empieza = new Date(aa, elmes, 1).getDay();
if (empieza == 0) empieza = 7;
var termina = empieza + totaldias;
var eldia = 1;
var celda = 100 / 7;
var _calendario = "<form name='" + el_id + "' >";

// ponemos el sitio que recogerá el resultado
_calendario += "<input type='hidden' name='resultado' id='resultado' value='" + resultado + "' />\n";

_calendario += "<table cellpadding='0' cellspacing='0' id='" + el_id + "' cols='7' border='0' style='width: 50px' >"
_calendario += "<thead id='" + el_id + "_thead'><tr>";

_calendario += "<th colspan='7'>";

_calendario += "<button type='button' class='flecha' onclick='antMes(aaaa.value, mes.value, this.form)'>&lt;</button>";

_calendario += "<select name='mes' onchange='mostrarDias(aaaa.value, this.value, this.form.name)' >";
for (var i = 0; i < 12; i ++)	{
	_calendario += "<option value='" + (i + 1) + "'";
	_calendario += (i == elmes) ? " selected" : "";
	_calendario += " > " + mes[i] + "</option>\n";
}
_calendario += "</select>";


_calendario += "<button type='button' class='flecha' onclick='sigMes(aaaa.value, mes.value, this.form)'>&gt;</button>";

_calendario += "&nbsp;&nbsp;&nbsp;&nbsp;";
_calendario += "<button type='button' class='flecha' onclick='--aaaa.value; mostrarDias(aaaa.value, mes.value, this.form.name)'>&lt;</button>";
_calendario += "<input type='text' size='2' name='aaaa' value='" + aa + "'/>"; 
_calendario += "<button type='button' class='flecha' onclick='++aaaa.value; mostrarDias(aaaa.value, mes.value, this.form.name)'>&gt;</button>";

_calendario += "</th></tr><tr >";
for (var i = 1; i < 8; i ++)
	_calendario += "<th class='dia' width=" + celda + "% >" + _dia[i] + "</th>";

_calendario += "</tr></thead>";



_calendario += "<tbody >";
// contenido del tBody


/*

_calendario += "<tr>";
for (var actual = 1; actual < termina; actual ++) {

	if ((actual % 7) == 1) _calendario += "</tr><tr>";
	if (actual < empieza) _calendario += "<td></td>";
	else {
		_calendario += "<td ><button type='button' onclick='seleccionaFecha(this.value, mes.value, aaaa.value)' value='" + eldia + "' class='";
		_calendario += (hoymismo == eldia) ? "hoy" : ((actual % 7) == 0) ? "domingo" : "normal";
		_calendario += "' >" + eldia++ + "</button></td>";
	}
}
_calendario += "</tr>";

*/
_calendario += "</tbody></table></form>";

var llamar = "mostrarDias('" + aa + "', '" + (elmes + 1) + "', " + "'" + el_id + "')";
//alert(llamar);
setTimeout(llamar, 100);

return _calendario;

}

var _hoy = new Date();

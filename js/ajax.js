function objetoAjax(met,url,procesador) {
this.url=url;
this.curl="";//complemento de la url
this.met=met;
this.xmlobj=crearObj();
this.procesador=procesador;
this.ejecutar=ejecutar;
this.completar=completar;
}

function completar(n) {
//crear complemento de la url
this.curl='?valor='+n;

this.ejecutar();
}

function crearObj() {
// Obtener la instancia del objeto XMLHttpRequest
if(window.XMLHttpRequest) {
return new XMLHttpRequest();
}
else if(window.ActiveXObject) {
return new ActiveXObject("Microsoft.XMLHTTP");
}
}

function ejecutar() {

// Preparar la funcion de respuesta
this.xmlobj.onreadystatechange = this.procesador;
// Realizar peticion HTTP
this.xmlobj.open(this.met, this.url+this.curl, true);
this.xmlobj.send(null);

}

function validar(form)
{
if (form.fecha.value == "")
{ alert("Por favor, ingrese la fecha"); form.fecha.focus(); return false; }

if (form.descripcion.value == "")
{ alert("Por favor, ingrese la descripci\u00f3n de la actividad"); form.descripcion.focus(); return false; }

if (form.actividades.value == "")
{ alert("Por favor, seleccione una actividad"); form.actividades.focus(); return false; }

if (form.empresas.value == "")
{ alert("Por favor, seleccione una empresa"); form.empresas.focus(); return false; }

if (form.proyectos.value == "")
{ alert("Si la actividad esta asociada a un proyecto seleccione c\u00f3digo"); form.proyectos.focus(); return false; }

if (form.inicios.value == "")
{ alert("Por favor, ingrese hora de inicio"); form.inicios.focus(); return false; }
else
{
var horas = form.inicios.value.indexOf(":");
var h = form.inicios.value.substr(0, horas);
var m = form.inicios.value.substr(horas + 1);

if( h > 24 )
{
document.insertardatos.inicios.value = "" ;
document.insertardatos.horas.value = "" ;
alert("Error, la hora inicial debe ser menor o igual a 24");
form.inicios.focus();
return false;
}

if( m > 60 )
{
document.insertardatos.inicios.value = "" ;
document.insertardatos.horas.value = "" ;
alert("Error, los minutos de la hora inicial deben ser menores o iguales a 60");
form.inicios.focus();
return false;
}
}

if (form.finales.value == "")
{ alert("Por favor, ingrese hora de finalizaci\u00f3n"); form.finales.focus(); return false; }
else
{
var horass = form.finales.value.indexOf(":");
var h = form.finales.value.substr(0, horass);
var m = form.finales.value.substr(horass + 1);

if( h > 24 )
{
document.insertardatos.finales.value = "" ;
document.insertardatos.horas.value = "" ;
alert("Error, la hora final debe ser menor o igual a 24");
form.finales.focus();
return false;
}

if( m > 60 )
{
document.insertardatos.finales.value = "" ;
document.insertardatos.horas.value = "" ;
alert("Error, los minutos de la hora final deben ser menores o iguales a 60");
form.finales.focus();
return false;
}
}

if (form.horas.value == "" || form.horas.value == "00:00")
{ alert("Por favor, de click en la casillas de las horas totales para obtener el total"); form.finales.focus(); return false; }

if (form.inicios.value.indexOf(':', 0) == -1)
{ alert("Hora de inicio inv\u00e1lida. Formato correcto : 24:00"); form.inicios.focus(); return false; }

if (form.finales.value.indexOf(':', 0) == -1)
{ alert("Hora final inv\u00e1lida. Formato correcto : 24:00"); form.finales.focus(); return false; }

//convertimos las horas a minutos para almacenarlos en la base de datos
var dotes = form.horas.value.indexOf(":");
var h1 = form.horas.value.substr(0, dotes);
var m1 = form.horas.value.substr(dotes + 1);
var horasa=Number(h1)*60 + Number(m1);
document.insertardatos.horas.value=horasa;

//verificamos que no se envie dos veces el mismo formulario
if (cuenta == 0)
{
cuenta++;
return true;
}
else
{
alert("El siguiente formulario ya ha sido enviado por favor actualize su pagina, muchas gracias.");
return false;
}
}


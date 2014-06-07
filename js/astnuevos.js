
var cuenta=0;

function toUpper(control) {

if (/[a-z]/.test(control.value)) {
control.value = control.value.toUpperCase();
}
}

//------------------------------------------------------------------------------------------------------
function tildes()
{
var cadena=document.insertardatos.descripcion.value;
cadena=cadena.replace('Á','A');
cadena=cadena.replace('É','E');
cadena=cadena.replace('Í','I');
cadena=cadena.replace('Ó','O');
cadena=cadena.replace('Ú','U');
cadena=cadena.replace('Ñ','N');
cadena=cadena.replace('Ä','A');
cadena=cadena.replace('Ë','E');
cadena=cadena.replace('Ï','I');
cadena=cadena.replace('Ö','O');
cadena=cadena.replace('Ü','U');
document.insertardatos.descripcion.value=cadena;
}

//------------------------------------------------------------------------------------------------------

function limpiar(evt){
document.insertardatos.horas.value = "" ;
}

//------------------------------------------------------------------------------------------------------

//permite ingresar solo numeros en un input
var nav4 = window.Event ? true : false;
function acceptNumhoras(evt){
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57 ':'=58
var key = nav4 ? evt.which : evt.keyCode;
return (key <= 13 || (key >= 48 && key <= 58));
}

//------------------------------------------------------------------------------------------------------

function acceptNumhorasNada(evt){
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57 ':'=58
var key = nav4 ? evt.which : evt.keyCode;
return (false);
}

//------------------------------------------------------------------------------------------------------

function acceptNumfecha(evt){
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57 ':'=58 '-'=45
var key = nav4 ? evt.which : evt.keyCode;
return (key <= 13 || ( key > 44 && key < 46 ) || (key >= 48 && key <= 58));
}


//------------------------------------------------------------------------------------------------------
//presiono boton eliminar
function btn_eliminar(form){
document.insertardatos.actividades.value = "3";
document.insertardatos.empresas.value = "SITES" ;
document.insertardatos.finales.value = "12:00:00";
document.insertardatos.inicios.value = "13:00:00";
}

//------------------------------------------------------------------------------------------------------

var cuenta=0;

function validar2(form)
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
{ alert("Error, la empresa seleccionada no posee proyectos"); form.proyectos.focus(); return false; }

if (form.actividades.value == "3")
{ 
if(form.pro.value == "PROYECTOS" )
{
alert("Error, la actividad Ausencia no puede estar relacionada a un proyecto"); form.actividades.focus(); return false; 
}
}

if (form.inicios.value.indexOf(':', 0) == -1)
{ alert("Hora de inicio inv\u00e1lida. Formato correcto  00:01"); form.inicios.focus(); return false; }

if (form.finales.value.indexOf(':', 0) == -1)
{ alert("Hora final inv\u00e1lida. Formato correcto  23:59"); form.finales.focus(); return false; }


//***************VALIDACION DE LOS DOS PUNTOS EN HORA INICIAL*************************
var pointI=form.inicios.value;
var n1 = pointI.indexOf(":",0);
var n2 = pointI.indexOf(":",1);
var n3 = pointI.indexOf(":",3);
var n4 = pointI.indexOf(":",4);

if( ( n1 != 0 && n1 != 1 && n1 != 3 && n1 != 4 ) && ( n2 != 1 && n2 != 3 && n2 != 4 ) && ( n3 != 3 && n3 != 4 ) && ( n4 != 4 ) )
{
}
else
{
alert("Hora de inicio inv\u00e1lida. Formato correcto  00:01"); form.inicios.focus(); return false;
} 


//**************FIN VALIDACION DE DOS PUNTOS EN HORA INICIAL**************************


var horrr = form.inicios.value.indexOf(":");
var hhhh = form.inicios.value.substr(0, horrr);

var hfinh = form.finales.value.indexOf(":");
var hfin2 = form.finales.value.substr(0, hfinh);

if (form.inicios.value == "" || form.inicios.value == "00:00")
{ alert("Por favor, ingrese hora de inicio comenzando en 00:01 y como maximo 23:58"); form.inicios.focus(); return false; }
else
{
var horas = form.inicios.value.indexOf(":");
var h = form.inicios.value.substr(0, horas);
var m = form.inicios.value.substr(horas + 1);

if( h > 23 ) //antes tenia 24
{
//document.insertardatos.inicios.value = "00:00" ;
document.insertardatos.horas.value = "" ;
alert("Error, la hora inicial debe ser menor o igual a 23");
form.inicios.focus();
return false;
}

if( m > 59 ) //antes 60
{
//document.insertardatos.inicios.value = "00:00" ;
document.insertardatos.horas.value = "" ;
alert("Error, los minutos de la hora inicial deben ser menores o iguales a 59");
form.inicios.focus();
return false;
}
} //fin if inicios 1

if (form.inicios.value == "00:00")
{ alert("Por favor, ingrese hora de inicio"); form.inicios.focus(); return false; }
else
{
var horas = form.inicios.value.indexOf(":");
var h = form.inicios.value.substr(0, horas);
var m = form.inicios.value.substr(horas + 1);

if( h > 23 ) //antes 24
{
//document.insertardatos.inicios.value = "00:00" ;
document.insertardatos.horas.value = "" ;
alert("Error, la hora inicial debe ser menor o igual a 23");
form.inicios.focus();
return false;
}

if( m > 59 ) //antes 60
{
//document.insertardatos.inicios.value = "00:00" ;
document.insertardatos.horas.value = "" ;
alert("Error, los minutos de la hora inicial deben ser menores o iguales a 59");
form.inicios.focus();
return false;
}
} //fin if inicios 2


if (form.finales.value == "")
{ alert("Por favor, ingrese hora de finalizaci\u00f3n"); form.finales.focus(); return false; }
else
{

//***************VALIDACION DE LOS DOS PUNTOS EN HORA FINAL*************************
var pointF=form.finales.value;
var n1 = pointF.indexOf(":",0);
var n2 = pointF.indexOf(":",1);
var n3 = pointF.indexOf(":",3);
var n4 = pointF.indexOf(":",4);

if( ( n1 != 0 && n1 != 1 && n1 != 3 && n1 != 4 ) && ( n2 != 1 && n2 != 3 && n2 != 4 ) && ( n3 != 3 && n3 != 4 ) && ( n4 != 4 ) )
{
}
else
{
alert("Hora final inv\u00e1lida. Formato correcto  23:59"); form.inicios.focus(); return false;
} 


//**************FIN VALIDACION DE DOS PUNTOS EN HORA FINAL**************************

var horas = form.finales.value.indexOf(":");
var h = form.finales.value.substr(0, horas);
var m = form.finales.value.substr(horas + 1);

if( h > 23 ) //antes 24
{
//document.insertardatos.finales.value = "00:00" ;
document.insertardatos.horas.value = "" ;
alert("Error, la hora final debe ser menor o igual a 23:59");
form.finales.focus();
return false;
}

if( m > 59 ) //antes 60
{
//document.insertardatos.finales.value = "00:00" ;
document.insertardatos.horas.value = "" ;
alert("Error, los minutos de la hora final deben ser menores o iguales a 59");
form.finales.focus();
return false;
}
} //fin if finales 1




if (form.finales.value == "00:00")
{ alert("Por favor, ingrese hora de finalizaci\u00f3n"); form.finales.focus(); return false; }
else
{

//***************VALIDACION DE LOS DOS PUNTOS EN HORA FINAL*************************
var pointF=form.finales.value;
var n1 = pointF.indexOf(":",0);
var n2 = pointF.indexOf(":",1);
var n3 = pointF.indexOf(":",3);
var n4 = pointF.indexOf(":",4);

if( ( n1 != 0 && n1 != 1 && n1 != 3 && n1 != 4 ) && ( n2 != 1 && n2 != 3 && n2 != 4 ) && ( n3 != 3 && n3 != 4 ) && ( n4 != 4 ) )
{
}
else
{
alert("Hora final inv\u00e1lida. Formato correcto  23:59"); form.finales.focus(); return false;
} 


//**************FIN VALIDACION DE DOS PUNTOS EN HORA FINAL**************************


var horas = form.finales.value.indexOf(":");
var h = form.finales.value.substr(0, horas);
var m = form.finales.value.substr(horas + 1);

if( h > 23 ) //antes 24
{
//document.insertardatos.finales.value = "00:00" ;
document.insertardatos.horas.value = "" ;
alert("Error, la hora final debe ser menor o igual a 23:59");
form.finales.focus();
return false;
}

if( m > 59 ) //antes 60
{
//document.insertardatos.finales.value = "00:00" ;
document.insertardatos.horas.value = "" ;
alert("Error, los minutos de la hora final deben ser menores o iguales a 59");
form.finales.focus();
return false;
}
} //fin if finales 2


if (form.horas.value == "" || form.horas.value == "0" )
{ alert("Error la hora inicial debe ser diferente a la hora final"); form.finales.focus(); return false; }


//INICIAMOS LA VALIDACION PARA FORMATO Y HORA FINAL
var tf = form.finales.value;
var ti = form.inicios.value;

var ubf = tf.indexOf(":");
var ubi = ti.indexOf(":");

var h1  = tf.substr(0, ubf);
var h2  = ti.substr(0, ubi);

var m1  = tf.substr(ubf + 1);
var m2  = ti.substr(ubi + 1);

if( Number(h1) == Number(h2) )
{
//si las horas son iguales validamos los minutos
if( Number(m1) == Number(m2) )
{
//si los minutos son iguales no haremos nada ya que el resultado sera cero
}
else
{
if (tf.indexOf(':', 0) == -1)
{ 
alert("Hora final inv\u00e1lida. Formato correcto : 23:59");
form.finales.focus();
return false;
}
else
{
if( Number(m2) > Number(m1) )
{
alert("Error la hora final debe ser mayor que la hora inicial");
form.finales.focus();
return false;
//document.insertardatos.finales.value = "00:00" ;
//document.insertardatos.inicios.value = "00:00" ;
}
}
}
}
else
{
if (tf.indexOf(':', 0) == -1)
{ alert("Hora final inv\u00e1lida. Formato correcto : 23:59");
form.finales.focus();
return false;}
else
{
//SI LAS HORAS NO SON IGUALES VALIDAMOS QUE LA HORA FINAL SEA MAYOR Q LA INICIAL
if( Number(h2) > Number(h1) )
{
alert("Error la hora final debe ser mayor a la hora inicial");
form.finales.focus();
return false;
//document.insertardatos.finales.value = "00:00" ;
//document.insertardatos.inicios.value = "00:00" ;
}
}
}


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

//-----------------------------------------------------------------------------------------------------------------------------------

//funcion para colocar el formato correcto a las horas para modificarlas

function formato(form)
{
var ini=form.inicios.value;
var fini=form.finales.value;
var horaI=ini.substr(0,5);
var horaF=fini.substr(0,5);

document.insertardatos.inicios.value = horaI ;
document.insertardatos.finales.value = horaF ;
}

//------------------------------------------------------------------------------------------------------

//FUNCION PARA CALCULAR EL TIEMPO TRANSCURRIDO PARA REALIZAR LA ACTIVIDAD-----------------
function restahoras(t1, t2){
var aux2=0;
var h=0;
var ceros=0;
var dot1 = t1.indexOf(":");
var dot2 = t2.indexOf(":");
var h1 = t1.substr(0, dot1);
var h2 = t2.substr(0, dot2);
var m1 = t1.substr(dot1 + 1);
var m2 = t2.substr(dot2 + 1);
var hora1=Number(h1)*60 + Number(m1);
var hora2=Number(h2)*60 + Number(m2);
var aux=hora1-hora2;

if(aux>=60)
{
while( aux>=1 )
{
aux2=aux;
aux=aux-60;
h=h+1;

if(aux>=0 && aux<=59)
{
aux2=aux;
aux=-1;
}
}
} //fin if
else
{
aux2=aux;
}

if(h<10)
{
if(aux2<10)
{
var valor=String(ceros)+ String(h)+":"+String(ceros)+String(aux2);
}
else
{
var valor=String(ceros)+ String(h)+":"+String(aux2);
}
} //fin if
else
{
if(aux2<10)
{
var valor=String(h)+":"+String(ceros)+String(aux2);
}
else
{
var valor=String(h)+":"+String(aux2);
}
} //fin else


///////////////////////////////////////////////////////////////////////////////////
//convertimos las horas a minutos para almacenarlos en la base de datos
var dotes = valor.indexOf(":");
var h1 = valor.substr(0, dotes);
var m1 = valor.substr(dotes + 1);
var valorp=Number(h1)*60 + Number(m1);
//document.insertardatos.horas.value=horasa;
//////////////////////////////////////////////////////////////////////////////////
return valorp;
}

//------------------------------------------------------------------------------------------------------

//FUNCION PARA IMPRIMIR EN EL TEXT LA HORA CALCULADA
function totalhoras()
{

var ini  = document.insertardatos.inicios.value;
var fini = document.insertardatos.finales.value;
var horaI= ini.substr(0,5);
var horaF= fini.substr(0,5);

document.insertardatos.inicios.value = horaI ;
document.insertardatos.finales.value = horaF ;

enviarhoras();
document.insertardatos.horas.value = restahoras(document.insertardatos.finales.value, document.insertardatos.inicios.value)
}

function totalhoras_modificar()
{
var iniI=document.insertardatos.inicios.value;
var finiI=document.insertardatos.finales.value;
var horaII=iniI.substr(0,5);
var horaFF=finiI.substr(0,5);

document.insertardatos.horas.value = restahoras(horaFF, horaII)
}

function enviarhoras()
{
controlhoras( document.insertardatos.finales.value , document.insertardatos.inicios.value );
}

//FUNCION PARA VALIDAR QUE LA HORA FINAL DE LA ACTIVIDAD DEBE SER MAYOR A LA HORA INICIAL DE LA ACTIVIDAD
function controlhoras( tf , ti )
{
var ubf = tf.indexOf(":");
var ubi = ti.indexOf(":");

var h1  = tf.substr(0, ubf);
var h2  = ti.substr(0, ubi);

var m1  = tf.substr(ubf + 1);
var m2  = ti.substr(ubi + 1);

if( Number(h1) == Number(h2) )
{
//si las horas son iguales validamos los minutos
if( Number(m1) == Number(m2) )
{
//si los minutos son iguales no haremos nada ya que el resultado sera cero
}
else
{
if (tf.indexOf(':', 0) == -1)
{ alert("Hora final inv\u00e1lida. Formato correcto : 23:59");}
else
{
if( Number(m2) > Number(m1) )
{


//***************VALIDACION DE LOS DOS PUNTOS EN HORA FINAL*************************
var pointF=tf;
var n1 = pointF.indexOf(":",0);
var n2 = pointF.indexOf(":",1);
var n3 = pointF.indexOf(":",3);
var n4 = pointF.indexOf(":",4);

if( ( n1 != 0 && n1 != 1 && n1 != 3 && n1 != 4 ) && ( n2 != 1 && n2 != 3 && n2 != 4 ) && ( n3 != 3 && n3 != 4 ) && ( n4 != 4 ) )
{
alert("Error la hora final debe ser mayor que la hora inicial");
}
else
{
alert("Hora final inv\u00e1lida. Formato correcto  23:59");
return false;
} 


//**************FIN VALIDACION DE DOS PUNTOS EN HORA FINAL**************************

}
}
}
}
else
{
if (tf.indexOf(':', 0) == -1)
{ alert("Hora final inv\u00e1lida. Formato correcto : 23:59"); }
else
{
//SI LAS HORAS NO SON IGUALES VALIDAMOS QUE LA HORA FINAL SEA MAYOR Q LA INICIAL
if( Number(h2) > Number(h1) )
{

//***************VALIDACION DE LOS DOS PUNTOS EN HORA FINAL*************************
var pointF=tf;
var n1 = pointF.indexOf(":",0);
var n2 = pointF.indexOf(":",1);
var n3 = pointF.indexOf(":",3);
var n4 = pointF.indexOf(":",4);

if( ( n1 != 0 && n1 != 1 && n1 != 3 && n1 != 4 ) && ( n2 != 1 && n2 != 3 && n2 != 4 ) && ( n3 != 3 && n3 != 4 ) && ( n4 != 4 ) )
{
alert("Error la hora final debe ser mayor que la hora inicial");
}
else
{
alert("Hora final inv\u00e1lida. Formato correcto  23:59");
return false;
} 


//**************FIN VALIDACION DE DOS PUNTOS EN HORA FINAL**************************

}
}
}
}


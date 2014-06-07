<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" type="text/javascript" src="../../../../js/seguridad.js"></script>
<script language="javascript" type="text/javascript" src="../../../../js/formularios.js"></script>
<link href="../../../../estilo/final_reportes.css" rel="stylesheet" type="text/css" />
<link href="../../../../estilo/estiloformularios.css" rel="stylesheet" type="text/css" />

<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Reporte Mensual</title>

<!--Hoja de estilos del calendario --------------------------------------------------------------------->
<link rel="stylesheet" type="text/css" media="all" href="../../../../js/calendario/calendar-blue2.css" title="win2k-cold-1" />
<!-- librería principal del calendario -->
<script type="text/javascript" src="../../../../js/calendario/calendar.js"></script>
<!-- librería para cargar el lenguaje deseado -->
<script type="text/javascript" src="../../../../js/calendario/lang/calendar-es.js"></script>
<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código -->
<script type="text/javascript" src="../../../../js/calendario/calendar-setup.js"></script>
<!--Hoja de estilos del calendario --------------------------------------------------------------------->

<script type="text/javascript" src="../../../../js/ajax.js"></script>

<script type="text/javascript">
objetoAjax.prototype.micompletar=micompletar;
objetoAjax.prototype.micompletar2=micompletar2;
objetoAjax.prototype.micompletar3=micompletar3;

function micompletar(forma)
{// 2)realiza la primera llamada al query dependiendo q se selecciono
var varea=forma.area;
// muestra el complemento de la url
this.curl="?COD="+varea.options[varea.selectedIndex].value;
//alert('COMPLEMENTO DE URL: \n\r'+this.curl);
this.ejecutar();//ejecuta la llamada
}

function muestraResultado()
{
if(this.readyState == 4)
{
if(this.status == 200)
{
var texto=this.responseText;
divTabla=window.document.getElementById('prueba'); //3)muestra el resultado en este id
divTabla.innerHTML=texto;
}
}
}

function micompletar2(forma)
{// 2)realiza la primera llamada al query dependiendo q se selecciono
var vreporte=forma.reporte;
// muestra el complemento de la url
this.curl="?reporte="+vreporte.options[vreporte.selectedIndex].value;
//alert('COMPLEMENTO DE URL: \n\r'+this.curl);
this.ejecutar();//ejecuta la llamada
}

function muestraResultado2()
{
if(this.readyState == 4)
{
if(this.status == 200)
{
var texto=this.responseText;
divTabla=window.document.getElementById('nuevo'); //3)muestra el resultado en este id
divTabla.innerHTML=texto;
}
}
}


function micompletar3(forma)
{// 2)realiza la primera llamada al query dependiendo q se selecciono
var varea=forma.area;
var vcolaborador=forma.colaborador;
var vclasificacion=forma.clasificacion;
var vinicio=forma.inicio;
var vfin=forma.fin;
// muestra el complemento de la url
this.curl="?area="+varea.options[varea.selectedIndex].value+"&colaborador="+vcolaborador.options[vcolaborador.selectedIndex].value+"&clasificacion="+vclasificacion.options[vclasificacion.selectedIndex].value+"&inicio="+vinicio.value+"&fin="+vfin.value;
//alert('COMPLEMENTO DE URL: \n\r'+this.curl);
this.ejecutar();//ejecuta la llamada
}

function muestraResultado3()
{
if(this.readyState == 4)
{
if(this.status == 200)
{
var texto=this.responseText;
divTabla=window.document.getElementById('mostrar_proyectos'); //3)muestra el resultado en este id
divTabla.innerHTML=texto;
}
}
}


var mitablajax=new objetoAjax('GET','consultaajax.php',muestraResultado);
window.onload=function () {mitablajax.micompletar(window.document.forms["criterios"]);}

var mitablajax2=new objetoAjax('GET','colaborador_4_ajax.php',muestraResultado2);
window.onload=function () {mitablajax2.micompletar2(window.document.forms["criterios"]);}

var mitablajax3=new objetoAjax('GET','colaborador_4_proyectos_ajax.php',muestraResultado3);
window.onload=function () {mitablajax3.micompletar3(window.document.forms["criterios"]);}

</script>

</head>

<body>

<?php

//Verificamos que el usuario haya iniciado sesion
session_start();
if($_SESSION['user']=="")
{
header ("Location: ../../../../index.php");
}

//RECUPERAMOS LAS VARIABLES OBTENIDAS DE LA SELECCION DEL PERIODO PARA EL AST

//$inicio=$_SESSION['colaborador_inicio'];
//$fin=$_SESSION['colaborador_fin'];
//$area=$_SESSION['colaborador_area'];
//$colaborador=$_SESSION['colaborador_usuario'];

//--------------------------------------------------------------------------

$userid=$_SESSION['user'];
include '../../../../config/db.php';

//guardar la conexion realizada al servidor de bases de datos en una variable
$conexion=mysql_connect($servidor,$usuario,$contra) or die(mysql_error());

//verificar si la conexion se realizo con exito
if(!$conexion)
{
die("No se pudo conectar");
}
//Seleccionar la base de datos a las que nos conectaremos
$bd=mysql_select_db($nombre_bd,$conexion) or die(mysql_error());

$colaborador=$_SESSION['user'];
/*
$sql="select * from usuarios where user='$colaborador' ";
$result = mysql_query($sql,$conexion);
$fila=mysql_fetch_array($result);

$sql1="SELECT * FROM ast WHERE usuario='$colaborador' AND fecha BETWEEN '$inicio' AND '$fin' ";
$result1 = mysql_query($sql1,$conexion);
*/
?>

<div id="contenedor">
<div id="encabezadologin" style="height: 84px">

<div id="logo">
<div id="logoimagen">
<img src="../../../../imagenes/sites.png" alt="sites"/>
</div>
<div id="textologo">
<p>Shared IT Enterprise Services</p>
</div>
</div>

<div id="astdes">
<p>Resumen de proyectos por colaborador</p>
</div>
</div>

<!--
<div id="contedatos">
<div id="contelinea">
<div id="conteizquierda">
<p>
<b> <span class="auto-style2">&Aacute;rea </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     :
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo $fila['area']; ?>
</b>
</p>
</div>
<div id="contederecha">
<p>
<b> <span class="auto-style2">Posici&oacute;n</span> :
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo $fila['puesto']; ?>
</b>
</p>
</div>
</div>

<div id="contelinea">
<div id="conteizquierda">
<p>
<b> <span class="auto-style2">Nombre</span> &nbsp;:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo $fila['nombre']; echo " "; echo $fila['apellido']; ?>
</b>
</p>
</div>
<div id="contederecha">
<p>
<b> <span class="auto-style2">Periodo</span> :
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo $inicio; ?>&nbsp;&nbsp; al &nbsp;&nbsp; <?php echo $fin; ?>
</b>
</p>
</div>
</div>
</div>

-->

<form name="sesiones4" target="_blank" action="colaborador_procesar.php" method="post" onsubmit="return reporte_colaborador_admin(this)" >

<div id="cajasrevisar"  >

<div id="textosrevisar">
<p><b>Seleccione el &aacute;rea :</b></p>
</div>
<div id="selecttexrevisar">
<select name="area" size="1" onclick="mitablajax.micompletar(this.form);" onchange="mitablajax3.micompletar3(this.form);" style="width: 160px">

<option value="">Seleccione una opci&oacute;n</option>
<option value="general">General</option>
<?php
$sqlcorre="select area from usuarios where user='$colaborador' ";
$result2 = mysql_query($sqlcorre,$conexion);
$correlativos1=mysql_fetch_array($result2);
$correlativos2=$correlativos1['area'];
echo "<option value=".$correlativos2.">".$correlativos2."</option>";

?>


</select>
</div>

<div id="otrotextos" style="width: 21%">
<p><b>Seleccionar colaborador :</b></p>
</div>
<div class="otrosele" style="width: 16%">
<select id="prueba" name="colaborador" size="1" onchange="mitablajax3.micompletar3(this.form);">
<option value="">Colaboradores</option>
</select>
</div>


<div id="textosrevisar" style="width: 12%">
<p><b>Clasificaci&oacute;n :</b></p>
</div>
<div id="selecttexrevisar" style="width: 8%">
<select name="clasificacion" size="1" style="width: 77px" onchange="mitablajax3.micompletar3(this.form);">
<option value="IS">IS</option>
<option value="IT">IT</option>
</select>
</div>


</div>


<div id="cajasrevisar"  >

<div id="textosrevisar">
<p><b>Inicio de periodo :</b></p>
</div>

<div id="selecttexrevisar" style="width: 14%">
<input type="text" name="inicio" id="campo_fecha" style="text-align:center; width: 137px;" value="" onkeypress="return acceptNumhorasNada4(event)" style="width: 141px" onchange="mitablajax3.micompletar3(this.form);" /></div>
<div id="calendario">
<input type="image" src="../../../../imagenes/calendar.png" id="lanzador" alt="Calendario"/>
</div>



<div id="otrotextos" style="width: 20%">
<p><b>Fin de periodo :</b></p>
</div>
<div class="otrosele" style="width: 16%">
<input type="text" name="fin" id="campo_fecha2" style="text-align:center; width: 155px;" value="" onkeypress="return acceptNumhorasNada4(event)" style="width: 141px" onchange="mitablajax3.micompletar3(this.form);" /></div>
<div id="calendario">
<input type="image" src="../../../../imagenes/calendar.png" id="lanzador2" alt="Calendario"/>
</div>


</div>

</form>




<div id="linea"></div>

<!--

<div id="grafico2">
<iframe frameborder="0" width="770px" height="470px" src="colaborador_4_actividades.php">
</iframe>
</div>

-->

<div id="mostrar_proyectos">

</div>

</div>

<!-- script que define y configura el calendario-->
<script type="text/javascript">
Calendar.setup({
inputField     :    "campo_fecha",     // id del campo de texto
ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto
button     :    "lanzador"     // el id del botón que lanzará el calendario
});
</script>

<!-- script que define y configura el calendario-->
<script type="text/javascript">
Calendar.setup({
inputField     :    "campo_fecha2",     // id del campo de texto
ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto
button     :    "lanzador2"     // el id del botón que lanzará el calendario
});
</script>


</body>
</html>

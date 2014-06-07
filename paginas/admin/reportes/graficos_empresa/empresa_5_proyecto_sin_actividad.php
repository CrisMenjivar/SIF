<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" type="text/javascript" src="../../../../js/formularios.js"></script>

<script language="javascript" type="text/javascript" src="../../../../js/seguridad.js"></script>

<link href="../../../../estilo/final_reportes.css" rel="stylesheet" type="text/css" />
<link href="../../../../estilo/estiloformularios.css" rel="stylesheet" type="text/css" />

<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Reporte de proyectos sin actividad</title>

<script type="text/javascript" src="../../../../js/ajax.js"></script>

<script type="text/javascript">
objetoAjax.prototype.micompletar=micompletar;

function micompletar(forma)
{// 2)realiza la primera llamada al query dependiendo q se selecciono
var vrango=forma.rango;
var vempresa=forma.empresa;
// muestra el complemento de la url
this.curl="?empresa="+vempresa.options[vempresa.selectedIndex].value+"&rango="+vrango.options[vrango.selectedIndex].value;
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
divTabla=window.document.getElementById('ejecutar'); //3)muestra el resultado en este id
divTabla.innerHTML=texto;
}
}
}


var mitablajax=new objetoAjax('GET','empresa_5_ajax.php',muestraResultado);
window.onload=function () {mitablajax.micompletar(window.document.forms["criterios"]);}


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
<p>Reporte de proyectos sin actividad</p>
</div>
</div>

<form name="sesiones4" target="_blank" action="colaborador_procesar.php" method="post" onsubmit="return reporte_colaborador_admin(this)" >

<div id="cajasrevisar"  >

<div id="textosrevisar" style="margin-left:150px">
<p><b>Seleccione el &aacute;rea :</b></p>
</div>
<div id="selecttexrevisar" style="width: 17%">
<select name="empresa" size="1" style="width: 170px"  onchange="mitablajax.micompletar(this.form);" >
<?php
$sqlcorre="select * from empresas where estado='a'";
$result2 = mysql_query($sqlcorre,$conexion);
?>
<option value="">Seleccione una empresa</option>
<option value="general">General</option>
<?php
while ( $correlativos1=mysql_fetch_array($result2) )
{
$correlativos2=$correlativos1['nombre'];
echo "<option value=".$correlativos2.">".$correlativos2."</option>";
}
?>
</select>
</div>

<div id="otrotextos" style="width: 21%">
<p><b>Rango de inactividad :</b></p>
</div>
<div class="otrosele" style="width: 16%">
<select name="rango" size="1" onchange="mitablajax.micompletar(this.form);" >
<option value="1">1 mes</option>
<option value="2">2 meses</option>
<option value="3">3 meses</option>
<option value="4">4 meses</option>
<option value="5">5 meses</option>
<option value="6">6 meses</option>
<option value="7">7 meses</option>
<option value="8">8 meses</option>
<option value="9">9 meses</option>
<option value="10">10 meses</option>
<option value="11">11 meses</option>
<option value="12">12 meses</option>
</select>
</div>


</div>

</form>

<div id="linea"></div>

<div id="ejecutar">

</div>

</div>


</body>
</html>

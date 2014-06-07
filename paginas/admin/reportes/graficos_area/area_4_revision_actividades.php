<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" type="text/javascript" src="../../../../js/formularios.js"></script>

<script language="javascript" type="text/javascript" src="../../../../js/seguridad.js"></script>

<link href="../../../../estilo/estiloformularios.css" rel="stylesheet" type="text/css" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Revisar AST Colaboradores</title>
<!--Hoja de estilos del calendario ---------------------------------------------------------------------> 
<link rel="stylesheet" type="text/css" media="all" href="../../../../js/calendario/calendar-blue2.css" title="win2k-cold-1" /> 
<!-- librería principal del calendario --> 
<script type="text/javascript" src="../../../../js/calendario/calendar.js"></script> 
<!-- librería para cargar el lenguaje deseado --> 
<script type="text/javascript" src="../../../../js/calendario/lang/calendar-es.js"></script> 
<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
<script type="text/javascript" src="../../../../js/calendario/calendar-setup.js"></script>
<!--Hoja de estilos del calendario --------------------------------------------------------------------->

<script type="text/javascript" src="../../../../js/ajax.js">
</script>

<script type="text/javascript">
objetoAjax.prototype.micompletar2=micompletar2;

function micompletar2(forma)
{
var varea=forma.area;
var vfini=forma.finicio;
var vffin=forma.ffinal;
this.curl="?area="+varea.options[varea.selectedIndex].value+"&inicio="+vfini.value+"&final="+vffin.value;
//alert('COMPLEMENTO DE URL: \n\r'+this.curl);
this.ejecutar();
}


function muestraResultado2()
{
if(this.readyState == 4)
{
if(this.status == 200)
{
var texto=this.responseText;
divTabla=window.document.getElementById('tabla');
divTabla.innerHTML=texto;
}
}
}

var mitablajax2=new objetoAjax('GET','datosastajax.php',muestraResultado2);
window.onload=function () {mitablajax2.micompletar2(window.document.forms["criterios"]);}
</script>

</head>

<body>
<?php

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


//Verificamos que el usuario haya iniciado sesion
session_start();
if($_SESSION['user']=="")
{
header ("Location: ../../../../index.php");
}
else
{
$ver=$_SESSION['user'];

$change="select admin from usuarios where user='$ver' ";
$verify = mysql_query($change,$conexion);
$move=mysql_fetch_array($verify);

if($move['admin']=="2")
{
header ("Location: ../../../usuarios/ast.php");
}

if($move['admin']=="3")
{
header ("Location: ../../../jefes/ast.php");
}

if($move['admin']=="4")
{
header ("Location: ../../../jefes_proyectos/ast.php");
}

}//fin else

//------------------------------------------------------------

//pendientes
$sq = "select count(usuario) as tot from excel where usuario='".$_SESSION['user']."' ";
$resP = mysql_query($sq,$conexion);
$resP2=mysql_fetch_array($resP);
$pendientes=$resP2['tot'];

?>


<div id="contenedorotros">
<div id="encabezadologin">

<div id="logo">
<div id="logoimagen">
<img src="../../../../imagenes/sites.png" alt="sites"/>
</div>
<div id="textologo">
<p>Shared IT Enterprise Services</p>
</div>
</div>

<div id="astdes">
<p style="font-size:27px;">Revision de actividades pendientes de correcci&oacute;n</p>
</div>

</div>


<!--INICIO DE LA BARRA DE MENU-->
<div id="conteencabezado">
<div id="cerrar">

</div>
</div>
<!--FIN DE LA BARRA DE MENU -->

<div id="contenedorrevisar">
<form name="sesiones" action="correo.php" method="post" target="_blank" >

<div id="cajasrevisar"  >

<div id="textosrevisar">
<p><b>Seleccione el &aacute;rea :</b></p>
</div>
<div id="selecttexrevisar">
<select name="area" size="1" onchange="mitablajax2.micompletar2(this.form);" style="width: 145px">
<?php
$sqlcorre="select * from area where estado='a'";
$result2 = mysql_query($sqlcorre,$conexion);
?>
<option value="">&Aacute;reas</option>
<?php
while ( $correlativos1=mysql_fetch_array($result2) )
{
$correlativos2=$correlativos1['codigo'];
echo "<option value=".$correlativos2.">".$correlativos2."</option>";
}
?>
</select>
</div>

</div>


<div id="cajasrevisar">
<div id="textosrevisar">
<p><b>Fecha de inicio :</b></p>
</div>
<div id="periodocaja" style="width: 14%">
<input type="text" style="text-align:center;" name="finicio" id="fecha_inicio" onchange="mitablajax2.micompletar2(this.form);" onkeypress="return acceptNumhorasNada(event)" />
</div>

<div id="calendario">
<input type="image" src="../../../../imagenes/calendar.png" id="lanzador_inicio" alt="Calendario"/>
</div>

<div id="textosrevisar4">
<p><b>Fecha final :</b></p>
</div>
<div id="periodocaja" style="width: 14%">
<input type="text" style="text-align:center;" name="ffinal" id="fecha_fin" onchange="mitablajax2.micompletar2(this.form);" onkeypress="return acceptNumhorasNada(event)"/>
</div>

<div id="calendario">
<input type="image" src="../../../../imagenes/calendar.png" id="lanzador_fin" alt="Calendario"/>
</div>


</div>

</form>
</div>

<div id="tabla">
</div>

<div id="error">
</div>
<div id="conteencabezado" style="margin-top:30px;"></div>
</div>

<!-- script que define y configura el calendario--> 
<script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "fecha_inicio",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador_inicio"     // el id del botón que lanzará el calendario 
}); 
</script> 

<!-- script que define y configura el calendario--> 
<script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "fecha_fin",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador_fin"     // el id del botón que lanzará el calendario 
}); 
</script> 

</body>

</html>

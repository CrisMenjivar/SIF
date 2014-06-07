<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" type="text/javascript" src="../../../js/formularios.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/seguridad.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/astnuevos.js"></script>
<link href="../../../estilo/estiloformularios.css" rel="stylesheet" type="text/css" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Sin título 1</title>
<base target="_parent" />

<!--Hoja de estilos del calendario --------------------------------------------------------------------->
<link rel="stylesheet" type="text/css" media="all" href="../../../js/calendario/calendar-blue2.css" title="win2k-cold-1" />
<!-- librería principal del calendario -->
<script type="text/javascript" src="../../../js/calendario/calendar.js"></script>
<!-- librería para cargar el lenguaje deseado -->
<script type="text/javascript" src="../../../js/calendario/lang/calendar-es.js"></script>
<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código -->
<script type="text/javascript" src="../../../js/calendario/calendar-setup.js"></script>
<!--Hoja de estilos del calendario --------------------------------------------------------------------->


</head>

<!--codigo de ajax para seleccionar el proyecto--------------------------------------------->

<script language="javascript" type="text/javascript" src="../../../js/ajax.js">
</script>

<script language="javascript" type="text/javascript">
objetoAjax.prototype.micompletar=micompletar;
objetoAjax.prototype.micompletar2=micompletar2;
objetoAjax.prototype.micompletar3=micompletar3;

function micompletar(forma)
{// 2)realiza la primera llamada al query dependiendo q se selecciono
//var vempresa=forma.opcion1;
var voperacion=forma.opcion20;
// muestra el complemento de la url
//this.curl="?empresa="+vempresa.options[vempresa.selectedIndex].value;
this.curl="?coor="+voperacion.options[voperacion.selectedIndex].value;

//alert('COMPLEMENTO DE URL: \n\r'+this.curl);
this.ejecutar();//ejecuta la llamada
}

function micompletar2(forma)
{
var varea=forma.opcion2;
var vempresa=forma.opcion1;
this.curl="?empresa="+vempresa.options[vempresa.selectedIndex].value+"&area="+varea.options[varea.selectedIndex].value;
//alert('COMPLEMENTO DE URL: \n\r'+this.curl);
this.ejecutar();
}

function micompletar3(forma)
{// 2)realiza la primera llamada al query dependiendo q se selecciono
var vproyecto=forma.opciones;
// muestra el complemento de la url
this.curl="?proyecto="+vproyecto.options[vproyecto.selectedIndex].value;
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
divTabla=window.document.getElementById('res_uno'); //3)muestra el resultado en este id
divTabla.innerHTML=texto;
}
}
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

function muestraResultado3()
{
if(this.readyState == 4)
{
if(this.status == 200)
{
var texto=this.responseText;
divTabla=window.document.getElementById('bloque'); //3)muestra el resultado en este id
divTabla.innerHTML=texto;
}
}
}

var mitablajax=new objetoAjax('GET','area_ajax.php',muestraResultado);
var mitablajax2=new objetoAjax('GET','proyecto_ajax.php',muestraResultado2);
var mitablajax3=new objetoAjax('GET','mod_ajax.php',muestraResultado3);

window.onload=function () {mitablajax.micompletar(window.document.forms["criterios"]);}
window.onload=function () {mitablajax2.micompletar2(window.document.forms["criterios"]);}
window.onload=function () {mitablajax3.micompletar3(window.document.forms["criterios"]);}


</script>

<!--FIN DEL CODIGO DE AJAX--------------------------------------------------------------------->


<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px;">

<?php

include '../../../config/db.php';

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
header ("Location: ../../../index.php");
}
else
{
$ver=$_SESSION['user'];

$change="select admin from usuarios where user='$ver' ";
$verify = mysql_query($change,$conexion);
$move=mysql_fetch_array($verify);

if($move['admin']=="2")
{
header ("Location: ../../usuarios/ast.php");
}

if($move['admin']=="3")
{
header ("Location: ../../jefes/ast.php");
}

if($move['admin']=="4")
{
header ("Location: ../../jefes_proyectos/ast.php");
}

}//fin else


//recuperamos los datos del proyecto a modificar
$nombre=$_SESSION['mod_proyecto'];
$opciones=$_SESSION['mod_opciones'];

if($nombre!="")
{

$sqldepartamento="select * from proyectos where correlativo='$nombre'";
$result2 = mysql_query($sqldepartamento,$conexion);
$datos=mysql_fetch_array($result2);

?>

<form name="sesiones" target="_parent" action="modificar_procesar.php" method="post" onsubmit="return validarproyectomodificar(this)" >

<input type="hidden" name="opciones" value="<?php echo $opciones; ?>" />

<div id="contenedorform" style="left: 0px; top: 0px; height:auto;box-shadow:none;overflow:hidden;">

<div id="encabezado" style="border-radius:0px;">
<p>---------------- Datos del proyecto a modificar ----------------</p>
</div>
<div id="cajas" >
<div id="selecttex">
<select name="opcion1" disabled="disabled" size="1" onchange="mitablajax.micompletar(this.form);">
<?php
$sqlcorre="select * from empresas where estado='a' ";
$result2 = mysql_query($sqlcorre,$conexion);
?>
<option value="<?php echo $datos['empresa']; ?>"><?php echo $datos['empresa']; ?></option>
<?php
while ( $correlativos1=mysql_fetch_array($result2) )
{
$correlativos2=$correlativos1['nombre'];
echo "<option value=".$correlativos2.">".$correlativos2."</option>";
}
?>
</select>
</div>
<div id="textos">
<p><b>Proyecto para :</b></p>
</div>
</div>

<div id="cajas" >
<div id="selecttex">
<select name="opcion2" disabled="disabled" size="1" onchange="mitablajax2.micompletar2(this.form);" >
<?php
$sql2="select * from area where estado='a' ";
$result2 = mysql_query($sql2,$conexion);
?>
<!-- <option value="<?php echo $datos['area']; ?>"><?php echo $datos['area']; ?></option> -->
<?php
while ( $areas=mysql_fetch_array($result2) )
{
$area=$areas['codigo'];
$name=$areas['nombre'];

if($datos['area']==$area)
{
echo '<option selected="selected" value="'.$area.'">'.$area." - ".$name."</option>";
}
else
{
echo "<option value=".$area.">".$area." - ".$name."</option>";

}
}
?>
</select>
</div>
<div id="textos">
<p><b>&Aacute;rea del proyecto :</b></p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text"  name="codigosss" disabled="disabled" value="<?php echo $datos['codigo']; ?>" />
<input type="hidden"  name="correlativo" disabled="disabled" value="<?php echo $datos['correlativo']; ?>" />
</div>
<div id="textos">
<p>Correlativo proyecto :</p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text"  name="nombre" value="<?php echo $datos['nombre']; ?>" />
</div>
<div id="textos">
<p>Nombre proyecto :</p>
</div>
</div>

<div id="cajas" style="height: 50px">
<div id="inputtex" style="height: 48px">
<textarea name="descripcion" style="width: 207px; height: 48px" ><?php echo $datos['descripcionp']; ?></textarea>
</div>
<div id="textos">
<p>Descripci&oacute;n del proyecto :</p>
</div>
</div>



<div id="cajas10"   style="margin-top:20px;">
<div id="selecttex">
<select name="opcion20" size="1" onchange="mitablajax.micompletar(this.form);" >
<?php
$sql2="select * from area where estado='a' ";
$result2 = mysql_query($sql2,$conexion);
?>
<option value="">Seleccione una &aacute;rea</option>
<?php
while ( $areas=mysql_fetch_array($result2) )
{
$area=$areas['codigo'];
$name=$areas['nombre'];
echo "<option value=".$area.">".$area." - ".$name."</option>";
}
?>
</select>
</div>
<div id="textos">
<p><b>&Aacute;rea del coordinador :</b></p>
</div>
</div>


<!--  INICIO DE LA DIVISION PARA CARGAR LOS USUARIOS SEGUN EL AREA ELEGIDA -->

<div id="res_uno">

<div id="cajas" >
<div id="selecttex">
<select name="coordinador" size="1">

<option value="<?php echo $datos['coordinador']; ?>"><?php echo $datos['coordinador']; ?></option>
<!--
<?php
$sql2="select * from usuarios where estado='a'";
$result2 = mysql_query($sql2,$conexion);

while ( $name=mysql_fetch_array($result2) )
{
$names=$name['user'];
echo "<option value=".$names.">".$names."</option>";
}
?>
-->

</select>
</div>
<div id="textos">
<p><b>Coordinador proyecto :</b></p>
</div>
</div>

</div>
<!--FIN DE DIV RES_UNO -->
<!--
<div id="cajas">
<div id="inputtex">
<input type="date"  name="inicio" value="<?php echo $datos['finicio']; ?>" />
</div>
<div id="textos">
<p>Fecha de inicio :</p>
</div>
</div>
-->
<div id="cajas">
<div id="textos" style="float:left;">
<p>Fecha de inicio :</p>
</div>

<div id="inputtex" style="width: 36%;float:left;margin-right:2px;margin-left:13px;">
<input type="text" id="fecha_inicio"  name="inicio" value="<?php echo $datos['finicio']; ?>" style="text-align:center;" onkeypress="return acceptNumhorasNada(event)"/>
</div>
<div id="calendario">
<input type="image" src="../../../imagenes/calendar.png" id="lanzador_inicio" alt="Calendario"/>
</div>

</div>

<!--
<div id="cajas">
<div id="inputtex">
<input type="date"  name="fin" value="<?php echo $datos['fcierre']; ?>"  />
</div>
<div id="textos">
<p>Fecha de fin :</p>
</div>
</div>
-->
<div id="cajas">
<div id="textos" style="float:left;">
<p>Fecha de fin :</p>
</div>

<div id="inputtex" style="width: 36%;float:left;margin-right:2px;margin-left:13px;">
<input type="text" id="fecha_fin" name="fin" value="<?php echo $datos['fcierre']; ?>" style="text-align:center;" onkeypress="return acceptNumhorasNada(event)" />
</div>

<div id="calendario">
<input type="image" src="../../../imagenes/calendar.png" id="lanzador_fin" alt="Calendario"/>
</div>

</div>


<!--
<div id="cajas">
<div id="inputtex">
<input type="date"  name="cierre" value="<?php echo $datos['freal']; ?>"  />
</div>
<div id="textos">
<p>Fecha real de cierre :</p>
</div>
</div>
-->
<div id="cajas">

<div id="textos" style="float:left;">
<p>Fecha real de cierre :</p>
</div>

<div id="inputtex" style="width: 36%;float:left;margin-right:2px;margin-left:13px;">
<input type="text" disabled="disabled" id="fecha_cierre"  name="cierress" value="<?php echo $datos['freal']; ?>" onkeypress="return acceptNumhorasNada(event)" style="text-align:center;" />
</div>

<input type="hidden" name="cierre" value="<?php echo $datos['freal']; ?>" />


<div id="calendario">
<input type="image" src="../../../imagenes/calendar.png" id="lanzador_cierre" alt="Calendario" disabled="disabled"/>
</div>

</div>


<div id="cajas">
<div id="inputtex">
<input type="text"  name="anio" value="<?php echo $datos['year']; ?>" />
</div>
<div id="textos">
<p>A&ntilde;o de apertura  :</p>
</div>
</div>

<div id="cajasbotom">
<div id="inputbotom">
<input type="submit" value="Modificar proyecto"/>
</div>
</div>

</div>

</form>
<?php
}
else
{
?>

<form name="sesiones1" target="_parent" action="modificar_procesar.php" method="post" onsubmit="return validarproyectomodificar(this)" >

<div id="contenedorform" style="left: 0px; top: 0px; height: 625px">

<div id="encabezado">
<p>---------------- Datos del proyecto a modificar ----------------</p>
</div>
<div id="cajas" >
<div id="selecttex">
<select name="opcion1" size="1" onchange="mitablajax.micompletar(this.form);">
</select>
</div>
<div id="textos">
<p><b>Proyecto para :</b></p>
</div>
</div>

<div id="cajas" >
<div id="selecttex">
<select name="opcion2" size="1" onchange="mitablajax2.micompletar2(this.form);" >
</select>
</div>
<div id="textos">
<p><b>&Aacute;rea del proyecto :</b></p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text" disabled="disabled"  name="correlativo" disabled="disabled" value="" />
</div>
<div id="textos">
<p>Correlativo proyecto :</p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text" disabled="disabled" name="nombre" value="" />
</div>
<div id="textos">
<p>Nombre proyecto :</p>
</div>
</div>

<div id="cajas" style="height: 50px">
<div id="inputtex" style="height: 48px">
<textarea name="descripcion" disabled="disabled" style="width: 207px; height: 48px" ></textarea>
</div>
<div id="textos">
<p>Descripci&oacute;n del proyecto :</p>
</div>
</div>


<div id="cajas" >
<div id="selecttex">
<select name="coordinador" size="1">
</select>
</div>
<div id="textos">
<p><b>Coordinador proyecto :</b></p>
</div>
</div>

<!--
<div id="cajas">
<div id="inputtex">
<input type="date"  name="inicio" value="" disabled="disabled" />
</div>
<div id="textos">
<p>Fecha de inicio :</p>
</div>
</div>
-->
<div id="cajas">
<div id="textos" style="float:left;">
<p>Fecha de inicio :</p>
</div>

<div id="inputtex" style="width: 36%;float:left;margin-right:2px;margin-left:13px;">
<input type="text" id="fecha_inicio"  name="inicio" value="" style="text-align:center;" onkeypress="return acceptNumhorasNada(event)"/>
</div>
<div id="calendario">
<input type="image" src="../../../imagenes/calendar.png" id="lanzador_inicio" alt="Calendario"/>
</div>

</div>

<!--
<div id="cajas">
<div id="inputtex">
<input type="date"  name="fin" value="" disabled="disabled"  />
</div>
<div id="textos">
<p>Fecha de fin :</p>
</div>
</div>
-->
<div id="cajas">
<div id="textos" style="float:left;">
<p>Fecha de fin :</p>
</div>

<div id="inputtex" style="width: 36%;float:left;margin-right:2px;margin-left:13px;">
<input type="text" id="fecha_fin" name="fin" value="" style="text-align:center;" onkeypress="return acceptNumhorasNada(event)" />
</div>

<div id="calendario">
<input type="image" src="../../../imagenes/calendar.png" id="lanzador_fin" alt="Calendario"/>
</div>

</div>

<!--
<div id="cajas">
<div id="inputtex">
<input type="date"  name="cierre" value="" disabled="disabled"  />
</div>
<div id="textos">
<p>Fecha real de cierre :</p>
</div>
</div>
-->
<div id="cajas">

<div id="textos" style="float:left;">
<p>Fecha real de cierre :</p>
</div>

<div id="inputtex" style="width: 36%;float:left;margin-right:2px;margin-left:13px;">
<input type="text" disabled="disabled" id="fecha_cierre"  name="cierress" value="0000-00-00" onkeypress="return acceptNumhorasNada(event)" style="text-align:center;" />
</div>

<input type="hidden" name="cierre" value="0000-00-00" />


<div id="calendario">
<input type="image" src="../../../imagenes/calendar.png" id="lanzador_cierre" alt="Calendario" disabled="disabled"/>
</div>

</div>



<div id="cajas">
<div id="inputtex">
<input type="text"  name="anio" value="" disabled="disabled" />
</div>
<div id="textos">
<p>A&ntilde;o de apertura  :</p>
</div>
</div>

<div id="cajasbotom">
<div id="inputbotom">
<input type="submit" disabled="disabled" value="Modificar proyecto"/>
</div>
</div>

</div>

</form>
<?php
}
?>

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

<!-- script que define y configura el calendario-->
<script type="text/javascript">
Calendar.setup({
inputField     :    "fecha_cierre",     // id del campo de texto
ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto
button     :    "lanzador_cierre"     // el id del botón que lanzará el calendario
});
</script>


</body>

</html>

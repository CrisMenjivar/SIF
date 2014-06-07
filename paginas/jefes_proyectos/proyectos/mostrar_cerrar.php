<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<script language="javascript" type="text/javascript" src="../../../js/formularios.js"></script>

<script language="javascript" type="text/javascript" src="../../../js/seguridad.js"></script>

<script language="javascript" type="text/javascript" src="../../../js/astnuevos.js"></script>
<link href="../../../estilo/estiloformularios.css" rel="stylesheet" type="text/css" />
<title>Sin título 1</title>

<!--Hoja de estilos del calendario --------------------------------------------------------------------->
<link rel="stylesheet" type="text/css" media="all" href="../../../js/calendario/calendar-blue2.css" title="win2k-cold-1" />
<!-- librería principal del calendario -->
<script type="text/javascript" src="../../../js/calendario/calendar.js"></script>
<!-- librería para cargar el lenguaje deseado -->
<script type="text/javascript" src="../../../js/calendario/lang/calendar-es.js"></script>
<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código -->
<script type="text/javascript" src="../../../js/calendario/calendar-setup.js"></script>
<!--Hoja de estilos del calendario --------------------------------------------------------------------->

<base target="_parent" />

</head>

<body>
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

if($move['admin']=="1")
{
header ("Location: ../../admin/menuadmin.php");
}

}//fin else


//recuperamos los datos del proyecto a modificar
$nombre=$_SESSION['cerrar_proyecto'];
$opciones=$_SESSION['cerrar_opciones'];


$sqldepartamento="select * from proyectos where correlativo='$nombre'";
$result2 = mysql_query($sqldepartamento,$conexion);
$datos=mysql_fetch_array($result2);

?>

<form name="sesiones" target="_parent" action="cerrar_procesar.php" method="post" onsubmit="return validarproyectocerrar(this)" >

<input type="hidden" name="opciones" value="<?php echo $opciones; ?>" />
<div id="contenedorform" style="box-shadow:none;height:auto;overflow:hidden;">

<div id="encabezado" style="border-radius:0px;">
<p>---------------- Datos del proyecto a cerrar ----------------</p>
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
<option value="<?php echo $datos['area']; ?>"><?php echo $datos['area']; ?></option>
<?php
while ( $areas=mysql_fetch_array($result2) )
{
$area=$areas['codigo'];
echo "<option value=".$area.">".$area."</option>";
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
<input type="text"  name="correlativo" disabled="disabled" value="<?php echo $datos['codigo']; ?>" />
</div>
<div id="textos">
<p>Correlativo proyecto :</p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text"  disabled="disabled" name="nombre" value="<?php echo $datos['nombre']; ?>" />
</div>
<div id="textos">
<p>Nombre proyecto :</p>
</div>
</div>

<div id="cajas" style="height: 50px">
<div id="inputtex" style="height: 48px">
<textarea name="descripcion" disabled="disabled" style="width: 207px; height: 48px" ><?php echo $datos['descripcionp']; ?></textarea>
</div>
<div id="textos">
<p>Descripci&oacute;n del proyecto :</p>
</div>
</div>


<div id="cajas" >
<div id="selecttex">
<select name="coordinador" size="1" disabled="disabled" >
<?php
$sql2="select * from usuarios where estado='a'";
$result2 = mysql_query($sql2,$conexion);
?>
<option value="<?php echo $datos['coordinador']; ?>"><?php echo $datos['coordinador']; ?></option>
<?php

while ( $name=mysql_fetch_array($result2) )
{
$names=$name['user'];
echo "<option value=".$names.">".$names."</option>";
}
?>
</select>
</div>
<div id="textos">
<p><b>Coordinador proyecto :</b></p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="date"  name="inicio" disabled="disabled" value="<?php echo $datos['finicio']; ?>" />
</div>
<div id="textos">
<p>Fecha de inicio :</p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="date"  name="fin" disabled="disabled" value="<?php echo $datos['fcierre']; ?>"  />
</div>
<div id="textos">
<p>Fecha de fin :</p>
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
<input type="text" id="fecha_cierre"  name="cierre" value="<?php echo $datos['freal']; ?>" onkeypress="return acceptNumhorasNada(event)" style="text-align:center;" />
</div>

<div id="calendario">
<input type="image" src="../../../imagenes/calendar.png" id="lanzador_cierre" alt="Calendario" />
</div>

</div>


<div id="cajas">
<div id="inputtex">
<input type="text"  name="anio" disabled="disabled" value="<?php echo $datos['year']; ?>" />
</div>
<div id="textos">
<p>A&ntilde;o de apertura  :</p>
</div>
</div>

<div id="cajasbotom">
<div id="inputbotom">
<input type="submit" value="Cerrar proyecto"/>
</div>
</div>

</div>

</form>

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

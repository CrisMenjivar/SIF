<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" type="text/javascript" src="../../../../js/seguridad.js"></script>
<link href="../../../../estilo/final_reportes.css" rel="stylesheet" type="text/css" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Reporte por empresas</title>

</head>

<body>
<?php

//Verificamos que el usuario haya iniciado sesion
session_start();
if($_SESSION['user']=="")
{
header ("Location: ../../../../index.php");
}

$areass=$_SESSION['empresa_area'];
$finicio=$_SESSION['empresa_inicio'];
$ffin=$_SESSION['empresa_fin'];



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
<div id="encabezadologin" style="height: 81px">

<div id="logo">
<div id="logoimagen">
<img src="../../../../imagenes/sites.png" alt="sites"/>
</div>
<div id="textologo">
<p>Shared IT Enterprise Services</p>
</div>
</div>

<div id="astdes">
<p>Utilizaci&oacute;n del tiempo general -- <?php echo $areass; ?></p>
</div>
</div>

<div id="contedatos" style="height: 37px">

<div id="contelinea">
<div id="contederecha" style="width: 489px">
<p>
<b> <span class="auto-style2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Periodo</span> :
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo $finicio; ?>&nbsp;&nbsp;&nbsp;&nbsp; al &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $ffin; ?>
</b>
</p>
</div>
</div>
</div>

<div id="linea"></div>

<div id="grafico2">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="empresa_1_actividad_grafico.php">
</iframe>
</div>

<div id="grafico2">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="empresa_1_utilizacion_grafico.php">
</iframe>
</div>

<div id="grafico2">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="empresa_1_promedio_grafico.php">
</iframe>
</div>

</div>

</body>
</html>

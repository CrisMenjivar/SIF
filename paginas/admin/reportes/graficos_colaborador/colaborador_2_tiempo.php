<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link href="../../../../estilo/final_reportes.css" rel="stylesheet" type="text/css" />

<script language="javascript" type="text/javascript" src="../../../../js/seguridad.js"></script>

<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Reporte Mensual</title>

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

$inicio=$_SESSION['colaborador_inicio'];
$fin=$_SESSION['colaborador_fin'];
$area=$_SESSION['colaborador_area'];
$colaborador=$_SESSION['colaborador_usuario'];

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

$sql="select * from usuarios where user='$colaborador' ";
$result = mysql_query($sql,$conexion);
$fila=mysql_fetch_array($result);

$sql1="SELECT * FROM ast WHERE usuario='$colaborador' ";
$result1 = mysql_query($sql1,$conexion);

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
<p style="font-size:29px;">Utilizaci&oacute;n del tiempo general por colaborador</p>
</div>
</div>

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

<div id="linea"></div>

<div id="grafico2">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="colaborador_2_actividad_grafico.php">
</iframe>
</div>

<div id="grafico2">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="colaborador_2_empresa_grafico.php">
</iframe>
</div>

<div id="grafico2">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="colaborador_2_utilizacion_grafico.php">
</iframe>
</div>

<div id="grafico2">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="colaborador_2_promedio_grafico.php">
</iframe>
</div>

</div>

</body>
</html>

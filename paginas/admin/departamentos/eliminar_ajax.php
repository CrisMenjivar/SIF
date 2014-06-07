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


//recuperamos los datos del departamento a modificar
$nombre=$_GET['departamento'];

$sqldepartamento="select * from area where codigo='$nombre'";
$result2 = mysql_query($sqldepartamento,$conexion);
$datos=mysql_fetch_array($result2);


if($nombre!="")
{
?>

<div id="contenedorform" style="box-shadow:none;">

<div id="encabezado" style="border-radius:0px;">
<p>---------------------------------------------------------------------------</p>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text"  disabled="disabled" name="nombre" value="<?php echo $datos['nombre']; ?>" />
</div>
<div id="textos">
<p>Nombre<b> Departamento:</b></p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text"  disabled="disabled" name="codigo" value="<?php echo $datos['codigo']; ?>" />
</div>
<div id="textos">
<p>Siglas Departamento :</p>
</div>
</div>


<div id="cajasbotom">
<div id="inputbotom">
<input type="submit" value="Eliminar Departamento"/>
</div>
</div>

</div>

<?php
}
else
{
?>

<div id="contenedorform">

<div id="encabezado">
<p>---------------------------------------------------------------------------</p>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text"  disabled="disabled" name="nombre" value="" />
</div>
<div id="textos">
<p>Nombre<b> Departamento:</b></p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text"  disabled="disabled" name="codigo" value="" />
</div>
<div id="textos">
<p>Siglas Departamento :</p>
</div>
</div>


<div id="cajasbotom">
<div id="inputbotom">
<input type="submit" disabled="disabled" value="Eliminar Departamento"/>
</div>
</div>

</div>

<?php
}
?>


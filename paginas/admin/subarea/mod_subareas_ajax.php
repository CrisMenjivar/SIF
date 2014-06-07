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

/*
$sqldepartamento="select * from subarea where area='$nombre'";
$result2 = mysql_query($sqldepartamento,$conexion);
$datos=mysql_fetch_array($result2);
*/

if( $nombre != "")
{
?>
<div id="cajas" >
<div id="selecttex" style="width: 43%">
<select name="opcion" size="1" onchange="mitablajax.micompletar(this.form);">
<?php
$sqlcorre="select * from subarea where estado='a' and area='$nombre'";
$result2 = mysql_query($sqlcorre,$conexion);
?>
<option value="">Lista de sub-departamentos</option>
<?php
while ( $correlativos1=mysql_fetch_array($result2) )
{
$correlativos2=$correlativos1['codigo'];
$names=$correlativos1['nombre'];

echo "<option value=".$correlativos2.">".$correlativos2." - ".$names."</option>";
}
?>
</select>
</div>
<div id="textos" style="width: 42%">
<p style="font-size:12px;"><b>Seleccionar sub-departamento:</b></p>
</div>
</div>


<?php
}
?>


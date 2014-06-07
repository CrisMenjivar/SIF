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

}//fin else



$area = $_GET['area'];

?>


<div id="cajas" >
<div id="selecttex">
<select name="subarea" size="1">
<?php
$sql2="select * from subarea where estado='a' and area='$area'";
$result2 = mysql_query($sql2,$conexion);
?>
<option value="">Seleccione la sub-&aacute;rea</option>
<?php
while ( $areass=mysql_fetch_array($result2) )
{
$ari=$areass['codigo'];
$name=$areass['nombre'];
$name=strtolower($name);
$name=ucfirst($name);
echo "<option value=".$ari.">".$ari." - ".$name."</option>";
}
?>
</select>
</div>
<div id="textos">
<p><b> Sub-&aacute;rea :</b></p>
</div>
</div>






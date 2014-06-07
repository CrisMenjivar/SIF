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


//recibimos el nombre de la empresa a utilizar para guardar el proyecto
//$empre=$_GET['empresa'];

$area=$_GET['coor'];


?>

<!--
<div id="cajas10"   style="margin-top:20px;">
<div id="selecttex">
<select name="opcion2" size="1" onchange="mitablajax2.micompletar2(this.form);" >
<?php
//$sql2="select * from area where estado='a' ";
//$result2 = mysql_query($sql2,$conexion);
?>
<option value="">Seleccione una Area</option>
<?php
//while ( $areas=mysql_fetch_array($result2) )
//{
//$area=$areas['codigo'];
//echo "<option value=".$area.">".$area."</option>";
//}
?>
</select>
</div>
<div id="textos">
<p><b>&Aacute;rea del Proyecto :</b></p>
</div>
</div>

-->

<div id="cajas" >
<div id="selecttex">
<select name="coordinador" size="1">

<option value="">Seleccione un Coordinador</option>

<?php
$sql2="select * from usuarios where estado='a' and area='$area'";
$result2 = mysql_query($sql2,$conexion);

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



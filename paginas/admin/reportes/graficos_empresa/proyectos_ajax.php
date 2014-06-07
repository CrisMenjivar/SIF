
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

}//fin else



//recuperamos los datos de la empresa a modificar
$nombre=$_GET['empresa'];
$estado=$_GET['estado'];

if( $estado == "abiertos" )
{
$fecha="0000-00-00";
$sqldepartamento="select * from proyectos where correlativo!='NO_ES_PROYECTO' and empresa='$nombre' and freal='$fecha'";

}

if( $estado == "cerrados" )
{
$fecha="0000-00-00";
$sqldepartamento="select * from proyectos where correlativo!='NO_ES_PROYECTO' and empresa='$nombre' and freal!='$fecha'";

}

if( $nombre != "" )
{

?>

<div id="textosrevisar" style="width: 12%">
<p style="width: 122px"><b>Proyecto :</b></p>
</div>

<div id="selecttexrevisar">
<select name="proyec" size="1" style="width: 156px">

<?php 

$result2 = mysql_query($sqldepartamento,$conexion);

while ( $grupos=mysql_fetch_array($result2) )
{
$correlativo=$grupos['correlativo'];
$nombre=$grupos['nombre'];

echo "<option value=".$correlativo.">".$correlativo." -- ".$nombre."</option>";
}
?>

</select>
</div>

<?php
}
else
{
?>

<div id="textosrevisar" style="width: 12%">
<p style="width: 122px"><b>Proyecto :</b></p>
</div>

<div id="selecttexrevisar">
<select name="proyec" size="1" style="width: 156px">

</select>
</div>

<?php
}
//-------------------------------------------------------------------------------------------------------------------
?>



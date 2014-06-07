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
$area=$_GET['area'];

if( $area != "general" )
{

?>

<div id="cajas" style="width: 636px" >
<div id="selecttex" style="width: 64%">
<select name="colaborador" size="1">
<option value="general">General</option>
<?php
$sql2="select user from usuarios where area='$area' ";
$result2 = mysql_query($sql2,$conexion);

while ( $colab=mysql_fetch_array($result2) )
{
$us=$colab['user'];
echo "<option value=".$us.">".$us."</option>";
}
?>
</select>
</div>
<div id="textos" style="width: 23%">
<p>Colaborador :</p>
</div>
</div>

<?php
}
else
{
echo '<input type="hidden" name="colaborador" value="no" />';
}

?>



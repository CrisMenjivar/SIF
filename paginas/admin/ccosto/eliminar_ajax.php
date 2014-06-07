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


//recuperamos los datos de la empresa a modificar
$nombre=$_GET['grupo'];

if($nombre != "")
{
$sqldepartamento="select * from ccosto where codigo='$nombre'";
$result2 = mysql_query($sqldepartamento,$conexion);
$datos=mysql_fetch_array($result2);

?>

<div id="contenedorform">

<div id="encabezado" style="border-radius:0px;">
<p>---------------- Centro de costo a eliminar ----------------</p>
</div>

<div id="cajas">
<div id="inputtex" style="width: 62%">
<input type="text" disabled="disabled"  name="codigo" value="<?php echo $datos['codigo']; ?>" style="width: 94px" class="auto-style1"/>
</div>
<div id="textos" style="width: 24%">
<p style="width: 113px">Codigo CeCo :</p>
</div>
</div>


<div id="cajas">
<div id="inputtex" style="width: 309px;">
<input  style="width: 284px;" type="text" disabled="disabled"  name="nombre" value="<?php echo $datos['nombre']; ?>"/>
</div>
<div id="textos" style="width: 23%">
<p style="width: 103px; font-size:12px;margin-left:10px;">Nombre CeCo :</p>
</div>
</div>

<div id="cajasbotom">
<div id="inputbotom">
<input type="submit" value="Eliminar CeCo"/>
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
<p>---------------- Centro de costo a eliminar ----------------</p>
</div>

<div id="cajas">
<div id="inputtex" style="width: 290px;">
<input style="width: 285px;" type="text"  name="nombre" value="" disabled="disabled"/>
</div>
<div id="textos" style="width: 137px;">
<p style="width: 135px">Centro de costo :</p>
</div>
</div>

<div id="cajasbotom">
<div id="inputbotom">
<input type="submit" disabled="disabled" value="Eliminar CeCo"/>
</div>
</div>

</div>

<?php
}
?>
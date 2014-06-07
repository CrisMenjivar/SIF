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


//recibimos el nombre de la empresa a utilizar para guardar el proyecto
$empre=$_GET['empresa'];
$area=$_GET['area'];
$tipo=$_GET['tipes'];


$sqlsigla="select * from empresas where nombre='$empre'";
$siglass = mysql_query($sqlsigla,$conexion);
$letras=mysql_fetch_array($siglass);
$agregar=$letras['siglas'];

$cuenta="Select COUNT(correlativo) as total from proyectos where empresa='$empre' and tipo='$tipo'";
$cuenta1 = mysql_query($cuenta,$conexion);
$total=mysql_fetch_array($cuenta1);

if( $total['total'] < 999 )
{
if( $total['total'] < 99 )
{
if( $total['total'] < 9 )
{
$num="000";
$var=$total['total'];
$var=$var+1;
$num .= $var;
}
else
{
$num="00";
$var=$total['total'];
$var=$var+1;
$num .= $var;
}
}
else
{
$num="0";
$var=$total['total'];
$var=$var+1;
$num .= $var;
}
}
else
{
$var=$total['total'];
$var=$var+1;
$num .= $var;
}


$codigo="";
$codigo .= $tipo.'-'.$agregar.'-'.$area.'-'.$num;

if( $area != "" )
{
?>

<div id="cajas">
<div id="inputtex">
<input type="text"  disabled="disabled" name="corre" value="<?PHP echo $codigo; ?>" />
<input type="hidden" name="correlativo" value="<?PHP echo $codigo; ?>" />
</div>
<div id="textos">
<p>Correlativo proyecto :</p>
</div>
</div>

<?php
}
else
{
?>
<div id="cajas">
<div id="inputtex">
<input type="text"  disabled="disabled" name="corre" value="" />
<input type="hidden" name="correlativo" value="" />
</div>
<div id="textos">
<p>Correlativo proyecto :</p>
</div>
</div>

<?php

}

?>
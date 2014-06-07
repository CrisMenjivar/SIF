<?php
 
include '../../config/db.php';

//guardar la conexion realizada al servidor de bases de datos en una variable
$conexion=mysql_connect($servidor,$usuario,$contra) or die(mysql_error());

//verificar si la conexion se realizo con exito
if(!$conexion)
{
die("No se pudo conectar");
}
//Seleccionar la base de datos a las que nos conectaremos
$bd=mysql_select_db($nombre_bd,$conexion) or die( mysql_error() );

//$pos = $_GET['variable'];

session_start();
if($_SESSION['user']=="")
{
header ("Location: ../../index.php");
}
else
{
$ver=$_SESSION['user'];

$change="select admin from usuarios where user='$ver' ";
$verify = mysql_query($change,$conexion);
$move=mysql_fetch_array($verify);

if($move['admin']=="3")
{
header ("Location: ../jefes/ast.php");
}

if($move['admin']=="1")
{
header ("Location: ../admin/menuadmin.php");
}

if($move['admin']=="4")
{
header ("Location: ../jefes_proyectos/ast.php");
}

}//fin else

$pos = $_GET['posicion'];
$usuario1 = $_SESSION['user'];
$fecha1 = $_GET['fecha'];
$descripcion1 = $_GET['descripcion'];
$inicio1 = $_GET['inicio'];
$fin1 = $_GET['fin'];

/*
$sql="delete from excel where usuario='$usuario1' and fecha='$fecha1' and descripcion='$descripcion1' and inicio='$inicio1' and fin='$fin1' ";
mysql_query($sql,$conexion);

*/

$textos = mysql_query("SELECT fecha,descripcion,inicio,fin,DAY(fecha) as dia FROM excel WHERE usuario='$usuario1' order by fecha ASC, inicio ASC",$conexion);

for($x = 0 ; $x < mysql_num_rows($textos) ; $x++)
{
$fila = mysql_fetch_assoc($textos);

if( $x == $pos )
{
$fecha=$fila['fecha'];
$descripcion=$fila['descripcion'];
$inicio=$fila['inicio'];
$fin=$fila['fin'];

$sql="delete from excel where fecha='$fecha' and descripcion='$descripcion' and inicio='$inicio' and fin='$fin'";
mysql_query($sql,$conexion);

}


} //fin del for para actualizar el registro seleccionado


$_SESSION['fecha']="";
$_SESSION['descripcion']="";
$_SESSION['inicio']="";
$_SESSION['fin']="";
$_SESSION['check']="100000000000000000000000";

header ("Location: ast_excel.php");

?>


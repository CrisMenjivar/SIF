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

//Verificamos que el usuario haya iniciado sesion
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
//$usuario1 = $_SESSION['user'];
$pos = $_GET['posicion'];
$fecha = $_GET['fecha'];
$descripcion = $_GET['descripcion'];
$actividad = $_GET['actividad'];
$empresa = $_GET['empresa'];
$proyecto = $_GET['proyecto'];
$inicio = $_GET['inicio'];
$fin = $_GET['fin'];
$total = $_GET['total'];


$_SESSION['c_fecha']=$fecha;
$_SESSION['c_descripcion']=$descripcion;
$_SESSION['c_actividad']=$actividad;
$_SESSION['c_empresa']=$empresa;
$_SESSION['c_proyecto']=$proyecto;
$_SESSION['c_inicio']=$inicio;
$_SESSION['c_fin']=$fin;
$_SESSION['c_total']=$total;
$_SESSION['c_check']=$pos;

header ("Location: corregirast.php");


?>

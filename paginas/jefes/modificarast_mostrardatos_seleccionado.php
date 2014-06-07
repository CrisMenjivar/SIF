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

if($move['admin']=="2")
{
header ("Location: ../usuarios/ast.php");
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


$_SESSION['m_fecha']=$fecha;
$_SESSION['m_descripcion']=$descripcion;
$_SESSION['m_actividad']=$actividad;
$_SESSION['m_empresa']=$empresa;
$_SESSION['m_proyecto']=$proyecto;
$_SESSION['m_inicio']=$inicio;
$_SESSION['m_fin']=$fin;
$_SESSION['m_total']=$total;
$_SESSION['m_check']=$pos;

header ("Location: 2_revisarast.php");


?>





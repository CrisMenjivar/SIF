<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title></title>
</head>

<body>
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

if($move['admin']=="3")
{
header ("Location: ../../jefes/ast.php");
}

if($move['admin']=="2")
{
header ("Location: ../../usuarios/ast.php");
}

if($move['admin']=="4")
{
header ("Location: ../../jefes_proyectos/ast.php");
}

}//fin else



//recuperamos los datos que nos envian desde el formulario ast
$user=$_SESSION['user'];
$fecha=$_POST['fecha'];

$descripcion=$_POST['descripcion'];
//$descripcion=strtolower($descripcion);
//$descripcion=ucfirst($descripcion);
//$descripcion=htmlentities($descripcion);
//$descripcion=htmlspecialchars($descripcion);
//$descripcion=strtr($descripcion,'ó','o');

$actividad=$_POST['actividades'];
$empresa=$_POST['empresas'];
$proyecto=$_POST['proyectos'];
$inicio=$_POST['inicios'];
$finales=$_POST['finales'];
$horas=$_POST['horas'];

$opcion=$_POST['pro'];
if($opcion=="NO_ES_PROYECTO")
{
$proyecto="NO_ES_PROYECTO";
}

$fecha21=$_POST['fecha21'];
$descripcion21=$_POST['descripcion21'];
$inicio21=$_POST['inicio21'];
$fin21=$_POST['fin21'];


$boton=$_POST['boton'];

if( $boton == "Guardar actividad" )
{

$query="select count(totalhoras) as total from ast where usuario='$user' and fecha='$fecha' and descripcion='$descripcion' and tipoact='$actividad' and empresa='$empresa' and cproyecto='$proyecto' and inicio='$inicio' and fin='$finales' and  totalhoras='$horas' and estado='a'";
$respuesta=mysql_query($query,$conexion);
$res=mysql_fetch_array($respuesta);
$respuesta=$res['total'];

if( $respuesta == 0 )
{

$sql="INSERT INTO registroast.ast (usuario,fecha,descripcion,tipoact,empresa,cproyecto,inicio,fin,totalhoras,estado,tipo) VALUES ('$user', '$fecha', '$descripcion', '$actividad', '$empresa', '$proyecto', '$inicio', '$finales', '$horas', 'a','o')";

if( mysql_query($sql,$conexion) )
{
$borrar="DELETE from excel where usuario='$user' and fecha='$fecha21' and descripcion='$descripcion21' and inicio='$inicio21' and fin='$fin21' ";
mysql_query($borrar,$conexion) or die ("problema con query");

$_SESSION['fecha']="";
$_SESSION['descripcion']="";
$_SESSION['inicio']="";
$_SESSION['fin']="";
$_SESSION['check']="100000000000000000";

header ("Location: ast_excel.php");
}
else
{

$_SESSION['fecha']="";
$_SESSION['descripcion']="";
$_SESSION['inicio']="";
$_SESSION['fin']="";
$_SESSION['check']="100000000000000000";

?>
<script type="text/javascript">alert("ERROR EN LOS DATOS AL REGISTRAR LA ACTIVIDAD. POR FAVOR INTENTELO NUEVAMENTE");</script>
<script type="text/javascript">
window.location="ast_excel.php";
</script>
<?php
}
}//fin if que evita repetir entradas
else
{

$_SESSION['fecha']="";
$_SESSION['descripcion']="";
$_SESSION['inicio']="";
$_SESSION['fin']="";
$_SESSION['check']="100000000000000000";

?>
<script type="text/javascript">alert("Error actividad duplicada");</script>
<script type="text/javascript">
window.location="ast_excel.php";
</script>
<?php
}

}//fin if q boton se presiono
else
{
$borrar="DELETE from excel where usuario='$user' and fecha='$fecha21' and descripcion='$descripcion21' and inicio='$inicio21' and fin='$fin21' ";
mysql_query($borrar,$conexion) or die ("problema con query");

$_SESSION['fecha']="";
$_SESSION['descripcion']="";
$_SESSION['inicio']="";
$_SESSION['fin']="";
$_SESSION['check']="100000000000000000";

header ("Location: ast_excel.php");

}

?>

</body>

</html>
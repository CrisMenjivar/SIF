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
$bd=mysql_select_db($nombre_bd,$conexion) or die(mysql_error());



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

//recuperamos los datos que nos envian desde el formulario ast
$user=$_SESSION['user'];
$fecha=$_POST['fecha'];

$descripcion=$_POST['descripcion'];
$actividad=$_POST['actividades'];
$empresa=$_POST['empresas'];
$proyecto=$_POST['proyectos'];
$inicio=$_POST['inicios'];
$finales=$_POST['finales'];
$horas=$_POST['horas'];

$opcion=$_POST['pro'];
if($opcion=="99")
{
$proyecto="99";
}

$query="select count(totalhoras) as total from ast where usuario='$user' and fecha='$fecha' and descripcion='$descripcion' and tipoact='$actividad' and empresa='$empresa' and cproyecto='$proyecto' and inicio='$inicio' and fin='$finales' and  totalhoras='$horas' and estado='a'";
$respuesta=mysql_query($query,$conexion);
$res=mysql_fetch_array($respuesta);
$respuesta=$res['total'];

if( $respuesta == 0 )
{

$sql="INSERT INTO registroast.ast (usuario,fecha,descripcion,tipoact,empresa,cproyecto,inicio,fin,totalhoras,estado) VALUES ('$user', '$fecha', '$descripcion', '$actividad', '$empresa', '$proyecto', '$inicio', '$finales', '$horas', 'a')";

if( mysql_query($sql,$conexion) )
{
header ("Location: ast.php");
}
else
{
?>
<script type="text/javascript">alert("Error en los datos de la actividad ingresada por favor intentelo nuevamente");</script>
<script type="text/javascript">
window.location="ast.php";
</script>
<?php
}

}//fin if que evita repetir entradas
else
{
?>
<script type="text/javascript">alert("Error actividad duplicada");</script>
<script type="text/javascript">
window.location="ast.php";
</script>
<?php
}
?>


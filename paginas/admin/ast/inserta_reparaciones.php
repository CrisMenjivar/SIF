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



//recuperamos los datos que nos envian desde el formulario ast
$userupdate=$_POST["usuario1"];

$fechab=$_POST["fecha"];
$descripcionb=$_POST['descripcion'];
$actividadb=$_POST["actividades"];
$empresab=$_POST["empresas"];
$proyectob=$_POST["proyectos"];
$iniciob=$_POST["inicios"];
$finalesb=$_POST["finales"];
$horasb=$_POST["horas"];

$opcion=$_POST['pro'];
if($opcion=="NO_ES_PROYECTO")
{
$proyectob="NO_ES_PROYECTO";
}




$sqlfin = "UPDATE ast SET totalhoras='$horasb' WHERE usuario='$userupdate' AND fecha='$fechab' AND descripcion='$descripcionb' AND tipoact='$actividadb' AND empresa='$empresab' AND cproyecto='$proyectob' and inicio='$iniciob' and fin='$finalesb' and totalhoras='0'";

if( mysql_query($sqlfin,$conexion) )
{
?>
<!-- <script type="text/javascript">alert("DATOS MODIFICADOS EXITOSAMENTE");</script> -->
<script type="text/javascript">
//window.close();
window.location="reparar_errores.php";
//window.open("modificarast.php");
//location.reload();
</script>

<?php
}

?>
</body>

</html>




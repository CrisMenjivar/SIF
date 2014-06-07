<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title></title>
</head>

<body>
<?php

//iniciamos la conexion
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


//recuperamos los datos enviados por el formulario
$creado=$_SESSION['user'];

$login=$_POST['login'];
$login=strtolower($login);
$login=strtr($login,' ','_');
$acceso=$_POST['acceso'];
$acceso=strtolower($acceso);
$area=$_POST['area'];
$subarea=$_POST['subarea'];
$ccosto=$_POST['ccosto'];
//$correo=$_POST['correo'];
$empresa=$_POST['empresa'];

$pass=$_POST['pass'];
$pass=strtolower($pass);
$contra=$pass;
$pass=hash_hmac('md5', $pass, 'ast');

$nombre=$_POST['nombre'];

$apellido=$_POST['apellido'];

$cargo=$_POST['cargo'];

$contrato=$_POST['contrato'];
$contrato=strtolower($contrato);
$contrato=ucfirst($contrato);

$proveedor=$_POST['proveedor'];
$proveedor=strtoupper($proveedor);

$sqlinsertar="INSERT INTO  registroast.usuarios (user ,admin ,nombre ,apellido ,area ,subarea,ccosto,pass,puesto ,contrato ,empresa ,proveedor ,estado,creado) VALUES ('$login',  '$acceso',  '$nombre',  '$apellido',  '$area', '$subarea', '$ccosto','$pass','$cargo',  '$contrato',  '$empresa',  '$proveedor',  'a','$creado')";

if( mysql_query($sqlinsertar,$conexion) )
{

?>
<script type="text/javascript">alert("Datos de usuario almacenados exitosamente");</script>
<script type="text/javascript">
window.location="nuevousuario.php";
</script>
<?php
}
else
{
?>
<script type="text/javascript">alert("Error !!! Verifique si el usuario ya esta registrado o si tiene caracteres especiales.");</script>
<script type="text/javascript">
window.location="nuevousuario.php";
</script>
<?php
}
?>

</body>

</html>

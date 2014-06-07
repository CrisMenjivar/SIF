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


//recuperamos los datos enviados por el formulario
$opcion=$_POST['opcion'];

$nombre=$_POST['nombre'];
//$nombre=strtolower($nombre);
//$nombre=ucwords($nombre);
//$nombre=strtr($nombre,' ','_');

$codigo=$_POST['codigo'];
$codigo=strtoupper($codigo);


//$sqlinsertar="INSERT INTO  registroast.area (codigo ,nombre ,estado) VALUES ('$codigo','$nombre','a')";
$mod="UPDATE `registroast`.`subarea` SET `codigo` = '$codigo',`nombre` = '$nombre' WHERE `subarea`.`codigo` = '$opcion' ";

if( mysql_query($mod,$conexion) )
{
?>
<script type="text/javascript">alert("SUB-DEPARTAMENTO MODIFICADO EXITOSAMENTE");</script>
<script type="text/javascript">
window.location="nuevodepartamentoModificar.php";
</script>
<?php
}
else
{
?>
<script type="text/javascript">alert("ERROR VERIFIQUE QUE LAS MODIFICACIONES NO COINCIDEN CON SUB-DEPARTAMENTOS YA REGISTRADOS");</script>
<script type="text/javascript">
window.location="nuevodepartamentoModificar.php";
</script>
<?php
}
?>
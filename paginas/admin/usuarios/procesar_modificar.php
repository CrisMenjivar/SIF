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
$opcion=$_POST['opcion'];

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
$pass=hash_hmac('md5', $pass, 'ast');

$nombre=$_POST['nombre'];
//$nombre=strtolower($nombre);
//$nombre=ucwords($nombre);
//$nombre=strtr($nombre,' ','_');

$apellido=$_POST['apellido'];
//$apellido=strtolower($apellido);
//$apellido=ucwords($apellido);
//$apellido=strtr($apellido,' ','_');

$cargo=$_POST['cargo'];
//$cargo=strtolower($cargo);
//$cargo=ucfirst($cargo);

$contrato=$_POST['contrato'];
$contrato=strtolower($contrato);
$contrato=ucfirst($contrato);

$proveedor=$_POST['proveedor'];
$proveedor=strtoupper($proveedor);


//$mod="INSERT INTO  registroast.usuarios (user ,admin ,nombre ,apellido ,area ,pass ,email ,puesto ,contrato ,empresa ,proveedor ,estado) VALUES ('$login',  '$acceso',  '$nombre',  '$apellido',  '$area',  '$pass',  '$correo',  '$cargo',  '$contrato',  '$empresa',  '$proveedor',  'a')";
$mod="UPDATE `registroast`.`usuarios` SET `user`='$login', `admin`='$acceso' , `nombre`='$nombre', `apellido`='$apellido',`pass` = '$pass',`area` = '$area',`subarea` = '$subarea',`ccosto` = '$ccosto',`puesto` = '$cargo',`contrato` = '$contrato',`proveedor` = '$proveedor' WHERE `usuarios`.`user` = '$opcion'";

if( mysql_query($mod,$conexion) )
{
?>
<script type="text/javascript">alert("DATOS DE USUARIO MODIFICADOS EXITOSAMENTE");</script>
<script type="text/javascript">
window.location="nuevousuarioModificar.php";
</script>
<?php
}
else
{
?>
<script type="text/javascript">alert("ERROR VERIFIQUE SI LAS MODIFICACIONES NO COINCIDEN CON USUARIOS YA REGISTRADOS");</script>
<script type="text/javascript">
window.location="nuevousuarioModificar.php";
</script>
<?php
}
?>
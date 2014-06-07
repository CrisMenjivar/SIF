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

$creado=$_SESSION['user'];
$meses=date("m");
$years=date("Y");
$dias=date("d");
$fopen=$years.$meses.$dias;
$fclose="0000-00-00";


//recuperamos los datos enviados por el formulario
$nombre=$_POST['nombreacti'];
$nombre=trim($nombre);

if( $nombre != "" and $nombre != NULL and $nombre != " " )
{

$nombre=ucfirst($nombre);
$nombre=strtr($nombre,' ','_');

$result11= mysql_query("select count(tipoact) as total from actividad where nombre='$nombre' ",$conexion);
$result22= mysql_fetch_array($result11);

if( $result22['total'] == 0 )
{

$result1= mysql_query("select count(tipoact) as total from actividad",$conexion);
$result2= mysql_fetch_array($result1);
$correlativo = $result2['total'];
$correlativo++;

$sqlinsertar="INSERT INTO  registroast.actividad (tipoact,nombre,estado,creado,fopen,fclose) VALUES ('$correlativo','$nombre','a','$creado','$fopen','$fclose')";

if( mysql_query($sqlinsertar,$conexion) )
{
?>
<script type="text/javascript">alert("ACTIVIDAD ALMACENADA EXITOSAMENTE");</script>
<script type="text/javascript">
window.location="nuevaactividad.php";
</script>
<?php
}
else
{
?>
<script type="text/javascript">alert("ERROR VERIFIQUE SI LA ACTIVIDAD YA ESTA REGISTRADA E INTENTELO NUEVAMENTE");</script>
<script type="text/javascript">
window.location="nuevaactividad.php";
</script>
<?php
}

}//fin if que verifica que no este dos veces la misma actividad
else
{

?>
<script type="text/javascript">alert("Error la actividad ya se encuentra registrada");</script>
<script type="text/javascript">
window.location="nuevaactividad.php";
</script>
<?php


}//fin else q pregunta si ya esta registrada

}//fin if que verifica que la variable no este en blanco
?>


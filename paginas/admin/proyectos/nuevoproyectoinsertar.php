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
$empresa=$_POST['opcion1'];
$codigo=$_POST['correlativo'];
$nombre=$_POST['nombre'];
$descripcion=$_POST['descripcion'];
$coordinador=$_POST['coordinador'];
$inicio=$_POST['inicio'];
$fin=$_POST['fin'];
$cierre=$_POST['cierre'];
$anio=$_POST['anio'];
$area=$_POST['opcion2'];
$tipo=$_POST['tip'];

if($cierre==" ")
{
$cierre="0000-00-00";
}

if( $empresa != "" and $codigo != "" and $nombre != "" and $coordinador != "" and $inicio != "" and $fin != "" and $anio != "" and $area != "" and $tipo != "" )
{

$result11= mysql_query("select count(correlativo) as total from proyectos where estado='a' and empresa='$empresa' and nombre='$nombre' and coordinador='$coordinador' and finicio='$inicio' and fcierre='$fin' and year='$anio' and area='$area' and tipo='$tipo' ",$conexion);
$result22= mysql_fetch_array($result11);

if( $result22['total'] == 0 )
{

$result1= mysql_query("select count(correlativo) as total from proyectos",$conexion);
$result2= mysql_fetch_array($result1);
$correlativo = $result2['total'];
$correlativo++;


$sqlinsertar="INSERT INTO registroast.proyectos (correlativo,codigo,tipo,finicio,fcierre,freal,nombre,descripcionp,year,empresa,area,coordinador,estado) VALUES ('$correlativo','$codigo','$tipo','$inicio','$fin','$cierre','$nombre','$descripcion','$anio','$empresa','$area','$coordinador','a')";

if( mysql_query($sqlinsertar,$conexion) ) // if que verifica que el proyecto se guarde cone exito
{

?>
<script type="text/javascript">alert("PROYECTO ALMACENADO EXITOSAMENTE");</script>
<script type="text/javascript">
window.location="nuevoproyectoseleccionar.php";
</script>
<?php
} // fin if el proyecto se guardo con exito
else
{
?>
<script type="text/javascript">alert("ERROR VERIFIQUE SI EL PROYECTO YA ESTA REGISTRADO E INTENTELO NUEVAMENTE");</script>
<script type="text/javascript">
window.location="nuevoproyectoseleccionar.php";
</script>
<?php
}

}//fin if que verifica que no este registrado
else
{

?>
<script type="text/javascript">alert("Error el proyecto ya fue registrado");</script>
<script type="text/javascript">
window.location="nuevoproyectoseleccionar.php";
</script>
<?php

} //fin else q verifica si ya fue registrado

}//fin if que verifica que los campos no esten vacios
?>


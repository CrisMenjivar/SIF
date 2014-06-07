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
$bd=mysql_select_db($nombre_bd,$conexion) or die( mysql_error() );


$pos = $_GET['variable'];
session_start();
$userast=$_SESSION['numero1'];
$finicio=$_SESSION['numero2'];
$ffinal=$_SESSION['numero3'];

$textos = mysql_query("SELECT * FROM ast WHERE usuario='$userast' AND fecha BETWEEN '$finicio' AND '$ffinal' ORDER BY fecha ASC, inicio ASC",$conexion);

for($x = 0 ; $x < mysql_num_rows($textos) ; $x++)
{
$fila = mysql_fetch_assoc($textos);

if( $x == $pos )
{
$usuario=$fila['usuario'];
$fecha=$fila['fecha'];
$descripcion=$fila['descripcion'];
$actividad=$fila['tipoact'];
$empresa=$fila['empresa'];
$proyecto=$fila['cproyecto'];
$inicio=$fila['inicio'];
$fin=$fila['fin'];
$total=$fila['totalhoras'];

$sql="UPDATE registroast.ast SET estado='b' WHERE  usuario='$usuario' AND fecha='$fecha' AND descripcion='$descripcion' AND  tipoact='$actividad' AND empresa='$empresa' AND cproyecto='$proyecto' AND inicio='$inicio' AND fin='$fin' AND totalhoras=$total AND  estado='a'";
//$sql="UPDATE registroast.ast SET estado='b' WHERE estado='$estado'";
$otross=mysql_query($sql,$conexion);
}
} //fin del for para actualizar el registro seleccionado
?>
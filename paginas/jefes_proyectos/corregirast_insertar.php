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

if($move['admin']=="3")
{
header ("Location: ../jefes/ast.php");
}

}//fin else


//recuperamos los datos que nos envian desde el formulario ast
$userupdate=$_SESSION['user'];
$fecha=$_POST["fecha"];

$descripcion=$_POST['descripcion'];

$actividad=$_POST["actividades"];
$empresa=$_POST["empresas"];
$proyecto=$_POST["proyectos"];
$inicio=$_POST["inicios"];
$finales=$_POST["finales"];
$horas=$_POST["horas"];

$opcion=$_POST['pro'];
if($opcion=="NO_ES_PROYECTO")
{
$proyecto="NO_ES_PROYECTO";
}


$fechab=$_POST["fecha1"];
$descripcionb=$_POST["descripcion1"];
$actividab=$_POST["actividad1"];
$empresab=$_POST["empresa1"];
$proyectob=$_POST["proyecto1"];
$iniciob=$_POST["inicio1"];
$finalb=$_POST["fin1"];
$horasb=$_POST["total1"];

$sqlfin = "UPDATE ast SET fecha='$fecha',descripcion='$descripcion',tipoact='$actividad', empresa='$empresa', cproyecto='$proyecto',inicio='$inicio',fin='$finales',totalhoras='$horas',estado='a' WHERE usuario='$userupdate' AND fecha='$fechab' AND descripcion='$descripcionb' AND tipoact='$actividab' AND empresa='$empresab' AND cproyecto='$proyectob' and inicio='$iniciob' and fin='$finalb' and totalhoras='$horasb'";

if( mysql_query($sqlfin,$conexion) )
{
//variables para corregir----------
$_SESSION['c_fecha']="";
$_SESSION['c_descripcion']="";
$_SESSION['c_actividad']="";
$_SESSION['c_empresa']="";
$_SESSION['c_proyecto']="";
$_SESSION['c_inicio']="";
$_SESSION['c_fin']="";
$_SESSION['c_total']="";
$_SESSION['c_check']="100000000000000000";
//--------------------------------------
header ("Location: corregirast.php");
}
else
{
//variables para corregir----------
$_SESSION['c_fecha']="";
$_SESSION['c_descripcion']="";
$_SESSION['c_actividad']="";
$_SESSION['c_empresa']="";
$_SESSION['c_proyecto']="";
$_SESSION['c_inicio']="";
$_SESSION['c_fin']="";
$_SESSION['c_total']="";
$_SESSION['c_check']="100000000000000000";
//--------------------------------------

?>
<script type="text/javascript">alert("ERROR EN LOS DATOS AL MODIFICAR EL REGISTRO. POR FAVOR INTENTELO NUEVAMENTE");</script>
<script type="text/javascript">
window.location="corregirast.php";
</script>
<?php
}
?>



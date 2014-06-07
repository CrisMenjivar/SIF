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

$query = "select count(totalhoras) as total from ast where usuario='$userupdate' and fecha='$fecha' and descripcion='$descripcion' and tipoact='$actividad' and empresa='$empresa' and cproyecto='$proyecto' and inicio='$inicio' and fin='$finales' and totalhoras='$horas'";
$respuesta=mysql_query($query,$conexion);
$res=mysql_fetch_array($respuesta);
$respuesta=$res['total'];

if( $respuesta == 0 )
{

$sqlfin = "UPDATE ast SET fecha='$fecha',descripcion='$descripcion',tipoact='$actividad', empresa='$empresa', cproyecto='$proyecto',inicio='$inicio', fin='$finales', totalhoras='$horas',estado='a' WHERE usuario='$userupdate' AND fecha='$fechab' AND descripcion='$descripcionb' AND tipoact='$actividab' AND empresa='$empresab' AND cproyecto='$proyectob' and inicio='$iniciob' and fin='$finalb' and totalhoras='$horasb'";

if( mysql_query($sqlfin,$conexion) )
{
$_SESSION['m_fecha']="";
   $_SESSION['m_descripcion']="";
   $_SESSION['m_actividad']="";
   $_SESSION['m_empresa']="";
   $_SESSION['m_proyecto']="";
   $_SESSION['m_inicio']="";
   $_SESSION['m_fin']="";
   $_SESSION['m_total']="";
   $_SESSION['m_check']="100000000000000000";

header ("Location: 2_revisarast.php");
}
else
{
$_SESSION['m_fecha']="";
   $_SESSION['m_descripcion']="";
   $_SESSION['m_actividad']="";
   $_SESSION['m_empresa']="";
   $_SESSION['m_proyecto']="";
   $_SESSION['m_inicio']="";
   $_SESSION['m_fin']="";
   $_SESSION['m_total']="";
   $_SESSION['m_check']="100000000000000000";

?>
<script type="text/javascript">alert("ERROR EN LOS DATOS AL MODIFICAR EL REGISTRO. POR FAVOR INTENTELO NUEVAMENTE");</script>
<script type="text/javascript">
window.location="2_revisarast.php";
</script>
<?php
}
}//fin de if que evita la repeticion de registros
else
{
$_SESSION['m_fecha']="";
   $_SESSION['m_descripcion']="";
   $_SESSION['m_actividad']="";
   $_SESSION['m_empresa']="";
   $_SESSION['m_proyecto']="";
   $_SESSION['m_inicio']="";
   $_SESSION['m_fin']="";
   $_SESSION['m_total']="";
   $_SESSION['m_check']="100000000000000000";

?>
<script type="text/javascript">alert("Error actividad duplicada");</script>
<script type="text/javascript">
window.location="2_revisarast.php";
</script>
<?php
}
?>





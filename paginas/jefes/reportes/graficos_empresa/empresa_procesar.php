<?php

include '../../../../config/db.php';

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
header ("Location: ../../../../index.php");
}
else
{
$ver=$_SESSION['user'];

$change="select admin from usuarios where user='$ver' ";
$verify = mysql_query($change,$conexion);
$move=mysql_fetch_array($verify);

if($move['admin']=="2")
{
header ("Location: ../../../usuarios/ast.php");
}

if($move['admin']=="1")
{
header ("Location: ../../../admin/menuadmin.php");
}

}//fin else

//recuperamos los datos enviados por el formulario
$reporte=$_POST['reporte'];
$inicio=$_POST['inicio'];
$year=$_POST['year'];
$fin=$_POST['fin'];
$area=$_POST['area'];
$proyecto=$_POST['proyec'];

switch($fin)
{
Case 1:
$diaI="01";
$diaF="31";
break;
Case 2:
$diaI="01";
$diaF="28";
break;
Case 3:
$diaI="01";
$diaF="31";
break;
Case 4:
$diaI="01";
$diaF="30";
break;
Case 5:
$diaI="01";
$diaF="31";
break;
Case 6:
$diaI="01";
$diaF="30";
break;
Case 7:
$diaI="01";
$diaF="31";
break;
Case 8:
$diaI="01";
$diaF="31";
break;
Case 9:
$diaI="01";
$diaF="30";
break;
Case 10:
$diaI="01";
$diaF="31";
break;
Case 11:
$diaI="01";
$diaF="30";
break;
Case 12:
$diaI="01";
$diaF="31";
break;
}

if( $inicio < 10 )
{
$ini="0".$inicio;
}
else
{
$ini=$inicio;
}

if( $fin < 10 )
{
$final="0".$fin;
}
else
{
$final=$fin;
}


$finicio=$year."-".$ini."-"."01";
$ffin=$year."-".$final."-".$diaF;

//session_start();
$_SESSION['empresa_inicio']=$finicio;
$_SESSION['empresa_fin']=$ffin;
$_SESSION['empresa_area']=$area;
$_SESSION['empresa_proyecto']=$proyecto;
//$_SESSION['empresa_usuario']=$colaborador;

$_SESSION['empresa_uno']=$inicio;
$_SESSION['empresa_dos']=$final;
$_SESSION['empresa_year']=$year;

if( $reporte == 1 )
{
?>
<script type="text/javascript">
window.location="empresa_1_tiempo_reporte.php";
</script>
<?php
}

if( $reporte == 2 )
{
?>      <script type="text/javascript">
window.location="empresa_2_proyectos_reporte.php";
</script>
<?php
}

if( $reporte == 3 )
{
?>      <script type="text/javascript">
window.location="empresa_3_horasproyecto.php";
</script>
<?php
}

if( $reporte == 4 )
{
?>      <script type="text/javascript">
window.location="empresa_4_proyectos_reporte.php";
</script>
<?php
}

?>


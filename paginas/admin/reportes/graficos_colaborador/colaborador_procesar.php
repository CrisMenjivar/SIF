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

if($move['admin']=="3")
{
header ("Location: ../../../jefes/ast.php");
}

}//fin else

//recuperamos los datos enviados por el formulario
$reporte=$_POST['reporte'];
$inicio=$_POST['inicio'];
$year=$_POST['year'];
$fin=$_POST['fin'];
$area=$_POST['area'];
$colaborador=$_POST['colaborador'];

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


$finicio=$year." - ".$ini." - "."01";
$ffin=$year." - ".$final." - ".$diaF;

//session_start();
$_SESSION['colaborador_inicio']=$finicio;
$_SESSION['colaborador_fin']=$ffin;
$_SESSION['colaborador_area']=$area;
$_SESSION['colaborador_usuario']=$colaborador;

$_SESSION['colaborador_uno']=$inicio;
$_SESSION['colaborador_dos']=$final;
$_SESSION['colaborador_year']=$year;

if( $reporte == 1 )
{
?>
<script type="text/javascript">
window.location="colaborador_1_ast.php";
</script>
<?php
}

if( $reporte == 2 )
{
?>      <script type="text/javascript">
window.location="colaborador_2_tiempo.php";
</script>
<?php
}

if( $reporte == 3 )
{
?>      <script type="text/javascript">
window.location="colaborador_3_proyectos.php";
</script>
<?php
}

if( $reporte == 4 )
{
?>      <script type="text/javascript">
window.location="colaborador_4_horasproyecto.php";
</script>
<?php
}
?>


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
$inicio=$_POST['inicio'];
$fin=$_POST['fin'];
$year=$_POST['anio'];
$area=$_POST['area'];

if( $inicio != $fin)
{
//session_start();
$_SESSION['year']=$year;
$_SESSION['inicio']=$inicio;
$_SESSION['fin']=$fin;
$_SESSION['tipo']=$area;

if( $area == "PROYECTOS" )
{
?>
<script type="text/javascript">
window.location="reporte_anual_areas_proyectos.php";
<!--window.location="prueba.php";
</script>

<?php
}

?>
<script type="text/javascript">
window.location="reporte_anual_areas.php";
<!--window.location="prueba.php";
</script>
<?php

}
else
{
?>
<script type="text/javascript">alert("ERROR LOS MESES SELECCIONADOS DEBEN SER DIFERENTES");</script>
<script type="text/javascript">
window.location="reporte_seleccionar_anual.php";
</script>
<?php
}
?>


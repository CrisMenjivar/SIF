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
$code=$_POST['codigo'];
$nombre=$_POST['nombre'];
$mostrar=$_POST['mostrar'];

//$mostrar=$nombre;
//$nombre=strtoupper($nombre);
//$nombre=strtr($nombre,' ','_');

//$mostrar=strtolower($mostrar);
$mostrar=ucfirst($mostrar);


$sqlinsertar="INSERT INTO registroast.ccosto (codigo,nombre,mostrar,estado,creado,fopen,fclose) VALUES ('$code','$nombre','$mostrar','a','$creado','$fopen',$fclose)";

if( mysql_query($sqlinsertar,$conexion) )
{
?>
<script type="text/javascript">alert("CENTRO DE COSTO ALMACENADO EXITOSAMENTE");</script>
<script type="text/javascript">
window.location="nuevo_grupo.php";
</script>
<?php
}
else
{
?>
<script type="text/javascript">alert("ERROR VERIFIQUE SI EL CENTRO DE COSTO YA ESTA REGISTRADO E INTENTELO NUEVAMENTE");</script>
<script type="text/javascript">
window.location="nuevo_grupo.php";
</script>
<?php
}
?>
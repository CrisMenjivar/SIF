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

$opcion=$_GET['opcion'];
$empresa=$_GET['empresa'];

if($opcion!="99" and $empresa!="----------------------" and $empresa!="")
{
?>
<select name="proyectos" size="1">
<?php
$sql4="select * from proyectos where estado='a' and empresa='$empresa' and correlativo!='99' and freal='0000-00-00'";
$result4 = mysql_query($sql4,$conexion);
while ( $proyecto=mysql_fetch_array($result4) )
{
$proyec=$proyecto['correlativo'];
$nompro=$proyecto['nombre'];
$nompro=strtr($nompro,'_',' ');

if( $proyec != "99" )
{
echo "<option value=".$proyec.">".$proyecto['nombre']."</option>";
}
}
?>
</select>
<?php
}

if($opcion=="99")
{
echo '<input name="proyectos" value="99" type="hidden" >';
}
?>
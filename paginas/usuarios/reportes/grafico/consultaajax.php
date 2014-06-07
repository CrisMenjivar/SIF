<option selected="selected" value="">Colaboradores</option>

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


$areas = $_GET['COD'];

$Textos = mysql_query("SELECT * FROM usuarios WHERE area='$areas'",$conexion);

if ($row = mysql_fetch_array($Textos))
{
do
{
echo '<option value="';
echo $row['user'];
echo '">';
echo $row['user'];
echo '</potion>';
} while ($row = mysql_fetch_array($Textos));
}
else
{
echo "Sin datos!";
}

?>


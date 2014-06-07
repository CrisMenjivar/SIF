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


$area = $_GET['area'];
$finicio= $_GET['inicio'];
$ffinal= $_GET['final'];


if( $area != "" and $finicio != "" and $ffinal != "" )
{

?>

<form>
<table width="999px" border="0" cellpadding="1" cellspacing="1" style="border-color:#000099;background-color:#3b5998;color:white;font-size:11px;">
<tr>
<td width="200px"  height="17px" align="center"> COLABORADORES </td>
<td width="400px"  height="17px" align="center"> CANTIDAD DE ACTIVIDADES PENDIENTES DE CORRECI&Oacute;N</td>
</tr>
</table>

<table width="999px" border="0" cellpadding="1" cellspacing="1" style="border-color:#000099;">
<?php

$personas = mysql_query("select user from usuarios where estado='a' and area='$area' ",$conexion);

$cuantos=0;

while( $colaboradores=mysql_fetch_array($personas) )
{

$usuario=$colaboradores['user'];

$res  = mysql_query("select count(fecha) as total from ast where fecha between '$finicio' and '$ffinal' and estado = 'b' and usuario='$usuario' ", $conexion);
$res1 = mysql_fetch_array($res);

if( $res1['total'] != 0 )
{
echo '<tr style="background-color:#CFCFCF;" >';
echo '<td width="200px"  height="17px" > '; echo '&nbsp;&nbsp;'; echo $usuario; echo '</td>';
echo '<td width="400px"  height="17px" align="center" > '; echo $res1['total']; echo '&nbsp;&nbsp; Pendientes'; echo '</td>';
echo '</tr>';

$cuantos=$cuantos+1;

}

} //fin while que recorre a los usuarios


if( $cuantos == 0 )
{

echo '<tr style="background-color:#CFCFCF;" >';
echo '<td height="17px" align="center" > Los colaboradores del &aacute;rea no tienen actividades pendientes de correcci&oacute;n </td>';
echo '</tr>';

}


?>

</table>
</form>

<?php
}
?>





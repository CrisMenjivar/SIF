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

$empresa = $_GET['empresa'];
$rango = $_GET['rango'];

$meses = date("m");
$anios = date("Y");
$dias  = date("d");

$ff = $anios .'-'. $meses .'-'. $dias;

for( $i = 0 ; $i < $rango ; $i++ )
{

if( $meses == 1 )
{
$meses = 12;
$anios = $anios - 1;
}
else
{
$meses = $meses - 1;
}

} // fin for

$fi = $anios .'-'. $meses .'-'. $dias;


if( $empresa == "general" ) // empresa == general
{
?>

<table cellpadding="0" cellspacing="0" border="1" style="margin-top:40px;">
<tr style="background-color:#3B5998;color:white;font-weight:bold;">
<td width="130px" height="20px" align="center" >Correlativo</td>
<td width="280px" height="20px" style="line-height:normal;" align="center" >Nombre</td>
<td width="100px" height="20px" align="center" >Empresa</td>
<td width="60px" height="20px" align="center" >&Aacute;rea</td>
<td width="111px" height="20px" align="center" >Coordinador</td>
<td width="92px" height="20px" align="center" >Inicio</td>
<td width="92px" height="20px" align="center" >Fin</td>
<td width="92px" height="20px" align="center" >Cierre</td>
<td width="65px" height="20px" align="center" >A&ntilde;o</td>
</tr>

<?php

$sql1="select * from proyectos where freal='0000-00-00' and correlativo!='99' and finicio < '$fi' ";
$result1 = mysql_query($sql1,$conexion);

while ( $proyectos=mysql_fetch_array($result1) )
{
$correlativo=$proyectos['codigo'];
$nombre=$proyectos['nombre'];
$nombre=strtr($nombre,'_',' ');
$nombre=strtolower($nombre);
$nombre=ucfirst($nombre);
$empresa=$proyectos['empresa'];
$area=$proyectos['area'];
$coordinador=$proyectos['coordinador'];
$inicio=$proyectos['finicio'];
$fin=$proyectos['fcierre'];
$cierre=$proyectos['freal'];
$anio=$proyectos['year'];

$sql2 = "select count(totalhoras) as total from ast where cproyecto='$correlativo' and fecha between '$fi' and '$ff' ";
$ver2 = mysql_query($sql2,$conexion);
$resultado=mysql_fetch_array($ver2);
$total=$resultado['total'];

if( $total == 0 )
{
echo '<tr>';
echo '<td width="130px" height="20px" align="center" >'; echo $correlativo; echo'</td>';
echo '<td width="280px" height="20px" style="line-height:normal;" >'; echo $nombre; echo'</td>';
echo '<td width="100px" height="20px" align="center" >'; echo $empresa; echo'</td>';
echo '<td width="60px" height="20px" align="center" >'; echo $area; echo'</td>';
echo '<td width="111px" height="20px" align="center" >'; echo $coordinador; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $inicio; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $fin; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $cierre; echo'</td>';
echo '<td width="65px" height="20px" align="center" >'; echo $anio; echo'</td>';
echo '</tr>';
} //fin if total == 0

} // fin while que recorre los proyectos
?>
</table>


<?php
}
else  // La empresa ingresada es diferente de GENERAL -------------------------------------------------
{
?>

<table cellpadding="0" cellspacing="0" border="1" style="margin-top:40px;">
<tr style="background-color:#3B5998;color:white;font-weight:bold;">
<td width="130px" height="20px" align="center" >Correlativo</td>
<td width="280px" height="20px" style="line-height:normal;" align="center">Nombre</td>
<td width="100px" height="20px" align="center" >Empresa</td>
<td width="60px" height="20px" align="center" >&Aacute;rea</td>
<td width="111px" height="20px" align="center" >Coordinador</td>
<td width="92px" height="20px" align="center" >Inicio</td>
<td width="92px" height="20px" align="center" >Fin</td>
<td width="92px" height="20px" align="center" >Cierre</td>
<td width="65px" height="20px" align="center" >A&ntilde;o</td>
</tr>

<?php
$sql1="select * from proyectos where freal='0000-00-00' and correlativo!='99' and empresa='$empresa' and finicio < '$fi' ";
$result1 = mysql_query($sql1,$conexion);

while ( $proyectos=mysql_fetch_array($result1) )
{
$correlativo=$proyectos['codigo'];
$nombre=$proyectos['nombre'];
$nombre=strtr($nombre,'_',' ');
$nombre=strtolower($nombre);
$nombre=ucfirst($nombre);
$empresa=$proyectos['empresa'];
$area=$proyectos['area'];
$coordinador=$proyectos['coordinador'];
$inicio=$proyectos['finicio'];
$fin=$proyectos['fcierre'];
$cierre=$proyectos['freal'];
$anio=$proyectos['year'];

$sql2 = "select count(totalhoras) as total from ast where cproyecto='$correlativo' and fecha between '$fi' and '$ff' ";
$ver2 = mysql_query($sql2,$conexion);
$resultado=mysql_fetch_array($ver2);
$total=$resultado['total'];

if( $total == 0 )
{
echo '<tr>';
echo '<td width="130px" height="20px" align="center" >'; echo $correlativo; echo'</td>';
echo '<td width="280px" height="20px" style="line-height:normal;" >'; echo $nombre; echo'</td>';
echo '<td width="100px" height="20px" align="center" >'; echo $empresa; echo'</td>';
echo '<td width="60px" height="20px" align="center" >'; echo $area; echo'</td>';
echo '<td width="111px" height="20px" align="center" >'; echo $coordinador; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $inicio; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $fin; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $cierre; echo'</td>';
echo '<td width="65px" height="20px" align="center" >'; echo $anio; echo'</td>';
echo '</tr>';
} //fin if total == 0

} // fin while que recorre los proyectos
?>
</table>


<?php
} //fin el la empresa es diferente de general

?>





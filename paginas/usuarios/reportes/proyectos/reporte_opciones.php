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

$areas = $_GET['area'];
$empresas = $_GET['empresa'];
$tipo = $_GET['tipo'];
$descripcion = $_GET['descripcion'];


if( $descripcion == "NO")
{
?>

<table width="1000px" border="0" cellpadding="1" cellspacing="1" style="border-color:#000099;background-color:#3b5998;color:white;font-size:14px;">
<tr>
<td width="130px"  height="19px" align="center"> Correlativo </td>
<td width="372px"  height="19px" align="center"> Nombre proyecto </td>
<td width="100px" height="19px" align="center"> Empresa</td>
<td width="60px" height="19px" align="center">&Aacute;rea</td>
<td width="111px" height="19px" align="center"> Coordinador</td>
<td width="92px" height="19px" align="center"> Inicio</td>
<td width="92px"  height="19px" align="center"> Fin estimado</td>
<td width="65px"  height="19px" align="center"> A&ntilde;o</td>
</tr>
</table>


<?php
if( $areas == "general" and $empresas == "general" and $tipo == "general" )
{
?>

<table cellpadding="0" cellspacing="0" border="1" class="fila">
<?php
$sql2="select * from proyectos where freal='0000-00-00' and correlativo!='NO_ES_PROYECTO' ";
$result2 = mysql_query($sql2,$conexion);

while ( $proyectos=mysql_fetch_array($result2) )
{
$correlativo=$proyectos['codigo'];
$nombre=$proyectos['nombre'];
$empresa=$proyectos['empresa'];
$area=$proyectos['area'];
$coordinador=$proyectos['coordinador'];
$inicio=$proyectos['finicio'];
$fin=$proyectos['fcierre'];

$anio=$proyectos['year'];

echo '<tr>';
echo '<td width="130px" height="20px" align="center" >'; echo $correlativo; echo'</td>';
echo '<td width="372px" height="20px" style="line-height:normal;" >'; echo $nombre; echo'</td>';
echo '<td width="100px" height="20px" align="center" >'; echo $empresa; echo'</td>';
echo '<td width="60px" height="20px" align="center" >'; echo $area; echo'</td>';
echo '<td width="111px" height="20px" align="center" >'; echo $coordinador; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $inicio; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $fin; echo'</td>';

echo '<td width="65px" height="20px" align="center" >'; echo $anio; echo'</td>';
echo '</tr>';
}
?>
</table>


<?php
}

if( $areas != "general" and $empresas != "general" and $tipo != "general")
{
?>

<table cellpadding="0" cellspacing="0" border="1" class="fila">
<?php
$sql2="select * from proyectos where freal='0000-00-00' and correlativo!='NO_ES_PROYECTO' and area='$areas' and empresa='$empresas' and tipo='$tipo'";
$result2 = mysql_query($sql2,$conexion);

while ( $proyectos=mysql_fetch_array($result2) )
{
$correlativo=$proyectos['codigo'];
$nombre=$proyectos['nombre'];
$empresa=$proyectos['empresa'];
$area=$proyectos['area'];
$coordinador=$proyectos['coordinador'];
$inicio=$proyectos['finicio'];
$fin=$proyectos['fcierre'];

$anio=$proyectos['year'];

echo '<tr>';
echo '<td width="130px" height="20px" align="center" >'; echo $correlativo; echo'</td>';
echo '<td width="372px" height="20px" style="line-height:normal;" >'; echo $nombre; echo'</td>';
echo '<td width="100px" height="20px" align="center" >'; echo $empresa; echo'</td>';
echo '<td width="60px" height="20px" align="center" >'; echo $area; echo'</td>';
echo '<td width="111px" height="20px" align="center" >'; echo $coordinador; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $inicio; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $fin; echo'</td>';

echo '<td width="65px" height="20px" align="center" >'; echo $anio; echo'</td>';
echo '</tr>';
}
?>
</table>


<?php
}


if( $areas != "general" and $empresas == "general" and $tipo == "general" )
{
?>
<table cellpadding="0" cellspacing="0" border="1" class="fila">
<?php
$sql2="select * from proyectos where freal='0000-00-00' and correlativo!='NO_ES_PROYECTO' and area='$areas'";
$result2 = mysql_query($sql2,$conexion);

while ( $proyectos=mysql_fetch_array($result2) )
{
$correlativo=$proyectos['codigo'];
$nombre=$proyectos['nombre'];
$empresa=$proyectos['empresa'];
$area=$proyectos['area'];
$coordinador=$proyectos['coordinador'];
$inicio=$proyectos['finicio'];
$fin=$proyectos['fcierre'];

$anio=$proyectos['year'];

echo '<tr>';
echo '<td width="130px" height="20px" align="center" >'; echo $correlativo; echo'</td>';
echo '<td width="372px" height="20px" style="line-height:normal;" >'; echo $nombre; echo'</td>';
echo '<td width="100px" height="20px" align="center" >'; echo $empresa; echo'</td>';
echo '<td width="60px" height="20px" align="center" >'; echo $area; echo'</td>';
echo '<td width="111px" height="20px" align="center" >'; echo $coordinador; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $inicio; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $fin; echo'</td>';

echo '<td width="65px" height="20px" align="center" >'; echo $anio; echo'</td>';
echo '</tr>';
}
?>
</table>

<?php
}

if( $areas == "general" and $empresas != "general" and $tipo == "general")
{
?>

<table cellpadding="0" cellspacing="0" border="1" class="fila">
<?php
$sql2="select * from proyectos where freal='0000-00-00' and correlativo!='NO_ES_PROYECTO' and empresa='$empresas'";
$result2 = mysql_query($sql2,$conexion);

while ( $proyectos=mysql_fetch_array($result2) )
{
$correlativo=$proyectos['codigo'];
$nombre=$proyectos['nombre'];
$empresa=$proyectos['empresa'];
$area=$proyectos['area'];
$coordinador=$proyectos['coordinador'];
$inicio=$proyectos['finicio'];
$fin=$proyectos['fcierre'];

$anio=$proyectos['year'];

echo '<tr>';
echo '<td width="130px" height="20px" align="center" >'; echo $correlativo; echo'</td>';
echo '<td width="372px" height="20px" style="line-height:normal;" >'; echo $nombre; echo'</td>';
echo '<td width="100px" height="20px" align="center" >'; echo $empresa; echo'</td>';
echo '<td width="60px" height="20px" align="center" >'; echo $area; echo'</td>';
echo '<td width="111px" height="20px" align="center" >'; echo $coordinador; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $inicio; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $fin; echo'</td>';

echo '<td width="65px" height="20px" align="center" >'; echo $anio; echo'</td>';
echo '</tr>';
}
?>
</table>


<?php
}

if( $areas == "general" and $empresas == "general" and $tipo != "general")
{
?>

<table cellpadding="0" cellspacing="0" border="1" class="fila">
<?php
$sql2="select * from proyectos where freal='0000-00-00' and correlativo!='NO_ES_PROYECTO' and tipo='$tipo'";
$result2 = mysql_query($sql2,$conexion);

while ( $proyectos=mysql_fetch_array($result2) )
{
$correlativo=$proyectos['codigo'];
$nombre=$proyectos['nombre'];
$empresa=$proyectos['empresa'];
$area=$proyectos['area'];
$coordinador=$proyectos['coordinador'];
$inicio=$proyectos['finicio'];
$fin=$proyectos['fcierre'];

$anio=$proyectos['year'];

echo '<tr>';
echo '<td width="130px" height="20px" align="center" >'; echo $correlativo; echo'</td>';
echo '<td width="372px" height="20px" style="line-height:normal;" >'; echo $nombre; echo'</td>';
echo '<td width="100px" height="20px" align="center" >'; echo $empresa; echo'</td>';
echo '<td width="60px" height="20px" align="center" >'; echo $area; echo'</td>';
echo '<td width="111px" height="20px" align="center" >'; echo $coordinador; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $inicio; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $fin; echo'</td>';

echo '<td width="65px" height="20px" align="center" >'; echo $anio; echo'</td>';
echo '</tr>';
}
?>
</table>


<?php
}

if( $areas != "general" and $empresas != "general" and $tipo == "general")
{
?>

<table cellpadding="0" cellspacing="0" border="1" class="fila">
<?php
$sql2="select * from proyectos where freal='0000-00-00' and correlativo!='NO_ES_PROYECTO' and empresa='$empresas' and area='$areas'";
$result2 = mysql_query($sql2,$conexion);

while ( $proyectos=mysql_fetch_array($result2) )
{
$correlativo=$proyectos['codigo'];
$nombre=$proyectos['nombre'];
$empresa=$proyectos['empresa'];
$area=$proyectos['area'];
$coordinador=$proyectos['coordinador'];
$inicio=$proyectos['finicio'];
$fin=$proyectos['fcierre'];

$anio=$proyectos['year'];

echo '<tr>';
echo '<td width="130px" height="20px" align="center" >'; echo $correlativo; echo'</td>';
echo '<td width="372px" height="20px" style="line-height:normal;" >'; echo $nombre; echo'</td>';
echo '<td width="100px" height="20px" align="center" >'; echo $empresa; echo'</td>';
echo '<td width="60px" height="20px" align="center" >'; echo $area; echo'</td>';
echo '<td width="111px" height="20px" align="center" >'; echo $coordinador; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $inicio; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $fin; echo'</td>';

echo '<td width="65px" height="20px" align="center" >'; echo $anio; echo'</td>';
echo '</tr>';
}
?>
</table>


<?php
}

if( $areas == "general" and $empresas != "general" and $tipo != "general")
{
?>

<table cellpadding="0" cellspacing="0" border="1" class="fila">
<?php
$sql2="select * from proyectos where freal='0000-00-00' and correlativo!='NO_ES_PROYECTO' and empresa='$empresas' and tipo='$tipo' ";
$result2 = mysql_query($sql2,$conexion);

while ( $proyectos=mysql_fetch_array($result2) )
{
$correlativo=$proyectos['codigo'];
$nombre=$proyectos['nombre'];
$empresa=$proyectos['empresa'];
$area=$proyectos['area'];
$coordinador=$proyectos['coordinador'];
$inicio=$proyectos['finicio'];
$fin=$proyectos['fcierre'];

$anio=$proyectos['year'];

echo '<tr>';
echo '<td width="130px" height="20px" align="center" >'; echo $correlativo; echo'</td>';
echo '<td width="372px" height="20px" style="line-height:normal;" >'; echo $nombre; echo'</td>';
echo '<td width="100px" height="20px" align="center" >'; echo $empresa; echo'</td>';
echo '<td width="60px" height="20px" align="center" >'; echo $area; echo'</td>';
echo '<td width="111px" height="20px" align="center" >'; echo $coordinador; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $inicio; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $fin; echo'</td>';

echo '<td width="65px" height="20px" align="center" >'; echo $anio; echo'</td>';
echo '</tr>';
}
?>
</table>


<?php
}

if( $areas != "general" and $empresas == "general" and $tipo != "general")
{
?>

<table cellpadding="0" cellspacing="0" border="1" class="fila">
<?php
$sql2="select * from proyectos where freal='0000-00-00' and correlativo!='NO_ES_PROYECTO' and area='$areas' and tipo='$tipo' ";
$result2 = mysql_query($sql2,$conexion);

while ( $proyectos=mysql_fetch_array($result2) )
{
$correlativo=$proyectos['codigo'];
$nombre=$proyectos['nombre'];
$empresa=$proyectos['empresa'];
$area=$proyectos['area'];
$coordinador=$proyectos['coordinador'];
$inicio=$proyectos['finicio'];
$fin=$proyectos['fcierre'];

$anio=$proyectos['year'];

echo '<tr>';
echo '<td width="130px" height="20px" align="center" >'; echo $correlativo; echo'</td>';
echo '<td width="372px" height="20px" style="line-height:normal;" >'; echo $nombre; echo'</td>';
echo '<td width="100px" height="20px" align="center" >'; echo $empresa; echo'</td>';
echo '<td width="60px" height="20px" align="center" >'; echo $area; echo'</td>';
echo '<td width="111px" height="20px" align="center" >'; echo $coordinador; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $inicio; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $fin; echo'</td>';

echo '<td width="65px" height="20px" align="center" >'; echo $anio; echo'</td>';
echo '</tr>';
}
?>
</table>


<?php
}

}//FIN IF DESCRIPCION == NO


//***************************************************************************************************************************************************
//***************************************************************************************************************************************************
//***************************************************************************************************************************************************
//***************************************************************************************************************************************************
//***************************************************************************************************************************************************
//***************************************************************************************************************************************************
//***************************************************************************************************************************************************
//***************************************************************************************************************************************************
//***************************************************************************************************************************************************
//***************************************************************************************************************************************************
//***************************************************************************************************************************************************
//***************************************************************************************************************************************************
//INICIO DE CODIGO PARA LAS TABLAS CON DESCRIPCION


if( $descripcion == "SI")
{

?>

<table width="1000px" border="0" cellpadding="1" cellspacing="1" style="border-color:#000099;background-color:#3b5998;color:white;font-size:14px;">
<tr>
<td width="130px"  height="19px" align="center"> Correlativo </td>
<td width="322px"  height="19px" align="center"> Nombre proyecto </td>
<td width="217px"  height="19px" align="center"> Descripci&oacute;n</td>
<td width="95px" height="19px" align="center"> Empresa</td>
<td width="55px" height="19px" align="center">&Aacute;rea</td>
<td width="111px" height="19px" align="center"> Coordinador</td>
<td width="92px" height="19px" align="center"> Inicio</td>
</tr>
</table>


<?php
if( $areas == "general" and $empresas == "general" and $tipo == "general" )
{
?>

<table cellpadding="0" cellspacing="0" border="1" class="fila">
<?php
$sql2="select * from proyectos where freal='0000-00-00' and correlativo!='NO_ES_PROYECTO' ";
$result2 = mysql_query($sql2,$conexion);

while ( $proyectos=mysql_fetch_array($result2) )
{
$correlativo=$proyectos['codigo'];
$nombre=$proyectos['nombre'];
$descripcionp=$proyectos['descripcionp'];
$empresa=$proyectos['empresa'];
$area=$proyectos['area'];
$coordinador=$proyectos['coordinador'];
$inicio=$proyectos['finicio'];

echo '<tr>';
echo '<td width="130px" height="20px" align="center" >'; echo $correlativo; echo'</td>';
echo '<td width="322px" height="20px" style="line-height:normal;" >'; echo $nombre; echo'</td>';
echo '<td width="217px" height="20px" style="line-height:normal">'; if( $descripcionp != NULL ){ echo $descripcionp; }else{ echo ' '; }; echo'</td>';
echo '<td width="95px" height="20px" align="center" >'; echo $empresa; echo'</td>';
echo '<td width="55px" height="20px" align="center" >'; echo $area; echo'</td>';
echo '<td width="111px" height="20px" align="center" >'; echo $coordinador; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $inicio; echo'</td>';
echo '</tr>';
}
?>
</table>


<?php
}

if( $areas != "general" and $empresas != "general" and $tipo != "general")
{
?>

<table cellpadding="0" cellspacing="0" border="1" class="fila">
<?php
$sql2="select * from proyectos where freal='0000-00-00' and correlativo!='NO_ES_PROYECTO' and area='$areas' and empresa='$empresas' and tipo='$tipo'";
$result2 = mysql_query($sql2,$conexion);

while ( $proyectos=mysql_fetch_array($result2) )
{
$correlativo=$proyectos['codigo'];
$nombre=$proyectos['nombre'];
$descripcionp=$proyectos['descripcionp'];
$empresa=$proyectos['empresa'];
$area=$proyectos['area'];
$coordinador=$proyectos['coordinador'];
$inicio=$proyectos['finicio'];

echo '<tr>';
echo '<td width="130px" height="20px" align="center" >'; echo $correlativo; echo'</td>';
echo '<td width="322px" height="20px" style="line-height:normal;" >'; echo $nombre; echo'</td>';
echo '<td width="217px" height="20px" style="line-height:normal">'; if( $descripcionp != NULL ){ echo $descripcionp; }else{ echo ' '; }; echo'</td>';
echo '<td width="95px" height="20px" align="center" >'; echo $empresa; echo'</td>';
echo '<td width="55px" height="20px" align="center" >'; echo $area; echo'</td>';
echo '<td width="111px" height="20px" align="center" >'; echo $coordinador; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $inicio; echo'</td>';
echo '</tr>';
}
?>
</table>


<?php
}


if( $areas != "general" and $empresas == "general" and $tipo == "general" )
{
?>
<table cellpadding="0" cellspacing="0" border="1" class="fila">
<?php
$sql2="select * from proyectos where freal='0000-00-00' and correlativo!='NO_ES_PROYECTO' and area='$areas'";
$result2 = mysql_query($sql2,$conexion);

while ( $proyectos=mysql_fetch_array($result2) )
{
$correlativo=$proyectos['codigo'];
$nombre=$proyectos['nombre'];
$descripcionp=$proyectos['descripcionp'];
$empresa=$proyectos['empresa'];
$area=$proyectos['area'];
$coordinador=$proyectos['coordinador'];
$inicio=$proyectos['finicio'];

echo '<tr>';
echo '<td width="130px" height="20px" align="center" >'; echo $correlativo; echo'</td>';
echo '<td width="322px" height="20px" style="line-height:normal;" >'; echo $nombre; echo'</td>';
echo '<td width="217px" height="20px" style="line-height:normal">'; if( $descripcionp != NULL ){ echo $descripcionp; }else{ echo ' '; }; echo'</td>';
echo '<td width="95px" height="20px" align="center" >'; echo $empresa; echo'</td>';
echo '<td width="55px" height="20px" align="center" >'; echo $area; echo'</td>';
echo '<td width="111px" height="20px" align="center" >'; echo $coordinador; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $inicio; echo'</td>';
echo '</tr>';
}
?>
</table>

<?php
}

if( $areas == "general" and $empresas != "general" and $tipo == "general")
{
?>

<table cellpadding="0" cellspacing="0" border="1" class="fila">
<?php
$sql2="select * from proyectos where freal='0000-00-00' and correlativo!='NO_ES_PROYECTO' and empresa='$empresas'";
$result2 = mysql_query($sql2,$conexion);

while ( $proyectos=mysql_fetch_array($result2) )
{
$correlativo=$proyectos['codigo'];
$nombre=$proyectos['nombre'];
$descripcionp=$proyectos['descripcionp'];
$empresa=$proyectos['empresa'];
$area=$proyectos['area'];
$coordinador=$proyectos['coordinador'];
$inicio=$proyectos['finicio'];

echo '<tr>';
echo '<td width="130px" height="20px" align="center" >'; echo $correlativo; echo'</td>';
echo '<td width="322px" height="20px" style="line-height:normal;" >'; echo $nombre; echo'</td>';
echo '<td width="217px" height="20px" style="line-height:normal">'; if( $descripcionp != NULL ){ echo $descripcionp; }else{ echo ' '; }; echo'</td>';
echo '<td width="95px" height="20px" align="center" >'; echo $empresa; echo'</td>';
echo '<td width="55px" height="20px" align="center" >'; echo $area; echo'</td>';
echo '<td width="111px" height="20px" align="center" >'; echo $coordinador; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $inicio; echo'</td>';
echo '</tr>';
}
?>
</table>


<?php
}

if( $areas == "general" and $empresas == "general" and $tipo != "general")
{
?>

<table cellpadding="0" cellspacing="0" border="1" class="fila">
<?php
$sql2="select * from proyectos where freal='0000-00-00' and correlativo!='NO_ES_PROYECTO' and tipo='$tipo'";
$result2 = mysql_query($sql2,$conexion);

while ( $proyectos=mysql_fetch_array($result2) )
{
$correlativo=$proyectos['codigo'];
$nombre=$proyectos['nombre'];
$descripcionp=$proyectos['descripcionp'];
$empresa=$proyectos['empresa'];
$area=$proyectos['area'];
$coordinador=$proyectos['coordinador'];
$inicio=$proyectos['finicio'];

echo '<tr>';
echo '<td width="130px" height="20px" align="center" >'; echo $correlativo; echo'</td>';
echo '<td width="322px" height="20px" style="line-height:normal;" >'; echo $nombre; echo'</td>';
echo '<td width="217px" height="20px" style="line-height:normal">'; if( $descripcionp != NULL ){ echo $descripcionp; }else{ echo ' '; }; echo'</td>';
echo '<td width="95px" height="20px" align="center" >'; echo $empresa; echo'</td>';
echo '<td width="55px" height="20px" align="center" >'; echo $area; echo'</td>';
echo '<td width="111px" height="20px" align="center" >'; echo $coordinador; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $inicio; echo'</td>';
echo '</tr>';
}
?>
</table>


<?php
}

if( $areas != "general" and $empresas != "general" and $tipo == "general")
{
?>

<table cellpadding="0" cellspacing="0" border="1" class="fila">
<?php
$sql2="select * from proyectos where freal='0000-00-00' and correlativo!='NO_ES_PROYECTO' and empresa='$empresas' and area='$areas'";
$result2 = mysql_query($sql2,$conexion);

while ( $proyectos=mysql_fetch_array($result2) )
{
$correlativo=$proyectos['codigo'];
$nombre=$proyectos['nombre'];
$descripcionp=$proyectos['descripcionp'];
$empresa=$proyectos['empresa'];
$area=$proyectos['area'];
$coordinador=$proyectos['coordinador'];
$inicio=$proyectos['finicio'];

echo '<tr>';
echo '<td width="130px" height="20px" align="center" >'; echo $correlativo; echo'</td>';
echo '<td width="322px" height="20px" style="line-height:normal;" >'; echo $nombre; echo'</td>';
echo '<td width="217px" height="20px" style="line-height:normal">'; if( $descripcionp != NULL ){ echo $descripcionp; }else{ echo ' '; }; echo'</td>';
echo '<td width="95px" height="20px" align="center" >'; echo $empresa; echo'</td>';
echo '<td width="55px" height="20px" align="center" >'; echo $area; echo'</td>';
echo '<td width="111px" height="20px" align="center" >'; echo $coordinador; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $inicio; echo'</td>';
echo '</tr>';
}
?>
</table>


<?php
}

if( $areas == "general" and $empresas != "general" and $tipo != "general")
{
?>

<table cellpadding="0" cellspacing="0" border="1" class="fila">
<?php
$sql2="select * from proyectos where freal='0000-00-00' and correlativo!='NO_ES_PROYECTO' and empresa='$empresas' and tipo='$tipo' ";
$result2 = mysql_query($sql2,$conexion);

while ( $proyectos=mysql_fetch_array($result2) )
{
$correlativo=$proyectos['codigo'];
$nombre=$proyectos['nombre'];
$descripcionp=$proyectos['descripcionp'];
$empresa=$proyectos['empresa'];
$area=$proyectos['area'];
$coordinador=$proyectos['coordinador'];
$inicio=$proyectos['finicio'];

echo '<tr>';
echo '<td width="130px" height="20px" align="center" >'; echo $correlativo; echo'</td>';
echo '<td width="322px" height="20px" style="line-height:normal;" >'; echo $nombre; echo'</td>';
echo '<td width="217px" height="20px" style="line-height:normal">'; if( $descripcionp != NULL ){ echo $descripcionp; }else{ echo ' '; }; echo'</td>';
echo '<td width="95px" height="20px" align="center" >'; echo $empresa; echo'</td>';
echo '<td width="55px" height="20px" align="center" >'; echo $area; echo'</td>';
echo '<td width="111px" height="20px" align="center" >'; echo $coordinador; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $inicio; echo'</td>';
echo '</tr>';
}
?>
</table>


<?php
}

if( $areas != "general" and $empresas == "general" and $tipo != "general")
{
?>

<table cellpadding="0" cellspacing="0" border="1" class="fila">
<?php
$sql2="select * from proyectos where freal='0000-00-00' and correlativo!='NO_ES_PROYECTO' and area='$areas' and tipo='$tipo' ";
$result2 = mysql_query($sql2,$conexion);

while ( $proyectos=mysql_fetch_array($result2) )
{
$correlativo=$proyectos['codigo'];
$nombre=$proyectos['nombre'];
$descripcionp=$proyectos['descripcionp'];
$empresa=$proyectos['empresa'];
$area=$proyectos['area'];
$coordinador=$proyectos['coordinador'];
$inicio=$proyectos['finicio'];

echo '<tr>';
echo '<td width="130px" height="20px" align="center" >'; echo $correlativo; echo'</td>';
echo '<td width="322px" height="20px" style="line-height:normal;" >'; echo $nombre; echo'</td>';
echo '<td width="217px" height="20px" style="line-height:normal">'; if( $descripcionp != NULL ){ echo $descripcionp; }else{ echo ' '; }; echo'</td>';
echo '<td width="95px" height="20px" align="center" >'; echo $empresa; echo'</td>';
echo '<td width="55px" height="20px" align="center" >'; echo $area; echo'</td>';
echo '<td width="111px" height="20px" align="center" >'; echo $coordinador; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $inicio; echo'</td>';
echo '</tr>';
}
?>
</table>


<?php
}

}//FIN IF DESCRIPCION == SI


?>





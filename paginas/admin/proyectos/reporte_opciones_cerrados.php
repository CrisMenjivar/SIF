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

$areas = $_GET['area'];
$empresas = $_GET['empresa'];
$tipo = $_GET['tipo'];
$cantidad = $_GET['cantidad'];

if( $cantidad != 0 and $cantidad != '0' )
{

if( $cantidad != "" )
{
   $cantidad = (int)$cantidad;
   $cantidad = $cantidad*60;
}

}


if( $cantidad == '0' )
{
$cantidad=1;
}

if( $cantidad == "")
{

if( $areas == "general" and $empresas == "general" and $tipo == "general" )
{
?>

<table class="fila" cellpadding="0" cellspacing="0" border="1">
<?php
$sql2="select * from proyectos where freal!='0000-00-00' and correlativo!='NO_ES_PROYECTO' ";
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
$cierre=$proyectos['freal'];
$anio=$proyectos['year'];

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
}
?>
</table>


<?php
}

if( $areas != "general" and $empresas != "general" and $tipo != "general")
{
?>

<table class="fila" cellpadding="0" cellspacing="0" border="1">
<?php
$sql2="select * from proyectos where freal!='0000-00-00' and correlativo!='NO_ES_PROYECTO' and area='$areas' and empresa='$empresas' and tipo='$tipo'";
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
$cierre=$proyectos['freal'];
$anio=$proyectos['year'];

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
}
?>
</table>


<?php
}


if( $areas != "general" and $empresas == "general" and $tipo == "general" )
{
?>
<table class="fila" cellpadding="0" cellspacing="0" border="1">
<?php
$sql2="select * from proyectos where freal!='0000-00-00' and correlativo!='NO_ES_PROYECTO' and area='$areas'";
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
$cierre=$proyectos['freal'];
$anio=$proyectos['year'];

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
}
?>
</table>

<?php
}

if( $areas == "general" and $empresas != "general" and $tipo == "general")
{
?>

<table class="fila" cellpadding="0" cellspacing="0" border="1">
<?php
$sql2="select * from proyectos where freal!='0000-00-00' and correlativo!='NO_ES_PROYECTO' and empresa='$empresas'";
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
$cierre=$proyectos['freal'];
$anio=$proyectos['year'];

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
}
?>
</table>


<?php
}

if( $areas == "general" and $empresas == "general" and $tipo != "general")
{
?>

<table class="fila" cellpadding="0" cellspacing="0" border="1">
<?php
$sql2="select * from proyectos where freal!='0000-00-00' and correlativo!='NO_ES_PROYECTO' and tipo='$tipo'";
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
$cierre=$proyectos['freal'];
$anio=$proyectos['year'];

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
}
?>
</table>


<?php
}

if( $areas != "general" and $empresas != "general" and $tipo == "general")
{
?>

<table class="fila" cellpadding="0" cellspacing="0" border="1">
<?php
$sql2="select * from proyectos where freal!='0000-00-00' and correlativo!='NO_ES_PROYECTO' and empresa='$empresas' and area='$areas'";
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
$cierre=$proyectos['freal'];
$anio=$proyectos['year'];

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
}
?>
</table>


<?php
}

if( $areas == "general" and $empresas != "general" and $tipo != "general")
{
?>

<table class="fila" cellpadding="0" cellspacing="0" border="1">
<?php
$sql2="select * from proyectos where freal!='0000-00-00' and correlativo!='NO_ES_PROYECTO' and empresa='$empresas' and tipo='$tipo' ";
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
$cierre=$proyectos['freal'];
$anio=$proyectos['year'];

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
}
?>
</table>


<?php
}

if( $areas != "general" and $empresas == "general" and $tipo != "general")
{
?>

<table class="fila" cellpadding="0" cellspacing="0" border="1">
<?php
$sql2="select * from proyectos where freal!='0000-00-00' and correlativo!='NO_ES_PROYECTO' and area='$areas' and tipo='$tipo' ";
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
$cierre=$proyectos['freal'];
$anio=$proyectos['year'];

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
}
?>
</table>


<?php
}


}





/*#####################################################################################################################################################*/
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

/*

select codigo,nombre,proyectos.empresa,area,coordinador,finicio,fcierre,freal,proyectos.year from proyectos inner join 
(select cproyecto,sum(ast.totalhoras) from ast group by cproyecto) as pcantidad on pcantidad.cproyecto=correlativo where freal!='0000-00-00' and correlativo!='NO_ES_PROYECTO'

select codigo,nombre,proyectos.empresa,area,coordinador,finicio,fcierre,freal,proyectos.year,sum(ast.totalhoras) as total from proyectos inner join ast on cproyecto=correlativo where freal!='0000-00-00' and correlativo!='NO_ES_PROYECTO'

*/


if(  $cantidad != "" )
{


if( $areas == "general" and $empresas == "general" and $tipo == "general" )
{
?>

<table class="fila" cellpadding="0" cellspacing="0" border="1">
<?php
$sql2="select * from proyectos where freal!='0000-00-00' and correlativo!='99' ";
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
$cierre=$proyectos['freal'];
$anio=$proyectos['year'];

$pro=$proyectos['correlativo'];

$variable = "select sum(totalhoras) as total from ast where cproyecto='$pro' ";
$variable1 = mysql_query($variable,$conexion);
$variable2 = mysql_fetch_array($variable1);

$variable3 = $variable2['total'];

if( $variable3 == NULL )
{
   $variable3=0;
}

if( $variable3 <= $cantidad )
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
}


}//fin while
?>
</table>


<?php
}

if( $areas != "general" and $empresas != "general" and $tipo != "general")
{
?>

<table class="fila" cellpadding="0" cellspacing="0" border="1">
<?php
$sql2="select * from proyectos where freal!='0000-00-00' and correlativo!='99' and area='$areas' and empresa='$empresas' and tipo='$tipo'";

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
$cierre=$proyectos['freal'];
$anio=$proyectos['year'];

$pro=$proyectos['correlativo'];

$variable = "select sum(totalhoras) as total from ast where cproyecto='$pro' ";
$variable1 = mysql_query($variable,$conexion);
$variable2 = mysql_fetch_array($variable1);

$variable3 = $variable2['total'];

if( $variable3 == NULL )
{
   $variable3=0;
}

if( $variable3 <= $cantidad )
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
}



}
?>
</table>


<?php
}


if( $areas != "general" and $empresas == "general" and $tipo == "general" )
{
?>
<table class="fila" cellpadding="0" cellspacing="0" border="1">
<?php
$sql2="select * from proyectos where freal!='0000-00-00' and correlativo!='99' and area='$areas'";
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
$cierre=$proyectos['freal'];
$anio=$proyectos['year'];

$pro=$proyectos['correlativo'];

$variable = "select sum(totalhoras) as total from ast where cproyecto='$pro' ";
$variable1 = mysql_query($variable,$conexion);
$variable2 = mysql_fetch_array($variable1);

$variable3 = $variable2['total'];

if( $variable3 == NULL )
{
   $variable3=0;
}

if( $variable3 <= $cantidad )
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
}


}
?>
</table>

<?php
}

if( $areas == "general" and $empresas != "general" and $tipo == "general")
{
?>

<table class="fila" cellpadding="0" cellspacing="0" border="1">
<?php
$sql2="select * from proyectos where freal!='0000-00-00' and correlativo!='99' and empresa='$empresas'";
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
$cierre=$proyectos['freal'];
$anio=$proyectos['year'];

$pro=$proyectos['correlativo'];

$variable = "select sum(totalhoras) as total from ast where cproyecto='$pro' ";
$variable1 = mysql_query($variable,$conexion);
$variable2 = mysql_fetch_array($variable1);

$variable3 = $variable2['total'];

if( $variable3 == NULL )
{
   $variable3=0;
}

if( $variable3 <= $cantidad )
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
}


}
?>
</table>


<?php
}

if( $areas == "general" and $empresas == "general" and $tipo != "general")
{
?>

<table class="fila" cellpadding="0" cellspacing="0" border="1">
<?php
$sql2="select * from proyectos where freal!='0000-00-00' and correlativo!='99' and tipo='$tipo'";
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
$cierre=$proyectos['freal'];
$anio=$proyectos['year'];

$pro=$proyectos['correlativo'];

$variable = "select sum(totalhoras) as total from ast where cproyecto='$pro' ";
$variable1 = mysql_query($variable,$conexion);
$variable2 = mysql_fetch_array($variable1);

$variable3 = $variable2['total'];

if( $variable3 == NULL )
{
   $variable3=0;
}

if( $variable3 <= $cantidad )
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
}


}
?>
</table>


<?php
}

if( $areas != "general" and $empresas != "general" and $tipo == "general")
{
?>

<table class="fila" cellpadding="0" cellspacing="0" border="1">
<?php
$sql2="select * from proyectos where freal!='0000-00-00' and correlativo!='99' and empresa='$empresas' and area='$areas'";
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
$cierre=$proyectos['freal'];
$anio=$proyectos['year'];

$pro=$proyectos['correlativo'];

$variable = "select sum(totalhoras) as total from ast where cproyecto='$pro' ";
$variable1 = mysql_query($variable,$conexion);
$variable2 = mysql_fetch_array($variable1);

$variable3 = $variable2['total'];

if( $variable3 == NULL )
{
   $variable3=0;
}

if( $variable3 <= $cantidad )
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
}


}
?>
</table>


<?php
}

if( $areas == "general" and $empresas != "general" and $tipo != "general")
{
?>

<table class="fila" cellpadding="0" cellspacing="0" border="1">
<?php
$sql2="select * from proyectos where freal!='0000-00-00' and correlativo!='99' and empresa='$empresas' and tipo='$tipo' ";
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
$cierre=$proyectos['freal'];
$anio=$proyectos['year'];

$pro=$proyectos['correlativo'];

$variable = "select sum(totalhoras) as total from ast where cproyecto='$pro' ";
$variable1 = mysql_query($variable,$conexion);
$variable2 = mysql_fetch_array($variable1);

$variable3 = $variable2['total'];

if( $variable3 == NULL )
{
   $variable3=0;
}

if( $variable3 <= $cantidad )
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
}


}
?>
</table>


<?php
}

if( $areas != "general" and $empresas == "general" and $tipo != "general")
{
?>

<table class="fila" cellpadding="0" cellspacing="0" border="1">
<?php
$sql2="select * from proyectos where freal!='0000-00-00' and correlativo!='99' and area='$areas' and tipo='$tipo' ";
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
$cierre=$proyectos['freal'];
$anio=$proyectos['year'];

$pro=$proyectos['correlativo'];

$variable = "select sum(totalhoras) as total from ast where cproyecto='$pro' ";
$variable1 = mysql_query($variable,$conexion);
$variable2 = mysql_fetch_array($variable1);

$variable3 = $variable2['total'];

if( $variable3 == NULL )
{
   $variable3=0;
}

if( $variable3 <= $cantidad )
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
}


}
?>
</table>


<?php
}


}// fin cantidad != ""





















?>





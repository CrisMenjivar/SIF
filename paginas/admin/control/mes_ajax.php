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

$mes=$_GET['mes'];
$year=$_GET['anio'];
$area=$_GET['area'];
$cantidad=1;

$meses=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');

if( $mes != "" AND $year != "" AND $area != "" )
{ 

if( $mes < 10 )
{
$m="0".$mes;
}
else
{
$m=$mes;
}

switch($mes)
{
Case 1:
$diaI="1";
$diaF="31";
break;
Case 2:
$diaI="1";
$diaF="28";
break;
Case 3:
$diaI="1";
$diaF="31";
break;
Case 4:
$diaI="1";
$diaF="30";
break;
Case 5:
$diaI="1";
$diaF="31";
break;
Case 6:
$diaI="1";
$diaF="30";
break;
Case 7:
$diaI="1";
$diaF="31";
break;
Case 8:
$diaI="1";
$diaF="31";
break;
Case 9:
$diaI="1";
$diaF="30";
break;
Case 10:
$diaI="1";
$diaF="31";
break;
Case 11:
$diaI="1";
$diaF="30";
break;
Case 12:
$diaI="1";
$diaF="31";
break;
}

$query="select user from usuarios where area='$area' and estado='a' ";
$res=mysql_query($query,$conexion);

?>

<table class="fila" width="997px" border="0" cellpadding="1" cellspacing="1" style="border-color:#000099;"> <!-- border="1px" cellpadding="0px" cellspacing="0px" align="center" bordercolor="black"  -->
<tr style="background-color:#CFCFCF;" >
<td width="100px" height="16px" align="center" rowspan="2">Nombre del colaborador</td>
<td height="16px" align="center" colspan="31" style="font-weight:bold;"><?php echo $meses[$mes-1]; echo ' -- '; echo $year; ?></td>
</tr>
<tr style="background-color:#CFCFCF;">
<?php

for( $k = $diaI ; $k <= $diaF ; $k++ )
{
if( $k<10)
{
$day="0".$k;
}
else
{
$day=$k;
}

$nameday=date("l", mktime(0, 0, 0, $mes, $day, $year));

?>

<?php
if( $nameday=="Saturday" || $nameday=="Sunday" )
{
?>
<td width="25px" height="16px" align="center" style="font-weight:bold;background-color:#0070c0"><?php echo $day; ?></td>
<?php
}
else
{
?>
<td width="25px" height="16px" align="center" style="font-weight:bold;"><?php echo $day; ?></td>
<?php
}

?>

<!--
<td width="25px" height="16px" align="center" style="font-weight:bold;"><?php echo $day; ?></td>
-->

<?php

}
?>
</tr>
<?php

$sin=0;
$cuantos=0;

while( $res1=mysql_fetch_array($res) ) //while de los usuarios
{
$persona=$res1['user'];
$cuantos++;
?>

<?php


//INICIAMOS CODIGO PARA VERIFICAR LA FECHA DE EMISION Y RETRASOS
$totalreg=0;
$based=0;

$ddd=date("d");
$mmm=date("m");

if( $mmm > $mes )
{

for( $x = $diaI ; $x <= $diaF ; $x++ )
{
if( $x<10){ $day="0".$x; }else{ $day=$x; }

$nameday3=date("l", mktime(0, 0, 0, $mes, $day, $year));

if( $nameday3=="Saturday" || $nameday3=="Sunday" )
{
}
else
{
$based++;

$sql="SELECT count(totalhoras) as total FROM ast inner join usuarios on user=usuario WHERE usuario='$persona' and area='$area' and fecha='$year-$m-$day'";
$cuenta=mysql_query($sql,$conexion);

$resultado=mysql_fetch_array($cuenta);
$yes=$resultado['total'];

if( $yes != 0 )
{
$totalreg++;
}


}//fin else q verifica q no sea sabado ni domingo

}//fin for


}
else
{

for( $k = 1 ; $k < $ddd; $k++ )
{
if( $k<10){ $day="0".$k; }else { $day=$k; }

$nameday4=date("l", mktime(0, 0, 0, $mes, $day, $year));

if( $nameday4=="Saturday" || $nameday4=="Sunday" )
{
}
else
{
$based++;

$sql="SELECT count(totalhoras) as total FROM ast inner join usuarios on user=usuario WHERE usuario='$persona' and area='$area' and fecha='$year-$m-$day'";
$cuenta=mysql_query($sql,$conexion);

$resultado=mysql_fetch_array($cuenta);
$yes3=$resultado['total'];

if( $yes3 != 0 )
{
$totalreg++;
}

}//fin else que verifica q no sea sabado o domingo

}//fin for


}//fin else mes elejido es menor


$based=$based-3;

if( $totalreg < $based )
{
$estado=1;
}
else
{
$estado=0;
}


?>


<tr style="background-color:#A2B5CD;">

<?php
if( $estado==1)
{
?>
<td width="100px" height="16px" align="center" style="color:red;font-weight:bold;text-align:left;background-color:#CFCFCF;" >&nbsp;<?php echo $persona; ?></td>
<?php
}
else
{
$sin++;

?>
<td width="100px" height="16px" align="center" style="text-align:left;background-color:#CFCFCF;" >&nbsp;<?php echo $persona; ?></td>
<?php
}

?>



<?php

for( $x = $diaI ; $x <= $diaF ; $x++ )
{
if( $x<10)
{
$day="0".$x;
}
else
{
$day=$x;
}

$sql="SELECT count(totalhoras) as total FROM ast inner join usuarios on user=usuario WHERE usuario='$persona' and area='$area' and fecha='$year-$m-$day'";
$cuenta=mysql_query($sql,$conexion);

$resultado=mysql_fetch_array($cuenta);
$yes=$resultado['total'];
?>

<?php
$nameday2=date("l", mktime(0, 0, 0, $mes, $x, $year));


if( $nameday2=="Saturday" || $nameday2=="Sunday" )
{
?>
<td width="25px" height="16px" align="center" style="color:red;font-weight:bold;background-color:#0070c0"><?php if( $yes != 0 ){ echo 'X'; }else{ } ?></td>
<?php
}
else
{
?>
<td width="25px" height="16px" align="center" style="color:red;font-weight:bold;"><?php if( $yes != 0 ){ echo 'X'; }else{ } ?></td>
<?php
}
?>



<?php

}//fin del for de las columnas
?>
</tr>
<?php
}//fin while de los usuarios
?>
</table>

<br>
<table width="708px" style="background-color:#CFCFCF;border-color:#000099;" border="0" cellpadding="1" cellspacing="1" >
<tr>
<td width="118px" style="font-weight:bold;text-align:center">Porcentaje</td>
<td width="118px" style="font-weight:bold;text-align:center">
<?php
$ft=(($sin/$cuantos)*100);

echo number_format($ft,2);
?>

</td>

<td width="118px" style="font-weight:bold;text-align:center">En tiempo</td>
<td width="118px" style="font-weight:bold;text-align:center"><?php echo $sin; ?></td>

<td width="118px" style="font-weight:bold;text-align:center">Colaboradores</td>
<td width="118px" style="font-weight:bold;text-align:center"><?php echo $cuantos; ?></td>


</tr>
</table>

<?php
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link href="../../../../estilo/final_reportes.css" rel="stylesheet" type="text/css" />

<script language="javascript" type="text/javascript" src="../../../../js/seguridad.js"></script>

<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Reporte por empresas</title>

<style type="text/css">
.auto-style2 {
border-width: 1px;
background-color: #3B5998;
color:white;
text-align:right;
}
.auto-style3 {
border-width: 1px;
text-align:right;
}
.auto-style8 {
border-width: 1px;
background-color: #3B5998;
color:white;
}
</style>

</head>

<body>
<?php

//Verificamos que el usuario haya iniciado sesion
session_start();
if($_SESSION['user']=="")
{
header ("Location: ../../../../index.php");
}

$areass=$_SESSION['empresa_area'];
$fecha1=$_SESSION['empresa_inicio'];
$fecha2=$_SESSION['empresa_fin'];
$proyecto=$_SESSION['empresa_proyecto'];
$anio_reporte=$_SESSION['empresa_year'];


$userid=$_SESSION['user'];
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

?>


<div id="contenedor">
<div id="encabezadologin" style="height: 81px">

<div id="logo">
<div id="logoimagen">
<img src="../../../../imagenes/sites.png" alt="sites"/>
</div>
<div id="textologo">
<p>Shared IT Enterprise Services</p>
</div>
</div>

<div id="astdes">
<p style="font-size:20px;">Horas dedicadas a proyectos por empresa -- <?php echo $areass; ?></p>
</div>
</div>

<div id="contedatos" style="height: 37px">

<div id="contelinea">
<div id="contederecha" style="width: 489px">
<p>
<b> <span >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Periodo</span> :
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo $fecha1; ?>&nbsp;&nbsp;&nbsp;&nbsp; al &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $fecha2; ?>
</b>
</p>
</div>
</div>
</div>

<div id="linea"></div>


<div id="conti" style="margin-left:110px; width: 797px;">

<div id="tem" style="width: 796px">
<p style="width: 792px">Proyecto</p>
</div>

<div id="contenidos">
<table width="795px" border="1" >
<tr>
<td width="170px" align="center"><strong>Correlativo</strong></td>
<td width="430px" align="center"><strong>Nombre proyecto</strong></td>
<td width="192px" align="center"><strong>Coordinador</strong></td>
</tr>

<?php 
$query="select * from proyectos where correlativo='$proyecto'";
$res100=mysql_query($query,$conexion);

$xy=0;
        
while( $rest=mysql_fetch_array($res100) ) //while de los proyectos
{
$correlativo=$rest['correlativo'];
$nombre=$rest['nombre'];
$coordinador=$rest['coordinador'];

echo '<tr>';
echo '<td width="170px" align="center">'; echo $correlativo; echo '</td>';
echo '<td width="430px" align="left">'; echo $nombre; echo '</td>';
echo '<td width="180px" align="center">'; echo $coordinador; echo '</td>';
echo '</tr>';

}
?>

</table>
</div>
</div>



<!-- **************************************************************************************************************************************************************** -->
<?php

//total por utilizacion
$sql4="select sum(totalhoras) as total from ast where cproyecto='$proyecto' and fecha BETWEEN '$fecha1' AND '$fecha2'";

//contamos los usuarios para sacar los promedios
$sql5="select count(codigo) as total from area where estado='a' ";


$utilizacion = mysql_query($sql4,$conexion);
$promedios = mysql_query($sql5,$conexion);
$tpromedios=mysql_fetch_array($promedios);


?>
<div id="consolidado" style="margin-left:110px;">

<div id="colaboradores" style="margin-left:150px;">
<table border="1px" cellpadding="0" cellspacing="0">
<tr>
<td class="auto-style2" colspan="1" style="text-align:center; height: 22px;"><strong>&Aacute;reas</strong></td>
<td colspan="1" style="text-align:center; height: 22px;background-color: #3B5998;color:white;"><strong>Horas</strong></td>
<?php
$resultado4=mysql_fetch_array($utilizacion);
$uti=$resultado4['total'];
//echo '<td width="70px" class="auto-style1">'; echo'</td>'; //echo $uti; echo' mins</td>';
?>
</tr>

<?php

//consulta para horas totales de empleados por areas
$queryss="select codigo from area where estado='a'";
$arr = mysql_query($queryss,$conexion);
$divisorrr=0;

while ( $resti=mysql_fetch_array($arr) )
{

$areas5=$resti['codigo'];

$sql40="select count(ast.totalhoras) as total from ast inner join usuarios on user=usuario where area='$areas5' and cproyecto='$proyecto' and fecha BETWEEN '$fecha1' AND '$fecha2' ";
$tar = mysql_query($sql40,$conexion);
$resultad6=mysql_fetch_array($tar);
$val6=$resultad6['total'];


if( $val6 == 0 )
{
echo '<tr>';
echo '<td>'; echo $areas5; echo '</td>';
echo '<td width="70px" class="auto-style5" style="text-align:right;">'; echo '0'; echo ' &nbsp;</td>';
echo '</tr>';

}
else
{
$divisorrr++;

$sql1="select area, sum(ast.totalhoras) as total from ast inner join usuarios on usuario=user where area='$areas5' and cproyecto='$proyecto' and fecha BETWEEN '$fecha1' AND '$fecha2' group by area";
$templeados = mysql_query($sql1,$conexion);


while ( $resultado1=mysql_fetch_array($templeados) )
{
echo '<tr>';
echo '<td>'; echo ucwords(strtr($resultado1['area'],'_',' ')); echo '</td>';
echo '<td width="70px" class="auto-style5" style="text-align:right;">'; 

$valor2=$resultado1['total']; 

$h=0;
			
			while( $valor2 != 0 )
			{
				if( $valor2 >= 60 )
				{
					$h=$h+1;
					$valor2=$valor2-60;
				}
				else
				{
				   if( $valor2 >= 10 )
				   {
				   		$h=$h.'.'.$valor2;
				   		$valor2=$valor2-$valor2;
				   }
				   else
				   {
				   		$h=$h.'.0'.$valor2;
				   		$valor2=$valor2-$valor2;
				   }
				}
			}
			
echo $h;


echo ' &nbsp;</td>';


echo '</tr>';
}//fin while evaluando las areas


}

}//fin while que selecciono las areas

?>
<tr>
<td class="auto-style2" style="text-align:center;font-weight:bold;">Total</td>
<td style="text-align:right;">

<?php 

$valor2=$uti; 

$h=0;
			
			while( $valor2 != 0 )
			{
				if( $valor2 >= 60 )
				{
					$h=$h+1;
					$valor2=$valor2-60;
				}
				else
				{
				   if( $valor2 >= 10 )
				   {
				   		$h=$h.'.'.$valor2;
				   		$valor2=$valor2-$valor2;
				   }
				   else
				   {
				   		$h=$h.'.0'.$valor2;
				   		$valor2=$valor2-$valor2;
				   }
				}
			}
			
echo $h;


echo' &nbsp;'; 

?>

</td>


</tr>
</table>
</div>

<div id="actividades" style="margin-left:10px;">
<table border="1px" cellpadding="0" cellspacing="0">
<tr>
<td align="center" class="auto-style2" colspan="1" style="text-align:center;font-weight:bold;">Utilizaci&oacute;n</td>
<td colspan="1" style="text-align:center; height: 22px;background-color: #3B5998;color:white; width: 81px;"><strong>Horas</strong></td>
<?php
//echo '<td width="70px" class="auto-style1">'; echo $uti; echo' mins</td>';
?>
<td align="center" class="auto-style8" style="text-align:center;font-weight:bold;font-size:12px; width: 85px;">Promedios</td>
</tr>
<?php
$prom=0;

$ques="select tipoact,nombre from actividad order by nombre asc";
$resu = mysql_query($ques,$conexion);

while ( $actis=mysql_fetch_array($resu) )
{

$actividadd=$actis['tipoact'];

$sql20="select count(ast.totalhoras) as total from ast where tipoact='$actividadd' and cproyecto='$proyecto' and fecha BETWEEN '$fecha1' AND '$fecha2' ";
$tac = mysql_query($sql20,$conexion);
$resultad=mysql_fetch_array($tac);
$val=$resultad['total'];

if( $val == 0 )
{
echo '<tr>';
echo '<td>'; echo strtr($actis['nombre'],'_',' '); echo'</td>';
echo '<td class="auto-style3">'; echo '0'; echo ' &nbsp;</td>';

echo '<td class="auto-style3">'; echo "0"; echo ' &nbsp;</td>';
echo '</tr>';


}
else
{

//consulta de total de horas por actividad
$sql2="select ast.tipoact,sum(ast.totalhoras) as total,actividad.nombre from ast inner join actividad on actividad.tipoact=ast.tipoact where ast.tipoact='$actividadd' and cproyecto='$proyecto' and fecha BETWEEN '$fecha1' AND '$fecha2' group by tipoact order by actividad.nombre asc";
$tactividades = mysql_query($sql2,$conexion);


while ( $resultado2=mysql_fetch_array($tactividades) )
{
echo '<tr>';
echo '<td>'; echo strtr($resultado2['nombre'],'_',' '); echo'</td>';
echo '<td class="auto-style3">'; 


$valor2=$resultado2['total']; 

$h=0;
			
			while( $valor2 != 0 )
			{
				if( $valor2 >= 60 )
				{
					$h=$h+1;
					$valor2=$valor2-60;
				}
				else
				{
				   if( $valor2 >= 10 )
				   {
				   		$h=$h.'.'.$valor2;
				   		$valor2=$valor2-$valor2;
				   }
				   else
				   {
				   		$h=$h.'.0'.$valor2;
				   		$valor2=$valor2-$valor2;
				   }
				}
			}
			
echo $h;


echo ' &nbsp;</td>';

$valor=$resultado2['total'];
$divisor=$tpromedios['total'];
$res=$valor/$divisorrr;
$prom=$prom+$res;

echo '<td class="auto-style3">'; $res9=round(($res/60) * 100) / 100;  echo $res9; echo ' &nbsp;</td>';
echo '</tr>';
}

}//fin else diferente de cero

}//fin while de las actividades
?>
<tr>
<td class="auto-style2" style="text-align:center;font-weight:bold;">Total</td>

<td style="text-align:right; width: 81px;" >

<?php 

$valor2=$uti; 

$h=0;
			
			while( $valor2 != 0 )
			{
				if( $valor2 >= 60 )
				{
					$h=$h+1;
					$valor2=$valor2-60;
				}
				else
				{
				   if( $valor2 >= 10 )
				   {
				   		$h=$h.'.'.$valor2;
				   		$valor2=$valor2-$valor2;
				   }
				   else
				   {
				   		$h=$h.'.0'.$valor2;
				   		$valor2=$valor2-$valor2;
				   }
				}
			}
			
echo $h;


echo' &nbsp;'; 

?>

</td>


<td class="auto-style3" style="width: 85px" > <?php $prom9=round(($prom/60) * 100) / 100; echo $prom9; ?> &nbsp;</td>
</tr>
</table>
</div>

</div>


<!-- **************************************************************************************************************************************************************** -->

<div id="grafico2">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="empresa_3_actividad_grafico.php">
</iframe>
</div>

<div id="grafico2">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="empresa_3_actividad2_grafico.php">
</iframe>
</div>


</div>

</body>
</html>

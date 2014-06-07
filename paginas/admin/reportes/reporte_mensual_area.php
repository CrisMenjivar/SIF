<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link href="../../../estilo/estilo_reportes1.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../../../js/seguridad.js"></script>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Reporte Mensual</title>
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



//RECUPERAMOS LAS VARIABLES OBTENIDAS DE LA SELECCION DEL PERIODO PARA EL AST

$anio_reporte=$_SESSION['year'];
$mes_reporte=$_SESSION['mes'];
$area_reporte=$_SESSION['area'];

//--------------------------------------------------------------------------


//calculamos los dias--------------------------------

switch ($mes_reporte)
{
Case 1:
$diaI="01";
$diaF="31";
$dia="Enero";
break;
Case 2:
$diaI="01";
$diaF="28";
$dia="Febrero";
break;
Case 3:
$diaI="01";
$diaF="31";
$dia="Marzo";
break;
Case 4:
$diaI="01";
$diaF="30";
$dia="Abril";
break;
Case 5:
$diaI="01";
$diaF="31";
$dia="Mayo";
break;
Case 6:
$diaI="01";
$diaF="30";
$dia="Junio";
break;
Case 7:
$diaI="01";
$diaF="31";
$dia="Julio";
break;
Case 8:
$diaI="01";
$diaF="31";
$dia="Agosto";
break;
Case 9:
$diaI="01";
$diaF="30";
$dia="Septiembre";
break;
Case 10:
$diaI="01";
$diaF="31";
$dia="Octubre";
break;
Case 11:
$diaI="01";
$diaF="30";
$dia="Noviembre";
break;
Case 12:
$diaI="01";
$diaF="31";
$dia="Diciembre";
break;
}


//---------------------------------------------------



$userid=$_SESSION['user'];

//$sql="select * from ( select area as areas, nombre as nombres,tipoact as actividad, sum(ast.totalhoras) as total from ast inner join usuarios on usuario=nombre group by area,tipoact ASC ) as temporal where areas='DAS'";

//consulta para horas totales de empleados por areas
$sql1="select user,area, nombre,sum(ast.totalhoras) as total from ast inner join usuarios on usuario=user where area='$area_reporte' and fecha BETWEEN '$anio_reporte-$mes_reporte-$diaI' AND '$anio_reporte-$mes_reporte-$diaF' group by area,nombre ASC";

//consulta de total de horas por actividad
$sql2="select area,p.tipoact,total,actividad.nombre from actividad inner join (select area, tipoact,sum(ast.totalhoras) as total from ast inner join usuarios on usuario=user where area='$area_reporte' and fecha BETWEEN '$anio_reporte-$mes_reporte-$diaI' AND '$anio_reporte-$mes_reporte-$diaF' group by area,tipoact ASC) as p on actividad.tipoact=p.tipoact order by actividad.nombre ";

//consulta para total de horas por empresas
$sql3="select area, ast.empresa,sum(ast.totalhoras) as total from ast inner join usuarios on usuario=user where area='$area_reporte' and fecha BETWEEN '$anio_reporte-$mes_reporte-$diaI' AND '$anio_reporte-$mes_reporte-$diaF' group by area,ast.empresa ASC";

//total por utilizacion
$sql4="select area,sum(ast.totalhoras) as total from ast inner join usuarios on usuario=user where area='$area_reporte' and fecha BETWEEN '$anio_reporte-$mes_reporte-$diaI' AND '$anio_reporte-$mes_reporte-$diaF' group by area ASC";

//contamos los usuarios para sacar los promedios
$sql5="select count(distinct usuario) as total from ast inner join usuarios on usuario=user where area='$area_reporte' and fecha BETWEEN '$anio_reporte-$mes_reporte-$diaI' AND '$anio_reporte-$mes_reporte-$diaF'";

$templeados = mysql_query($sql1,$conexion);
$tactividades = mysql_query($sql2,$conexion);
$tempresas = mysql_query($sql3,$conexion);
$utilizacion = mysql_query($sql4,$conexion);
$promedios = mysql_query($sql5,$conexion);
$tpromedios=mysql_fetch_array($promedios);

?>


<div id="contenedor" style="height:auto;overflow:hidden;">
<div id="encabezado">
<div id="logo">
<div id="logoimagen">
<img src="../../../imagenes/sites.png" alt="sites"/>
</div>
<div id="textologo"><p>Shared IT Enterprise Services</p></div>
</div>

<div id="descripcion">
<div id="caja"><p>An&aacute;lisis semanal de tiempo -- AST</p></div>
<div id="caja4"><p><b>Reporte mensual de actividades por departamento</b></p></div>
<div id="caja2">
<div id="caja3"><p><b>&Aacute;rea : <?php echo $area_reporte; ?></b></p></div>
<div id="caja3"><p><b>Mes  : <?php echo $dia;  ?></b></p></div>
</div>
</div>
</div>

<div id="consolidado" style="width: 854px">

<div id="colaboradores" style="width: 264px">
<table border="1px" cellpadding="0" cellspacing="0" style="width: 261px">
<tr>
<td class="auto-style2" colspan="1" style="text-align:center;"><strong>Colaboradores</strong></td>
<td colspan="1" style="text-align:center;background-color: #3B5998;color:white; width: 71px;"><strong>Horas</strong></td>
<?php
$resultado4=mysql_fetch_array($utilizacion);
$uti=$resultado4['total'];
//echo '<td width="70px" class="auto-style1">'; echo'</td>'; //echo $uti; echo' mins</td>';
?>
</tr>

<?php
while ( $resultado1=mysql_fetch_array($templeados) )
{
echo '<tr>';
echo '<td>'; echo ucwords(strtr($resultado1['user'],'_',' ')); echo '</td>';
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
}
?>
<tr>
<td class="auto-style2" style="text-align:center;font-weight:bold;">Total</td>
<td style="text-align:right; width: 71px;">

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


echo' &nbsp;'; ?></td>


</tr>
</table>
</div>

<div id="actividades" style="width: 294px; height: 56px">
<table border="1px" cellpadding="0" cellspacing="0" style="width: 293px">
<tr>
<td align="center" class="auto-style2" colspan="1" style="text-align:center;font-weight:bold; width: 121px;">Utilizaci&oacute;n</td>
<td align="center" colspan="1" style="text-align:center;font-weight:bold;background-color: #3B5998;color:white; width: 80px;">Horas</td>
<?php
//echo '<td width="70px" class="auto-style1">'; echo $uti; echo' mins</td>';
?>
<td align="center" class="auto-style8" style="text-align:center;font-weight:bold;font-size:12px;">Promedios</td>
</tr>
<?php
$prom=0;
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
$res=$valor/$divisor;
$prom=$prom+$res;

echo '<td class="auto-style3">'; $res9=round(($res/60) * 100) / 100;  echo $res9; echo ' &nbsp;</td>';
echo '</tr>';
}
?>
<tr>
<td class="auto-style2" style="text-align:center;font-weight:bold; width: 121px;">Total</td>
<td style="text-align:right; width: 80px;" >

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
 

echo' &nbsp;'; ?></td>
<td class="auto-style3" > <?php $prom9=round(($prom/60) * 100) / 100; echo $prom9; ?> &nbsp;</td>
</tr>
</table>
</div>

<div id="empresas" style="width: 291px">
<table border="1px" cellpadding="0" cellspacing="0" style="width: 292px">
<tr>
<td align="center" class="auto-style2" colspan="1" style="text-align:center;font-weight:bold;">Empresas</td>
<td align="center" colspan="1" style="text-align:center;font-weight:bold;background-color: #3B5998;color:white; width: 80px;">Horas</td>
<?php
//echo '<td width="70px" class="auto-style1">'; echo $uti; echo' mins</td>';
?>
<td align="center" class="auto-style8" style="text-align:center;font-weight:bold;font-size:12px;">Promedios</td>
</tr>

<?php
$prom2=0;
while ( $resultado3=mysql_fetch_array($tempresas) )
{
echo '<tr>';
echo '<td>'; echo $resultado3['empresa']; echo'</td>';
echo '<td class="auto-style3">'; 

$valor2=$resultado3['total']; 

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

$valor=$resultado3['total'];
$divisor=$tpromedios['total'];
$res2=$valor/$divisor;
$prom2=$prom2+$res2;

echo '<td class="auto-style3">'; $res10=round(($res2/60) * 100) / 100; echo $res10; echo ' &nbsp;</td>';
echo '</tr>';
}
?>
<tr>
<td class="auto-style2" style="text-align:center;font-weight:bold;">Total</td>
<td style="text-align:right; width: 80px;">
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


echo' &nbsp;'; ?></td>
<td class="auto-style3"> <?php $prom10=round(($prom2/60) * 100) / 100; echo $prom10; ?> &nbsp;</td>
</tr>
</table>
</div>
</div>

<div id="grafico" style="margin-top:320px;">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="grafico_mes_actividad_grafico.php">
</iframe>
</div>

<div id="grafico">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="grafico_mes_empresa_grafico.php">
</iframe>
</div>



</div>

<div id="contenedor" <?php if( $area_reporte == "AMM"){ echo 'style="width:1300px;"';}else{ echo 'style="width:1000px;""';} ?>>

<div id="grafico">
<iframe frameborder="0" <?php if( $area_reporte == "AMM"){ echo 'style="margin-left:0px;" width="1300px"';}else{ echo 'width="1000px"';} ?> scrolling="no" marginheight="0" marginwidth="0" height="500px" src="grafico_mes_colaborador_grafico.php">
</iframe>
</div>


</div>

</body>
</html>

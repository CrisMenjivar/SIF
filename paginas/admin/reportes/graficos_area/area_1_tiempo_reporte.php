<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link href="../../../../estilo/final_reportes.css" rel="stylesheet" type="text/css" />

<script language="javascript" type="text/javascript" src="../../../../js/seguridad.js"></script>

<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Reporte por &aacute;reas</title>

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


$areass=$_SESSION['area_area'];
$finicio=$_SESSION['area_inicio'];
$ffin=$_SESSION['area_fin'];

$inicio = $_SESSION['area_uno'];
$fin = $_SESSION['area_dos'];
$anio = $_SESSION['area_year'];


switch ($fin)
{
Case 1:
$diaII="01";
$diaFF="31";
break;
Case 2:
$diaII="01";
$diaFF="28";
break;
Case 3:
$diaII="01";
$diaFF="31";
break;
Case 4:
$diaII="01";
$diaFF="30";
break;
Case 5:
$diaII="01";
$diaFF="31";
break;
Case 6:
$diaII="01";
$diaFF="30";
break;
Case 7:
$diaII="01";
$diaFF="31";
break;
Case 8:
$diaII="01";
$diaFF="31";
break;
Case 9:
$diaII="01";
$diaFF="30";
break;
Case 10:
$diaII="01";
$diaFF="31";
break;
Case 11:
$diaII="01";
$diaFF="30";
break;
Case 12:
$diaII="01";
$diaFF="31";
break;
}



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
<p>Utilizaci&oacute;n del tiempo general -- <?php echo $areass; ?></p>
</div>
</div>

<div id="contedatos" style="height: 37px">

<div id="contelinea">
<div id="contederecha" style="width: 489px">
<p>
<b> <span >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Periodo</span> :
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo $finicio; ?>&nbsp;&nbsp;&nbsp;&nbsp; al &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $ffin; ?>
</b>
</p>
</div>
</div>
</div>

<div id="linea"></div>



















<div id="consolidado" style="margin-left:auto;margin-right:auto;">

<div id="colaboradores">
<table border="1px" cellpadding="0" cellspacing="0" style="width: 200px">
<tr>
<td class="auto-style2" colspan="1" style="text-align:center; width: 111px;"><strong>Meses</strong></td>
<td colspan="1" style="text-align:center;background-color: #3B5998;color:white"><strong>Horas</strong></td>
<?php

//total por utilizacion
$sql4="select sum(totalhoras) as total from ast inner join usuarios on user=usuario where area='$areass' and fecha BETWEEN '$anio-$inicio-$diaII' AND '$anio-$fin-$diaFF'";

//contamos los usuarios para sacar los promedios
//$sql5="select count(codigo) as total from area where estado='a' ";


$utilizacion = mysql_query($sql4,$conexion);
//$promedios = mysql_query($sql5,$conexion);
//$tpromedios=mysql_fetch_array($promedios);


$resultado4=mysql_fetch_array($utilizacion);
$uti=$resultado4['total'];
//echo '<td width="70px" class="auto-style1">'; echo'</td>'; //echo $uti; echo' mins</td>';
?>
</tr>

<?php
$divisorrr=1;
for( $l=$inicio ; $l<=$fin ; $l++ )
{
if( $l != $fin )
{
$divisorrr++;
}
}

for( $i=$inicio ; $i<=$fin ; $i++ )
{

switch ($i)
{
Case 1:
$mes="Enero";
$diaI="01";
$diaF="31";
break;
Case 2:
$mes="Febrero";
$diaI="01";
$diaF="28";
break;
Case 3:
$mes="Marzo";
$diaI="01";
$diaF="31";
break;
Case 4:
$mes="Abril";
$diaI="01";
$diaF="30";
break;
Case 5:
$mes="Mayo";
$diaI="01";
$diaF="31";
break;
Case 6:
$mes="Junio";
$diaI="01";
$diaF="30";
break;
Case 7:
$mes="Julio";
$diaI="01";
$diaF="31";
break;
Case 8:
$mes="Agosto";
$diaI="01";
$diaF="31";
break;
Case 9:
$mes="Septiembre";
$diaI="01";
$diaF="30";
break;
Case 10:
$mes="Octubre";
$diaI="01";
$diaF="31";
break;
Case 11:
$mes="Noviembre";
$diaI="01";
$diaF="30";
break;
Case 12:
$mes="Diciembre";
$diaI="01";
$diaF="31";
break;
}


$sql40="select count(ast.totalhoras) as total from ast inner join usuarios on user=usuario where area='$areass' and fecha BETWEEN '$anio-$i-$diaI' AND '$anio-$i-$diaF' ";
$tar = mysql_query($sql40,$conexion);
$resultad6=mysql_fetch_array($tar);
$val6=$resultad6['total'];

if( $val6 == 0 )
{
echo '<tr>';
echo '<td>'; echo $mes; echo '</td>';
echo '<td width="70px" class="auto-style5" style="text-align:right;">'; echo '0'; echo ' &nbsp;</td>';
echo '</tr>';

}
else
{

$sql1="select sum(ast.totalhoras) as total from ast inner join usuarios on user=usuario where area='$areass' and fecha BETWEEN '$anio-$i-$diaI' AND '$anio-$i-$diaF'";
$templeados = mysql_query($sql1,$conexion);


while ( $resultado1=mysql_fetch_array($templeados) )
{
echo '<tr>';
echo '<td>'; echo $mes; echo '</td>';
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



}//fin for para evaluar el primer cuadro


?>
<tr>
<td class="auto-style2" style="text-align:center;font-weight:bold; width: 111px;">Total</td>
<td style="text-align:right;"><?php 


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

<div id="actividades">
<table border="1px" cellpadding="0" cellspacing="0">
<tr>
<td align="center" class="auto-style2" colspan="1" style="text-align:center;font-weight:bold; width: 125px;">Utilizaci&oacute;n</td>
<td align="center" colspan="1" style="text-align:center;font-weight:bold;background-color: #3B5998;color:white; width: 80px;">Horas</td>

<?php
//echo '<td width="70px" class="auto-style1">'; echo $uti; echo' mins</td>';
?>
<td align="center" class="auto-style8" style="text-align:center;font-weight:bold;font-size:12px;">Promedios</td>
</tr>
<?php
$prom=0;

$ques="select tipoact,nombre from actividad order by nombre asc";
$resu = mysql_query($ques,$conexion);

while ( $actis=mysql_fetch_array($resu) )
{

$actividadd=$actis['tipoact'];

$sql20="select count(ast.totalhoras) as total from ast inner join usuarios on user=usuario where area='$areass' and tipoact='$actividadd' and fecha BETWEEN '$anio-$inicio-$diaII' AND '$anio-$fin-$diaFF' ";
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
$sql2="select p.tipoact,total,actividad.nombre from actividad inner join (select tipoact,sum(ast.totalhoras) as total from ast inner join usuarios on user=usuario where area='$areass' and tipoact='$actividadd' and fecha BETWEEN '$anio-$inicio-$diaII' AND '$anio-$fin-$diaFF' group by tipoact) as p on p.tipoact=actividad.tipoact order by actividad.nombre asc";
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
$divisor=$divisorrr;
$res=$valor/$divisorrr;
$prom=$prom+$res;

echo '<td class="auto-style3">'; $res9=round(($res/60) * 100) / 100;  echo $res9; echo ' &nbsp;</td>';
echo '</tr>';
}

}//fin else diferente de cero

}//fin while de las actividades
?>
<tr>
<td class="auto-style2" style="text-align:center;font-weight:bold; width: 125px;">Total</td>
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

<div id="empresas">
<table border="1px" cellpadding="0" cellspacing="0">
<tr>
<td align="center" class="auto-style2" colspan="1" style="text-align:center;font-weight:bold; width: 117px;">Empresas</td>
<td align="center" colspan="1" style="text-align:center;font-weight:bold;background-color: #3B5998;color:white; width: 83px;">Horas</td>
<?php
//echo '<td width="70px" class="auto-style1">'; echo $uti; echo' mins</td>';
?>
<td align="center" class="auto-style8" style="text-align:center;font-weight:bold;font-size:12px;">Promedios</td>
</tr>

<?php
$prom2=0;


$ques="select nombre from empresas";
$restu = mysql_query($ques,$conexion);

while ( $empress=mysql_fetch_array($restu) )
{

$empresass=$empress['nombre'];

$sql30="select count(ast.totalhoras) as total from ast inner join usuarios on user=usuario where area='$areass' and ast.empresa='$empresass' and fecha BETWEEN '$anio-$inicio-$diaII' AND '$anio-$fin-$diaFF' ";
$tem = mysql_query($sql30,$conexion);
$resultad2=mysql_fetch_array($tem);
$val2=$resultad2['total'];

if( $val2 == 0 )
{

echo '<tr>';
echo '<td>'; echo $empresass; echo'</td>';
echo '<td class="auto-style3">'; echo "0"; echo ' &nbsp;</td>';

echo '<td class="auto-style3">'; echo "0"; echo ' &nbsp;</td>';
echo '</tr>';

}
else
{

//consulta para total de horas por empresas
$sql3="select ast.empresa,sum(ast.totalhoras) as total from ast inner join usuarios on user=usuario where area='$areass' and ast.empresa='$empresass' and fecha BETWEEN '$anio-$inicio-$diaII' AND '$anio-$fin-$diaFF' group by ast.empresa ASC";
$tempresas = mysql_query($sql3,$conexion);


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
$divisor=$divisorrr;
$res2=$valor/$divisorrr;
$prom2=$prom2+$res2;

echo '<td class="auto-style3">'; $res10=round(($res2/60) * 100) / 100; echo $res10; echo ' &nbsp;</td>';
echo '</tr>';
}

}//fin else

}//fin while de las empresas
?>
<tr>
<td class="auto-style2" style="text-align:center;font-weight:bold; width: 117px;">Total</td>
<td style="text-align:right; width: 83px;">

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


<!-- INICIO DEL AREA DE GRAFICOS -->

<div id="grafico2">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="area_1_actividad_grafico.php">
</iframe>
</div>

<div id="grafico2">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="area_1_empresa_grafico.php">
</iframe>
</div>


<div id="grafico2">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="area_1_utilizacion_grafico.php"> <!--area_1_empresa.php -->
</iframe>
</div>

<div id="grafico2" style="margin-left:auto;margin-right:auto;">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="area_1_promedio_grafico.php">
</iframe>
</div>

</div>

</body>
</html>

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


<div id="contenedor" style="height:auto;overflow:hidden;">
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
<p style="font-size:25px; width: 547px;">Reporte general de proyectos por empresas</p>
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





<!-- **************************************************************************************************************************************************************** -->
<?php

//total por utilizacion
$sql4="select sum(totalhoras) as total from ast where cproyecto!='NO_ES_PROYECTO' and fecha BETWEEN '$fecha1' AND '$fecha2'";

//contamos los usuarios para sacar los promedios
$sql5="select count(codigo) as total from area where estado='a' ";


$utilizacion = mysql_query($sql4,$conexion);
$promedios = mysql_query($sql5,$conexion);
$tpromedios=mysql_fetch_array($promedios);


?>
<div id="consolidado" style="margin-left:110px;">

<div id="colaboradores" style="margin-left:100px;width:300px;">
<table border="1px" cellpadding="0" cellspacing="0" style="width: 300px">
<tr>
<td class="auto-style2" colspan="1" style="text-align:center;"><strong>&Aacute;reas</strong></td>
<td class="auto-style2" colspan="1" style="text-align:center;background-color: #3B5998; width: 67px;"><strong>Horas</strong></td>
<td class="auto-style2" colspan="1" style="text-align:center; height: 22px;width:111px;text-align:center;"><strong>Cantidad proyectos</strong></td>


<?php
$resultado4=mysql_fetch_array($utilizacion);
$uti=$resultado4['total'];
//echo '<td width="70px" class="auto-style1">'; echo'</td>'; //echo $uti; echo' mins</td>';
?>
</tr>

<?php

$sql4012="select count(correlativo) as total from proyectos where freal='0000-00-00' ";
$tar12 = mysql_query($sql4012,$conexion);
$resultad612=mysql_fetch_array($tar12);
$val612=$resultad612['total'];


//consulta para horas totales de empleados por areas
$queryss="select codigo from area where estado='a'";
$arr = mysql_query($queryss,$conexion);
$divisorrr=0;

while ( $resti=mysql_fetch_array($arr) )
{

$areas5=$resti['codigo'];

$sql40="select count(ast.totalhoras) as total from ast inner join usuarios on user=usuario where area='$areas5' and cproyecto!='NO_ES_PROYECTO' and fecha BETWEEN '$fecha1' AND '$fecha2' ";
$tar = mysql_query($sql40,$conexion);
$resultad6=mysql_fetch_array($tar);
$val6=$resultad6['total'];

$sql401="select count(correlativo) as total from proyectos where area='$areas5' and freal='0000-00-00' ";
$tar1 = mysql_query($sql401,$conexion);
$resultad61=mysql_fetch_array($tar1);
$val61=$resultad61['total'];


if( $val6 == 0 )
{
echo '<tr>';
echo '<td>'; echo $areas5; echo '</td>';
echo '<td width="70px" class="auto-style5" style="text-align:right;">'; echo '0'; echo ' &nbsp;</td>';
echo '<td width="70px" class="auto-style5" style="text-align:center;">'; echo $val61; echo '</td>';

echo '</tr>';

}
else
{
$divisorrr++;

$sql1="select area, sum(ast.totalhoras) as total from ast inner join usuarios on usuario=user where area='$areas5' and cproyecto!='NO_ES_PROYECTO' and fecha BETWEEN '$fecha1' AND '$fecha2' group by area";
$templeados = mysql_query($sql1,$conexion);


while ( $resultado1=mysql_fetch_array($templeados) )
{
echo '<tr>';
echo '<td>'; echo ucwords(strtr($resultado1['area'],'_',' ')); echo '</td>';
echo '<td width="70px" class="auto-style5" style="text-align:right;">'; echo round(($resultado1['total']/60) * 100) / 100; echo ' &nbsp;</td>';
echo '<td width="70px" class="auto-style5" style="text-align:center;">'; echo $val61; echo '</td>';
echo '</tr>';
}//fin while evaluando las areas


}

}//fin while que selecciono las areas

?>
<tr>
<td class="auto-style2" style="text-align:center;font-weight:bold; width: 97px;">Total</td>
<td style="text-align:right; width: 67px;"><?php echo round(($uti/60)*100)/100; echo' &nbsp;'; ?></td>
<td style="text-align:center; width: 111px;"><?php echo $val612; ?></td>
</tr>
</table>
</div>

<div id="actividades" style="margin-left:10px;">
<table border="1px" cellpadding="0" cellspacing="0">
<tr>
<td align="center" class="auto-style2" colspan="1" style="text-align:center;font-weight:bold;">Empresas</td>
<td colspan="1" style="text-align:center;background-color: #3B5998; width: 71px; color:white;"><strong>Horas</strong></td>
<?php
//echo '<td width="70px" class="auto-style1">'; echo $uti; echo' mins</td>';
?>
<td align="center" class="auto-style8" style="text-align:center;font-weight:bold;font-size:12px; width: 128px;">Cantidad proyectos</td>
</tr>
<?php
$prom=0;

$ques="select nombre from empresas where estado='a' ";
$resu = mysql_query($ques,$conexion);

while ( $actis=mysql_fetch_array($resu) )
{

$empresa=$actis['nombre'];

$sql20="select count(ast.totalhoras) as total from ast where empresa='$empresa' and cproyecto!='NO_ES_PROYECTO' and fecha BETWEEN '$fecha1' AND '$fecha2' ";
$tac = mysql_query($sql20,$conexion);
$resultad=mysql_fetch_array($tac);
$val=$resultad['total'];

$sql201="select count(correlativo) as total from proyectos where empresa='$empresa' and freal='0000-00-00' ";
$tac1 = mysql_query($sql201,$conexion);
$resultad1=mysql_fetch_array($tac1);
$val1=$resultad1['total'];


if( $val == 0 )
{
echo '<tr>';
echo '<td>'; echo strtr($empresa,'_',' '); echo'</td>';
echo '<td class="auto-style3">'; echo '0'; echo ' &nbsp;</td>';

echo '<td class="auto-style3" style="text-align:center;" >'; echo $val1; echo '</td>';
echo '</tr>';


}
else
{

//consulta de total de horas por actividad
$sql2="select empresa,sum(ast.totalhoras) as total from ast where empresa='$empresa' and cproyecto!='NO_ES_PROYECTO' and fecha BETWEEN '$fecha1' AND '$fecha2' group by empresa";
$tactividades = mysql_query($sql2,$conexion);


while ( $resultado2=mysql_fetch_array($tactividades) )
{
echo '<tr>';
echo '<td>'; echo strtr($resultado2['empresa'],'_',' '); echo'</td>';
echo '<td class="auto-style3">'; echo round(($resultado2['total']/60)*100)/100; echo ' &nbsp;</td>';

$valor=$resultado2['total'];
$divisor=$tpromedios['total'];
$res=$valor/$divisorrr;
$prom=$prom+$res;

echo '<td class="auto-style3" style="text-align:center;">  '; echo $val1; echo '</td>';
echo '</tr>';
}

}//fin else diferente de cero

}//fin while de las actividades
?>
<tr>
<td class="auto-style2" style="text-align:center;font-weight:bold;">Total</td>
<td style="text-align:right; width: 71px;" ><?php echo round(($uti/60)*100)/100; echo' &nbsp;'; ?></td>
<td class="auto-style3" style="text-align:center; width: 128px;" > <?php echo $val612; ?></td>
</tr>
</table>
</div>

</div>


<!-- **************************************************************************************************************************************************************** -->

<div id="grafico">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="empresa_4_cantidad_grafico.php">
</iframe>
</div>

<div id="grafico">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="empresa_4_cantidadarea_grafico.php">
</iframe>
</div>

<div id="grafico">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="empresa_4_cantidadaperturados_grafico.php">
</iframe>
</div>


</div>

</body>
</html>

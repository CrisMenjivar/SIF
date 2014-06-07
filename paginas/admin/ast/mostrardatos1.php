<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link href="../../../estilo/estiloast.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../../../js/seguridad.js"></script>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title></title>
</head>
<body style="margin:0px 0px 0px 0px;">

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

$userid=$_SESSION['user'];

//LIMITAMOS LOS REGISTROS A MOSTRAR YA QUE DEBEN MOSTRARSE SOLO LOS CORRESPONDIENTES AL MES EN CURSO
$meses=date("m");
$years=date("Y");

switch($meses)
{
Case 1:
$diaF="31";
break;
Case 2:
$diaF="28";
break;
Case 3:
$diaF="31";
break;
Case 4:
$diaF="30";
break;
Case 5:
$diaF="31";
break;
Case 6:
$diaF="30";
break;
Case 7:
$diaF="31";
break;
Case 8:
$diaF="31";
break;
Case 9:
$diaF="30";
break;
Case 10:
$diaF="31";
break;
Case 11:
$diaF="30";
break;
Case 12:
$diaF="31";
break;
}
$mes123=$meses-1;

$sql="select fecha,descripcion,p.empresa,inicio,fin,totalhoras,p.tipo,dia,p.nombre,codigo as cproyecto from proyectos inner join (SELECT fecha,descripcion,empresa,cproyecto as c,inicio,fin,totalhoras,tipo,DAY(fecha) as dia,nombre FROM ast inner join actividad on ast.tipoact=actividad.tipoact WHERE usuario='$userid' AND fecha BETWEEN '$years-$mes123-24' AND '$years-$meses-$diaF' order by fecha DESC, inicio DESC ) as p on correlativo=c";

$result=mysql_query($sql,$conexion);

?>
<table width="1000px" border="0" cellpadding="1" cellspacing="1" style="border-color:#000099;" class="fila">
<?php
while($resultado=mysql_fetch_array($result))
{

$fecha=$resultado['fecha'];
$descripcion=$resultado['descripcion'];
$actividad=strtr($resultado['nombre'],'_',' ');
$empresa=$resultado['empresa'];
$proyecto=strtr($resultado['cproyecto'],'_',' ');
$inicio=$resultado['inicio'];
$finales=$resultado['fin'];
$horas=$resultado['totalhoras'];
$tipo=$resultado['tipo'];
?>
<tr <?php if( $tipo == "o"){ if($resultado['dia']%2 == 0){echo 'style="color:blue;background-color:#A2B5CD;"';}else{echo 'style="color:blue;background-color:#E3E3E3;"';} }else{ if($resultado['dia']%2 == 0){echo 'style="background-color:#A2B5CD;"';}else{echo 'style="background-color:#E3E3E3;"';} } ?> >
<td width="70px" height="16px"><?php echo $fecha;?></td>
<td width="328px" height="16px" style="line-height:normal;padding:0px 3px 0px 3px;"><?php echo $descripcion;?></td>
<td width="116px" height="16px" style="padding:0px 0px 0px 4px;"><?php echo $actividad;?></td>
<td width="96px" height="16px" style="padding:0px 0px 0px 4px;"><?php echo $empresa;?></td>
<td width="126px" height="16px" align="left" style="padding:0px 0px 0px 4px;"><?php echo $proyecto;?></td>
<td width="75px" height="16px" align="center"><?php echo $inicio;?></td>
<td width="75px" height="16px" align="center"><?php echo $finales;?></td>
<td width="84px" height="16px" style="padding-right:18px;" align="right"><?php echo $horas;?> mins</td>
<?php
echo '</tr>';
}//fin while que muestra todos los registros correspondientes al mes en curso

?>
</table>


</body>
</html>
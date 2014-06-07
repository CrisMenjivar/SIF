<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link href="../../../../estilo/final_reportes.css" rel="stylesheet" type="text/css" />

<script language="javascript" type="text/javascript" src="../../../../js/seguridad.js"></script>

<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Reporte Mensual</title>

</head>

<body>
<?php

//Verificamos que el usuario haya iniciado sesion
session_start();
if($_SESSION['user']=="")
{
header ("Location: ../../../../index.php");
}

//RECUPERAMOS LAS VARIABLES OBTENIDAS DE LA SELECCION DEL PERIODO PARA EL AST

$inicio=$_SESSION['colaborador_inicio'];
$fin=$_SESSION['colaborador_fin'];
$area=$_SESSION['colaborador_area'];
$colaborador=$_SESSION['colaborador_usuario'];

$uno=$_SESSION['colaborador_uno'];
$dos=$_SESSION['colaborador_dos'];
$year=$_SESSION['colaborador_year'];

if( $uno < 10 )
{
$m1="0".$uno;
}
else
{
$m1=$uno;
}

if( $dos < 10 )
{
$m2="0".$dos;
}
else
{
$m2=$dos;
}

switch ($dos)
{
Case 1:
$diaI="01";
$diaF="31";
break;
Case 2:
$diaI="01";
$diaF="28";
break;
Case 3:
$diaI="01";
$diaF="31";
break;
Case 4:
$diaI="01";
$diaF="30";
break;
Case 5:
$diaI="01";
$diaF="31";
break;
Case 6:
$diaI="01";
$diaF="30";
break;
Case 7:
$diaI="01";
$diaF="31";
break;
Case 8:
$diaI="01";
$diaF="31";
break;
Case 9:
$diaI="01";
$diaF="30";
break;
Case 10:
$diaI="01";
$diaF="31";
break;
Case 11:
$diaI="01";
$diaF="30";
break;
Case 12:
$diaI="01";
$diaF="31";
break;
}


//--------------------------------------------------------------------------

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

$sql="select * from usuarios where user='$colaborador' ";
$result = mysql_query($sql,$conexion);
$fila=mysql_fetch_array($result);

//$sql1="select * from (SELECT usuario,fecha,descripcion,tipoact,empresa,cproyecto,inicio,fin,totalhoras FROM ast WHERE usuario='$colaborador' AND fecha BETWEEN '$year-$m1-$diaI' AND '$year-$m2-$diaF' order by inicio ASC) as nuevo order by fecha ASC ";

$sql1="select fecha,descripcion,p.nombre,codigo as proyecto,inicio,p.empresa,fin,totalhoras,p.tipo,dia from proyectos inner join ( SELECT fecha,descripcion,nombre,empresa,cproyecto,inicio,fin,totalhoras,tipo,DAY(fecha) as dia FROM ast inner join actividad on actividad.tipoact=ast.tipoact WHERE usuario='$colaborador' AND fecha BETWEEN '$year-$m1-$diaI' AND '$year-$m2-$diaF' order by fecha ASC,inicio ASC ) as p on cproyecto=correlativo ";
$result1 = mysql_query($sql1,$conexion);

?>

<div id="contenedor" style="height:auto;overflow:hidden;">
<div id="encabezadologin">

<div id="logo">
<div id="logoimagen">
<img src="../../../../imagenes/sites.png" alt="sites"/>
</div>
<div id="textologo">
<p>Shared IT Enterprise Services</p>
</div>
</div>

<div id="astdes">
<p style="font-size:28px;">Reporte de actividades diarias por colaborador</p>
</div>
</div>

<div id="contedatos">
<div id="contelinea">
<div id="conteizquierda">
<p>
<b> <span class="auto-style2">&Aacute;rea </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     :
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo $fila['area']; ?>
</b>
</p>
</div>
<div id="contederecha">
<p>
<b> <span class="auto-style2">Posici&oacute;n</span> :
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo $fila['puesto']; ?>
</b>
</p>
</div>
</div>

<div id="contelinea">
<div id="conteizquierda">
<p>
<b> <span class="auto-style2">Nombre</span> &nbsp;:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo $fila['nombre']; echo " "; echo $fila['apellido']; ?>
</b>
</p>
</div>
<div id="contederecha">
<p>
<b> <span class="auto-style2">Periodo</span> :
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo $inicio; ?>&nbsp;&nbsp; al &nbsp;&nbsp; <?php echo $fin; ?>
</b>
</p>
</div>
</div>
</div>

<div id="linea"></div>

<div id="datos">
<div id="bloque"><p>Fecha</p></div>
<div id="bloque2"><p>Descripci&oacute;n</p></div>
<div id="bloque3"><p>Actividad</p></div>
<div id="bloque4"><p>Empresa</p></div>
<div id="bloque5"><p>Proyecto</p></div>
<div id="bloque6"><p>Inicio</p></div>
<div id="bloque6"><p>Fin</p></div>
<div id="bloque7"><p>Total</p></div>


</div>

<table class="fila" width="999px" border="0" cellpadding="1" cellspacing="1" style="border-color:#000099;">
<?php
$suma=0;
while ( $resultado1=mysql_fetch_array($result1) )
{
$fecha=$resultado1['fecha'];
$descripcion=$resultado1['descripcion'];
$actividad=strtr($resultado1['nombre'],'_',' ');
$empresa=$resultado1['empresa'];
$proyecto=strtr($resultado1['proyecto'],'_',' ');
$inicio1=$resultado1['inicio'];
$finales1=$resultado1['fin'];
$horas1=$resultado1['totalhoras'];
$actual1 = $inicio1;
$actual2 = $finales1;
$actual3 = $horas1;
$suma=$suma+$horas1;
?>
<tr <?php if( $resultado1['tipo'] == "o"){ if($resultado1['dia']%2 == 0){echo 'style="color:blue;background-color:#A2B5CD;"';}else{echo 'style="color:blue;background-color:#CFCFCF;"';} }else{ if($resultado1['dia']%2 == 0){echo 'style="background-color:#A2B5CD;"';}else{echo 'style="background-color:#CFCFCF;"';} } ?> >
<td width="70px"  height="16px"> <?php echo $fecha; ?></td>
<td width="317px" height="16px" style="line-height:normal;"> <?php echo $descripcion; ?></td>
<td width="115px" height="16px" > <?php echo $actividad; ?></td>
<td width="95px" height="16px" > <?php echo $empresa;?></td>
<td width="136px" height="16px" > <?php echo $proyecto; ?></td>
<td width="78px"  height="16px" align="center"> <?php echo $actual1; ?></td>
<td width="78px"  height="16px" align="center"> <?php echo $actual2; ?></td>
<td width="70px"  height="16px" align="right"> <?php echo $actual3; ?> mins</td>

</tr>
<?php
} //fin while que muestra todos los registros correspondientes al mes en curso
?>
<tr>
<td colspan="5" style="text-align:right">TOTAL HORAS</td>
<td colspan="3" style="text-align:center"><?php echo round(($suma/60)*100)/100; ?> hrs</td>
</tr>
</table>

<div id="dosgraficos">
<div id="grafico2">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="colaborador_1_actividad_grafico.php" >
</iframe>
</div>
<div id="grafico2">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="colaborador_1_empresa_grafico.php" >
</iframe>
</div>
</div>

</div>

</body>
</html>


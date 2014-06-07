<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" type="text/javascript" src="../../../../js/formularios.js"></script>
<link href="../../../../estilo/estiloformularios.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../../../../js/seguridad.js"></script>

<!--[if lt IE 9]>
<script src="../../../../js/IE9.js" type="text/javascript"></script>
<![endif]-->

<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Reportes por &aacute;rea</title>

</head>

<body>

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


//Verificamos que el usuario haya iniciado sesion
session_start();
if($_SESSION['user']=="")
{
header ("Location: ../../../../index.php");
}
else
{
$ver=$_SESSION['user'];

$change="select admin from usuarios where user='$ver' ";
$verify = mysql_query($change,$conexion);
$move=mysql_fetch_array($verify);

if($move['admin']=="2")
{
header ("Location: ../../../usuarios/ast.php");
}

if($move['admin']=="1")
{
header ("Location: ../../../admin/menuadmin.php");
}

if($move['admin']=="4")
{
header ("Location: ../../../jefes_proyectos/ast.php");
}

}//fin else

$colaborador=$_SESSION['user'];

//----------------------------------------------
$error1 = "select count(estado) as tot from ast where estado='b' and usuario='".$_SESSION['user']."' ";
$result7 = mysql_query($error1,$conexion);
$res=mysql_fetch_array($result7);
$num=$res['tot'];

//-----------------------------------------------
//-----------------------------------------------

//pendientes
$sq = "select count(usuario) as tot from excel where usuario='".$_SESSION['user']."' ";
$resP = mysql_query($sq,$conexion);
$resP2=mysql_fetch_array($resP);
$pendientes=$resP2['tot'];

?>


<div id="contenedorotros">
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
<p>An&aacute;lisis Semanal de Tiempo -- AST</p>
</div>

</div>


<!--INICIO DE LA BARRA DE MENU-->
<div id="conteencabezado">
<div id="cerrar">
<ul>
<li><a href="../../../instrucciones.php" target="_blank">Guia para registro</a></li>

<li><a href="#" >Registro</a>
<ul>
<li><a href="../../ast.php" >Manual</a></li>

<li><a href="../../cargar_archivo.php" >Desde archivo</a></li>
<?php
if( $pendientes != 0 )
{
echo '<li><a href="../../ast_excel.php" >Pendientes('; echo $pendientes; echo ')</a></li>';
}
?>
</ul>
</li>

<li><a href="../../corregirast.php"><?php if( $num != 0 ){ echo '<div id="resaltado" style="color:yellow;">AST Denegados</div>'; }else{ echo 'AST Denegados';}?></a></li>
<li><a href="../../2_revisarast.php">Modificar AST</a></li>
<li><a href="#" style="color:orange;">Reportes</a>
<ul>
<li><a href="../graficos_colaborador/colaborador_reporte.php" >Por colaborador</a></li>
<li><a href="area_reporte.php" style="color:orange;">Por &aacute;rea</a></li>
<li><a href="../graficos_empresa/empresa_reporte.php" >Por empresa</a></li>
<li><a href="../proyectos/reporte_proyectos_en_curso.php" >Proyectos en curso</a></li>
<li><a href="../../control/control.php" >Control de entregas</a></li>
</ul>
</li>

<li><a href="../../../cerrarsesion.php">Cerrar sesion</a></li>
</ul>
</div>

</div>
<!--FIN DE LA BARRA DE MENU -->

<div id="contenedorrevisar" style="left: 0px; top: 0px; height: 271px">
<form name="sesiones" target="_blank" action="area_procesar.php" method="post" onsubmit="return validarproyectoseleccionar(this)" >

<div id="cajasrevisar" style="height: 4px"  >
</div>


<div id="cajasrevisar" style="height: 27px" >

<div id="textosrevisar">
<p><b>Seleccionar reporte :</b></p>
</div>
<div id="selecttexrevisar" style="width: 35%">
<select name="reporte" size="1" style="width: 344px" >
<option value="1">Utilizaci&oacute;n del tiempo general por &aacute;rea</option>
<!-- <option value="4">Resumen de proyectos por &aacute;rea</option> -->
</select>
</div>

</div>

<div id="cajasrevisar"  >

<div id="textosrevisar">
<p><b>Seleccione el &aacute;rea :</b></p>
</div>
<div id="selecttexrevisar">
<select name="area" size="1" >
<?php
$sqlcorre="select area from usuarios where user='$colaborador'";
$result2 = mysql_query($sqlcorre,$conexion);
$correlativos1=mysql_fetch_array($result2);
$correlativos2=$correlativos1['area'];
echo "<option value=".$correlativos2.">".$correlativos2."</option>";

?>
</select>
</div>

</div>


<div id="cajasrevisar"  >

<div id="textosrevisar">
<p><b>Inicio de periodo :</b></p>
</div>

<div id="selecttexrevisar">
<select name="inicio" size="1" >
<option value="1">Enero</option>
<option value="2">Febrero</option>
<option value="3">Marzo</option>
<option value="4">Abril</option>
<option value="5">Mayo</option>
<option value="6">Junio</option>
<option value="7">Julio</option>
<option value="8">Agosto</option>
<option value="9">Septiembre</option>
<option value="10">Octubre</option>
<option value="11">Noviembre</option>
<option value="12">Diciembre</option>
</select>
</div>



<div id="otrotextos" style="width: 17%">
<p><b>Fin de periodo :</b></p>
</div>
<div class="otrosele" style="width: 17%">
<select name="fin" size="1" >
<option value="1">Enero</option>
<option value="2">Febrero</option>
<option value="3">Marzo</option>
<option value="4">Abril</option>
<option value="5">Mayo</option>
<option value="6">Junio</option>
<option value="7">Julio</option>
<option value="8">Agosto</option>
<option value="9">Septiembre</option>
<option value="10">Octubre</option>
<option value="11">Noviembre</option>
<option value="12">Diciembre</option>
</select>
</div>

<div id="otrotextos" style="width: 10%">
<p><b>A&ntilde;o :</b></p>
</div>
<div class="otrosele" style="width: 17%">
<select name="year" size="1" >
<option value="2013">2013</option>
<option value="2014">2014</option>
<option value="2015">2015</option>
<option value="2016">2016</option>
<option value="2017">2017</option>
<option value="2018">2018</option>
<option value="2019">2019</option>
<option value="2020">2020</option>
</select>
</div>


</div>
<div id="cajasrevisar">
<div id="butomm">
<input type="submit" value="Generar reporte" />
</div>

</div>


</form>
</div>

</div>

</body>

</html>

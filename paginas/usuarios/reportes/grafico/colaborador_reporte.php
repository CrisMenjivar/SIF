<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" type="text/javascript" src="../../../../js/astnuevos.js"></script>

<script language="javascript" type="text/javascript" src="../../../../js/seguridad.js"></script>

<script language="javascript" type="text/javascript" src="../../../../js/formularios.js"></script>
<link href="../../../../estilo/estiloformularios.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 9]>
<script src="../../../../js/IE9.js" type="text/javascript"></script>
<![endif]-->
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Reportes por colaborador</title>

<script type="text/javascript" src="../../../../js/ajax.js">
</script>
<script type="text/javascript">
objetoAjax.prototype.micompletar=micompletar;

function micompletar(forma)
{// 2)realiza la primera llamada al query dependiendo q se selecciono
var varea=forma.area;
// muestra el complemento de la url
this.curl="?COD="+varea.options[varea.selectedIndex].value;
//alert('COMPLEMENTO DE URL: \n\r'+this.curl);
this.ejecutar();//ejecuta la llamada
}

function muestraResultado()
{
if(this.readyState == 4)
{
if(this.status == 200)
{
var texto=this.responseText;
divTabla=window.document.getElementById('prueba'); //3)muestra el resultado en este id
divTabla.innerHTML=texto;
}
}
}

var mitablajax=new objetoAjax('GET','consultaajax.php',muestraResultado);
window.onload=function () {mitablajax.micompletar(window.document.forms["criterios"]);}
</script>


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

if($move['admin']=="3")
{
header ("Location: ../../../jefes/ast.php");
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
$error1 = "select * from usuarios where user='".$_SESSION['user']."' ";
$result7 = mysql_query($error1,$conexion);
$res=mysql_fetch_array($result7);

//-----------------------------------------------
$error3 = "select count(estado) as tot from ast where estado='b' and usuario='".$_SESSION['user']."' ";
$result3 = mysql_query($error3,$conexion);
$res3=mysql_fetch_array($result3);
$num=$res3['tot'];

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

<!--
<li><a href="../../ast.php" >Registro AST</a></li>
-->

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

<li><a href="#" style="color:orange;">Reporte</a>
<ul>
<li><a href="colaborador_reporte.php" style="color:orange;">Colaborador</a></li>
<li><a href="../proyectos/reporte_proyectos_en_curso.php" >Proyectos en curso</a></li>
</ul>

</li>


<li><a href="../../../cerrarsesion.php">Cerrar sesion</a></li>
</ul>
</div>

</div>
<!--FIN DE LA BARRA DE MENU -->

<div id="contenedorrevisar" style="left: 1px; top: 0px; height: 411px">
<form name="sesiones" target="_blank" action="colaborador_procesar.php" method="post" onsubmit="return reportes_usuarios_colaborador(this)" >

<div id="cajasrevisar" style="height: 4px"  >
</div>

<input type="hidden" name="area" value="<?php echo $res['area'];?>" />
<input type="hidden" name="colaborador" value="<?php echo $res['user'];?>" />

<div id="cajasrevisar" style="height: 27px" >

<div id="textosrevisar">
<p><b>Seleccionar reporte :</b></p>
</div>
<div id="selecttexrevisar" style="width: 35%">
<select name="reporte" size="1" style="width: 344px" >
<option value="1">Reporte de actividades diarias por colaborador</option>
<option value="2">Utilizaci&oacute;n del tiempo general por colaborador</option>
<option value="3">Utilizaci&oacute;n del tiempo en proyectos por colaborador</option>
<!-- <option value="4">Resumen de proyectos por colaborador</option> -->
</select>
</div>

</div>


<div id="cajasrevisar"  >

<div id="textosrevisar">
<p><b>Inicio de periodo :</b></p>
</div>

<div id="selecttexrevisar" style="width: 14%">
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



<div id="otrotextos" style="width: 19%">
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

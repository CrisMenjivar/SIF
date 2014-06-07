<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" type="text/javascript" src="../../js/astnuevos.js"></script>
<script language="javascript" type="text/javascript" src="../../js/seguridad.js"></script>
<link href="../../estilo/estiloast.css" rel="stylesheet" type="text/css" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>An&aacute;lisis Semanal de Tiempo -- AST</title>

<!-- inicio de script para los input de las horas ------------------------------------------------------->
<script type="text/javascript" language="javascript" src="../../js/horas/jquery-1.7.1.min.js"></script>
<script type="text/javascript" language="javascript" src="../../js/horas/jquery.mousewheel.js"></script>
<script type="text/javascript" language="javascript" src="../../js/horas/jquery.timepickerinputmask.min.js"></script>

<script type="text/javascript" language="javascript">
$(document).ready(function () {

$('.input1').TimepickerInputMask();

$('.input2').TimepickerInputMask();

});
</script>

<!--FIN DE LAS HORAS------------------------------------------------------------------------------------->

<!--Hoja de estilos del calendario --------------------------------------------------------------------->
<link rel="stylesheet" type="text/css" media="all" href="../../js/calendario/calendar-blue2.css" title="win2k-cold-1" />
<!-- librería principal del calendario -->
<script type="text/javascript" src="../../js/calendario/calendar.js"></script>
<!-- librería para cargar el lenguaje deseado -->
<script type="text/javascript" src="../../js/calendario/lang/calendar-es.js"></script>
<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código -->
<script type="text/javascript" src="../../js/calendario/calendar-setup.js"></script>
<!--Hoja de estilos del calendario --------------------------------------------------------------------->

<style type="text/css">
.auto-style2 {
color: #0033CC;
}
</style>

<script type="text/javascript" src="../../js/ajax.js">
</script>

<script type="text/javascript">
objetoAjax.prototype.micompletar2=micompletar2;

function micompletar2(forma)
{
var vempresa=forma.empresas;
var vopcion=forma.pro;
this.curl="?opcion="+vopcion.options[vopcion.selectedIndex].value+"&empresa="+vempresa.options[vempresa.selectedIndex].value;
//alert('COMPLEMENTO DE URL: \n\r'+this.curl);
this.ejecutar();
}

function muestraResultado2()
{
if(this.readyState == 4)
{
if(this.status == 200)
{
var texto=this.responseText;
divTabla=window.document.getElementById('proyectmsj');
divTabla.innerHTML=texto;
}
}
}

var mitablajax2=new objetoAjax('GET','proyectos_ajax.php',muestraResultado2);
window.onload=function () {mitablajax2.micompletar2(window.document.forms["criterios"]);}
</script>


</head>

<body style="height:auto">
<?php

include '../../config/db.php';

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
header ("Location: ../../index.php");
}
else
{
$ver=$_SESSION['user'];

$change="select admin from usuarios where user='$ver' ";
$verify = mysql_query($change,$conexion);
$move=mysql_fetch_array($verify);

if($move['admin']=="2")
{
header ("Location: ../usuarios/ast.php");
}

if($move['admin']=="1")
{
header ("Location: ../admin/menuadmin.php");
}

if($move['admin']=="4")
{
header ("Location: ../jefes_proyectos/ast.php");
}

}//fin else


$sql="select * from usuarios where user='".$_SESSION['user']."' ";
$result = mysql_query($sql,$conexion);
$fila=mysql_fetch_array($result);


//----------------------------------------------
$error1 = "select count(estado) as tot from ast where estado='b' and usuario='".$_SESSION['user']."' ";
$result7 = mysql_query($error1,$conexion);
$res=mysql_fetch_array($result7);
$num=$res['tot'];

//-----------------------------------------------

//pendientes
$sq = "select count(usuario) as tot from excel where usuario='".$_SESSION['user']."' ";
$resP = mysql_query($sq,$conexion);
$resP2=mysql_fetch_array($resP);
$pendientes=$resP2['tot'];


?>

<div id="contenedor" style="left: 0px; top: 0px; height: 594px" >

<div id="encabezadologin">
<div id="logo" style="width: 202px; height: 68px">
<div id="logoimagen" style="width: 196px">
<img src="../../imagenes/sites.png" alt="sites"/>
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
<div id="conteencabezado" >
<div id="cerrar">
<ul>
<li><a href="../instrucciones.php" target="_blank">Guia para registro</a></li>

<li><a href="#" style="color:orange">Registro</a>
<ul>
<li><a href="ast.php" >Manual</a></li>

<li><a href="cargar_archivo.php" style="color:orange">Desde archivo</a></li>
<?php
if( $pendientes != 0 )
{
echo '<li><a href="ast_excel.php" >Pendientes('; echo $pendientes; echo ')</a></li>';
}
?>
</ul>
</li>

<li><a href="corregirast.php"><?php if( $num != 0 ){ echo '<div id="resaltado" style="color:yellow;">AST Denegados</div>'; }else{ echo 'AST Denegados';}?></a></li>
<li><a href="2_revisarast.php">Modificar AST</a></li>
<li><a href="#">Reportes</a>
<ul>
<li><a href="reportes/graficos_colaborador/colaborador_reporte.php" >Por colaborador</a></li>
<li><a href="reportes/graficos_area/area_reporte.php" >Por &aacute;rea</a></li>
<li><a href="reportes/graficos_empresa/empresa_reporte.php" >Por empresa</a></li>
<li><a href="reportes/proyectos/reporte_proyectos_en_curso.php" >Proyectos en curso</a></li>
<li><a href="control/control.php" >Control de entregas</a></li>
</ul>
</li>

<li><a href="../cerrarsesion.php">Cerrar sesion</a></li>
</ul>
</div>
</div>
<!--FIN DE LA BARRA DE MENU -->
<div id="contedatos">
<div id="contelinea">
<div id="izquierda" style="width: 415px">
	<p class="auto-style2" style="width: 402px"><span class="auto-style2">&Aacute;rea</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     :
&nbsp;&nbsp;&nbsp;
<?php echo $fila['area']; ?>
</p></div>
<div id="derecha"><p style="width: 567px"><span class="auto-style2" style="height: 25px">Posici&oacute;n</span>&nbsp;&nbsp;:
&nbsp;&nbsp;&nbsp;
<?php echo $fila['puesto']; ?>
</p></div>
</div>
<div id="contelinea">
<div id="izquierda" style="width: 415px">
	<p class="auto-style2" style="width: 401px">
<span class="auto-style2" style="height: 25px">Nombre</span>&nbsp; :
&nbsp;&nbsp;&nbsp;
<?php echo $fila['nombre']; echo "_"; echo $fila['apellido'];?>
</p></div>
<div id="derecha" style="width: 576px"><p class="auto-style2">
<span class="auto-style2" style="height: 25px">Contrato</span> :
&nbsp;&nbsp;&nbsp;
<?php echo $fila['contrato']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="auto-style2" style="height: 25px">Proveedor</span> :
<?php echo ucwords(strtolower($fila['proveedor'])); ?>
</p></div>
</div>

</div>

<div id="descripcion" style="height: 16px">
</div>


<div id="insertardatos">

</div>

<div id="contenedorlogin" style="left: 0px; top: 0px; width: 462px;">
<form name="subirdatos" action="upload.php" method="post" enctype="multipart/form-data">
<div id="encabezado" style="width: 463px;border-top-left-radius:10px;border-top-right-radius:10px;">
<p style="font-weight:normal"><b>Importaci&oacute;n de datos desde Outlook</b></p>
</div>

<div id="cajas" style="height: 26px; width: 458px;margin-top:60px;" >
<div id="inputtex" style="margin-right:auto;margin-left:10px;float:left; width: 71%;">
<input name="archivo" type="file" value="Adjuntar" size="35" style="width: 329px; height: 23px;color:red;" />
</div>

<div id="inputbotom" style="margin: 0px auto; float:left;width: 105px; height: 23px;">
<input name="enviar" type="submit" value="Cargar archivo" style="width: 104px; height: 23px" />
<input name="action" type="hidden" value="upload" />
</div>
</div>


<div id="cajas2" style="width: 458px"    >

<div id="radiotex1" style="width: 28%; margin:0px;">
<div id="radiotex2">
<input type="radio"  name="tipo" value="2" />
</div>
<div id="textradio" style="width: 20%"><p>Mac</p></div>
</div>


<div id="radiotex1" style="width: 27%; margin:0px;">
<div id="radiotex2">
<input type="radio"  name="tipo" value="1" checked="checked" />
</div>
<div id="textradio" style="width: 50%"><p>Windows</p></div>
</div>

<div id="textos" style="width: 32%">
<p>Excel generado en :</p>
</div>
</div>






<div id="cajas2" style="width: 458px"    >

<div id="radiotex1" style="width: 28%; margin:0px;">
<div id="radiotex2">
<input type="radio"  name="idioma" value="ingles" />
</div>
<div id="textradio" style="width: 20%"><p>Ingles</p></div>
</div>


<div id="radiotex1" style="width: 27%; margin:0px;">
<div id="radiotex2">
<input type="radio"  name="idioma" value="espanol" checked="checked" />
</div>
<div id="textradio" style="width: 50%"><p>Espa&ntilde;ol</p></div>
</div>

<div id="textos" style="width: 32%">
<p>Idioma :</p>
</div>
</div>



<div id="encabezado" style="margin-top:20px;width:463px; height:25px;border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-left-radius:10px;border-bottom-right-radius:10px;">

</div>


</form>
</div>


</div>


</body>

</html>

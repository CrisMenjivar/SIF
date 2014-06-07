<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" type="text/javascript" src="../../../js/seguridad.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/formularios.js"></script>
<link href="../../../estilo/estiloformularios.css" rel="stylesheet" type="text/css" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Modificar Proyecto</title>

</head>

<!--codigo de ajax para seleccionar el proyecto--------------------------------------------->

<script language="javascript" type="text/javascript" src="../../../js/ajax.js">
</script>

<script language="javascript" type="text/javascript">
objetoAjax.prototype.micompletar=micompletar;
objetoAjax.prototype.micompletar2=micompletar2;
objetoAjax.prototype.micompletar3=micompletar3;
objetoAjax.prototype.micompletar4=micompletar4;

function micompletar(forma)
{// 2)realiza la primera llamada al query dependiendo q se selecciono
//var vempresa=forma.opcion1;
var voperacion=forma.opcion20;
// muestra el complemento de la url
//this.curl="?empresa="+vempresa.options[vempresa.selectedIndex].value;
this.curl="?coor="+voperacion.options[voperacion.selectedIndex].value;

//alert('COMPLEMENTO DE URL: \n\r'+this.curl);
this.ejecutar();//ejecuta la llamada
}

function micompletar2(forma)
{
var varea=forma.opcion2;
var vempresa=forma.opcion1;
this.curl="?empresa="+vempresa.options[vempresa.selectedIndex].value+"&area="+varea.options[varea.selectedIndex].value;
//alert('COMPLEMENTO DE URL: \n\r'+this.curl);
this.ejecutar();
}

function micompletar3(forma)
{// 2)realiza la primera llamada al query dependiendo q se selecciono
var vproyecto=forma.opciones;
// muestra el complemento de la url
this.curl="?proyecto="+vproyecto.options[vproyecto.selectedIndex].value;
//alert('COMPLEMENTO DE URL: \n\r'+this.curl);
this.ejecutar();//ejecuta la llamada
}

function micompletar4(forma)
{
var varea=forma.areasnuevas;
var vempresa=forma.empresasnuevas;
this.curl="?empresa="+vempresa.options[vempresa.selectedIndex].value+"&area="+varea.options[varea.selectedIndex].value;
//alert('COMPLEMENTO DE URL: \n\r'+this.curl);
this.ejecutar();
}


function muestraResultado()
{
if(this.readyState == 4)
{
if(this.status == 200)
{
var texto=this.responseText;
divTabla=window.document.getElementById('res_uno'); //3)muestra el resultado en este id
divTabla.innerHTML=texto;
}
}
}

function muestraResultado2()
{
if(this.readyState == 4)
{
if(this.status == 200)
{
var texto=this.responseText;
divTabla=window.document.getElementById('tabla');
divTabla.innerHTML=texto;
}
}
}

function muestraResultado3()
{
if(this.readyState == 4)
{
if(this.status == 200)
{
var texto=this.responseText;
divTabla=window.document.getElementById('bloque'); //3)muestra el resultado en este id
divTabla.innerHTML=texto;
}
}
}

function muestraResultado4()
{
if(this.readyState == 4)
{
if(this.status == 200)
{
var texto=this.responseText;
divTabla=window.document.getElementById('bloq'); //3)muestra el resultado en este id
divTabla.innerHTML=texto;
}
}
}


var mitablajax=new objetoAjax('GET','area_ajax.php',muestraResultado);
var mitablajax2=new objetoAjax('GET','proyecto_ajax.php',muestraResultado2);
var mitablajax3=new objetoAjax('GET','mod_ajax.php',muestraResultado3);
var mitablajax4=new objetoAjax('GET','select_modificar.php',muestraResultado4);

window.onload=function () {mitablajax.micompletar(window.document.forms["criterios"]);}
window.onload=function () {mitablajax2.micompletar2(window.document.forms["criterios"]);}
window.onload=function () {mitablajax3.micompletar3(window.document.forms["criterios"]);}
window.onload=function () {mitablajax4.micompletar4(window.document.forms["criterios"]);}


</script>

<!--FIN DEL CODIGO DE AJAX--------------------------------------------------------------------->


<body style="height: 1128px">

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

if($move['admin']=="1")
{
header ("Location: ../../admin/menuadmin.php");
}

}//fin else

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


<div id="contenedorotros" style="left: 0px; top: 0px; height:auto;overflow:hidden;">
<div id="encabezadologin">

<div id="logo">
<div id="logoimagen">
<img src="../../../imagenes/sites.png" alt="sites"/>
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
<li><a href="../../instrucciones.php" target="_blank">Guia para registro</a></li>

<!--
<li><a href="../ast.php">Registro en AST</a></li>
-->

<li><a href="#" >Registro</a>
<ul>
<li><a href="../ast.php" >Manual</a></li>

<li><a href="../cargar_archivo.php" >Desde archivo</a></li>
<?php
if( $pendientes != 0 )
{
echo '<li><a href="../ast_excel.php" >Pendientes('; echo $pendientes; echo ')</a></li>';
}
?>
</ul>
</li>

<li><a href="../corregirast.php"><?php if( $num != 0 ){ echo '<div id="resaltado" style="color:yellow;">AST Denegados</div>'; }else{ echo 'AST Denegados';}?></a></li>
<li><a href="../2_revisarast.php">Modificar AST</a></li>

<li><a href="#">Reportes</a>
<ul>
<li><a href="../reportes/graficos_colaborador/colaborador_reporte.php" >Por colaborador</a></li>
<li><a href="../reportes/graficos_area/area_reporte.php" >Por &aacute;rea</a></li>
<li><a href="../reportes/graficos_empresa/empresa_reporte.php" >Por empresa</a></li>
<li><a href="../control/control.php" >Control de entregas</a></li>

</ul>
</li>

<li><a href="#" style="color:orange;">Proyectos</a>
<ul>
<li><a href="nuevoproyectoseleccionar.php" >Agregar Nuevo Proyecto</a></li>
<li><a href="nuevoproyectoModificar.php" style="color:orange;">Modificar Proyecto</a></li>
<li><a href="cerrarproyecto.php">Cerrar Proyecto</a></li>
<li><a href="reporteproyectocurso.php">Reporte Proyectos en Curso</a></li>
<li><a href="reporteproyectofinalizado.php">Reporte Proyectos Terminados</a></li>
</ul>
</li>

<li><a href="../../cerrarsesion.php">Cerrar sesion</a></li>
</ul>
</div>
</div>
<!--FIN DE LA BARRA DE MENU -->

<div id="contenedorform" style="left: 0px; top: 0px; height:auto;overflow:hidden;">
<form name="sesiones" action="modificar_procesar.php" method="post" onsubmit="return validarproyectomodificar(this)" >
<div id="encabezado" style="margin-top:-15px;">
<p>Modificar Proyecto</p>
</div>



<div id="cajas" >
<div id="selecttex">
<select name="empresasnuevas" size="1" onchange="mitablajax4.micompletar4(this.form);">
<?php
$sqlcorre34="select nombre from empresas where estado='a'";
$result234 = mysql_query($sqlcorre34,$conexion);
?>
<option value="">Lista de empresas</option>
<?php
while ( $correlativos134=mysql_fetch_array($result234) )
{
$namerr34=$correlativos134['nombre'];
echo "<option value=".$namerr34.">".$namerr34."</option>";

}
?>
</select>
</div>
<div id="textos">
<p><b>Seleccionar empresa :</b></p>
</div>
</div>



<div id="cajas" >
<div id="selecttex">
<select name="areasnuevas" size="1" onchange="mitablajax4.micompletar4(this.form);">
<?php
$sqlcorre45="select codigo from area where estado='a'";
$result245 = mysql_query($sqlcorre45,$conexion);
?>
<option value="">Lista de &aacute;reas</option>
<?php
while ( $correlativos145=mysql_fetch_array($result245) )
{
$correlativos245=$correlativos145['codigo'];
echo "<option value=".$correlativos245.">".$correlativos245."</option>";
}
?>
</select>
</div>
<div id="textos">
<p><b>Seleccionar &aacute;rea :</b></p>
</div>
</div>


<!------------------------------------------------------------------------------------------------------------------------>

<div id="bloq">

<div id="cajas" >
<div id="selecttex">
<select name="opciones" size="1" onchange="mitablajax3.micompletar3(this.form);">
<option value="">Lista de proyectos</option>
</select>
</div>
<div id="textos">
<p><b>Seleccionar proyecto :</b></p>
</div>
</div>



<!------------------------------------------------------------------------------------------------------------------------>


<!--DESPLEGAR AJAX--------------------------->
<div id="bloque">

<div id="contenedorform" style="height:auto;overflow:hidden;">

<div id="encabezado" style="border-radius:0px;">
<p>---------------- Datos del proyecto a modificar ----------------</p>
</div>
<div id="cajas" >
<div id="selecttex">
<select name="opcion1" disabled="disabled" size="1" onchange="mitablajax.micompletar(this.form);">
</select>
</div>
<div id="textos">
<p><b>Proyecto para :</b></p>
</div>
</div>

<div id="cajas" >
<div id="selecttex">
<select name="opcion2" disabled="disabled" size="1" onchange="mitablajax2.micompletar2(this.form);" >
</select>
</div>
<div id="textos">
<p><b>&Aacute;rea del proyecto :</b></p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text"  name="correlativo" disabled="disabled" value="" />
</div>
<div id="textos">
<p>Correlativo proyecto :</p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text" disabled="disabled"  name="nombre" value="" />
</div>
<div id="textos">
<p>Nombre proyecto :</p>
</div>
</div>

<div id="cajas" style="height: 50px">
<div id="inputtex" style="height: 48px">
<textarea name="descripcion" disabled="disabled" style="width: 207px; height: 48px" ></textarea>
</div>
<div id="textos">
<p>Descripci&oacute;n del proyecto :</p>
</div>
</div>


<div id="cajas10"   style="margin-top:20px;">
<div id="selecttex">
<select disabled="disabled" name="opcion20" size="1" onchange="mitablajax.micompletar(this.form);" >
</select>
</div>
<div id="textos">
<p><b>&Aacute;rea del coordinador :</b></p>
</div>
</div>


<div id="cajas" >
<div id="selecttex">
<select disabled="disabled" name="coordinador" size="1">
</select>
</div>
<div id="textos">
<p><b>Coordinador proyecto :</b></p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="date" disabled="disabled"  name="inicio" value="" />
</div>
<div id="textos">
<p>Fecha de inicio :</p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="date" disabled="disabled"  name="fin" value=""  />
</div>
<div id="textos">
<p>Fecha de fin :</p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="date" disabled="disabled"  name="cierre" value=""  />
</div>
<div id="textos">
<p>Fecha real de cierre :</p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text" disabled="disabled"  name="anio" value="" />
</div>
<div id="textos">
<p>A&ntilde;o de apertura  :</p>
</div>
</div>

<div id="cajasbotom">
<div id="inputbotom">
<input type="submit" disabled="disabled" value="Modificar proyecto"/>
</div>
</div>

</div>

</div>
<!------------------------------------------->

</div>

</form>
</div>


<div id="footer2" style="margin-top:30px;"></div>
</div>

</body>

</html>

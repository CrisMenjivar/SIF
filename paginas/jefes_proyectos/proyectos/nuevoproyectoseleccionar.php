<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" type="text/javascript" src="../../../js/horas/jquery-1.7.1.min.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/formularios.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/seguridad.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/astnuevos.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/horas/jquery-ui-1.10.4.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/horas/datepicker-es.js"></script>
<link href="../../../estilo/estiloformularios.css" rel="stylesheet" type="text/css" />
<link href="../../../estilo/flick/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Nuevo Proyecto</title>

</head>

<!--codigo de ajax para seleccionar el proyecto--------------------------------------------->

<script type="text/javascript" src="../../../js/ajax.js">
</script>

<script type="text/javascript">
objetoAjax.prototype.micompletar=micompletar;
objetoAjax.prototype.micompletar2=micompletar2;

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
var tipss=forma.tip;

var departamento;

if( document.getElementById('identificado_uno').checked )
{
departamento="IT";
}

if( document.getElementById('identificado_dos').checked )
{
departamento="IS";
}

this.curl="?empresa="+vempresa.options[vempresa.selectedIndex].value+"&area="+varea.options[varea.selectedIndex].value+"&tipes="+departamento;
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

var mitablajax=new objetoAjax('GET','area_ajax.php',muestraResultado);
var mitablajax2=new objetoAjax('GET','proyecto_ajax.php',muestraResultado2);

window.onload=function () {mitablajax.micompletar(window.document.forms["criterios"]);}
window.onload=function () {mitablajax2.micompletar2(window.document.forms["criterios"]);}

</script>

<!--FIN DEL CODIGO DE AJAX--------------------------------------------------------------------->

<body>

<?php

$codigo="";

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
<p class="logueado">Bienvenido : <?php echo $_SESSION['user']; ?></p>
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
<li><a href="nuevoproyectoseleccionar.php" style="color:orange;">Agregar Nuevo Proyecto</a></li>
<li><a href="nuevoproyectoModificar.php" >Modificar Proyecto</a></li>
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
<form name="sesiones" action="nuevoproyectoinsertar.php" method="post" onsubmit="return validarproyecto(this)" >
<div id="encabezado" style="margin-top:-20px;">
<p>Agregar nuevo proyecto</p>
</div>


<div id="cajas" >
<div id="selecttex">
<select name="opcion1" size="1" style="width: 193px" onchange="mitablajax2.micompletar2(this.form);"  > <!-- onchange="mitablajax.micompletar(this.form);"  -->
<?php
$sqlcorre="select * from empresas where estado='a' ";
$result2 = mysql_query($sqlcorre,$conexion);
?>
<option value="">Seleccione una Empresa</option>
<?php
while ( $correlativos1=mysql_fetch_array($result2) )
{
$correlativos2=$correlativos1['nombre'];
echo "<option value=".$correlativos2.">".$correlativos2."</option>";
}
?>
</select>
</div>
<div id="textos">
<p><b>Proyecto para :</b></p>
</div>
</div>

<!--DESPLEGAR AJAX--------------------------->
<div id="res" style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px;">

<div id="cajas10"   style="margin-top:20px;">
<div id="selecttex">
<select name="opcion2" size="1" onchange="mitablajax2.micompletar2(this.form);" style="width: 192px" >
<?php
$sql2="select * from area where estado='a' ";
$result2 = mysql_query($sql2,$conexion);
?>
<option value="">Seleccione una &aacute;rea</option>
<?php
while ( $areas=mysql_fetch_array($result2) )
{
$area=$areas['codigo'];
$name=$areas['nombre'];
echo "<option value=".$area.">".$area." - ".$name."</option>";
}
?>
</select>
</div>
<div id="textos">
<p><b>&Aacute;rea del proyecto :</b></p>
</div>
</div>

</div> <!-- fin division res -->
<!------------------------------------------->

<div id="cajas2"    >
<div id="radiotex1">
<div id="radiotex2">
<input type="radio"  name="tip" id="identificado_uno" value="IT" checked="checked" onchange="mitablajax2.micompletar2(this.form);" />
</div>
<div id="textradio"><p>IT</p></div>
</div>
<div id="textos">
<p>Clasificaci&oacute;n :</p>
</div>
</div>

<div id="cajas2"    >
<div id="radiotex1">
<div id="radiotex2">
<input type="radio"  name="tip" value="IS" id="identificado_dos"   onchange="mitablajax2.micompletar2(this.form);" />
</div>
<div id="textradio"><p>IS</p></div>
</div>
<div id="textos">
<p><b></b></p>
</div>
</div>



<div id="contenedorform2" style="margin-top:5px;">

<!--DESPLEGAR AJAX--------------------------->
<div id="tabla" style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px;">

<div id="cajas">
<div id="inputtex">
<input type="text"  disabled="disabled" name="corre" value="" />
<input type="hidden" name="correlativo" value="<?PHP echo $codigo; ?>" />
</div>
<div id="textos">
<p>Correlativo proyecto :</p>
</div>
</div>

</div>
<!-- fin div tabla----------------------------------------->


<div id="cajas">
<div id="inputtex">
<input type="text"  name="nombre" value="" />
</div>
<div id="textos">
<p>Nombre proyecto :</p>
</div>
</div>

<div id="cajas" style="height: 50px">
<div id="inputtex" style="height: 48px">
<textarea name="descripcion" style="width: 207px; height: 48px" ></textarea>
</div>
<div id="textos">
<p>Descripci&oacute;n del proyecto :</p>
</div>
</div>


<div id="cajas10"   style="margin-top:20px;">
<div id="selecttex">
<select name="opcion20" size="1" onchange="mitablajax.micompletar(this.form);" >
<?php
$sql2="select * from area where estado='a' ";
$result2 = mysql_query($sql2,$conexion);
?>
<option value="">Seleccione una &aacute;rea</option>
<?php
while ( $areas=mysql_fetch_array($result2) )
{
$area=$areas['codigo'];
$name=$areas['nombre'];
echo "<option value=".$area.">".$area." - ".$name."</option>";
}
?>
</select>
</div>
<div id="textos">
<p><b>&Aacute;rea del coordinador :</b></p>
</div>
</div>


<!--  INICIO DE LA DIVISION PARA CARGAR LOS USUARIOS SEGUN EL AREA ELEGIDA -->

<div id="res_uno">
<div id="cajas" >
<div id="selecttex">
<select name="coordinador" size="1">

<option value="">Seleccione un Coordinador</option>
<!--
<?php
$sql2="select * from usuarios where estado='a'";
$result2 = mysql_query($sql2,$conexion);

while ( $name=mysql_fetch_array($result2) )
{
$names=$name['user'];
echo "<option value=".$names.">".$names."</option>";
}
?>
-->

</select>
</div>
<div id="textos">
<p><b>Coordinador proyecto :</b></p>
</div>
</div>

</div>
<!--FIN DE DIV RES_UNO -->

<div id="cajas">
<div id="textos" style="float:left;">
<p>Fecha de inicio :</p>
</div>

<div id="inputtex" style="width: 36%;float:left;margin-right:2px;margin-left:13px;">
<input type="text" id="fecha_inicio"  name="inicio" value="" style="text-align:center;" onkeypress="return acceptNumhorasNada(event)"/>
</div>

</div>

<div id="cajas">
<div id="textos" style="float:left;">
<p>Fecha de fin :</p>
</div>

<div id="inputtex" style="width: 36%;float:left;margin-right:2px;margin-left:13px;">
<input type="text" id="fecha_fin" name="fin" value="" style="text-align:center;" onkeypress="return acceptNumhorasNada(event)" />
</div>

</div>

<div id="cajas">

<div id="textos" style="float:left;">
<p>Fecha real de cierre :</p>
</div>

<div id="inputtex" style="width: 36%;float:left;margin-right:2px;margin-left:13px;">
<input type="text" disabled="disabled" id="fecha_cierre"  name="cierress" value="0000-00-00" onkeypress="return acceptNumhorasNada(event)" style="text-align:center;" />
</div>

<input type="hidden" name="cierre" value="0000-00-00" />

</div>

<div id="cajas">
<div id="inputtex">
<input type="text"  name="anio" value="" />
</div>
<div id="textos">
<p>A&ntilde;o de apertura  :</p>
</div>
</div>


<div id="cajasbotom">
<div id="inputbotom">
<input type="submit" value="Guardar Proyecto"/>
</div>
</div>

</div>


</form>
</div>
<div id="footer2" style="margin-top:30px;"></div>
</div>

<!-- script que define y configura el calendario-->
<script type="text/javascript">
$(function() {
	$( "#fecha_inicio" ).datepicker({
	  defaultDate: "+1w",
	  changeMonth: true,
	  numberOfMonths: 3,
	  dateFormat: 'yy-mm-dd',
	  onClose: function( selectedDate ) {
		$( "#fecha_fin" ).datepicker( "option", "minDate", selectedDate );
	  }
	});
	$( "#fecha_fin" ).datepicker({
	  defaultDate: "+1w",
	  changeMonth: true,
	  numberOfMonths: 3,
	  dateFormat: 'yy-mm-dd',
	  onClose: function( selectedDate ) {
		$( "#fecha_inicio" ).datepicker( "option", "maxDate", selectedDate );
	  }
	});
  });
  
  $(function() {
	$( "#fecha_cierre" ).datepicker({
	  defaultDate: "+1w",
	  changeMonth: true,
	  numberOfMonths: 1,
	  dateFormat: 'yy-mm-dd',
	});
  });  
</script>

</body>

</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" type="text/javascript" src="../../../js/astnuevos.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/seguridad.js"></script>
<link href="../../../estilo/estiloast.css" rel="stylesheet" type="text/css" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>An&aacute;lisis Semanal de Tiempo -- AST</title>

<!-- inicio de script para los input de las horas ------------------------------------------------------->
<script type="text/javascript" language="javascript" src="../../../js/horas/jquery-1.7.1.min.js"></script>
<script type="text/javascript" language="javascript" src="../../../js/horas/jquery.mousewheel.js"></script>
<script type="text/javascript" language="javascript" src="../../../js/horas/jquery.timepickerinputmask.min.js"></script>

<script type="text/javascript" language="javascript">
$(document).ready(function () {

$('.input1').TimepickerInputMask();

$('.input2').TimepickerInputMask();

});
</script>

<!--FIN DE LAS HORAS------------------------------------------------------------------------------------->

<!--Hoja de estilos del calendario --------------------------------------------------------------------->
<link rel="stylesheet" type="text/css" media="all" href="../../../js/calendario/calendar-blue2.css" title="win2k-cold-1" />
<!-- librería principal del calendario -->
<script type="text/javascript" src="../../../js/calendario/calendar.js"></script>
<!-- librería para cargar el lenguaje deseado -->
<script type="text/javascript" src="../../../js/calendario/lang/calendar-es.js"></script>
<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código -->
<script type="text/javascript" src="../../../js/calendario/calendar-setup.js"></script>
<!--Hoja de estilos del calendario --------------------------------------------------------------------->

<style type="text/css">
.auto-style2 {
color: #0033CC;
}
</style>

<script type="text/javascript" src="../../../js/ajax.js">
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

if($move['admin']=="3")
{
header ("Location: ../../jefes/ast.php");
}

if($move['admin']=="2")
{
header ("Location: ../../usuarios/ast.php");
}

if($move['admin']=="4")
{
header ("Location: ../../jefes_proyectos/ast.php");
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
<div id="conteencabezado" >
<div id="cerrar">
<ul>
<li><a href="#" style="color:orange;">Men&uacute;</a>
<ul>
<li><a href="../menuadmin.php">Inicio</a></li>
<li><a href="../../instrucciones.php" target="_blank">Gu&iacute;a para registro</a></li>
<li><a href="../correo/nuevo_correo.php">Enviar correo</a></li>
<li><a href="ast.php" >Llenar AST [Administrador]</a></li>
<li><a href="cargar_archivo.php" style="color:orange;">Registrar desde archivo</a></li>
<li><a href="corregirast.php">AST Denegados [Administrador]</a></li>
<li><a href="modificarast.php">Modificar AST [Administrador]</a></li>

<?php
if( $pendientes != 0 )
{
echo '<li><a href="ast_excel.php" >Pendientes ('; echo $pendientes; echo ')</a></li>';
}
?>

<li><a href="../control/control.php">Control de entregas AST</a></li>
<li><a href="../../cerrarsesion.php">Cerrar sesi&oacute;n</a></li>
</ul>
</li>

<li><a href="#">Revisi&oacute;n AST</a>
<ul>
<li><a href="../revisarast/revisarast.php" >Revisi&oacute;n de AST por &aacute;rea</a></li>
</ul>
</li>

<li><a href="#">Usuarios</a>
<ul>
<li><a href="../usuarios/nuevousuario.php" >Agregar Nuevo Usuario</a></li>
<li><a href="../usuarios/nuevousuarioModificar.php">Modificar Usuario</a></li>
<li><a href="../usuarios/eliminarusuario.php">Eliminar Usuario</a></li>
<li><a href="../usuarios/reporteusuario.php">Reporte de Usuarios</a></li>

<!--centros de costos -->
<li><a href="../ccosto/nuevo_grupo.php" >Agregar centro de costo</a></li>
<li><a href="../ccosto/modificar_grupo.php" >Modificar centro de costo</a></li>
<li><a href="../ccosto/eliminar_grupo.php" >Eliminar centro de costo</a></li>
<li><a href="../ccosto/reporte_grupo.php" >Reporte de centros de costos</a></li>

</ul>
</li>

<li><a href="#">Departamentos</a>
<ul>
<li><a href="../departamentos/nuevodepartamento.php" >Agregar Nuevo Departamento</a></li>
<li><a href="../departamentos/nuevodepartamentoModificar.php" >Modificar Departamento</a></li>
<li><a href="../departamentos/eliminardepartamento.php">Eliminar Departamento</a></li>
<li><a href="../departamentos/reportedepartamento.php">Reporte de Departamentos</a></li>
<!--INICIO DE LOS SUBDEPARTAMENOS -->
<li><a href="../subarea/nuevodepartamento.php" >Agregar Nuevo Sub-departamento</a></li>
<li><a href="../subarea/nuevodepartamentoModificar.php" >Modificar Sub-departamento</a></li>
<li><a href="../subarea/eliminardepartamento.php">Eliminar Sub-departamento</a></li>
<li><a href="../subarea/reportedepartamento.php">Reporte de Sub-departamentos</a></li>

</ul>
</li>

<li><a href="#">Empresas</a>
<ul>
<li><a href="../empresas/nuevaempresa.php" >Agregar Nueva Empresa</a></li>
<li><a href="../empresas/nuevaempresaModificar.php" >Modificar Empresa</a></li>
<li><a href="../empresas/eliminarempresa.php">Eliminar Empresa</a></li>
<li><a href="../empresas/reporteempresa.php">Reporte de Empresas</a></li>
</ul>
</li>

<li><a href="#">Actividades</a>
<ul>
<li><a href="../actividades/nuevaactividad.php" >Agregar Nueva Actividad</a></li>
<li><a href="../actividades/eliminaractividad.php">Eliminar Actividad</a></li>
<li><a href="../actividades/reporteactividades.php">Reporte Actividades</a></li>
</ul>
</li>

<li><a href="#">Proyectos</a>
<ul>
<li><a href="../proyectos/nuevoproyectoseleccionar.php" >Agregar Nuevo Proyecto</a></li>
<li><a href="../proyectos/nuevoproyectoModificar.php" >Modificar Proyecto</a></li>
<li><a href="../proyectos/cerrarproyecto.php">Cerrar Proyecto</a></li>
<li><a href="../proyectos/reporteproyectocurso.php">Reporte Proyectos en Curso</a></li>
<li><a href="../proyectos/reporteproyectofinalizado.php">Reporte Proyectos Terminados</a></li>
</ul>
</li>

<li><a href="#">Grupos</a>
<ul>
<li><a href="../grupos/nuevo_grupo.php" >Agregar Nuevo Grupo</a></li>
<li><a href="../grupos/modificar_grupo.php" >Modificar Grupo</a></li>
<li><a href="../grupos/eliminar_grupo.php" >Eliminar Grupo</a></li>
<li><a href="../grupos/reporte_grupo.php" >Reporte De Grupos</a></li>
</ul>
</li>

<li><a href="#">Reportes</a>
<ul>
<li><a href="../reportes/reporte_seleccionar.php" >Reporte AST-Mes</a></li>
<li><a href="../reportes/reporte_seleccionar_anual.php" >Reporte AST-Anual</a></li>
<li><a href="../reportes/graficos_colaborador/colaborador_reporte.php" >Por colaborador</a></li>
<li><a href="../reportes/graficos_area/area_reporte.php" >Por &aacute;reas</a></li>
<li><a href="../reportes/graficos_empresa/empresa_reporte.php" >Por empresas</a></li>

<!--    <li><a href="reportes/horizontal2.php" >horizontal</a></li>
<li><a href="reportes/vertical.php" >vertical</a></li>
<li><a href="llenar.php" >Llenar</a></li> -->
</ul>
</li>


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

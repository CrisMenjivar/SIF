<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" type="text/javascript" src="../../../js/formularios.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/seguridad.js"></script>
<link href="../../../estilo/estiloformularios.css" rel="stylesheet" type="text/css" />

<!--[if lt IE 9]>
<script src="../../../js/IE9.js" type="text/javascript"></script>
<![endif]-->

<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Control AST</title>

<script type="text/javascript" src="../../../js/ajax.js">
</script>

<script type="text/javascript">
objetoAjax.prototype.micompletar4=micompletar4;

function micompletar4(forma)
{// 2)realiza la primera llamada al query dependiendo q se selecciono
var vmes1=forma.mes1;
var vanio1=forma.year1;
var varea1=forma.area;
// muestra el complemento de la url
this.curl="?mes="+vmes1.options[vmes1.selectedIndex].value+"&anio="+vanio1.options[vanio1.selectedIndex].value+"&area="+varea1.options[varea1.selectedIndex].value;
//alert('COMPLEMENTO DE URL: \n\r'+this.curl);
this.ejecutar();//ejecuta la llamada
}

function muestraResultado4()
{
if(this.readyState == 4)
{
if(this.status == 200)
{
var texto=this.responseText;
divTabla=window.document.getElementById('mes'); //3)muestra el resultado en este id
divTabla.innerHTML=texto;
}
}
}

var mitablajax4=new objetoAjax('GET','mes_ajax.php',muestraResultado4);
window.onload=function () {mitablajax4.micompletar4(window.document.forms["criterios"]);}


</script>


</head>

<body>

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

//------------------------------------------------------------

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
<li><a href="#" style="color:orange;">Men&uacute;</a>
<ul>
<li><a href="../menuadmin.php">Inicio</a></li>
<li><a href="../../instrucciones.php" target="_blank">Gu&iacute;a para registro</a></li>
<li><a href="../correo/nuevo_correo.php">Enviar correo</a></li>
<li><a href="../ast/ast.php">Llenar AST [Administrador]</a></li>
<li><a href="../ast/cargar_archivo.php" >Registrar desde archivo</a></li>
<li><a href="../ast/corregirast.php">AST Denegados [Administrador]</a></li>
<li><a href="../ast/modificarast.php">Modificar AST [Administrador]</a></li>

<?php
if( $pendientes != 0 )
{
echo '<li><a href="../ast/ast_excel.php" >Pendientes ('; echo $pendientes; echo ')</a></li>';
}
?>

<li><a href="control.php" style="color:orange;">Control de entregas AST</a></li>
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

<div id="contenedorrevisar" style="left: 0px; top: 0px; height: auto;padding-bottom:20px;">
<form name="sesiones" target="_blank" action="colaborador_procesar.php" method="post" onsubmit="return validarproyectoseleccionar(this)" >

<div id="cajasrevisar" style="height: 4px"  >
</div>

<div id="cajasrevisar"  >
<h3>Control de registro de actividades :</h3>
</div>



<div id="cajasrevisar"  >

<div id="textosrevisar">
<p><b>Seleccione el &aacute;rea :</b></p>
</div>
<div id="selecttexrevisar">
<select name="area" size="1" onchange="mitablajax4.micompletar4(this.form);">
<?php
$sqlcorre="select * from area where estado='a'";
$result2 = mysql_query($sqlcorre,$conexion);
?>
<option value="">&Aacute;reas</option>
<?php
while ( $correlativos1=mysql_fetch_array($result2) )
{
$correlativos2=$correlativos1['codigo'];
echo "<option value=".$correlativos2.">".$correlativos2."</option>";
}
?>
</select>
</div>

<div id="textosrevisar">
<p><b>Mes :</b></p>
</div>

<div id="selecttexrevisar">
<select name="mes1" size="1" onchange="mitablajax4.micompletar4(this.form);">
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
<select id="otro" name="year1" size="1" onchange="mitablajax4.micompletar4(this.form);">
<option value="">Seleccionar a&ntilde;o</option>
<option value="2013" selected="selected">2013</option>
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
<div id="mes" style="margin-top:20px;padding-top:20px;"></div>
</form>

<div id="indica">
<p>
**Indicaciones : <br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*Las columnas con fondo azul oscuro indican fines de semana.<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*Los colaboradores marcados en color rojo presentan demoras en el registro de datos con 3 dias de retraso con respecto a la fecha de emision del reporte.
</p>
</div>


</div>

</div>

</body>

</html>

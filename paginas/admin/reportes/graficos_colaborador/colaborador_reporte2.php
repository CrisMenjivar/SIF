<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" type="text/javascript" src="../../../../js/formularios.js"></script>

<script language="javascript" type="text/javascript" src="../../../../js/seguridad.js"></script>

<link href="../../../../estilo/estiloformularios.css" rel="stylesheet" type="text/css" />

<!--[if lt IE 9]>
<script src="../../../../js/IE9.js" type="text/javascript"></script>
<![endif]-->
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Reportes por colaborador</title>
<script type="text/javascript" src="../../../../js/ajax.js">
</script>

<!--Hoja de estilos del calendario --------------------------------------------------------------------->
<link rel="stylesheet" type="text/css" media="all" href="../../../../js/calendario/calendar-blue2.css" title="win2k-cold-1" />
<!-- librería principal del calendario -->
<script type="text/javascript" src="../../../../js/calendario/calendar.js"></script>
<!-- librería para cargar el lenguaje deseado -->
<script type="text/javascript" src="../../../../js/calendario/lang/calendar-es.js"></script>
<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código -->
<script type="text/javascript" src="../../../../js/calendario/calendar-setup.js"></script>
<!--Hoja de estilos del calendario --------------------------------------------------------------------->


<script type="text/javascript">
objetoAjax.prototype.micompletar=micompletar;
objetoAjax.prototype.micompletar2=micompletar2;

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

function micompletar2(forma)
{// 2)realiza la primera llamada al query dependiendo q se selecciono
var vreporte=forma.reporte;
// muestra el complemento de la url
this.curl="?reporte="+vreporte.options[vreporte.selectedIndex].value;
//alert('COMPLEMENTO DE URL: \n\r'+this.curl);
this.ejecutar();//ejecuta la llamada
}

function muestraResultado2()
{
if(this.readyState == 4)
{
if(this.status == 200)
{
var texto=this.responseText;
divTabla=window.document.getElementById('nuevo'); //3)muestra el resultado en este id
divTabla.innerHTML=texto;
}
}
}


var mitablajax=new objetoAjax('GET','consultaajax.php',muestraResultado);
window.onload=function () {mitablajax.micompletar(window.document.forms["criterios"]);}

var mitablajax2=new objetoAjax('GET','colaborador_4_ajax.php',muestraResultado2);
window.onload=function () {mitablajax2.micompletar2(window.document.forms["criterios"]);}

</script>


</head>

<body>
<script type="text/javascript">
if (top != self) top.location.href = location.href;
</script>


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

if($move['admin']=="3")
{
header ("Location: ../../../jefes/ast.php");
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
<li><a href="#">Men&uacute;</a>
<ul>
<li><a href="../../menuadmin.php">Inicio</a></li>
<li><a href="../../../instrucciones.php" target="_blank">Gu&iacute;a para registro</a></li>
<li><a href="../../ast/ast.php">Llenar AST [Administrador]</a></li>
<li><a href="../../ast/cargar_archivo.php" >Registrar desde archivo</a></li>
<li><a href="../../ast/corregirast.php">AST Denegados [Administrador]</a></li>
<li><a href="../../ast/modificarast.php">Modificar AST [Administrador]</a></li>

<?php
if( $pendientes != 0 )
{
echo '<li><a href="../../ast/ast_excel.php" >Pendientes ('; echo $pendientes; echo ')</a></li>';
}
?>

<li><a href="../../control/control.php">Control de entregas AST</a></li>
<li><a href="../../../cerrarsesion.php">Cerrar sesi&oacute;n</a></li>
</ul>
</li>

<li><a href="#">Revisi&oacute;n AST</a>
<ul>
<li><a href="../../revisarast/revisarast.php" >Revisi&oacute;n de AST por &aacute;rea</a></li>
</ul>
</li>

<li><a href="#">Usuarios</a>
<ul>
<li><a href="../../usuarios/nuevousuario.php" >Agregar Nuevo Usuario</a></li>
<li><a href="../../usuarios/nuevousuarioModificar.php">Modificar Usuario</a></li>
<li><a href="../../usuarios/eliminarusuario.php">Eliminar Usuario</a></li>
<li><a href="../../usuarios/reporteusuario.php">Reporte de Usuarios</a></li>

<!--centros de costos -->
<li><a href="../../ccosto/nuevo_grupo.php" >Agregar centro de costo</a></li>
<li><a href="../../ccosto/modificar_grupo.php" >Modificar centro de costo</a></li>
<li><a href="../../ccosto/eliminar_grupo.php" >Eliminar centro de costo</a></li>
<li><a href="../../ccosto/reporte_grupo.php" >Reporte de centros de costos</a></li>

</ul>
</li>

<li><a href="#">Departamentos</a>
<ul>
<li><a href="../../departamentos/nuevodepartamento.php" >Agregar Nuevo Departamento</a></li>
<li><a href="../../departamentos/nuevodepartamentoModificar.php" >Modificar Departamento</a></li>
<li><a href="../../departamentos/eliminardepartamento.php">Eliminar Departamento</a></li>
<li><a href="../../departamentos/reportedepartamento.php">Reporte de Departamentos</a></li>
<!--INICIO DE LOS SUBDEPARTAMENOS -->
<li><a href="../../subarea/nuevodepartamento.php" >Agregar Nuevo Sub-departamento</a></li>
<li><a href="../../subarea/nuevodepartamentoModificar.php" >Modificar Sub-departamento</a></li>
<li><a href="../../subarea/eliminardepartamento.php">Eliminar Sub-departamento</a></li>
<li><a href="../../subarea/reportedepartamento.php">Reporte de Sub-departamentos</a></li>

</ul>
</li>

<li><a href="#">Empresas</a>
<ul>
<li><a href="../../empresas/nuevaempresa.php" >Agregar Nueva Empresa</a></li>
<li><a href="../../empresas/nuevaempresaModificar.php" >Modificar Empresa</a></li>
<li><a href="../../empresas/eliminarempresa.php">Eliminar Empresa</a></li>
<li><a href="../../empresas/reporteempresa.php">Reporte de Empresas</a></li>
</ul>
</li>

<li><a href="#">Actividades</a>
<ul>
<li><a href="../../actividades/nuevaactividad.php" >Agregar Nueva Actividad</a></li>
<li><a href="../../actividades/eliminaractividad.php">Eliminar Actividad</a></li>
<li><a href="../../actividades/reporteactividades.php">Reporte Actividades</a></li>
</ul>
</li>

<li><a href="#">Proyectos</a>
<ul>
<li><a href="../../proyectos/nuevoproyectoseleccionar.php" >Agregar Nuevo Proyecto</a></li>
<li><a href="../../proyectos/nuevoproyectoModificar.php" >Modificar Proyecto</a></li>
<li><a href="../../proyectos/cerrarproyecto.php">Cerrar Proyecto</a></li>
<li><a href="../../proyectos/reporteproyectocurso.php">Reporte Proyectos en Curso</a></li>
<li><a href="../../proyectos/reporteproyectofinalizado.php">Reporte Proyectos Terminados</a></li>
</ul>
</li>

<li><a href="#">Grupos</a>
<ul>
<li><a href="../../grupos/nuevo_grupo.php" >Agregar Nuevo Grupo</a></li>
<li><a href="../../grupos/modificar_grupo.php" >Modificar Grupo</a></li>
<li><a href="../../grupos/eliminar_grupo.php" >Eliminar Grupo</a></li>
<li><a href="../../grupos/reporte_grupo.php" >Reporte De Grupos</a></li>
</ul>
</li>

<li><a href="#" style="color:orange;">Reportes</a>
<ul>
<li><a href="../reporte_seleccionar.php" >Reporte AST-Mes</a></li>
<li><a href="../reporte_seleccionar_anual.php" >Reporte AST-Anual</a></li>
<li><a href="colaborador_reporte.php" style="color:orange;">Por colaborador</a></li>
<li><a href="../graficos_area/area_reporte.php" >Por &aacute;reas</a></li>
<li><a href="../graficos_empresa/empresa_reporte.php" >Por empresas</a></li>

<!--    <li><a href="reportes/horizontal2.php" >horizontal</a></li>
<li><a href="reportes/vertical.php" >vertical</a></li>
<li><a href="llenar.php" >Llenar</a></li> -->
</ul>
</li>


</ul>
</div>

</div>
<!--FIN DE LA BARRA DE MENU -->

<div id="contenedorrevisar" style="left: 0px; top: 0px; height: 241px">

<div id="nuevo">
<form name="sesiones4" target="_blank" action="colaborador_procesar.php" method="post" onsubmit="return reporte_colaborador_admin(this)" >

<div id="cajasrevisar" style="height: 4px"  >
</div>


<div id="cajasrevisar" style="height: 27px" >

<div id="textosrevisar">
<p><b>Seleccionar reporte :</b></p>
</div>
<div id="selecttexrevisar" style="width: 35%">
<select name="reporte" size="1" style="width: 344px" onchange="mitablajax2.micompletar2(this.form);">
<option value="1">Reporte de actividades diarias por colaborador</option>
<option value="2">Utilizaci&oacute;n del tiempo general por colaborador</option>
<option value="3">Utilizaci&oacute;n del tiempo en proyectos por colaborador</option>
<option value="4" selected="selected">Resumen de proyectos por colaborador</option>
</select>
</div>

<div id="textosrevisar" style="width: 12%">
<p><b>Clasificaci&oacute;n :</b></p>
</div>
<div id="selecttexrevisar" style="width: 8%">
<select name="clasificacion" size="1" style="width: 77px" >
<option value="IS">IS</option>
<option value="IT">IT</option>
</select>
</div>


</div>

<div id="cajasrevisar"  >

<div id="textosrevisar">
<p><b>Seleccione el &aacute;rea :</b></p>
</div>
<div id="selecttexrevisar">
<select name="area" size="1" onchange="mitablajax.micompletar(this.form);">
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

<div id="otrotextos" style="width: 21%">
<p><b>Seleccionar colaborador :</b></p>
</div>
<div class="otrosele">
<select id="prueba" name="colaborador" size="1" >
</select>
</div>
</div>


<div id="cajasrevisar"  >

<div id="textosrevisar">
<p><b>Inicio de periodo :</b></p>
</div>

<div id="selecttexrevisar" style="width: 14%">
<input type="text" name="inicio" id="campo_fecha" style="text-align:center; width: 137px;" value="" onkeypress="return acceptNumhorasNada4(event)" style="width: 141px"/></div>
<div id="calendario">
<input type="image" src="../../../../imagenes/calendar.png" id="lanzador" alt="Calendario"/>
</div>



<div id="otrotextos" style="width: 20%">
<p><b>Fin de periodo :</b></p>
</div>
<div class="otrosele" style="width: 16%">
<input type="text" name="fin" id="campo_fecha2" style="text-align:center; width: 155px;" value="" onkeypress="return acceptNumhorasNada4(event)" style="width: 141px"/></div>
<div id="calendario">
<input type="image" src="../../../../imagenes/calendar.png" id="lanzador2" alt="Calendario"/>
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
<div id="conteencabezado" style="margin-top:200px;"></div>
</div>

<!-- script que define y configura el calendario-->
<script type="text/javascript">
Calendar.setup({
inputField     :    "campo_fecha",     // id del campo de texto
ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto
button     :    "lanzador"     // el id del botón que lanzará el calendario
});
</script>

<!-- script que define y configura el calendario-->
<script type="text/javascript">
Calendar.setup({
inputField     :    "campo_fecha2",     // id del campo de texto
ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto
button     :    "lanzador2"     // el id del botón que lanzará el calendario
});
</script>


</body>

</html>

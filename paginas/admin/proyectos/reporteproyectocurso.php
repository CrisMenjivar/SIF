<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" type="text/javascript" src="../../../js/formularios.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/seguridad.js"></script>
<link href="../../../estilo/estiloformularios.css" rel="stylesheet" type="text/css" />
<link href="../../../estilo/reportes.css" rel="stylesheet" type="text/css" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Reporte de Proyectos</title>

<script type="text/javascript" src="../../../js/ajax.js"></script>

<script type="text/javascript">
objetoAjax.prototype.micompletar=micompletar;
objetoAjax.prototype.micompletar2=micompletar2;

function micompletar(forma)
{// 2)realiza la primera llamada al query dependiendo q se selecciono
var varea=forma.area;
var vempresa=forma.empresa;
var vtipo=forma.tipo;
var vdescripcion=forma.descripcion;
var vcantidad=forma.cantidad;
// muestra el complemento de la url
this.curl="?area="+varea.options[varea.selectedIndex].value+"&empresa="+vempresa.options[vempresa.selectedIndex].value+"&tipo="+vtipo.options[vtipo.selectedIndex].value+"&descripcion="+vdescripcion.options[vdescripcion.selectedIndex].value+"&cantidad="+vcantidad.value;   
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
divTabla=window.document.getElementById('reporte2'); //3)muestra el resultado en este id
divTabla.innerHTML=texto;
}
}
}


function micompletar2(forma)
{// 2)realiza la primera llamada al query dependiendo q se selecciono
var vconsulta=forma.consultar;
// muestra el complemento de la url
this.curl="?consulta="+vconsulta.value;
//alert('COMPLEMENTO DE URL: \n\r'+this.curl);
this.ejecutar();//ejecuta la llamada
}


var mitablajax=new objetoAjax('GET','reporte_opciones.php',muestraResultado);
window.onload=function () {mitablajax.micompletar(window.document.forms["criterios"]);}

var mitablajax2=new objetoAjax('GET','reporte_consultar_registros.php',muestraResultado);
window.onload=function () {mitablajax2.micompletar2(window.document.forms["criterios"]);}



</script>

<style type="text/css">

.fila tr {
	
background: rgb(242,249,254);
background: -moz-linear-gradient(45deg,  rgba(242,249,254,1) 0%, rgba(214,240,253,1) 1%);
background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,rgba(242,249,254,1)), color-stop(1%,rgba(214,240,253,1)));
background: -webkit-linear-gradient(45deg,  rgba(242,249,254,1) 0%,rgba(214,240,253,1) 1%);
background: -o-linear-gradient(45deg,  rgba(242,249,254,1) 0%,rgba(214,240,253,1) 1%);
background: -ms-linear-gradient(45deg,  rgba(242,249,254,1) 0%,rgba(214,240,253,1) 1%);
background: linear-gradient(45deg,  rgba(242,249,254,1) 0%,rgba(214,240,253,1) 1%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f2f9fe', endColorstr='#d6f0fd',GradientType=1 );

}

.fila tr:hover td{

/*-------------------------DEGRADADO CELESTE--------------------------------------------------------------------------*/
background: rgb(183,222,237);
background: -moz-linear-gradient(top,  rgba(183,222,237,1) 0%, rgba(113,206,239,1) 50%, rgba(33,180,226,1) 51%, rgba(183,222,237,1) 100%); 
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(183,222,237,1)), color-stop(50%,rgba(113,206,239,1)), color-stop(51%,rgba(33,180,226,1)), color-stop(100%,rgba(183,222,237,1)));
background: -webkit-linear-gradient(top,  rgba(183,222,237,1) 0%,rgba(113,206,239,1) 50%,rgba(33,180,226,1) 51%,rgba(183,222,237,1) 100%); 
background: -o-linear-gradient(top,  rgba(183,222,237,1) 0%,rgba(113,206,239,1) 50%,rgba(33,180,226,1) 51%,rgba(183,222,237,1) 100%); 
background: -ms-linear-gradient(top,  rgba(183,222,237,1) 0%,rgba(113,206,239,1) 50%,rgba(33,180,226,1) 51%,rgba(183,222,237,1) 100%); 
background: linear-gradient(to bottom,  rgba(183,222,237,1) 0%,rgba(113,206,239,1) 50%,rgba(33,180,226,1) 51%,rgba(183,222,237,1) 100%); 
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b7deed', endColorstr='#b7deed',GradientType=0 ); 

/*---------------------------------------------------------------------------------------------------*/

}

</style>

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

<div id="contenedor">
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
<li><a href="#">Men&uacute;</a>
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

<li><a href="#" style="color:orange;">Proyectos</a>
<ul>
<li><a href="nuevoproyectoseleccionar.php" >Agregar Nuevo Proyecto</a></li>
<li><a href="nuevoproyectoModificar.php" >Modificar Proyecto</a></li>
<li><a href="cerrarproyecto.php">Cerrar Proyecto</a></li>
<li><a href="reporteproyectocurso.php" style="color:orange;">Reporte Proyectos en Curso</a></li>
<li><a href="reporteproyectofinalizado.php">Reporte Proyectos Terminados</a></li>
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

<h2 align="center">Reporte de proyectos en curso</h2>

<form name="sesiones" action="" method="post" target="_parent" >
<div id="filtro">
<div id="filtro1" style="width: 352px">
<div id="filtro11" style="width: 152px; height: 20px">
<p style="width: 147px">Empresas : &nbsp;&nbsp;&nbsp;&nbsp;</p>
</div>
<div id="filtro12">
<select name="empresa" size="1" style="width: 196px" onchange="mitablajax.micompletar(this.form);"  >
<?php
$sqlcorre="select * from empresas where estado='a' ";
$result2 = mysql_query($sqlcorre,$conexion);
?>
<option value="general">General</option>
<?php
while ( $correlativos1=mysql_fetch_array($result2) )
{
$correlativos2=$correlativos1['nombre'];
echo "<option value=".$correlativos2.">".$correlativos2."</option>";
}
?>
</select>

</div>
</div>

<div id="filtro1" style="width: 338px">
<div id="filtro11" style="width: 113px">
<p style="width: 117px">&Aacute;reas : &nbsp;&nbsp;&nbsp;&nbsp;</p>
</div>
<div id="filtro12" style="width: 214px">
<select name="area" size="1" onchange="mitablajax.micompletar(this.form);" style="width: 202px" >
<?php
$sql2="select * from area where estado='a' ";
$result2 = mysql_query($sql2,$conexion);
?>
<option value="general">General</option>
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
</div>

<div id="filtro1" style="width: 248px">
<div id="filtro11" style="width: 113px">
<p style="width: 117px">Tipo : &nbsp;&nbsp;&nbsp;&nbsp;</p>
</div>
<div id="filtro12" style="width: 125px">
<select name="tipo" size="1" onchange="mitablajax.micompletar(this.form);" style="width: 107px" >
<option value="general">General</option>
<option value="IT">IT</option>
<option value="IS">IS</option>
</select>

</div>
</div>

</div><!--fin div filtro -->





<div id="filtro" style="height: 43px">

<div id="filtro1" style="width: 560px">
<div id="filtro11" style="width: 212px; height: 20px">
<p style="width: 209px">B&uacute;squeda especifica : &nbsp;</p>
</div>
<div id="filtro12" style="width: 260px">
<input type="text" name="consultar" value="" style="width: 256px; text-align:center;" onkeypress="mitablajax2.micompletar2(this.form);" />
</div>
</div>


<div id="filtro1" style="width: 394px">
<div id="filtro11" style="width: 242px; height: 20px">
<p style="width: 236px">Descripci&oacute;n del proyecto : &nbsp;</p>
</div>
<div id="filtro12" style="width: 141px">
<select name="descripcion" style="width: 107px" onchange="mitablajax.micompletar(this.form);">
<option value="NO">NO</option>
<option value="SI">SI</option>
</select>
</div>
</div>

</div>

<div id="filtro" style="height: 28px">
<div id="filtro1" style="width: 769px">
<div id="filtro11" style="width: 239px; height: 20px">
<p style="width: 252px">Proyectos con tiempo <?php echo '<' ?> a : &nbsp;&nbsp;&nbsp;&nbsp;</p>
</div>
<div id="filtro12">
<input type="text" value="" name="cantidad" style="width:122px;text-align:center;" />

<!--
<select name="cantidad" onchange="mitablajax.micompletar(this.form);" style="width:122px">
<option value="NO" selected="selected">Desactivar</option>
<option value="0">0</option>
<option value="250">250</option>
<option value="500">500</option>
<option value="1000">1000</option>
<option value="1500">1500</option>
</select>
-->
</div>

<div id="filtro11" style="width:153px" >
<p style="float:left;margin-left:5px;">horas</p>
<input type="button" name="otro" value="Buscar" onclick="mitablajax.micompletar(this.form);"  style="float:left;margin-left:10px;"/>
</div>


</div>

</div>



</form>

<div id="reporte2"> <!--division donde se despliega ajax -->

<table width="1000px" border="0" cellpadding="1" cellspacing="1" style="border-color:#000099;background-color:#3b5998;color:white;font-size:14px;">
<tr>
<td width="130px"  height="19px" align="center"> Correlativo </td>
<td width="372px"  height="19px" align="center"> Nombre proyecto </td>
<td width="100px" height="19px" align="center"> Empresa</td>
<td width="60px" height="19px" align="center">&Aacute;rea</td>
<td width="111px" height="19px" align="center"> Coordinador</td>
<td width="92px" height="19px" align="center"> Inicio</td>
<td width="92px"  height="19px" align="center"> Fin estimado</td>
<td width="65px"  height="19px" align="center"> A&ntilde;o</td>
</tr>
</table>


<table cellpadding="0" cellspacing="0" border="1" class="fila" >
<?php
$sql2="select * from proyectos where freal='0000-00-00' and correlativo!='NO_ES_PROYECTO' ";
$result2 = mysql_query($sql2,$conexion);

while ( $proyectos=mysql_fetch_array($result2) )
{
$correlativo=$proyectos['codigo'];
$nombre=$proyectos['nombre'];
$empresa=$proyectos['empresa'];
$area=$proyectos['area'];
$coordinador=$proyectos['coordinador'];
$inicio=$proyectos['finicio'];
$fin=$proyectos['fcierre'];
$anio=$proyectos['year'];

echo '<tr >';
echo '<td width="130px" height="20px" align="center" >'; echo $correlativo; echo'</td>';
echo '<td width="372px" height="20px" style="line-height:normal;" >'; echo $nombre; echo'</td>';
echo '<td width="100px" height="20px" align="center" >'; echo $empresa; echo'</td>';
echo '<td width="60px" height="20px" align="center" >'; echo $area; echo'</td>';
echo '<td width="111px" height="20px" align="center" >'; echo $coordinador; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $inicio; echo'</td>';
echo '<td width="92px" height="20px" align="center" >'; echo $fin; echo'</td>';
echo '<td width="65px" height="20px" align="center" >'; echo $anio; echo'</td>';
echo '</tr>';
}
?>
</table>
</div>
<div id="conteencabezado" style="margin-top:30px;"></div>
</div>

</body>

</html>

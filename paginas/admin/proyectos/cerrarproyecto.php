
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" type="text/javascript" src="../../../js/formularios.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/seguridad.js"></script>
<link href="../../../estilo/estiloformularios.css" rel="stylesheet" type="text/css" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Cerrar Proyecto</title>

</head>

<!--codigo de ajax para seleccionar el proyecto--------------------------------------------->

<script type="text/javascript" src="../../../js/ajax.js">
</script>

<script type="text/javascript">

objetoAjax.prototype.micompletar3=micompletar3;
objetoAjax.prototype.micompletar4=micompletar4;

function micompletar3(forma)
{// 2)realiza la primera llamada al query dependiendo q se selecciono
var vproyecto=forma.opciones;
// muestra el complemento de la url
this.curl="?proyecto="+vproyecto.options[vproyecto.selectedIndex].value;
//alert('COMPLEMENTO DE URL: \n\r'+this.curl);
this.ejecutar();//ejecuta la llamada
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


function micompletar4(forma)
{
var varea=forma.areasnuevas;
var vempresa=forma.empresasnuevas;
this.curl="?empresa="+vempresa.options[vempresa.selectedIndex].value+"&area="+varea.options[varea.selectedIndex].value;
//alert('COMPLEMENTO DE URL: \n\r'+this.curl);
this.ejecutar();
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



var mitablajax3=new objetoAjax('GET','cerrar_ajax.php',muestraResultado3);
var mitablajax4=new objetoAjax('GET','select_cerrar.php',muestraResultado4);

window.onload=function () {mitablajax3.micompletar3(window.document.forms["criterios"]);}
window.onload=function () {mitablajax4.micompletar4(window.document.forms["criterios"]);}
</script>

<!--FIN DEL CODIGO DE AJAX--------------------------------------------------------------------->


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


<div id="contenedorotros" style="height:auto;overflow:hidden;">
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
<li><a href="cerrarproyecto.php" style="color:orange;">Cerrar Proyecto</a></li>
<li><a href="reporteproyectocurso.php">Reporte Proyectos en Curso</a></li>
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

<div id="contenedorform" style="left: 0px; top: 0px; height: auto">
<form name="sesiones" action="cerrar_procesar.php" method="post" onsubmit="return validarproyectocerrar(this)" >
<div id="encabezado" >
<p>Cerrar Proyecto</p>
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


<!--
<div id="cajas" >
<div id="selecttex">
<select name="opciones" size="1" onchange="mitablajax3.micompletar3(this.form);">
<?php
$sqlcorre="select * from proyectos where freal='0000-00-00'";
$result2 = mysql_query($sqlcorre,$conexion);
?>
<option value="">Lista de proyectos</option>
<?php
while ( $correlativos1=mysql_fetch_array($result2) )
{
$correlativos2=$correlativos1['correlativo'];
$namerr=$correlativos1['nombre'];
if($correlativos2 != "NO_ES_PROYECTO")
{
echo "<option value=".$correlativos2.">".$correlativos2." - ".$namerr."</option>";
}
}
?>
</select>
</div>
<div id="textos">
<p><b>Seleccionar proyecto :</b></p>
</div>
</div>
-->

<!------------------------------------------------------------------------------------------------------------------------>


<!--DESPLEGAR AJAX--------------------------->
<div id="bloque">

<div id="contenedorform" style="box-shadow:none;height:auto;overflow:hidden;">

<div id="encabezado" style="border-radius:0px;">
<p>---------------- Datos del proyecto a cerrar ----------------</p>
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
<input type="text"  disabled="disabled" name="nombre" value="" />
</div>
<div id="textos">
<p>Nombre proyecto :</p>
</div>
</div>

<div id="cajas" style="height: 50px">
<div id="inputtex" style="height: 48px">
<textarea name="descripcion" disabled="disabled" style="width: 188px; height: 47px" ></textarea>
</div>
<div id="textos">
<p>Descripci&oacute;n del proyecto :</p>
</div>
</div>


<div id="cajas" >
<div id="selecttex">
<select name="coordinador" size="1" disabled="disabled" >
</select>
</div>
<div id="textos">
<p><b>Coordinador proyecto :</b></p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text"  name="inicio" disabled="disabled" value="" />
</div>
<div id="textos">
<p>Fecha de inicio :</p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text"  name="fin" disabled="disabled" value=""  />
</div>
<div id="textos">
<p>Fecha de fin :</p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text"  name="cierre" disabled="disabled" value=""  />
</div>
<div id="textos">
<p>Fecha real de cierre :</p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text"  name="anio" disabled="disabled" value="" />
</div>
<div id="textos">
<p>A&ntilde;o de apertura  :</p>
</div>
</div>

<div id="cajasbotom">
<div id="inputbotom">
<input type="submit" disabled="disabled" value="Cerrar proyecto"/>
</div>
</div>

</div>

</div>
<!------------------------------------------->

</div>
</form>
</div>

<div id="conteencabezado" style="margin-top:35px;margin-bottom:0px;"></div>

</div>

</body>

</html>


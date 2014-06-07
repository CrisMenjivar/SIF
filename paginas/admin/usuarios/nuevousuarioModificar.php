<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" type="text/javascript" src="../../../js/formularios.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/seguridad.js"></script>
<link href="../../../estilo/estiloformularios.css" rel="stylesheet" type="text/css" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Modificar Usuarios</title>

<script type="text/javascript" src="../../../js/ajax.js"></script>

<script type="text/javascript">
objetoAjax.prototype.micompletar=micompletar;
objetoAjax.prototype.micompletar2=micompletar2;
objetoAjax.prototype.micompletar3=micompletar3;


function micompletar(forma)
{// 2)realiza la primera llamada al query dependiendo q se selecciono
var vusuario=forma.opcion;
// muestra el complemento de la url
this.curl="?usuario="+vusuario.options[vusuario.selectedIndex].value;
//alert('COMPLEMENTO DE URL: \n\r'+this.curl);
this.ejecutar();//ejecuta la llamada
}

function micompletar2(forma)
{// 2)realiza la primera llamada al query dependiendo q se selecciono
var varea=forma.opcion_usuarios;
// muestra el complemento de la url
this.curl="?area="+varea.options[varea.selectedIndex].value;
//alert('COMPLEMENTO DE URL: \n\r'+this.curl);
this.ejecutar();//ejecuta la llamada
}

function micompletar3(forma)
{// 2)realiza la primera llamada al query dependiendo q se selecciono
var varea=forma.area;
// muestra el complemento de la url
this.curl="?area="+varea.options[varea.selectedIndex].value;
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
divTabla=window.document.getElementById('desplegar'); //3)muestra el resultado en este id
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
divTabla=window.document.getElementById('usuarios'); //3)muestra el resultado en este id
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
divTabla=window.document.getElementById('subareasajax'); //3)muestra el resultado en este id
divTabla.innerHTML=texto;
}
}
}


var mitablajax=new objetoAjax('GET','modajax.php',muestraResultado);
window.onload=function () {mitablajax.micompletar(window.document.forms["criterios"]);}

var mitablajax2=new objetoAjax('GET','us_ajax.php',muestraResultado2);
window.onload=function () {mitablajax2.micompletar2(window.document.forms["criterios"]);}

var mitablajax3=new objetoAjax('GET','nuevousuario_subareas_ajax.php',muestraResultado3);
window.onload=function () {mitablajax3.micompletar3(window.document.forms["criterios"]);}



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


<div id="contenedorotros" style="left: 0px; top: 0px">
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

<li><a href="#" style="color:orange;">Usuarios</a>
<ul>
<li><a href="nuevousuario.php" >Agregar Nuevo Usuario</a></li>
<li><a href="nuevousuarioModificar.php" style="color:orange;">Modificar Usuario</a></li>
<li><a href="eliminarusuario.php">Eliminar Usuario</a></li>
<li><a href="reporteusuario.php">Reporte de Usuarios</a></li>

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

<div id="contenedorform">
<form name="sesiones" action="procesar_modificar.php" method="post" onsubmit="return validarusuario(this)" >
<div id="encabezado">
<p>Modificar datos de usuario</p>
</div>

<div id="cajas" >
<div id="selecttex">
<select name="opcion_usuarios" size="1" onchange="mitablajax2.micompletar2(this.form);" >
<?php
$sqlcorre12="select * from area where estado='a'";
$result21 = mysql_query($sqlcorre12,$conexion);
?>
<option value="">Lista de &aacute;reas</option>
<?php
while ( $correlativos11=mysql_fetch_array($result21) )
{
$correlativos21=$correlativos11['codigo'];
$namess=$correlativos11['nombre'];
echo "<option value=".$correlativos21.">".$correlativos21." - ".$namess."</option>";
}
?>
</select>
</div>
<div id="textos">
<p><b>Seleccione &aacute;rea :</b></p>
</div>
</div>



<div id="cajas" >
<div id="selecttex">
<!--inicio ajax usuarios -->
<div id="usuarios">

<select name="opcion" size="1" onchange="mitablajax.micompletar(this.form);" >
<!--
<?php
$sqlcorre="select * from usuarios where estado='a'";
$result2 = mysql_query($sqlcorre,$conexion);
?>
<option value="">Lista de usuarios</option>
<?php
while ( $correlativos1=mysql_fetch_array($result2) )
{
$correlativos2=$correlativos1['user'];
echo "<option value=".$correlativos2.">".$correlativos2."</option>";
}
?>
-->
</select>

</div>
<!-- fin ajax usuarios -->

</div>
<div id="textos">
<p><b>Seleccione un usuario :</b></p>
</div>
</div>

<!-- mostramos los datos con ajax-------------------------------------->
<div id="desplegar">

<div id="contenedorform">
<div id="encabezado" style="border-radius:0px;">
<p>-------------------------------------------------------------------------------</p>
</div>

<div id="cajas" >
<div id="c1">
<div id="inputtex2" >
<input disabled="disabled" type="text"  name="login" value="" />
</div>
<div id="c2"><p>@siman.com</p></div>
</div>

<div id="textos" style="width: 28%">
<p style="width: 158px">Login de usuario<b> :</b></p>
</div>
</div>

<div id="cajas2"    >
<div id="radiotex1">
<div id="radiotex2">
<input type="radio" disabled="disabled"  name="acceso" value="1"  />
</div>
<div id="textradio"><p>Administrador</p></div>
</div>
<div id="textos">
<p>Nivel de acceso :</p>
</div>
</div>

<div id="cajas2"    >
<div id="radiotex1">
<div id="radiotex2">
<input type="radio" disabled="disabled"  name="acceso" value="2"  />
</div>
<div id="textradio"><p>Usuario</p></div>
</div>
<div id="textos">
<p><b></b></p>
</div>
</div>

<div id="cajas2"    >
<div id="radiotex1">
<div id="radiotex2">
<input type="radio"  name="acceso" value="3" disabled="disabled"  />
</div>
<div id="textradio"><p>Jefe de &aacute;rea</p></div>
</div>
<div id="textos">
<p><b></b></p>
</div>
</div>

<div id="cajas2"    >
<div id="radiotex1">
<div id="radiotex2">
<input type="radio"  name="acceso" value="4" disabled="disabled"/>
</div>
<div id="textradio"><p>Jefe de &aacute;rea-Admin</p></div>
</div>
<div id="textos">
<p><b></b></p>
</div>
</div>



<div id="cajas" >
<div id="inputtex">
<input type="text"  name="pass" value="" disabled="disabled" />

</div>
<div id="textos">
<p><b> Contrase&ntilde;a :</b></p>
</div>
</div>

<div id="cajas" >
<div id="inputtex">
<input type="text"  name="confirmar" value="" disabled="disabled" />

</div>
<div id="textos">
<p><b> Confirmar contrase&ntilde;a :</b></p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text"  name="nombre" value="" disabled="disabled" />
</div>
<div id="textos">
<p>Nombre<b> :</b></p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text"  name="apellido" value="" disabled="disabled" />
</div>
<div id="textos">
<p>Apellido :</p>
</div>
</div>


<div id="cajas" >
<div id="selecttex">
<select name="area" disabled="disabled" size="1">
<?php
$sql2="select * from area where estado='a' ";
$result2 = mysql_query($sql2,$conexion);
?>
<!-- <option value="<?php echo $datos['area']; ?>"><?php echo $datos['area']; ?></option> -->
<?php
while ( $areass=mysql_fetch_array($result2) )
{
$ari=$areass['codigo'];
echo "<option value=".$ari.">".$ari."</option>";

}
?>
</select>
</div>
<div id="textos">
<p><b> &Aacute;rea :</b></p>
</div>
</div>

<div id="cajas" >
<div id="selecttex">
<select name="subarea" disabled="disabled" size="1">
<?php
$sql2="select * from subarea where estado='a'";
$result2 = mysql_query($sql2,$conexion);
?>
<!-- <option value="<?php echo $datos['subarea']; ?>"><?php echo $datos['subarea']; ?></option> -->
<?php
while ( $areass=mysql_fetch_array($result2) )
{
$ari=$areass['codigo'];
echo '<option selected="selected" value="'.$ari.'">'.$ari."</option>";
echo "<option value=".$ari.">".$ari."</option>";

}
?>
</select>
</div>
<div id="textos">
<p><b> Sub-&aacute;rea :</b></p>
</div>
</div>

<div id="cajas" >
<div id="selecttex">
<select disabled="disabled" name="ccosto" size="1">
<?php
$sql2="select * from ccosto where estado='a'";
$result2 = mysql_query($sql2,$conexion);
?>
<!-- <option value="<?php echo $datos['ccosto']; ?>"><?php echo $datos['ccosto']; ?></option> -->
<?php
while ( $areass=mysql_fetch_array($result2) )
{
$ari=$areass['nombre'];
$mos=$ari;
$mos=strtr($mos,'_',' ');
$mos=strtolower($mos);
$mos=ucwords($mos);

echo "<option value=".$ari.">".$mos."</option>";

}
?>
</select>
</div>
<div id="textos">
<p><b> Centro de costo :</b></p>
</div>
</div>

<div id="cajas" >
<div id="inputtex">
<input type="text"  name="cargo" value="" disabled="disabled" />

</div>
<div id="textos">
<p>Cargo<b> :</b></p>
</div>
</div>

<div id="cajas" >
<div id="selecttex">
<select name="contrato" disabled="disabled" size="1" style="width: 184px">
<!-- <option value="<?php echo $datos['contrato']; ?>"><?php echo $datos['contrato']; ?></option> -->
<option selected="selected" value="Planilla">Planilla</option>
<option value="Outsourcing">Outsourcing</option>
</select>
</div>
<div id="textos">
<p><b> Contrato :</b></p>
</div>
</div>

<input type="hidden" name="empresa" value="" disabled="disabled" />

<div id="cajas" >
<div id="inputtex">
<input type="text" disabled="disabled"  name="proveedor" value="" />
</div>
<div id="textos">
<p><b> Proveedor :</b></p>
</div>
</div>


<div id="cajasbotom">
<div id="inputbotom">
<input type="submit" disabled="disabled" value="Modificar Usuario"/>
</div>
</div>
</div>

</div>
<!--FIN DE AJAX ------------------------------------------------------------------>
</form>

</div>

<div id="conteencabezado" style="margin-top:20px;"></div>
</div>

</body>

</html>

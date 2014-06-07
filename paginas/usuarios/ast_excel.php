<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" type="text/javascript" src="../../js/astnuevos.js"></script>

<script language="javascript" type="text/javascript" src="../../js/seguridad.js"></script>

<link href="../../estilo/estiloast.css" rel="stylesheet" type="text/css" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>An&aacute;lisis Semanal de Tiempo -- AST</title>

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

<!-- definimos que la pagina no se pueda cargar dentro del frame -->

<script type="text/javascript">
if (top != self) top.location.href = location.href;
</script>

<!-- ------------------------------------------------------------------------ -->
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

if($move['admin']=="3")
{
header ("Location: ../jefes/ast.php");
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

if( $pendientes == 0 )
{
header ("Location: ast.php");
}


//-----------------------------------------------------

$cuestion = "select * from excel where usuario='".$_SESSION['user']."' ";
$resC = mysql_query($cuestion,$conexion);
$resC2=mysql_fetch_array($resC);
$fecha = $resC2['fecha'];
$descripcion = $resC2['descripcion'];
$inicio = $resC2['inicio'];
$fin = $resC2['fin'];

?>

<div id="contenedor" >

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

<li><a href="#" style="color:orange;">Registro</a>
<ul>
<li><a href="ast.php" >Manual</a></li>
<li><a href="cargar_archivo.php" >Desde archivo</a></li>

<?php
if( $pendientes != 0 )
{
echo '<li><a href="ast_excel.php" style="color:orange;">Pendientes('; echo $pendientes; echo ')</a></li>';
}
?>

</ul>
</li>


<li><a href="corregirast.php"><?php if( $num != 0 ){ echo '<div id="resaltado" style="color:yellow;">AST Denegados</div>'; }else{ echo 'AST Denegados';}?></a></li>
<li><a href="2_revisarast.php">Modificar AST</a></li>

<li><a href="#">Reporte</a>
<ul>
<li><a href="reportes/grafico/colaborador_reporte.php" >Colaborador</a></li>
<li><a href="reportes/proyectos/reporte_proyectos_en_curso.php">Proyectos en curso</a></li>
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

<table width="1000px" border="0" cellpadding="1" cellspacing="1" style="border-color:#000099;background-color:#3b5998;color:white;font-size:11px;">
<tr>
<td width="30px"  height="17px" align="center"> -- </td>
<td width="30px"  height="17px" align="center"> -- </td>
<td width="86px"  height="17px" align="center"> FECHA</td>
<td width="392px" height="17px" align="center"> DESCRIPCI&Oacute;N</td>

<td width="105px" height="17px" align="center">TIPO ACTIVIDAD</td>
<td width="93px" height="17px" align="center"> EMPRESA</td>
<td width="134px" height="17px" align="center"> PROYECTO</td>

<td width="78px"  height="17px" align="center"> INICIO</td>
<td width="78px"  height="17px" align="center"> FIN</td>
</tr>
</table>


<!--frame------------------------------------------------------------------------------------------------->
<div id="conteframe" style="margin:0px 0px 0px 0px; height: 304px;">
<iframe frameborder="0" scrolling="yes" src="mostrardatos_excel.php" style="margin:0px 0px 0px 0px;height:303px;overflow-x:hidden;overflow-y:visibled;" target="_parent" >
</iframe>
</div>
<!--frame------------------------------------------------------------------------------------------------->

<div id="insertardatos">
<div id="areadatos" style="height:22px;"><p style="height:22px;">&nbsp;&nbsp;&Aacute;rea para el registro de datos</p></div>
<div id="descripcion" style="margin:4px 0px 0px 0px; height: 27px;">
<div id="fecha"><p>Fecha</p></div>
<div id="descri" style="width: 375px"><p>Descripci&oacute;n</p></div>
<div id="tipoact"><p>Actividad</p></div>
<div id="empresa"><p>Empresa</p></div>
<div id="proyecto"><p>Proyecto</p></div>
<div id="inicio"><p>Inicio</p></div>
<div id="fin"><p>Fin</p></div>
<!--<div id="horas"><p>Horas</p></div> -->
</div>

</div>
<div id="insertar">

<form name="insertardatos" action="insertardatos_excel.php" method="post" onsubmit="return validar2(this)">

<input type="hidden" name="fecha21" value="<?php echo $_SESSION['fecha']; ?>"/>
<input type="hidden" name="descripcion21" value="<?php echo $_SESSION['descripcion']; ?>"/>
<input type="hidden" name="inicio21" value="<?php echo $_SESSION['inicio']; ?>"/>
<input type="hidden" name="fin21" value="<?php echo $_SESSION['fin']; ?>"/>

<div id="fechatex">
<input type="text" name="fecha" id="campo_fecha" <?php if($_SESSION['fecha']==""){echo 'disabled="disabled"';} ?>  value="<?php echo $_SESSION['fecha']; ?>" onkeypress="return acceptNumhorasNada(event)"/>
</div>

<div id="calendario">
<input type="image" src="../../imagenes/calendar.png" id="lanzador" alt="Calendario" <?php if($_SESSION['fecha']==""){echo 'disabled="disabled"';} ?> />
</div>
<div id="descritex" style="width: 340px">
<input type="text" name="descripcion" maxlength="58" value="<?php echo $_SESSION['descripcion']; ?>" style="width: 334px" <?php if($_SESSION['fecha']==""){echo 'disabled="disabled"';} ?> />
</div>

<div id="tipoacttex">
<select name="actividades" size="1" <?php if($_SESSION['fecha']==""){echo 'disabled="disabled"';} ?> >
<?php
$sql2="select * from actividad where estado='a'";
$result2 = mysql_query($sql2,$conexion);
?>
<option value="">----------------------</option>
<?php
while ( $actividad=mysql_fetch_array($result2) )
{
echo "<option value=".$actividad['tipoact'].">".strtr($actividad['nombre'],'_',' ')."</option>";
}
?>

</select>
</div>

<div id="empresatex">
<select name="empresas" size="1" onchange="mitablajax2.micompletar2(this.form);" <?php if($_SESSION['fecha']==""){echo 'disabled="disabled"';} ?> >
<?php
$sql3="select * from empresas where estado='a'";
$result3 = mysql_query($sql3,$conexion);
?>
<option value="">----------------------</option>
<?php
while ( $empresa=mysql_fetch_array($result3) )
{
$empre=$empresa['nombre'];
echo "<option value=".$empre.">".$empre."</option>";
}
?>
</select>
</div>

<div id="proyectotex">
<select name="pro" size="1" onchange="mitablajax2.micompletar2(this.form);" <?php if($_SESSION['fecha']==""){echo 'disabled="disabled"';} ?> >
<option value="99">NO ES PROYECTO</option>
<option value="PROYECTOS">PROYECTOS</option>
</select>
</div>

<div id="iniciotex">
<input type="text" name="inicios" value="<?php echo $_SESSION['inicio']; ?>" maxlength="5" onclick="formato(this.form)" onkeypress="return acceptNumhoras(event)" <?php if($_SESSION['inicio']==""){echo 'disabled="disabled"';} ?> />
</div>

<div id="fintex">
<input type="text" name="finales" value="<?php echo $_SESSION['fin']; ?>" maxlength="5" onclick="formato(this.form)" onkeypress="return acceptNumhoras(event)" onblur="enviarhoras()" <?php if($_SESSION['fin']==""){echo 'disabled="disabled"';} ?>/>
</div>

<input type="hidden" name="horas" value="" />

<div id="botonfinal" style="height: 18px;">
<!--<div id="format"><p>A&ntilde;o-Mes-D&iacute;as</p></div> -->
<div id="format" style="height: 17px"> <!-- <input type="button" id="lanzador" value="Calendario" /> --> </div>
<div id="proyectmsj" style="height: 17px"></div>
<div id="botonfinal1" style="height: 16px"><p style="height: 17px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Formato 24 horas</p></div>
</div>

<div id="botonfinal">
<!--<div id="format"><p>A&ntilde;o-Mes-D&iacute;as</p></div> -->


<div id="format"> <!-- <input type="button" id="lanzador" value="Calendario" /> --> 
<input type="submit" value="Eliminar actividad" name="boton" onclick="btn_eliminar(this.form)" style="width: 131px; height: 26px;margin-left:15px;margin-top:2px;font-size:15px" <?php if($_SESSION['fecha']==""){echo 'disabled="disabled"';} ?>/>
</div>


<div id="proyectmsj"></div>
<div id="botonfinal1"><input type="submit" value="Guardar actividad" name="boton" onfocus="formato(this.form)" onclick="totalhoras()" style="width: 131px; height: 26px;margin-left:15px;" <?php if($_SESSION['fecha']==""){echo 'disabled="disabled"';} ?> /></div>
</div>
</form>
</div>

</div>

<!-- script que define y configura el calendario-->
<script type="text/javascript">
Calendar.setup({
inputField     :    "campo_fecha",     // id del campo de texto
ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto
button     :    "lanzador"     // el id del botón que lanzará el calendario
});
</script>

</body>

</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" type="text/javascript" src="../../js/horas/jquery-1.7.1.min.js"></script>
<script language="javascript" type="text/javascript" src="../../js/formularios.js"></script>
<script language="javascript" type="text/javascript" src="../../js/seguridad.js"></script>
<script language="javascript" type="text/javascript" src="../../js/astnuevos.js"></script>
<script language="javascript" type="text/javascript" src="../../js/horas/jquery-ui-1.10.4.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="../../js/horas/datepicker-es.js"></script>
<link href="../../estilo/estiloformularios.css" rel="stylesheet" type="text/css" />
<link href="../../estilo/estiloast.css" rel="stylesheet" type="text/css" />
<link href="../../estilo/flick/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Modificar AST</title>

<script type="text/javascript" src="../../js/ajax.js">
</script>

<script type="text/javascript">
objetoAjax.prototype.micompletar2=micompletar2;
objetoAjax.prototype.micompletar3=micompletar3;

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

function micompletar3(forma)
{

if (forma.cambio.checked == true )
{
var vopcion="movil";
}
else
{
var vopcion="pc";
}
 
this.curl="?opcion="+vopcion;
//alert('COMPLEMENTO DE URL: \n\r'+this.curl);
this.ejecutar();
}


function muestraResultado3()
{
if(this.readyState == 4)
{
if(this.status == 200)
{
var texto=this.responseText;
divTabla=window.document.getElementById('dispositivos');
divTabla.innerHTML=texto;
}
}
}


var mitablajax2=new objetoAjax('GET','proyectos_ajax.php',muestraResultado2);
window.onload=function () {mitablajax2.micompletar2(window.document.forms["criterios"]);}

var mitablajax3=new objetoAjax('GET','dispositivos.php',muestraResultado3);
window.onload=function () {mitablajax3.micompletar3(window.document.forms["criterios"]);}

</script>


<style type="text/css">
.auto-style1 {
color: orange;
}
.auto-style2 {
color: #0033CC;
}
</style>

</head>

<body>

<?php

$total1="";

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


$usuario1=$_SESSION['user'];


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

<div id="contenedorotros">
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
<p class="logueado">Bienvenido : <?php echo $_SESSION['user']; ?></p>
<p>An&aacute;lisis Semanal de Tiempo -- AST</p>
</div>

</div>


<!--INICIO DE LA BARRA DE MENU-->
<div id="conteencabezado" >
<div id="cerrar">
<ul>
<li><a href="../instrucciones.php" target="_blank" >Guia para registro</a></li>

<!--
<li><a href="ast.php" >Registro AST</a></li>
-->

<li><a href="#" >Registro</a>
<ul>
<li><a href="ast.php" >Manual</a></li>
<li><a href="cargar_archivo.php" >Desde archivo</a></li>

<?php
if( $pendientes != 0 )
{
echo '<li><a href="ast_excel.php">Pendientes('; echo $pendientes; echo ')</a></li>';
}
?>

</ul>
</li>



<li><a href="corregirast.php"><?php if( $num != 0 ){ echo '<div id="resaltado" style="color:yellow;">AST Denegados</div>'; }else{ echo 'AST Denegados';}?></a></li>
<li><a href="2_revisarast.php" style="color:orange;">Modificar AST</a></li>

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

<div id="salida" ><p style="margin-left:10px;">Seleccione la actividad a modificar :</p></div>

<table width="1000px" border="0" cellpadding="1" cellspacing="1" style="border-color:#000099;background-color:#3b5998;color:white;font-size:11px;">
<tr>
<td width="30px"  height="17px" align="center"> -- </td>
<td width="86px"  height="17px" align="center"> FECHA</td>
<td width="392px" height="17px" align="center"> DESCRIPCI&Oacute;N</td>
<td width="115px" height="17px" align="center">TIPO ACTIVIDAD</td>
<td width="103px" height="17px" align="center"> EMPRESA</td>
<td width="144px" height="17px" align="center"> PROYECTO</td>
<td width="78px"  height="17px" align="center"> INICIO</td>
<td width="78px"  height="17px" align="center"> FIN</td>
</tr>
</table>

<!--frame------------------------------------------------------------------------------------------------->
<div id="conteframe" style="margin:0px 0px 0px 0px; height:265px;">
<iframe frameborder="0" scrolling="yes" src="modificarast_mostrardatos.php" style="margin:0px 0px 0px 0px;height:264px;overflow-x:hidden;overflow-y:visibled;" target="_parent" >
</iframe>
</div>
<!--frame------------------------------------------------------------------------------------------------->


<?php

$fecha1 = $_SESSION['m_fecha'];
$descripcion1 = $_SESSION['m_descripcion'];
$actividad1 = $_SESSION['m_actividad'];
$empresa1 = $_SESSION['m_empresa'];
$proyecto1 = $_SESSION['m_proyecto'];
$inicio1 = $_SESSION['m_inicio'];
$fin1 = $_SESSION['m_fin'];
$total1 = $_SESSION['m_total'];



?>


<div id="error" > <!-- Inicio de la division error -->

<div id="insertardatos" style="margin-top:0px;">
<div id="areadatos" style="height:22px;"><p style="height:22px;">&nbsp;&nbsp;&Aacute;rea para el registro de datos</p></div>
<div id="descripcion" style="margin-top:4px;margin-left:0px;">
<div id="fecha"><p>Fecha</p></div>
<div id="descri" style="width: 380px"><p>Descripci&oacute;n</p></div>
<div id="tipoact"><p>Actividad</p></div>
<div id="empresa"><p>Empresa</p></div>
<div id="proyecto"><p>Proyecto</p></div>
<div id="inicio"><p>Inicio</p></div>
<div id="fin"><p>Fin</p></div>

</div>

</div>

<div id="insertar" style="height: 86px">
<form name="insertardatos" action="insertarastmodificado.php" target="_parent" method="post" onsubmit="return validar2(this)">

<input type="hidden" name="usuario1" value="<?php echo $usuario1; ?>" />
<input type="hidden" name="fecha1" value="<?php echo $fecha1; ?>" />
<input type="hidden" name="descripcion1" value="<?php echo $descripcion1; ?>" />
<input type="hidden" name="actividad1" value="<?php echo $actividad1; ?>" />
<input type="hidden" name="empresa1" value="<?php echo $empresa1; ?>" />
<input type="hidden" name="proyecto1" value="<?php echo $proyecto1; ?>" />
<input type="hidden" name="inicio1" value="<?php echo $inicio1; ?>" />
<input type="hidden" name="fin1" value="<?php echo $fin1; ?>" />
<input type="hidden" name="total1" value="<?php echo $total1; ?>" />

<div id="fechatex">
<input type="text" name="fecha" id="campo_fecha" value="<?php echo $fecha1; ?>" <?php if($fecha1==""){echo 'disabled="disabled"';} ?> maxlength="10" onkeypress="return acceptNumhorasNada(event)"/>
</div>

<div id="descritex" style="width: 341px" >
<input type="text" name="descripcion" maxlength="58" value="<?php echo $descripcion1; ?>" style="width: 338px" <?php if($fecha1==""){echo 'disabled="disabled"';} ?> />
</div>

<div id="tipoacttex">
<select name="actividades" size="1" <?php if($fecha1==""){echo 'disabled="disabled"';} ?> >
<?php
$sql2="select * from actividad where estado='a'";
$result2 = mysql_query($sql2,$conexion);

while ( $actividad=mysql_fetch_array($result2) )
{
$activi=$actividad['tipoact'];

if( $actividad1 == $activi )
{
echo '<option selected="selected" value="'.$activi.'">'.strtr($actividad['nombre'],'_',' ')."</option>";
}
else
{
echo "<option value=".$activi.">".strtr($actividad['nombre'],'_',' ')."</option>";
}
}
?>
</select>
</div>

<div id="empresatex">
<select name="empresas" size="1" onchange="mitablajax2.micompletar2(this.form);" <?php if($fecha1==""){echo 'disabled="disabled"';} ?> >
<?php
$sql3="select * from empresas where estado='a'";
$result3 = mysql_query($sql3,$conexion);
?>
<!--<option value="<?php echo $empre; ?>"><?php echo $empre; ?></option> -->
<?php
while ( $empresa=mysql_fetch_array($result3) )
{
$empres=$empresa['nombre'];

if($empresa1==$empres)
{
echo '<option selected="selected" value='.$empres.'>'.$empres.'</option>';
}
else
{
echo "<option value=".$empres.">".$empres."</option>";
}

}
?>
</select>

</div>

<div id="proyectotex">
<select name="pro" size="1" onchange="mitablajax2.micompletar2(this.form);" <?php if($fecha1==""){echo 'disabled="disabled"';} ?> >
<?php
if($proyecto1=="99")
{
echo '<option value="99" selected="selected" >NO ES PROYECTO</option>';
echo '<option value="PROYECTOS" >PROYECTOS</option>';
}
else
{
echo '<option value="99" >NO ES PROYECTO</option>';
echo '<option value="PROYECTOS" selected="selected" >PROYECTOS</option>';
}
?>
</select>

</div>

<div id="iniciotex">
<input type="text" name="inicios" value="<?php echo $inicio1; ?>" onclick="formato(this.form)" <?php if($fecha1==""){echo 'disabled="disabled"';} ?> maxlength="5" onfocus="limpiar()" onkeypress="return acceptNumhoras(event)" onblur="validar(this)"/>
</div>

<div id="fintex">
<input type="text" name="finales" value="<?php echo $fin1; ?>" onclick="formato(this.form)" <?php if($fecha1==""){echo 'disabled="disabled"';} ?> maxlength="5" onfocus="limpiar()" onkeypress="return acceptNumhoras(event)" onblur="enviarhoras()"/>
</div>

<input type="hidden" name="horas" value="<?php echo $total1; ?>" maxlength="5" />


<!-- ----------------------------------------------------------------->
<div id="botonfinal" style="height: 17px">
<div id="format" style="height: 17px"></div>
<?php
// echo " <input type='submit' value='Guardar actividad' style='width: 131px; height: 26px'/> ";
echo '<div id="proyectmsj" style="height: 17px">';

if($proyecto1!="99" and $proyecto1!="")
{
echo '<select name="proyectos" size="1">';

$sql4="select * from proyectos where estado='a' and empresa='$empresa1' and correlativo!='99'";
$result4 = mysql_query($sql4,$conexion);

while ( $proyecto=mysql_fetch_array($result4) )
{
$proyectos=$proyecto['correlativo'];
$nompro=$proyecto['nombre'];
$nompro=strtr($nompro,'_',' ');
$nompro=strtolower($nompro);
$nompro=ucfirst($nompro);
if( $proyecto1 == $proyectos )
{
echo '<option selected="selected" value="'.$proyectos.'">'.$nompro."</option>";
}
else
{
echo '<option value="'.$proyectos.'">'.$nompro."</option>";

}
} //fin while

echo '</select>';
}
else
{
echo '<input type="hidden" name="proyectos" value="99">';
}
echo '</div>';
echo '<div id="botonfinal1" style="height: 16px"><p style="height: 17px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Formato 24 horas</p></div>';

?>

<div id="botonfinal">
<!--<div id="format"><p>A&ntilde;o-Mes-D&iacute;as</p></div> -->
<div id="format"> <!-- <input type="button" id="lanzador" value="Calendario" /> --> </div>
<div id="proyectmsj"></div>
<div id="botonfinal1" style="height: 25px"><input type="submit" value="Guardar actividad" onclick="totalhoras()" <?php if($fecha1==""){echo 'disabled="disabled"';} ?> style="width: 131px; height: 26px;margin-left:15px;"/></div>
</div>


</div>
</form>
</div>


</div><!-- fin de la division error -->

</div>

<!-- script que define y configura el calendario-->
<script type="text/javascript">
$(function() {
	$( "#campo_fecha" ).datepicker({
	  defaultDate: "+1w",
	  changeMonth: true,
	  numberOfMonths: 1,
	  dateFormat: 'yy-mm-dd',
	});
  });
</script>


</body>

</html>

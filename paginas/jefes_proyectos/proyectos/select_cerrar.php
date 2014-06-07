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


//recibimos el nombre de la empresa a utilizar para guardar el proyecto
$empresa=$_GET['empresa'];
$area=$_GET['area'];


if( $empresa != "" and $area != "" )
{

?>

<div id="cajas" >
<div id="selecttex">
<select name="opciones" size="1" onchange="mitablajax3.micompletar3(this.form);">
<?php
$sqlcorre="select * from proyectos where empresa='$empresa' and area='$area' and freal='0000-00-00'";
$result2 = mysql_query($sqlcorre,$conexion);
?>
<option value="">Lista de proyectos</option>
<?php
while ( $correlativos1=mysql_fetch_array($result2) )
{
$correlativos2=$correlativos1['codigo'];
$namerr=$correlativos1['nombre'];
if($correlativos2 != "NO_ES_PROYECTO")
{
echo "<option value=".$correlativos1['correlativo'].">".$correlativos2." - ".$namerr."</option>";
}
}
?>
</select>
</div>
<div id="textos">
<p><b>Seleccionar proyecto :</b></p>
</div>
</div>


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
<input type="text" disabled="disabled"  name="nombre" value="" />
</div>
<div id="textos">
<p>Nombre proyecto :</p>
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


<?php

}
else
{
?>

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
<input type="text" disabled="disabled"  name="nombre" value="" />
</div>
<div id="textos">
<p>Nombre proyecto :</p>
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


<?php
} 

?>


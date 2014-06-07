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


//recuperamos los datos del proyecto a modificar
$nombre=$_GET['proyecto'];

if( $nombre != "" )
{
$_SESSION['mod_proyecto']=$nombre;
$_SESSION['mod_opciones']=$nombre;
?>

<iframe width="500px" height="660px" frameborder="0" scrolling="no" src="mostrar_proyecto.php" marginheight="0" marginwidth="0" target="_parent"></iframe>

<?php
}
else
{
?>
<div id="contenedorform" style="height: auto;box-shadow:none;overflow:hidden;">

<div id="encabezado" style="border-radius:0px;">
<p>---------------- Datos del proyecto a modificar ----------------</p>
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

<div id="cajas" style="height: 50px">
<div id="inputtex" style="height: 48px">
<textarea name="descripcion" disabled="disabled" style="width: 207px; height: 48px" ></textarea>
</div>
<div id="textos">
<p>Descripci&oacute;n del proyecto :</p>
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



<?php
}

?>



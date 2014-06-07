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


//recuperamos los datos de la empresa a modificar
$nombre=$_GET['empresa'];

if($nombre!="")
{

$sqldepartamento="select * from empresas where nombre='$nombre'";
$result2 = mysql_query($sqldepartamento,$conexion);
$datos=mysql_fetch_array($result2);

?>

<div id="contenedorform" style="box-shadow:none;">

<div id="encabezado" style="border-radius:0px;">
<p>-------------------------------------------------------------------------</p>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text"  name="nombre" value="<?php echo $datos['nombre']; ?>" onblur="sigla()" />
</div>
<div id="textos">
<p>Nombre<b> Empresa :</b></p>
</div>
</div>

<!--INPUT OCULTO PARA INSERTAR LAS SIGLAS PARA LOS PROYECTOS -->
<input type="hidden" name="siglas" value="" >
<!---- --------------------------- -->


<div id="cajas">
<div id="selecttex">
<select name="grupo" size="1" onchange="sigla()">
<?php
$sql2="select * from grupos";
$result2 = mysql_query($sql2,$conexion);

while ( $grupos=mysql_fetch_array($result2) )
{
$group=$grupos['grupo'];
if( $datos['cgrupo'] == $group )
{
echo '<option selected="selected" value="'.$group.'">'.strtr($group,'_',' ').'</option>';
}
else
{
echo "<option value=".$group.">".strtr($group,'_',' ')."</option>";
}

}
?>
</select>
</div>
<div id="textos">
<p>Grupo :</p>
</div>
</div>

<div id="cajasbotom">
<div id="inputbotom">
<input type="submit" value="Modificar Empresa"/>
</div>
</div>

</div>

<?php
}
else
{
?>

<div id="contenedorform" style="box-shadow:none;">

<div id="encabezado" style="border-radius:0px;">
<p>-------------------------------------------------------------------------</p>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text"  name="nombre" disabled="disabled" value="" onblur="sigla()" />
</div>
<div id="textos">
<p>Nombre<b> Empresa :</b></p>
</div>
</div>

<!--INPUT OCULTO PARA INSERTAR LAS SIGLAS PARA LOS PROYECTOS -->
<input type="hidden" disabled="disabled" name="siglas" value="" >
<!---- --------------------------- -->


<div id="cajas">
<div id="selecttex">
<select name="grupo" size="1" onchange="sigla()">
</select>
</div>
<div id="textos">
<p>Grupo :</p>
</div>
</div>

<div id="cajasbotom">
<div id="inputbotom">
<input type="submit" disabled="disabled" value="Modificar Empresa"/>
</div>
</div>

</div>

<?php
}
?>



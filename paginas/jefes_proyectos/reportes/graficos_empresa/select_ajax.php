
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

if($move['admin']=="1")
{
header ("Location: ../../../admin/menuadmin.php");
}

}//fin else


//recuperamos los datos de la empresa a modificar
$reporte=$_GET['reporte'];


if( $reporte == "4" )
{
?>
<input type="hidden" value="vacio" name="area">
<input type="hidden" value="vacio" name="proyec">

<?php
}
else
{

if( $reporte == "3" )
{

?>

<div id="cajasrevisar"  >

<div id="textosrevisar" style="width: 18%">
<p><b>Seleccione la empresa :</b></p>
</div>
<div id="selecttexrevisar">
<select name="area" size="1" onchange="mitablajax.micompletar(this.form);" >
<?php
$sqlcorre="select * from empresas where estado='a'";
$result2 = mysql_query($sqlcorre,$conexion);
?>
<option value="">Empresas</option>
<?php
while ( $correlativos1=mysql_fetch_array($result2) )
{
$correlativos2=$correlativos1['nombre'];
echo "<option value=".$correlativos2.">".$correlativos2."</option>";
}
?>
</select>
</div>

<div id="textosrevisar" style="width: 14%">
<p style="width: 133px"><b>Estado :</b></p>
</div>
<div id="selecttexrevisar">
<select name="estado" size="1" onchange="mitablajax.micompletar(this.form);" style="width: 156px">
<option value="abiertos">En curso</option>
<option value="cerrados">Finalizados</option>
</select>
</div>

<div id="desplegar"> <!--Inicio de la division de ajax desplegar -->

<div id="textosrevisar" style="width: 12%">
<p style="width: 122px"><b>Proyecto :</b></p>
</div>

<div id="selecttexrevisar">
<select name="proyec" size="1" style="width: 156px">
</select>
</div>

</div><!--fin division del ajax desplegar -->

</div>


<?php
}
else
{
?>

<div id="cajasrevisar"  >

<div id="textosrevisar" style="width: 18%">
<p><b>Seleccione la empresa :</b></p>
</div>
<div id="selecttexrevisar">
<select name="area" size="1" >
<?php
$sqlcorre="select * from empresas where estado='a'";
$result2 = mysql_query($sqlcorre,$conexion);
?>
<option value="">Empresas</option>
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

<input type="hidden" name="proyec" value="vacio" />

<?php
}
}
//-------------------------------------------------------------------------------------------------------------------
?>



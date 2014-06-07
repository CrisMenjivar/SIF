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

session_start();
$colaborador=$_SESSION['user'];

$reporte = $_GET['reporte'];

if( $reporte == 1 )
{
?>

<form name="sesiones1" target="_blank" action="colaborador_procesar.php" method="post" onsubmit="return reporte_colaborador_admin(this)" >

<div id="cajasrevisar" style="height: 4px"  >
</div>


<div id="cajasrevisar" style="height: 27px" >

<div id="textosrevisar">
<p><b>Seleccionar reporte :</b></p>
</div>
<div id="selecttexrevisar" style="width: 35%">
<select name="reporte" size="1" style="width: 344px" onchange="mitablajax2.micompletar2(this.form);">
<option value="1" selected="selected">Reporte de actividades diarias por colaborador</option>
<option value="2">Utilizaci&oacute;n del tiempo general por colaborador</option>
<option value="3">Utilizaci&oacute;n del tiempo en proyectos por colaborador</option>
<option value="4">Resumen de proyectos por colaborador</option>
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
$sqlcorre="select area from usuarios where user='$colaborador' ";
$result2 = mysql_query($sqlcorre,$conexion);
$correlativos1=mysql_fetch_array($result2);
$correlativos2=$correlativos1['area'];
echo "<option value=".$correlativos2.">".$correlativos2."</option>";

?>
</select>
</div>

<div id="otrotextos">
<p><b>Seleccionar colaborador :</b></p>
</div>
<div class="otrosele">
<select id="prueba" name="colaborador" size="1" >
<?php

$Textos = mysql_query("SELECT * FROM usuarios WHERE area='$correlativos2'",$conexion);

if ($row = mysql_fetch_array($Textos))
{
do
{
echo '<option value="';
echo $row['user'];
echo '">';
echo $row['user'];
echo '</potion>';
} while ($row = mysql_fetch_array($Textos));
}

?>

</select>
</div>
</div>


<div id="cajasrevisar"  >

<div id="textosrevisar">
<p><b>Inicio de periodo :</b></p>
</div>

<div id="selecttexrevisar">
<select name="inicio" size="1" >
<option value="1">Enero</option>
<option value="2">Febrero</option>
<option value="3">Marzo</option>
<option value="4">Abril</option>
<option value="5">Mayo</option>
<option value="6">Junio</option>
<option value="7">Julio</option>
<option value="8">Agosto</option>
<option value="9">Septiembre</option>
<option value="10">Octubre</option>
<option value="11">Noviembre</option>
<option value="12">Diciembre</option>
</select>
</div>



<div id="otrotextos" style="width: 17%">
<p><b>Fin de periodo :</b></p>
</div>
<div class="otrosele" style="width: 17%">
<select name="fin" size="1" >
<option value="1">Enero</option>
<option value="2">Febrero</option>
<option value="3">Marzo</option>
<option value="4">Abril</option>
<option value="5">Mayo</option>
<option value="6">Junio</option>
<option value="7">Julio</option>
<option value="8">Agosto</option>
<option value="9">Septiembre</option>
<option value="10">Octubre</option>
<option value="11">Noviembre</option>
<option value="12">Diciembre</option>
</select>
</div>

<div id="otrotextos" style="width: 10%">
<p><b>A&ntilde;o :</b></p>
</div>
<div class="otrosele" style="width: 17%">
<select name="year" size="1" >
<option value="2013">2013</option>
<option value="2014">2014</option>
<option value="2015">2015</option>
<option value="2016">2016</option>
<option value="2017">2017</option>
<option value="2018">2018</option>
<option value="2019">2019</option>
<option value="2020">2020</option>
</select>
</div>


</div>
<div id="cajasrevisar">
<div id="butomm">
<input type="submit" value="Generar reporte" />
</div>

</div>
</form>

<?php
}

//--------------------------------------------------------------------------------------------------------------------------------------


if( $reporte == 2 )
{
?>

<form name="sesiones2" target="_blank" action="colaborador_procesar.php" method="post" onsubmit="return reporte_colaborador_admin(this)" >

<div id="cajasrevisar" style="height: 4px"  >
</div>


<div id="cajasrevisar" style="height: 27px" >

<div id="textosrevisar">
<p><b>Seleccionar reporte :</b></p>
</div>
<div id="selecttexrevisar" style="width: 35%">
<select name="reporte" size="1" style="width: 344px" onchange="mitablajax2.micompletar2(this.form);">
<option value="1">Reporte de actividades diarias por colaborador</option>
<option value="2" selected="selected">Utilizaci&oacute;n del tiempo general por colaborador</option>
<option value="3">Utilizaci&oacute;n del tiempo en proyectos por colaborador</option>
<option value="4">Resumen de proyectos por colaborador</option>
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
$sqlcorre="select area from usuarios where user='$colaborador' ";
$result2 = mysql_query($sqlcorre,$conexion);
$correlativos1=mysql_fetch_array($result2);
$correlativos2=$correlativos1['area'];
echo "<option value=".$correlativos2.">".$correlativos2."</option>";

?>

</select>
</div>

<div id="otrotextos">
<p><b>Seleccionar colaborador :</b></p>
</div>
<div class="otrosele">
<select id="prueba" name="colaborador" size="1" >
<?php

$Textos = mysql_query("SELECT * FROM usuarios WHERE area='$correlativos2'",$conexion);

if ($row = mysql_fetch_array($Textos))
{
do
{
echo '<option value="';
echo $row['user'];
echo '">';
echo $row['user'];
echo '</potion>';
} while ($row = mysql_fetch_array($Textos));
}

?>

</select>
</div>
</div>


<div id="cajasrevisar"  >

<div id="textosrevisar">
<p><b>Inicio de periodo :</b></p>
</div>

<div id="selecttexrevisar">
<select name="inicio" size="1" >
<option value="1">Enero</option>
<option value="2">Febrero</option>
<option value="3">Marzo</option>
<option value="4">Abril</option>
<option value="5">Mayo</option>
<option value="6">Junio</option>
<option value="7">Julio</option>
<option value="8">Agosto</option>
<option value="9">Septiembre</option>
<option value="10">Octubre</option>
<option value="11">Noviembre</option>
<option value="12">Diciembre</option>
</select>
</div>



<div id="otrotextos" style="width: 17%">
<p><b>Fin de periodo :</b></p>
</div>
<div class="otrosele" style="width: 17%">
<select name="fin" size="1" >
<option value="1">Enero</option>
<option value="2">Febrero</option>
<option value="3">Marzo</option>
<option value="4">Abril</option>
<option value="5">Mayo</option>
<option value="6">Junio</option>
<option value="7">Julio</option>
<option value="8">Agosto</option>
<option value="9">Septiembre</option>
<option value="10">Octubre</option>
<option value="11">Noviembre</option>
<option value="12">Diciembre</option>
</select>
</div>

<div id="otrotextos" style="width: 10%">
<p><b>A&ntilde;o :</b></p>
</div>
<div class="otrosele" style="width: 17%">
<select name="year" size="1" >
<option value="2013">2013</option>
<option value="2014">2014</option>
<option value="2015">2015</option>
<option value="2016">2016</option>
<option value="2017">2017</option>
<option value="2018">2018</option>
<option value="2019">2019</option>
<option value="2020">2020</option>
</select>
</div>


</div>
<div id="cajasrevisar">
<div id="butomm">
<input type="submit" value="Generar reporte" />
</div>

</div>
</form>

<?php
}


if( $reporte == 3 )
{
?>

<form name="sesiones3" target="_blank" action="colaborador_procesar.php" method="post" onsubmit="return reporte_colaborador_admin(this)" >

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
<option value="3" selected="selected">Utilizaci&oacute;n del tiempo en proyectos por colaborador</option>
<option value="4">Resumen de proyectos por colaborador</option>
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
$sqlcorre="select area from usuarios where user='$colaborador' ";
$result2 = mysql_query($sqlcorre,$conexion);
$correlativos1=mysql_fetch_array($result2);
$correlativos2=$correlativos1['area'];
echo "<option value=".$correlativos2.">".$correlativos2."</option>";

?>

</select>
</div>

<div id="otrotextos">
<p><b>Seleccionar colaborador :</b></p>
</div>
<div class="otrosele">
<select id="prueba" name="colaborador" size="1" >
<?php

$Textos = mysql_query("SELECT * FROM usuarios WHERE area='$correlativos2'",$conexion);

if ($row = mysql_fetch_array($Textos))
{
do
{
echo '<option value="';
echo $row['user'];
echo '">';
echo $row['user'];
echo '</potion>';
} while ($row = mysql_fetch_array($Textos));
}

?>

</select>
</div>
</div>


<div id="cajasrevisar"  >

<div id="textosrevisar">
<p><b>Inicio de periodo :</b></p>
</div>

<div id="selecttexrevisar">
<select name="inicio" size="1" >
<option value="1">Enero</option>
<option value="2">Febrero</option>
<option value="3">Marzo</option>
<option value="4">Abril</option>
<option value="5">Mayo</option>
<option value="6">Junio</option>
<option value="7">Julio</option>
<option value="8">Agosto</option>
<option value="9">Septiembre</option>
<option value="10">Octubre</option>
<option value="11">Noviembre</option>
<option value="12">Diciembre</option>
</select>
</div>



<div id="otrotextos" style="width: 17%">
<p><b>Fin de periodo :</b></p>
</div>
<div class="otrosele" style="width: 17%">
<select name="fin" size="1" >
<option value="1">Enero</option>
<option value="2">Febrero</option>
<option value="3">Marzo</option>
<option value="4">Abril</option>
<option value="5">Mayo</option>
<option value="6">Junio</option>
<option value="7">Julio</option>
<option value="8">Agosto</option>
<option value="9">Septiembre</option>
<option value="10">Octubre</option>
<option value="11">Noviembre</option>
<option value="12">Diciembre</option>
</select>
</div>

<div id="otrotextos" style="width: 10%">
<p><b>A&ntilde;o :</b></p>
</div>
<div class="otrosele" style="width: 17%">
<select name="year" size="1" >
<option value="2013">2013</option>
<option value="2014">2014</option>
<option value="2015">2015</option>
<option value="2016">2016</option>
<option value="2017">2017</option>
<option value="2018">2018</option>
<option value="2019">2019</option>
<option value="2020">2020</option>
</select>
</div>


</div>
<div id="cajasrevisar">
<div id="butomm">
<input type="submit" value="Generar reporte" />
</div>

</div>
</form>

<?php
}




if( $reporte == 4 )
{
?>

<form name="sesiones" target="_blank" action="colaborador_procesar.php" method="post" onsubmit="return reporte_colaborador_admin(this)" >

<div id="cajasrevisar" style="height: 4px"  >
</div>


<div id="cajasrevisar" style="height: 27px" >

<div id="textosrevisar">
<p><b>Seleccionar reporte :</b></p>
</div>
<div id="selecttexrevisar" style="width: 35%" >
<select name="reporte" size="1" style="width: 344px" onchange="mitablajax2.micompletar2(this.form);">
<option value="1">Reporte de actividades diarias por colaborador</option>
<option value="2">Utilizaci&oacute;n del tiempo general por colaborador</option>
<option value="3">Utilizaci&oacute;n del tiempo en proyectos por colaborador</option>
<option value="4" selected="selected">Resumen de proyectos por colaborador</option>
</select>
</div>

</div>

<div id="cajasrevisar"  >

<div id="textosrevisar">
<p><b>Seleccione el &aacute;rea :</b></p>
</div>
<div id="selecttexrevisar">
<select name="area" size="1" onchange="mitablajax.micompletar(this.form);" disabled="disabled">
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

<div id="otrotextos">
<p><b>Seleccionar colaborador :</b></p>
</div>
<div class="otrosele">
<select id="prueba" name="colaborador" size="1" disabled="disabled">
</select>
</div>
</div>


<div id="cajasrevisar"  >

<div id="textosrevisar">
<p><b>Inicio de periodo :</b></p>
</div>

<div id="selecttexrevisar" style="width: 14%">
<select name="inicio" size="1" disabled="disabled">
<option value="1">Enero</option>
<option value="2">Febrero</option>
<option value="3">Marzo</option>
<option value="4">Abril</option>
<option value="5">Mayo</option>
<option value="6">Junio</option>
<option value="7">Julio</option>
<option value="8">Agosto</option>
<option value="9">Septiembre</option>
<option value="10">Octubre</option>
<option value="11">Noviembre</option>
<option value="12">Diciembre</option>
</select>
</div>



<div id="otrotextos" style="width: 19%">
<p><b>Fin de periodo :</b></p>
</div>
<div class="otrosele" style="width: 17%">
<select name="fin" size="1" disabled="disabled">
<option value="1">Enero</option>
<option value="2">Febrero</option>
<option value="3">Marzo</option>
<option value="4">Abril</option>
<option value="5">Mayo</option>
<option value="6">Junio</option>
<option value="7">Julio</option>
<option value="8">Agosto</option>
<option value="9">Septiembre</option>
<option value="10">Octubre</option>
<option value="11">Noviembre</option>
<option value="12">Diciembre</option>
</select>
</div>


<div id="otrotextos" style="width: 10%">
<p><b>A&ntilde;o :</b></p>
</div>
<div class="otrosele" style="width: 17%">
<select name="year" size="1" disabled="disabled" >
<option value="2013">2013</option>
<option value="2014">2014</option>
<option value="2015">2015</option>
<option value="2016">2016</option>
<option value="2017">2017</option>
<option value="2018">2018</option>
<option value="2019">2019</option>
<option value="2020">2020</option>
</select>
</div>


</div>

<div id="cajasrevisar"  >

<div id="textosrevisar" style="width: 51%" >
<p style="color:red;">** Para este reporte solo es necesario dar un click en el boton <b>Generar reporte</b> ** </p>
</div>

</div>


<div id="cajasrevisar">
<div id="butomm">
<a href="colaborador_4_horasproyecto.php" target="_blank"><input type="button" value="Generar reporte" /></a>
</div>

</div>

<input type="hidden" name="1" id="lanzador1"/>
<input type="hidden" name="2" id="lanzador2"/>
</form>





<?php
}


?>




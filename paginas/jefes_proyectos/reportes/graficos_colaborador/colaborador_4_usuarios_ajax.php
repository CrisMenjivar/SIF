<option selected="selected" value="">Colaboradores</option>

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


$areas = $_GET['COD'];

if( $areas != "general" )
{

$Textos = mysql_query("SELECT * FROM usuarios WHERE area='$areas'",$conexion);
?>


<div id="otrotextos" style="width: 21%">
<p><b>Seleccionar colaborador :</b></p>
</div>
<div class="otrosele" style="width: 16%">

<select name="colaborador" size="1" onblur="mitablajax3.micompletar3(this.form);">
<option value="">Colaboradores</option>




<?php

if ($row = mysql_fetch_array($Textos))
{
do
{
echo '<option value="';
echo $row['user'];
echo '">';
echo ucwords(strtr($row['user'],'_',' '));
echo '</option>';
} while ($row = mysql_fetch_array($Textos));
}
else
{
echo "Sin datos!";
}


?>
</select>
</div>


<?php

}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" type="text/javascript" src="../../../js/astnuevos.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/seguridad.js"></script>
<link href="../../../estilo/estiloast.css" rel="stylesheet" type="text/css" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>An&aacute;lisis Semanal de Tiempo -- AST</title>

<!-- inicio de script para los input de las horas ------------------------------------------------------->
<script type="text/javascript" language="javascript" src="../../../js/horas/jquery-1.7.1.min.js"></script>
<script type="text/javascript" language="javascript" src="../../../js/horas/jquery.mousewheel.js"></script>
<script type="text/javascript" language="javascript" src="../../../js/horas/jquery.timepickerinputmask.min.js"></script>

<script type="text/javascript" language="javascript">
$(document).ready(function () {

$('.input1').TimepickerInputMask();

$('.input2').TimepickerInputMask();

});
</script>

<!--FIN DE LAS HORAS------------------------------------------------------------------------------------->

<!--Hoja de estilos del calendario --------------------------------------------------------------------->
<link rel="stylesheet" type="text/css" media="all" href="../../../js/calendario/calendar-blue2.css" title="win2k-cold-1" />
<!-- librería principal del calendario -->
<script type="text/javascript" src="../../../js/calendario/calendar.js"></script>
<!-- librería para cargar el lenguaje deseado -->
<script type="text/javascript" src="../../../js/calendario/lang/calendar-es.js"></script>
<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código -->
<script type="text/javascript" src="../../../js/calendario/calendar-setup.js"></script>
<!--Hoja de estilos del calendario --------------------------------------------------------------------->

<script type="text/javascript" src="../../../js/ajax.js">
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


</head>

<body style="height:auto">
<?php
include('../../../config/db.php');

//guardar la conexion realizada al servidor de bases de datos en una variable
$conexion=mysql_connect($servidor,$usuario,$contra) or die(mysql_error());

//verificar si la conexion se realizo con exito
if(!$conexion)
{
die("No se pudo conectar");
}
//Seleccionar la base de datos a las que nos conectaremos
$bd=mysql_select_db($nombre_bd,$conexion) or die(mysql_error());

?>

<?php
$textos = mysql_query("SELECT * FROM ast WHERE totalhoras='0' limit 0,1",$conexion);
$fila = mysql_fetch_assoc($textos);

$usuario1=$fila['usuario'];
$fecha1=$fila['fecha'];
$descripcion1=$fila['descripcion'];
$actividad1=$fila['tipoact'];
$empresa1=$fila['empresa'];
$proyecto1=$fila['cproyecto'];
$inicio1=$fila['inicio'];
$fin1=$fila['fin'];
$total1=$fila['totalhoras'];

?>

<div id="insertardatos" style="margin-top:5px;">
<div id="areadatos" style="height:22px;"><p style="height:22px;">&nbsp;&nbsp;&Aacute;rea para el registro de datos</p></div>
<div id="descripcion" style="margin-top:4px;margin-left:1px;">
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
<form name="insertardatos" action="inserta_reparaciones.php" target="_parent" method="post" onsubmit="return validar2(this)">

<input type="hidden" name="usuario1" value="<?php echo $usuario1; ?>" />

<div id="fechatex">
<input type="text" name="fecha" id="campo_fecha" value="<?php echo $fecha1; ?>" maxlength="10" onkeypress="return acceptNumhorasNada(event)"/>
</div>

<div id="calendario">
<input type="image" src="../../../imagenes/calendar.png" id="lanzador" alt="Calendario"/>
</div>

<div id="descritex" style="width: 341px" >
<input type="text" name="descripcion" maxlength="58" value="<?php echo $descripcion1; ?>" style="width: 338px" />
</div>

<div id="tipoacttex">
<select name="actividades" size="1">
<?php
$sql2="select * from actividad where estado='a'";
$result2 = mysql_query($sql2,$conexion);

while ( $actividad=mysql_fetch_array($result2) )
{
$activi=$actividad['tipoact'];

if( $actividad1 == $activi )
{
echo '<option selected="selected" value="'.$activi.'">'.strtr($activi,'_',' ')."</option>";
}
else
{
echo "<option value=".$activi.">".strtr($activi,'_',' ')."</option>";
}
}
?>
</select>
</div>

<div id="empresatex">
<select name="empresas" size="1" onchange="mitablajax2.micompletar2(this.form);" >
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
<select name="pro" size="1" onchange="mitablajax2.micompletar2(this.form);" >
<?php
if($proyecto1=="NO_ES_PROYECTO")
{
echo '<option value="NO_ES_PROYECTO" selected="selected" >NO ES PROYECTO</option>';
echo '<option value="PROYECTOS" >PROYECTOS</option>';
}
else
{
echo '<option value="NO_ES_PROYECTO" >NO ES PROYECTO</option>';
echo '<option value="PROYECTOS" selected="selected" >PROYECTOS</option>';
}
?>
</select>

</div>

<div id="iniciotex">
<input type="text" name="inicios" value="<?php echo $inicio1; ?>" onclick="formato(this.form)" maxlength="5" onfocus="limpiar()" onkeypress="return acceptNumhoras(event)" onblur="validar(this)"/>
</div>

<div id="fintex">
<input type="text" name="finales" value="<?php echo $fin1; ?>" onclick="formato(this.form)" maxlength="5" onfocus="limpiar()" onkeypress="return acceptNumhoras(event)" onblur="enviarhoras()"/>
</div>

<input type="hidden" name="horas" value="<?php echo $total1; ?>" maxlength="5" />

<!--
<div id="horastex">
<input type="text" name="horas" value="<?php echo $total1; ?>" maxlength="5" onkeypress="return acceptNumhoras(event)" />
</div>
-->

<!-- ----------------------------------------------------------------->
<div id="botonfinal" style="height: 17px">
<div id="format" style="height: 17px"></div>
<?php
// echo " <input type='submit' value='Guardar actividad' style='width: 131px; height: 26px'/> ";
echo '<div id="proyectmsj" style="height: 17px">';

if($proyecto1!="NO_ES_PROYECTO")
{
echo '<select name="proyectos" size="1">';

$sql4="select * from proyectos where estado='a' and empresa='$empresa1' and correlativo!='NO_ES_PROYECTO'";
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
echo '<option selected="selected" value="'.$proyectos.'">'.$proyectos." - ".$nompro."</option>";
}
} //fin while

echo '</select>';
}
else
{
echo '<input type="hidden" name="proyectos" value="NO_ES_PROYECTO">';
}
echo '</div>';
echo '<div id="botonfinal1" style="height: 16px"><p style="height: 17px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Formato 24 horas</p></div>';

?>

<div id="botonfinal">
<!--<div id="format"><p>A&ntilde;o-Mes-D&iacute;as</p></div> -->
<div id="format"> <!-- <input type="button" id="lanzador" value="Calendario" /> --> </div>
<div id="proyectmsj"></div>
<div id="botonfinal1" style="height: 25px"><input type="submit" value="Guardar actividad" onclick="totalhoras()" style="width: 131px; height: 26px;margin-left:15px;"/></div>
</div>


</div>
</form>
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

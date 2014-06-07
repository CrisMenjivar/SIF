<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" type="text/javascript" src="../../js/seguridad.js"></script>
<link href="../../estilo/estiloformularios.css" rel="stylesheet" type="text/css" />
<link href="../../estilo/estiloast.css" rel="stylesheet" type="text/css" />

<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Sin título 1</title>

<script type="text/javascript" src="../../js/ajax.js">
</script>

<base target="_parent" />

</head>

<body style="margin:0px 0px 0px 0px;">
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

if($move['admin']=="2")
{
header ("Location: ../usuarios/ast.php");
}

}//fin else

$usuario1=$_SESSION['user'];

?>

<div id="tabla">

<table class="fila" width="995px" border="0" cellpadding="1" cellspacing="1" style="border-color:#000099;">
<?php

$textos = mysql_query("SELECT fecha,descripcion,inicio,fin,DAY(fecha) as dia FROM excel WHERE usuario='$usuario1' order by fecha ASC, inicio ASC",$conexion);

for($x = 0 ; $x < mysql_num_rows($textos) ; $x++)
{

$fila = mysql_fetch_assoc($textos);

$link_modificar='datoexcel_ajax.php?posicion='.$x.'&fecha='.$fila['fecha'].'&descripcion='.$fila['descripcion'].'&inicio='.$fila['inicio'].'&fin='.$fila['fin'];
$link_eliminar='datoexcel_eliminar_ajax.php?posicion='.$x.'&fecha='.$fila['fecha'].'&descripcion='.$fila['descripcion'].'&inicio='.$fila['inicio'].'&fin='.$fila['fin'];

echo '<tr'; if( $_SESSION['check'] == $x){ if($fila['dia']%2 == 0){echo 'class="par-seleccionado"';}else{echo 'class="impar-seleccionado"';} }else{ if($fila['dia']%2 == 0){echo 'class="par"';}else{echo 'class="impar"';} } echo '>';
echo '<td width="30px"  height="17px" align="center" '; if( $_SESSION['check'] == $x){ if($fila['dia']%2 == 0){echo 'class="par-seleccionado"';}else{echo 'class="impar-seleccionado"';} }else{ if($fila['dia']%2 == 0){echo 'class="par"';}else{echo 'class="impar"';} } echo'> <a target="_parent" href="';   echo $link_modificar; echo '" ><img style="margin:0px 0px -3px 0px;" alt="Editar registro" src="../../imagenes/lapiz2.png" /> </a> </td>';
echo '<td width="30px"  height="17px" align="center" '; if( $_SESSION['check'] == $x){ if($fila['dia']%2 == 0){echo 'class="par-seleccionado"';}else{echo 'class="impar-seleccionado"';} }else{ if($fila['dia']%2 == 0){echo 'class="par"';}else{echo 'class="impar"';} } echo'> <a target="_parent" href="';   echo $link_eliminar; echo '" ><img style="margin:0px 0px -3px 0px;" alt="Editar registro" src="../../imagenes/eliminar.png" /> </a> </td>';
echo '<td width="80px"  height="17px" align="center" '; if( $_SESSION['check'] == $x){ if($fila['dia']%2 == 0){echo 'class="par-seleccionado"';}else{echo 'class="impar-seleccionado"';} }else{ if($fila['dia']%2 == 0){echo 'class="par"';}else{echo 'class="impar"';} } echo ' >'; echo $fila['fecha'];       echo '</td>';
echo '<td width="404px" style="line-height:normal;" height="17px"  ';               if( $_SESSION['check'] == $x){ if($fila['dia']%2 == 0){echo 'class="par-seleccionado"';}else{echo 'class="impar-seleccionado"';} }else{ if($fila['dia']%2 == 0){echo 'class="par"';}else{echo 'class="impar"';} } echo ' >'; echo $fila['descripcion']; echo '</td>';
echo '<td width="105px" height="17px"  ';               if( $_SESSION['check'] == $x){ if($fila['dia']%2 == 0){echo 'class="par-seleccionado"';}else{echo 'class="impar-seleccionado"';} }else{ if($fila['dia']%2 == 0){echo 'class="par"';}else{echo 'class="impar"';} } echo ' >';                            echo '</td>';
echo '<td width="93px" height="17px"  ';                if( $_SESSION['check'] == $x){ if($fila['dia']%2 == 0){echo 'class="par-seleccionado"';}else{echo 'class="impar-seleccionado"';} }else{ if($fila['dia']%2 == 0){echo 'class="par"';}else{echo 'class="impar"';} } echo ' >';                            echo '</td>';
echo '<td width="134px" height="17px"  ';               if( $_SESSION['check'] == $x){ if($fila['dia']%2 == 0){echo 'class="par-seleccionado"';}else{echo 'class="impar-seleccionado"';} }else{ if($fila['dia']%2 == 0){echo 'class="par"';}else{echo 'class="impar"';} } echo '>';                             echo '</td>';
echo '<td width="78px"  height="17px" align="center" '; if( $_SESSION['check'] == $x){ if($fila['dia']%2 == 0){echo 'class="par-seleccionado"';}else{echo 'class="impar-seleccionado"';} }else{ if($fila['dia']%2 == 0){echo 'class="par"';}else{echo 'class="impar"';} } echo '>'; echo $fila['inicio'];       echo '</td>';
echo '<td width="78px"  height="17px" align="center" '; if( $_SESSION['check'] == $x){ if($fila['dia']%2 == 0){echo 'class="par-seleccionado"';}else{echo 'class="impar-seleccionado"';} }else{ if($fila['dia']%2 == 0){echo 'class="par"';}else{echo 'class="impar"';} } echo '>'; echo $fila['fin'];          echo '</td>';
echo '</tr>';


}//fin for para obtener las actividades

?>

</table>

</div>


<div id="error"></div>

</body>

</html>

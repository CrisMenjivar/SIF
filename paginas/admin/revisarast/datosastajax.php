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


$userast = $_GET['userast'];
$finicio= $_GET['inicio'];
$ffinal= $_GET['final'];

//CREAMOS SESION PARA RECHAZAR LAS PETICIONES DE EL USUARIO
session_start();
$_SESSION['numero1']=$userast;
$_SESSION['numero2']=$finicio;
$_SESSION['numero3']=$ffinal;

if($_SESSION['numero1'] != "" and $_SESSION['numero2'] != "" and $_SESSION['numero3'] != ""  )
{

?>

<form>
<table width="999px" border="0" cellpadding="1" cellspacing="1" style="border-color:#000099;background-color:#3b5998;color:white;font-size:11px;">
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

<table class="fila" width="999px" border="0" cellpadding="1" cellspacing="1" style="border-color:#000099;">
<?php

$textos = mysql_query("select fecha,descripcion,p.empresa,inicio,fin,p.tipo,dia,p.nombre,codigo as cproyecto from proyectos inner join (SELECT fecha,descripcion,empresa,cproyecto as c,inicio,fin,tipo,DAY(fecha) as dia,nombre FROM ast inner join actividad on ast.tipoact=actividad.tipoact WHERE usuario='$userast' AND fecha BETWEEN '$finicio' AND '$ffinal' ORDER BY fecha ASC, inicio ASC ) as p on correlativo=c",$conexion);

for($x = 0 ; $x < mysql_num_rows($textos) ; $x++)
{

$fila = mysql_fetch_assoc($textos);

echo '<tr'; if( $fila['tipo'] == "o"){ if($fila['dia']%2 == 0){echo 'style="color:blue;background-color:#A2B5CD;"';}else{echo 'style="color:blue;background-color:#CFCFCF;"';} }else{ if($fila['dia']%2 == 0){echo 'style="background-color:#A2B5CD;"';}else{echo 'style="background-color:#CFCFCF;"';} } echo '>';
echo '<td width="30px"  height="17px" align="center" '; if( $fila['tipo'] == "o"){ if($fila['dia']%2 == 0){echo 'style="color:blue;background-color:#A2B5CD;"';}else{echo 'style="color:blue;background-color:#CFCFCF;"';} }else{ if($fila['dia']%2 == 0){echo 'style="background-color:#A2B5CD;"';}else{echo 'style="background-color:#CFCFCF;"';} } echo ' > <input name="rechazado" type="checkbox" value="'; echo $x; echo '"  onclick="mitablajax3.micompletar3(this);" /> </td>';
echo '<td width="80px"  height="17px" align="center" '; if( $fila['tipo'] == "o"){ if($fila['dia']%2 == 0){echo 'style="color:blue;background-color:#A2B5CD;"';}else{echo 'style="color:blue;background-color:#CFCFCF;"';} }else{ if($fila['dia']%2 == 0){echo 'style="background-color:#A2B5CD;"';}else{echo 'style="background-color:#CFCFCF;"';} } echo ' >'; echo $fila['fecha'];       echo '</td>';
echo '<td width="404px" height="17px"  ';               if( $fila['tipo'] == "o"){ if($fila['dia']%2 == 0){echo 'style="color:blue;background-color:#A2B5CD;"';}else{echo 'style="color:blue;background-color:#CFCFCF;"';} }else{ if($fila['dia']%2 == 0){echo 'style="background-color:#A2B5CD;"';}else{echo 'style="background-color:#CFCFCF;"';} } echo ' >'; echo $fila['descripcion']; echo '</td>';
echo '<td width="115px" height="17px"  ';               if( $fila['tipo'] == "o"){ if($fila['dia']%2 == 0){echo 'style="color:blue;background-color:#A2B5CD;"';}else{echo 'style="color:blue;background-color:#CFCFCF;"';} }else{ if($fila['dia']%2 == 0){echo 'style="background-color:#A2B5CD;"';}else{echo 'style="background-color:#CFCFCF;"';} } echo ' >'; echo $fila['nombre'];      echo '</td>';
echo '<td width="103px" height="17px"  ';               if( $fila['tipo'] == "o"){ if($fila['dia']%2 == 0){echo 'style="color:blue;background-color:#A2B5CD;"';}else{echo 'style="color:blue;background-color:#CFCFCF;"';} }else{ if($fila['dia']%2 == 0){echo 'style="background-color:#A2B5CD;"';}else{echo 'style="background-color:#CFCFCF;"';} } echo ' >'; echo $fila['empresa'];     echo '</td>';
echo '<td width="144px" height="17px"  ';               if( $fila['tipo'] == "o"){ if($fila['dia']%2 == 0){echo 'style="color:blue;background-color:#A2B5CD;"';}else{echo 'style="color:blue;background-color:#CFCFCF;"';} }else{ if($fila['dia']%2 == 0){echo 'style="background-color:#A2B5CD;"';}else{echo 'style="background-color:#CFCFCF;"';} } echo '>'; echo $fila['cproyecto'];   echo '</td>';
echo '<td width="78px"  height="17px" align="center" '; if( $fila['tipo'] == "o"){ if($fila['dia']%2 == 0){echo 'style="color:blue;background-color:#A2B5CD;"';}else{echo 'style="color:blue;background-color:#CFCFCF;"';} }else{ if($fila['dia']%2 == 0){echo 'style="background-color:#A2B5CD;"';}else{echo 'style="background-color:#CFCFCF;"';} } echo '>'; echo $fila['inicio'];      echo '</td>';
echo '<td width="78px"  height="17px" align="center" '; if( $fila['tipo'] == "o"){ if($fila['dia']%2 == 0){echo 'style="color:blue;background-color:#A2B5CD;"';}else{echo 'style="color:blue;background-color:#CFCFCF;"';} }else{ if($fila['dia']%2 == 0){echo 'style="background-color:#A2B5CD;"';}else{echo 'style="background-color:#CFCFCF;"';} } echo '>'; echo $fila['fin'];         echo '</td>';
echo '</tr>';


}//fin for para obtener las actividades

?>

</table>
</form>

<?php
}
?>





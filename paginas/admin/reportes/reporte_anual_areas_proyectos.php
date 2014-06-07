<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link href="../../../estilo/estilo_reportes1.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../../../js/seguridad.js"></script>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Reporte Anual</title>

<style type="text/css">
.auto-style2 {
border-width: 1px;
background-color: #3B5998;
color:white;
text-align:right;
}
.auto-style3 {
border-width: 1px;
text-align:right;
}
.auto-style8 {
border-width: 1px;
background-color: #3B5998;
color:white;
}
</style>

</head>

<body>
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


$userid=$_SESSION['user'];
$anio=$_SESSION['year'];
$inicio=$_SESSION['inicio'];
$fin=$_SESSION['fin'];
$area=$_SESSION['tipo'];

switch ($fin)
{
Case 1:
$diaII="01";
$diaFF="31";
break;
Case 2:
$diaII="01";
$diaFF="28";
break;
Case 3:
$diaII="01";
$diaFF="31";
break;
Case 4:
$diaII="01";
$diaFF="30";
break;
Case 5:
$diaII="01";
$diaFF="31";
break;
Case 6:
$diaII="01";
$diaFF="30";
break;
Case 7:
$diaII="01";
$diaFF="31";
break;
Case 8:
$diaII="01";
$diaFF="31";
break;
Case 9:
$diaII="01";
$diaFF="30";
break;
Case 10:
$diaII="01";
$diaFF="31";
break;
Case 11:
$diaII="01";
$diaFF="30";
break;
Case 12:
$diaII="01";
$diaFF="31";
break;
}


?>


<div id="contenedor">
<div id="encabezado">
<div id="logo">
<div id="logoimagen">
<img src="../../../imagenes/sites.png" alt="sites"/>
</div>
<div id="textologo"><p>Shared IT Enterprise Services</p></div>
</div>

<div id="descripcion">
<div id="caja"><p>An&aacute;lisis semanal de tiempo -- AST</p></div>
<div id="caja4"><p><b>Reporte anual de actividades por departamento</b></p></div>
<div id="caja2">

<div id="caja3"><p><b>&Aacute;rea : <?php echo 'PROYECTOS SITES';  ?></b></p></div>
<div id="caja3"><p style="font-size:13px;"><b>Periodo :  <?php echo $anio; echo "-"; echo $inicio; echo "-"; echo $diaII; echo "   al   "; echo $anio; echo "-"; echo $fin; echo "-"; echo $diaFF; ?></b></p></div>

</div>
</div>
</div>

<!-- ------------------------------------------------------------------------------------------------------ -->


<?php
if( $area == "PROYECTOS")
{

//total por utilizacion
$sql4="select sum(totalhoras) as total from ast where cproyecto!='99' AND fecha BETWEEN '$anio-$inicio-$diaII' AND '$anio-$fin-$diaFF'";

//contamos los usuarios para sacar los promedios
$sql5="select count(codigo) as total from area where estado='a' ";


$utilizacion = mysql_query($sql4,$conexion);
$promedios = mysql_query($sql5,$conexion);
$tpromedios=mysql_fetch_array($promedios);


//inicio consolidado***************************************************************************************************************************
?>

<div id="consolidado">

<div id="colaboradores">
<table border="1px" cellpadding="0" cellspacing="0">
<tr>
<td class="auto-style2" colspan="1" style="text-align:center;"><strong>Meses</strong></td>
<td colspan="1" style="text-align:center;background-color: #3B5998;color:white"><strong>Horas</strong></td>
<?php
$resultado4=mysql_fetch_array($utilizacion);
$uti=$resultado4['total'];
//echo '<td width="70px" class="auto-style1">'; echo'</td>'; //echo $uti; echo' mins</td>';
?>
</tr>

<?php

$divisorrr=1;
for( $l=$inicio ; $l<=$fin ; $l++ )
{
if( $l != $fin )
{
$divisorrr++;
}
}

for( $i=$inicio ; $i<=$fin ; $i++ )
{

switch ($i)
{
Case 1:
$mes="Enero";
$diaI="01";
$diaF="31";
break;
Case 2:
$mes="Febrero";
$diaI="01";
$diaF="28";
break;
Case 3:
$mes="Marzo";
$diaI="01";
$diaF="31";
break;
Case 4:
$mes="Abril";
$diaI="01";
$diaF="30";
break;
Case 5:
$mes="Mayo";
$diaI="01";
$diaF="31";
break;
Case 6:
$mes="Junio";
$diaI="01";
$diaF="30";
break;
Case 7:
$mes="Julio";
$diaI="01";
$diaF="31";
break;
Case 8:
$mes="Agosto";
$diaI="01";
$diaF="31";
break;
Case 9:
$mes="Septiembre";
$diaI="01";
$diaF="30";
break;
Case 10:
$mes="Octubre";
$diaI="01";
$diaF="31";
break;
Case 11:
$mes="Noviembre";
$diaI="01";
$diaF="30";
break;
Case 12:
$mes="Diciembre";
$diaI="01";
$diaF="31";
break;
}


$sql40="select count(ast.totalhoras) as total from ast inner join usuarios on user=usuario where cproyecto!='99' AND fecha BETWEEN '$anio-$i-$diaI' AND '$anio-$i-$diaF' ";
$tar = mysql_query($sql40,$conexion);
$resultad6=mysql_fetch_array($tar);
$val6=$resultad6['total'];

if( $val6 == 0 )
{
echo '<tr>';
echo '<td>'; echo $mes; echo '</td>';
echo '<td width="70px" class="auto-style5" style="text-align:right;">'; echo '0'; echo ' &nbsp;</td>';
echo '</tr>';

}
else
{

$sql1="select sum(ast.totalhoras) as total from ast where cproyecto!='99' AND fecha BETWEEN '$anio-$i-$diaI' AND '$anio-$i-$diaF'";
$templeados = mysql_query($sql1,$conexion);


while ( $resultado1=mysql_fetch_array($templeados) )
{
echo '<tr>';
echo '<td>'; echo $mes; echo '</td>';
echo '<td width="70px" class="auto-style5" style="text-align:right;">'; 

$valor2=$resultado1['total']; 

$h=0;
			
			while( $valor2 != 0 )
			{
				if( $valor2 >= 60 )
				{
					$h=$h+1;
					$valor2=$valor2-60;
				}
				else
				{
				   if( $valor2 >= 10 )
				   {
				   		$h=$h.'.'.$valor2;
				   		$valor2=$valor2-$valor2;
				   }
				   else
				   {
				   		$h=$h.'.0'.$valor2;
				   		$valor2=$valor2-$valor2;
				   }
				}
			}
			
echo $h;


echo ' &nbsp;</td>';

echo '</tr>';
}//fin while evaluando las areas


}



}//fin for para evaluar el primer cuadro


?>
<tr>
<td class="auto-style2" style="text-align:center;font-weight:bold;">Total</td>
<td style="text-align:right;">

<?php 

$valor2=$uti; 

$h=0;
			
			while( $valor2 != 0 )
			{
				if( $valor2 >= 60 )
				{
					$h=$h+1;
					$valor2=$valor2-60;
				}
				else
				{
				   if( $valor2 >= 10 )
				   {
				   		$h=$h.'.'.$valor2;
				   		$valor2=$valor2-$valor2;
				   }
				   else
				   {
				   		$h=$h.'.0'.$valor2;
				   		$valor2=$valor2-$valor2;
				   }
				}
			}
			
echo $h;


echo' &nbsp;'; ?></td>


</tr>
</table>
</div>

<div id="actividades">
<table border="1px" cellpadding="0" cellspacing="0">
<tr>
<td align="center" class="auto-style2" colspan="1" style="text-align:center;font-weight:bold; width: 125px;">Utilizaci&oacute;n</td>
<td align="center" colspan="1" style="text-align:center;font-weight:bold;background-color: #3B5998;color:white; width: 77px;">Horas</td>
<?php
//echo '<td width="70px" class="auto-style1">'; echo $uti; echo' mins</td>';
?>
<td align="center" class="auto-style8" style="text-align:center;font-weight:bold;font-size:12px;">Promedios</td>
</tr>
<?php
$prom=0;

$ques="select tipoact,nombre from actividad order by nombre asc";
$resu = mysql_query($ques,$conexion);

while ( $actis=mysql_fetch_array($resu) )
{

$actividadd=$actis['tipoact'];

$sql20="select count(ast.totalhoras) as total from ast where cproyecto!='99' AND tipoact='$actividadd' and fecha BETWEEN '$anio-$inicio-$diaII' AND '$anio-$fin-$diaFF' ";
$tac = mysql_query($sql20,$conexion);
$resultad=mysql_fetch_array($tac);
$val=$resultad['total'];

if( $val == 0 )
{
echo '<tr>';
echo '<td>'; echo strtr($actis['nombre'],'_',' '); echo'</td>';
echo '<td class="auto-style3">'; echo '0'; echo ' &nbsp;</td>';

echo '<td class="auto-style3">'; echo "0"; echo ' &nbsp;</td>';
echo '</tr>';


}
else
{

//consulta de total de horas por actividad
$sql2="select ast.tipoact,sum(ast.totalhoras) as total,nombre from ast inner join actividad on actividad.tipoact=ast.tipoact where cproyecto!='99' AND ast.tipoact='$actividadd' and fecha BETWEEN '$anio-$inicio-$diaII' AND '$anio-$fin-$diaFF' group by ast.tipoact";
$tactividades = mysql_query($sql2,$conexion);


while ( $resultado2=mysql_fetch_array($tactividades) )
{
echo '<tr>';
echo '<td>'; echo strtr($resultado2['nombre'],'_',' '); echo'</td>';
echo '<td class="auto-style3">'; 

$valor2=$resultado2['total']; 

$h=0;
			
			while( $valor2 != 0 )
			{
				if( $valor2 >= 60 )
				{
					$h=$h+1;
					$valor2=$valor2-60;
				}
				else
				{
				   if( $valor2 >= 10 )
				   {
				   		$h=$h.'.'.$valor2;
				   		$valor2=$valor2-$valor2;
				   }
				   else
				   {
				   		$h=$h.'.0'.$valor2;
				   		$valor2=$valor2-$valor2;
				   }
				}
			}
			
echo $h;


echo ' &nbsp;</td>';

$valor=$resultado2['total'];
$divisor=$tpromedios['total'];
$res=$valor/$divisorrr;
$prom=$prom+$res;

echo '<td class="auto-style3">'; $res9=round(($res/60) * 100) / 100;  echo $res9; echo ' &nbsp;</td>';
echo '</tr>';
}

}//fin else diferente de cero

}//fin while de las actividades
?>
<tr>
<td class="auto-style2" style="text-align:center;font-weight:bold; width: 125px;">Total</td>
<td style="text-align:right; width: 77px;" >


<?php 

$valor2=$uti; 


$h=0;
			
			while( $valor2 != 0 )
			{
				if( $valor2 >= 60 )
				{
					$h=$h+1;
					$valor2=$valor2-60;
				}
				else
				{
				   if( $valor2 >= 10 )
				   {
				   		$h=$h.'.'.$valor2;
				   		$valor2=$valor2-$valor2;
				   }
				   else
				   {
				   		$h=$h.'.0'.$valor2;
				   		$valor2=$valor2-$valor2;
				   }
				}
			}
			
echo $h;


echo' &nbsp;'; ?>


</td>


<td class="auto-style3" > <?php $prom9=round(($prom/60) * 100) / 100; echo $prom9; ?> &nbsp;</td>
</tr>
</table>
</div>

<div id="empresas">
<table border="1px" cellpadding="0" cellspacing="0">
<tr>
<td align="center" class="auto-style2" colspan="1" style="text-align:center;font-weight:bold;">Empresas</td>
<td align="center" colspan="1" style="text-align:center;font-weight:bold;background-color: #3B5998;color:white">Horas</td>
<?php
//echo '<td width="70px" class="auto-style1">'; echo $uti; echo' mins</td>';
?>
<td align="center" class="auto-style8" style="text-align:center;font-weight:bold;font-size:12px;">Promedios</td>
</tr>

<?php
$prom2=0;


$ques="select nombre from empresas";
$restu = mysql_query($ques,$conexion);

while ( $empress=mysql_fetch_array($restu) )
{

$empresass=$empress['nombre'];

$sql30="select count(ast.totalhoras) as total from ast where cproyecto!='99' AND empresa='$empresass' and fecha BETWEEN '$anio-$inicio-$diaII' AND '$anio-$fin-$diaFF' ";
$tem = mysql_query($sql30,$conexion);
$resultad2=mysql_fetch_array($tem);
$val2=$resultad2['total'];

if( $val2 == 0 )
{

echo '<tr>';
echo '<td>'; echo $empresass; echo'</td>';
echo '<td class="auto-style3">'; echo "0"; echo ' &nbsp;</td>';

echo '<td class="auto-style3">'; echo "0"; echo ' &nbsp;</td>';
echo '</tr>';

}
else
{

//consulta para total de horas por empresas
$sql3="select ast.empresa,sum(ast.totalhoras) as total from ast where cproyecto!='99' AND empresa='$empresass' and fecha BETWEEN '$anio-$inicio-$diaII' AND '$anio-$fin-$diaFF' group by ast.empresa ASC";
$tempresas = mysql_query($sql3,$conexion);


while ( $resultado3=mysql_fetch_array($tempresas) )
{
echo '<tr>';
echo '<td>'; echo $resultado3['empresa']; echo'</td>';
echo '<td class="auto-style3">'; 

$valor2=$resultado3['total']; 

$h=0;
			
			while( $valor2 != 0 )
			{
				if( $valor2 >= 60 )
				{
					$h=$h+1;
					$valor2=$valor2-60;
				}
				else
				{
				   if( $valor2 >= 10 )
				   {
				   		$h=$h.'.'.$valor2;
				   		$valor2=$valor2-$valor2;
				   }
				   else
				   {
				   		$h=$h.'.0'.$valor2;
				   		$valor2=$valor2-$valor2;
				   }
				}
			}
			
echo $h;


echo ' &nbsp;</td>';

$valor=$resultado3['total'];
$divisor=$tpromedios['total'];
$res2=$valor/$divisorrr;
$prom2=$prom2+$res2;

echo '<td class="auto-style3">'; $res10=round(($res2/60) * 100) / 100; echo $res10; echo ' &nbsp;</td>';
echo '</tr>';
}

}//fin else

}//fin while de las empresas
?>
<tr>
<td class="auto-style2" style="text-align:center;font-weight:bold;">Total</td>
<td style="text-align:right;">


<?php 


$valor2=$uti; 

$h=0;
			
			while( $valor2 != 0 )
			{
				if( $valor2 >= 60 )
				{
					$h=$h+1;
					$valor2=$valor2-60;
				}
				else
				{
				   if( $valor2 >= 10 )
				   {
				   		$h=$h.'.'.$valor2;
				   		$valor2=$valor2-$valor2;
				   }
				   else
				   {
				   		$h=$h.'.0'.$valor2;
				   		$valor2=$valor2-$valor2;
				   }
				}
			}
			
echo $h;


echo' &nbsp;'; ?>


</td>



<td class="auto-style3"> <?php $prom10=round(($prom2/60) * 100) / 100; echo $prom10; ?> &nbsp;</td>
</tr>
</table>
</div>
</div>

<?php
//fin consolidado****************************************************************************************
}
?><!--fin if para agregar cuadro resumen si el area es general -->

<!-- ------------------------------------------------------------------------------------------------------ -->

<div id="grafico2">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="grafico_anual_actividad_proyectos_grafico.php">
</iframe>
</div>

<div id="grafico2">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="grafico_anual_empresa_proyectos_grafico.php">
</iframe>
</div>


<div id="grafico2">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="982px" height="470px" src="grafico_anual_promes_proyectos_grafico.php">
</iframe>
</div>

</div>

</body>
</html>

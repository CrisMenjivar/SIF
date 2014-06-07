<?php

//RECUPERAMOS LAS VARIABLES OBTENIDAS DE LA SELECCION DEL PERIODO PARA EL AST

session_start();
$inicio=$_SESSION['area_inicio']; //formato : anio-mes-dia 2014-01-01
$fin=$_SESSION['area_fin'];       //formato : anio-mes-dia 2014-01-31
$area=$_SESSION['area_area'];     //area
$year=$_SESSION['area_year'];     //formato : 2014

$uno=$_SESSION['area_uno']; //formato : es un digito entre 1 hasta 12 marca el mes de inicio
$dos=$_SESSION['area_dos']; //formato : es un digito entre 1 hasta 12 marca el mes de fin


//--------------------------------------------------------------------------

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

$meses=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
$color =array("#FF0F00","#FF6600","#FF9E01","#FCD202","#F8FF01","#B0DE09","#04D215","#0D8ECF","#0D52D1","#2A0CD0","#8A0CCF","#CD0D74");

$cont=0;

//creamos e iniciamos la cadena a convertir en json
$prefix='';

echo "[";

for( $y = $uno ; $y <= $dos ; $y++)
{
	if( $y < 10 )
	{
		$m1="0".$y;
	}
	else
	{
		$m1=$y;
	}

	switch ($y)
	{
		Case 1:
				$diaI="01";
				$diaF="31";
		break;
		Case 2:
				$diaI="01";
				$diaF="28";
		break;
		Case 3:
				$diaI="01";
				$diaF="31";
		break;
		Case 4:
				$diaI="01";
				$diaF="30";
		break;
		Case 5:
				$diaI="01";
				$diaF="31";
		break;
		Case 6:
				$diaI="01";
				$diaF="30";
		break;
		Case 7:
				$diaI="01";
				$diaF="31";
		break;
		Case 8:
				$diaI="01";
				$diaF="31";
		break;
		Case 9:
				$diaI="01";
				$diaF="30";
		break;
		Case 10:
				$diaI="01";
				$diaF="31";
		break;
		Case 11:
				$diaI="01";
				$diaF="30";
		break;
		Case 12:
				$diaI="01";
				$diaF="31";
		break;
	}//FIN SWITCH

	if( $y != $uno)
	{
		echo ',';
	}
	
	echo $prefix . " {";
	echo '"mes": "'.$meses[$y-1].'", ';
	
	

	$sql2="select count(correlativo) as totales from proyectos where area='$area' and finicio BETWEEN '$year-$m1-$diaI' AND '$year-$m1-$diaF'";
    $cuenta=mysql_query($sql2,$conexion);
    $valor=mysql_fetch_assoc($cuenta);
    $total=$valor['totales'];

	echo '"value1": '.$total.',';

	echo '"color": "'.$color[$cont].'"';
	echo " }";
	$cont++;	

} //FIN DEL FOR y

echo "]";

?>

<?php
    
//RECUPERAMOS LAS VARIABLES OBTENIDAS DE LA SELECCION DEL PERIODO PARA EL AST
    
    session_start();
    $inicio=$_SESSION['empresa_inicio'];
    $fin=$_SESSION['empresa_fin'];
    $empresa=$_SESSION['empresa_area'];
    $year=$_SESSION['empresa_year'];
    
    $uno=$_SESSION['empresa_uno'];
    $dos=$_SESSION['empresa_dos'];

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
	
	

    $sql2="select count(correlativo) as totales from proyectos where empresa='$empresa' and finicio BETWEEN '$year-$m1-$diaI' AND '$year-$m1-$diaF'";
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

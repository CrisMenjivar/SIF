<?php
    
    //RECUPERAMOS LAS VARIABLES OBTENIDAS DE LA SELECCION DEL PERIODO PARA EL AST
    session_start();
    $inicio=$_SESSION['empresa_inicio'];
    $fin=$_SESSION['empresa_fin'];
    $empresa=$_SESSION['empresa_area'];
    $year=$_SESSION['empresa_year'];
    $codigop=$_SESSION['empresa_proyecto'];
    
    $uno=$_SESSION['empresa_uno'];
    $dos=$_SESSION['empresa_dos'];

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

$query="select codigo from area where estado='a'";
$res=mysql_query($query,$conexion);

//creamos e iniciamos la cadena a convertir en json
$prefix='';

echo "[";

        
while( $res1=mysql_fetch_array($res) ) //while de las areas
{
    $codigo=$res1['codigo'];   
    
    $sql12="select sum(totalhoras) as total from ast inner join usuarios on user=usuario where area='$codigo' and cproyecto='$codigop' and fecha BETWEEN '$inicio' AND '$fin'";
    $otro=mysql_query($sql12,$conexion);
    $otro2=mysql_fetch_assoc($otro);
    $valor2=$otro2['total'];
    		
	echo $prefix . " {";
	echo '"tipo": "'.$codigo.'", ';

	if( $valor2 != NULL )
    {
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
			
			$valor2=$h;


			echo '"value1": '.$valor2.'';
    }
    else
    {
    	$cero=0;
		echo '"value1": '.$cero.'';
    }    
    echo " }";
    	
	$prefix = ",";

} //fin while de las areas

echo "]";



?>


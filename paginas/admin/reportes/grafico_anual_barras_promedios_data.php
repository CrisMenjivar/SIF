<?php
    
    include '../../../config/db.php';
     session_start();

	$year=$_SESSION['year'];
    $uno=$_SESSION['inicio'];
    $dos=$_SESSION['fin'];
    $area2=$_SESSION['tipo'];


    //guardar la conexion realizada al servidor de bases de datos en una variable
    $conexion=mysql_connect($servidor,$usuario,$contra) or die(mysql_error());

    //verificar si la conexion se realizo con exito
    if(!$conexion)
    {
        die("No se pudo conectar");
    }
    //Seleccionar la base de datos a las que nos conectaremos
    $bd=mysql_select_db($nombre_bd,$conexion) or die(mysql_error());


$color =array("#FF0F00","#FF6600","#FF9E01","#FCD202","#F8FF01","#B0DE09","#04D215","#0D8ECF","#0D52D1","#2A0CD0","#8A0CCF","#CD0D74");

//RECUPERAMOS LAS VARIABLES OBTENIDAS DE LA SELECCION DEL PERIODO PARA EL AST
     
    //calculamos los dias--------------------------------
    
    if( $uno < 10 )
            {
                $m1="0".$uno;
            }
            else
            {
                $m1=$uno;
            }
        
		 if( $dos < 10 )
            {
                $m2="0".$dos;
            }
            else
            {
                $m2=$dos;
            }

 
            switch ($dos)
            {
                Case 1:
                    $diaF="31";
                break;
                Case 2:
                    $diaF="28";
                break;
                Case 3:
                    $diaF="31";
                break;
                Case 4:
                    $diaF="30";
                break;
                Case 5:
                    $diaF="31";
                break;
                Case 6:
                    $diaF="30";
                break;
                Case 7:
                    $diaF="31";
                break;
                Case 8:
                    $diaF="31";
                break;
                Case 9:
                    $diaF="30";
                break;
                Case 10:
                    $diaF="31";
                break;
                Case 11:
                    $diaF="30";
                break;
                Case 12:
                    $diaF="31";
                break;
            }//fin switch

 
$query="select codigo from area where estado='a'";
$res=mysql_query($query,$conexion);

$cont=0;

//creamos e iniciamos la cadena a convertir en json
$prefix='';

echo "[";


while( $res1=mysql_fetch_array($res) ) //while de las areas
{
    $codigo=$res1['codigo'];    
    
    $sql12="select sum(ast.totalhoras) as total from ast inner join usuarios on user=usuario where area='$codigo' and fecha BETWEEN '$year-$m1-01' AND '$year-$m2-$diaF'";
    $otro=mysql_query($sql12,$conexion);
    $otro2=mysql_fetch_assoc($otro);
    $valor2=$otro2['total'];

	echo $prefix . " {";
	echo '"area": "'.$codigo.'", ';
	
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

			echo '"value1": '.$valor2.',';    
    }
    else
    {
        $cero=0;
		echo '"value1": '.$cero.',';
    }
    
    echo '"color": "'.$color[$cont].'"';
	echo " }";
	$cont++;
	
	if( $cont != 6 )
	{
	   echo ',';
	}
	
} //fin while de las actividades
    
echo "]";

?>



<?php
    
    //RECUPERAMOS LAS VARIABLES OBTENIDAS DE LA SELECCION DEL PERIODO PARA EL AST
    session_start();
    $anio=$_SESSION['year'];
    $mes=$_SESSION['mes'];
    $area=$_SESSION['area'];

    //--------------------------------------------------------------------------
    
    
    //calculamos los dias--------------------------------
    
    switch ($mes)
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
    }
     
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
    
$query="select codigo from area where estado='a'";
$res=mysql_query($query,$conexion);

//creamos e iniciamos la cadena a convertir en json
$prefix='';

echo "[";

        
while( $res1=mysql_fetch_array($res) ) //while de las empresas
{
    $codigo=$res1['codigo'];
    
    $sql12="select sum(totalhoras) as total from ast inner join usuarios on user=usuario where area='$codigo' and fecha BETWEEN '$anio-$mes-$diaI' AND '$anio-$mes-$diaF'";
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
 
   	echo ', "color": "#0d52d1"';
    	
   	echo " }";
   	
	$prefix = ",";
		
		
} //fin while de las actividades

echo "]";

?>

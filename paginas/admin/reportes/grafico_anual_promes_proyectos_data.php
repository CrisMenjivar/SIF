<?php
    
//RECUPERAMOS LAS VARIABLES OBTENIDAS DE LA SELECCION DEL PERIODO PARA EL AST
session_start();
$anio=$_SESSION['year'];
$inicio=$_SESSION['inicio'];
$fin=$_SESSION['fin'];
$area=$_SESSION['tipo'];
    
//--------------------------------------------------------------------------
    
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
    
    $meses=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
 
    $color =array("#FF0F00","#FF6600","#FF9E01","#FCD202","#F8FF01","#B0DE09","#04D215","#0D8ECF","#0D52D1","#2A0CD0","#8A0CCF","#CD0D74");

$cont=0;

//creamos e iniciamos la cadena a convertir en json
$prefix='';

echo "[";


        for( $y = $inicio ; $y <= $fin ; $y++)
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
    }
        
     
	
	echo $prefix . " {";
	echo '"mes": "'.$meses[$y-1].'", ';
	
	
            $sql2="select sum(totalhoras) as totales from ast inner join usuarios on user=usuario where cproyecto!='99' and fecha BETWEEN '$anio-$m1-$diaI' AND '$anio-$m1-$diaF'";
            
            $cuenta=mysql_query($sql2,$conexion);
    
            $valor=mysql_fetch_assoc($cuenta);
            $valor2=$valor['totales'];
            
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
	
	   if( $y != $fin)
	{
		echo ',';
	}

} //FIN DEL FOR y

echo "]";

?>

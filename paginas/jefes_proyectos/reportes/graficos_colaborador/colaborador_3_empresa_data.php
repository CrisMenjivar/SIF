<?php
    
//RECUPERAMOS LAS VARIABLES OBTENIDAS DE LA SELECCION DEL PERIODO PARA EL AST
    
    session_start();
    $inicio=$_SESSION['colaborador_inicio'];
    $fin=$_SESSION['colaborador_fin'];
    $area=$_SESSION['colaborador_area'];
    $colaborador=$_SESSION['colaborador_usuario'];
    $year=$_SESSION['colaborador_year'];
    
    $uno=$_SESSION['colaborador_uno'];
    $dos=$_SESSION['colaborador_dos'];

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
    
    //OBTENEMOS LOS DATOS SEGUN LA PETICION DEL REPORTE GENERAL O POR AREAS 
    
    $meses=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');

//creamos e iniciamos la cadena a convertir en json
$prefix='';

echo "[";

for( $y = $uno ; $y <= $dos ; $y++) //FOR QUE CONTROLA LOS MESES
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
	} //fin del switch
	
	echo $prefix . " {";
	echo '"mes": "'.$meses[$y-1].'" ';
		
	$query="select nombre from empresas where estado='a' order by nombre asc";
	$res=mysql_query($query,$conexion);
	$conta=1;

	while( $res1=mysql_fetch_array($res) ) //WHILE DE LAS EMPRESAS
	{
		echo ', ';
		
		$codigo=$res1['nombre'];

        $sql12="select sum(totalhoras) as total from ast inner join usuarios on user=usuario where usuario='$colaborador' and ast.empresa='$codigo' and ast.cproyecto!='99' and fecha BETWEEN '$year-$m1-$diaI' AND '$year-$m1-$diaF'";
		$otro=mysql_query($sql12,$conexion);
		$otro2=mysql_fetch_assoc($otro);
		$valor2=$otro2['total'];
		
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
			

			echo '"value'.$conta.'": '.$valor2.'';
		}
		else
		{
			$cero=0;
			echo '"value'.$conta.'": '.$cero.'';
		}
		$conta++;
	} //fin while de las actividades
	
	echo " }";
	$prefix = ",";
	
}//FIN DEL FOR DE LOS MESES ESTE CIERRA EL CICLO

echo "]";

?>



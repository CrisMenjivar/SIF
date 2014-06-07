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

//creamos e iniciamos la cadena a convertir en json
$prefix='';
echo "[";


for( $x = $uno ; $x <= $dos ; $x++ )
{
	$cont=1;
	
	if( $x < 10 )
	{
		$m1="0".$x;
	}
	else
	{
		$m1=$x;
	}
	
	switch ($x)
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

	$total="select SUM(totalhoras) as total from ast inner join usuarios on user=usuario where fecha BETWEEN '$year-$m1-$diaI' AND '$year-$m1-$diaF' ";
	$cuenta=mysql_query($total,$conexion);
	$valor=mysql_fetch_array($cuenta);
	$totales=$valor['total'];
	
	if( $totales != NULL)
	{
		//TIEMPO NO PRODUCTIVO
		$prueba1="select SUM(totalhoras) as total from ( select cproyecto,tipoact,totalhoras from ast inner join usuarios on user=usuario where cproyecto='99' and fecha BETWEEN '$year-$m1-$diaI' AND '$year-$m1-$diaF' ) as tabla where tipoact='3' OR tipoact='10' ";
		$otro1=mysql_query($prueba1,$conexion);
		$res1=mysql_fetch_array($otro1);
		$acceso1=$res1['total'];

		if( $acceso1 != NULL )
		{
			$prom1=$acceso1;
			
			$h=0;
			
			while( $prom1 != 0 )
			{
				if( $prom1 >= 60 )
				{
					$h=$h+1;
					$prom1=$prom1-60;
				}
				else
				{
				   if( $prom1 >= 10 )
				   {
				   		$h=$h.'.'.$prom1;
				   		$prom1=$prom1-$prom1;
				   }
				   else
				   {
				   		$h=$h.'.0'.$prom1;
				   		$prom1=$prom1-$prom1;
				   }
				}
			}
			
			$prom1=$h;

		}
		else
		{
			$prom1=0;
		}
		
		//===============================================================================================================================
		//TIEMPO DE PROYECTOS
		$prueba21="select SUM(totalhoras) as total from ( select cproyecto,tipoact,totalhoras from ast inner join usuarios on user=usuario where fecha BETWEEN '$year-$m1-$diaI' AND '$year-$m1-$diaF' ) as tabla where cproyecto!='99'";

		$otro21=mysql_query($prueba21,$conexion);
		$res21=mysql_fetch_array($otro21);
		$acceso21=$res21['total'];

		if( $acceso21 != NULL )
		{
			$prom21=$acceso21;
			
			$h=0;
			
			while( $prom21 != 0 )
			{
				if( $prom21 >= 60 )
				{
					$h=$h+1;
					$prom21=$prom21-60;
				}
				else
				{
				   if( $prom21 >= 10 )
				   {
				   		$h=$h.'.'.$prom21;
				   		$prom21=$prom21-$prom21;
				   }
				   else
				   {
				   		$h=$h.'.0'.$prom21;
				   		$prom21=$prom21-$prom21;
				   }
				}
			}
			
			$prom21=$h;

		}
		else
		{
			$prom21=0;
		}

		//===============================================================================================================================
		//TIEMPO ADMINISTRATIVO
		$prueba2="select SUM(totalhoras) as total from ( select cproyecto,tipoact,totalhoras from ast inner join usuarios on user=usuario where cproyecto='99' and fecha BETWEEN '$year-$m1-$diaI' AND '$year-$m1-$diaF' ) as tabla where tipoact='4' or tipoact='7' or tipoact='8' or tipoact='11' or tipoact='1' ";
	
		$otro2=mysql_query($prueba2,$conexion);
		$res2=mysql_fetch_array($otro2);
		$acceso2=$res2['total'];

		if( $acceso2 != NULL )
		{
			$prom2=$acceso2;
			
			$h=0;
			
			while( $prom2 != 0 )
			{
				if( $prom2 >= 60 )
				{
					$h=$h+1;
					$prom2=$prom2-60;
				}
				else
				{
				   if( $prom2 >= 10 )
				   {
				   		$h=$h.'.'.$prom2;
				   		$prom2=$prom2-$prom2;
				   }
				   else
				   {
				   		$h=$h.'.0'.$prom2;
				   		$prom2=$prom2-$prom2;
				   }
				}
			}
			
			$prom2=$h;

		}
		else
		{
			$prom2=0;
		}
		
		//==============================================================================================================================
		//TIEMPO DE MANTENIMIENTOS
		$prueba3="select SUM(totalhoras) as total from ( select cproyecto,tipoact,totalhoras from ast inner join usuarios on user=usuario where cproyecto='99' and fecha BETWEEN '$year-$m1-$diaI' AND '$year-$m1-$diaF' ) as tabla where tipoact='9' ";

		$otro3=mysql_query($prueba3,$conexion);
		$res3=mysql_fetch_array($otro3);
		$acceso3=$res3['total'];

		if( $acceso3 != NULL )
		{
			$prom3=$acceso3;
			
			$h=0;
			
			while( $prom3 != 0 )
			{
				if( $prom3 >= 60 )
				{
					$h=$h+1;
					$prom3=$prom3-60;
				}
				else
				{
				   if( $prom3 >= 10 )
				   {
				   		$h=$h.'.'.$prom3;
				   		$prom3=$prom3-$prom3;
				   }
				   else
				   {
				   		$h=$h.'.0'.$prom3;
				   		$prom3=$prom3-$prom3;
				   }
				}
			}
			
			$prom3=$h;

		}
		else
		{
			$prom3=0;
		}
		
		//==============================================================================================================================
		//TIEMPO DE FALLAS
		$prueba4="select SUM(totalhoras) as total from ( select cproyecto,tipoact,totalhoras from ast inner join usuarios on user=usuario where cproyecto='99' and fecha BETWEEN '$year-$m1-$diaI' AND '$year-$m1-$diaF' ) as tabla where tipoact='6' ";
		$otro4=mysql_query($prueba4,$conexion);
		$res4=mysql_fetch_array($otro4);
		$acceso4=$res4['total'];

		if( $acceso4 != NULL )
		{
			$prom4=$acceso4;
			
			$h=0;
			
			while( $prom4 != 0 )
			{
				if( $prom4 >= 60 )
				{
					$h=$h+1;
					$prom4=$prom4-60;
				}
				else
				{
				   if( $prom4 >= 10 )
				   {
				   		$h=$h.'.'.$prom4;
				   		$prom4=$prom4-$prom4;
				   }
				   else
				   {
				   		$h=$h.'.0'.$prom4;
				   		$prom4=$prom4-$prom4;
				   }
				}
			}
			
			$prom4=$h;

		}
		else
		{
			$prom4=0;
		}
		
		//=============================================================================================================================
		//TIEMPO DE ATENCION Y SOPORTE
		$prueba5="select SUM(totalhoras) as total from ( select cproyecto,tipoact,totalhoras from ast inner join usuarios on user=usuario where cproyecto='99' and fecha BETWEEN '$year-$m1-$diaI' AND '$year-$m1-$diaF' ) as tabla where tipoact='2' or tipoact='12' ";
		$otro5=mysql_query($prueba5,$conexion);
		$res5=mysql_fetch_array($otro5);
		$acceso5=$res5['total'];

		if( $acceso5 != NULL )
		{
			$prom5=$acceso5;
			
			$h=0;
			
			while( $prom5 != 0 )
			{
				if( $prom5 >= 60 )
				{
					$h=$h+1;
					$prom5=$prom5-60;
				}
				else
				{
				   if( $prom5 >= 10 )
				   {
				   		$h=$h.'.'.$prom5;
				   		$prom5=$prom5-$prom5;
				   }
				   else
				   {
				   		$h=$h.'.0'.$prom5;
				   		$prom5=$prom5-$prom5;
				   }
				}
			}
			
			$prom5=$h;

		}
		else
		{
			$prom5=0;
		}
		
		//============================================================================================================================
		//TIEMPO DE CORREO
		$prueba6="select SUM(totalhoras) as total from ( select cproyecto,tipoact,totalhoras from ast inner join usuarios on user=usuario where cproyecto='99' and fecha BETWEEN '$year-$m1-$diaI' AND '$year-$m1-$diaF' ) as tabla where tipoact='5' ";
		$otro6=mysql_query($prueba6,$conexion);
		$res6=mysql_fetch_array($otro6);
		$acceso6=$res6['total'];

		if( $acceso6 != NULL )
		{
			$prom6=$acceso6;
			
			$h=0;
			
			while( $prom6 != 0 )
			{
				if( $prom6 >= 60 )
				{
					$h=$h+1;
					$prom6=$prom6-60;
				}
				else
				{
				   if( $prom6 >= 10 )
				   {
				   		$h=$h.'.'.$prom6;
				   		$prom6=$prom6-$prom6;
				   }
				   else
				   {
				   		$h=$h.'.0'.$prom6;
				   		$prom6=$prom6-$prom6;
				   }
				}
			}
			
			$prom6=$h;

		}
		else
		{
			$prom6=0;
		}
		
		echo $prefix . " {";
		echo '"mes": "'.$meses[$x-1].'", ';
		
		echo '"value'.$cont.'": '.$prom2.', ';
		$cont=$cont+1;
		
		echo '"value'.$cont.'": '.$prom21.', ';
		$cont=$cont+1;
		
		echo '"value'.$cont.'": '.$prom1.', ';
		$cont=$cont+1;
		
		echo '"value'.$cont.'": '.$prom3.', ';
		$cont=$cont+1;
		
		echo '"value'.$cont.'": '.$prom4.', ';
		$cont=$cont+1;
		
		echo '"value'.$cont.'": '.$prom5.', ';
		$cont=$cont+1;
		
		echo '"value'.$cont.'": '.$prom6.'';
		//$cont=$cont+1;
		echo " }";
		
		if( $x != $dos )
		{
			$prefix = ",";
		}
				
	}//FIN IF QUE COMPRUEBA TOTALES ES DECIR QUE EL MES ESTA VACIO O NO
	else
	{
		$cero=0;
		
		echo $prefix . " {";
		echo '"mes": "'.$meses[$x-1].'", ';
		
		echo '"value'.$cont.'": '.$cero.', ';
		$cont=$cont+1;
		
		echo '"value'.$cont.'": '.$cero.', ';
		$cont=$cont+1;
		
		echo '"value'.$cont.'": '.$cero.', ';
		$cont=$cont+1;
		
		echo '"value'.$cont.'": '.$cero.', ';
		$cont=$cont+1;
		
		echo '"value'.$cont.'": '.$cero.', ';
		$cont=$cont+1;
		
		echo '"value'.$cont.'": '.$cero.', ';
		$cont=$cont+1;
		
		echo '"value'.$cont.'": '.$cero.'';
		
		echo " }";
	    
	    if( $x != $dos )
		{
			$prefix = ",";
		}

	}
	
} //FIN DEL FOR DE LOS MESES

echo "]";


?>



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

$servidor=$_SESSION['grafico_servidor'];
$usuario=$_SESSION['grafico_usuario'];
$contra=$_SESSION['grafico_pass'];
$nombre_bd=$_SESSION['grafico_bd'];


    //--------------------------------------------------------------------------
    
    //include '../../../config/db.php';

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
        
    
    
    switch ($dos)
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

$query="select correlativo from proyectos where correlativo!='NO_ES_PROYECTO' ";
$res=mysql_query($query,$conexion);

$xy=0;
        
while( $res1=mysql_fetch_array($res) ) //while de los proyectos
{
    $codigo=$res1['correlativo'];                   
    $suma=0;     
    $suma1="select SUM(totalhoras) as totales from ast where usuario='$colaborador' and cproyecto='$codigo' and fecha BETWEEN '$year-$m1-$diaI' AND '$year-$m2-$diaF'";
    $suma2="select count(totalhoras) as totales from ast where usuario='$colaborador' and cproyecto='$codigo' and fecha BETWEEN '$year-$m1-$diaI' AND '$year-$m2-$diaF'";
    //$sql1="select * from ( select tipoact as actividad, sum(ast.totalhoras) as total from ast inner join usuarios on usuario=user where usuario='$colaborador' and cproyecto='$codigo' and fecha BETWEEN '$year-$m1-$diaI' AND '$year-$m2-$diaF' group by tipoact ASC ) as temporal";
    //$sql="select actividad,SUM(totales) as total from ( select fecha as fechas,ast.usuario as userf,cproyecto as proyect, tipoact as actividad,totalhoras as totales from ast inner join usuarios on usuario=user where cproyecto='$codigo' and fecha BETWEEN '$inicio' AND '$fin') as temporal where userf='$colaborador' group by proyect,actividad ASC";
    
    $sum2=mysql_query($suma2,$conexion);
    $s2=mysql_fetch_array($sum2);
    $tot=$s2['totales'];
    
    if( $tot != 0 )
    {
        $sum1=mysql_query($suma1,$conexion);    
        $s1=mysql_fetch_assoc($sum1);
        $total=$s1['totales'];
            
        $datos[$xy][0]=$codigo;

        $acti="select tipoact from actividad";
        $res2=mysql_query($acti,$conexion);
        
        $k=1;
        
        while( $res3=mysql_fetch_array($res2) ) //while de los actividades
        {
            $tipo=$res3['tipoact'];
            
            $opciones1="SELECT tipoact as actividad,sum(totalhoras) as total FROM `ast` WHERE usuario='$colaborador' and tipoact='$tipo' and cproyecto='$codigo'and fecha between '$year-$m1-$diaI' and '$year-$m2-$diaF' group by tipoact";
            $opciones2="SELECT count(tipoact) as cuenta FROM `ast` WHERE usuario='$colaborador' and tipoact='$tipo' and cproyecto='$codigo' and fecha between '$year-$m1-$diaI' and '$year-$m2-$diaF' ";
            
            $opcion2=mysql_query($opciones2,$conexion);
            $op2=mysql_fetch_array($opcion2);
            $acceso=$op2['cuenta'];

            if( $acceso != 0 )
            {
                $opcion1=mysql_query($opciones1,$conexion);
                $op1=mysql_fetch_array($opcion1);
                $valor=$op1['total'];
                
                $valor2=intval( round( ( ($valor/$total)*100 ) ) );
    
                $datos[$xy][$k]=$valor2;
                $suma=$suma+$valor2;
                $k++;
            }
            else
            {
                $datos[$xy][$k]=0;
                $k++;
            }
            
        }//fin while actividades
        
if( $suma > 100 )
{
  $paso=$suma-100;
  $flag=0;
  $max=0;
  
  for( $j=1 ; $j<$k ; $j++ )
  {
    if( $datos[$xy][$j] != 0 )
	{
	   if( $datos[$xy][$j] > $max )
	   {
	      $max=$datos[$xy][$j];
		  $flag=$j;
	   }//fin if ubicar el valor mayor
	}//fin if diferente de cero
  }//fin for para encontrar el valor mayor
  
  $datos[$xy][$flag]=$datos[$xy][$flag]-$paso;

}//fin IF SI SUMA MAYOR A 100

if( $suma < 100 )
{
  $falta=100-$suma;
  $two=0;
  $b=10000;
  $flag=0;
  
  for( $j=1 ; $j<$k ; $j++ )
  {
     if( $datos[$xy][$j] != 0 )
     {
        if( $b > $datos[$xy][$j] )
        {
           $b = $datos[$xy][$j];
           $flag=$j;
        } 
     }//fin if valor diferente de cero
  } //fin for para encontrar el menor valor
  
  for( $R=1 ; $R<$k ; $R++ )
  {
     if( $two == 0 )
     {
       if( $flag == $R )
       {
          $datos[$xy][$R]=$datos[$xy][$R]+$falta;
          $two++;
       }//fin if valor diferente de cero
     }//fin if sumar una sola vez
  } //fin for para sumarle el valor
}//FIN IF LE HIZO FALTA PARA EL 100%
		
        $xy++;
    }// fin if q valida que existan actividades en el proyecto seleccionado
}//fin while proyectos
    
        
$otro1="select tipoact from actividad";
$otro2=mysql_query($otro1,$conexion);

for($x = 0 ; $x < mysql_num_rows($otro2) ; $x++)
{ 
    $fila = mysql_fetch_assoc($otro2);
    $name=strtr($fila['tipoact'],'_',' ');
    $nombres[$x]=$name;
} //fin for x

$colaborador=strtr($colaborador,'_',' ');
$colaborador=ucwords($colaborador);            
$titulo="Promedio HH por proyectos -- ".$colaborador;
//---------------------------------------------------
    
require_once '../phplot/phplot.php';


$plot = new PHPlot(750,450);
$plot->SetImageBorderType('plain');
$plot->SetDataType('text-data-yx');
$plot->SetDataValues($datos);
$plot->SetPlotType('stackedbars');
$plot->SetRGBArray('large');
$colors = array('LightSkyBlue','PaleGreen','YellowGreen','violet','grey73','turquoise2','MediumOrchid','CornflowerBlue','aquamarine2','DarkOrange','AntiqueWhite3','khaki1','RoyalBlue','HotPink2','DarkKhaki','tan3','tomato1','DarkGoldenrod2','OliveDrab3');

//$colors = array('violet','peru','SkyBlue','LimeGreen','purple','red', 'green', 'blue', 'yellow','cyan','orange','brown','maroon','gray','navy','pink1','chocolate1','magenta','salmon','maroon','lavender','navy');
//$nombres=array('A','B','C','D','E');
$plot->SetDataColors($colors);
//$plot->SetLegendWorld(10, 5); 
//$plot->SetLegendPosition(3, 2, 'plot', 1, 0, -5, 5);
$plot->SetBackgroundColor('white');
$plot->SetLegend($nombres);
$plot->SetLegendPixels(605, 26);
//$plot->SetMarginsPixels(-140,0,0,0);
//$plot->SetShading(0);
//$plot->SetLabelScalePosition(0.4);
$plot->SetShading(1);
# Show data value labels:
$plot->SetXDataLabelPos('plotstack');
$plot->SetTitle($titulo);
$plot->SetTitleColor('blue'); //color del titulo superior
$plot->SetXTitle('Porcentajes'); 
$plot->SetXTitleColor('blue'); //color del titulo inferior
$plot->SetDataValueLabelColor('black'); //color para valores dentro de las barras
$plot->SetDataLabelColor('blue'); //color para variables eje Y

$plot->SetFont('y_label',5, 15, NULL); // para regular tamano de fuente en eje y
$plot->SetFont('x_label',4,1, NULL); // para regular tamano de fuente en eje x
$plot->SetFont('title',5, 25, NULL); //para regular tamano de fuente en titulo
//$plot->SetFont($elem, $font, [$size], [$line_spacing])
//-------------------------------------------------------------------------

//$plot->SetPlotAreaWorld(NULL, NULL, NULL, NULL);
$plot->SetPlotAreaPixels(NULL,NULL, 598, NULL);

//-------------------------------------------------------------------------
# Rotate data value labels to 90 degrees:
$plot->SetXDataLabelAngle(0); //para colocar los datos en forma vertical

# Format the data value labels with 1 decimal place:
$plot->SetXDataLabelType('data', 0);

# Specify a whole number for the X tick interval:
$plot->SetSkipRightTick(1);
$plot->SetXTickIncrement(10);
$plot->SetXTickAnchor(0);
$plot->SetYTickCrossing(100);

# Disable the Y tick marks:
$plot->SetYTickPos('none');
//$plot->SetXTickLabelPos('none');
//$plot->SetXTickPos('none');


$plot->DrawGraph();

?>



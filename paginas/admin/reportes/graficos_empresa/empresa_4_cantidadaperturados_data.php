<?php
    
//RECUPERAMOS LAS VARIABLES OBTENIDAS DE LA SELECCION DEL PERIODO PARA EL AST
    session_start();
    $inicio=$_SESSION['empresa_inicio'];
    $fin=$_SESSION['empresa_fin'];
    $empresa=$_SESSION['empresa_area'];
    $year=$_SESSION['empresa_year'];
    $codigo=$_SESSION['empresa_proyecto'];
    
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

	$color = array(	
					'LightSkyBlue',
					'#EEEE00',
					'#DBDB70',
					'#FF3E96',
					'#C0C0C0',
					'#00FF7F',
					'#32CD32',
					'#99CC32',
					"#CA9726",
					'PaleGreen',
					'#FF0F00',
					'#9370DB',
					
					
					'#238E68',
					'orange',
					'#4876FF',
					'#D98719',
					"#CA9726",
					"#0D52D1"
				);


$cont=0;

//creamos e iniciamos la cadena a convertir en json
$prefix='';

echo "[";

   
$query="select nombre from empresas where estado='a'";
$res=mysql_query($query,$conexion);
        
while( $res1=mysql_fetch_array($res) ) //while de las empresas
{
    $empresa=$res1['nombre'];    
    
    $sql12="select count(correlativo) as total from proyectos where empresa='$empresa' and finicio BETWEEN '$inicio' AND '$fin'";
    $otro=mysql_query($sql12,$conexion);
    $otro2=mysql_fetch_assoc($otro);
    $valor2=$otro2['total'];
        
    echo $prefix . " {";
	echo '"empresa": "'.$empresa.'", ';
        
    echo '"value1": '.$valor2.',';

	echo '"color": "'.$color[$cont].'"';
	echo " }";
	$cont++;	  
    
    echo ',';
    
} //fin while de las actividades
    
echo "]";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Sin título 1</title>

<script language="javascript" type="text/javascript" src="../../../../js/seguridad.js"></script>

<link rel="stylesheet" href="../../../../estilo/amchar_style.css" type="text/css" />
<script src="../../../../js/amcharts/amcharts.js" type="text/javascript"></script>
<script src="../../../../js/amcharts/serial.js" type="text/javascript"></script>

<!--[if (!IE) | (gte IE 10)]> -->
        <script src="../../../../js/amcharts/exporting/amexport.js" type="text/javascript"></script>
        <script src="../../../../js/amcharts/exporting/rgbcolor.js" type="text/javascript"></script>
        <script src="../../../../js/amcharts/exporting/canvg.js" type="text/javascript"></script>
        <script src="../../../../js/amcharts/exporting/jspdf.js" type="text/javascript"></script>
        <script src="../../../../js/amcharts/exporting/filesaver.js" type="text/javascript"></script>
        <script src="../../../../js/amcharts/exporting/jspdf.plugin.addimage.js" type="text/javascript"></script>
        <!-- <![endif]-->


<?php
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

session_start();
$empresa=$_SESSION['empresa_area'];

echo '
	<!-- custom functions -->
	<script>
		AmCharts.loadJSON = function(url) 
		{
			// create the request
  			if (window.XMLHttpRequest) 
  			{
    		
    			// IE7+, Firefox, Chrome, Opera, Safari
    			var request = new XMLHttpRequest();
  			} 
  			else 
  			{
    			// code for IE6, IE5
    			var request = new ActiveXObject("Microsoft.XMLHTTP");
  			}

  			// load it
  			// the last "false" parameter ensures that our code will wait before the
  			// data is loaded
  			request.open("GET", url, false);
  			request.send();

  			// parse adn return the output
  			return eval(request.responseText);
		}; //fin funcion AMCHARTS.LOADJSON
	</script>
	';
?>

<?php
    //$color = array('#CD853F','#912CEE','#436EEE','red','#7A67EE','green','Aqua','#D9D919','#238E23','#C0C0C0','#9370DB ','orange','#238E68','#99CC32','#EEEE00','#EE3A8C','#00C5CD');
  	//$color = array('LightSkyBlue','PaleGreen','YellowGreen','violet','CornflowerBlue','aquamarine','DarkOrange','RoyalBlue','HotPink','DarkKhaki','DarkGoldenrod','OliveDrab');
	
	$color = array(
					'LightSkyBlue',
					'#EEEE00',
					'#DBDB70',
					'#FF3E96',
					'#C0C0C0',
					'#00FF7F',
					'#32CD32',
					'#99CC32',
					'orange',	
					'#9370DB',
					'#CA9726',
					'#FF0F00',
					'#238E68',
					'#DB9370',
					'#4876FF'
				);

	echo 	'<!-- the chart code -->
  			<script>
  	
			var chart;

			// create chart
			AmCharts.ready(function() 
			{
  				
  				
  				
  				// load the data
  				var chartData = AmCharts.loadJSON("empresa_3_actividad_data.php");
  				
  				// SERIALL CHART
        	    chart = new AmCharts.AmSerialChart();
        	    chart.dataProvider = chartData;
        	    chart.addTitle("Promedio HH por proyecto - '.$empresa.'",20,"#CC0000",1,true);
        	    
        	    chart.exportConfig = {
                    menuTop: "32px",
                    menuBottom: "auto",
                    menuRight: "245px",
                    backgroundColor: "#efefef",

                    menuItemStyle	: {
                    backgroundColor			: '."'#EFEFEF'".',
                    rollOverBackgroundColor	: '."'#DDDDDD'".'},

                    menuItems: [{
                        textAlign: '."'center'".',
                         icon: '."'../../../../js/amcharts/images/export.png'".',
                        onclick:function(){},
                        items: [{
                            title: '."'JPG'".',
                            format: '."'jpg'".'
                        }, {
                            title: '."'PNG'".',
                            format: '."'png'".'
                        }, {
                            title: '."'PDF'".',
                            format: '."'pdf'".'
                        }]
                    }]
                }

				
        	    chart.categoryField = "proyecto";
        	    chart.plotAreaBorderAlpha = 0.2;
        	    chart.rotate = true;
  				
  				// AXES
        	    // Category
        	    var categoryAxis = chart.categoryAxis;
        	    categoryAxis.gridAlpha = 0.1;
        	    categoryAxis.axisAlpha = 0;
        	    categoryAxis.gridPosition = "start";
	
        	    // value
        	    var valueAxis = new AmCharts.ValueAxis();
        	    valueAxis.stackType = "100%";
        	    valueAxis.gridAlpha = 0.1;
        	    valueAxis.axisAlpha = 0;
        	    chart.addValueAxis(valueAxis); 
			'; //fin ECHO
	
	$query="select tipoact,nombre from actividad order by nombre asc";
	$res=mysql_query($query,$conexion);
    
    $cont=0;
    
	while( $res1=mysql_fetch_array($res) ) //WHILE DE LAS ACTIVIDADES
	{
		$codigo=$res1['nombre'];
		$codigo=utf8_encode($codigo); //decodificamos los valores devueltos por la base para poder usarlos
		$codigo=str_replace('_',' ',$codigo);
		$codigo=str_replace('á','\u00E1',$codigo);
		$codigo=str_replace('é','\u00E9',$codigo);
		$codigo=str_replace('í','\u00ED',$codigo);
		$codigo=str_replace('ó','\u00F3',$codigo);
		$codigo=str_replace('Ã³','\u00F3',$codigo);
		$codigo=str_replace('?','\u00F3',$codigo);
		$codigo=str_replace('Ó','\u00F3',$codigo);
		$codigo=str_replace('ú','\u00FA',$codigo);
		$codigo=str_replace('ñ','\u00F1',$codigo);
		
		
		
		echo '
                var graph = new AmCharts.AmGraph();
                graph.title = "'.$codigo.'";
                graph.labelText = "[[percents]]%";
                graph.valueField = "value'.$res1['tipoact'].'";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 1;
                graph.lineColor = "'.$color[$cont].'";
                graph.balloonText = "<b><span style='."'color:".'black'."'".'>[[title]]</b></span><br><span style='."'font-size:14px'".'>[[category]]: <b>[[value]] Horas</b> - ([[percents]]%)</span>";
                chart.addGraph(graph);
			 ';//FIN ECHO
		
		$cont=$cont+1;
	}
	
	echo '
			// LEGEND
                var legend = new AmCharts.AmLegend();
                legend.position = "right";
                legend.borderAlpha = 0.3;
                legend.horizontalGap = 10;
                legend.switchType = "v";
                chart.balloonText = "[[title]]<br><span style='."'font-size:14px'".'><b>[[value]]</b> ([[percents]]%)</span>";
                chart.addLegend(legend);

                chart.creditsPosition = "top-right";                
                

                // WRITE
                chart.write("chartdiv");
                
            }); //FIN AMCHAR READY FUNCTION
            
            // Make chart 2D/3D
            function setDepth() {
                if (document.getElementById("rb1").checked) {
                    chart.depth3D = 0;
                    chart.angle = 0;
                } else {
                    chart.depth3D = 10;
                    chart.angle = 20;
                }
                chart.validateNow();
            }


		 ';
	echo '</script>';
?>
  	
  			
	



</head>

<body>

	<div id="chartdiv" style="width: 990px; height: 470px;"></div>
        <!--
        <div style="margin-left:40px;">
            <input type="radio" checked="checked" name="group" id="rb1" onclick="setDepth()" />2D
            <input type="radio" name="group" id="rb2" onclick="setDepth()" />3D
		</div>
		-->
</body>

</html>

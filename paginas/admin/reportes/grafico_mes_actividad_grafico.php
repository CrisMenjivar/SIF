<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Sin título 1</title>

<script language="javascript" type="text/javascript" src="../../../js/seguridad.js"></script>

<link rel="stylesheet" href="../../../estilo/amchar_style.css" type="text/css" />
<script src="../../../js/amcharts/amcharts.js" type="text/javascript"></script>
<script src="../../../js/amcharts/pie.js" type="text/javascript"></script>



<!--[if (!IE) | (gte IE 10)]> -->         
		<script src="../../../js/amcharts/exporting/amexport.js" type="text/javascript"></script>
        <script src="../../../js/amcharts/exporting/rgbcolor.js" type="text/javascript"></script>
        <script src="../../../js/amcharts/exporting/canvg.js" type="text/javascript"></script>
        <script src="../../../js/amcharts/exporting/jspdf.js" type="text/javascript"></script>
        <script src="../../../js/amcharts/exporting/filesaver.js" type="text/javascript"></script>
        <script src="../../../js/amcharts/exporting/jspdf.plugin.addimage.js" type="text/javascript"></script>
        <!-- <![endif]-->


<?php

session_start();
$area=$_SESSION['area'];


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
					'PaleGreen',
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
  				var chartData = AmCharts.loadJSON("grafico_mes_actividad_data.php");
  				
  				// PIE CHART
                chart = new AmCharts.AmPieChart();
                chart.dataProvider = chartData;
                chart.titleField = "tipo";
                chart.valueField = "value1";
				
				chart.depth3D = 10;
                chart.angle = 10;				
				                
				                
        	    chart.addTitle("Utilizaci\u00F3n HH por actividad - '.$area.'",20,"#CC0000",1,true);
        	    
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
                         icon: '."'../../../js/amcharts/images/export.png'".',
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

				// LEGEND
                var legend = new AmCharts.AmLegend();
                //legend.align = "center";
                legend.markerType = "circle";
                chart.balloonText = "[[title]]<br><span style='."'font-size:14px'".'><b>[[value]] Horas</b> : ([[percents]]%)</span>";
                //chart.addLegend(legend);
                
                legend.position = "right";
                legend.borderAlpha = 0.3;
                legend.horizontalGap = 10;
                legend.switchType = "v";
                chart.addLegend(legend);

                chart.creditsPosition = "top-right";
        	    

                // WRITE
                chart.write("chartdiv");
                
            }); //FIN AMCHAR READY FUNCTION

		 ';
	echo '</script>';
?>
  	

</head>

<body>

	<div id="chartdiv" style="width: 990px; height: 470px;"></div>

</body>

</html>





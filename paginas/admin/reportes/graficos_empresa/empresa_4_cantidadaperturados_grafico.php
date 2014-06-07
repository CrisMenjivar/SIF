<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Sin título 1</title>

<script language="javascript" type="text/javascript" src="../../../../js/seguridad.js"></script>

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
 
	echo 	'<!-- the chart code -->
  			<script>
  	
			var chart;

			// create chart
			AmCharts.ready(function() 
			{
  				
  				
  				
  				// load the data
  				var chartData = AmCharts.loadJSON("empresa_4_cantidadaperturados_data.php");
  				
  				// SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "empresa";
                chart.startDuration = 1;
                chart.addTitle("Total de proyectos aperturados por empresa",20,"#CC0000",1,true);
  				
  				chart.exportConfig = {
                    menuTop: "32px",
                    menuBottom: "auto",
                    menuRight: "65px",
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

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.labelRotation = 90; // this line makes category values to be rotated
                categoryAxis.gridAlpha = 0;
                categoryAxis.fillAlpha = 1;
                categoryAxis.fillColor = "#FAFAFA";
                categoryAxis.gridPosition = "start";

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.dashLength = 5;
                //valueAxis.title = "Visitors from country";
                valueAxis.axisAlpha = 0;
                chart.addValueAxis(valueAxis);

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.valueField = "value1";
                graph.colorField = "color";
                graph.balloonText = "<b>[[category]]: Aperturados [[value]]</b>";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 1;
                chart.addGraph(graph);

                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chartCursor.cursorAlpha = 0;
                chartCursor.zoomable = false;
                chartCursor.categoryBalloonEnabled = false;
                chart.addChartCursor(chartCursor);

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

	<div id="chartdiv" style="width: 890px; height: 470px;margin-left:40px;"></div>
        <!--
        <div style="margin-left:40px;">
            <input type="radio" checked="checked" name="group" id="rb1" onclick="setDepth()" />2D
            <input type="radio" name="group" id="rb2" onclick="setDepth()" />3D
		</div>
		-->
</body>

</html>

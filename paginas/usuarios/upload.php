<?php

include '../../config/db.php';

//guardar la conexion realizada al servidor de bases de datos en una variable
$conexion=mysql_connect($servidor,$usuario,$contra) or die(mysql_error());

//verificar si la conexion se realizo con exito
if(!$conexion)
{
die("No se pudo conectar");
}
//Seleccionar la base de datos a las que nos conectaremos
$bd=mysql_select_db($nombre_bd,$conexion) or die(mysql_error());

//Verificamos que el usuario haya iniciado sesion
session_start();
if($_SESSION['user']=="")
{
header ("Location: ../../index.php");
}
else
{
$ver=$_SESSION['user'];

$change="select admin from usuarios where user='$ver' ";
$verify = mysql_query($change,$conexion);
$move=mysql_fetch_array($verify);

if($move['admin']=="3")
{
header ("Location: ../jefes/ast.php");
}

if($move['admin']=="1")
{
header ("Location: ../admin/menuadmin.php");
}

if($move['admin']=="4")
{
header ("Location: ../jefes_proyectos/ast.php");
}

}//fin else



//===================================================================================================================

$tipe=$_POST['tipo'];
$idioma=$_POST['idioma'];

//incluimos la clase
require_once '../../PHPExcel_1.7.9/Classes/PHPExcel/IOFactory.php';

//cargamos el archivo que deseamos leer

//$objPHPExcel = PHPExcel_IOFactory::load('xls/prueba.xls');

$archivosss = $_FILES['archivo']['tmp_name'];
$tipoExcel = $_FILES["archivo"]['type'];

$ext = substr($_FILES['archivo']['name'], strrpos($_FILES['archivo']['name'],'.'));

//application/vnd.ms-excel     application/excel
//http://www.htmlquick.com/es/reference/mime-types.html
//http://es.softuses.com/129083

$fechaE = "";
$inicioE = "";
$finE = "";
$descripcionE = "";


    //INICIA EL CODIGO SI EL ARCHIVO EXCEL ES DE MAC .XLSX **************************************************************
    //INICIA EL CODIGO SI EL ARCHIVO EXCEL ES DE MAC .XLSX **************************************************************
    //INICIA EL CODIGO SI EL ARCHIVO EXCEL ES DE MAC .XLSX **************************************************************

    if( $tipoExcel == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" and $tipe == 2 and $idioma = "espanol" )
    {

        $objPHPExcel = PHPExcel_IOFactory::load( $archivosss );

        //obtenemos los datos de la hoja activa (la primera)
        $objHoja=$objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

        //recorremos las filas obtenidas

        foreach ($objHoja as $iIndice=>$objCelda)
        {
             $celda = $objCelda['A'] ; //imprimimos el contenido de la celda utilizando la letra de cada columna

            if( $iIndice == 1 ) //primera iteracion
            {
                $descripcionE =  $celda;
            }//fin if primera iteracion
            else //si no es la primera iteracion
            {
                if( $descripcionE == "" ) //verificamos si esta llena la descripcion para llenarla
                {
                    $descripcionE =  $celda;
                }
                else //si descripcion esta llena significa que llenaremos hora y mes
                {    
                    //si los campos estan vacios los llenamos
                    if( $fechaE == "" and $inicioE == "" and $finE == "" )
                    {     
                        $tipoSave= $celda[0]. $celda[1]. $celda[2]. $celda[3]. $celda[4]. $celda[5]. $celda[6]. $celda[7]. $celda[8]. $celda[9]. $celda[10];
             
                        if( $tipoSave == "planificado" ) //verificamos que sea tipo planificado para q contenga fecha y horas
                        {
                             $rec = 12;
                             $dd = "";
                             $mm = "";
                             $aa = "";
                             $ii = "";
                             $ff = "";
              
                             while(  $celda[$rec] != " ") //recorremos para obtener el dia
                             {
                                 $dd  = $dd .  $celda[$rec];
                                 $rec = $rec + 1;
                             }
                             
                             $rec = $rec + 4;
                             
                             while(  $celda[$rec] != " ") //recorremos para obtener el mes
                             {
                                 $mm  = $mm. $celda[$rec];
                                 $rec = $rec + 1;
                             }
                             
                             $rec = $rec + 4;
                             
                             while(  $celda[$rec] != " ") //recorremos para obtener el anio
                             {
                                 $aa  = $aa. $celda[$rec];
                                 $rec = $rec + 1;
                             }
                             
                             $rec = $rec + 7;
                             
                             while(  $celda[$rec] != " ") //recorremos para obtener la hora de inicio
                             {
                                 $ii  = $ii. $celda[$rec];
                                 $rec = $rec + 1;
                             }
                             
                             $rec = $rec + 7;
                             
                             $end = strlen( $celda);
                             
                             $pp='1';
                             
                             while( $pp ) //recorremos para obtener la hora de fin
                             {
                                 $ff  = $ff. $celda[$rec];
                                 $rec = $rec + 1;
                                 
                                 if( $rec > $end-1 )
                                 {
                                     $pp = 0;
                                 }
                             }
                             
                             //preparemos el mes convertirlo de letra a numero
                             switch($mm)
                             {
                                Case "enero":
                                             $mmm="01";
                                break;
                                Case "febrero":
                                             $mmm="02";
                                break;
                                Case "marzo":
                                             $mmm="03";
                                break;
                                Case "abril":
                                             $mmm="04";
                                break;
                                Case "mayo":
                                             $mmm="05";
                                break;
                                Case "junio":
                                             $mmm="06";
                                break;
                                Case "julio":
                                             $mmm="07";
                                break;
                                Case "agosto":
                                             $mmm="08";
                                break;
                                Case "septiembre":
                                             $mmm="09";
                                break;
                                Case "octubre":
                                             $mmm="10";
                                break;
                                Case "noviembre":
                                             $mmm="11";
                                break;
                                Case "diciembre":
                                             $mmm="12";
                                break;
                             }//fin switch
                             
                             $dates = $aa .'-' . $mmm . '-' . $dd;
                             
                             $fechaE  = $dates;
                             $inicioE = $ii;
                             $finE    = $ff;
             
                        }//fin if tipo == planificado
                        else //si no es planificado ES PROGRAMADA
                        {
                            $fechaE  = "fecha";
                            $inicioE = "inicio";
                            $finE    = "fin";
                            
                            //********************************
                            //INICIA TIPO ACTIVIDAD PROGRAMADA
                            //********************************
             
                            $tipoSave= $celda[0]. $celda[1]. $celda[2]. $celda[3]. $celda[4]. $celda[5]. $celda[6]. $celda[7]. $celda[8]. $celda[9];
                         
                            if( $tipoSave == "Programado" ) //verificamos que sea tipo planificado para q contenga fecha y horas
                            {
                                $rec = 16;
                                $fechaE  = "";
                                $inicioE = "";
                                $finE    = "";
                                                                
                                $fechaE  =  $celda[22]. $celda[23]. $celda[24]. $celda[25]."-". $celda[19]. $celda[20]."-". $celda[16]. $celda[17];
                         
                                for( $ct = 27 ; $ct <= 34 ; $ct++ ) //recorremos para obtener la fecha
                                {
                                    $inicioE  = $inicioE .  $celda[$ct];
                                }
                                
                                for( $ct = 39 ; $ct <= 46 ; $ct++ ) //recorremos para obtener la fecha
                                {
                                    $finE  = $finE .  $celda[$ct];
                                }
            
                             }
                             else
                             {
                                $fechaE  = "fecha";
                                $inicioE = "inicio";
                                $finE    = "fin";
                             
                             }
                             
                             //********************************
                             //TERMINA ACTIIVIDAD PROGRAMADA
                             //********************************

                         } //FIN IF DEL ELSE QUE PREGUNTA SI ES PLANIFICADO o programado

                    }
                    else //si ya estan llenos los campos ignoramos la fila q esta activa
                    {
                         if(  $celda != " " ) //if para insertar cuando encuentre espacio en blanco
                         {
                             
                             if( $fechaE != "fecha" and $inicioE != "inicio" and $finE != "fin" ) //verificamos que sea tipo == planificado por el contenido de las variables
                             {
	                             $descripcionE = utf8_decode($descripcionE);
	            
	                             $sql="INSERT INTO `registroast`.`excel` (usuario,descripcion,fecha,inicio,fin) VALUES ('$ver','$descripcionE','$fechaE','$inicioE','$finE')";
	            
	                             if( mysql_query($sql,$conexion) )
	                             {
	            
	                             }
	                             else
	                             {
	                             ?>
	                                 <script type="text/javascript">alert("Error en los datos al registrar una actividad");</script>
	                                 <script type="text/javascript">
	                                 window.location="ast_excel.php";
	                                 </script>
	                             <?php
	                             }
	                             
	                             //aplicamos reset a las variables despues de insertar
	                             $descripcionE = "";
	                             $fechaE       = "";
	                             $inicioE      = "";
	                             $finE         = "";
                             }
                             else //si las variables no fueron tipo planificado entonces al encontrar linea vacia hacemos el reset para ignorar registro
                             {
                                 //aplicamos reset a las variables despues de insertar
                                 $descripcionE = "";
                                 $fechaE       = "";
                                 $inicioE      = "";
                                 $finE         = "";
                             }
            
            
                         }//fin if que inserta en la BD cuando encuentre la linea en blanco de separacion
                         
                    }//fin else q preguntaba si estaban llenos todos los campos para ignorar fila activa
   
                }//fin else q pregunta si descripcion esta llena
      
            }//fin else no es la primera iteracion

        }//fin foreach

        //insertamos el ultimo registro encontrado      
        if( $fechaE != "" and $inicioE != "" and $finE != "" and $descripcionE != "" ) //verificamos que las variables no esten vacias
        {
            $descripcionE = utf8_decode($descripcionE);
        
            $sql="INSERT INTO `registroast`.`excel` (usuario,descripcion,fecha,inicio,fin) VALUES ('$ver','$descripcionE','$fechaE','$inicioE','$finE')";
        
            if( mysql_query($sql,$conexion) )
            {
            
            }
            else
            {
            ?>
               <script type="text/javascript">alert("Error en los datos al registrar una actividad");</script>
               <script type="text/javascript">
               window.location="ast_excel.php";
               </script>
            <?php
            }

        }// fin if  que inserta el ultimo registro encontrado

        header ("Location: ast_excel.php");

    }//FIN IF DE MAC .XLSX
    
    //FIN DEL CODIGO SI EL ARCHIVO EXCEL ES DE MAC .XLSX **************************************************************
    //FIN DEL CODIGO SI EL ARCHIVO EXCEL ES DE MAC .XLSX **************************************************************
    
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/    
    
    /*INICIO MAC INGLES */
    
    //INICIA EL CODIGO SI EL ARCHIVO EXCEL ES DE MAC .XLSX **************************************************************
    //INICIA EL CODIGO SI EL ARCHIVO EXCEL ES DE MAC .XLSX **************************************************************
    //INICIA EL CODIGO SI EL ARCHIVO EXCEL ES DE MAC .XLSX **************************************************************

    if( $tipoExcel == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" and $tipe == 2 and $idioma = "ingles" )
    {

        $objPHPExcel = PHPExcel_IOFactory::load( $archivosss );

        //obtenemos los datos de la hoja activa (la primera)
        $objHoja=$objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

        //recorremos las filas obtenidas

        foreach ($objHoja as $iIndice=>$objCelda)
        {
             $celda = $objCelda['A'] ; //imprimimos el contenido de la celda utilizando la letra de cada columna

            if( $iIndice == 1 ) //primera iteracion
            {
            	$tipo11=$celda[0].$celda[1].$celda[2].$celda[3].$celda[4].$celda[5].$celda[6].$celda[7]; //Location
                $tipo22=$celda[0].$celda[1].$celda[2].$celda[3].$celda[4].$celda[5].$celda[6].$celda[7]; //Invitees
                $tipo33=$celda[0].$celda[1].$celda[2].$celda[3];           //When
                $tipo44=$celda[0].$celda[1].$celda[2].$celda[3].$celda[4];  //Where
            	
                if( !( $tipo11 == "Location" || $tipo22 == "Invitees" || $tipo33 == "When" || $tipo44 == "Where" ) )
                {
                    $descripcionE =  $celda;
                }

            }//fin if primera iteracion
            else //si no es la primera iteracion
            {
                if( $descripcionE == "" ) //verificamos si esta llena la descripcion para llenarla
                {
                    $tipo11=$celda[0].$celda[1].$celda[2].$celda[3].$celda[4].$celda[5].$celda[6].$celda[7]; //Location
                    $tipo22=$celda[0].$celda[1].$celda[2].$celda[3].$celda[4].$celda[5].$celda[6].$celda[7]; //Invitees
                    $tipo33=$celda[0].$celda[1].$celda[2].$celda[3];           //When
                    $tipo44=$celda[0].$celda[1].$celda[2].$celda[3].$celda[4];  //Where
                    
                    if( !( $tipo11 == "Location" || $tipo22 == "Invitees" || $tipo33 == "When" || $tipo44 == "Where" ) )
                    {
                    	$descripcionE =  $celda;
                    }
                }
                else //si descripcion esta llena significa que llenaremos Descripcion, hora y mes
                {    
                    //si los campos estan vacios los llenamos
                    if( $fechaE == "" and $inicioE == "" and $finE == "" )
                    {     
                        $tipoSave = $celda[0]. $celda[1]. $celda[2]. $celda[3]. $celda[4]. $celda[5]. $celda[6]. $celda[7]. $celda[8]. $celda[9];
             
                        if( $tipoSave == "scheduled " ) //verificamos que sea tipo PROGRAMADA SCHEDULED para q contenga fecha y horas
                        {
                             $rec = 10; //posicion inicial del mes el cual es lo primero a identificar en idioma ingles
                             $dd = ""; //dia
                             $mm = ""; //mes
                             $aa = ""; //anio
                             $ii = ""; //hora inicial
                             $ff = ""; //hora final
                             $hi = ""; //si la hora inicial es AM o PM
                             $hf = ""; //si la hora final es AM o PM
                             
                             //$mes_ingles= $celda[10].$celda[11].$celda[12].$celda[13].$celda[14].$celda[15].$celda[16];
                             
                             while(  $celda[$rec] != " ") //recorremos para obtener el mes
                             {
                                 $mm  = $mm. $celda[$rec];
                                 $rec = $rec + 1;
                             }
                             
                             $rec++;
              					
                             while(  $celda[$rec] != ",") //recorremos para obtener el dia
                             {
                                 $dd  = $dd .  $celda[$rec];
                                 $rec = $rec + 1;
                             }
                                                
                             $rec = $rec + 2;
                             
                             while(  $celda[$rec] != " ") //recorremos para obtener el anio
                             {
                                 $aa  = $aa. $celda[$rec];
                                 $rec = $rec + 1;
                             }
                             
                             $rec = $rec + 6;
                             
                             while(  $celda[$rec] != " ") //recorremos para obtener la hora de inicio
                             {
                                 $ii  = $ii. $celda[$rec];
                                 $rec = $rec + 1;
                             }
                             
                             $rec = $rec + 1;
                             
                             while(  $celda[$rec] != " ") //recorremos para obtener AM o PM de la hora inicio
                             {
                                 $hi  = $hi. $celda[$rec];
                                 $rec = $rec + 1;
                             }

                             
                             $rec = $rec + 4;
                             
                             while(  $celda[$rec] != " ")  //recorremos para obtener la hora de fin
                             {
                                 $ff  = $ff. $celda[$rec];
                                 $rec = $rec + 1;
                             }

                             $rec++;
                             
                             $end = strlen( $celda);
                             
                             $pp='1';
                             
                             while( $pp )  //recorremos para obtener AM o PM de la hora de fin
                             {
                                 $hf  = $hf. $celda[$rec];
                                 $rec = $rec + 1;
                                 
                                 if( $rec > $end-1 )
                                 {
                                     $pp = 0;
                                 }
                             }
                             
                             //preparemos el mes convertirlo de letra a numero
                             switch($mm)
                             {
                                Case "January":
                                             $mmm="01";
                                break;
                                Case "February":
                                             $mmm="02";
                                break;
                                Case "March":
                                             $mmm="03";
                                break;
                                Case "April":
                                             $mmm="04";
                                break;
                                Case "May":
                                             $mmm="05";
                                break;
                                Case "June":
                                             $mmm="06";
                                break;
                                Case "July":
                                             $mmm="07";
                                break;
                                Case "August":
                                             $mmm="08";
                                break;
                                Case "September":
                                             $mmm="09";
                                break;
                                Case "October":
                                             $mmm="10";
                                break;
                                Case "November":
                                             $mmm="11";
                                break;
                                Case "December":
                                             $mmm="12";
                                break;
                             }//fin switch
                             
                             $dates = $aa .'-' . $mmm . '-' . $dd;
                             
                             
                             /********************************************************************/
                             /* CONVERTIMOS HORA INICIAL EN FORMATO DE 24 HORAS */
                             
                             $cont=0;
                             $horas="";
                             $horas2="";
                             
                             if( $hi == "AM" )
                             {
                             	$hora_inicial = $ii;
                             }
                             else
                             {
                             	while( $ii[$cont] != ":" )
                             	{
                             		$horas = $horas . $ii[$cont];
                             		$cont++;
                             	}
                             	
                             	if( $horas != "12" and $horas != 12 )
                             	{
                             		$horas2 = $horas + 12;
                             	}
                             	else
                             	{
                             		$horas2 = 12;
                             	}

                             	
                             	$hora_inicial = $horas2.$ii[$cont].$ii[$cont+1].$ii[$cont+2];
                             	
                             }//fin else que pregunta si $hi == AM
                             
                             /***************************************************************************/
                             
                             /* CONVERTIMOS HORA FINAL EN FORMATO DE 24 HORAS */
                             
                             $cont=0;
                             $horas="";
                             $horas2="";
                             
                             if( $hf == "AM" )
                             {
                             	$hora_final = $ff;
                             }
                             else
                             {
                             	while( $ff[$cont] != ":" )
                             	{
                             		$horas = $horas . $ff[$cont];
                             		$cont++;
                             	}
                             	
                             	if( $horas != "12" and $horas != 12 )
                             	{
                             		$horas2 = $horas + 12;
                             	}
                             	else
                             	{
                             		$horas2 = 12;
                             	}
                             	
                             	$hora_final = $horas2.$ff[$cont].$ff[$cont+1].$ff[$cont+2];
                             	
                             }//fin else que pregunta si $ff == AM

                             /***************************************************************************/
                             
                             $fechaE  = $dates;
                             $inicioE = $hora_inicial;
                             $finE    = $hora_final;
             
                        }//fin if tipo == PROGRAMADA  SCHEDULED	
                        else //tipo SCHEDULED:
                        {
                            
								/*
                            $fechaE  = "fecha";
                            $inicioE = "inicio";
                            $finE    = "fin";
                            */
                            
                            
                            //********************************
                            //INICIA TIPO ACTIVIDAD ESCHEDULED:
                            //********************************
             
                            $tipoSave = $celda[0]. $celda[1]. $celda[2]. $celda[3]. $celda[4]. $celda[5]. $celda[6]. $celda[7]. $celda[8]. $celda[9];
             					                         
                            if( $tipoSave == "Scheduled:" || $tipoSave == "scheduled:" ) //verificamos que sea tipo planificado para q contenga fecha y horas
                            {
                                 $rec = 11; //posicion inicial del mes el cual es lo primero a identificar en idioma ingles con dos puntos
	                             $dd = ""; //dia
	                             $mm = ""; //mes
	                             $aa = ""; //anio
	                             $ii = ""; //hora inicial
	                             $ff = ""; //hora final
	                             $hi = ""; //si la hora inicial es AM o PM
	                             $hf = ""; //si la hora final es AM o PM
	                             
                                                         
	                             while(  $celda[$rec] != " " ) //recorremos para obtener el mes
	                             {
	                                 $mm  = $mm. $celda[$rec];
	                                 $rec = $rec + 1;
	                             }
                             
                             	 $rec++;
              					
	                             while(  $celda[$rec] != "," ) //recorremos para obtener el dia
	                             {
	                                 $dd  = $dd .  $celda[$rec];
	                                 $rec = $rec + 1;
	                             }
                                                
	                             $rec = $rec + 2;
	                             
	                             while(  $celda[$rec] != "," ) //recorremos para obtener el anio
	                             {
	                                 $aa  = $aa. $celda[$rec];
	                                 $rec = $rec + 1;
	                             }
                             
                             	 $rec = $rec + 2;
                             	 $conteo = 0;
                             
	                             while( $conteo != 2 ) //recorremos para obtener la hora de inicio
	                             {
	                                 if( $celda[$rec] == ":" )
	                                 {
	                                 	$conteo++;
	                                 }
	                                 if( $conteo != 2 )
	                                 {
	                                 	$ii  = $ii. $celda[$rec];
	                                 	$rec = $rec + 1;
	                                 }
	                             }
                             
                             	 $rec = $rec + 4;
                             
	                             while(  $celda[$rec] != " ") //recorremos para obtener AM o PM de la hora inicio
	                             {
	                                 $hi  = $hi. $celda[$rec];
	                                 $rec = $rec + 1;
	                             }

                             
	                             $rec = $rec + 4;
	                             $conteo=0;

	                             
	                             while(  $conteo != 2 )  //recorremos para obtener la hora de fin
	                             {
	                                 if( $celda[$rec] == ":" )
	                                 {
	                                 	$conteo++;
	                                 }
	                                 if( $conteo != 2 )
	                                 {
		                                 $ff  = $ff. $celda[$rec];
		                                 $rec = $rec + 1;
		                             }
	                             }

                             $rec = $rec + 4;
                             
                             $end = strlen( $celda);
                             
                             $pp='1';
                             
                             while( $pp )  //recorremos para obtener AM o PM de la hora de fin
                             {
                                 $hf  = $hf. $celda[$rec];
                                 $rec = $rec + 1;
                                 
                                 if( $rec > $end-1 )
                                 {
                                     $pp = 0;
                                 }
                             }
                             
                             //preparemos el mes convertirlo de letra a numero
                             switch($mm)
                             {
                                Case "Jan":
                                             $mmm="01";
                                break;
                                Case "Feb":
                                             $mmm="02";
                                break;
                                Case "Mar":
                                             $mmm="03";
                                break;
                                Case "Apr":
                                             $mmm="04";
                                break;
                                Case "May":
                                             $mmm="05";
                                break;
                                Case "Jun":
                                             $mmm="06";
                                break;
                                Case "Jul":
                                             $mmm="07";
                                break;
                                Case "Aug":
                                             $mmm="08";
                                break;
                                Case "Sep":
                                             $mmm="09";
                                break;
                                Case "Oct":
                                             $mmm="10";
                                break;
                                Case "Nov":
                                             $mmm="11";
                                break;
                                Case "Dec":
                                             $mmm="12";
                                break;
                             }//fin switch
                             
                             $dates = $aa .'-' . $mmm . '-' . $dd;
                             
                             
                             /********************************************************************/
                             /* CONVERTIMOS HORA INICIAL EN FORMATO DE 24 HORAS */
                             
                             $cont=0;
                             $horas="";
                             $horas2="";
                             
                             if( $hi == "AM" )
                             {
                             	$hora_inicial = $ii;
                             }
                             else
                             {
                             	while( $ii[$cont] != ":" )
                             	{
                             		$horas = $horas . $ii[$cont];
                             		$cont++;
                             	}
                             	
                             	if( $horas != "12" and $horas != 12 )
                             	{
                             		$horas2 = $horas + 12;
                             	}
                             	else
                             	{
                             		$horas2 = 12;
                             	}

                             	
                             	$hora_inicial = $horas2.$ii[$cont].$ii[$cont+1].$ii[$cont+2];
                             	
                             }//fin else que pregunta si $hi == AM
                             
                             /***************************************************************************/
                             
                             /* CONVERTIMOS HORA FINAL EN FORMATO DE 24 HORAS */
                             
                             $cont=0;
                             $horas="";
                             $horas2="";
                             
                             if( $hf == "AM" )
                             {
                             	$hora_final = $ff;
                             }
                             else
                             {
                             	while( $ff[$cont] != ":" )
                             	{
                             		$horas = $horas . $ff[$cont];
                             		$cont++;
                             	}
                             	
                             	if( $horas != "12" and $horas != 12 )
                             	{
                             		$horas2 = $horas + 12;
                             	}
                             	else
                             	{
                             		$horas2 = 12;
                             	}
                             	
                             	$hora_final = $horas2.$ff[$cont].$ff[$cont+1].$ff[$cont+2];
                             	
                             }//fin else que pregunta si $ff == AM

                              /***************************************************************************/
                             
                              $fechaE  = $dates;
                              $inicioE = $hora_inicial;
                              $finE    = $hora_final;    
                                      
                         }//fin si scheduled: tiene dos puntos
                         else
                         {
                             $fechaE  = "";
                             $inicioE = "";
                             $finE    = "";    
                         }
                             
                             //********************************
                             //TERMINA ACTIIVIDAD ESCHEDULED:
                             //********************************
								
                        } //FIN IF DEL ELSE QUE PREGUNTA SI escheduled o escheduled:

                    }
                    else //si ya estan llenos los campos ignoramos la fila q esta activa
                    {
                         if(  $celda != " " ) //if para insertar cuando encuentre espacio en blanco
                         {
                             
                             if( $fechaE != "fecha" and $inicioE != "inicio" and $finE != "fin" ) //verificamos que sea tipo == planificado por el contenido de las variables
                             {
	                             $descripcionE = utf8_decode($descripcionE);  
	            
	                             $sql="INSERT INTO `registroast`.`excel` (usuario,descripcion,fecha,inicio,fin) VALUES ('$ver','$descripcionE','$fechaE','$inicioE','$finE')";
	            
	                             if( mysql_query($sql,$conexion) )
	                             {
	            
	                             }
	                             else
	                             {
	                             ?>
	                                 <script type="text/javascript">alert("Error en los datos al registrar una actividad");</script>
	                                 <script type="text/javascript">
	                                 window.location="ast_excel.php";
	                                 </script>
	                             <?php
	                             }
	                             
	                             //aplicamos reset a las variables despues de insertar
	                             $descripcionE = "";
	                             $fechaE       = "";
	                             $inicioE      = "";
	                             $finE         = "";
                             }
                             else //si las variables no fueron tipo planificado entonces al encontrar linea vacia hacemos el reset para ignorar registro
                             {
                                 //aplicamos reset a las variables despues de insertar
                                 $descripcionE = "";
                                 $fechaE       = "";
                                 $inicioE      = "";
                                 $finE         = "";
                             }
            
            
                         }//fin if que inserta en la BD cuando encuentre la linea en blanco de separacion
                         
                    }//fin else q preguntaba si estaban llenos todos los campos para ignorar fila activa
   
                }//fin else q pregunta si descripcion esta llena
      
            }//fin else no es la primera iteracion

        }//fin foreach

        //insertamos el ultimo registro encontrado      
        if( $fechaE != "" and $inicioE != "" and $finE != "" and $descripcionE != "" ) //verificamos que las variables no esten vacias
        {
            $descripcionE = utf8_decode($descripcionE);
        
            $sql="INSERT INTO `registroast`.`excel` (usuario,descripcion,fecha,inicio,fin) VALUES ('$ver','$descripcionE','$fechaE','$inicioE','$finE')";
        
            if( mysql_query($sql,$conexion) )
            {
            
            }
            else
            {
            ?>
               <script type="text/javascript">alert("Error en los datos al registrar una actividad");</script>
               <script type="text/javascript">
               window.location="ast_excel.php";
               </script>
            <?php
            }

        }// fin if  que inserta el ultimo registro encontrado

       // header ("Location: ast_excel.php");

    }//FIN IF DE MAC .XLSX
    
    //FIN DEL CODIGO SI EL ARCHIVO EXCEL ES DE MAC .XLSX **************************************************************
    //FIN DEL CODIGO SI EL ARCHIVO EXCEL ES DE MAC .XLSX **************************************************************

    
    

//**********************************************************************************************************************************
//**********************************************************************************************************************************


//INICIA EL CODIGO SI EL ARCHIVO EXCEL ES DE WINDOWS CON EXTENSION .XLS o .XLSX

    if( ( $tipoExcel == "application/vnd.ms-excel" || $tipoExcel == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ) and $tipe == 1 )
    {
		
		if( $ext == '.CSV' || $ext == '.csv' || $ext == '.Csv' )
		{
			$objReader = new PHPExcel_Reader_CSV();
			$objReader->setInputEncoding('CP1252');
			$objReader->setDelimiter(',');
			$objReader->setEnclosure('');
			$objReader->setLineEnding("\r\n");
			$objReader->setSheetIndex(0);		
			$objPHPExcel = $objReader->load($archivosss);
        
        	$objHoja=$objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        }
        else
        {
        	$objPHPExcel = PHPExcel_IOFactory::load( $archivosss );
        	//obtenemos los datos de la hoja activa (la primera)
        	$objHoja=$objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        }
        
        foreach ($objHoja as $iIndice=>$objCelda)
        {
            $celda = $objCelda['A'];
            $var2 = $objCelda['B'] ;
            $var3 = $objCelda['C'] ;
            $var4 = $objCelda['D'] ;
        
            if(  $celda == "Asunto" || $var2 == "Fechadecomienzo" || $var3 == "Comienzo" || $celda == "Subject" || $var2 == "Start Date" || $var3 == "Start Time" )
            {
            }
            else
            {
                //PREPARAMOS LA FECHA 1/08/2013
                if( $var2[1] != "/" ) // dd- SI?    preguntamos si el dia es de dos o un digito
                {
                    if( $var2[4] != "/" ) // dd-mm-
                    {
                        $y = $var2[6].$var2[7].$var2[8].$var2[9];
                        $m = $var2[3].$var2[4];
                        $d = $var2[0].$var2[1];
                    }
                    else // dd-m-
                    {
                        $y = $var2[5].$var2[6].$var2[7].$var2[8];
                        $m = "0".$var2[3];
                        $d = $var2[0].$var2[1];
                    }
                } // FIN DE dd- SI?
                else // d-
                {
                    if( $var2[3] != "/" ) // d-mm-
                    {
                        $y = $var2[5].$var2[6].$var2[7].$var2[8];
                        $m = $var2[2].$var2[3];
                        $d = "0".$var2[0];
                    }
                    else // d-m-
                    {
                        $y = $var2[4].$var2[5].$var2[6].$var2[7];
                        $m = "0".$var2[2];
                        $d = "0".$var2[0];
                    }
                }// FIN ELSE d-
        
                $f = $y . "-" . $m . "-" . $d;
        
                //preparamos el formato para la hora inicial------------------------------------------------------------------------
                if( $var3[9] == "a")
                {
                    $varI = $var3[0].$var3[1].$var3[2].$var3[3].$var3[4].$var3[5].$var3[6].$var3[7];
                }
                else
                {
                    $h = $var3[0].$var3[1];
                    
                    if( $h == "01" )
                    {
                        $hh = "13";
                    }
        
                    if( $h == "02" )
                    {
                        $hh = "14";
                    }
        
                    if( $h == "03" )
                    {
                        $hh = "15";
                    }
                    
                    if( $h == "04" )
                    {
                        $hh = "16";
                    }
        
                    if( $h == "05" )
                    {
                        $hh = "17";
                    }
                    
                    if( $h == "06" )
                    {
                        $hh = "18";
                    }
                    
                    if( $h == "07" )
                    {
                        $hh = "19";
                    }
                    
                    if( $h == "08" )
                    {
                        $hh = "20";
                    }
                    
                    if( $h == "09" )
                    {
                        $hh = "21";
                    }
        
                    if( $h == "10" )
                    {
                        $hh = "22";
                    }
                    
                    if( $h == "11" )
                    {
                        $hh = "23";
                    }
                    
                    if( $h == "12" )
                    {
                        $hh = "12";
                    }
                    
                    $varI = $hh.$var3[2].$var3[3].$var3[4].$var3[5].$var3[6].$var3[7];
        
                }
                //FIN FORMATO HORA INICIAL--------------------------------------------------------------------------------------------------
    
                //INICIO FORMATO HORA FINAL-------------------------------------------------------------------------------------------------
                
                if( $var4[9] == "a")
                {
                    $varF = $var4[0].$var4[1].$var4[2].$var4[3].$var4[4].$var4[5].$var4[6].$var4[7];
                }
                else
                {
                    $h = $var4[0].$var4[1];
                    
                    if( $h == "01" )
                    {
                        $hh = "13";
                    }
                    
                    if( $h == "02" )
                    {
                        $hh = "14";
                    }
                    
                    if( $h == "03" )
                    {
                        $hh = "15";
                    }
                    
                    if( $h == "04" )
                    {
                        $hh = "16";
                    }
                    
                    if( $h == "05" )
                    {
                        $hh = "17";
                    }
                
                    if( $h == "06" )
                    {
                        $hh = "18";
                    }
                
                    if( $h == "07" )
                    {
                        $hh = "19";
                    }
                    
                    if( $h == "08" )
                    {
                        $hh = "20";
                    }
                    
                    if( $h == "09" )
                    {
                        $hh = "21";
                    }
                    
                    if( $h == "10" )
                    {
                        $hh = "22";
                    }
                    
                    if( $h == "11" )
                    {
                        $hh = "23";
                    }
                    
                    if( $h == "12" )
                    {
                        $hh = "12";
                    }
    
                    $varF = $hh.$var4[2].$var4[3].$var4[4].$var4[5].$var4[6].$var4[7];
                
                }//FIN FORMATO HORA FINAL----------------------------------------------------------------------------------------------------
        
                $varcode= utf8_decode( $celda);
        
                $sql="INSERT INTO `registroast`.`excel` (usuario,descripcion,fecha,inicio,fin) VALUES ('$ver','$varcode','$f','$varI','$varF')";
                
                if( mysql_query($sql,$conexion) )
                {
                }
                else
                {
                    ?>
                    
                    <script type="text/javascript">alert("Error en los datos al registrar una actividad");</script>
                    <script type="text/javascript">
                    window.location="ast_excel.php";
                    </script>
                    
                    <?php
                }
        
            }//fin del if else que verifica que no se almacene la primera linea con los encabezados
                
        }//fin for each
    
        header ("Location: ast_excel.php");
    
    }//fin if que preguntaba si era excel o no el archivo que se subio al server
    else
    {
        ?>
        
        <script type="text/javascript">alert("Error el archivo seleccionado no es Excel ( .xls )");</script>
        <script type="text/javascript">
        window.location="cargar_archivo.php";
        </script>
        
        <?php
    }


?>

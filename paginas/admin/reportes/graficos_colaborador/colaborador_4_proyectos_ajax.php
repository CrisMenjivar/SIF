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


$area = $_GET['area'];
$colaborador = $_GET['colaborador'];
$clasificacion = $_GET['clasificacion'];
$inicio = $_GET['inicio'];
$fin = $_GET['fin'];

if( $area == "general" ) // si es general o coloaborador
{

if( $inicio != "" and $fin != "" ) //verifica que los campos no esten vacios inicio y fin
{

?>


<div id="conti" style="width: 992px; margin-right:auto;margin-left:auto;margin-bottom:30px;">

<div id="tem" style="width: 991px">
<p style="width: 990px">Proyectos</p>
</div>

<div id="contenidos" style="width: 989px">
<table border="1" style="width: 991px" >
<tr>
<td width="170px" align="center"><strong>Correlativo</strong></td>
<td width="530px" align="center"><strong>Nombre proyecto</strong></td>
<td width="180px" align="center"><strong>Empresa</strong></td>
<td width="250px" align="center"><strong>Total de horas invertidas</strong></td>
<td width="180px" align="center"><strong>%</strong></td>
</tr>

<?php 


$totalhoras=0;

   $query22="select correlativo from proyectos where correlativo!='NO_ES_PROYECTO' ";
   $res2002=mysql_query($query22,$conexion);
   
   while( $rest12=mysql_fetch_array($res2002) ) //while de los proyectos que es jefe
   {
      $correlativo12=$rest12['correlativo'];
            
      $query200="select sum(totalhoras) as total from ast where cproyecto='$correlativo12' and fecha BETWEEN '$inicio' and '$fin' ";
      $res200=mysql_query($query200,$conexion);
      $rest200=mysql_fetch_array($res200);
      $totalhoras= $totalhoras + $rest200['total'];

   }//FIN while de los proyectos que es jefe

if( $totalhoras == 0 )
{
$totalhoras=1;
}

$totalhoras=$totalhoras/60;

$totalconsumo=0;

   $query2="select correlativo,nombre,empresa from proyectos where correlativo!='NO_ES_PROYECTO' ";
   $res200=mysql_query($query2,$conexion);
   
   while( $rest1=mysql_fetch_array($res200) ) //while de los proyectos que es jefe
   {
      $correlativo1=$rest1['correlativo'];
      $nombre1=$rest1['nombre'];
      $empresa1=$rest1['empresa'];
      
      $q1="select sum(totalhoras) as total from ast where cproyecto='$correlativo1' and fecha BETWEEN '$inicio' and '$fin'";
      $r1=mysql_query($q1,$conexion);
      $t1=mysql_fetch_array($r1);
      $total1=$t1['total'];
      
      if( $total1 != NULL )
      {
      $totalconsumo=$totalconsumo+$total1;
      $total1=$total1/60;
      echo '<tr>';
      echo '<td width="170px" align="center"><strong>'; echo $correlativo1; echo '</strong></td>';
      echo '<td width="530px" ><strong>'; echo $nombre1; echo '</strong></td>';
      echo '<td width="180px" align="center"><strong>'; echo $empresa1;     echo '</strong></td>';
      echo '<td width="250px" align="center"><strong>'; echo round( $total1 * 100) / 100;       echo '</strong></td>';
      echo '<td width="180px" align="center"><strong>'; echo round( (($total1/$totalhoras)*100) *100)/100; echo '&nbsp; %'; echo '</strong></td>';
      echo '</tr>';
      }


   }//FIN while de los proyectos que es jefe

      $totalconsumo=$totalconsumo/60;
      echo '<tr>';
      echo '<td width="170px" colspan="2" align="right"><strong>'; echo 'TOTAL &nbsp;'; echo '</strong></td>';
      echo '<td width="180px" align="center"><strong>'; echo '</strong></td>';
      echo '<td width="250px" align="center"><strong>'; echo round( $totalconsumo * 100 )/100; echo '</strong></td>';
      echo '<td width="180px" align="center"><strong>'; echo '100 %'; echo '</strong></td>';
      echo '</tr>';

?>

</table>
</div>
</div>


<?php

}// FIN IF verifica que los campos no esten vacios inicio y fin


}
else //else si es general o colaborador
{


if( $area != "" and $colaborador != "" and $clasificacion != "" and $inicio != "" and $fin != "" ) //verifica que los campos no esten vacios
{
?>
<div id="conti" style="width: 992px; margin-right:auto;margin-left:auto;margin-bottom:30px;">

<div id="tem" style="width: 991px">
<p style="width: 990px">Proyectos</p>
</div>

<div id="contenidos" style="width: 989px">
<table border="1" style="width: 991px" >
<tr>
<td width="170px" align="center"><strong>Correlativo</strong></td>
<td width="530px" align="center"><strong>Nombre proyecto</strong></td>
<td width="90px" align="center"><strong>Coordinador</strong></td>
<td width="180px" align="center"><strong>Empresa</strong></td>
<td width="250px" align="center"><strong>Total de horas invertidas</strong></td>
<td width="90px" align="center"><strong>%</strong></td>
</tr>

<?php

$totalhoras=0;

   $query22="select correlativo from proyectos where correlativo!='NO_ES_PROYECTO' ";
   $res2002=mysql_query($query22,$conexion);
   
   while( $rest12=mysql_fetch_array($res2002) ) //while de los proyectos que es jefe
   {
      $correlativo12=$rest12['correlativo'];
            
      $query200="select sum(totalhoras) as total from ast where usuario='$colaborador' and cproyecto='$correlativo12' and fecha BETWEEN '$inicio' and '$fin' ";
      $res200=mysql_query($query200,$conexion);
      $rest200=mysql_fetch_array($res200);
      $totalhoras= $totalhoras + $rest200['total'];

   }//FIN while de los proyectos que es jefe

if( $totalhoras == 0 )
{
$totalhoras=1;
}

$totalhoras=$totalhoras/60;

$totalconsumo=0;
 
$query="select nombre from empresas";
$res100=mysql_query($query,$conexion);

while( $rest=mysql_fetch_array($res100) ) //while de las empresas
{
   $empresa=$rest['nombre'];
   
   $query2="select correlativo,nombre,empresa from proyectos where correlativo!='NO_ES_PROYECTO' and coordinador='$colaborador' and tipo='$clasificacion' and empresa='$empresa' ";
   $res200=mysql_query($query2,$conexion);
   
   while( $rest1=mysql_fetch_array($res200) ) //while de los proyectos que es jefe
   {
      $correlativo1=$rest1['correlativo'];
      $nombre1=$rest1['nombre'];
      $empresa1=$rest1['empresa'];
      
      $q1="select sum(totalhoras) as total from ast where usuario='$colaborador' and cproyecto='$correlativo1' and fecha BETWEEN '$inicio' and '$fin' ";
      $r1=mysql_query($q1,$conexion);
      $t1=mysql_fetch_array($r1);
      $total1=$t1['total'];
      
      if( $total1 != NULL )
      {
      $totalconsumo=$totalconsumo+$total1;
      $total1 = $total1 / 60;
      echo '<tr>';
      echo '<td width="170px" align="center"><strong>'; echo $correlativo1; echo '</strong></td>';
      echo '<td width="530px" ><strong>'; echo $nombre1;      echo '</strong></td>';
      echo '<td width="90px" align="center"><strong>'; echo 'SI';     echo '</strong></td>';
      echo '<td width="180px" align="center"><strong>'; echo $empresa1;     echo '</strong></td>';
      echo '<td width="250px" align="center"><strong>'; echo round( $total1 * 100 )/100;       echo '</strong></td>';
      echo '<td width="90px" align="center"><strong>'; echo round( (($total1/$totalhoras)*100) *100)/100; echo '</strong></td>';
      echo '</tr>';
      }


   }//FIN while de los proyectos que es jefe
   
   
   $query3="select correlativo,nombre,empresa from proyectos where correlativo!='NO_ES_PROYECTO' and coordinador!='$colaborador' and tipo='$clasificacion' and empresa='$empresa' ";
   $res300=mysql_query($query3,$conexion);
   
   while( $rest3=mysql_fetch_array($res300) ) //while de los proyectos que NO es jefe
   {
      $correlativo3=$rest3['correlativo'];
      $nombre3=$rest3['nombre'];
      $empresa3=$rest3['empresa'];
      
      $q2="select sum(totalhoras) as total from ast where usuario='$colaborador' and cproyecto='$correlativo3' and fecha BETWEEN '$inicio' and '$fin'";
      $r2=mysql_query($q2,$conexion);
      $t2=mysql_fetch_array($r2);
      $total3=$t2['total'];
      
      if( $total3 != NULL )
      {
      $totalconsumo=$totalconsumo+$total3;
      $total3 = $total3 / 60;
      echo '<tr>';
      echo '<td width="170px" align="center"><strong>'; echo $correlativo3; echo '</strong></td>';
      echo '<td width="530px" ><strong>'; echo $nombre3;      echo '</strong></td>';
      echo '<td width="90px" align="center"><strong>'; echo 'NO';     echo '</strong></td>';
      echo '<td width="180px" align="center"><strong>'; echo $empresa3;     echo '</strong></td>';
      echo '<td width="250px" align="center"><strong>'; echo round( $total3 * 100 )/100;       echo '</strong></td>';
      echo '<td width="90px" align="center"><strong>'; echo round( (($total3/$totalhoras)*100) *100)/100; echo '</strong></td>';//echo round(($uti/60)*100)/100;
      echo '</tr>';
      }      
   }//FIN while de los proyectos que NO es jefe

}//FIN while de las empresas
      $totalconsumo = $totalconsumo/60;
      echo '<tr>';
      echo '<td width="170px" colspan="2" align="right"><strong>'; echo 'TOTAL &nbsp;'; echo '</strong></td>';
      echo '<td width="180px" align="center"><strong>'; echo '</strong></td>';
      echo '<td width="90px" align="center"><strong>'; echo '</strong></td>';
      echo '<td width="250px" align="center"><strong>'; echo round( $totalconsumo * 100 )/100;       echo '</strong></td>';
      echo '<td width="90px" align="center"><strong>'; echo '100'; echo '</strong></td>';
      echo '</tr>';
?>

</table>
</div>
</div>


<?php
} //fin if que verifica que todos los campos no esten vacios
else
{
?>




<?php
}

}//fin else si es general o colaborador
?>










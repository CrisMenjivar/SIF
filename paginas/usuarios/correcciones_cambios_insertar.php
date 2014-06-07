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



$yearI = $_POST['anioI'];
$mesI = $_POST['mesI'];
$yearF = $_POST['anioF'];
$mesF = $_POST['mesF'];

$inicioI = $yearI.'-'.$mesI.'-01';
$inicioF = $yearI.'-'.$mesI.'-31';

session_start();
$user=$_SESSION['user'];

$consulta=mysql_query("Select * from ast where usuario='$user' and fecha between '$inicioI' and '$inicioF' ",$conexion);
//$r=mysql_fetch_array($consulta);

while( $r=mysql_fetch_array($consulta) )
{
    $f=$r['fecha'];
    
    $descripcion = $r['descripcion'];
    $actividad = $r['tipoact'];
    $empresa = $r['empresa'];
    $proyecto = $r['cproyecto'];
    $inicio = $r['inicio'];
    $finales = $r['fin'];
    $horas = $r['totalhoras'];
    
    //2014-01-02
    
    $fechaFinal=$yearF.'-'.$mesF.'-'.$f[8].$f[9];
    
    $sql="INSERT INTO registroast.ast (usuario,fecha,descripcion,tipoact,empresa,cproyecto,inicio,fin,totalhoras,estado) VALUES ('$user', '$fechaFinal', '$descripcion', '$actividad', '$empresa', '$proyecto', '$inicio', '$finales', '$horas', 'b')";

	if( mysql_query($sql,$conexion) )
	{
	    
	}


}


?>

<script type="text/javascript">alert("hecho");</script>
<script type="text/javascript">
window.location="datos_x.php";
</script>


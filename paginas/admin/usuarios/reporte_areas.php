<?php
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

$areas = $_GET['area'];

if( $areas == "general" )
{
?>

<table cellpadding="0" cellspacing="0" border="1">
<?php
$sql2="select * from usuarios";
$result2 = mysql_query($sql2,$conexion);
$contador=1;
while ( $usuarios=mysql_fetch_array($result2) )
{
$usuario=$usuarios['user'];
$pass=$usuarios['pass'];
$admin=$usuarios['admin'];
$nombre=$usuarios['nombre'];
$apellido=$usuarios['apellido'];
$area=$usuarios['area'];
$cargo=$usuarios['puesto'];
$contrato=$usuarios['contrato'];
$proveedor=$usuarios['proveedor'];
$estado=$usuarios['estado'];
$creado=$usuarios['creado'];

echo '<tr>';
echo '<td width="30px" height="20px" align="center" >'; echo $contador; echo'</td>';
echo '<td width="120px" height="20px" align="center" style="line-height:normal;" >'; echo $usuario; echo'</td>';
echo '<td width="90px" height="20px" align="center" >'; if( $admin == "1" ){ echo "Admin";}if( $admin == "2" ){ echo "Usuario";}if( $admin == "3" ){ echo "Jefe &aacute;rea";} echo'</td>';
echo '<td width="90px" height="20px" align="center" style="line-height:normal;" >'; echo $nombre; echo'</td>';
echo '<td width="90px" height="20px" align="center" style="line-height:normal;" >'; echo $apellido; echo'</td>';
echo '<td width="90px" height="20px" align="center" >'; echo $area; echo'</td>';
echo '<td width="120px" height="20px" align="center" style="line-height:normal;" >'; echo $cargo; echo'</td>';
echo '<td width="90px" height="20px" align="center" >'; echo $contrato; echo'</td>';
echo '<td width="90px" height="20px" align="center" style="line-height:normal;" >'; echo $proveedor; echo'</td>';
echo '<td width="80px" height="20px" align="center" >'; if( $estado == "a" ){ echo "Activo";}else{echo "Inactivo";} echo'</td>';
echo '<td width="100px" height="20px" align="center" style="line-height:normal;">'; echo $creado; echo'</td>';

echo '</tr>';
$contador++;
}
?>
</table>

<?php
}
else
{
?>

<table cellpadding="0" cellspacing="0" border="1">
<?php
$sql2="select * from usuarios where area='$areas'";
$result2 = mysql_query($sql2,$conexion);
$contador=1;
while ( $usuarios=mysql_fetch_array($result2) )
{
$usuario=$usuarios['user'];
$pass=$usuarios['pass'];
$admin=$usuarios['admin'];
$nombre=$usuarios['nombre'];
$apellido=$usuarios['apellido'];
$area=$usuarios['area'];
$cargo=$usuarios['puesto'];
$contrato=$usuarios['contrato'];
$proveedor=$usuarios['proveedor'];
$estado=$usuarios['estado'];
$creado=$usuarios['creado'];

echo '<tr>';
echo '<td width="30px" height="20px" align="center" >'; echo $contador; echo'</td>';
echo '<td width="120px" height="20px" align="center" style="line-height:normal;" >'; echo $usuario; echo'</td>';
echo '<td width="90px" height="20px" align="center" >'; if( $admin == "1" ){ echo "Admin";}if( $admin == "2" ){ echo "Usuario";}if( $admin == "3" ){ echo "Jefe &aacute;rea";} echo'</td>';
echo '<td width="90px" height="20px" align="center" style="line-height:normal;" >'; echo $nombre; echo'</td>';
echo '<td width="90px" height="20px" align="center" style="line-height:normal;" >'; echo $apellido; echo'</td>';
echo '<td width="90px" height="20px" align="center" >'; echo $area; echo'</td>';
echo '<td width="120px" height="20px" align="center" style="line-height:normal;" >'; echo $cargo; echo'</td>';
echo '<td width="90px" height="20px" align="center" >'; echo $contrato; echo'</td>';
echo '<td width="90px" height="20px" align="center" style="line-height:normal;" >'; echo $proveedor; echo'</td>';
echo '<td width="80px" height="20px" align="center" >'; if( $estado == "a" ){ echo "Activo";}else{echo "Inactivo";} echo'</td>';
echo '<td width="100px" height="20px" align="center" style="line-height:normal;">'; echo $creado; echo'</td>';

echo '</tr>';
$contador++;
}
?>
</table>


<?php
}

?>



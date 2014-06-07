<?php

//iniciamos la conexion
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



//Verificamos que el usuario haya iniciado sesion
session_start();
if($_SESSION['user']=="")
{
header ("Location: ../../../index.php");
}
else
{
$ver=$_SESSION['user'];

$change="select admin from usuarios where user='$ver' ";
$verify = mysql_query($change,$conexion);
$move=mysql_fetch_array($verify);

if($move['admin']=="2")
{
header ("Location: ../../usuarios/ast.php");
}

if($move['admin']=="3")
{
header ("Location: ../../jefes/ast.php");
}

if($move['admin']=="4")
{
header ("Location: ../../jefes_proyectos/ast.php");
}

}//fin else


//recuperamos los datos enviados por el formulario
$area=$_POST['area'];
$colaborador=$_POST['colaborador'];
$asunto=$_POST['asunto'];
$mensaje=$_POST['cuerpo'];
$cc=$_POST['cc'];


if( $area == "general" and $colaborador == "no")
{


// Varios destinatarios
$para  = $_SESSION['user'].'@siman.com';

$correos1="select user from usuarios where estado='a' and user!='$para'";
$correos2=mysql_query($correos1,$conexion);

while( $correos3=mysql_fetch_array($correos2) ) // while para obtener los destinatarios de correo
{
$para .= ", ";
$para .= $correos3['user']."@siman.com";
}//fin while para agregar los correos de todos los empleados

if( $cc != "" and $cc != " " and $cc != "  " and $cc != "  " and $cc != "  " )
{
    $para .= ", ".$cc;
}

// subject
$titulo = $asunto;


$mensaje .= '. 
Atentamente.
Administracion SITES
Nota : Por favor no responder este correo.';

// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'From: '.$_SESSION['user'].'@siman.com' . "\r\n";
$cabeceras .= 'Message-Id: Aplicacion AST'."\r\n";

ini_set('SMTP',"10.100.1.103");
ini_set('smtp_port','25');

// Mail it
if( mail($para, $titulo, $mensaje, $cabeceras,"-fast_service@sitescorp.com") )
{
?>
<script type="text/javascript">alert("Mensaje enviado");</script>
<script type="text/javascript">
window.location="nuevo_correo.php";
</script>
<?php
}
else
{
?>
<script type="text/javascript">alert("Error al enviar el mensaje");</script>
<script type="text/javascript">
window.location="nuevo_correo.php";
</script>
<?php

}

}//fin if que verifica que area == general y colaborador == no



/********************************************************************************************************************/
/********************************************************************************************************************/


if( $area != "general" and $colaborador == "general")
{

// Varios destinatarios
$para  = $_SESSION['user'].'@siman.com';

$correos1="select user from usuarios where estado='a' and area='$area' and user!='$para'";
$correos2=mysql_query($correos1,$conexion);

while( $correos3=mysql_fetch_array($correos2) ) // while para obtener los destinatarios de correo
{
$para .= ", ";
$para .= $correos3['user']."@siman.com";
}//fin while para agregar los correos de todos los empleados

if( $cc != "" and $cc != " " and $cc != "  " and $cc != "  " and $cc != "  " )
{
    $para .= ", ".$cc;
}


// subject
$titulo = $asunto;


$mensaje .= '. 
Atentamente.
Administracion SITES
Nota : Por favor no responder este correo.';

// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'From: '.$_SESSION['user'].'@siman.com' . "\r\n";
$cabeceras .= 'Message-Id: Aplicacion AST'."\r\n";

ini_set('SMTP',"10.100.1.103");
ini_set('smtp_port','25');

// Mail it
if( mail($para, $titulo, $mensaje, $cabeceras,"-fast_service@sitescorp.com") )
{
?>
<script type="text/javascript">alert("Mensaje enviado");</script>
<script type="text/javascript">
window.location="nuevo_correo.php";
</script>
<?php
}
else
{
?>
<script type="text/javascript">alert("Error al enviar el mensaje");</script>
<script type="text/javascript">
window.location="nuevo_correo.php";
</script>
<?php

}


}//fin if que verifica que area != general y colaborador == general




/********************************************************************************************************************/
/********************************************************************************************************************/


if( $area != "general" and $colaborador != "general" and $colaborador != "no" )
{


// Varios destinatarios
$para  = $_SESSION['user'].'@siman.com';
$para .= ", ";
$para .= $colaborador."@siman.com";

if( $cc != "" and $cc != " " and $cc != "  " and $cc != "  " and $cc != "  " )
{
    $para .= ", ".$cc;
}


// subject
$titulo = $asunto;


$mensaje .= '. 
Atentamente.
Administracion SITES
Nota : Por favor no responder este correo.';

// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'From: '.$_SESSION['user'].'@siman.com' . "\r\n";
$cabeceras .= 'Message-Id: Aplicacion AST'."\r\n";

ini_set('SMTP',"10.100.1.103");
ini_set('smtp_port','25');

// Mail it
if( mail($para, $titulo, $mensaje, $cabeceras,"-fast_service@sitescorp.com") )
{
?>
<script type="text/javascript">alert("Mensaje enviado");</script>
<script type="text/javascript">
window.location="nuevo_correo.php";
</script>
<?php
}
else
{
?>
<script type="text/javascript">alert("Error al enviar el mensaje");</script>
<script type="text/javascript">
window.location="nuevo_correo.php";
</script>
<?php

}


}//fin if que verifica que area != general, colaborador != no y colaborador != general





?>


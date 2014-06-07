<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Correo enviado</title>
</head>

<body>

<?php
session_start();
$destino=$_SESSION['email'];
//$persona=$_SESSION['email'];

$destino.="@siman.com";
//$destino1="mr09033@gmail.com";
$asunto="Notificación de AST Denegados";
$cuerpo='Estimad@, <br><br>Se te notifica que algunas actividades registradas en el  AST presentan errores. Por favor ingresar a la sección de "AST Denegado" y corregir. <br><br> Gracias por tu atención, <br><br> SITES';

//$headers = "From: tpiexa2grup17@tpiexa2grup17.site40.net" . "\r\n" ."CC: somebodyelse@example.com";
ini_set('SMTP',"10.100.1.103");
ini_set('smtp_port','25');
mail($destino,$asunto,$cuerpo);

echo '<h4>Correo electronico enviado satisfactoriamente a : '; echo $destino; echo '</h4>';
?>

</body>

</html>





<?php
/*

www.elcodigofuente.com/enviar-mail-correos-php-planos-html-569/


\n = salto de línea
\t = sangría
\r = retorno de carro

$para = 'destino@dominio.com';
$titulo = 'El título del correo';
$mensaje = 'Hola, bienvenido a mi sitio web \r\n Saludos'; //Mensaje de 2 lineas
$cabeceras = 'From: webmaster1@midominio.com' . "\r\n" . //La direccion de correo desde donde supuestamente se envió
    'Reply-To: webmaster2@midominio.com' . "\r\n" . //La direccion de correo a donde se responderá (cuando el recepto haga click en RESPONDER)
    'X-Mailer: PHP/' . phpversion();  //información sobre el sistema de envio de correos, en este caso la version de PHP
 
mail($para, $titulo, $mensaje, $cabeceras);

*/
?>















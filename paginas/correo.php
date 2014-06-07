<?php

$casilla = 'daniel_martinez@siman.com';
 
$asunto = 'Aca va el asunto del email';

$cabeceras = "From: karla_hernandez@siman.com \r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";

$mensaje = '<html><body>';
$mensaje .= '<h1>¡Hola mundo!</h1>';
$mensaje .= '</body></html>';

$mensaje = '<html><body>';
$mensaje .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$mensaje .= "<tr style='background: #eee;'><td><strong>Nombre:</strong> </td><td> jjjjjjjj</td></tr>";
$mensaje .= "<tr><td><strong>Email:</strong> </td><td> kkkkkk </td></tr>";
$mensaje .= "<tr><td><strong>Tipo:</strong> </td><td> mmmmmm</td></tr>";
$mensaje .= "<tr><td><strong>Prioridad:</strong> </td><td> kkkkk </td></tr>";
$mensaje .= "<tr><td><strong>Nombre de usuario a cambiar (principal):</strong> </td><td> tttttt </td></tr>";

$mensaje .= "<tr><td><strong>Nombre alternativo (adicional):</strong> </td><td> xxxx </td></tr>";

$mensaje .= "<tr><td><strong>Contenido actual:</strong> </td><td> zzzzz </td></tr>";

$mensaje .= "<tr><td><strong>Nuevo contenido:</strong> </td><td> llllll </td></tr>";
$mensaje .= "</table>";
$mensaje .= "</body></html>";

mail($casilla, $asunto, $mensaje, $cabeceras, );

ini_set('SMTP',"10.100.1.103");
ini_set('smtp_port','25');

echo 'codigo ejecutado . 2';




?>




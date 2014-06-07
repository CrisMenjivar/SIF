<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" type="text/javascript" src="../../js/astnuevos.js"></script>

<script language="javascript" type="text/javascript" src="../../js/seguridad.js"></script>

<link href="../../estilo/estiloast.css" rel="stylesheet" type="text/css" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title></title>

</head>

<body style="margin:0px 0px 0px 0px;">
<?php 
$pos = $_GET['variable'];

session_start();
$_SESSION['pos_denegados_usuarios']=$pos;

?>

<iframe width="1000px" frameborder="0" scrolling="no" height="179px" src="1_rechazarastajax_contenido.php" marginheight="0" marginwidth="0" style="margin:0px 0px 0px 0px;padding:0px 0px 0px 0px;">
</iframe>

</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link href="estilo/estilo.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="js/formularios.js"></script>
<script language="javascript" type="text/javascript" src="js/seguridad.js"></script>
<script language="javascript" src="js/IE9.js" type="text/javascript"></script>

<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>An&aacute;lisis Semanal de Tiempo -- AST</title>
</head>
<body style="margin-top:1px;">
<?php
include 'config/db.php';


//Verificamos que el usuario haya iniciado sesion
session_start();
if(@$_SESSION['user']!="") //colocamos arroba para evitar que se despliege error por si la variable no a sido creada
{

$sql="select * from usuarios where user='".$_SESSION['user']."' ";
$result = mysql_query($sql,$conexion);
$fila=mysql_fetch_array($result);

$nivel=$fila['admin'];

if($nivel==1)
{
header ("Location: paginas/admin/menuadmin.php");
}
if($nivel==2)
{
header ("Location: paginas/usuarios/ast.php");
}
if($nivel==3)
{
header ("Location: paginas/jefes/ast.php");
}

}

?>

<div id="contenedor" style="left: 0px; top: 0px; height: 619px">
<div id="encabezadologin">

<div id="logo">

<div id="logoimagen">
<img src="imagenes/sites.png" style="border-radius:10px;" alt="sites"/>
</div>
<div id="textologo">
<p>Shared IT Enterprise Services</p>
</div>
</div>
<div id="astdes">
<p>An&aacute;lisis Semanal de Tiempo -- AST</p>
</div>

</div>
<div id="contenedorlogin">
<form name="sesiones" action="paginas/validarusuario.php" method="post" onsubmit="return validarlogin(this)">
<div id="encabezado">
<p><b>Iniciar Sesion</b></p>
</div>

<div id="cajas" >
<div id="inputtex">
<input type="text" style="box-shadow: 0 1px 2px -2px black;"  name="usuario" value="" />

</div>
<div id="textos">
<p><b>Usuario :</b></p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="password" style="box-shadow: 0 1px 2px -2px black;"  name="pass" value="" />

</div>
<div id="textos">
<p><b>Contrase&ntilde;a :</b></p>
</div>
</div>

<div id="cajasbotom">
<div id="inputbotom">
<input type="submit" value="Iniciar Sesion"/>
</div>
</div>
</form>
</div>

<div id="msj" style="height: 250px">
<?php
$errorDato="";


if( isset( $_SESSION['error'] ) )
{
if($_SESSION['error']=="tres")
{
$errorDato="Su cuenta de usuario fue cancelada, Por favor comuniquese con el administrador para activarla";
}
if($_SESSION['error']=="uno")
{
$errorDato="Usuario o contrase&ntilde;a no v&aacute;lida, por favor verificar.";
}
session_unset( $_SESSION['error'] );
}
?>
<center><br/><br/><?php echo $errorDato; ?></center>
</div>

<div id="footer">
</div>
</div>

</body>

</html>

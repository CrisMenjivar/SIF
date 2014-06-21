<html >

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title></title>
</head>

<body>

<?php
$login= mysql_real_escape_string($_POST['usuario']);
$login=strtolower($login);
$login=strtr($login,' ','_');
$clave = mysql_real_escape_string($_POST['pass']);
$clave = strtolower($clave);
$clave=hash_hmac('md5', $clave, 'ast');


include '../config/db.php';

//guardar la conexion realizada al servidor de bases de datos en una variable
$conexion=mysql_connect($servidor,$usuario,$contra) or die(mysql_error());

//verificar si la conexion se realizo con exito
if(!$conexion)
{
die("No se pudo conectar");
}
//Seleccionar la base de datos a las que nos conectaremos
$bd=mysql_select_db($nombre_bd,$conexion) or die(mysql_error());


session_start();
$op="pc";
$_SESSION['type']=$op;

$sql="select user,admin,estado,nombre from usuarios where user='$login' and pass='$clave' ";
$result = mysql_query($sql,$conexion);
$fila=mysql_fetch_array($result);

if($fila!="")
{
if($fila['estado']=="a")
{
session_start();
$_SESSION['user']=$login;
$_SESSION['tiempo']= time();

//variables para el excel----------
$_SESSION['fecha']="";
$_SESSION['descripcion']="";
$_SESSION['inicio']="";
$_SESSION['fin']="";
$_SESSION['check']="100000000000000000";
//--------------------------------------

//variables para modificar----------
$_SESSION['m_fecha']="";
$_SESSION['m_descripcion']="";
$_SESSION['m_actividad']="";
$_SESSION['m_empresa']="";
$_SESSION['m_proyecto']="";
$_SESSION['m_inicio']="";
$_SESSION['m_fin']="";
$_SESSION['m_total']="";
$_SESSION['m_check']="100000000000000000";
//--------------------------------------

//variables para corregir----------
$_SESSION['c_fecha']="";
$_SESSION['c_descripcion']="";
$_SESSION['c_actividad']="";
$_SESSION['c_empresa']="";
$_SESSION['c_proyecto']="";
$_SESSION['c_inicio']="";
$_SESSION['c_fin']="";
$_SESSION['c_total']="";
$_SESSION['c_check']="100000000000000000";
//--------------------------------------






if($fila['admin']=="1")
{
header ("Location: admin/menuadmin.php");
}

if($fila['admin']=="2")
{
header ("Location: usuarios/ast.php");
}

if($fila['admin']=="3")
{
header ("Location: jefes/ast.php");
}

if($fila['admin']=="4")
{
header ("Location: jefes_proyectos/ast.php");
}



}
else
{
$errores="tres";
session_start();
$_SESSION['error']=$errores;
header ("Location: ../index.php");
}
}
else
{
$errores="uno";
session_start();
$_SESSION['error']=$errores;
header ("Location: ../index.php");
}

?>

</body>

</html>

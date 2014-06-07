<?php

$opcion=$_GET['opcion'];

session_start();

$_SESSION['type']=$opcion;

//header ("Location: ast.php");

?>

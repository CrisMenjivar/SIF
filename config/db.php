<?php
    $servidor="localhost"; $usuario="usersif"; $contra="usersif"; $nombre_bd="bdastsif";
    //$conexion=mysqli_connect($servidor, $usuario, $contra, $nombre_bd);
    
    session_start();
 
    $inactivo = 10*60;
 
    if(isset($_SESSION['tiempo']) ) {
    $vida_session = time() - $_SESSION['tiempo'];
        if($vida_session > $inactivo)
        {
            session_destroy();
        }
    }
 
    session_write_close();
?>

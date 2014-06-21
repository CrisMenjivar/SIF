<?php
    $servidor="localhost"; $usuario="registroast"; $contra="registroast"; $nombre_bd="registroast";
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

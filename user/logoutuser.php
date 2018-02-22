<?php
session_start();

    if (isset($_SESSION["user"])) {
        if ($_SESSION["tipo"]!="Usuario") {
            session_destroy();
            header("Location: inicio.php");        
        }
    } 
    else {      
        session_destroy();
        header("Location: panel.php");
    }
session_destroy();
header("Location: ../user/inicio.php");
?>
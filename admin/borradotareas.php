<?php 
    session_start();

    if (isset($_SESSION["user"])) {
        if ($_SESSION["tipo"]!="Administrador") {
            session_destroy();
            header("Location: inicio.php");        
        }
    } 
    else {      
        session_destroy();
        header("Location: ../user/inicio.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Reparaciones</title>
  </head>
  <body>
    <?php

      //CREATING THE CONNECTION
      $connection = new mysqli("localhost", "root", "Admin2015", "MIDGARD");
      $connection->set_charset("utf8");

      //TESTING IF THE CONNECTION WAS RIGHT
      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }

      //MAKING A SELECT QUERY
      /* Consultas de selección que devuelven un conjunto de resultados */
     
      $query1 = "SET FOREIGN_KEY_CHECKS=0";
      echo "$query1";
      $connection->query($query1);
          
           
            
      
      
      
      $query2 = "delete from Tareas where IDTarea ='".$_GET['id']."'";
      echo "$query2";
      if ($result = $connection->query($query2)) {  
          
          header('Location: Tareas-ADMIN.php'); 
            
      }

          //Free the result. Avoid High Memory Usages
          $result->close();
          unset($obj);
          unset($connection);

       //END OF THE IF CHECKING IF THE QUERY WAS RIGHT

    ?>
  </body>
</html>
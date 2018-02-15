<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrando ...</title>
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
      
      $connection->query($query1);
          
           
            
      
      
      
      $query2 = "delete from Eventos where IDEv ='".$_GET['id']."'";
      
      if ($result = $connection->query($query2)) {  
          
          header('Location: Eventos-ADMIN.php'); 
            
      }

          //Free the result. Avoid High Memory Usages
          $result->close();
          unset($obj);
          unset($connection);

       //END OF THE IF CHECKING IF THE QUERY WAS RIGHT

    ?>
  </body>
</html>
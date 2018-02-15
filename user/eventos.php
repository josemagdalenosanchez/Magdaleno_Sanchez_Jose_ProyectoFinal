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
        header("Location: inicio.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos</title>
    <link rel="stylesheet" href="../estilos/1.css">  
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
      if ($result = $connection->query("select * from Eventos;")) {

         

      ?>

          <!-- PRINT THE TABLE AND THE HEADER -->
        <h1>MIS EVENTOS</h1>
        <div class="tablasolo">  
        <table style="border:1px solid black">
          <thead>
            <tr>
              <th>Organizador</th>
              <th>Fecha del Evento</th>
              <th>Lugar</th>
              <th>Precio</th>
              
          </thead>
        </div>
      <?php

          //FETCHING OBJECTS FROM THE RESULT SET
          //THE LOOP CONTINUES WHILE WE HAVE ANY OBJECT (Query Row) LEFT
          while($obj = $result->fetch_object()) {
              //PRINTING EACH ROW
              echo "<tr>";
              echo "<td>".$obj->Organizador."</td>";
              echo "<td>".$obj->FechaEvento."</td>";
              echo "<td>".$obj->Lugar."</td>";
              echo "<td>".$obj->Precio."</td>";
                            
              echo "</tr>";
          }

          //Free the result. Avoid High Memory Usages
          $result->close();
          unset($obj);
          unset($connection);

      } //END OF THE IF CHECKING IF THE QUERY WAS RIGHT

    ?>
  </body>
</html>

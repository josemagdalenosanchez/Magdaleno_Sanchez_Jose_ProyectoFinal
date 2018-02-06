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
    <link rel="stylesheet" href="../estilos/1.css">
    <title>Tareas</title>
  </head>
  <body>
    <?php

      //CREATING THE CONNECTION
      $connection = new mysqli("localhost", "root", "2asirtriana", "MIDGARD");
      $connection->set_charset("utf8");

      //TESTING IF THE CONNECTION WAS RIGHT
      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }

      //MAKING A SELECT QUERY
      /* Consultas de selección que devuelven un conjunto de resultados */
      if ($result = $connection->query("select * from Tareas t join Informe i on t.IDTarea = i.IDTarea join Miembros m on i.IDMiem = m.IDMiem where m.Nombre ='".$_SESSION["user"]."'  ;")) {
            
         

      ?>

          <!-- PRINT THE TABLE AND THE HEADER -->
          
        <table class="tablasolo">
          <thead>
            <tr>
              <th>Descripcion</th>
              <th>Fecha de la Tarea</th>
            </tr>  
          
          </thead>
              
      <?php

          //FETCHING OBJECTS FROM THE RESULT SET
          //THE LOOP CONTINUES WHILE WE HAVE ANY OBJECT (Query Row) LEFT
          while($obj = $result->fetch_object()) {
              //PRINTING EACH ROW
              echo "<tr>";
              echo "<td>".$obj->Descripcion."</td>";
              echo "<td>".$obj->FechaTarea."</td>";
                                        
              echo "</tr>";
              
          }

          //Free the result. Avoid High Memory Usages
          $result->close();
          unset($obj);
          unset($connection);

      } //END OF THE IF CHECKING IF THE QUERY WAS RIGHT

    ?>
      </table>
  </body>
</html>

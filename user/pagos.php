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
    <title>Pagos</title>
    <link rel="stylesheet" href="../estilos/1.css">
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
      if ($result = $connection->query("select * from Pagos p join Miembros m on p.IDMiem = m.IDMiem where m.Nombre ='".$_SESSION["user"]."'  ;")) {
            
         

      ?>

          <!-- PRINT THE TABLE AND THE HEADER -->
        <h1>MIS PAGOS</h1>  
        <table style="border:1px solid black">
          <thead>
            <tr>
              <th>Concepto</th>
              <th>Pago</th>
              <th>Fecha Limite</th>
              
          </thead>

      <?php

          //FETCHING OBJECTS FROM THE RESULT SET
          //THE LOOP CONTINUES WHILE WE HAVE ANY OBJECT (Query Row) LEFT
          while($obj = $result->fetch_object()) {
              //PRINTING EACH ROW
              echo "<tr>";
              echo "<td>".$obj->Concepto."</td>";
              echo "<td>".$obj->Cantidad."</td>";
              echo "<td>".$obj->FechaPago."</td>";                          
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

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
        header("Location: panel.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/1.css">
    <title>Gestion de Usuarios</title>
  </head>
  <body>
    <?php

      //CREATING THE CONNECTION
      $connection = new mysqli("localhost", "root", "Admin2015", "MIDGARD",3316);
      $connection->set_charset("utf8");

      //TESTING IF THE CONNECTION WAS RIGHT
      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }

      //MAKING A SELECT QUERY
      /* Consultas de selección que devuelven un conjunto de resultados */
      if ($result = $connection->query("select * from Miembros;")) {

         

      ?>

          <!-- PRINT THE TABLE AND THE HEADER -->
          <table style="border:1px solid black">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Apellidos</th>
              <th>Fecha de Nacimiento</th>
              <th>Fecha de Ingreso</th>
              <th>Tipo</th>
              <th>E-Mail</th>
              <th>ACCIONES</th>    
          </thead>

      <?php

          //FETCHING OBJECTS FROM THE RESULT SET
          //THE LOOP CONTINUES WHILE WE HAVE ANY OBJECT (Query Row) LEFT
          while($obj = $result->fetch_object()) {
              //PRINTING EACH ROW
              echo "<tr>";
              echo "<td>".$obj->Nombre."</td>";
              echo "<td>".$obj->Apellidos."</td>";
              echo "<td>".$obj->FechaNacimiento."</td>";
              echo "<td>".$obj->FechaIngreso."</td>";
              echo "<td>".$obj->Tipo."</td>";
              echo "<td>".$obj->EMail."</td>";
              echo "<td>".
                   "<a href=borrado.php?id=$obj->IDMiem>"."<img src='../imagenes/borrar.png' width=15px heigth=15px>".
                   "<a href=aumentoprivilegios.php?id=$obj->IDMiem>"."<img src='../imagenes/aumentar.png' width=15px heigth=15px>".
                   "<a href=reducir.php?id=$obj->IDMiem>"."<img src='../imagenes/degradar.gif' width=18px heigth=18px>".
                   "</td>";
              echo "</tr>";
          }

          //Free the result. Avoid High Memory Usages
          $result->close();
          unset($obj);
          unset($connection);

      } //END OF THE IF CHECKING IF THE QUERY WAS RIGHT

    ?>
    <a href='Panel-ADMIN.php'><img src='../imagenes/atras.svg' width=60px heigth=60px>           
  </body>
</html>

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
    <title>Gestion de Reparaciones</title>
  </head>
  <body>
    <div id="general">
        <div id="izda">
        <h1>GESTION DE TAREAS</h1>    
        <table style="border:1px solid black">
          <thead>
            <tr>
              <th>Descripcion</th>
              <th>Fecha</th>
              <th>Miembros</th>              
            </thead>         
            
        
    <?php

      //CREATING THE CONNECTION
      $connection = new mysqli("localhost", "root", "2asirtriana", "MIDGARD");
      $connection->set_charset("utf8");

      //TESTING IF THE CONNECTION WAS RIGHT
      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }

     if (isset($_POST['fecha'])) {
       $query2 = "INSERT INTO Tareas VALUES (null,'".$_POST["desc"]."','".$_POST["fecha"]."')";
       $result = $connection->query($query2);
      
                    
       $query3 = "INSERT INTO Informe  VALUES (".$_POST["miembro"].",".$connection->insert_id.")";
       $result = $connection->query($query3);
      
     }
                     
 
      //MAKING A SELECT QUERY
      /* Consultas de selección que devuelven un conjunto de resultados */
      if ($result = $connection->query("select t.Descripcion, t.FechaTarea, m.Nombre,t.IDTarea from Tareas t join Informe i on t.IDTarea = i.IDTarea join Miembros m on i.IDMiem = m.IDMiem;")) {

         
        
          //FETCHING OBJECTS FROM THE RESULT SET
          //THE LOOP CONTINUES WHILE WE HAVE ANY OBJECT (Query Row) LEFT
          while($obj = $result->fetch_object()) {
              //PRINTING EACH ROW
              echo "<tr>";
              echo "<td>".$obj->Descripcion."</td>";
              echo "<td>".$obj->FechaTarea."</td>";
              echo "<td>".$obj->Nombre."</td>";
              echo "<td>".
                   "<a href='borradotareas.php?id=".$obj->IDTarea."'><img src='../imagenes/borrar.jpg' width=15px heigth=15px>".
                   "<a href='editadotareas.php?id=".$obj->IDTarea."'><img src='../imagenes/editar.png' width=28px heigth=28px>".
                   "</td>";
              echo "</tr>";
      }

      ?>
     </div>
     <div id="dcha">
            

        <h1>INSERTAR TAREAS</h1>   
        <form method="post">
                <div>
                     <label for="mail">Descripcion:</label>
                     <input type="text" name="desc" />
                </div>
                <div>
                     <label for="mail">Fecha:</label>
                     <input type="date" name="fecha" required/>
                </div>
                <div>
                     <label for="mail">Miembro:</label>
                     <select name="miembro" required>
                    <?php
                          $query2 ="select IDMiem, Nombre from Miembros;";
                          $result=$connection->query($query2);    
          
                          while ($obj = $result->fetch_object()) {
                          echo "<option name ='miembro' value='".$obj->IDMiem."'>".$obj->Nombre."</option>";
                          
                          
                        }                   
                           ?>
                     </select>
                </div>
                <div>
                   
                     <input type="submit" id="Acceder" name="Acceder" class="boton"/>
                  
                </div>
                </form> 
           
        </div>    
      </div>
      <?php

          //Free the result. Avoid High Memory Usages
          $result->close();
          unset($obj);
          unset($connection);

      } //END OF THE IF CHECKING IF THE QUERY WAS RIGHT

    ?>
  </body>
</html>

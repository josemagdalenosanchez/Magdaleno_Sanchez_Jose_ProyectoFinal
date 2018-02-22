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
    <link rel="stylesheet" href="../estilos/2.css">  
    <title>Gestion de Eventos</title>
  </head>
  <body>
    <div id="general">
     <div id="izda">
        <h1>GESTION DE EVENTOS</h1>    
        <table style="border:1px solid black">
          <thead>
            <tr>
              <th>Descripcion</th>
              <th>Fecha</th>
              <th>Miembros</th>              
            </thead>         
            
        
    <?php

      //CREATING THE CONNECTION
      $connection = new mysqli("localhost", "root", "Admin2015", "MIDGARD");
      $connection->set_charset("utf8");

      //TESTING IF THE CONNECTION WAS RIGHT
      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }

     if (isset($_POST['fecha'])) {
       $query2 = "INSERT INTO Tareas VALUES (null,'".$_POST["desc"]."','".$_POST["fecha"]."','".$_POST["lug"]."','".$_POST["pre"]."')";
       $result = $connection->query($query2);
      
                  
       
      
     }
                     
 
      //MAKING A SELECT QUERY
      /* Consultas de selección que devuelven un conjunto de resultados */
      if ($result = $connection->query("select * from Eventos;")) {

         
        
          //FETCHING OBJECTS FROM THE RESULT SET
          //THE LOOP CONTINUES WHILE WE HAVE ANY OBJECT (Query Row) LEFT
          while($obj = $result->fetch_object()) {
              //PRINTING EACH ROW
              echo "<tr>";
              echo "<td>".$obj->Organizador."</td>";
              echo "<td>".$obj->FechaEvento."</td>";
              echo "<td>".$obj->Lugar."</td>";
              echo "<td>".$obj->Precio."</td>";
              echo "<td>".
                  "<a href='borradoeventos.php?id=".$obj->IDEv."'><img src='../imagenes/borrar.png' width=15px heigth=15px>".
                  "<a href='editadoeventos.php?id=".$obj->IDEv."'><img src='../imagenes/editar.png' width=15px heigth=28px>"
                  ."</td>";
              echo "</tr>";
             
      }

      ?>
         </table>       
     </div>
     <div id="dcha">
            

        <h1>INSERTAR EVENTO</h1>   
        <form method="post">
                <div>
                     <label for="mail">Organizador:</label>
                     <input type="text" name="desc" />
                </div>
                <div>
                     <label for="mail">Fecha:</label>
                     <input type="date" name="fecha" required/>
                </div>
                <div>
                     <label for="mail">Lugar:</label>
                     <input type="text" name="lug" />
                             
                </div>
                 <div>
                     <label for="mail">Precio:</label>
                     <input type="text" name="pre" /><br>
                      <label for="miembro">Añadir Miembro:</label>
                      <select name="miembro" required>
                    <?php
                          $query2 ="select IDMiem, Nombre from Miembros;";
                          $result=$connection->query($query2);    
          
                          while ($obj = $result->fetch_object()) {
                          echo "<option name ='miembro' value='".$obj->IDMiem."'>".$obj->Nombre."</option>";
                          
                          
                        }                   
                           ?>       
                </div>
                
                <div>
                   
                     <input type="submit" id="Acceder" name="Acceder" class="boton"/>
                  
                </div>
                 
           
               
                     </form>
      
     </div>        
      <?php

          //Free the result. Avoid High Memory Usages
          $result->close();
          unset($obj);
          unset($connection);

      } //END OF THE IF CHECKING IF THE QUERY WAS RIGHT

    ?>
    <a href='Panel-ADMIN.php'><img src='../imagenes/atras.svg' width=60px heigth=60px>
    </div>
    </div>        
  </body>
</html>

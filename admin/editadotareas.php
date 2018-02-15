<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passing info with POST and HTML FORMS using a single file.</title>
    <link rel="stylesheet" type="text/css" href="../estilos/1.css">
    <style>
      span {
        width: 100px;
        display: inline-block;
      }
    </style>
  </head>
  <body>

      <!-- PHP STRUCTURE FOR CONDITIONAL HTML -->
      <!-- FIRST TIME. NO DATA IN THE POST (checking a required form field) -->
      <!-- So we must show the form -->

      <?php

        if (empty($_GET)) {
          echo "No se han recibido datos de la Tarea";
          exit();
        }


      ?>

      <?php if (!isset($_POST["fecha"])) : ?>

        <?php

          //CREATING THE CONNECTION
          $connection = new mysqli("localhost", "root", "Admin2015", "MIDGARD",3316);
          $connection->set_charset("uft8");

          //TESTING IF THE CONNECTION WAS RIGHT
          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }

          //MAKING A SELECT QUERY
          /* Consultas de selección que devuelven un conjunto de resultados */
          $query="SELECT * from Tareas where IDTarea ='".$_GET["id"]."'";
          
          if ($result = $connection->query($query))  {

            $obj = $result->fetch_object();

            if ($result->num_rows==0) {
              echo "NO EXISTE ESA TAREA";
              exit();
            }

            $codigo = $obj->IDTarea;
            $descripcion = $obj->Descripcion;
            $fecha = $obj->FechaTarea;
            
            

          } 

        ?>
        <form method="post">
          <fieldset>
            <legend>Información de la Tarea</legend>
            <span>Descripcion:</span><input value='<?php echo $descripcion; ?>' type="text" name="des" required><br>
            <span>Fecha de la Tarea:</span><input value='<?php echo $fecha; ?>'type="date" name="fecha" required><br>
            <select name="miembro" required>
                    <?php
                          $query2 ="select IDMiem, Nombre from Miembros;";
                          $result=$connection->query($query2);    
          
                          while ($obj = $result->fetch_object()) {
                          echo "<option name ='miembro' value='".$obj->IDMiem."'>".$obj->Nombre."</option>";
                          
                          
                        }                   
                           ?>  
            <input type="hidden" name="codigo" value='<?php echo $codigo; ?>'>
            <p><input type="submit" value="Actualizar"></p>
          </fieldset>
        </form>

      <!-- DATA IN $_POST['dni']. Coming from a form submit -->
      <?php else: ?>

        <?php

        $codigo = $_POST["codigo"];
        $descripcion = $_POST["des"];
        $fecha = $_POST["fecha"];
        $miembro = $_POST["miembro"];
        

        //CREATING THE CONNECTION
        $connection = new mysqli("localhost", "root", "Admin2015", "MIDGARD",3316);
        $connection->set_charset("uft8");

        //TESTING IF THE CONNECTION WAS RIGHT
        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }

        //MAKING A SELECT QUERY
        /* Consultas de selección que devuelven un conjunto de resultados */
        if (isset($_POST['fecha'])) {
        $query="update Tareas set Descripcion='$descripcion',FechaTarea='$fecha'
        WHERE IDTarea='$codigo'";
           
        $query2="update Informe set IDMiem ='$miembro' WHERE IDTarea='$codigo'";
        }
            
        if ($result = $connection->query($query)) {
          echo "Datos actualizados";
          header('Location: Tareas-ADMIN.php');    
        } else {
          echo "Error al actualizar los datos";
        }
        if ($result = $connection->query($query2)) {
          echo "Datos actualizados";
          header('Location: Tareas-ADMIN.php');    
        } else {
          echo "Error al actualizar los datos";
        }    

        ?>

      <?php endif ?>

  </body>
</html>
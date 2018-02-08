<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passing info with POST and HTML FORMS using a single file.</title>
    <link rel="stylesheet" type="text/css" href=" ">
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
          echo "No se han recibido datos del cliente";
          exit();
        }


      ?>

      <?php if (!isset($_POST["lug"])) : ?>

        <?php

          //CREATING THE CONNECTION
          $connection = new mysqli("localhost", "root", "2asirtriana", "MIDGARD");
          $connection->set_charset("uft8");

          //TESTING IF THE CONNECTION WAS RIGHT
          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }

          //MAKING A SELECT QUERY
          /* Consultas de selección que devuelven un conjunto de resultados */
          $query="SELECT * from Eventos where IDEv ='".$_GET["id"]."'";

          if ($result = $connection->query($query))  {

            $obj = $result->fetch_object();

            if ($result->num_rows==0) {
              echo "NO EXISTE ESE EVENTO";
              exit();
            }

            $codigo = $obj->IDEv;
            $organizador = $obj->Organizador;
            $fechaEvento = $obj->FechaEvento;
            $lugar = $obj->Lugar;
            $precio = $obj->Precio;
            

          } 

        ?>
        <form method="post">
          <fieldset>
            <legend>Información del Evento</legend>
            <span>Organizador:</span><input value='<?php echo $organizador; ?>' type="text" name="org" required><br>
            <span>Fecha del Evento:</span><input value='<?php echo $fechaEvento; ?>'type="date" name="fecha" required><br>
            <span>Lugar:</span><input type="text" value='<?php echo $lugar; ?>'name="lug" required><br>
            <span>Precio:</span><input type="text" name="prec" value='<?php echo $precio; ?>'><br>
            <input type="hidden" name="codigo" value='<?php echo $codigo; ?>'>
            <p><input type="submit" value="Actualizar"></p>
          </fieldset>
        </form>

      <!-- DATA IN $_POST['dni']. Coming from a form submit -->
      <?php else: ?>

        <?php

        $codigo = $_POST["codigo"];
        $organizador = $_POST["org"];
        $fecha = $_POST["fecha"];
        $lugar = $_POST["lug"];
        $precio = $_POST["prec"];
        

        //CREATING THE CONNECTION
        $connection = new mysqli("localhost", "root", "2asirtriana", "MIDGARD");
        $connection->set_charset("uft8");

        //TESTING IF THE CONNECTION WAS RIGHT
        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }

        //MAKING A SELECT QUERY
        /* Consultas de selección que devuelven un conjunto de resultados */
        $query="update Eventos set Organizador='$organizador',FechaEvento='$fecha',
        Lugar='$lugar',Precio='$precio'
        WHERE IDEv='$codigo'";

        echo $query;
        if ($result = $connection->query($query)) {
          echo "Datos actualizados";
          header('Location: Eventos-ADMIN.php');    
        } else {
          echo "Error al actualizar los datos";
        }

        ?>

      <?php endif ?>

  </body>
</html>

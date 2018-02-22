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
          echo "No se han recibido datos del cliente";
          exit();
        }


      ?>

      <?php if (!isset($_POST["can"])) : ?>

        <?php
            

          //CREATING THE CONNECTION
          $connection = new mysqli("localhost", "root", "Admin2015", "MIDGARD",3316);
          $connection->set_charset("uft8");

          //TESTING IF THE CONNECTION WAS RIGHT
          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              echo "HOLA";
              exit();
          }

          //MAKING A SELECT QUERY
          /* Consultas de selección que devuelven un conjunto de resultados */
          $query="SELECT p.*, m.Nombre from Pagos p join Miembros m on p.IDMiem = m.IDMiem where IDPag ='".$_GET["id"]."'";

        echo $query;
          if ($result = $connection->query($query))  {

            $obj = $result->fetch_object();

            if ($result->num_rows==0) {
              echo "NO EXISTE ESE EVENTO";
              exit();
            }

            $codigo = $obj->IDPag;
            $concepto = $obj->Concepto;
            $cantidad = $obj->Cantidad;
            $fecha = $obj->FechaPago;
            $nombre = $obj->Nombre;
              
            
            

          } 

        ?>
        <form method="post">
          <fieldset>
            <legend>Información del Pago</legend>
            <span>Concepto:</span><input value='<?php echo $concepto; ?>' type="text" name="con" required><br>
            <span>Fecha de Pago:</span><input value='<?php echo $fecha; ?>'type="date" name="fecha" required><br>
            <span>Cantidad:</span><input type="text" value='<?php echo $cantidad; ?>'name="can" required><br>
            <span>Miembro:</span><input type="text" name="mi" value='<?php echo $nombre; ?>'><br>
            <input type="hidden" name="codigo" value='<?php echo $codigo; ?>'>
            <p><input type="submit" value="Actualizar"></p>
          </fieldset>
        </form>

      <!-- DATA IN $_POST['dni']. Coming from a form submit -->
      <?php else: ?>

        <?php

        $codigo = $_POST["codigo"];
        $concepto = $_POST["con"];
        $fecha = $_POST["fecha"];
        $cantidad = $_POST["can"];
        $miembro = $_POST["mi"];
        

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
        $query="update Pagos set Concepto='$concepto',Cantidad='$cantidad',
        FechaPago='$fecha'
        WHERE IDPag='$codigo'";

        
        if ($result = $connection->query($query)) {
          echo "Datos actualizados";
          header('Location: Pagos-ADMIN.php');    
        } else {
          echo "Error al actualizar los datos";
        }

        ?>

      <?php endif ?>

  </body>
</html>
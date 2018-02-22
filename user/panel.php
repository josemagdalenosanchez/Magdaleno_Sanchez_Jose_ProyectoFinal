<?php 
    session_start();
    
    if (!isset($_SESSION["user"])) {
      session_destroy();
      header("Location: inicio.php");
    } 
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../estilos/1.css">
</head>

<body>
    
    <div id="general">
        <h1>PANEL DE CONTROL</h1>
        <div id="opciones">
            <div id="tareas"><img src="../imagenes/martillo.svg" width="100px" height="100px"><a href='tareas.php' class="boton">Tareas</a></div>
            <div id="eventos"><img src="../imagenes/espada.png" width="100px" height="100px"><a href='eventos.php' class="boton">Eventos</a></div>
            <div id="pagos"><img src="../imagenes/moneda.png" width="100px" height="100px"><a href='pagos.php' class="boton">Pagos</a></div>
            <a href='logoutuser.php'><img src='../imagenes/atras.svg' width=60px heigth=60px>
        </div>
    </div>
</body>
</html>

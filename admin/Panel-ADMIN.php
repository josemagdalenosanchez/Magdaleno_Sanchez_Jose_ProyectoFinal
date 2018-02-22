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
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/1.css">
    <title></title>
    <link rel="stylesheet" href="../estilos/1.css">
</head>

<body>
    <div id="general">
        <h1>PANEL DE CONTROL</h1>
        <div id="opciones">
            <div id="tareas"><img src="../imagenes/martillo.svg" width="100px" height="100px"><a href='Tareas-ADMIN.php' class="boton">Gestion de Tareas</a></div>
            <div id="eventos"><img src="../imagenes/espada.png" width="100px" height="100px"><a href='Eventos-ADMIN.php' class="boton">Gestion de Eventos</a></div>
            <div id="pagos"><img src="../imagenes/moneda.png" width="100px" height="100px"><a href='Pagos-ADMIN.php' class="boton">Gestion de Pagos</a></div>
            <div id="usuarios"><img src="../imagenes/usuario.svg" width="100px" height="100px"><a href='Usuarios-ADMIN.php' class="boton">Gestion de Usuarios</a></div>
            <a href='logout.php'><img src='../imagenes/atras.svg' width=60px heigth=60px>
        </div>
    </div>
</body>
</html>

<?php
    session_start();
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
    <?php
        //FORM SUBMITTED
        if (isset($_POST["user"])) {
          //CREATING THE CONNECTION
          $connection = new mysqli("localhost", "root", "Admin2015", "MIDGARD",3316);
          //TESTING IF THE CONNECTION WAS RIGHT
          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }
          
          
          //MAKING A SELECT QUERY
          //Password coded with md5 at the database. Look for better options
          $consulta="select * from Miembros where
          Nombre='".$_POST["user"]."' and Pass=md5('".$_POST["pass"]."');";         
        
            
          //Test if the query was correct
          //SQL Injection Possible
          //Check http://php.net/manual/es/mysqli.prepare.php for more security
          if ($result = $connection->query($consulta)) {
              //No rows returned
              if ($result->num_rows===0) {
                echo "LOGIN INVALIDO";
                session_destroy();  
              } else {
                //VALID LOGIN. SETTING SESSION VARS
                $obj = $result->fetch_object();
                $_SESSION["user"]=$_POST["user"];
                $_SESSION["language"]="es";
                $_SESSION["tipo"]=$obj->Tipo;
                var_dump($_SESSION);
                if ($obj->Tipo == "Usuario"){
                    header('Location: panel.php');    
                }  
                else {
                    header('Location: ../admin/Panel-ADMIN.php');
                }
              }
           } else {
            echo "Wrong Query";
           }
          }
  
    ?>
    <div id="general">
        <h1>PROGRAMA DE GESTION MIDGARD</h1>
        <div id="banner">
            <div id="imagen">
                <img src="../imagenes/a.png" alt="Banner" height="500" width="500">     
                <div id="bregistro"><a href="registro.php" target="_blank" class="boton">¡REGISTRATE YA!</a></div>
            </div>
            <div id="datos">
                <form method="post">
                <div>
                     <label for="mail">Nombre:</label>
                     <input type="text" name="user" />
                </div>
                <div>
                     <label for="mail">Password:</label>
                     <input type="password" name="pass" />
                </div>
                <div>
                     <input type="submit" id="Acceder" name="Acceder" class="boton" />
                </div>
                </form>    
            </div>
        </div>
    </div>
</body>
</html>

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
       <h1>REGISTRO</h1>
        <?php
            $host_db = "localhost";
            $user_db = "root";
            $pass_db = "2asirtriana";
            $db_name = "MIDGARD";
            $tbl_name = "Miembros";
 
            $form_pass = $_POST['pass'];
 
            $hash = password_hash($form_pass, PASSWORD_BCRYPT); 

            $conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

 if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}

 $buscarUsuario = "SELECT * FROM $tbl_name
 WHERE EMail = '$_POST[mail]' ";

 $result = $conexion->query($buscarUsuario);

 $count = mysqli_num_rows($result);

 if ($count == 1) {
 echo "<br />". "Usuario ya registrado." . "<br />";

 echo "<a href='index.html'>Por favor escoga otro Nombre</a>";
 }
 else{

 $query = "INSERT INTO Miembros (Nombre, Apellidos, FechaNacimiento, FechaIngreso, EMail, Password)
           VALUES ('$_POST[nom]','$_POST[ape]','$_POST[fdn]','$_POST[fdi]','$_POST[mail]', '$hash')";

 if ($conexion->query($query) === TRUE) {
 
 echo "<br />" . "<h2>" . "Usuario Creado Exitosamente!" . "</h2>";
 echo "<h4>" . "Bienvenido: " . $_POST['nom'] . "</h4>" . "\n\n";
 echo "<h5>" . "Hacer Login: " . "<a href='login.html'>Login</a>" . "</h5>"; 
 }

 else {
 echo "Error al crear el usuario." . $query . "<br>" . $conexion->error; 
   }
 }
 mysqli_close($conexion);
?>
       <div id="fregistro">
           
                <?php if (!isset($_POST["nom"])) : ?>
                
                    <form action="/my-handling-form-page" method="post">
                    <div>
                         <label for="name">Nombre:</label>
                         <input type="text" id="nom" required/>
                    </div>
                    <div>
                         <label for="name">Apellidos:</label>
                         <input type="text" id="ape" />
                    </div>
                    <div>
                         <label for="name">Fecha de Nacimiento:</label>
                         <input type="date" id="fdn" />
                    </div>
                    <div>
                         <label for="name">Fecha de Ingreso:</label>
                         <input type="date" id="fdi" />
                    </div>    
                    <div>
                         <label for="mail">E-mail:</label>
                         <input type="email" id="mail" />
                    </div>
                    <div>
                         <label for="name">Contraseña:</label>
                         <input type="password" id="pass" />
                    </div>    

                    <div>
                         <input type="submit" id="Acceder" name="Acceder" class="boton" />
                    </div>
                    </form>    
        </div>
        
        <?php else : ?>
        
                
        <?php elseif; ?>
        
    </div>
</body>
</html>

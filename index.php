<?php
// Conexión a la base de datos (reemplaza estos valores con los de tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "authenapp";


// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}

// Proceso de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $correo = $_POST["email"];
    $contrasena = $_POST["password"];

    // Hash de la contraseña
    $hashedContrasena = password_hash($contrasena, PASSWORD_DEFAULT);

    // Insertar el usuario en la base de datos
    $sql = "INSERT INTO usuarios (correo, contrasena) VALUES ('$correo', '$hashedContrasena')";
    if ($conn->query($sql) === true) {
        // Redirigir a la página de inicio de sesión después del registro exitoso
        header("Location: login.php");
        exit();
    } else {
        echo "Error al registrar el usuario: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="css/theme.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+Adlam&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+Adlam+Unjoined&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+Anatolian+Hieroglyphs&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+Arabic&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+Armenian&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans:600,400,500&display=swap">
    </head>
    <body>
        <div class="container">
            <img src="devchallenges.svg" style="width: 130.17px; height: 18px; display: flex;"/>
            <div class="greeting" style="font-family: 'Noto Sans', sans-serif; font-weight: 600; font-size: 16px;">Join thousands of learners from around the world
                <p></p>
                <p></p>
            </div>
            <form class="login-form" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <!-- Agrega el atributo "method" y "action" al formulario -->
                <div class="greeting">
                    <p style="text-align: justify; font-family: 'Noto Sans', sans-serif; font-weight: 400; font-size: 16px;">Master web development by making real-life projects. There are multiple paths for you to choose</p>
                </div>
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <button type="submit">Start Coding Now</button>
            </form>
            <p class="socialmedia">or continue with these social profiles</P>
            <div class="socialmlogos">
                <img src="./Google.svg">
                <img src="./Facebook.svg">
                <img src="./Twitter.svg">
                <img src="./Gihub.svg">
            </div>
            <p style="font-family: 'Noto Sans', sans-serif; font-weight: 400; text-align: center; font-size: 14px;">Already a member? <a href="login.php">Login</a></p>
        </div>
    </body>
</html>
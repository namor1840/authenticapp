<?php
session_start();

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

// Proceso de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $correo = $_POST["email"];
    $contrasena = $_POST["password"];

    // Consultar la base de datos para verificar las credenciales
    $sql = "SELECT id, contrasena FROM usuarios WHERE correo = '$correo'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedContrasena = $row["contrasena"];
        // Verificar la contraseña usando password_verify()
        if (password_verify($contrasena, $hashedContrasena)) {
            // Autenticación exitosa, establecer la variable de sesión con el ID del usuario
            $_SESSION["usuario_id"] = $row["id"];
            header("Location: profile.php"); // Redirigir a la página de perfil después del inicio de sesión
            exit();
        } else {
            header("location: login.php");
        }
    } else {
        echo "Credenciales incorrectas. Por favor, intenta nuevamente.";
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
            <form class="login-form" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <button type="submit">Login</button>
            </form>
            <p class="socialmedia">or continue with these social profile</P>
            <div class="socialmlogos">
                <img src="./Google.svg">
                <img src="./Facebook.svg">
                <img src="./Twitter.svg">
                <img src="./Gihub.svg">
            </div>
            <p style="font-family: 'Noto Sans', sans-serif; font-weight: 400; text-align: center;">Don’t have an account yet? <a href="index.php">Register</a></p>
        </div>
    </body>
</html>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario_id"])) {
    // Si el usuario no ha iniciado sesión, redirigir al formulario de inicio de sesión
    header("Location: login.php");
    exit();
}

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

// Obtener el ID del usuario desde la sesión
$usuarioId = $_SESSION["usuario_id"];

// Consultar los datos del perfil del usuario
$sql = "SELECT * FROM usuarios WHERE id = $usuarioId";
$resultado = $conn->query($sql);

// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    $perfil = $resultado->fetch_assoc();
} else {
    die("Perfil no encontrado.");
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="css/theme.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="containerprofile">
            <!-- Menú desplegable en la parte superior derecha -->
            <div class="profile-container">
                <div class="profile-box">
                    <div class="profile-image">
                        <!-- Muestra la foto de perfil del usuario -->
                        <img src="<?php echo $perfil['imagen']; ?>" alt="imagen">
                    </div>
                    <div class="profile-info">
                        <h2><?php echo $perfil['nombre']; ?></h2>
                        <p><?php echo $perfil['biografia']; ?></p>
                        <p>Número de Teléfono: <?php echo $perfil['telefono']; ?></p>
                        <p>Correo Electrónico: <?php echo $perfil['correo']; ?></p>
                        <p>Contraseña: ***********</p><a href="editar_perfil.php" class="edit-button">Editar Perfil</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
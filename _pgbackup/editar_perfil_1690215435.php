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
if ($resultado->num_rows == 1) {
    $perfil = $resultado->fetch_assoc();
} else {
    die("Perfil no encontrado.");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $biografia = $_POST["biografia"];
    $telefono = $_POST["telefono"];

    $sql = "UPDATE usuarios SET nombre='$nombre', biografia='$biografia', telefono='$telefono' WHERE id = $usuarioId";
    if ($conn->query($sql) === true) {
        header("Location: profile.php");
        exit();
    } else {
        echo "Error al actualizar el perfil: " . $conn->error;
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="containerprofile">
        <div class="profile-container">
            <div class="profile-box">
                <form class="edit-profile-form" method="post">
                    <div class="profile-image">
                        <!-- Muestra la foto de perfil actual del usuario -->
                        <img src="<?php echo $perfil['imagen']; ?>" alt="Foto de Perfil">
                    </div>
                    <div class="profile-info">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" value="<?php echo $perfil['nombre']; ?>"><br>
                        <label for="biografia">Biografía:</label>
                        <textarea name="biografia"><?php echo $perfil['biografia']; ?></textarea><br>
                        <label for="telefono">Número de Teléfono:</label>
                        <input type="tel" name="telefono" value="<?php echo $perfil['telefono']; ?>"><BR>
                        <input type="submit" value="Guardar Cambios">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
</body>
</html>
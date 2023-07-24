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

// Proceso de actualización del perfil
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST["nombre"];
    $biografia = $_POST["biografia"];
    $telefono = $_POST["telefono"];

    // Procesar la foto de perfil
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagen_tmp = $_FILES['imagen']['tmp_name'];
        $imagen_name = $_FILES['imagen']['name'];
        $imagen_extension = pathinfo($imagen_name, PATHINFO_EXTENSION);
        $imagen_nombre_nuevo = uniqid('perfil_', true) . '.' . $imagen_extension;
        $imagen_destino = $imagen_nombre_nuevo;

        // Mover la foto de perfil al directorio raíz del servidor
        if (move_uploaded_file($imagen_tmp, $imagen_destino)) {
            // Actualizar la foto de perfil en la base de datos
            $sql = "UPDATE usuarios SET nombre='$nombre', biografia='$biografia', telefono='$telefono', imagen='$imagen_destino' WHERE id = $usuarioId";
            if ($conn->query($sql) === true) {
                // Redirigir a la página de perfil después de la actualización exitosa
                header("Location: profile.php");
                exit();
            } else {
                echo "Error al actualizar el perfil: " . $conn->error;
            }
        } else {
            echo "Error al subir la foto de perfil.";
        }
    } else {
        // Si no se seleccionó una nueva foto de perfil, actualizar los otros campos sin cambiar la foto
        $sql = "UPDATE usuarios SET nombre='$nombre', biografia='$biografia', telefono='$telefono' WHERE id = $usuarioId";
        if ($conn->query($sql) === true) {
            // Redirigir a la página de perfil después de la actualización exitosa
            header("Location: profile.php");
            exit();
        } else {
            echo "Error al actualizar el perfil: " . $conn->error;
        }
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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans:400,600,500&display=swap">
    </head>
    <body>
        <div class="navbar">
            <!-- Logo o título de la página, puedes agregarlo aquí -->
            <div class="profile-info">
                <!-- Foto de perfil del usuario -->
                <img src="<?php echo $perfil['imagen']; ?>" alt="Foto de Perfil">
                <!-- Nombre del usuario --><span><?php echo $perfil['nombre']; ?></span>
            </div>
            <div class="dropdown">
                <!-- Flecha para desplegar el menú -->
                <div class="arrow">&#9660;</div>
                <!-- Menú desplegable -->
                <div class="dropdown-content"><a href="#">My Profile</a><a href="profile.php">Group Chat</a><a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
        <div class="containerprofile">
            <div class="profile-container">
                <div class="profile-box">
                    <form class="edit-profile-form" method="post" enctype="multipart/form-data">
                        <div class="profile-image">
                            <!-- Muestra la foto de perfil actual del usuario -->
                            <img src="<?php echo $perfil['imagen']; ?>" alt="Foto de Perfil" style="width: 72px; height: 72px;">
                            <!-- Campo para seleccionar una nueva foto de perfil -->
                            <input type="file" name="imagen">
                        </div>
                        <h1>Change Info</h1><br>
                        <p>Changes will be reflected to every services</p>
                        <div class="profile-info" style="flex-direction: column; align-items: flex-start; display: flex; width: 707px; height: 502px; flex-wrap: wrap;">
                            <label for="nombre" style="font-family: 'Noto Sans', sans-serif; font-weight: 500; font-size: 13px;">Nombre:</label>
                            <input type="text" name="nombre" value="<?php echo $perfil['nombre']; ?>" style="width: 416px; height: 52px;"><br>
                            <label for="biografia" style="font-family: 'Noto Sans', sans-serif; font-weight: 500; font-size: 13px;">Biografía:</label>
                            <textarea name="biografia" style="width: 416.93px; height: 91px;"><?php echo $perfil['biografia']; ?></textarea><br>
                            <label for="telefono" style="font-family: 'Noto Sans', sans-serif; font-weight: 500; font-size: 13px;">Número de Teléfono:</label>
                            <input type="tel" name="telefono" value="<?php echo $perfil['telefono']; ?>" style="width: 416px; height: 52px;"><BR>
                            <input type="submit" value="Save" style="width: 82px; height: 36px; background: #2F80ED; color: #fff; border-radius: 8px; border: none; cursor: pointer;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
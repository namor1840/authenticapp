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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .profile-box {
            width: 848px;
            height: 580px;
            background-color: #fff;
            border-radius: 20px; /* Borde redondeado */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-name {
            font-size: 18px;
            font-weight: bold;
            margin-left: 10px;
            cursor: pointer;
        }

        /* Estilos del submenú */
        .submenu {
            position: absolute;
            top: 10px;
            right: 20px;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .arrow {
            font-size: 18px;
            margin-left: 5px;
        }

        .submenu-items {
            position: absolute;
            top: 30px;
            right: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 5px 0;
            display: none;
        }

        .submenu-items a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: #333;
        }

        .submenu-items a:hover {
            background-color: #f2f2f2;
        }

        .profile-info {
            flex: 1;
        }

        .edit-button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            align-self: flex-end; /* Mover el botón al lado derecho */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Menú desplegable en la parte superior derecha -->
        <div class="submenu">
            <span class="arrow">&#9662;</span>
            <div class="submenu-items">
                <a href="#">Mi Perfil</a>
                <a href="#">Group Chat</a>
                <a href="cerrar_sesion.php">Cerrar Sesión</a>
            </div>
        </div>
        <div class="profile-box">
            <div class="profile-header">
                <div class="profile-image">
                    <img src="<?php echo $perfil['imagen']; ?>" alt="imagen">
                </div>
                <div class="profile-name">
                    <?php echo $perfil['nombre']; ?>
                </div>
            </div>
            <div class="profile-info">
                <p><?php echo $perfil['biografia']; ?></p>
                <p>Número de Teléfono: <?php echo $perfil['telefono']; ?></p>
                <p>Correo Electrónico: <?php echo $perfil['correo']; ?></p>
                <p>Contraseña: ***********</p>
                <a href="editar_perfil.php" class="edit-button">Editar Perfil</a>
            </div>
        </div>
    </div>
    <script>
        function toggleMenu() {
            var submenu = document.querySelector(".submenu-items");
            submenu.style.display = submenu.style.display === "none" ? "block" : "none";
        }
    </script>
</body>
</html>
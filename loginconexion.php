<!DOCTYPE html>
<html>
<head>
    <title>Tu formulario</title>
    <!-- Incluir las bibliotecas de SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
</head>
<body>
<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "administrador";

$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error al conectarse a la base de datos: " . $conn->connect_error);
}

$sql = "SELECT * FROM usuario WHERE correo = '$correo'";
$result = $conn->query($sql);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($contraseña, $row["contraseña"])) {
        // Iniciar la sesión
        session_start();
        // Almacenar información de inicio de sesión en variables de sesión
        $_SESSION['correo'] = $correo;
        // Redirigir al usuario al menú de inicio
        echo "<script>
                Swal.fire('Éxito', 'Inicio de sesión exitoso', 'success').then(function() {
                    window.location.href = 'menu_inicio.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire('Error', 'Contraseña incorrecta', 'error').then(function() {
                    window.location.href = 'login.php';
                });
              </script>";
    }
} else {
    echo "<script>
            Swal.fire('Advertencia', 'Usuario no registrado. <a href=\'registro.php\'>Registrarse</a>', 'warning').then(function() {
                window.location.href = 'login.php';
            });
          </script>";
}

$conn->close();
?>
</body>
</html>

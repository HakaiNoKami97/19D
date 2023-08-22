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
        header("Location: menu_inicio.php");
        exit();
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "Usuario no registrado. <a href='registro.php'>Registrarse</a>";
}

$conn->close();
?>

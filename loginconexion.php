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
        echo "Inicio de sesión exitoso";
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "Usuario no registrado. <a href='registro.php'>Registrarse</a>";
}

$conn->close();
?>
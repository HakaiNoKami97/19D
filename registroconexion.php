<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "administrador";

$cedula = $_POST['id'];
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$telefono = $_POST['telefono'];
$tipousuarioid = $_POST['tipousuarioid'];
$fecha = date("Y-m-d H:i:s");

if (empty($cedula) || empty($correo) || empty($contraseña) || empty($telefono)) {
    echo 'Por favor, completa todos los campos antes de enviar el formulario.';
    exit();
}
if ($tipousuarioid === '0' || empty($tipousuarioid) || $tipousuarioid === null) {
    echo 'Por favor, seleccione un servicio válido.';
    exit();
}

// Encriptar la contraseña
$contraseña_encriptada = password_hash($contraseña, PASSWORD_DEFAULT);

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error al conectarse a la base de datos: " . $conn->connect_error);
}

$sql = "INSERT INTO usuario (id, correo, contraseña, telefono, fecha, tipousuarioid)
        VALUES ('$cedula', '$correo', '$contraseña_encriptada', '$telefono', '$fecha', $tipousuarioid)";

if ($conn->query($sql) === TRUE) {
    // Enviar correo de validación
    $to = $correo;
    $subject = "Confirmación de Registro";
    $message = "Gracias por registrarte. Tu cuenta ha sido creada.";
    $headers = "From: guillermo971013@hotmail.com";
    mail($to, $subject, $message, $headers);
    
    echo "Registro exitoso";
} else {
    echo "Error al registrar: " . $conn->error;
}

$conn->close();
?>
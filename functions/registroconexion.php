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
require_once 'conexion.php';

$cedula = trim($_POST['id']);
$correo = trim($_POST['correo']);
$contraseña = $_POST['contraseña'];
$telefono = trim($_POST['telefono']);
$tipousuarioid = $_POST['tipousuarioid'];
$fecha = date("Y-m-d H:i:s");

if (empty($cedula) || empty($correo) || empty($contraseña) || empty($telefono)) {
    echo "<script>
            Swal.fire('Advertencia', 'Por favor, completa todos los campos antes de enviar el formulario.', 'warning').then(function() {
                window.location.href = '../panel/registro.php';
            });
          </script>";
    exit();
}
if ($tipousuarioid === '0' || empty($tipousuarioid) || $tipousuarioid === null) {
    echo "<script>
            Swal.fire('Advertencia', 'Por favor, seleccione un servicio válido.', 'warning').then(function() {
                window.location.href = '../panel/registro.php';
            });
          </script>";
    exit();
}

// Verificar si los campos contienen solo espacios en blanco
if (strlen($cedula) === 0 || strlen($correo) === 0 || strlen($telefono) === 0) {
    echo "<script>
            Swal.fire('Advertencia', 'Por favor, completa todos los campos antes de enviar el formulario.', 'warning').then(function() {
                window.location.href = '../panel/registro.php';
            });
          </script>";
    exit();
}

// Encriptar la contraseña
$contraseña_encriptada = password_hash($contraseña, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuario (id, correo, contraseña, telefono, fecha, tipousuarioid)
        VALUES ('$cedula', '$correo', '$contraseña_encriptada', '$telefono', '$fecha', $tipousuarioid)";

if ($conn->query($sql) === TRUE) {
    // Enviar correo de validación
    $to = $correo;
    $subject = "Confirmación de Registro";
    $message = "Gracias por registrarte. Tu cuenta ha sido creada.";
    $headers = "From: guillermo971013@hotmail.com";
    mail($to, $subject, $message, $headers);
    echo "<script>
            Swal.fire('Éxito', 'Registro exitoso.', 'success').then(function() {
                window.location.href = '../login.php';
            });
          </script>";
} else {
    echo "<script>
            Swal.fire('Error', 'Error al registrar: " . $conn->error . "', 'error').then(function() {
                window.location.href = '../panel/registro.php';
            });
          </script>";
}

$conn->close();
?>
</body>
</html>

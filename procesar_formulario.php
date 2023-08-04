<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// Incluir la librería PHPMailer
require 'vendor/autoload.php';

// Datos del formulario
$nombre = $_POST['inputName4'];
$correo = $_POST['inputEmail4'];
$numero = $_POST['inputNumber4'];
$servicio = $_POST['inputState'];
$mensaje = $_POST['inputMessage'];

if (empty($nombre) || empty($correo) || empty($numero) || empty($mensaje)) {
    echo 'Por favor, completa todos los campos antes de enviar el formulario.';
    exit();
  }
if ($servicio === '0' || empty($servicio) || $servicio === null ) {
    echo 'Por favor, seleccione un servicio válido.';
    exit();
  }
  
// Configurar la conexión SMTP
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'mail.somos19d.com'; // Cambiar esto por el servidor de correo saliente
$mail->SMTPAuth = true;
$mail->Username = 'info@somos19d.com'; // Cambiar esto por tu correo electrónico
$mail->Password = '!2023.1nf0'; // Cambiar esto por tu contraseña del correo electrónico
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Datos del correo
$mail->setFrom('info@somos19d.com', '19D'); // Cambiar esto por tu correo y tu nombre
$mail->addAddress('info@somos19d.com', 'Información 19D'); // Cambiar esto por el correo destino y su nombre
$mail->Subject = 'Mensaje desde formulario de contacto';
$mail->Body = "Nombre: $nombre\nCorreo: $correo\nNúmero: $numero\nServicio: $servicio\nMensaje: $mensaje";

// Enviar el correo
if ($mail->send()) {
    $response = array('status' => 'success', 'message' => 'Formulario enviado con éxito');
  } else {
    $response = array('status' => 'error', 'message' => 'Error al enviar el correo: ' . $mail->ErrorInfo);
  }
  header('Content-Type: application/json');
  echo json_encode($response);
  

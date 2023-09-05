<?php
session_start(); // Iniciar sesión si aún no se ha hecho

// Destruir todas las variables de sesión
session_unset();
// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión
header("Location: ../login.php");
exit();
?>

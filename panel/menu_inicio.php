<?php
// Inicia o reanuda la sesión
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['correo'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="../css/menu_inicio.css" rel="stylesheet" />
        <title>INICIO 19D</title>
    </head>
    <body>
      <ul class="slider">
        <li id="slide1" class="nav-item">
          <a class="nav-link" href="empresa_form.php">NOSOTROS</a>
        </li>
        <li id="slide2" class="nav-item">
          <a class="nav-link" href="servicio_form.php">SERVICIOS</a>
        </li>
        <li id="slide3" class="nav-item">
          <a class="nav-link" href="desarrollo_form.php">DESARROLLOS</a>
        </li>
      </ul>
      <nav>
        <ul class="menu">
          <li><a href="#slide1">Nosotros</a></li>
          <li><a href="#slide2">Servicios</a></li>
          <li><a href="#slide3">Desarrollos</a></li>
          <li><a href="../functions/logout.php">Cerrar Sesión</a></li>
        </ul>
      </nav>
    </body>
</html>
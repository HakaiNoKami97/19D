<!DOCTYPE html>
<html>
<head>
    <link href="css/stylelogin.css" rel="stylesheet" />
    <title>LOG IN 19D</title>
</head>
<body>
    <div class="container">
        <h2>Iniciar Sesión</h2>
        <form action="loginconexion.php" method="post">
            Correo: <input type="email" name="correo" required><br>
            Contraseña: <input type="password" name="contraseña" required><br>
            <input type="submit" value="Iniciar Sesión">
        </form>
        <p>¿No tienes una cuenta? <a href="registro.php">Registrarse</a></p>
    </div>
</body>
</html>
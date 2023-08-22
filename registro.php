<!DOCTYPE html>
<html>
<head>
    <link href="css/styleregistro.css" rel="stylesheet" />
    <title>SIGN UP 19D</title>
</head>
<body>
    <div class="container">
        <h2>Registro de Usuario</h2>
        <form action="registroconexion.php" method="post">
            Cedula: <input type="text" id="id" name="id" required><br>
            Correo: <input type="email" id="correo" name="correo" required><br>
            Contraseña: <input type="password" id="contraseña" name="contraseña" required><br>
            Teléfono: <input type="text" id="telefono" name="telefono"><br>
            Tipo de Usuario: 
            <select id="tipousuarioid" name="tipousuarioid" required>
                <option disabled selected value="0">Seleccione un rol</option>
                <option value="1">Administrador</option>
                <option value="2">Desarrollador</option>
            </select><br>
            <input type="submit" value="Registrar">
        </form>
        <p>¿Ya tienes una cuenta? <a href="login.php">Iniciar Sesión</a></p>
    </div>    
</body>
</html>
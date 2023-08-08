<!DOCTYPE html>
<html>
<head>
    <title>NOSOTROS 19D</title>
</head>
<body>
    <h2>NOSOTROS</h2>
    
    <?php
    if (isset($_GET['edit_id'])) {
        $edit_id = $_GET['edit_id'];
        // Aquí deberías cargar los datos de la base de datos para el ID específico
        // Ejemplo: SELECT * FROM empresa WHERE id = $edit_id;
        // Luego, puedes llenar los campos del formulario con estos datos
    }
    ?>

    <form action="empresa_process.php" method="post">
        Nombre: <input type="text" name="nombre" required><br>
        Misión: <textarea name="mision" rows="3" required></textarea><br>
        Visión: <textarea name="vision" rows="3" required></textarea><br>
        Descripción: <textarea name="descripcion" rows="5" required></textarea><br>
        <!-- Agrega más campos según los datos de tu tabla "empresa" -->

        <?php
        // Si estamos editando, mostrar el botón de actualizar
        if (isset($edit_id)) {
            echo '<input type="hidden" name="edit_id" value="' . $edit_id . '">';
            echo '<input type="submit" name="update" value="Actualizar">';
        } else {
            // Si no estamos editando, mostrar el botón de guardar
            echo '<input type="submit" name="save" value="Guardar">';
        }
        ?>
    </form>

    <h2>Empresas Registradas</h2>

    <p><a href="empresa_form.php">Agregar Nueva Empresa</a></p>
</body>
</html>
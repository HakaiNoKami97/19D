<!DOCTYPE html>
<html>
<head>
    <link href="css/styleempresa.css" rel="stylesheet" />
    <title>NOSOTROS 19D</title>
</head>
<body>
    <h2>NOSOTROS</h2>
    <form action="empresa_process.php" method="post">
        Misión: <textarea name="mision" rows="3" required></textarea><br>
        Visión: <textarea name="vision" rows="3" required></textarea><br>

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

    <h2>Datos Registrados</h2>

    <p><a href="empresa_form.php">Agregar Nueva Empresa</a></p>
</body>
</html>
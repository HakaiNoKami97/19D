<?php
// Inicia o reanuda la sesión
session_start();
ini_set('display_errors', 1);
// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['correo'])) {
    header("Location: ../login.php");
    exit();
}
require_once '../functions/conexion.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link href="../css/styleservicio.css" rel="stylesheet" />
    <link href="../css/dashboard.css" rel="stylesheet" />
    <title>SERVICIOS 19D</title>
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <ul>
                <li><a href="menu_inicio.php">Inicio</a></li>
                <li><a href="empresa_form.php">Nosotros</a></li>
                <li><a href="servicio_form.php">Registrar Servicio</a></li>                
                <li><a href="desarrollo_form.php">Registrar Desarrollo</a></li>
                <li><a href="../functions/logout.php">Cerrar Sesión</a></li>
            </ul>
        </div>
    <div class="content">
        <div class="container">
            <h2>Registrar Servicio</h2>
            
            <!-- Formulario para agregar/editar registros -->
            <form action="../functions/servicio_process.php" method="post" enctype="multipart/form-data">
                <?php
                if (isset($_GET['edit_id'])) {
                    $edit_id = $_GET['edit_id'];

                    $sql = "SELECT * FROM servicio WHERE id = $edit_id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo "<h3>Editar Servicio</h3>";
                        echo '<form action="../functions/servicio_process.php" method="post" enctype="multipart/form-data">';
                        echo 'Nombre: <input type="text" name="nombre" value="' . $row['nombre'] . '" required><br>';
                        echo 'Descripción: <textarea name="descripcion" rows="3" required>' . $row['descripción'] . '</textarea><br>';
                        echo 'Imagen Actual: <img src="' . $row['imagen']. '" alt="Imagen del Servicio" width="100"><br>';
                        echo 'Nueva Imagen: <input type="file" name="imagen" accept="image/*"><br>';
                        echo '<input type="hidden" name="edit_id" value="' . $edit_id . '">';
                        echo '<input type="submit" name="update" value="Actualizar">';
                        echo '</form>';
                    } else {
                        echo "No se encontraron datos para editar.";
                    }

                    $conn->close();
                } else {
                    // Si no estamos editando, mostrar campos vacíos
                    echo 'Nombre: <input type="text" name="nombre" required><br>';
                    echo 'Descripción: <textarea name="descripcion" rows="3" required></textarea><br>';
                    echo 'Imagen: <input type="file" name="imagen" accept="image/*"><br>';
                    echo '<input type="submit" name="save" value="Guardar">';
                }
                ?>
            </form>

            <h2>Nuestros Servicios</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>TITULO</th>
                    <th>DESCRIPCIÓN</th>
                    <th>IMAGEN</th>
                    <th>FECHA</th>
                    <th>EDITAR</th>
                    <th>ELIMINAR</th>
                </tr>
                
                <?php

                // Realizar consulta a la tabla "empresa"
                $sql = "SELECT * FROM servicio";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['descripción'] . "</td>";
                        echo "<td><img src='" . $row['imagen'] . "' alt='Imagen de Servicio' width='100'></td>";
                        echo "<td>" . $row['fecha'] . "</td>";
                        echo '<td><a href="servicio_form.php?edit_id=' . $row['id'] . '">Editar</a></td>';
                        echo '<td><a href="../functions/servicio_process.php?delete_id=' . $row['id'] . '">Eliminar</a></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No hay registros disponibles</td></tr>";
                }

                $conn->close();
                ?>
            </table>
        </div>
    </div>
    </div>
</body>
</html>
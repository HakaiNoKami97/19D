<!DOCTYPE html>
<html>
<head>
    <link href="css/styledesarrollo.css" rel="stylesheet" />
    <title>DESARROLLO 19D</title>
</head>
<body>
    <div class="container">
        <h2>Registrar Desarrollo</h2>
        
        <!-- Formulario para agregar/editar registros -->
        <form action="desarrollo_process.php" method="post" enctype="multipart/form-data">
            <?php
            if (isset($_GET['edit_id'])) {
                $edit_id = $_GET['edit_id'];
                $servername = "localhost:3306";
                $username = "root";
                $password = "";
                $dbname = "administrador";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Error al conectarse a la base de datos: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM desarrollo WHERE id = $edit_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<h3>Editar Desarrollo</h3>";
                    echo '<form action="desarrollo_process.php" method="post" enctype="multipart/form-data">';
                    echo 'Nombre: <input type="text" name="nombre" value="' . $row['nombre'] . '" required><br>';
                    echo 'Descripción: <textarea name="descripcion" rows="3" required>' . $row['descripción'] . '</textarea><br>';
                    echo 'Imagen Actual: <img src="' . $row['imagen']. '" alt="Imagen del Desarrollo" width="100"><br>';
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

        <h2>Sobre Nosotros</h2>
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
            $servername = "localhost:3306";
            $username = "root";
            $password = "";
            $dbname = "administrador";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Error al conectarse a la base de datos: " . $conn->connect_error);
            }

            // Realizar consulta a la tabla "empresa"
            $sql = "SELECT * FROM desarrollo";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nombre'] . "</td>";
                    echo "<td>" . $row['descripción'] . "</td>";
                    echo "<td><img src='" . $row['imagen'] . "' alt='Imagen de Desarrollo' width='100'></td>";
                    echo "<td>" . $row['fecha'] . "</td>";
                    echo '<td><a href="desarrollo_form.php?edit_id=' . $row['id'] . '">Editar</a></td>';
                    echo '<td><a href="desarrollo_process.php?delete_id=' . $row['id'] . '">Eliminar</a></td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No hay registros disponibles</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </div>
    
</body>
</html>
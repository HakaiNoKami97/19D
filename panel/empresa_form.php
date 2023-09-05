<?php
// Inicia o reanuda la sesión
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['correo'])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="../css/styleempresa.css" rel="stylesheet" />
    <link href="../css/dashboard.css" rel="stylesheet" />
    <title>NOSOTROS 19D</title>
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
        <h2>NOSOTROS</h2>
        
        <!-- Formulario para agregar/editar registros -->
        <form action="../functions/empresa_process.php" method="post">
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

                $sql = "SELECT * FROM empresa WHERE id = $edit_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $misionValue = $row['misión'];
                    $visionValue = $row['visión'];
                    echo 'Misión: <textarea name="mision" rows="3" required>' . $misionValue . '</textarea><br>';
                    echo 'Visión: <textarea name="vision" rows="3" required>' . $visionValue . '</textarea><br>';
                    echo '<input type="hidden" name="edit_id" value="' . $edit_id . '">';
                    echo '<input type="submit" name="update" value="Actualizar">';
                } else {
                    echo "No se encontraron datos para editar.";
                }

                $conn->close();
            } else {
                // Si no estamos editando, mostrar campos vacíos
                echo 'Misión: <textarea name="mision" rows="3" required></textarea><br>';
                echo 'Visión: <textarea name="vision" rows="3" required></textarea><br>';
                echo '<input type="submit" name="save" value="Guardar">';
            }
            ?>
        </form>

        <h2>Sobre Nosotros</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Misión</th>
                <th>Visión</th>
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
            $sql = "SELECT * FROM empresa";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['misión'] . "</td>";
                    echo "<td>" . $row['visión'] . "</td>";
                    echo '<td><a href="empresa_form.php?edit_id=' . $row['id'] . '">Editar</a></td>';
                    echo '<td><a href="../functions/empresa_process.php?delete_id=' . $row['id'] . '">Eliminar</a></td>';
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
</body>
</html>
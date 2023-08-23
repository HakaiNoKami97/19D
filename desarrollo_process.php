<!DOCTYPE html>
<html>
<head>
    <title>Tu formulario</title>
    <!-- Incluir las bibliotecas de SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
</head>
<body>
    <!-- Tu contenido HTML aquí -->

    <?php
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "administrador";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error al conectarse a la base de datos: " . $conn->connect_error);
    }

    if (isset($_POST['save'])) {
        $nombre = trim($_POST['nombre']);
        $descripcion = trim($_POST['descripcion']);
        $imagen_nombre = ($_FILES['imagen']['name']);
        $imagen_tmp = ($_FILES['imagen']['tmp_name']);
        $fecha_registro = date("Y-m-d H:i:s"); // Fecha y hora actual

        if (empty($nombre) || empty($descripcion)) {
            echo "<script>
                    Swal.fire('Advertencia', 'Por favor, completa todos los campos antes de enviar el formulario.', 'warning').then(function() {
                        window.location.href = 'desarrollo_form.php';
                    });
                  </script>";
            exit();
        }

        // Resto del código...

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    Swal.fire('Éxito', 'Registro de desarrollo exitoso', 'success').then(function() {
                        window.location.href = 'desarrollo_form.php';
                    });
                  </script>";
        } else {
            echo "<script>
                    Swal.fire('Error', 'Error al registrar desarrollo: " . $conn->error . "', 'error').then(function() {
                        window.location.href = 'desarrollo_form.php';
                    });
                  </script>";
        }
    } elseif (isset($_POST['update'])) {
        // Resto del código...

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    Swal.fire('Éxito', 'Actualización de desarrollo exitosa', 'success').then(function() {
                        window.location.href = 'desarrollo_form.php';
                    });
                  </script>";
        } else {
            echo "<script>
                    Swal.fire('Error', 'Error al actualizar desarrollo: " . $conn->error . "', 'error').then(function() {
                        window.location.href = 'desarrollo_form.php';
                    });
                  </script>";
        }
    } elseif (isset($_GET['delete_id'])) {
        // Resto del código...

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    Swal.fire('Éxito', 'Registro eliminado exitosamente', 'success').then(function() {
                        window.location.href = 'desarrollo_form.php';
                    });
                  </script>";
        } else {
            echo "<script>
                    Swal.fire('Error', 'Error al eliminar registro: " . $conn->error . "', 'error').then(function() {
                        window.location.href = 'desarrollo_form.php';
                    });
                  </script>";
        }
    }

    $conn->close();
    ?>
</body>
</html>

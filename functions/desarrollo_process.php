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
    require_once 'conexion.php';

    if (isset($_POST['save'])) {
        $nombre = trim($_POST['nombre']);
        $descripcion = trim($_POST['descripcion']);
        $imagen_nombre = ($_FILES['imagen']['name']);
        $imagen_tmp = ($_FILES['imagen']['tmp_name']);
        $fecha_registro = date("Y-m-d H:i:s"); // Fecha y hora actual

        if (empty($nombre) || empty($descripcion)) {
            echo "<script>
                    Swal.fire('Advertencia', 'Por favor, completa todos los campos antes de enviar el formulario.', 'warning').then(function() {
                        window.location.href = '../panel/desarrollo_form.php';
                    });
                  </script>";
            exit();
        }

        // Subir imagen al servidor
        $imagen_ruta = "../uploads/" . $imagen_nombre;
        move_uploaded_file($imagen_tmp, $imagen_ruta);

        // Insertar datos en la base de datos
        $sql = "INSERT INTO desarrollo (nombre, descripción, imagen, fecha)
                VALUES ('$nombre', '$descripcion', '$imagen_ruta', '$fecha_registro')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    Swal.fire('Éxito', 'Registro de desarrollo exitoso', 'success').then(function() {
                        window.location.href = '../panel/desarrollo_form.php';
                    });
                  </script>";
        } else {
            echo "<script>
                    Swal.fire('Error', 'Error al registrar desarrollo: " . $conn->error . "', 'error').then(function() {
                        window.location.href = '../panel/desarrollo_form.php';
                    });
                  </script>";
        }
    } elseif (isset($_POST['update'])) {
        $edit_id = $_POST['edit_id'];
        $nombre = trim($_POST['nombre']);
        $descripcion = trim($_POST['descripcion']);

        if (empty($nombre) || empty($descripcion)) {
            echo "<script>
                    Swal.fire('Advertencia', 'Por favor, completa todos los campos antes de enviar el formulario.', 'warning').then(function() {
                        window.location.href = '../panel/desarrollo_form.php';
                    });
                </script>";
            exit();
        }

        // Verificar si se cargó una nueva imagen
        if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $imagen_nombre = $_FILES['imagen']['name'];
            $imagen_tmp = $_FILES['imagen']['tmp_name'];

            // Ruta donde se guardarán las imágenes
            $imagen_ruta = "../uploads/" . $imagen_nombre;

            // Subir nueva imagen al servidor
            move_uploaded_file($imagen_tmp, $imagen_ruta);

            // Actualizar detalles del servicio en la base de datos, incluyendo la imagen
            $sql = "UPDATE desarrollo SET
                    nombre = '$nombre',
                    descripción = '$descripcion',
                    imagen = '$imagen_ruta'
                    WHERE id = $edit_id";

        } else {
            // Actualizar detalles del servicio en la base de datos sin cambiar la imagen
            $sql = "UPDATE desarrollo SET
                    nombre = '$nombre',
                    descripción = '$descripcion'
                    WHERE id = $edit_id";
        }

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    Swal.fire('Éxito', 'Actualización de desarrollo exitosa', 'success').then(function() {
                        window.location.href = '../panel/desarrollo_form.php';
                    });
                </script>";
        } else {
            echo "<script>
                    Swal.fire('Error', 'Error al actualizar desarrollo: " . $conn->error . "', 'error').then(function() {
                        window.location.href = '../panel/desarrollo_form.php';
                    });
                </script>";
        }
    } elseif (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];

        // Realizar la eliminación en la base de datos
        $sql = "DELETE FROM desarrollo WHERE id = $delete_id";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    Swal.fire('Éxito', 'Registro eliminado exitosamente', 'success').then(function() {
                        window.location.href = '../panel/desarrollo_form.php';
                    });
                </script>";
        } else {
            echo "<script>
                    Swal.fire('Error', 'Error al eliminar registro: " . $conn->error . "', 'error').then(function() {
                        window.location.href = '../panel/desarrollo_form.php';
                    });
                </script>";
        }
    }

    $conn->close();
    ?>
</body>
</html>

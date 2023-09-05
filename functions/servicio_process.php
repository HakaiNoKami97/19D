<!DOCTYPE html>
<html>
<head>
    <title>Tu formulario</title>
    <!-- Incluir las bibliotecas de SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
</head>
<body>
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
    $imagen_nombre = $_FILES['imagen']['name'];
    $imagen_tmp = $_FILES['imagen']['tmp_name'];
    $fecha_registro = date("Y-m-d H:i:s"); // Fecha y hora actual

    if (empty($nombre) || empty($descripcion)) {
        echo "<script>
                Swal.fire('Advertencia', 'Por favor, completa todos los campos antes de enviar el formulario.', 'warning').then(function() {
                    window.location.href = '../panel/servicio_form.php';
                });
              </script>";
        exit();
    }

    // Subir imagen al servidor
    $imagen_ruta = "../uploads/" . $imagen_nombre;
    move_uploaded_file($imagen_tmp, $imagen_ruta);

    // Insertar datos en la base de datos
    $sql = "INSERT INTO servicio (nombre, descripción, imagen, fecha)
            VALUES ('$nombre', '$descripcion', '$imagen_ruta', '$fecha_registro')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                Swal.fire('Éxito', 'Registro de servicio exitoso', 'success').then(function() {
                    window.location.href = '../panel/servicio_form.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire('Error', 'Error al registrar servicio: " . $conn->error . "', 'error').then(function() {
                    window.location.href = '../panel/servicio_form.php';
                });
              </script>";
    }
}  elseif (isset($_POST['update'])) {
    $edit_id = $_POST['edit_id'];
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);

    if (empty($nombre) || empty($descripcion)) {
        echo "<script>
                Swal.fire('Advertencia', 'Por favor, completa todos los campos antes de enviar el formulario.', 'warning').then(function() {
                    window.location.href = '../panel/servicio_form.php';
                });
              </script>";
        exit();
    }

    // Verificar si se cargó una nueva imagen
    if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagen_nombre = $_FILES['imagen']['name'];
        $imagen_tmp = $_FILES['imagen']['tmp_name'];

        // Ruta donde se guardarán las imágenes
        $imagen_ruta = "uploads/" . $imagen_nombre;

        // Subir nueva imagen al servidor
        move_uploaded_file($imagen_tmp, $imagen_ruta);

        // Actualizar detalles del servicio en la base de datos, incluyendo la imagen
        $sql = "UPDATE servicio SET
                nombre = '$nombre',
                descripción = '$descripcion',
                imagen = '$imagen_ruta'
                WHERE id = $edit_id";

    } else {
        // Actualizar detalles del servicio en la base de datos sin cambiar la imagen
        $sql = "UPDATE servicio SET
                nombre = '$nombre',
                descripción = '$descripcion'
                WHERE id = $edit_id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                Swal.fire('Éxito', 'Actualización de servicio exitosa', 'success').then(function() {
                    window.location.href = '../panel/servicio_form.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire('Error', 'Error al actualizar servicio: " . $conn->error . "', 'error').then(function() {
                    window.location.href = '../panel/servicio_form.php';
                });
              </script>";
    }
} elseif (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Realizar la eliminación en la base de datos
    $sql = "DELETE FROM servicio WHERE id = $delete_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                Swal.fire('Éxito', 'Registro eliminado exitosamente', 'success').then(function() {
                    window.location.href = '../panel/servicio_form.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire('Error', 'Error al eliminar registro: " . $conn->error . "', 'error').then(function() {
                    window.location.href = '../panel/servicio_form.php';
                });
              </script>";
    }
}

$conn->close();
header("Location: ../panel/servicio_form.php");
exit();
?>
</body>
</html>

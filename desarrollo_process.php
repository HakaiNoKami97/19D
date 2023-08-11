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
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $imagen_nombre = $_FILES['imagen']['name'];
    $imagen_tmp = $_FILES['imagen']['tmp_name'];
    $fecha_registro = date("Y-m-d H:i:s"); // Fecha y hora actual

    // Subir imagen al servidor
    $imagen_ruta = "uploads/" . $imagen_nombre;
    move_uploaded_file($imagen_tmp, $imagen_ruta);

    // Insertar datos en la base de datos
    $sql = "INSERT INTO desarrollo (nombre, descripción, imagen, fecha)
            VALUES ('$nombre', '$descripcion', '$imagen_ruta', '$fecha_registro')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro de desarrollo exitoso";
    } else {
        echo "Error al registrar desarrollo: " . $conn->error;
    }
}  elseif (isset($_POST['update'])) {
    $edit_id = $_POST['edit_id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Verificar si se cargó una nueva imagen
    if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagen_nombre = $_FILES['imagen']['name'];
        $imagen_tmp = $_FILES['imagen']['tmp_name'];

        // Ruta donde se guardarán las imágenes
        $imagen_ruta = "uploads/" . $imagen_nombre;

        // Subir nueva imagen al servidor
        move_uploaded_file($imagen_tmp, $imagen_ruta);

        // Actualizar detalles del desarrollo en la base de datos, incluyendo la imagen
        $sql = "UPDATE desarrollo SET
                nombre = '$nombre',
                descripción = '$descripcion',
                imagen = '$imagen_ruta'
                WHERE id = $edit_id";

    } else {
        // Actualizar detalles del desarrollo en la base de datos sin cambiar la imagen
        $sql = "UPDATE desarrollo SET
                nombre = '$nombre',
                descripción = '$descripcion'
                WHERE id = $edit_id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Actualización de desarrollo exitosa";
    } else {
        echo "Error al actualizar desarrollo: " . $conn->error;
    }
} elseif (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Realizar la eliminación en la base de datos
    $sql = "DELETE FROM desarrollo WHERE id = $delete_id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro eliminado exitosamente";
    } else {
        echo "Error al eliminar registro: " . $conn->error;
    }
}

header("Location: desarrollo_form.php");
exit();

$conn->close();
?>
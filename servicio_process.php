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
    $sql = "INSERT INTO servicio (nombre, descripción, imagen, fecha)
            VALUES ('$nombre', '$descripcion', '$imagen_ruta', '$fecha_registro')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro de servicio exitoso";
    } else {
        echo "Error al registrar servicio: " . $conn->error;
    }
}  elseif (isset($_POST['update'])) {
    $edit_id = $_POST['edit_id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Actualizar detalles del servicio en la base de datos
    $sql = "UPDATE servicio SET
            nombre = '$nombre',
            descripción = '$descripcion'
            WHERE id = $edit_id";

    if ($conn->query($sql) === TRUE) {
        echo "Actualización de servicio exitosa";
    } else {
        echo "Error al actualizar servicio: " . $conn->error;
    }
} elseif (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Realizar la eliminación en la base de datos
    $sql = "DELETE FROM servicio WHERE id = $delete_id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro eliminado exitosamente";
    } else {
        echo "Error al eliminar registro: " . $conn->error;
    }
}

header("Location: servicio_form.php");
exit();

$conn->close();
?>
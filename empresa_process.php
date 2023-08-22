<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "administrador";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error al conectarse a la base de datos: " . $conn->connect_error);
}

// Verificar si ya existe un registro en la tabla "empresa"
/*$sql_check = "SELECT COUNT(*) AS count FROM empresa";
$result_check = $conn->query($sql_check);
$row_check = $result_check->fetch_assoc();
$empresa_exists = $row_check['count'] > 0;*/

if (isset($_POST['save'])) {
    // Insertar nuevo registro
    $mision = trim($_POST['mision']);
    $vision = trim($_POST['vision']);
    $sql = "INSERT INTO empresa (misión, visión)
            VALUES ('$mision', '$vision')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro de empresa exitoso";
    } else {
        echo "Error al registrar empresa: " . $conn->error;
    }
} elseif (isset($_POST['update'])) {
    // Actualizar registro existente
    $edit_id = $_POST['edit_id'];
    $mision = trim($_POST['mision']);
    $vision = trim($_POST['vision']);

    $sql = "UPDATE empresa SET
            misión = '$mision',
            visión = '$vision'
            WHERE id = $edit_id";

    if ($conn->query($sql) === TRUE) {
        echo "Actualización de empresa exitosa";
    } else {
        echo "Error al actualizar empresa: " . $conn->error;
    }
} elseif (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Realizar la eliminación en la base de datos
    $sql = "DELETE FROM empresa WHERE id = $delete_id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro eliminado exitosamente";
    } else {
        echo "Error al eliminar registro: " . $conn->error;
    }
}

header("Location: empresa_form.php");
exit();

$conn->close();
?>
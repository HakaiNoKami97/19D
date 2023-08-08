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
    $mision = $_POST['mision'];
    $vision = $_POST['vision'];
    $sql = "INSERT INTO empresa (misión, visión, descripción)
            VALUES ('$mision', '$vision')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro de empresa exitoso";
    } else {
        echo "Error al registrar empresa: " . $conn->error;
    }
} elseif (isset($_POST['update'])) {
    $mision = $_POST['mision'];
    $vision = $_POST['vision'];

    // Realizar la actualización en la base de datos
    $sql = "UPDATE empresa SET
            misión = '$mision',
            visión = '$vision',
            WHERE id = $edit_id";

    if ($conn->query($sql) === TRUE) {
        echo "Actualización de empresa exitosa";
    } else {
        echo "Error al actualizar empresa: " . $conn->error;
    }
}

header("Location: empresa_form.php");
exit();

$conn->close();
?>
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
    $mision = trim($_POST['mision']);
    $vision = trim($_POST['vision']);

    if (empty($mision) || empty($vision)) {
        echo "<script>
                Swal.fire('Advertencia', 'Por favor, completa todos los campos antes de enviar el formulario.', 'warning').then(function() {
                    window.location.href = 'empresa_form.php';
                });
              </script>";
        exit();
    }

    $sql = "INSERT INTO empresa (misión, visión)
            VALUES ('$mision', '$vision')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                Swal.fire('Éxito', 'Registro de empresa exitoso', 'success').then(function() {
                    window.location.href = 'empresa_form.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire('Error', 'Error al registrar empresa: " . $conn->error . "', 'error').then(function() {
                    window.location.href = 'empresa_form.php';
                });
              </script>";
    }
} elseif (isset($_POST['update'])) {
    $edit_id = $_POST['edit_id'];
    $mision = trim($_POST['mision']);
    $vision = trim($_POST['vision']);

    if (empty($mision) || empty($vision)) {
        echo "<script>
                Swal.fire('Advertencia', 'Por favor, completa todos los campos antes de enviar el formulario.', 'warning').then(function() {
                    window.location.href = 'empresa_form.php';
                });
              </script>";
        exit();
    }

    $sql = "UPDATE empresa SET
            misión = '$mision',
            visión = '$vision'
            WHERE id = $edit_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                Swal.fire('Éxito', 'Actualización de empresa exitosa', 'success').then(function() {
                    window.location.href = 'empresa_form.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire('Error', 'Error al actualizar empresa: " . $conn->error . "', 'error').then(function() {
                    window.location.href = 'empresa_form.php';
                });
              </script>";
    }
} elseif (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql = "DELETE FROM empresa WHERE id = $delete_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                Swal.fire('Éxito', 'Registro eliminado exitosamente', 'success').then(function() {
                    window.location.href = 'empresa_form.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire('Error', 'Error al eliminar registro: " . $conn->error . "', 'error').then(function() {
                    window.location.href = 'empresa_form.php';
                });
              </script>";
    }
}

$conn->close();
header("Location: empresa_form.php");
exit();
?>
</body>
</html>

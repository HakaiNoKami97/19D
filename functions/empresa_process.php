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

/*$firstRecordQuery = "SELECT COUNT(*) AS count FROM empresa";
$result = $conn->query($firstRecordQuery);
$row = $result->fetch_assoc();
$hasRecords = $row['count'] > 0;*/

if (isset($_POST['save'])) {
    $mision = trim($_POST['mision']);
    $vision = trim($_POST['vision']);

    if (empty($mision) || empty($vision)) {
        echo "<script>
                Swal.fire('Advertencia', 'Por favor, completa todos los campos antes de enviar el formulario.', 'warning').then(function() {
                    window.location.href = '../panel/empresa_form.php';
                });
              </script>";
        exit();
    }

    $sql = "INSERT INTO empresa (misión, visión)
            VALUES ('$mision', '$vision')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                Swal.fire('Éxito', 'Registro de empresa exitoso', 'success').then(function() {
                    window.location.href = '../panel/empresa_form.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire('Error', 'Error al registrar empresa: " . $conn->error . "', 'error').then(function() {
                    window.location.href = '../panel/empresa_form.php';
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
                    window.location.href = '../panel/empresa_form.php';
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
                    window.location.href = '../panel/empresa_form.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire('Error', 'Error al actualizar empresa: " . $conn->error . "', 'error').then(function() {
                    window.location.href = '../panel/empresa_form.php';
                });
              </script>";
    }
} elseif (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql = "DELETE FROM empresa WHERE id = $delete_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                Swal.fire('Éxito', 'Registro eliminado exitosamente', 'success').then(function() {
                    window.location.href = '../panel/empresa_form.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire('Error', 'Error al eliminar registro: " . $conn->error . "', 'error').then(function() {
                    window.location.href = '../panel/empresa_form.php';
                });
              </script>";
    }
} /*else {
    if (!$hasRecords) {
        echo "<script>
                Swal.fire('Advertencia', 'Debes registrar al menos una vez antes de poder actualizar o eliminar.', 'warning').then(function() {
                    window.location.href = 'empresa_form.php';
                });
              </script>";
        exit();
    }
}*/

$conn->close();
header("Location: ../panel/empresa_form.php");
exit();
?>
</body>
</html>

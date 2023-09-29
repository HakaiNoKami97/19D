<?php
require_once 'conexion.php';

$sql = "SELECT mision, vision FROM empresa WHERE id = id";
$result = $conn->query($sql);

$response = array('mision' => '', 'vision' => '');

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response['mision'] = utf8_encode($row['mision']);
    $response['vision'] = utf8_encode($row['vision']);
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>

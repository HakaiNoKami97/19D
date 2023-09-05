<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "administrador";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error al conectarse a la base de datos: " . $conn->connect_error);
}

$sql = "SELECT misión, visión FROM empresa WHERE id = id";
$result = $conn->query($sql);

$response = array('mision' => '', 'vision' => '');

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response['mision'] = $row['misión'];
    $response['vision'] = $row['visión'];
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>

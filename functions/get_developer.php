<?php
ini_set('display_errors', 1);
require_once 'conexion.php';

$sql = "SELECT * FROM desarrollo";
$result = $conn->query($sql);

$services = array();

if ($result->num_rows > 0) {
    while($data = $result->fetch_assoc()){
        $descripcion = utf8_encode($data['descripcion']);
        $services[] = array(
            'imagen' => utf8_encode($data['imagen']),
            'nombre' => utf8_encode($data['nombre']),
            'descripcion' => $descripcion
        );
    }
    $result->free();
}
$conn->close();
// header('Content-type: application/json; charset=utf-8');
echo json_encode($services, 5000);
?>

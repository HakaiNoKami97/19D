<?php
require_once 'conexion.php';

$sql = "SELECT * FROM desarrollo";
$result = $conn->query($sql);

$services = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        $services[] = array(
            'imagen' => $row['imagen'],
            'nombre' => $row['nombre'],
            'descripcion' => $row['descripción']
        );
    }                    
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($services);
?>

<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "administrador";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error al conectarse a la base de datos: " . $conn->connect_error);
}

$sql = "SELECT * FROM servicio";
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

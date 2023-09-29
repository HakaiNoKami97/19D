<?php
    $servername = "localhost:3306";
    $username = "root";
    $password = "123456";
    $dbname = "administrador";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error al conectarse a la base de datos: " . $conn->connect_error);
    }
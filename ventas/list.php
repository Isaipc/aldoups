<?php
header("Content-Type: application/json; charset=UTF-8");

include '../database/conexion.php';

try {
    $sql = $conn->prepare('SELECT * FROM ventas');
    $sql->execute();

    $result = $sql->fetchAll();
    
    echo json_encode($result);

} catch (PDOException $e) {
    die('ERROR: ' . $e->getMessage());
}

<?php

include '../database/conexion.php';

try {
    $sql = $conn->prepare('SELECT * FROM categorias');
    $sql->execute();

    $result = $sql->fetchAll();
    
    echo json_encode($result);

} catch (PDOException $e) {
    die('ERROR: ' . $e->getMessage());
}

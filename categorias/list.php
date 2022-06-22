<?php
header("Content-Type: application/json; charset=UTF-8");

include '../database/conexion.php';

try {
    $sql = $conn->prepare('SELECT * FROM categorias');
    $sql->execute();

    $result = $sql->fetchAll(PDO::FETCH_OBJ);

    echo json_encode(['data' => $result]);

} catch (PDOException $e) {
    die('ERROR: ' . $e->getMessage());
}

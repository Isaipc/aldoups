<?php
header("Content-Type: application/json; charset=UTF-8");

include '../database/conexion.php';

try {
    $stmt = 'SELECT 
                productos.id,
                productos.nombre,
                productos.precio,
                productos.stock,
                categorias.nombre as categoria,
                productos.fecha_ingreso,
                productos.fecha_modificacion
            FROM productos 
                INNER JOIN categorias
                ON categorias.id = productos.categoria_id';

    $sql = $conn->prepare($stmt);
    $sql->execute();

    $result = $sql->fetchAll(PDO::FETCH_OBJ);

    echo json_encode(['data' => $result]);
} catch (PDOException $e) {
    die('ERROR: ' . $e->getMessage());
}

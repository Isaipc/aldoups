<?php
header("Content-Type: application/json; charset=UTF-8");

include '../database/conexion.php';

try {
    $sql = 'SELECT 
            productos.id,
            productos.nombre,
            SUM(producto_vendido.cantidad) AS total_vendidos,
            categorias.nombre as categoria
            FROM producto_vendido
            INNER JOIN productos ON productos.id = producto_vendido.producto_id
            INNER JOIN categorias ON categorias.id = productos.categoria_id
            GROUP BY producto_vendido.producto_id';

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

    echo json_encode(['data' => $result]);
    
} catch (PDOException $e) {
    die('ERROR: ' . $e->getMessage());
}

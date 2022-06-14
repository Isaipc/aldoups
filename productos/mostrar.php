<?php
header("Content-Type: application/json; charset=UTF-8");

include '../database/conexion.php';

try {
    $stmt = 'SELECT 
                productos.id,
                productos.nombre,
                productos.precio,
                productos.stock,
                productos.descripcion,
                categorias.id AS categoria_id,
                categorias.nombre AS categoria,
                productos.fecha_ingreso,
                productos.fecha_modificacion
            FROM productos 
                INNER JOIN categorias
                ON categorias.id = productos.categoria_id
            WHERE productos.id=?';


    $sql = $conn->prepare($stmt);
    $sql->execute([$_GET['id']]);
    $json = json_encode($sql->fetchObject());

    echo $json;
} catch (PDOException $e) {
    die('ERROR: ' . $e->getMessage());
}

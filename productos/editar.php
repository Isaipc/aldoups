<?php

include '../database/conexion.php';

$json = file_get_contents("php://input");
$data = json_decode($json);

if ($data == null)
    die(http_response_code(400));

try {
    $stmt = $conn->prepare(
        'UPDATE productos SET
            nombre = :nombre,
            precio = :precio,
            stock = :stock,
            descripcion = :descripcion,
            categoria_id = :categoria_id
        WHERE id = :id'
    );

    $stmt->bindParam(':id', $data->id);
    $stmt->bindParam(':nombre', $data->nombre);
    $stmt->bindParam(':precio', $data->precio);
    $stmt->bindParam(':stock', $data->stock);
    $stmt->bindParam(':descripcion', $data->descripcion);
    $stmt->bindParam(':categoria_id', $data->categoria_id);
    $stmt->execute();

    $sql = 'SELECT 
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


    $stmt= $conn->prepare($sql);
    $stmt->execute([$data->id]);

    $json = json_encode($stmt->fetchObject());

    echo $json;
} catch (PDOException $e) {
    die('ERROR : ' . $e->getMessage());
}

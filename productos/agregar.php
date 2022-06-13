<?php
header("Content-Type: application/json; charset=UTF-8");
include '../database/conexion.php';

$json = file_get_contents("php://input");
$data = json_decode($json);


if ($data == null)
    die(http_response_code(400));

try {
    $sql = $conn->prepare('INSERT INTO 
    productos (nombre, precio, stock, descripcion, categoria_id)
    VALUES(:nombre, :precio, :stock, :descripcion, :categoria_id)');

    $sql->bindParam(':nombre', $data->nombre);
    $sql->bindParam(':precio', $data->precio);
    $sql->bindParam(':stock', $data->stock);
    $sql->bindParam(':descripcion', $data->descripcion);
    $sql->bindParam(':categoria_id', $data->categoria_id);
    $result = $sql->execute();

    $id = $conn->lastInsertId();


    $stmt = 'SELECT 
                productos.id,
                productos.nombre,
                productos.precio,
                productos.stock,
                productos.descripcion,
                categorias.nombre AS categoria,
                productos.fecha_ingreso,
                productos.fecha_modificacion
            FROM productos 
                INNER JOIN categorias
                ON categorias.id = productos.categoria_id
            WHERE productos.id=?';

    $sql = $conn->prepare($stmt);
    $sql->execute([$id]);
    $json = json_encode($sql->fetchObject());

    echo $json;

    // echo $sql->rowCount() > 0 ? json_encode($sql):  http_response_code(400);
} catch (PDOException $e) {
    die('ERROR : ' . $e);
}

<?php

include '../database/conexion.php';

$json = file_get_contents("php://input");
$data = json_decode($json);

if ($data == null)
    die(http_response_code(400));

try {
    $sql = $conn->prepare(
        'UPDATE productos SET
            nombre = :nombre,
            precio = :precio,
            stock = :stock,
            descripcion = :descripcion,
            categoria_id = :categoria_id
        WHERE id = :id'
    );

    $sql->bindParam(':id', $data->id);
    $sql->bindParam(':nombre', $data->nombre);
    $sql->bindParam(':precio', $data->precio);
    $sql->bindParam(':stock', $data->stock);
    $sql->bindParam(':descripcion', $data->descripcion);
    $sql->bindParam(':categoria_id', $data->categoria_id);
    $sql->execute();

    $sql = $conn->prepare('SELECT * FROM productos WHERE id=?');
    $sql->execute([$data->id]);
    $json = json_encode($sql->fetchObject());

    echo $json;
} catch (PDOException $e) {
    die('ERROR : ' . $e->getMessage());
}

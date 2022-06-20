<?php

include '../database/conexion.php';

$json = file_get_contents("php://input");
$data = json_decode($json);

if ($data == null)
    die(http_response_code(400));

try {
    $sql = $conn->prepare(
        'UPDATE categorias SET
            nombre = :nombre,
            descripcion = :descripcion
        WHERE id = :id'
    );

    $sql->bindParam(':id', $data->id);
    $sql->bindParam(':nombre', $data->nombre);
    $sql->bindParam(':descripcion', $data->descripcion);
    $sql->execute();

    $sql = $conn->prepare('SELECT * FROM categorias WHERE id=?');
    $sql->execute([$data->id]);
    $json = json_encode($sql->fetchObject());

    echo $json;

} catch (PDOException $e) {
    die('ERROR : ' . $e->getMessage());
}

<?php
header("Content-Type: application/json; charset=UTF-8");
include '../database/conexion.php';

$json = file_get_contents("php://input");
$data = json_decode($json);


if ($data == null)
    die(http_response_code(400));

try {
    $sql = $conn->prepare('INSERT INTO 
    categorias(nombre, descripcion)
    VALUES(:nombre, :descripcion)');

    $sql->bindParam(':nombre', $data->nombre);
    $sql->bindParam(':descripcion', $data->descripcion);
    $result = $sql->execute();

    $id = $conn->lastInsertId();

    $sql = $conn->prepare('SELECT * FROM categorias WHERE id=?');
    $sql->execute([$id]);
    $json = json_encode($sql->fetchObject());

    echo $json;

    // echo $sql->rowCount() > 0 ? json_encode($sql):  http_response_code(400);
} catch (PDOException $e) {
    die('ERROR : ' . $e);
}

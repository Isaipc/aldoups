<?php
header("Content-Type: application/json; charset=UTF-8");
include '../database/conexion.php';

$json = file_get_contents("php://input");
$data = json_decode($json);

if ($data == null)
    die(http_response_code(400));

try {
    $sql = $conn->prepare('DELETE FROM categorias WHERE id = :id');
    $sql->bindParam(':id', $data->id);
    $sql->execute();

    $count = $sql->rowCount();

    if ($count > 0)
        die(http_response_code(200));
    else
        die(http_response_code(400));

} catch (PDOException $e) {
    die('ERROR: ' . $e->getMessage());
}

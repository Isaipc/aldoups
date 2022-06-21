<?php
header("Content-Type: application/json; charset=UTF-8");
include '../database/conexion.php';

$json = file_get_contents("php://input");
$data = json_decode($json);

if ($data == null)
    die(http_response_code(400));

try {
    $sql = 'INSERT INTO cortes_de_caja(efectivo_esperado, efectivo_contado)
     VALUES(:efectivo_esperado, :efectivo_contado, :usuario_id)';
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':efectivo_esperado', $data->efectivo_esperado);
    $stmt->bindParam(':efectivo_contado', $data->efectivo_contado);
    $stmt->bindParam(':usuario_id', $data->usuario_id);
    $result = $stmt->execute();

    $id = $conn->lastInsertId();

    $stmt = $conn->prepare('SELECT * FROM cortes_de_caja WHERE id=?');
    $stmt->execute([$id]);
    $json = json_encode($stmt->fetchObject());

    echo $json;

} catch (PDOException $e) {
    die('ERROR : ' . $e);
}

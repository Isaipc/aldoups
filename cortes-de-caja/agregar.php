<?php
include '../database/conexion.php';
$json = file_get_contents("php://input");
$data = json_decode($json);

if ($data == null)
    die(http_response_code(400));

// definir el rango de fechas
$dt_inicio = new DateTime();
$dt_inicio->setTime(0, 0);

$dt_fin = new DateTime();
$dt_fin->setTime(23, 59, 59);

// formatear las fechas para poder consultar
$inicio = $dt_inicio->format('Y-m-d H:i:s');
$fin = $dt_fin->format('Y-m-d H:i:s');

try {
    // consulta de las ventas del día
    $sql = 'SELECT * FROM ventas WHERE fecha_ingreso BETWEEN :inicio AND :fin';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':inicio', $inicio);
    $stmt->bindParam(':fin', $fin);
    $stmt->execute();

    $ventas = $stmt->fetchAll(PDO::FETCH_OBJ);

    // calcular el total de las ventas del día
    $total = 0;
    $efectivo_esperado = array_reduce($ventas, function ($total, $v) {
        return $total += $v->total;
    });
    $efectivo_esperado = $total;

    var_dump($efectivo_esperado);
    $data->usuario_id = 1;
    $data->efectivo_esperado = $efectivo_esperado;

    $sql = 'INSERT INTO cortes_de_caja(efectivo_esperado, efectivo_contado, usuario_id)
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

    header("Content-Type: application/json; charset=UTF-8");
    echo $json;
} catch (PDOException $e) {
    die('ERROR : ' . $e);
}

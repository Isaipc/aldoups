<?php
include '../database/conexion.php';

try {

    // definir el rango de fechas
    $dt_inicio = new DateTime();
    $dt_inicio->setTime(0, 0);

    $dt_fin = new DateTime();
    $dt_fin->setTime(23, 59, 59);

    // formatear las fechas para poder consultar
    $inicio = $dt_inicio->format('Y-m-d H:i:s');
    $fin = $dt_fin->format('Y-m-d H:i:s');

    // consulta de las ventas del día
    $sql = 'SELECT * FROM ventas WHERE fecha_ingreso BETWEEN :inicio AND :fin';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':inicio', $inicio);
    $stmt->bindParam(':fin', $fin);
    $stmt->execute();

    $ventas = $stmt->fetchAll(PDO::FETCH_OBJ);

    // calcular el total de las ventas del día
    $efectivo_esperado = 0;
    $efectivo_esperado = array_reduce($ventas, function ($total, $v) {
        return $total += $v->total;
    });

} catch (PDOException $e) {
    die('ERROR: ' . $e->getMessage());
}

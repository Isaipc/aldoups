<?php

include '../database/conexion.php';

try {
    // obtener el ultimo corte de caja
    $sql = 'SELECT efectivo_contado FROM cortes_de_caja ORDER BY fecha_ingreso DESC';
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $corte_anterior = $stmt->fetchObject();

} catch (PDOException $e) {
    die('ERROR: ' . $e->getMessage());
}

<?php
header("Content-Type: application/json; charset=UTF-8");

include '../database/conexion.php';


try {
    $sql = $conn->prepare('SELECT * FROM ventas WHERE id=?');
    $sql->execute([$_GET['id']]);
    $json = json_encode($sql->fetchObject());

    echo $json;
} catch (PDOException $e) {
    die('ERROR: ' . $e->getMessage());
}

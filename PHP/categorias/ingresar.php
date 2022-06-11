<?php

include '../conexionBD.php';

if (count($_POST) == 0)
    die(http_response_code(400));

try {
    $sql = $conn->prepare('INSERT INTO 
    categorias(nombre, descripcion)
    VALUES(:nombre, :descripcion)');

    $sql->bindParam(':nombre', $_POST['nombre']);
    $sql->bindParam(':descripcion', $_POST['descripcion']);
    $sql->execute();

    echo $sql->rowCount() > 0  ?
        http_response_code(201) :  http_response_code(400);
} catch (PDOException $e) {
    die('ERROR : ' . $e);
}

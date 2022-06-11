<?php

include '../database/conexion.php';

if(count($_POST) == 0 || !isset($_POST['id']))
    die(http_response_code(400));

try {
    $sql = $conn->prepare(
        'UPDATE categorias SET
            nombre = :nombre,
            descripcion = :descripcion,
        WHERE id = :id');

    $sql->bindParam(':id', $_POST['id']);
    $sql->bindParam(':nombre', $_POST['nombre']);
    $sql->bindParam(':descripcion', $_POST['descripcion']);
    $sql->execute();
    
    echo $sql->rowCount() > 0  ?
        http_response_code(202) :  http_response_code(200);
        
}catch(PDOException $e){
    die('ERROR : ' . $e->getMessage());
}
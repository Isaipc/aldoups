<?php
header("Content-Type: application/json; charset=UTF-8");
include '../database/conexion.php';

$json = file_get_contents("php://input");
$data = json_decode($json);


if ($data == null)
    die(http_response_code(400));

try {
    // se obtienen los valores de la bd:
    // $ids = array_map(function ($e) {
    //     return $e->id;
    // }, $data);

    // $placeholder = str_repeat('?,', count($ids) - 1) . '?';

    // $sql = "SELECT precio, stock FROM productos WHERE id in ($placeholder)";
    // $stmt = $conn->prepare($sql);
    // $stmt->execute($ids);

    // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // // var_dump($result);

    // Se calcula el total de la venta 
    // $total = 0;
    // foreach($data as $key => $producto){
    //     $monto = $producto->precio * $producto->cantidad;
    //     $total += $monto;
    // }

    $usuario_id = 1;
    $total = array_reduce($data, function ($total, $d) {
        return $total += $d->monto;
    });

    //insertar venta
    $sql = 'INSERT INTO ventas(total, usuario_id) VALUES(:total, :usuario_id)';
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':total', $total);
    $stmt->bindParam(':usuario_id', $usuario_id);
    $result = $stmt->execute();

    $venta_id = $conn->lastInsertId();

    //obtener venta insertada
    $stmt = $conn->prepare('SELECT * FROM ventas WHERE id=?');
    $stmt->execute([$venta_id]);
    $json = json_encode($stmt->fetchObject());

    foreach ($data as $key => $d) {
        // insertar productos vendidos
        $sql = 'INSERT INTO producto_vendido(producto_id, venta_id, cantidad, precio)
        VALUES(:producto_id, :venta_id, :cantidad, :precio)';

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':producto_id', $d->id);
        $stmt->bindParam(':venta_id', $venta_id);
        $stmt->bindParam(':cantidad', $d->cantidad);
        $stmt->bindParam(':precio', $d->precio);
        $stmt->execute();

        // actualiza el stock de los productos
        $sql = 'UPDATE productos SET 
            stock = stock - :cantidad
        WHERE id = :id';

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $d->id);
        $stmt->bindParam(':cantidad', $d->cantidad);
        $stmt->execute();
    }

    echo $json;
} catch (PDOException $e) {
    die('ERROR : ' . $e);
}

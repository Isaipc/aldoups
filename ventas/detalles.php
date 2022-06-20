<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de venta</title>
    <?php include '../includes/head.php' ?>
</head>

<body>
    <?php include '../includes/navbar.php' ?>
    <div class="container p-2">
        <h2>Detalles de venta</h3>
            <a class="btn btn-primary" href="/realizar-venta">Registrar nueva venta</a>

            <?php
            include '../database/conexion.php';

            try {

                //ID de la venta seleccionada en el index.php
                $id = $_GET['id'];

                // obtener los datos de la venta
                $sql = 'SELECT * FROM ventas WHERE id = :id';
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $venta = $stmt->fetchObject();

                // obtener los productos registrados en venta
                $sql = 'SELECT 
                        productos.nombre as producto,
                        producto_vendido.cantidad,
                        productos.precio
                        FROM producto_vendido 
                        INNER JOIN productos
                        ON productos.id = producto_vendido.producto_id
                        WHERE venta_id = :venta_id';
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':venta_id', $venta->id);
                $stmt->execute();
                $productos = $stmt->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die('ERROR: ' . $e->getMessage());
            }
            ?>

            <div class="container py-3">
                <div class="row mb-1">
                    <span class="col-2"> ID: </span>
                    <label class="id col-6">
                        <?= $venta->id ?>
                    </label>
                </div>
                <div class="row mb-1">
                    <span class="col-2"> Fecha de igreso: </span>
                    <label class="fecha_ingreso col-6">
                        <?= $venta->fecha_ingreso ?>
                    </label>
                </div>
                <div class="row mb-1">
                    <span class="col-2" class="col"> Total: </span>
                    <label class="descripcion col-6">
                        $ <?= $venta->total ?> MXN
                    </label>
                </div>
            </div>

            <!-- Tabla de visualizacion de datos -->
            <div class="card">
                <div class="card-body">
                    <table class="table table-responsive table-hover table-striped">
                        <thead>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                        </thead>
                        <tbody id="items">
                            <?php

                            foreach ($productos as $key => $p) {
                                echo "<tr>";
                                echo "<td>" . ($key + 1) . "</td>";
                                echo "<td>$p->producto</td>";
                                echo "<td>$p->cantidad</td>";
                                echo "<td>$p->precio</td>";
                                echo "</tr>";
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    <?php include '../includes/scripts.php' ?>
</body>

</html>
<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del corte de caja</title>
    <?php include '../includes/head.php' ?>
</head>

<body>
    <?php include '../includes/navbar.php' ?>
    <div class="container p-2">
        <h2>Detalles del corte de caja</h3>
            <?php
            include '../database/conexion.php';

            // definir el rango de fechas
            $dt_inicio = new DateTime();
            $dt_inicio->setTime(0, 0);

            $dt_fin = new DateTime();
            $dt_fin->setTime(23, 59, 59);

            // formatear las fechas para poder consultar
            $inicio = $dt_inicio->format('Y-m-d H:i:s');
            $fin = $dt_fin->format('Y-m-d H:i:s');

            try {

                //ID de la venta seleccionada en el index.php
                $id = $_GET['id'];

                // obtener los datos del corte de caja
                $sql = 'SELECT * FROM cortes_de_caja WHERE id = :id';
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $corte = $stmt->fetchObject();

                // consulta de las ventas del día
                $sql = 'SELECT * FROM ventas WHERE fecha_ingreso BETWEEN :inicio AND :fin';
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':inicio', $inicio);
                $stmt->bindParam(':fin', $fin);
                $stmt->execute();

                $items = $stmt->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die('ERROR: ' . $e->getMessage());
            }
            ?>

            <div class="container py-3">
                <div class="row mb-1">
                    <span class="col-2"> ID: </span>
                    <label class="id col-6">
                        <?= $corte->id ?>
                    </label>
                </div>
                <div class="row mb-1">
                    <span class="col-2"> Fecha de igreso: </span>
                    <label class="fecha_ingreso col-6">
                        <?= $corte->fecha_ingreso ?>
                    </label>
                </div>
                <div class="row mb-1">
                    <span class="col-2" class="col"> Efectivo esperado: </span>
                    <label class="descripcion col-6">
                        $<?= $corte->efectivo_esperado ?> MXN
                    </label>
                </div>
                <div class="row mb-1">
                    <span class="col-2" class="col"> Efectivo contado: </span>
                    <label class="descripcion col-6">
                        $<?= $corte->efectivo_contado ?> MXN
                    </label>
                </div>

            </div>

            <!-- Tabla de visualizacion de datos -->
            <div class="card">
                <div class="card-body">
                    <table class="table table-responsive table-hover table-striped">
                        <thead>
                            <th>No. venta</th>
                            <th>Total</th>
                            <th>Fecha de ingreso</th>
                            <th>Ingresado por</th>
                        </thead>
                        <tbody id="items">
                            <?php foreach ($items as $key => $i) { ?>
                                <tr>
                                    <td>
                                        <a href="/ventas/detalles?id=<?= $i->id ?>" class="text-decoration-none">
                                            <?= $i->id ?>
                                        </a>
                                    </td>
                                    <td>$<?= $i->total ?></td>
                                    <td><?= $i->fecha_ingreso ?></td>
                                    <td><?= $i->usuario_id ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    <?php include '../includes/scripts.php' ?>
</body>

</html>
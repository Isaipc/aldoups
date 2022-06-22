<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de ventas</title>
    <?php include '../includes/head.php' ?>
</head>

<body>
    <?php include '../includes/navbar.php' ?>
    <div class="container p-2">
        <h2>Historial de ventas</h2>
        <a class="btn btn-primary" href="/realizar-venta">Registrar nueva venta</a>
        <!-- Tabla de visualizacion de datos -->
        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-responsive table-hover table-striped">
                    <thead>
                        <th>No. venta</th>
                        <th>Total importe</th>
                        <th>Fecha de ingreso</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include '../includes/scripts.php' ?>
    <script type="module" src="../js/ventas.js"></script>
</body>

</html>
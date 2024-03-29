<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cortes de caja</title>
    <?php include '../includes/head.php' ?>
</head>

<body>
    <?php include '../includes/navbar.php' ?>
    <div class="container p-2">
        <h2>Historial de cortes de caja</h2>

        <a class="btn btn-primary" href="/realizar-corte">Realizar corte del día </a>

        <!-- Tabla de visualizacion de datos -->
        <div class="card">
            <div class="card-body">
                <table class="table table-responsive table-hover table-striped">
                    <thead>
                        <th>#</th>
                        <th>Efectivo esperado</th>
                        <th>Efectivo contado</th>
                        <th>Fecha de ingreso</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody id="items"></tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include '../includes/scripts.php' ?>
    <script type="module" src="../js/cortes-de-caja.js"></script>
</body>

</html>
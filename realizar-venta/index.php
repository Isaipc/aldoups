<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
    <?php include '../includes/head.php' ?>
</head>

<body>
    <?php include '../includes/navbar.php'; ?>

    <div class="container p-2">
        <h2>Realizar venta</h2>
        <div class="row">
            <div class="col-lg-4 p-3">
                <form action="" id="form">
                    <div class="row mb-2">
                        <label for="producto">Producto</label>
                        <input type="text" name="producto" id="producto" class="form-control">
                    </div>
                    <div class="row mb-3">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control">
                    </div>
                    <div class="row">
                        <button class="btn btn-primary col-lg-6" data-bs-toggle="modal" data-bs-target="#modalGuardar">
                            Agregar
                        </button>
                    </div>
                </form>
            </div>
            <div class="col p-3">
                <table class="table table-md table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Producto 1</td>
                            <td>#</td>
                            <td>#</td>
                        </tr>
                        <tr>
                            <td>Producto 1</td>
                            <td>#</td>
                            <td>#</td>
                        </tr>
                        <tr>
                            <td>Producto 1</td>
                            <td>#</td>
                            <td>#</td>
                        </tr>
                        <tr>
                            <td>Producto 1</td>
                            <td>#</td>
                            <td>#</td>
                        </tr>
                        <tr>
                            <td>Producto 1</td>
                            <td>#</td>
                            <td>#</td>
                        </tr>
                        <tr>
                            <td>Producto 1</td>
                            <td>#</td>
                            <td>#</td>
                        </tr>
                        <tr>
                            <td>Producto 1</td>
                            <td>#</td>
                            <td>#</td>
                        </tr>
                        <tr>
                            <td>Producto 1</td>
                            <td>#</td>
                            <td>#</td>
                        </tr>
                        <tr>
                            <td>Producto 1</td>
                            <td>#</td>
                            <td>#</td>
                        </tr>
                        <tr>
                            <td>Producto 1</td>
                            <td>#</td>
                            <td>#</td>
                        </tr>
                    </tbody>
                </table>

                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalGuardar">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</body>

</html>
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
                <div class="alert alert-danger error">
                    <ul id="errores"></ul>
                </div>
                <form action="" id="form">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="producto">Producto</label>
                            <select name="producto" id="producto" class="form-select">
                                <option value="">--SELECCIONE UN PRODUCTO--</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="cantidad">Precio</label>
                            <input type="number" name="precio" id="precio" class="form-control" disabled>
                        </div>
                        <div class="col">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" value="1">
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary col-lg-6">
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
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody id="carrito"></tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <h4 class="me-4">Total</h4>
                    <h4 id="total">0</h4>
                </div>

                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalGuardar">
                    Guardar
                </button>
            </div>
        </div>
    </div>
    <?php include '../includes/scripts.php' ?>
    <script type="module" src="../js/realizar-venta.js"></script>
</body>

</html>
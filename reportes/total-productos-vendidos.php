<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <?php include '../includes/head.php' ?>
</head>

<body>
    <?php include '../includes/navbar.php'; ?>

    <div class="container p-2">
        <h2>Total de productos vendidos</h2>
        
        <!-- Tabla de visualizacion de datos -->
        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-responsive table-hover table-striped">
                    <thead>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Total vendidos</th>
                        <th>Categoria</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="modelTitledIs" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalle del producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <span class="col-6">ID</span>
                                <label class="id col-6"></label>
                            </div>
                            <div class="row mb-2">
                                <span class="col-6">Nombre</span>
                                <label class="nombre col-6"></label>
                            </div>
                            <div class="row mb-2">
                                <span class="col-6">Precio</span>
                                <label class="precio col-6"></label>
                            </div>
                            <div class="row mb-2">
                                <span class="col-6">Stock</span>
                                <label class="stock col-6"></label>
                            </div>
                            <div class="row mb-2">
                                <span class="col-6">Descripcion del producto</span>
                                <label class="descripcion col-6"></label>
                            </div>
                            <div class="row mb-2">
                                <span class="col-6">Categoria</span>
                                <label class="categoria col-6"></label>
                            </div>
                            <div class="row mb-2">
                                <span class="col-6">Fecha de ingreso</span>
                                <label class="fecha_ingreso col-6"></label>
                            </div>
                            <div class="row mb-2">
                                <span class="col-6">Fecha de modificacion</span>
                                <label class="fecha_modificacion col-6"></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/scripts.php' ?>
    <script type="module" src="../js/total-productos-vendidos.js"></script>
</body>

</html>
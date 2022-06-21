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
        <h2>Productos</h2>
        <!-- Agregar -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalGuardar">
            <i class="bi bi-plus"></i>
            Nuevo
        </button>

        <!-- Tabla de visualizacion de datos -->
        <div class="card">
            <div class="card-body">
                <table class="table table-responsive table-hover table-striped">
                    <thead>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Categoria</th>
                        <th>Fecha de ingreso</th>
                        <th>Fecha de modificacion</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody id="productos"></tbody>
                </table>
            </div>
        </div>

        <form id="form" method="post">
            <div class="modal fade" id="modalGuardar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nueva producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-5">
                            <!-- Lista de errores -->
                            <div class="alert alert-danger modal-error d-none" role="alert">
                                <ul id="errores"></ul>
                            </div>

                            <!-- creacion de formulario -->
                            <div class="row">
                                <input id="id" name="id" type="number" class="d-none">
                                <div class="row mb-3">
                                    <input id="nombre" name="nombre" type="text" class="form-control">
                                    <label for="nombre">Nombre</label>
                                </div>
                                <div class="row mb-3">
                                    <input id="precio" name="precio" type="text" class="form-control">
                                    <label for="precio">Precio</label>
                                </div>
                                <div class="row mb-3">
                                    <input id="stock" name="stock" type="text" class="form-control">
                                    <label for="stock">Stock</label>
                                </div>
                                <div class="row mb-3">
                                    <input id="descripcion" type="text" name="descripcion" class="form-control">
                                    <label for="descripcion">Descripcion de producto </label>
                                </div>
                                <div class="row mb-3">
                                    <select id="categoria" name="categoria" class="form-select" aria-label="Default select example">
                                        <option value="">--SELECCIONA UNA CATEGORIA--</option>
                                    </select>
                                    <label for="category">categoria</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button class="btn btn-success btn-rounded" type="submit">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

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
                                <span class="col-6">Nombre</span>
                                <label class="nombre col-6">[nombre]</label>
                            </div>
                            <div class="row mb-2">
                                <span class="col-6">Precio</span>
                                <label class="precio col-6">[precio]</label>
                            </div>
                            <div class="row mb-2">
                                <span class="col-6">Stock</span>
                                <label class="stock col-6">[stock]</label>
                            </div>
                            <div class="row mb-2">
                                <span class="col-6">Descripcion del producto</span>
                                <label class="descripcion col-6">[descripcion]</label>
                            </div>
                            <div class="row mb-2">
                                <span class="col-6">Categoria</span>
                                <label class="categoria col-6">[categoria]</label>
                            </div>
                            <div class="row mb-2">
                                <span class="col-6">Fecha de ingreso</span>
                                <label class="fecha_ingreso col-6">[fecha]</label>
                            </div>
                            <div class="row mb-2">
                                <span class="col-6">Fecha de modificacion</span>
                                <label class="fecha_modificacion col-6">[fecha]</label>
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
    <script type="module" src="../js/productos.js"></script>
</body>

</html>
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
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalIngresar">
            <i class="bi bi-plus"></i>
            Nuevo
        </button>
        <!-- Eliminar -->
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar">
            Eliminar
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
                    </thead>
                    <tbody id="productos"></tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="modalIngresar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nueva producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-5">
                        <!-- creacion de formulario -->
                        <form id="form" method="post">
                            <div class="row">
                                <input type="hidden" name="id" id="id">
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
                                        <option>--SELECCIONA UNA CATEGORIA--</option>
                                    </select>
                                    <label for="category">categoria</label>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button class="btn btn-success btn-rounded" type="submit">Guardar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar elemento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="post" onsubmit="return validaE(this);">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 md-form">
                                    <input type="text" name="Enombre" id="Ename" class="text-uppercase form-control">
                                    <label for="Ename">Nombre</label>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="modelTitledIs" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal tittle text-white font-weight-bold">Detalle del producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <span class="col-6">Nombre</span>
                                <label id="_nombre" class="col-6">[nombre]</label>
                            </div>
                            <div class="row mb-2">
                                <span class="col-6">Precio</span>
                                <label id="_precio" class="col-6">[precio]</label>
                            </div>
                            <div class="row mb-2">
                                <span class="col-6">Stock</span>
                                <label id="_stock" class="col-6">[stock]</label>
                            </div>
                            <div class="row mb-2">
                                <span class="col-6">Descripcion del producto</span>
                                <label id="_descripcion" class="col-6">[descripcion]</label>
                            </div>
                            <div class="row mb-2">
                                <span class="col-6">Categoria</span>
                                <label id="_categoria" class="col-6">[categoria]</label>
                            </div>
                            <div class="row mb-2">
                                <span class="col-6">Fecha de ingreso</span>
                                <label id="_fecha_ingreso" class="col-6">[fecha]</label>
                            </div>
                            <div class="row mb-2">
                                <span class="col-6">Fecha de modificacion</span>
                                <label id="_fecha_modificacion" class="col-6">[fecha]</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/scripts.php' ?>
    <script type="module" src="../js/productos.js"></script>
</body>

</html>
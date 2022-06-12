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
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalIngresar">
            <i class="bi bi-plus"></i>
            Agregar
        </button>

        <div class="modal fade" id="modalIngresar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nueva insercion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-5">
                        <!-- creacion de formulario -->
                        <form id="form" action="#" method="post" onsubmit="return valida(this);">
                            <div class="row">
                                <input type="hidden" name="id" id="id">
                                <div class="col-lg-6 col-md-6 md-form">
                                    <input id="name" name="nombre" type="text" class="text-uppercase form-control">
                                    <label for="name">nombre</label>
                                </div>
                                <div class="col-lg-6 col-md-6 md-form">
                                    <input id="cost" name="precio" type="text" class="text-uppercase form-control">
                                    <label for="cost">Precio</label>
                                </div>
                                <div class="col-lg-6 col-md-6 md-form">
                                    <input id="stock" name="stock" type="text" class="text-uppercase form-control">
                                    <label for="stock">cantidad</label>
                                </div>
                                <div class="col-lg-6 col-md-6 md-form">
                                    <input id="date" name="fecha" type="date" class="text-uppercase form-control">
                                    <label for="date">fecha de ingreso</label>
                                </div>
                                <div class="col-lg-6 col-md-6 md-form">
                                    <input type="text" name="descripcion" id="desc" class="text-uppercase form-control">
                                    <label for="desc"> descripcion de producto </label>
                                </div>
                                <div class="col-lg-6 col-md-6 md-form">
                                    <select id="category" name="categoria" class="form-select" aria-label="Default select example">
                                        <option selected>--SELECCIONA --</option>
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
        <!-- Eliminar -->
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar">
            eliminar
        </button>


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


        <!-- Tabla de visualizacion de datos -->

        <div class="card">
            <div class="card-body">
                <table id="account-grid" class="table table-responsive table-hover">
                    <thead>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Descripcion</th>
                        <th>Categoria</th>
                        <th>Fecha de ingreso</th>
                    </thead>
                    <tbody id="account-grid-body"></tbody>
                </table>
                <div id="grid-alert" class="alert alert-warning" role="alert">
                    <i class="fas fa-info-circle"></i><strong id="grid-message"></strong>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="modelTitledIs" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal tittle text-white font-weight-bold">Detalle del producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-4 col-sm-4 text-primary font-weight-bold">Nombre</div>
                                <label id="nombre-agregar" class="col-6">[nombre]</label>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-4 text-primary font-weight-bold">Precio</div>
                                <label for="precio-agregar" class="col-6">[precio]</label>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-4 text-primary font-weight-bold">Cantidad</div>
                                <label for="cantidad-agregar" class="col-6">[cantidad]</label>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-4 text-primary font-weight-bold">Descripcion de producto
                                </div>
                                <label for="descripcion-agregar" class="col-6">[descripcion]</label>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-4 text-primary font-weight-bold">categoria</div>
                                <label for="categoria-agregar" class="col-6">[categoria]</label>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-4 text-primary font-weight-bold">Fecha de igreso</div>
                                <label for="fecha-agregar" class="col-6">[fecha]</label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/scripts.php' ?>
</body>

</html>
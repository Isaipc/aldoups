<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
    <?php include '../includes/head.php' ?>
</head>

<body>
    <?php include '../includes/navbar.php' ?>
    <div class="container p-2">
        <h2>Categorias</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalIngresar">
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
                        <th>Descripcion</th>
                        <th>Fecha de ingreso</th>
                        <th>Fecha de modificacion</th>
                    </thead>
                    <tbody id="categorias"></tbody>
                </table>
            </div>
        </div>

        <!-- Modal ingreso -->
        <form id="form" action="#" method="POST">
            <div class="modal fade" id="modalIngresar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nueva categoria</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-5">
                            <!-- creacion de formulario -->
                            <div class="row mb-2">
                                <input type="hidden" name="id" id="id">
                                <input id="nombre" name="nombre" type="text" class="form-control">
                                <label for="nombre">Nombre</label>
                            </div>
                            <div class="row">
                                <textarea id="descripcion" name="descripcion" class="form-control"></textarea>
                                <label for="descripcion">Descripcion<label>
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

        <!-- Modal detalle -->
        <div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="modelTitledIs" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detalles de la categoría</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-1">
                            <span> Nombre: </span>
                            <span id="_nombre">[nombre]</span>
                        </div>
                        <div class="row mb-1">
                            <span class="col"> Descripcion: </span>
                            <span class="col" id="_descripcion">[descripcion]</span>
                        </div>
                        <div class="row mb-1">
                            <span> Fecha de igreso: </span>
                            <span id="_fecha_ingreso">[fecha]</span>
                        </div>
                        <div class="row mb-1">
                            <span> Fecha de modifiacion: </span>
                            <span id="_fecha_modificacion">[fecha]</span>
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
    <script type="module" src="../js/categorias.js"></script>
</body>

</html>
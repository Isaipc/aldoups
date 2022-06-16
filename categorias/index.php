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
                        <th>Descripcion</th>
                        <th>Fecha de ingreso</th>
                        <th>Fecha de modificacion</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody id="categorias"></tbody>
                </table>
            </div>
        </div>

        <!-- Modal ingreso -->
        <form id="form" action="#" method="POST">
            <div class="modal fade" id="modalGuardar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nueva categoria</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-5">
                            <!-- Lista de errores -->
                            <div class="alert alert-danger modal-error" role="alert">
                                <ul id="errores"></ul>
                            </div>
                            <!-- creacion de formulario -->
                            <input id="id" name="id" type="number" class="d-none">
                            <div class="row mb-2">
                                <input id="nombre" name="nombre" type="text" class="form-control">
                                <label for="nombre">Nombre</label>
                            </div>
                            <div class="row">
                                <input id="descripcion" name="descripcion" type="text" class="form-control">
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
                            <span class="col-6"> ID: </span>
                            <label class="id col-6">[ID]</label>
                        </div>
                        <div class="row mb-1">
                            <span class="col-6"> Nombre: </span>
                            <label class="nombre col-6">[nombre]</label>
                        </div>
                        <div class="row mb-1">
                            <span class="col-6" class="col"> Descripcion: </span>
                            <label class="descripcion col-6">[descripcion]</label>
                        </div>
                        <div class="row mb-1">
                            <span class="col-6"> Fecha de igreso: </span>
                            <label class="fecha_ingreso col-6">[fecha]</label>
                        </div>
                        <div class="row mb-1">
                            <span class="col-6"> Fecha de modifiacion: </span>
                            <label class="fecha_modificacion col-6">[fecha]</label>
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
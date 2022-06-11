<!DOCTYPE html>
<html lang="es-MX">

<head>
    <title>INCIO</title>
    <meta charset="UTF-8">
    <meta name="Pagina_inicio" content="pagina principal del proyecto de programacion web">
    <?php include 'includes/head.php' ?>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>
    <div class="container p-2">
        <a href="" class="btn btn-primary">
            <i class="bi bi-currency-dollar"></i>
            Realizar venta
        </a>
        <a href="" class="btn btn-primary">
            <i class="bi bi-check-lg"></i>
            Realizar corte de caja
        </a>
        <h2 class="text-center py-5"> VEZAG DISTRIBUIDORA AUTORIZADO XD </h2>
        <!-- Busqueda -->
        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel">Buscar elemento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="post" onsubmit="return validaB(this);">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 md-form">
                                    <input id="Rname" name="Bnombre" type="text" class="text-uppercasse form-control">
                                    <label for="Rname">Nombre</label>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button class="btn btn-primary">buscar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Modal 2</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Hide this modal and show the first with the button below.
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Back to first</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <?php include 'includes/scripts.php' ?>
</body>

</html>
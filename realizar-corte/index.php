<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar corte de caja</title>
    <?php include '../includes/head.php' ?>
</head>

<body>
    <?php include '../includes/navbar.php'; ?>
    <?php include '../cortes-de-caja/mostrar_ventas_del_dia.php'; ?>
    <?php include '../cortes-de-caja/mostrar_corte_anterior.php'; ?>

    <div class="container p-2">
        <h2>Realizar corte de caja</h2>
        <div class="row">
            <div class="col p-3">
                <div class="row mb-3">
                    <div class="col">
                        <table class="table table-md table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>No. venta</th>
                                    <th>Fecha</th>
                                    <th class="text-end">Total importe</th>
                                </tr>
                            </thead>
                            <tbody id="items">
                                <?php foreach ($ventas as $key => $v) { ?>
                                    <tr>
                                        <td>
                                            <a href="/ventas/detalles?id=<?= $v->id ?>" class="text-decoration-none">
                                                <?= $v->id ?>
                                            </a>
                                        </td>
                                        <td><?= $v->fecha_ingreso ?></td>
                                        <td class="text-end">$<?= $v->total ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            <h4 class="me-4">Total</h4>
                            <h4 id="total"> $<?= $efectivo_esperado ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 p-3">
                <form action="" id="form">
                    <div class="row mb-3">
                        <div class="col-xl-4 col-lg-12">
                            <label for="fecha">Fecha de corte</label>
                        </div>
                        <div class="col">
                            <input type="text" name="fecha" id="fecha" class="form-control" value="<?= $dt_inicio->format('d/m/Y') ?>" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-4 col-lg-12">
                            <label for="fondo_anterior">Fondo anterior</label>
                        </div>
                        <div class="col">
                            <input type="text" id="fondo_anterior" class="form-control" value="<?= $corte_anterior->efectivo_contado ?? 0 ?>" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-4 col-lg-12">
                            <label for="efectivo_esperado">Efectivo esperado</label>
                        </div>
                        <div class="col">
                            <input type="text" id="efectivo_esperado" class="form-control" value="<?= $efectivo_esperado ?>" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="alert alert-danger error d-none">
                            <ul id="errores"></ul>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-4 col-lg-12">
                            <label for="efectivo_contado">Efectivo contado</label>
                        </div>
                        <div class="col">
                            <input type="text" name="efectivo_contado" id="efectivo_contado" class="form-control">
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-lg-8">
                            <button type="submit" class="btn btn-primary w-100">
                                Guardar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include '../includes/scripts.php' ?>
    <script type="module" src="../js/realizar-corte-de-caja.js"></script>
</body>

</html>
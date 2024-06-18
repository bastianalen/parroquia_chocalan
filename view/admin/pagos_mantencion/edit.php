<?php

include '../../../controller/controllerpagosmantencion.php';
// require_once("../../../controller/initialize.php");

if (!isset($_SESSION['user_id'])){
  redirect(web_root."view/admin/index.php");
}

$n_registro = $_GET['n_registro'];
$pagosmantencion = new PagosMantencion();
$pagomantencion = $pagosmantencion->single_pagosmantencion($n_registro);
?>  




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Datos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>




    <form class="form-horizontal" action="../../../controller/controllerpagosmantencion.php?action=edit" method="POST" >
        <div class="mb-3 row">
            <label for="rut" class="col-md-4 col-form-label">rut :</label>
            <div class="col-md-8">
                <input type="hidden" class="form-control" id="n_registro" name="n_registro" placeholder="n_registro" value="<?php echo $pagomantencion->n_registro; ?>">
                <input type="text" class="form-control" id="rut" name="rut" placeholder="rut" value="<?php echo $pagomantencion->rut; ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="n_tumba" class="col-md-4 col-form-label">n_tumba :</label>
            <div class="col-md-8">
                <input type="number" class="form-control" id="n_tumba" name="n_tumba" placeholder="n_tumba" value="<?php echo $pagomantencion->n_tumba; ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="patio" class="col-md-4 col-form-label">patio :</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="patio" name="patio" placeholder="patio" value="<?php echo $pagomantencion->patio; ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="propietario" class="col-md-4 col-form-label">propietario :</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="propietario" name="propietario" placeholder="propietario" value="<?php echo $pagomantencion->propietario; ?>">
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="fecha_pago" class="col-md-4 col-form-label">fecha_pago :</label>
            <div class="col-md-8">
                <input type="date" class="form-control" id="fecha_pago" name="fecha_pago" placeholder="año" value="<?php echo $pagomantencion->fecha_pago; ?>">
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="monto" class="col-md-4 col-form-label">monto :</label>
            <div class="col-md-8">
                <input type="number" class="form-control" id="monto" name="monto" placeholder="monto" value="<?php echo $pagomantencion->monto; ?>">
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="estado_pago" class="col-md-4 col-form-label">estado_pago:</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="estado_pago" name="estado_pago" placeholder="estado de pago" value="<?php echo $pagomantencion->estado_pago; ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-md-8 offset-md-4">
                <button class="btn btn-primary" name="update" type="submit">Actualizar</button>
                <a href="index.php" class="btn btn-info">Atrás</a>
            </div>
        </div>
    </form>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
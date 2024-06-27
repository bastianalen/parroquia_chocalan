<?php
include "../../../controller/controllerpagosmantencion.php";


// Comprobar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
$pago_mantencion = isset($_POST['pago_mantencion']) ? $_POST['pago_mantencion'] : "";

$pagomantencion = new PagoMantencion();
if (!empty($pago_mantencion)){
    $pagomantenciones = $pagomantencion->find_pagomantenciones($pago_mantencion);
} else {
    $pagomantenciones = $pagomantencion->listofpagomantencion_distinct();
}

$persona = new Persona();

$sector = new Sector();

$tipotumba = new TipoTumba();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos Mantención</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <form action="index.php" method="post" class="form-inline justify-content-center">
            <div class="form-group">
                <input type="text" name="pago_mantencion" class="form-control mr-2" placeholder="Buscar aquí...">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Pagos Mantención
            </h1>
        </div>
    </div>

    <form action="index.php?view=add" method="POST">
        <div class="table-responsive">
            <table id="dash-table" class="table table-striped table-bordered table-hover" style="font-size: 12px" cellspacing="0">
                <thead>
                    <tr>
                    <!--<th>nºregistro</th> -->
                        <th>Propietario</th>
                        <th>Rut Propietario</th>
                        <th>Difunto</th>
                        <th>Tumba</th>
                        <th>Tipo Tumba</th>
                        <th>Sector</th>
                        <th>acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                    echo "<script>console.log(".json_encode($pagomantenciones).")</script>";
                    foreach ($pagomantenciones as $result) {
                        echo '<tr>';
                        
                        $persona_r = $persona->single_people_id($result['id_persona']);
                        echo '<td>' . $persona_r->propietario . '</td>';
                        echo '<td>' . $persona_r->rut. '</td>';
                        echo '<td>' . $persona_r->pnombre . '</td>';
                        echo '<td>' . $persona_r->nro_tumba . '</td>';

                        $tipotumba_r = $tipotumba->single_tumba($persona_r->tipo_tumba);
                        echo '<td>' . $tipotumba_r->tipo . '</td>';

                        $sector_r = $sector->single_sector($persona_r->id_sector);
                        echo '<td>' . $sector_r->sector . '</td>';
                       
                        echo '<td align="center" > <a title="Detalles" href="index.php?view=edit&id_persona=' . $result['id_persona'] . '"  class="btn btn-primary btn-xs ">  <span class="fa fa-edit fw-fa"></span></a>					
                        <a title="Editar" href="../../../controller/controllerpagosmantencion.php?action=delete&id_persona=' . $result['id_persona'] . '"  class="btn btn-danger btn-xs">  <span class="fa fa-trash fw-fa"></span></a>
                         </td>';
                        echo '</tr>';
                    }
                    ?>
                   
                </tbody>
            </table>
        </div>
    </form>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>


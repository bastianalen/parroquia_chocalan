<?php

include '../../../controller/controllerpagosmantencion.php';
// require_once("../../../controller/initialize.php");

if (!isset($_SESSION['user_id'])) {
    redirect(web_root . "view/admin/index.php");
}

$n_registro = $_GET['n_registro'];
$pagosmantencion = new PagosMantencion();
$pagomantencion = $pagosmantencion->single_pagosmantencion($n_registro);

echo "<script>console.log('pagomantencion2: " . json_encode($pagomantencion) . "')</script>";
echo "<script>console.log('pagomantencion: " . $pagomantencion->n_tumba . "')</script>";

$pago = new Pagos();
$pagos = $pago->find_pagos_tumba_sector($pagomantencion->n_tumba, $pagomantencion->patio);
$pagos_count = $pago->count_find_pagos_tumba_sector($pagomantencion->n_tumba, $pagomantencion->patio);

echo "<script>console.log('pagos: " . json_encode($pagos) . "')</script>";
$sector = new Sector();

$sectores = $sector->single_sector($pagomantencion->patio);
echo "<script>console.log('sector: " . json_encode($sectores->sector) . "')</script>";
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Mantenciones</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>



    <form class="form-horizontal" action="../../../controller/controllerpagosmantencion.php?action=edit" method="POST">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Editar Mantención</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="table-responsive">
            <table id="dash-table" class="table table-striped table-bordered table-hover" style="font-size: 12px"
                cellspacing="0">
                <thead>
                    <tr>
                        <!--<th>nºregistro</th> -->
                        <th>Patio</th>
                        <th>Tumba</th>
                        <?php

                        foreach ($pagos as $result) {

                            echo '<td>' . $result['id_anio'] . '</td>';

                        }
                        ?>



                    </tr>
                </thead>
                <tbody>
                    <?php

                    $anios_pagados = [];
                    echo '<tr>';
                    echo '<td>' . $sectores->sector . '</td>';
                    echo '<td>' . $pagomantencion->n_tumba . '</td>';
                    foreach ($pagos as $result) {
                        echo "<script>console.log('pasgos: ".json_encode($result['id_anio'])."')</script>";
                        echo '<td>Pagado</td>';
                        $anios_pagados[] = $result['id_anio'];
                    }
                    echo "<script>console.log('pasgos: ".json_encode($anios_pagados)."')</script>";
                    //echo '<td align="center" > <a title="Editar" href="index.php?view=edit&n_registro=' . $result['n_registro'] . '"  class="btn btn-primary btn-xs ">  <span class="fa fa-edit fw-fa"></span></a>					
                    //<a title="Editar" href="../../../controller/controllerpagosmantencion.php?action=delete&n_registro=' . $result['n_registro'] . '"  class="btn btn-danger btn-xs">  <span class="fa fa-trash fw-fa"></span></a>					
                    //
                    //</td>';
                    echo '</tr>';
                    ?>

                </tbody>
            </table>
        </div>

        <div class="mb-3 row">
            <div class="col-md-4 control-label">
                <?php
                
                echo '<a title="Añadir" href="index.php?view=add&sector=' . $pagomantencion->patio . '&n_tumba=' . $pagomantencion->n_tumba . '&anios=' . urlencode(json_encode($anios_pagados)) . '" class="btn btn-primary btn-xs">
                        <i class="fa fa-plus-circle fw-fa"></i> Añadir año pagado
                    </a>';
                
                ?>

                <a href="index.php" class="btn btn-info">Atrás</a>
            </div>
        </div>
    </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
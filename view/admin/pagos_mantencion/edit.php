<?php

include '../../../controller/controllerpagosmantencion.php';
// require_once("../../../controller/initialize.php");

if (!isset($_SESSION['user_id'])) {
    redirect(web_root . "view/admin/index.php");
}

$id_persona = $_GET['id_persona'];

$pago = new PagoMantencion();
$pagos = $pago->find_pagos_persona($id_persona);

$persona = new Persona();
$datos_persona = $persona->single_people_id($id_persona);

$sector = new Sector();
$sectores = $sector->single_sector($datos_persona->id_sector);

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos de Mantencion</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>



    <form class="form-horizontal" action="../../../controller/controllerpagosmantencion.php?action=edit" method="POST">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Pagos de Mantencion</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="table-responsive">
            <table id="dash-table" class="table table-striped table-bordered table-hover" style="font-size: 12px"
                cellspacing="0">
                <thead>
                    <tr>
                        <!--<th>nºregistro</th> -->
                        <th>Propietario</th>
                        <th>Difunto</th>
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
                    echo '<td>' . $datos_persona->propietario . '</td>';
                    echo '<td>' . $datos_persona->pnombre . '</td>';
                    foreach ($pagos as $result) {
                        echo '<td>Pagado</td>';
                        $anios_pagados[] = $result['id_anio'];
                    }
                    echo '</tr>';
                    ?>

                </tbody>
            </table>
        </div>

        <div class="mb-3 row">
            <div class="col-md-4 control-label">
                <?php
                
                echo '<a title="Añadir" href="index.php?view=add&id_persona=' . $datos_persona->id_persona . '&anios=' . urlencode(json_encode($anios_pagados)) . '" class="btn btn-primary">
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
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
        <form action="index.php" method="GET" class="form-inline justify-content-center">
            <div class="form-group">
                <input type="text" name="query" class="form-control mr-2" placeholder="Buscar aquí...">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Pagos Mantención
                <a href="index.php?view=add" class="btn btn-primary btn-xs">
                    <i class="fa fa-plus-circle fw-fa"></i> Nuevo
                </a>
            </h1>
        </div>
    </div>

    <form action="index.php?view=add" method="POST">
        <div class="table-responsive">
            <table id="dash-table" class="table table-striped table-bordered table-hover" style="font-size: 12px" cellspacing="0">
                <thead>
                    <tr>
                        <th>nºregistro</th>
                        <th>rut</th>
                        <th>nºtumba</th>
                        <th>patio</th>
                        <th>propietario</th>
                        <th>fecha pago</th>
                        <th>monto</th>
                        <th>estado pago</th>
                        <th>accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $pagosmantencion = new PagosMantencion;
                    $pagosmantenciones=$pagosmantencion->listofpagosmantencion();

                    foreach ($pagosmantenciones as $result) {
                       
                        echo '<tr>';
                       
                        echo '<td>' . $result['n_registro']. '</td>';
                        echo '<td>' . $result['rut']. '</td>';
                        echo '<td>' . $result['n_tumba'] . '</td>';
                        echo '<td>' . $result['patio'] . '</td>';
                        echo '<td>' . $result['propietario'] . '</td>';
                        echo '<td>' . $result['fecha_pago'] . '</td>';
                        echo '<td>' . $result['monto'] . '</td>';
                        echo '<td>' . $result['estado_pago'] . '</td>';
                       
                        echo '<td align="center" > <a title="Editar" href="index.php?view=edit&n_registro=' . $result['n_registro'] . '"  class="btn btn-primary btn-xs ">  <span class="fa fa-edit fw-fa"></span></a>					
                        <a title="Editar" href="../../../controller/controllerpagosmantencion.php?action=delete&n_registro=' . $result['n_registro'] . '"  class="btn btn-danger btn-xs">  <span class="fa fa-trash fw-fa"></span></a>					
                        
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


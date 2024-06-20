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

// Inicializa la clase Persona
$pagosmantencion = new PagosMantencion();
if (!empty($pago_mantencion)){
    $pagosmantenciones = $pagosmantencion->find_pagosmantenciones($pago_mantencion);
} else {
    $pagosmantenciones = $pagosmantencion->listofpagosmantencion();
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
                        <th>Tumba</th>
                        <th>Tipo Tumba</th>
                        <th>Patio</th>
                        <th>Fecha Pago</th>
                        <th>Monto</th>
                        <th>Estado Pago</th>
                        <th>acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                    foreach ($pagosmantenciones as $result) {
                       
                        echo '<tr>';
                       
                        //echo '<td>' . $result['n_registro']. '</td>';
                        echo '<td>' . $result['propietario'] . '</td>';
                        echo '<td>' . $result['rut']. '</td>';
                        echo '<td>' . $result['n_tumba'] . '</td>';
                        echo '<td>' . $result['tipo'] . '</td>';
                        echo '<td>' . $result['sector'] . '</td>';
                        
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



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
<html>
<head>
    <title>Pagos Mantención</title>
</head>
<body>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar</title>
    
</head>
<body>
    <div class="container mt-5">
        <form action="index.php" method="GET" class="form-inline justify-content-center">
            <div class="form-group">
                <input type="text" name="query" class="form-control mr-2" placeholder="Buscar aqui...">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>
</body>



<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Pagos mantencion<a href="index.php?view=add" class="btn btn-primary btn-xs"><i class="fa fa-plus-circle fw-fa"></i> Nuevo</a></h1>
    </div>
</div>

<form action="edit.php" method="POST">
    <div class="table-responsive">
        <table id="dash-table" class="table table-striped table-bordered table-hover" style="font-size: 12px" cellspacing="0">
            <thead>
                <tr>
                    <th>SELECCION</th>
                    <th>N° REGISTRO</th>
                    <th>RUT</th>
                    <th>N_TUMBA</th>
                    <th>PATIO</th>
                    <th>PROPIETARIO</th>
                    <th>FECHA PAGO</th>
                    <th>MONTO</th>
                    <th>ESTADO_PAGO</th>
                    <th>ACCION</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td align="center"><input type="checkbox" name="selector[]" value="<?php echo $row['N_REGISTRO']; ?>"></td>
                    <td><?php echo htmlspecialchars($row['N_REGISTRO']); ?></td>
                    <td><?php echo htmlspecialchars($row['RUT']); ?></td>
                    <td><?php echo htmlspecialchars($row['N_TUMBA']); ?></td>
                    <td><?php echo htmlspecialchars($row['PATIO']); ?></td>
                    <td><?php echo htmlspecialchars($row['PROPIETARIO']); ?></td>
                    <td><?php echo htmlspecialchars($row['FECHA_PAGO']); ?></td>
                    <td><?php echo htmlspecialchars($row['MONTO']); ?></td>
                    <td><?php echo htmlspecialchars($row['ESTADO_PAGO']); ?></td>
                    <td align="center">
                        <button type="submit" class="btn btn-primary btn-xs" name="edit_id" value="<?php echo $row['N_REGISTRO']; ?>">
                            <i class="fa fa-pencil fw-fa"></i>
                        </button>
                        <button type="submit" class="btn btn-danger btn-xs" name="delete" value="Eliminar">
                            <i class="fa fa-trash fw-fa"></i>
                        </button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</form>



</body>
</html>

<?php
$conn->close();
?>



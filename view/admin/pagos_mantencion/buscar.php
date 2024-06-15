<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parroquia_chocalan";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el término de búsqueda
$query = $_GET['query'];

// Preparar la consulta
$sql = "SELECT RUT,NOMBRES FROM tblpagosmantencion WHERE rut LIKE ? ";
$stmt = $conn->prepare($sql);
$search = "%$query%";
$stmt->bind_param("s", $search);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Búsqueda</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Resultados de Búsqueda</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                <th>SELECCION</th>
					<th>N° REGISTRO</th>
                    <th>RUT</th>
                    <th>PATIO</th>
                    <th>NOMBRES</th>
                    <th>FECHA PAGO</th>
                    <th>MONTO</th>
                    <th>ACCION</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['N_REGISTRO']); ?></td>
                        <td><?php echo htmlspecialchars($row['RUT']); ?></td>
                        <td><?php echo htmlspecialchars($row['PATIO']); ?></td>
                        <td><?php echo htmlspecialchars($row['NOMBRES']); ?></td>
                        <td><?php echo htmlspecialchars($row['FECHA_PAGO']); ?></td>
                        <td><?php echo htmlspecialchars($row['MONTO']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">No se encontraron resultados</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Cerrar conexión
$conn->close();
?>

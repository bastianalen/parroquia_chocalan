<?php
require_once __DIR__ . '../../src/payment.php';

$donacion =  new Donacion();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['token_ws'])) {
    $token = $_GET['token_ws']; // Capturar el token de Transbank desde el parámetro token_ws

    // Lógica para confirmar la transacción con Transbank
    $response = commitTransaction($token);

    // Preparar los datos para mostrar en la boleta
    $isApproved = $response->isApproved();
    $authorizationCode = $response->getAuthorizationCode();
    $amount = $response->getAmount(); // Asegúrate de tener este método en tu response
    $transactionDate = $response->getTransactionDate(); // Asegúrate de tener este método en tu response

    $message = $isApproved ? "PAGO EXITOSO GRACIAS POR TU APORTE!" : "UPS! LO SENTIMOS NO SE PUDO REALIZAR EL PAGO";
    $details = $isApproved ? "Código de autorización: $authorizationCode" : "";
} else {
    $message = "Parámetro token_ws no encontrado.";
    $details = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Pago</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h2><?php echo $message; ?></h2>
            </div>
            <div class="card-body">
                <?php if ($isApproved): ?>
                    <h5 class="card-title">Detalles de la Transacción</h5>
                    <p class="card-text"><strong>Monto:</strong> $<?php echo htmlspecialchars($amount); ?></p>
                    <p class="card-text"><strong>Fecha de Transacción:</strong> <?php echo htmlspecialchars($transactionDate); ?></p>
                    <p class="card-text"><strong><?php echo $details; ?></strong></p>
                    <a href="../../index.php" class="btn btn-success">Volver al Inicio</a>
                <?php else: ?>
                    <p class="card-text"><?php echo $details; ?></p>
                    <div class="text-center">
                    <a href="../../view/donaciones/donaciones.php" class="btn btn-danger">Intentar de Nuevo</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>

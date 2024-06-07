<?php
// public/return.php

require_once __DIR__ . '../../src/payment.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['token_ws'])) {
    $token = $_GET['token_ws']; // Capturar el token de Transbank desde el parámetro token_ws

    // Lógica para confirmar la transacción con Transbank
    $response = commitTransaction($token);

    if ($response->isApproved()) {
        echo "Pago exitoso, código de autorización: " . $response->getAuthorizationCode();
    } else {
        echo "Pago fallido.";
    }
} else {
    echo "Parámetro token_ws no encontrado.";
}
?>
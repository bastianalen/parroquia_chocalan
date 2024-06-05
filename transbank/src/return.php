<?php
// public/return.php

require_once __DIR__ . '/../src/payment.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token_ws'];
    $response = commitTransaction($token);

    if ($response->isApproved()) {
        echo "Pago exitoso, código de autorización: " . $response->getAuthorizationCode();
    } else {
        echo "Pago fallido.";
    }
}
?>
<?php
// src/payment.php

require_once __DIR__ . '/../vendor/autoload.php';

use Transbank\Webpay\WebpayPlus\Transaction;

function createTransaction($amount, $sessionId, $buyOrder, $returnUrl)
{
    $config = require __DIR__ . '/config.php';

    // Convertir el carácter "$" de la variable $amount de payment y en el script que esta en el input de donaciones.php a caracter especial jiji :)
    $amount = (int) str_replace('$', '', $amount);

    $transaction = new Transaction();
    $response = $transaction->create($buyOrder, $sessionId, $amount, $returnUrl);

    return $response;
}

function commitTransaction($token)
{
    $transaction = new Transaction();
    $response = $transaction->commit($token);

    return $response;


    
}

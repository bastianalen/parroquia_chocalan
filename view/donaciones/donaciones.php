<?php

session_start();
// Manejo de la solicitud de donación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once  "../../transbank/src/payment.php";

    $amount = $_POST['amount'];
    $sessionId = session_id();
    $buyOrder = uniqid();
    $returnUrl = 'http://localhost/parroquia_chocalan/transbank/src/return.php';

    $response = createTransaction($amount, $sessionId, $buyOrder, $returnUrl);

    header('Location: ' . $response->getUrl() . '?token_ws=' . $response->getToken());
    exit();
}
?>




<!DOCTYPE html>
    <html>

    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donaciones</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="../donaciones/DonacionStyle.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
    <!-- seccion de donaciones redireccion con la api de pago en webpay de transbank -->
    <!-- --------------------------------------------------------------------------------------------- -->
                <div class="container">
                    <form action="" method="post" class="donation-form">
                    <header class="font-thin mb-10 py-10">
                        <div class="container mx-auto flex items-center">
                            <div class="text">
                                <h1 class="text-4xl font-bold text-pink-700">Redirigir a Transbank 
                                    <span class="text-sm font-thin"><br>Parroquia Chocalan
                                    </span> 
                                </h1> 
                            <div class="form-group">
                            <label for="amount">Monto a donar:</label>
                            <input type="text" name="amount" id="amount" class="form-control" placeholder="ingrese monto aqui" oninput="addPesoSign(this)" required>
                            <!-- este script hace que se anteponga un signo peso al valor que le ingreso al imput en ingresar monto aqui -->
                            <script>
                            function addPesoSign(input) {
                                // Asegurarse de que el campo tiene algún valor y que no comience con el signo de peso
                                if (input.value.trim() === "" || input.value.trim() === "$") {
                                    // Fijar el signo de peso al principio del campo
                                    input.value = "$";
                                } else {
                                    // Si el campo ya tiene un valor, mantenerlo tal como está
                                    input.value = input.value;
                                }
                                
                                // Configurar el evento oninput para agregar el signo de peso mientras se escribe
                                input.oninput = function() {
                                    let value = input.value.trim();
                                    if(value.charAt(0) !== "$") {
                                        input.value = "$" + value;
                                    }
                                };
                            }
                            </script>
                        </div>
                        <button type="submit" class="btn btn-primary">ir a transbank</button>
                    </form>
                </div>
    <!-- ---------------------------------------------------------------------------------------------- -->
    </body>
</html>
<?php
require_once ("initialize.php");

header('Content-Type: application/json');
// Local
// $pdo = new PDO("mysql:dbname=parroquia_chocalan;host=127.0.0.1", "root", "");

// Host
// $pdo = new PDO("mysql:dbname=cpa101887_parroquia;host=localhost", "cpa101887_admin", "parroquia_srl_chocalan");

$accion = (isset($_GET['accion'])) ? $_GET['accion'] : 'leer';
switch ($accion) {
    
    default:
        // Obtiene los tipos de servicios
        $evento = new Eventos();
        $eventos = $evento->list_of_eventos();
        echo json_encode($eventos);

    
}
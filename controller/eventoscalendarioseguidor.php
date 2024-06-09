<?php
require_once ("initialize.php");

header('Content-Type: application/json');
$pdo = new PDO("mysql:dbname=parroquia_chocalan;host=127.0.0.1", "root", "");

$accion = (isset($_GET['accion'])) ? $_GET['accion'] : 'leer';
switch ($accion) {
    
    default:
        try{
            // Obtiene los tipos de servicios
            $evento = new Eventos();
            $eventos = $evento->list_of_eventos();

            echo json_encode($eventos);
        } catch (PDOException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;

    
}
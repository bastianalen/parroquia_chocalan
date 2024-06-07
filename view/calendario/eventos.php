<?php
require_once ("../../admin/model/initialize.php");

header('Content-Type: application/json');
$pdo = new PDO("mysql:dbname=parroquia_chocalan;host=127.0.0.1", "root", "");

$accion = (isset($_GET['accion'])) ? $_GET['accion'] : 'leer';
switch ($accion) {
    
    default:
        try{
            /*sellecionar los eventos del calendario */
            $sentenciaSQL = $pdo->prepare("SELECT * FROM tblcaleneucaristia");
            $sentenciaSQL->execute();
    
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($resultado);
        } catch (PDOException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;

    
}
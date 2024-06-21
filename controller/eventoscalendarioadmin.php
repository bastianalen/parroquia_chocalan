<?php
require_once ("initialize.php");

header('Content-Type: application/json');
// Local
// $pdo = new PDO("mysql:dbname=parroquia_chocalan;host=127.0.0.1", "root", "");

// Host
// $pdo = new PDO("mysql:dbname=cpa101887_parroquia;host=localhost", "cpa101887_admin", "parroquia_srl_chocalan");

$accion = (isset($_GET['accion'])) ? $_GET['accion'] : 'leer';
switch ($accion) {
    case 'agregar':
        doInsert();
        break;


    case 'eliminar':
        doDelete();
        break;
    case 'modificar':
        doEdit();
        break;
    
    default:
        // Verificar si tipo_calendario está definido en $_POST
        if (!isset($_POST['tipo_calendario'])) {
            echo json_encode(['error' => 'El parámetro tipo_calendario no está definido.']);
            exit;
        }

        $tipo_calendario = $_POST['tipo_calendario'];

        $evento = new Eventos();
        $eventos = $evento->list_of_eventos_tipo($tipo_calendario);
        // Verificar que el resultado es un array
        if (is_array($eventos)) {
            // echo "<script>console.log('eventoscalendarioadmin.php 1: eventos: ' ". json_encode($eventos)." )</script>";
            echo json_encode($eventos);
        } else {
            echo json_encode(['error' => 'No se encontraron eventos.']);
        }
        break;

    
}

function doInsert() {

    $evento = new Eventos();
    
    $data = array(
            "titulo" => $_POST['titulo'],
            "descripcion" => $_POST['descripcion'],
            "color" => $_POST['color'],
            "colorTexto" => $_POST['colorTexto'],
            "tipo_servicio" => $_POST['tipo_servicio'],
            "inicio" => $_POST['inicio'],
            "fin" => $_POST['fin'],
            "tipo_calendario" => $_POST['tipo_calendario'],
        );

    $respuesta = $evento->create($data);
    
    echo json_encode($respuesta);
}

function doEdit() {
    /*instruccion de modificar */
    $evento = new Eventos();
    $data = array(
            "titulo" => $_POST['titulo'],
            "descripcion" => $_POST['descripcion'],
            "color" => $_POST['color'],
            "colorTexto" => $_POST['colorTexto'],
            "tipo_servicio" => $_POST['tipo_servicio'],
            "inicio" => $_POST['inicio'],
            "fin" => $_POST['fin'],
            "tipo_calendario" => $_POST['tipo_calendario'],
        );

    $respuesta = $evento->update($data,$_POST['id']);
    echo json_encode($respuesta);
}

function doDelete() {
    
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $evento = new Eventos();
        $respuesta = $evento->delete($id);
    }
    echo json_encode($respuesta);
}
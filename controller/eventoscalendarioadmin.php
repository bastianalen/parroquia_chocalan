<?php
require_once ("initialize.php");

header('Content-Type: application/json');
/*Incluye el archivo de inicialización y configura el encabezado de 
la respuesta como JSON, indicando que todas las respuestas de este script estarán en formato JSON. */

// Local
// $pdo = new PDO("mysql:dbname=parroquia_chocalan;host=127.0.0.1", "root", "");

// Host
// $pdo = new PDO("mysql:dbname=cpa101887_parroquia;host=localhost", "cpa101887_admin", "parroquia_srl_chocalan");
/*El switch determina la acción según el valor de $_GET['accion']. */
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : 'leer';
switch ($accion) {
    /*agregar: Llama a la función doInsert() para agregar un nuevo evento. */
    case 'agregar':
        doInsert();
        break;
    /*eliminar: Llama a la función doDelete() para eliminar un evento existente. */
    case 'eliminar':
        doDelete();
        break;
    /*modificar: Llama a la función doEdit() para modificar un evento existente. */
    case 'modificar':
        doEdit();
        break;
    /*leer (por defecto): Obtiene eventos de un tipo específico
     (tipo_calendario) usando el método list_of_eventos_tipo() del modelo Eventos. */
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
/*Función doInsert() para Agregar Eventos: */
function doInsert() {

    $evento = new Eventos();
    /*Recibe datos del evento desde $_POST.
    Crea un nuevo evento utilizando el método create() del modelo Eventos.
    Devuelve la respuesta en formato JSON. */
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
/*Función doEdit() para Modificar Eventos: */
function doEdit() {
    /*instruccion de modificar */
    $evento = new Eventos();
    /*Recibe datos actualizados del evento desde $_POST.
    Actualiza el evento con el ID especificado utilizando el método update() del modelo Eventos.
    Devuelve la respuesta en formato JSON. */
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
/*Función doDelete() para Eliminar Eventos: */
function doDelete() {
/*Recibe el ID del evento a eliminar desde $_POST.
Elimina el evento con el ID especificado utilizando el método delete() del modelo Eventos.
Devuelve la respuesta en formato JSON. */
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $evento = new Eventos();
        $respuesta = $evento->delete($id);
    }
    echo json_encode($respuesta);
}
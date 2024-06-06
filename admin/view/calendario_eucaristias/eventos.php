<?php
require_once ("../../model/initialize.php");

header('Content-Type: application/json');
$pdo = new PDO("mysql:dbname=parroquia_chocalan;host=127.0.0.1", "root", "");

$accion = (isset($_GET['accion'])) ? $_GET['accion'] : 'leer';
switch ($accion) {
    case 'agregar':
        /*instruccion de agregado */
        $sentenciaSQL = $pdo->prepare("INSERT INTO
        tblcaleneucaristia(titulo,descripcion,color,colorTexto,tipo_servicio,inicio,fin,tipo_calendario)
        VALUES(:titulo,:descripcion,:color,:colorTexto,:tipo_servicio,:inicio,:fin,:tipo_calendario)");

        $respuesta = $sentenciaSQL->execute(
            array(
                "titulo" => $_POST['titulo'],
                "descripcion" => $_POST['descripcion'],
                "color" => $_POST['color'],
                "colorTexto" => $_POST['colorTexto'],
                "tipo_servicio" => $_POST['tipo_servicio'],
                "inicio" => $_POST['inicio'],
                "fin" => $_POST['fin'],
                "tipo_calendario" => $_POST['tipo_calendario'],
            )
        );
        echo json_encode($respuesta);
        break;


    case 'eliminar':
        /*instruccion de eliminar */
        $respuesta = false;
        if (isset($_POST['id'])) {
            $sentenciaSQL = $pdo->prepare("DELETE FROM tblcaleneucaristia WHERE id=:id");
            $respuesta = $sentenciaSQL->execute(array("id" => $_POST['id']));
        }
        echo json_encode($respuesta);

        break;
    case 'modificar':
        /*instruccion de modificar */

        $sentenciaSQL = $pdo->prepare("UPDATE tblcaleneucaristia SET
        titulo=:titulo,
        descripcion=:descripcion,
        color=:color,
        colorTexto=:colorTexto,
        tipo_servicio=:tipo_servicio,
        inicio=:inicio,
        fin=:fin
        tipo_calendario=:tipo_calendario
        WHERE id=:id "
        );
        $respuesta = $sentenciaSQL->execute(
            array(
                "id"=> $_POST['id'],
                "titulo" => $_POST['titulo'],
                "descripcion" => $_POST['descripcion'],
                "color" => $_POST['color'],
                "colorTexto" => $_POST['colorTexto'],
                "tipo_servicio" => $_POST['tipo_servicio'],
                "inicio" => $_POST['inicio'],
                "fin" => $_POST['fin'],
                "tipo_calendario" => $_POST['tipo_calendario'],
            )
        );
        // echo "<script>console.log(".json_encode($respuesta).")</script>";
        echo json_encode($respuesta);
        break;
    
    default:
        // Verificar si tipo_calendario está definido en $_POST
        if (!isset($_POST['tipo_calendario'])) {
            echo json_encode(['error' => 'El parámetro tipo_calendario no está definido.']);
            exit;
        }

        $tipo_calendario = $_POST['tipo_calendario'];

        try{
            /*sellecionar los eventos del calendario */
            $sentenciaSQL = $pdo->prepare("SELECT * FROM tblcaleneucaristia WHERE tipo_calendario = :tipo_calendario");
            $sentenciaSQL->bindParam(':tipo_calendario', $tipo_calendario, PDO::PARAM_INT);
            $sentenciaSQL->execute();

            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

            // Verificar que el resultado es un array
            if (is_array($resultado)) {
                // echo "<script>console.log(". json_encode($resultado)." )</script>";
                echo json_encode($resultado);
            } else {
                echo json_encode(['error' => 'No se encontraron eventos.']);
            }
        } catch (PDOException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;

    
}
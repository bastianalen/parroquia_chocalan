<?php
require_once ("../../model/initialize.php");

header('Content-Type: application/json');
$pdo = new PDO("mysql:dbname=parroquia_chocalan;host=127.0.0.1", "root", "");

$accion = (isset($_GET['accion'])) ? $_GET['accion'] : 'leer';

switch ($accion) {
    case 'agregar':
        /*instruccion de agregado */
        $sentenciaSQL = $pdo->prepare("INSERT INTO
        tblcaleneucaristia(titulo,descripcion,color,colorTexto,inicio,fin)
        VALUES(:titulo,:descripcion,:color,:colorTexto,:inicio,:fin)");

        $respuesta = $sentenciaSQL->execute(
            array(
                "titulo" => $_POST['titulo'],
                "descripcion" => $_POST['descripcion'],
                "color" => $_POST['color'],
                "colorTexto" => $_POST['colorTexto'],
                "inicio" => $_POST['inicio'],
                "fin" => $_POST['fin'],
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
        inicio=:inicio,
        fin=:fin
        WHERE id=:id
        ");
        $respuesta = $sentenciaSQL->execute(
            array(
                "id"=> $_POST['id'],
                "titulo" => $_POST['titulo'],
                "descripcion" => $_POST['descripcion'],
                "color" => $_POST['color'],
                "colorTexto" => $_POST['colorTexto'],
                "inicio" => $_POST['inicio'],
                "fin" => $_POST['fin'],
            )
        );
        echo json_encode($respuesta);
        break;
    
    default:
        /*sellecionar los eventos del calendario */
        $sentenciaSQL = $pdo->prepare("SELECT * FROM tblcaleneucaristia");
        $sentenciaSQL->execute();

        $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        break;

    
}



?>
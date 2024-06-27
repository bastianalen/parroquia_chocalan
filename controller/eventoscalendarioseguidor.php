<?php
/*Se incluye el archivo de inicialización (initialize.php) contiene la 
configuración inicial del sistema, incluyendo la conexión a 
la base de datos u otras configuraciones necesarias.
 */
require_once ("initialize.php");
/*Se establece el encabezado de la respuesta como JSON,
 lo cual indica que todas las respuestas del script estarán en formato JSON. */
header('Content-Type: application/json');
// Local
// $pdo = new PDO("mysql:dbname=parroquia_chocalan;host=127.0.0.1", "root", "");

// Host
// $pdo = new PDO("mysql:dbname=cpa101887_parroquia;host=localhost", "cpa101887_admin", "parroquia_srl_chocalan");


/*Se utiliza $_GET['accion'] para determinar qué acción debe realizarse. Si $_GET['accion'] no está definido, se asigna 'leer' como valor por defecto.
Dentro del switch, la acción por defecto (default) se ejecuta cuando no se especifica ninguna acción específica ('accion').
Se instancia un objeto Eventos y se llama al método list_of_eventos(), que probablemente consulta la base de datos para obtener una lista de eventos.
Los eventos obtenidos se convierten en formato JSON usando json_encode() y se envían como respuesta al cliente. */
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : 'leer';
switch ($accion) {
    
    default:
        // Obtiene los tipos de servicios
        $evento = new Eventos();
        $eventos = $evento->list_of_eventos();
        echo json_encode($eventos);

    
}
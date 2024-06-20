<?php
// Asegurarse de que los errores se muestren en desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Obtener la ruta del archivo actual
$this_file = str_replace('\\', '/', __FILE__);
$doc_root = $_SERVER['DOCUMENT_ROOT'];

// Definir las rutas web y del servidor
$web_root = str_replace(array($doc_root, "controller/config.php"), '', $this_file);
$server_root = str_replace('controller/config.php', '', $this_file);

define('web_root', $web_root);
define('server_root', $server_root);

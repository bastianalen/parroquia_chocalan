<?php
// Asegurarse de que los errores se muestren en desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Obtener la ruta del archivo actual
/*__FILE__ es una constante mágica de PHP que devuelve la ruta completa del archivo actual.
str_replace('\\', '/', __FILE__) reemplaza todas las barras invertidas
 (\) por barras normales (/). Esto es importante para asegurar 
 que la ruta esté en el formato de Unix, incluso en entornos Windows. */
$this_file = str_replace('\\', '/', __FILE__);
/*$_SERVER['DOCUMENT_ROOT'] contiene la ruta del directorio raíz del servidor web en el sistema de archivos. */
$doc_root = $_SERVER['DOCUMENT_ROOT'];

/*$web_root se obtiene eliminando $doc_root y el nombre del archivo (controller/config.php) de la ruta del archivo actual ($this_file).
$server_root se obtiene eliminando solo el nombre del archivo (controller/config.php) de la ruta del archivo actual ($this_file). */
// Definir las rutas web y del servidor
$web_root = str_replace(array($doc_root, "controller/config.php"), '', $this_file);
$server_root = str_replace('controller/config.php', '', $this_file);
/*define() se utiliza para definir constantes en PHP. En este caso, se definen dos constantes:
web_root: Representa la ruta relativa desde la raíz del servidor web hasta el directorio donde se encuentra el archivo config.php.
server_root: Representa la ruta absoluta del sistema de archivos hasta el directorio donde se encuentra el archivo config.php, excluyendo el nombre del archivo. */
define('web_root', $web_root);
define('server_root', $server_root);

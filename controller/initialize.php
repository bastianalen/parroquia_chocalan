<?php
/*Este código en PHP establece varias constantes y carga archivos de configuración y funciones necesarios para una aplicación.  */
/*Definición de la constante DS (DIRECTORY_SEPARATOR): */
/*Esta línea define la constante DS como el separador
 de directorios del sistema operativo actual (DIRECTORY_SEPARATOR).
  Si ya está definida, no hace nada (null). Esto es útil para asegurar 
  la compatibilidad con diferentes sistemas operativos. */
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

/*Define la constante SITE_ROOT como la ruta absoluta al directorio 
raíz del sitio web. Utiliza $_SERVER['DOCUMENT_ROOT'] para obtener la raíz 
del documento del servidor web y concatena con DS y el nombre del directorio 
parroquia_chocalan. Esto asume que parroquia_chocalan es el directorio principal 
de la aplicación dentro de la raíz del servidor. */
defined('SITE_ROOT') ? null : define ('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].DS.'parroquia_chocalan');
// Fin local


/*LIB_PATH se define como la ruta al directorio controller dentro de SITE_ROOT.
LIB_PATH_MODEL se define como la ruta al directorio model dentro de SITE_ROOT. */
defined('LIB_PATH') ? null : define ('LIB_PATH',SITE_ROOT.DS.'controller');
defined('LIB_PATH_MODEL') ? null : define ('LIB_PATH_MODEL',SITE_ROOT.DS.'model');

/*Estas líneas cargan archivos PHP necesarios para la funcionalidad del 
sitio web desde los directorios controller y model.
Los archivos incluidos (config.php, function.php, session.php, etc.) 
probablemente contienen configuraciones de base de datos, funciones útiles, 
manejo de sesiones y definiciones de clases relacionadas con los modelos de datos específicos de la aplicación. */

/*este código PHP inicializa rutas y constantes necesarias para la aplicación, 
asegurando la inclusión correcta de archivos y configuraciones esenciales para su funcionamiento adecuado. */
require_once(LIB_PATH.DS."config.php");
require_once(LIB_PATH.DS."function.php");
require_once(LIB_PATH.DS."session.php");
require_once(LIB_PATH_MODEL.DS."accounts.php");
require_once(LIB_PATH_MODEL.DS."sector.php");
require_once(LIB_PATH_MODEL.DS."solicitud.php");
require_once(LIB_PATH_MODEL.DS."people.php");
require_once(LIB_PATH_MODEL.DS."tiposervicio.php");
require_once(LIB_PATH_MODEL.DS."calendario.php");
require_once(LIB_PATH_MODEL.DS."tipotumba.php");
require_once(LIB_PATH_MODEL.DS."tipocalendario.php");
require_once(LIB_PATH_MODEL.DS."roluser.php");
require_once(LIB_PATH_MODEL.DS."pagomantencion.php");
require_once(LIB_PATH_MODEL.DS."estadospagos.php");
require_once(LIB_PATH_MODEL.DS."anios.php");
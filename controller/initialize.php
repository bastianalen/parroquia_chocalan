<?php
//define the core paths
//Define them as absolute peths to make sure that require_once works as expected

//DIRECTORY_SEPARATOR is a PHP Pre-defined constants:
//(\ for windows, / for Unix)
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : define ('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].DS.'parroquia_chocalan');

defined('LIB_PATH') ? null : define ('LIB_PATH',SITE_ROOT.DS.'controller');
defined('LIB_PATH_MODEL') ? null : define ('LIB_PATH_MODEL',SITE_ROOT.DS.'model');

//load the database configuration first.
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
require_once(LIB_PATH_MODEL.DS."pagosmantencion.php");
require_once(LIB_PATH_MODEL.DS."estadospagos.php");
require_once(LIB_PATH_MODEL.DS."pagos.php");
require_once(LIB_PATH_MODEL.DS."anios.php");
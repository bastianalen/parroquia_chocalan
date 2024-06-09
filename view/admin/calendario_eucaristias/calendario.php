<?php 
require_once("../../../controller/initialize.php");
if (!isset($_SESSION['user_id'])){
 redirect(web_root."view/admin/login.php");
} 

$content='home.php';
$view = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
switch ($view) {
	case '1' :
        $titulo="Panel Administrador";	
		$content='index2.php';		
		break;	
	default :
	    $titulo="Panel Administrador";	
		$content ='index2.php';		
}
require_once("../theme/templates.php");
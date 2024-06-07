<?php 
require_once("../../public/include/initialize.php");

$content='index.php';
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
require_once("viewsolicitarhora.php");
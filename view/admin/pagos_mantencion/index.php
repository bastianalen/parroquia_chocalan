<?php
require_once("../../../controller/initialize.php");

if(!isset($_SESSION['user_id'])){
	redirect(web_root."admin/view/index.php");
}

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

	$header=$view;
	$titulo="pagos_mantencion"; 
	switch ($view) {

	case 'list' :
	 
		$content    = 'list.php';		
		break;

	case 'add' : 
		$content    = 'add.php';		
		break;

	case 'edit' : 
		$content    = 'edit.php';		
		break;

	case 'view' : 
		$content    = 'view.php';
		break;
  

  	default :
	$titulo="Pagos Mantencion";
		$content    = 'list.php';
	}
  

require_once ("../theme/templates.php");


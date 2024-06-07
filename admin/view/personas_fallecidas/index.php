<?php
require_once("../../model/initialize.php");
//checkAdmin();
	# code...
if(!isset($_SESSION['user_id'])){
	redirect(web_root."admin/view/index.php");
}

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

	$header=$view;
	$titulo="Fallecidos"; 
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
	$titulo="Fallecidos";
		$content    = 'list.php';
	}
  

require_once ("../../theme/templates.php");


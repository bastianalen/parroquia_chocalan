<?php
require_once("../../model/initialize.php");
if(!isset($_SESSION['user_id'])){
	redirect(web_root."../index.php");
}
$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
$titulo ='Report';
switch ($view) {
	case 'list' :

		$content    = 'list.php';		
		break;
			
	default :
		$content    = 'list.php';		
}
require_once '../../theme/templates.php';

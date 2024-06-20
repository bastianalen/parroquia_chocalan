<?php

require_once ("initialize.php");
if (!isset($_SESSION['user_id'])) {
	redirect(web_root . "view/admin/index.php");
}

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add':
		doInsert();
		break;

	case 'edit':
		doEdit();
		break;

	case 'delete':
		doDelete();
		break;

}

function doInsert()
{
	// global $mydb;
	if (isset($_POST['save'])) {
		
		
		$pagos = new Pagos();
		
		$pagos->sector = $_POST['id_sector'];
		$pagos->id_anio = $_POST['anio'];
		$pagos->n_tumba = $_POST['n_tumba'];
		
		echo "<script>console.log('1: ".$_POST['id_sector']."')</script>";
		echo "<script>console.log('2: ".$_POST['anio']."')</script>";
		echo "<script>console.log('3: ".$_POST['n_tumba']."')</script>";
		echo "<script>console.log('4: ".json_encode($pagos)."')</script>";
		// $pagos->create();
		message("¡Nueva Sección creada exitosamente!", "success");
		//redirect("../view/admin/pagos_mantencion/index.php");

	}
}

function doEdit()
{
	if (isset($_POST['update'])) {
		$pagos = new Pagos();

		$pagos->sector = $_POST['sector'];
		$pagos->id_anio = $_POST['id_anio'];
		$pagos->n_tumba = $_POST['n_tumba'];

		$pagos->update($_POST['id_pago']);
		message("¡Seccion actualizada!", "success");
		redirect("../view/admin/pagos_mantencion/index.php");
	}
}

function doDelete()
{
	$id_pago = $_GET['id_pago'];
	$pagos = new Pagos();
	$pagos->delete($id_pago);
	message("¡Pago eliminado!", "info");
	redirect('../view/admin/pagos_mantencion/index.php');

}
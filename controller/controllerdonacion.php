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
		$fecha_actual = date('Y-m-d');
		
		$donacion = new Donacion();
		
		$donacion->id_donacion = $_POST['id_donacion'];
		$donacion->monto = $_POST['monto'];
		$donacion->fecha = $fecha_actual;
		
		$donacion->create();
		message("¡Nueva Sección creada exitosamente!", "success");
		redirect("../view/admin/pagos_mantencion/index.php");

	}
}

function doEdit()
{
	if (isset($_POST['update'])) {
		$donacion = new Donacion();
		
		$donacion->id_donacion = $_POST['id_donacion'];
		$donacion->monto = $_POST['monto'];
		$donacion->fecha = $fecha_actual;

		$donacion->update($_POST['id_donacion']);
		message("¡Seccion actualizada!", "success");
		redirect("../view/admin/pagos_mantencion/index.php");
	}
}

function doDelete()
{
	$id_donacion = $_GET['id_donacion'];
	$donacion = new Donacion();
	$donacion->delete($id_donacion);
	message("¡Donacion eliminada!", "info");
	redirect('../view/admin/pagos_mantencion/index.php');

}
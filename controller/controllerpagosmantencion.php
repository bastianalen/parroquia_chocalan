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
		
		$pagomantencion = new PagoMantencion();
		
		$pagomantencion->id_anio = $_POST['anio'];
		$pagomantencion->id_persona = $_POST['id_persona'];
		$pagomantencion->fecha_pago = $fecha_actual;
		$pagomantencion->monto = $_POST['monto'];
		$pagomantencion->estado = 2;
		
		// echo "<script>console.log('2: ".$_POST['anio']."')</script>";
		// echo "<script>console.log('2: ".$_POST['id_persona']."')</script>";
		// echo "<script>console.log('2: ".$fecha_actual."')</script>";
		// echo "<script>console.log('2: ".$_POST['monto']."')</script>";
		// echo "<script>console.log('4: ".json_encode($pagomantencion)."')</script>";
		$pagomantencion->create();
		message("¡Nueva Sección creada exitosamente!", "success");
		redirect("../view/admin/pagos_mantencion/index.php");

	}
}

function doEdit()
{
	if (isset($_POST['update'])) {
		$pagomantencion = new PagoMantencion();

		$pagomantencion->id_anio = $_POST['anio'];
		$pagomantencion->id_persona = $_POST['id_persona'];
		$pagomantencion->fecha_pago = $_POST['fecha_pago'];
		$pagomantencion->monto = $_POST['monto'];
		$pagomantencion->estado = 2;

		$pagomantencion->update($_POST['id_pago']);
		message("¡Seccion actualizada!", "success");
		redirect("../view/admin/pagos_mantencion/index.php");
	}
}

function doDelete()
{
	$id_pago = $_GET['id_pago'];
	$pagomantencion = new PagoMantencion();
	$pagomantencion->delete($id_pago);
	message("¡Pago eliminado!", "info");
	redirect('../view/admin/pagos_mantencion/index.php');

}
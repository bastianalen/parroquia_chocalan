<?php
/*El código comienza incluyendo el archivo de inicialización (initialize.php) 
y verifica si hay una sesión activa ($_SESSION['user_id']). Si no hay sesión */
require_once ("initialize.php");
if (!isset($_SESSION['user_id'])) {
	redirect(web_root . "view/admin/index.php");
}

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
/*Dependiendo del valor de $action, se llama a una de las funciones definidas (doInsert(), doEdit(), doDelete()). */
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
	/*Esta función se ejecuta cuando se envía el formulario para agregar un nuevo pago de mantenimiento ($_POST['save']).
	Se crea un nuevo objeto PagoMantencion, se asignan los valores desde el formulario y se llama al método create() para insertar el registro en la base de datos. */
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
/*Esta función maneja la actualización de un registro de pago de mantenimiento ($_POST['update']).
Se crea un objeto PagoMantencion, se asignan los valores desde el formulario de edición y se llama
al método update() con el ID del pago ($_POST['id_pago']) para actualizar el registro correspondiente en la base de datos. */
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
/*Esta función elimina un registro de pago de mantenimiento ($_GET['id_pago']).
Se crea un objeto PagoMantencion y se llama al método delete() con el ID del pago para eliminar el registro correspondiente en la base de datos. */
function doDelete()
{
	$id_pago = $_GET['id_pago'];
	$pagomantencion = new PagoMantencion();
	$pagomantencion->delete($id_pago);
	message("¡Pago eliminado!", "info");
	redirect('../view/admin/pagos_mantencion/index.php');

}
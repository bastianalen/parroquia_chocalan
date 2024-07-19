<?php
require_once("initialize.php");
if (!isset($_SESSION['user_id'])) {
	redirect(web_root . "view/admin/administradores/index.php");
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

	case 'photos':
		doupdateimage();
		break;


}

function doInsert()
{
	if (isset($_POST['save'])) {


		if ($_POST['nombre'] == "" or $_POST['user_nom'] == "" or $_POST['user_contra'] == "") {
			$messageStats = false;
			message("¡Todos los campos son obligatorios!", "error");
			redirect('../view/admin/administradores/index.php?view=add');
		} else {
			$user = new User();
			// $user->user_id 		= $_POST['user_id'];
			$user->nombre = $_POST['nombre'];
			$user->user_nom = $_POST['user_nom'];
			$user->user_contra = sha1($_POST['user_contra']);
			$user->id_rol = $_POST['id_rol'];
			$user->email = $_POST['user_nom'];
			$user->create();

			message("¡Nuevo usuario [" . $_POST['nombre'] . "] creado exitosamente!", "success");
			redirect("../view/admin/administradores/index.php");

		}
	}

}

function doEdit()
{
	if (isset($_POST['save'])) {

		$user = new User();
		$user->nombre = $_POST['nombre'];
		$user->user_nom = $_POST['user_nom'];
		$user->user_contra = sha1($_POST['user_contra']);
		$user->id_rol = $_POST['id_rol'];
		$user->email = $_POST['user_nom'];
		$user->update($_POST['user_id']);

		message("El usuario [" . $_POST['nombre'] . "] ha sido actualizado!", "success");
		redirect("../view/admin/administradores/index.php");
	}
}


function doDelete()
{
	$id = $_GET['id'];

	$user = new User();
	$user->delete($id);

	message("¡Usuario eliminado!","success");
	redirect('../view/admin/administradores/index.php');

}

function doupdateimage()
{

	$errofile = $_FILES['photo']['error'];
	$type = $_FILES['photo']['type'];
	$temp = $_FILES['photo']['tmp_name'];
	$myfile = $_FILES['photo']['name'];
	$location = "photos/" . $myfile;


	if ($errofile > 0) {
		message("¡No hay Imagen seleccionada!", "error");
		redirect("../view/admin/administradores/index.php?view=view&id=" . $_GET['id']);
	} else {

		@$file = $_FILES['photo']['tmp_name'];
		@$image = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		@$image_name = addslashes($_FILES['photo']['name']);
		@$image_size = getimagesize($_FILES['photo']['tmp_name']);

		if ($image_size == FALSE) {
			message("¡El archivo subido no es una imagen!", "error");
			redirect("../view/admin/administradores/index.php?view=view&id=" . $_GET['id']);
		} else {
			//uploading the file
			move_uploaded_file($temp, "photos/" . $myfile);



			$user = new User();
			$user->user_img = $location;
			$user->update($_SESSION['user_id']);
			message("¡La imagen se actualizó correctamente!", "success");
			redirect("photos/");


		}
	}

}

?>
<?php
require_once("../../include/initialize.php");
if (!isset($_SESSION['USERID'])) {
	redirect(web_root . "admin/index.php");
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


		if ($_POST['U_NAME'] == "" or $_POST['U_USERNAME'] == "" or $_POST['U_PASS'] == "") {
			$messageStats = false;
			message("¡Todos los campos son obligatorios!", "error");
			redirect('index.php?view=add');
		} else {
			$user = new User();
			// $user->USERID 		= $_POST['user_id'];
			$user->U_NAME = $_POST['U_NAME'];
			$user->U_USERNAME = $_POST['U_USERNAME'];
			$user->U_PASS = sha1($_POST['U_PASS']);
			$user->U_ROLE = $_POST['U_ROLE'];
			$user->create();

			// $autonum = New Autonumber(); 
			// $autonum->auto_update(2);

			message("¡Nuevo [" . $_POST['U_NAME'] . "] creado exitosamente!", "exito");
			redirect("index.php");

		}
	}

}

function doEdit()
{
	if (isset($_POST['save'])) {

		$user = new User();
		$user->U_NAME = $_POST['U_NAME'];
		$user->U_USERNAME = $_POST['U_USERNAME'];
		$user->U_PASS = sha1($_POST['U_PASS']);
		$user->U_ROLE = $_POST['U_ROLE'];
		$user->update($_POST['USERID']);

		message("[" . $_POST['U_NAME'] . "] ha sido actualizado!", "exito");
		redirect("index.php");
	}
}


function doDelete()
{
	$id = $_GET['id'];

	$user = new User();
	$user->delete($id);

	message("¡Usuario ya eliminado!");
	redirect('index.php');

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
		redirect("index.php?view=view&id=" . $_GET['id']);
	} else {

		@$file = $_FILES['photo']['tmp_name'];
		@$image = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		@$image_name = addslashes($_FILES['photo']['name']);
		@$image_size = getimagesize($_FILES['photo']['tmp_name']);

		if ($image_size == FALSE) {
			message("¡El archivo subido no es una imagen!", "error");
			redirect("index.php?view=view&id=" . $_GET['id']);
		} else {
			//uploading the file
			move_uploaded_file($temp, "photos/" . $myfile);



			$user = new User();
			$user->USERIMAGE = $location;
			$user->update($_SESSION['USERID']);
			redirect("index.php");


		}
	}

}

?>
<?php
require_once("../../public/include/initialize.php");
// require_once("../../admin/model/initialize.php");

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
	if (isset($_POST['save'])) {


		if ($_POST['nombre'] == "" or $_POST['userEmail'] == "" or $_POST['fecha'] == "" or $_POST['hora_solicitud'] == "" or $_POST['tipo_servicio'] == "") {
			$messageStats = false;
			message("¡Todos los campos son obligatorios!", "error");
			redirect('index.php');
		} else {
			$solicitud = new Solicitud();
			$solicitud->nombre = $_POST['nombre'];
			$solicitud->email = $_POST['userEmail'];
			$solicitud->fecha_solicitud = $_POST['fecha'];
			$solicitud->fecha_envio = (new DateTime())->format('Y-m-d H:i:s');;
			$solicitud->hora_solicitud = $_POST['hora_solicitud'];
			$solicitud->tipo_servicio = $_POST['tipo_servicio'];
			$solicitud->comentario = $_POST['userMessage'];
			$solicitud->create();
			message("¡Nueva solicitud de [" . $_POST['nombre'] . "] enviada con exito!", "exito");
			redirect("index.php");

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

		message("[" . $_POST['nombre'] . "] ha sido actualizado!", "exito");
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
			$user->user_img = $location;
			$user->update($_SESSION['user_id']);
			redirect("photos/");


		}
	}

}

?>
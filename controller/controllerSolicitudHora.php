<?php
require_once("initialize.php");

/*Se determina la acción solicitada a través del parámetro GET action.
Dependiendo de la acción, se llama a la función correspondiente (doInsert(), doEdit(), doDelete()). */
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
/*doInsert() se activa al enviar el formulario para agregar una nueva solicitud ($_POST['save']).
Verifica si los campos obligatorios están completos.
Crea un objeto Solicitud, asigna los valores del formulario y llama al método create() 
para guardar la solicitud en la base de datos. */
function doInsert()
{
	if (isset($_POST['save'])) {


		if ($_POST['nombre'] == "" or $_POST['userEmail'] == "" or $_POST['fecha'] == "" or $_POST['hora_solicitud'] == "" or $_POST['tipo_servicio'] == "") {
			$messageStats = false;
			message("¡Todos los campos son obligatorios!", "error");
			redirect('../view/solicitarhora/index.php');
		} else {
			$solicitud = new Solicitud();
			$solicitud->nombre = $_POST['nombre'];
			$solicitud->email = $_POST['userEmail'];
			$solicitud->fecha_solicitud = $_POST['fecha'];
			$solicitud->fecha_envio = (new DateTime())->format('Y-m-d H:i:s');;
			$solicitud->hora_solicitud = $_POST['hora_solicitud'];
			$solicitud->tipo_servicio = $_POST['tipo_servicio'];
			$solicitud->comentario = $_POST['userMessage'];
			$solicitud->estado = $_POST['estado_solicitud'];
			$solicitud->create();
			message("¡Nueva solicitud de [" . $_POST['nombre'] . "] enviada con exito!", "exito");
			redirect("../view/solicitarhora/index.php");

		}
	}

}
/*doEdit() maneja la edición de un usuario existente ($_POST['save']).
Crea un objeto User, asigna los nuevos valores y llama al método update()
para actualizar los datos del usuario en la base de datos.
 */
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
		redirect("../view/solicitarhora/index.php");
	}
}

/*doDelete() elimina un usuario específico según el ID proporcionado en el parámetro GET.
Llama al método delete() de la clase User para eliminar el usuario de la base de datos. */
function doDelete()
{
	$id = $_GET['id'];

	$user = new User();
	$user->delete($id);

	message("¡Usuario ya eliminado!");
	redirect('../view/solicitarhora/index.php');

}
/*doupdateimage() se encarga de manejar la carga y actualización de imágenes para los usuarios.
Verifica si se cargó una imagen válida y la guarda en la carpeta photos/.
Actualiza el campo user_img del usuario en la base de datos con la ubicación de la nueva imagen. */
function doupdateimage()
{

	$errofile = $_FILES['photo']['error'];
	$type = $_FILES['photo']['type'];
	$temp = $_FILES['photo']['tmp_name'];
	$myfile = $_FILES['photo']['name'];
	$location = "photos/" . $myfile;


	if ($errofile > 0) {
		message("¡No hay Imagen seleccionada!", "error");
		redirect("../view/solicitarhora/index.php?view=view&id=" . $_GET['id']);
	} else {

		@$file = $_FILES['photo']['tmp_name'];
		@$image = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		@$image_name = addslashes($_FILES['photo']['name']);
		@$image_size = getimagesize($_FILES['photo']['tmp_name']);

		if ($image_size == FALSE) {
			message("¡El archivo subido no es una imagen!", "error");
			redirect("../view/solicitarhora/index.php?view=view&id=" . $_GET['id']);
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
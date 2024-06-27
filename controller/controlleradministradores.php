<?php
/*Incluye el archivo de inicialización (initialize.php) que probablemente contiene configuraciones y funciones necesarias. */
require_once("initialize.php");
/*Verifica si hay una sesión activa ($_SESSION['user_id']). Si no está establecida, redirige al usuario a la página de inicio de sesión. */
if (!isset($_SESSION['user_id'])) {
	redirect(web_root . "view/admin/administradores/index.php");
}
/*Obtiene el parámetro action de la URL (mediante GET). Este parámetro determina qué acción se realizará. */
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

/*Según el valor de action, llama a funciones específicas 
(doInsert(), doEdit(), doDelete(), doupdateimage()) para realizar las operaciones correspondientes. */
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
/*Función doInsert():
Inserta un nuevo usuario en la base de datos cuando se envía el formulario de agregar.
Verifica si los campos requeridos están completos.
Crea un objeto User, asigna valores desde el formulario, cifra la contraseña con SHA-1 y llama al método create() para insertar el nuevo usuario en la base de datos.
Función doEdit():
 */
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

			message("¡Nuevo usuario [" . $_POST['nombre'] . "] creado exitosamente!", "exito");
			redirect("../view/admin/administradores/index.php");

		}
	}

}
/*Actualiza la información de un usuario existente en la base de datos cuando se envía el formulario de edición.
Crea un objeto User, asigna valores desde el formulario, cifra la contraseña con SHA-1 y llama al método update() con el ID del usuario para actualizar los datos.
Función doDelete(): */
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
		redirect("../view/admin/administradores/index.php");
	}
}

/*Elimina un usuario de la base de datos según el ID proporcionado en la URL ($_GET['id']).
Crea un objeto User y llama al método delete() para realizar la eliminación.
Función doupdateimage(): */
function doDelete()
{
	$id = $_GET['id'];

	$user = new User();
	$user->delete($id);

	message("¡Usuario ya eliminado!");
	redirect('../view/admin/administradores/index.php');

}
/*Actualiza la imagen de perfil del usuario.
Verifica si se ha seleccionado un archivo de imagen válido.
Mueve el archivo de imagen a la ubicación especificada (photos/) y actualiza el campo user_img en la base de datos. */
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
			redirect("photos/");


		}
	}

}

?>
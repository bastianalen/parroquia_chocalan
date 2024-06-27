
<?php
/*Incluir el archivo de inicialización (initialize.php), que contiene configuraciones y funciones necesarias. */
require_once ("initialize.php");
/*Verifica si hay una sesión activa ($_SESSION['user_id']). 
Si no está establecida, redirige al usuario a la página de inicio de sesión. */
 	 if (!isset($_SESSION['user_id'])){
      redirect(web_root."view/admin/index.php");
     }

/*Obtiene el parámetro action de la URL (mediante GET). Este parámetro determina qué acción se realizará (añadir, editar, eliminar, etc.). */
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
/*Según el valor de action, llama a las funciones correspondientes 
(doInsert(), doEdit(), doDelete()) para realizar las operaciones relacionadas con los sectores. */
switch ($action) {
	case 'add' :
	doInsert();
	break;
	
	case 'edit' :
	doEdit();
	break;
	
	case 'delete' :
	doDelete();
	break;

 
	}
   /*Función doInsert():

	Inserta un nuevo sector en la base de datos cuando se envía el formulario de agregar.
	Verifica si el campo sector está completo.
	Crea un objeto Sector, asigna valores desde el formulario y llama al método create() para insertar el nuevo sector en la base de datos. */
	function doInsert(){
		if(isset($_POST['save'])){


		if ( $_POST['sector'] == "" ) {
			$messageStats = false;
			message("All field is required!","error");
			redirect('../view/admin/import/index.php?view=add');
		}else{	
			$sector = New Sector();
			$sector->sector	= $_POST['sector'];
			$sector->create();

			message("New Section created successfully!", "success");
			redirect("../view/admin/import/index.php");
			
		}
		}

	}
	/*Función doEdit():

	Actualiza la información de un sector existente en la base de datos cuando se envía el formulario de edición.
	Crea un objeto Sector, asigna valores desde el formulario y llama al método update() con el ID del sector para actualizar los datos. */
	function doEdit(){
		if(isset($_POST['save'])){

			$sector = New Sector();
			$sector->sector	= $_POST['sector'];
			$sector->update($_POST['id_sector']);

			message("Section has been updated!", "success");
			redirect("../view/admin/import/index.php");
		}

	}

	/*Función doDelete():

	Elimina un sector de la base de datos según el ID proporcionado en la URL ($_GET['id']).
	Crea un objeto Sector y llama al método delete() para realizar la eliminación. */
	function doDelete(){

			$id = $_GET['id'];

			$sector = New Sector();
			$sector->delete($id);

			message("Section already Deleted!","info");
			redirect('../view/admin/import/index.php');
		
	}
?>

<?php
require_once ("initialize.php");
if (!isset($_SESSION['user_id'])){
 redirect(web_root."view/admin/index.php");
}

/*Se utiliza para determinar la acción que se va a realizar, basada en el parámetro
 GET action. Si action está definido y no está vacío, se asigna a la variable $action;
  de lo contrario, se establece como una cadena vacía. */
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
/*En función del valor de $action, se llama a una de las funciones definidas (doInsert(), doEdit(), doDelete()). */
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
/*Esta función se ejecuta cuando se envía el formulario para agregar un nuevo sector ($_POST['save']).
Verifica si el campo sector no está vacío. Si está vacío, muestra un mensaje de error y redirige de vuelta al formulario.
Crea un nuevo objeto Sector, asigna el valor del campo sector, y llama al método create() para insertar el registro en la base de datos. */
function doInsert(){
	if(isset($_POST['save'])){
		
		if ( empty($_POST['sector']) ) {
			$messageStats = false;
			message("All field is required!","error");
			redirect('../view/admin/patios_cementerio/index.php?view=add');
		}else{	
			$sector = new Sector();
			echo "<script> console.log(' ". $_POST['sector'] ." ') </script>";
			$sector->sector	= $_POST['sector'];
			$sector->create();
			message("¡Nueva Sección creada exitosamente!", "success");
			redirect("../view/admin/patios_cementerio/index.php");
			
		}
	}
}
/*Esta función maneja la actualización de un registro de sector ($_POST['save']).
Crea un objeto Sector, asigna el valor del campo sector desde el formulario de edición, 
y llama al método update() con el ID del sector ($_POST['id_sector']) para actualizar el 
registro correspondiente en la base de datos. */
function doEdit(){
	if(isset($_POST['save'])){
		$sector = new Sector();
		$sector->sector	= $_POST['sector'];
		$sector->update($_POST['id_sector']);
		message("¡La sección ha sido actualizada!", "success");
		redirect("../view/admin/patios_cementerio/index.php");
	}
}
/*Esta función elimina un registro de sector ($_GET['id']).
Crea un objeto Sector y llama al método delete() con el ID del sector para eliminar el registro correspondiente en la base de datos.
Muestra un mensaje de éxito y redirige de vuelta a la página de índice de administración de sectores. */
function doDelete(){
		$id = $_GET['id'];
		$sector = new Sector();
		$sector->delete($id);
		message("¡Sección ya eliminada!","info");
		redirect('../view/admin/patios_cementerio/index.php');
	
}
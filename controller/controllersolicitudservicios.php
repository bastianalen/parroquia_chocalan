
<?php
require_once ("initialize.php");
if (!isset($_SESSION['user_id'])){
 redirect(web_root."view/admin/index.php");
}

/*Determina la acción solicitada a través del parámetro GET action.
Llama a la función correspondiente (doInsert(), doEdit(), doDelete()) basada en la acción especificada. */
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

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
/*Función doInsert() para Agregar Nuevas Solicitudes: */
/*Valida si se ha enviado el formulario ($_POST['save']).
Verifica que el campo solicitud no esté vacío.
Crea una nueva entrada de solicitud utilizando el modelo Solicitud y redirige según el resultado. */
function doInsert(){
	if(isset($_POST['save'])){
		
		if ( empty($_POST['solicitud']) ) {
			$messageStats = false;
			message("All field is required!","error");
			redirect('../view/admin/solicitud_servicio/index.php?view=add');
		}else{	
			$solicitud = new Solicitud();
			echo "<script> console.log(' ". $_POST['solicitud'] ." ') </script>";
			$solicitud->solicitud	= $_POST['solicitud'];
			$solicitud->create();
			message("¡Nueva Sección creada exitosamente!", "success");
			redirect("../view/admin/solicitud_servicio/index.php");
			
		}
	}
}

/*Verifica si se han recibido los parámetros id_solicitud y estado a través de GET.
Actualiza el estado de la solicitud en la base de datos utilizando el método update() del modelo Solicitud.
Muestra un mensaje de éxito dependiendo del estado actualizado y redirige a la página de administración de solicitudes. */
function doEdit() {
    if (isset($_GET['id_solicitud']) && isset($_GET['estado'])) {
        $id_solicitud = htmlspecialchars($_GET['id_solicitud']);
        $estado = htmlspecialchars($_GET['estado']);
        
        $solicitud = new Solicitud();
        $solicitud->estado = $estado;
        $solicitud->update($id_solicitud);
        
        if ($estado == 2) {
            message("¡La solicitud ha sido Aceptada!", "success");
		} elseif ($estado == 3) {
            message("¡La solicitud ha sido Rechazada!", "success");
		} else {
            message("¡Error al actualizar el estado de la solicitud!", "error");

		}
        redirect("../view/admin/solicitud_servicio/index.php");
		} else {
        message("Error al actualizar la solicitud.", "error");
        redirect("../view/admin/solicitud_servicio/index.php");
    }
}
/*Obtiene el id de la solicitud a eliminar a través de GET.
Utiliza el método delete() del modelo Solicitud para eliminar la solicitud de la base de datos.
Muestra un mensaje de información y redirige a la página de administración de solicitudes después de la eliminación. */
function doDelete(){
		$id = $_GET['id'];
		$solicitud = new Solicitud();
		$solicitud->delete($id);
		message("¡Sección ya eliminada!","info");
		redirect('../view/admin/solicitud_servicio/index.php');
	
}
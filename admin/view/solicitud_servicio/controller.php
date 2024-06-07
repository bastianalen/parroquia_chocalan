
<?php
require_once ("../../model/initialize.php");
if (!isset($_SESSION['user_id'])){
 redirect(web_root."admin/view/index.php");
}


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
   
function doInsert(){
	if(isset($_POST['save'])){
		
		if ( empty($_POST['solicitud']) ) {
			$messageStats = false;
			message("All field is required!","error");
			redirect('index.php?view=add');
		}else{	
			$solicitud = new Solicitud();
			echo "<script> console.log(' ". $_POST['solicitud'] ." ') </script>";
			$solicitud->solicitud	= $_POST['solicitud'];
			$solicitud->create();
			message("¡Nueva Sección creada exitosamente!", "success");
			redirect("index.php");
			
		}
	}
}

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
        redirect("index.php");
		} else {
        message("Error al actualizar la solicitud.", "error");
        redirect("index.php");
    }
}

function doDelete(){
		$id = $_GET['id'];
		$solicitud = new Solicitud();
		$solicitud->delete($id);
		message("¡Sección ya eliminada!","info");
		redirect('index.php');
	
}
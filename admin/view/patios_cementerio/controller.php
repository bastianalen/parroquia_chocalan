
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
		
		if ( empty($_POST['sector']) ) {
			$messageStats = false;
			message("All field is required!","error");
			redirect('index.php?view=add');
		}else{	
			$sector = new Sector();
			echo "<script> console.log(' ". $_POST['sector'] ." ') </script>";
			$sector->sector	= $_POST['sector'];
			$sector->create();
			message("¡Nueva Sección creada exitosamente!", "success");
			redirect("index.php");
			
		}
	}
}

function doEdit(){
	if(isset($_POST['save'])){
		$sector = new Sector();
		$sector->sector	= $_POST['sector'];
		$sector->update($_POST['id_sector']);
		message("¡La sección ha sido actualizada!", "success");
		redirect("index.php");
	}
}

function doDelete(){
		$id = $_GET['id'];
		$sector = new Sector();
		$sector->delete($id);
		message("¡Sección ya eliminada!","info");
		redirect('index.php');
	
}
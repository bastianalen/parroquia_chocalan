
<?php
require_once ("initialize.php");
 	 if (!isset($_SESSION['user_id'])){
      redirect(web_root."view/admin/index.php");
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

	function doEdit(){
		if(isset($_POST['save'])){

			$sector = New Sector();
			$sector->sector	= $_POST['sector'];
			$sector->update($_POST['id_sector']);

			message("Section has been updated!", "success");
			redirect("../view/admin/import/index.php");
		}

	}


	function doDelete(){

			$id = $_GET['id'];

			$sector = New Sector();
			$sector->delete($id);

			message("Section already Deleted!","info");
			redirect('../view/admin/import/index.php');
		
	}
?>
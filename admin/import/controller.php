
<?php
require_once ("../model/initialize.php");
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


		if ( $_POST['sector'] == "" ) {
			$messageStats = false;
			message("All field is required!","error");
			redirect('index.php?view=add');
		}else{	
			$sector = New Sector();
			$sector->sector	= $_POST['sector'];
			$sector->create();

			message("New Section created successfully!", "success");
			redirect("index.php");
			
		}
		}

	}

	function doEdit(){
		if(isset($_POST['save'])){

			$sector = New Sector();
			$sector->sector	= $_POST['sector'];
			$sector->update($_POST['id_sector']);

			message("Section has been updated!", "success");
			redirect("index.php");
		}

	}


	function doDelete(){
		// if (isset($_POST['selector'])==''){
		// message("Select a records first before you delete!","error");
		// redirect('index.php');
		// }else{

			$id = $_GET['id'];

			$sector = New Sector();
			$sector->delete($id);

			message("Section already Deleted!","info");
			redirect('index.php');

		// $id = $_POST['selector'];
		// $key = count($id);

		// for($i=0;$i<$key;$i++){

		// 	$sector = New Sector();
		// 	$sector->delete($id[$i]);

		// 	message("Sector already Deleted!","info");
		// 	redirect('index.php');
		// }
		// }
		
	}
?>
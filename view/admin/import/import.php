<?php
require_once("../../../controller/initialize.php");
	 if (!isset($_SESSION['user_id'])){
      redirect(web_root."view/admin/login.php");
     } 
if(isset($_POST["Import"])){
		
global $mydb;

$filename=$_FILES["file"]["tmp_name"];
		

	if($_FILES["file"]["size"] > 0){

		$file = fopen($filename, "r");
		while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE){         	
			$sql = "INSERT into tblpersonas (`nro_tumba`, `nombre`, `fecha_nacimiento`, `fecha_nacimiento`,`id_sector`,``) values('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]')";
			//we are using mysql_query function. it returns a resource on true else False on error
			$mydb->setQuery($sql);
			$cur = $mydb->executeQuery();

			if(! $cur ) {
				echo "<script type=\"text/javascript\">alert(\"Invalid File:Please Upload CSV File.\");
				window.location = \"index.php\"
				</script>";
			}

		}
		fclose($file);
		//throws a message if data successfully imported to mysql database from excel file
		echo "<script type=\"text/javascript\">alert(\"CSV File has been successfully Imported.\");
		window.location = \"index.php\"
		</script>";		 
		
		//close of connection
		mysql_close($conn); 
					
				
				
	}
}	 
?>	
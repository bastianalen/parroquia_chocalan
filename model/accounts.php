<?php
require_once(__DIR__ ."/../controller/initialize.php");
require_once(LIB_PATH_MODEL.DS.'databaseuser.php');
class User {
	protected static  $tblname = "tblcuentauser";
	protected static  $innertbl = " tcu INNER JOIN tblroluser tru ON tcu.id_rol = tru.id_rol ";
	
	function dbfields () {
		global $mydb_user;
		return $mydb_user->getfieldsononetable(self::$tblname);
	}
	function listofuser(){
		global $mydb_user;
		$mydb_user->setQuery("SELECT * FROM ".self::$tblname.self::$innertbl);
		$cur = $mydb_user->executeQuery();

		if (!$cur) {
			// Manejo de errores
			error_log("Error executing query: " . $mydb_user->error);
			return false;
		}

		$result = [];
		while ($row = $cur->fetch_assoc()) {
			$result[] = $row;
		}

		return $result;
	}
 
	function find_user($id="",$user_name=""){
		global $mydb_user;
		$mydb_user->setQuery("SELECT * FROM ".self::$tblname.self::$innertbl." 
			WHERE user_id = {$id} OR user_nom = '{$user_name}'");
		$cur = $mydb_user->executeQuery();
		$row_count = $mydb_user->num_rows($cur);
		return $row_count;
	}
	static function userAuthentication($user_nom,$user_contra){
		global $mydb_user;
		$mydb_user->setQuery("SELECT * FROM tblcuentauser WHERE user_nom = '". $user_nom ."' and user_contra = '". $user_contra ."'");
		$cur = $mydb_user->executeQuery();
		if($cur==false){
			die(mysql_error());
		}
		$row_count = $mydb_user->num_rows($cur);//get the number of count
		 if ($row_count == 1){
		 $user_found = $mydb_user->loadSingleResult();
		 	$_SESSION['user_id']   		= $user_found->user_id;
		 	$_SESSION['nombre']      	= $user_found->nombre;
		 	$_SESSION['user_nom'] 	= $user_found->user_nom;
		 	$_SESSION['user_contra'] 		= $user_found->user_contra;
		 	$_SESSION['id_rol'] 		= $user_found->id_rol;
		   return true;
		 }else{
		 	return false;
		 }
	}
	function single_user($id=""){
			global $mydb_user;
			$mydb_user->setQuery("SELECT * FROM ".self::$tblname." 
				Where user_id= '{$id}' LIMIT 1");
			$cur = $mydb_user->loadSingleResult();
			return $cur;
	}

	function single_user_rol($id_rol=""){
		global $mydb_user;
		$mydb_user->setQuery("SELECT * FROM ".self::$tblname." 
			Where id_rol= '{$id_rol}' LIMIT 1");
		$cur = $mydb_user->loadSingleResult();
		return $cur;
	}
	/*---Instantiation of Object dynamically---*/
	static function instantiate($record) {
		$object = new self;

		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		} 
		return $object;
	}
	
	
	/*--Cleaning the raw data before submitting to Database--*/
	private function has_attribute($attribute) {
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
		// return an array of attribute names and their values
	  global $mydb_user;
	  $attributes = array();
	  foreach($this->dbfields() as $field) {
	    if(property_exists($this, $field)) {
			$attributes[$field] = $this->$field;
		}
	  }
	  return $attributes;
	}
	
	protected function sanitized_attributes() {
	  global $mydb_user;
	  $clean_attributes = array();
	  // sanitize the values before submitting
	  // Note: does not alter the actual value of each attribute
	  foreach($this->attributes() as $key => $value){
	    $clean_attributes[$key] = $mydb_user->escape_value($value);
	  }
	  return $clean_attributes;
	}
	
	
	/*--Create,Update and Delete methods--*/
	public function save() {
	  // A new record won't have an id yet.
	  return isset($this->id) ? $this->update() : $this->create();
	}
	
	public function create() {
		global $mydb_user;
		// Don't forget your SQL syntax and good habits:
		// - INSERT INTO table (key, key) VALUES ('value', 'value')
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$attributes = $this->sanitized_attributes();
		$sql = "INSERT INTO ".self::$tblname." (";
		$sql .= join(", ", array_keys($attributes));
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
	echo $mydb_user->setQuery($sql);
	
	 if($mydb_user->executeQuery()) {
	    $this->id = $mydb_user->insert_id();
	    return true;
	  } else {
	    return false;
	  }
	}

	public function update($id=0) {
	  global $mydb_user;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$tblname." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE user_id=". $id;
	  $mydb_user->setQuery($sql);
	 	if(!$mydb_user->executeQuery()) return false; 	
		
	}

	public function delete($id=0) {
		global $mydb_user;
		  $sql = "DELETE FROM ".self::$tblname;
		  $sql .= " WHERE user_id=". $id;
		  $sql .= " LIMIT 1 ";
		  $mydb_user->setQuery($sql);
		  
			if(!$mydb_user->executeQuery()) return false; 	
	
	}	


}
?>
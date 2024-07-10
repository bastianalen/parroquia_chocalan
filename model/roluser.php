<?php
require_once(__DIR__ ."/../controller/initialize.php");
require_once(LIB_PATH_MODEL.DS.'databaseuser.php');

class RolUser {

	protected static  $tblname = "tblroluser";

	function dbfields () {
		global $mydb_user;
		return $mydb_user->getfieldsononetable(self::$tblname);

	}
	function listofroluser(){
		global $mydb_user;
		$mydb_user->setQuery("SELECT * FROM ".self::$tblname);
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
	function find_tumba($id="",$name=""){
		global $mydb_user;
		$mydb_user->setQuery("SELECT * FROM ".self::$tblname." WHERE id_rol = {$id} OR rol_nom = '{$name}'");
		$cur = $mydb_user->executeQuery();
		$row_count = $mydb_user->num_rows($cur);
		return $row_count;
	}
	 
	function single_tumba($id=""){
		global $mydb_user;
		$mydb_user->setQuery("SELECT * FROM ".self::$tblname." where id_rol = {$id} LIMIT 1");
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
		$sql .= " WHERE id_rol =". $id;
	  $mydb_user->setQuery($sql);
	 	if(!$mydb_user->executeQuery()) return false; 	
		
	}

	public function delete($id=0) {
		global $mydb_user;
		  $sql = "DELETE FROM ".self::$tblname;
		  $sql .= " WHERE id_rol =". $id;
		  $sql .= " LIMIT 1 ";
		  $mydb_user->setQuery($sql);
		  
			if(!$mydb_user->executeQuery()) return false; 	
	
	}	


}
<?php
require_once(__DIR__ ."/../controller/initialize.php");
require_once(LIB_PATH_MODEL.DS.'database.php');
class Persona {
	protected static  $tblname = "tblpersonas";
	protected static  $innertbl = " tper 
									INNER JOIN tblsector tsec ON tper.id_sector = tsec.id_sector 
									INNER JOIN tbltipotumba ttptum ON tper.tipo_tumba = ttptum.id_tipo_tumba ";

	function dbfields () {
		global $mydb;
		return $mydb->getfieldsononetable(self::$tblname);

	}
	function listofpeople(){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname.self::$innertbl);
		$cur = $mydb->executeQuery();

		if (!$cur) {
			// Manejo de errores
			error_log("Error executing query: " . $mydb->error);
			return false;
		}

		$result = [];
		while ($row = $cur->fetch_assoc()) {
			$result[] = $row;
		}

		return $result;
	}
	function find_people($id="",$name=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." 
			WHERE rut = {$id} OR pnombre = '{$name}'");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);
		return $row_count;
	}
	function find_propietario($id="",$name=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." 
			WHERE rut = {$id} OR propietario = '{$name}'");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);
		return $row_count;
	}
	function find_persona_sector($id_sector=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." 
			WHERE id_sector = {$id_sector} ");

		$cur = $mydb->executeQuery();
		
		if (!$cur) {
			// Manejo de errores
			error_log("Error executing query: " . $mydb->error_msg);
			return false;
		}

		$result = [];
		while ($row = $cur->fetch_assoc()) {
			$result[] = $row;
		}

		return $result;
	}

	function find_persona_tumba($nro_tumba=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." 
			WHERE nro_tumba = {$nro_tumba} ");

		$cur = $mydb->executeQuery();
		
		if (!$cur) {
			// Manejo de errores
			error_log("Error executing query: " . $mydb->error_msg);
			return false;
		}

		$result = [];
		while ($row = $cur->fetch_assoc()) {
			$result[] = $row;
		}

		return $result;
	}

	function find_persona_tumba_sector($nro_tumba="",$id_sector=0){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." 
			WHERE nro_tumba = {$nro_tumba} and id_sector = {$id_sector}");

		$cur = $mydb->executeQuery();
		
		if (!$cur) {
			// Manejo de errores
			error_log("Error executing query: " . $mydb->error_msg);
			return false;
		}

		$result = [];
		while ($row = $cur->fetch_assoc()) {
			$result[] = $row;
		}

		return $result;
	}
 
	function find_all_people($name=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." 
			WHERE pnombre = '{$name}'");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);
		return $row_count;
	}
	 
	
	 
	function single_people($id=""){
			global $mydb;
			$mydb->setQuery("SELECT * FROM ".self::$tblname." 
				Where rut = {$id} LIMIT 1");
			$cur = $mydb->loadSingleResult();
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
	  global $mydb;
	  $attributes = array();
	  foreach($this->dbfields() as $field) {
	    if(property_exists($this, $field)) {
			$attributes[$field] = $this->$field;
		}
	  }
	  return $attributes;
	}
	
	protected function sanitized_attributes() {
	  global $mydb;
	  $clean_attributes = array();
	  // sanitize the values before submitting
	  // Note: does not alter the actual value of each attribute
	  foreach($this->attributes() as $key => $value){
	    $clean_attributes[$key] = $mydb->escape_value($value);
	  }
	  return $clean_attributes;
	}
	
	
	/*--Create,Update and Delete methods--*/
	public function save() {
	  // A new record won't have an id yet.
	  return isset($this->id) ? $this->update() : $this->create();
	}
	
	public function create() {
		global $mydb;
		$attributes = $this->sanitized_attributes();
		$sql = "INSERT INTO ".self::$tblname." (";
		$sql .= join(", ", array_keys($attributes));
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
	echo $mydb->setQuery($sql);
	
	 if($mydb->executeQuery()) {
	    $this->id = $mydb->insert_id();
	    return true;
	  } else {
	    return false;
	  }
	}

	public function update($id=0) {
	  global $mydb;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$tblname." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE rut=". $id;
	  $mydb->setQuery($sql);
	 	if(!$mydb->executeQuery()) return false; 	
		
	}

	public function delete($id=0) {
		global $mydb;
		  $sql = "DELETE FROM ".self::$tblname;
		  $sql .= " WHERE rut=". $id;
		  $sql .= " LIMIT 1 ";
		  $mydb->setQuery($sql);
		  
			if(!$mydb->executeQuery()) return false; 	
	
	}	


}
?>
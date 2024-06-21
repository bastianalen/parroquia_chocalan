<?php
// Llama al controlador inizializador
require_once(__DIR__ ."/../controller/initialize.php");
// Llama a la conexion de la base de datos
require_once(LIB_PATH_MODEL.DS.'database.php');

// Crea la clase Eventos
class Eventos {

	// Almacena el nombre de la tabla
	protected static  $tblname = "tblcaleneucaristia";

	// Almacena las relaciones que posee la tabla principal "tblcaleneucaristia"
	protected static  $innertbl = " tce INNER JOIN tbltiposervicio tts ON tce.tipo_Servicio = tts.id_servicio 
									INNER JOIN tbltipocalendario ttc ON tce.tipo_calendario = ttc.id_tipo";

	// 
	function dbfields () {
		global $mydb;
		return $mydb->getfieldsononetable(self::$tblname);

	}

	// funcion que obtiene todos los datos en de la tabla
	function list_of_eventos(){
		// Conecta la base de datos
		global $mydb;
		// Almacena la consulta de la funcion
		$mydb->setQuery("SELECT * FROM " . self::$tblname);
		// Almacena los resultados de la consulta
		$cur = $mydb->executeQuery();

		// Valida que se obtengan datos
		if (!$cur) {
			// Manejo de errores
			error_log("Error executing query: " . $mydb->error);
			return false;
		}

		// Crea una variable que almacenará en arreglo los datos
		$result = [];
		// Recorre la variable $cur y almacena los datos en la varible tipo array creada
		while ($row = $cur->fetch_assoc()) {
			$result[] = $row;
		}

		// Devuelve los datos obtenidos
		return $result;
	}

	function list_of_eventos_tipo($tipo_calendario=""){
		// Conecta la base de datos
		global $mydb;
		// Almacena la consulta de la funcion
		$mydb->setQuery("SELECT * FROM " . self::$tblname. self::$innertbl." WHERE tce.tipo_calendario = {$tipo_calendario}");
		// Almacena los resultados de la consulta
		$cur = $mydb->executeQuery();

		// Valida que se obtengan datos
		if (!$cur) {
			// Manejo de errores
			error_log("Error executing query: " . $mydb->error);
			return false;
		}

		// Crea una variable que almacenará en arreglo los datos
		$result = [];
		// Recorre la variable $cur y almacena los datos en la varible tipo array creada
		while ($row = $cur->fetch_assoc()) {
			$result[] = $row;
		}

		// Devuelve los datos obtenidos
		return $result;
	}
	
	function find_eventos($id="",$name=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname. self::$innertbl." WHERE id = {$id} OR titulo = '{$name}'");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);
		return $row_count;
	}
	 
	function single_eventos($id=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname. self::$innertbl." where id = {$id} LIMIT 1");
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
	
	protected function sanitized_attributes($data) {
	  global $mydb;
	  $clean_attributes = array();
	  foreach($data as $key => $value){
	    $clean_attributes[$key] = $mydb->escape_value($value);
	  }
	  return $clean_attributes;
	}
	
	
	/*--Create,Update and Delete methods--*/
	public function save() {
	  // A new record won't have an id yet.
	  return isset($this->id) ? $this->update() : $this->create();
	}
	
	public function create($data) {
		global $mydb;
		$attributes = $this->sanitized_attributes($data);
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

	public function update($data,$id=0) {
	  global $mydb;
		$attributes = $this->sanitized_attributes($data);
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$tblname." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE id =". $id;
        echo $mydb->setQuery($sql);
    	
    	if($mydb->executeQuery()) {
    	    return true;
    	} else {
    	    return false;
    	} 	
		
	}

	public function delete($id=0) {
		global $mydb;
		$sql = "DELETE FROM ".self::$tblname;
		$sql .= " WHERE id =". $id;
		$sql .= " LIMIT 1 ";
		echo $mydb->setQuery($sql);
	
	 if($mydb->executeQuery()) {
	    return true;
	  } else {
	    return false;
	  } 	
	
	}	
	
	
}
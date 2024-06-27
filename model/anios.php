<?php
/*Se incluyen archivos necesarios (initialize.php y database.php) para la inicialización y configuración de la aplicación. */
require_once(__DIR__ ."/../controller/initialize.php");
require_once(LIB_PATH_MODEL.DS.'database.php');

/*La clase Anio se define con la propiedad estática $tblname que especifica el nombre de la tabla de la base de datos que esta clase manejará (tblanios). */
class Anio {

	protected static  $tblname = "tblanios";
	
/*Este método utiliza una instancia global de base de datos ($mydb) para obtener los nombres de los campos de la tabla especificada en self::$tblname (tblanios en este caso). */
	function dbfields () {
		global $mydb;
		return $mydb->getfieldsononetable(self::$tblname);

	}
	/*list_of_anio ejecuta una consulta SQL para seleccionar todos los registros de la tabla tblanios.
	Utiliza métodos de la instancia de base de datos ($mydb) para establecer la consulta y ejecutarla.
	Retorna un arreglo de resultados si la consulta es exitosa, o false si hay un error. */
	function list_of_anio(){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname);
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
	/*find_anio busca registros en tblanios basados en el ID del año (id_anio) o el año (anio) proporcionado.
	Retorna el número de filas encontradas que coinciden con los criterios de búsqueda. */
	function find_anio($id="",$anio=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." WHERE id_anio = {$id} OR anio = '{$anio}'");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);
		return $row_count;
	}
	 /*single_anio obtiene un solo registro de tblanios basado en el ID del año proporcionado.
	Retorna una única fila como resultado si se encuentra, o null si no hay coincidencias. */
	function single_anio($id=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." where id_anio = {$id} LIMIT 1");
		$cur = $mydb->loadSingleResult();
		return $cur;
	}
	
	/* instantiate es un método estático que instancia un objeto Anio (self).
	Toma un arreglo ($record) y establece sus atributos como propiedades del objeto si existen y son accesibles.
	Métodos attributes, sanitized_attributes y has_attribute
	Estos métodos son utilizados internamente para manejar los 
	atributos del objeto Anio y para asegurar que los datos estén
	limpios y listos para ser insertados o actualizados en la base de datos.*/
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
	/*save decide si llamar a create o update dependiendo 
	de si el objeto Anio ya tiene un ID ($this->id).
	create construye y ejecuta una consulta SQL para insertar 
	un nuevo registro en la tabla tblanios 
	con los atributos del objeto Anio. */
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
	/*update actualiza un registro existente en tblanios con los atributos modificados del objeto Anio.
	delete elimina un registro específico de tblanios basado en el ID del año proporcionado.
	Resumen
	Este código PHP implementa una clase Anio que facilita 
	la manipulación de datos en la tabla tblanios de una base de datos. 
	Proporciona métodos para consultar, crear, actualizar y eliminar registros, además
	de métodos internos para manejar atributos y limpiar
	datos antes de enviar consultas SQL a la base de datos. */
	public function update($id=0) {
	  global $mydb;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$tblname." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE id_anio =". $id;
	  $mydb->setQuery($sql);
	 	if(!$mydb->executeQuery()) return false; 	
		
	}

	public function delete($id=0) {
		global $mydb;
		  $sql = "DELETE FROM ".self::$tblname;
		  $sql .= " WHERE id_anio =". $id;
		  $sql .= " LIMIT 1 ";
		  $mydb->setQuery($sql);
		  
			if(!$mydb->executeQuery()) return false; 	
	
	}	


}
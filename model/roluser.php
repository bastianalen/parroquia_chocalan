<?php
require_once(__DIR__ ."/../controller/initialize.php");
require_once(LIB_PATH_MODEL.DS.'database.php');

class RolUser {

	protected static  $tblname = "tblroluser"; // Nombre de la tabla en la base de datos
	// Retorna los nombres de los campos de la tabla
	function dbfields () {
		global $mydb;
		return $mydb->getfieldsononetable(self::$tblname);
	}
	// Obtiene la lista completa de registros de la tabla
	function listofroluser(){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname); // Consulta SQL para seleccionar todos los registros
		$cur = $mydb->executeQuery(); // Ejecuta la consulta
		if (!$cur) {
			// Manejo de errores si la consulta falla
			error_log("Error executing query: " . $mydb->error);
			return false;
		}

		$result = [];
		while ($row = $cur->fetch_assoc()) {
			$result[] = $row; // Almacena cada fila en el arreglo de resultados
		}
		return $result; // Retorna el arreglo de resultados
	}
	// Busca un registro por ID o nombre
	function find_tumba($id="", $name=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." WHERE id_rol = {$id} OR rol_nom = '{$name}'"); // Consulta SQL con condiciones
		$cur = $mydb->executeQuery(); // Ejecuta la consulta
		$row_count = $mydb->num_rows($cur); // Obtiene el número de filas encontradas
		return $row_count; // Retorna la cantidad de filas encontradas
	}
	// Obtiene un solo registro por ID
	function single_tumba($id=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." where id_rol = {$id} LIMIT 1"); // Consulta SQL para obtener un solo registro
		$cur = $mydb->loadSingleResult(); // Carga el resultado de la consulta como un solo objeto
		return $cur; // Retorna el objeto resultado
	}
	/*---Instanciación del objeto dinámicamente---*/
	static function instantiate($record) {
		$object = new self; // Crea una nueva instancia del objeto actual (self)

		foreach($record as $attribute => $value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value; // Asigna los valores del registro al objeto
		  }
		} 
		return $object; // Retorna el objeto instanciado
	}
	/*--Limpiando los datos antes de enviarlos a la base de datos--*/
	private function has_attribute($attribute) {
	  // Verifica si el atributo existe en el objeto
	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
	  global $mydb;
	  $attributes = array();
	  foreach($this->dbfields() as $field) {
	    if(property_exists($this, $field)) {
			$attributes[$field] = $this->$field; // Obtiene los valores de los atributos del objeto
		}
	  }
	  return $attributes; // Retorna los atributos del objeto
	}
	
	protected function sanitized_attributes() {
	  global $mydb;
	  $clean_attributes = array();
	  // Limpia los valores antes de enviarlos a la base de datos
	  foreach($this->attributes() as $key => $value){
	    $clean_attributes[$key] = $mydb->escape_value($value); // Escapa los valores para prevenir inyección SQL
	  }
	  return $clean_attributes; // Retorna los atributos limpios
	}
	
	/*--Métodos para Crear, Actualizar y Eliminar--*/
	public function save() {
	  // Si el registro ya tiene un ID, actualiza; de lo contrario, crea uno nuevo
	  return isset($this->id) ? $this->update() : $this->create();
	}
	
	public function create() {
		global $mydb;
		$attributes = $this->sanitized_attributes();
		$sql = "INSERT INTO ".self::$tblname." ("; // Consulta SQL para insertar un nuevo registro
		$sql .= join(", ", array_keys($attributes)); // Concatena los nombres de los campos
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes)); // Concatena los valores de los campos
		$sql .= "')"; // Cierra la consulta SQL

		echo $mydb->setQuery($sql); // Establece la consulta SQL en la instancia de $mydb

	  if($mydb->executeQuery()) {
	    $this->id = $mydb->insert_id(); // Obtiene el ID del registro insertado
	    return true; // Retorna verdadero si la inserción fue exitosa
	  } else {
	    return false; // Retorna falso si la inserción falló
	  }
	}

	public function update($id=0) {
	  global $mydb;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'"; // Construye los pares clave=valor para la actualización
		}
		$sql = "UPDATE ".self::$tblname." SET ";
		$sql .= join(", ", $attribute_pairs); // Concatena los pares clave=valor separados por comas
		$sql .= " WHERE id_rol =". $id; // Establece la condición WHERE para la actualización
	  $mydb->setQuery($sql); // Establece la consulta SQL en la instancia de $mydb

	 	if(!$mydb->executeQuery()) return false; // Ejecuta la consulta y retorna falso si falla la ejecución	
	}

	public function delete($id=0) {
		global $mydb;
		  $sql = "DELETE FROM ".self::$tblname; // Consulta SQL para eliminar registros
		  $sql .= " WHERE id_rol =". $id; // Establece la condición WHERE para eliminar el registro con el ID dado
		  $sql .= " LIMIT 1 "; // Limita la eliminación a un solo registro
		  $mydb->setQuery($sql); // Establece la consulta SQL en la instancia de $mydb
		  
			if(!$mydb->executeQuery()) return false; // Ejecuta la consulta y retorna falso si falla la ejecución	
	}	
}

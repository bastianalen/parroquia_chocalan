<?php
require_once(__DIR__ ."/../controller/initialize.php");
require_once(LIB_PATH_MODEL.DS.'database.php');
class Persona {
	protected static  $tblname = "tblpersonas"; // Nombre de la tabla en la base de datos
	protected static  $innertbl = " tper 
									INNER JOIN tblsector tsec ON tper.id_sector = tsec.id_sector 
									INNER JOIN tbltipotumba ttptum ON tper.tipo_tumba = ttptum.id_tipo_tumba "; // Tablas y joins adicionales para consultas complejas

	// Retorna los nombres de los campos de la tabla
	function dbfields () {
		global $mydb;
		return $mydb->getfieldsononetable(self::$tblname);

	}

	// Obtiene la lista completa de personas con detalles de sectores y tipos de tumba
	function listofpeople(){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname.self::$innertbl); // Consulta SQL para seleccionar todos los registros con joins
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

	// Busca personas por rut o nombre
	function find_people($id="",$name=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." 
			WHERE rut = {$id} OR pnombre = '{$name}'"); // Consulta SQL con condiciones de búsqueda
		$cur = $mydb->executeQuery(); // Ejecuta la consulta
		$row_count = $mydb->num_rows($cur); // Obtiene el número de filas encontradas
		return $row_count; // Retorna la cantidad de filas encontradas
	}

	// Busca personas por ID o nombre
	function find_people_id($id="",$name=""){
		global $mydb;
		$sql= "SELECT * FROM ".self::$tblname." 
		WHERE 1=1";
		if ($id !== "") {
			$sql .= " AND id_persona = '{$id}'"; // Agrega condición si se proporciona ID
		}
		if ($name !== "") {
			$sql .= " AND pnombre = '{$name}'"; // Agrega condición si se proporciona nombre
		}
		$mydb->setQuery($sql); // Establece la consulta SQL en la instancia de $mydb
		$cur = $mydb->executeQuery(); // Ejecuta la consulta
		$results= [];
		while ($row = $cur->fetch_assoc()) {
			$results[] = $row; // Almacena cada fila en el arreglo de resultados
		}
		return $results; // Retorna el arreglo de resultados
	}

	// Busca personas por rut o propietario
	function find_propietario($id="",$name=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." 
			WHERE rut = {$id} OR propietario = '{$name}'"); // Consulta SQL con condiciones de búsqueda
		$cur = $mydb->executeQuery(); // Ejecuta la consulta
		$row_count = $mydb->num_rows($cur); // Obtiene el número de filas encontradas
		return $row_count; // Retorna la cantidad de filas encontradas
	}

	// Busca personas por ID de sector
	function find_persona_sector($id_sector=""){
		global $mydb;
		$sql = "SELECT * FROM ".self::$tblname.self::$innertbl." 
			WHERE 1=1";
		if ($id_sector != 0) {
            $sql.= " AND tper.id_sector = {$id_sector} "; // Agrega condición si se proporciona ID de sector
        }

		$mydb->setQuery($sql); // Establece la consulta SQL en la instancia de $mydb
		$cur = $mydb->executeQuery(); // Ejecuta la consulta
		if (!$cur) {
			// Manejo de errores si la consulta falla
			error_log("Error executing query: " . $mydb->error_msg);
			return false;
		}

		$result = [];
		while ($row = $cur->fetch_assoc()) {
			$result[] = $row; // Almacena cada fila en el arreglo de resultados
		}

		return $result; // Retorna el arreglo de resultados
	}

	// Busca personas por número de tumba
	function find_persona_tumba($nro_tumba=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname.self::$innertbl." 
			WHERE tper.nro_tumba = {$nro_tumba} "); // Consulta SQL con condición de número de tumba

		$cur = $mydb->executeQuery(); // Ejecuta la consulta
		
		if (!$cur) {
			// Manejo de errores si la consulta falla
			error_log("Error executing query: " . $mydb->error_msg);
			return false;
		}

		$result = [];
		while ($row = $cur->fetch_assoc()) {
			$result[] = $row; // Almacena cada fila en el arreglo de resultados
		}

		return $result; // Retorna el arreglo de resultados
	}

	// Busca personas por número de tumba y ID de sector
	function find_persona_tumba_sector($nro_tumba="",$id_sector=0){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname.self::$innertbl." 
			WHERE tper.nro_tumba = {$nro_tumba} and tper.id_sector = {$id_sector}"); // Consulta SQL con condiciones de número de tumba y ID de sector

		$cur = $mydb->executeQuery(); // Ejecuta la consulta
		
		if (!$cur) {
			// Manejo de errores si la consulta falla
			error_log("Error executing query: " . $mydb->error_msg);
			return false;
		}

		$result = [];
		while ($row = $cur->fetch_assoc()) {
			$result[] = $row; // Almacena cada fila en el arreglo de resultados
		}

		return $result; // Retorna el arreglo de resultados
	}
 
	// Busca todas las personas por nombre
	function find_all_people($name=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." 
			WHERE pnombre = '{$name}'"); // Consulta SQL con condición de nombre
		$cur = $mydb->executeQuery(); // Ejecuta la consulta
		$row_count = $mydb->num_rows($cur); // Obtiene el número de filas encontradas
		return $row_count; // Retorna la cantidad de filas encontradas
	}
	 
	// Obtiene un solo registro de persona por rut
	function single_people($id=""){
			global $mydb;
			$mydb->setQuery("SELECT * FROM ".self::$tblname." 
				Where rut = {$id} LIMIT 1"); // Consulta SQL para obtener un solo registro por rut
			$cur = $mydb->loadSingleResult(); // Carga el resultado de la consulta como un solo objeto
			return $cur; // Retorna el objeto resultado
	}

	// Obtiene un solo registro de persona por ID
	function single_people_id($id=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." 
			Where id_persona = {$id} LIMIT 1"); // Consulta SQL para obtener un solo registro por ID de persona
		$cur = $mydb->loadSingleResult(); // Carga el resultado de la consulta como un solo objeto
		return $cur; // Retorna el objeto resultado
	}

	/*---Instanciación del objeto dinámicamente---*/
	static function instantiate($record) {
		$object = new self; // Crea una nueva instancia del objeto actual (self)

		foreach($record as $attribute=>$value){
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
	  return $attributes; //
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
			$sql .= " WHERE id_persona=". $id;
			$sql .= " LIMIT 1 ";
			$mydb->setQuery($sql);
			
			  if(!$mydb->executeQuery()) return false; 	
	  
	  }	
  
  
  }
  ?>
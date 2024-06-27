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
	/*Este código PHP define una clase que maneja operaciones CRUD 
	(Crear, Leer, Actualizar, Eliminar) para una entidad llamada eventos 
	en una base de datos. Aquí está el análisis detallado de la clase y sus métodos: */
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
	/*find_eventos busca eventos en la base de datos 
	basados en el ID del evento ($id) o el título ($name)
	proporcionado como parámetro. Retorna el número de filas
	encontradas que coinciden con los criterios de búsqueda. */
	function find_eventos($id="",$name=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname. self::$innertbl." WHERE id = {$id} OR titulo = '{$name}'");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);
		return $row_count;
	}
	 /*single_eventos obtiene un solo evento de la base 
	 de datos basado en el ID del evento proporcionado. 
	 Retorna un solo registro como resultado si se 
	 encuentra, o null si no hay coincidencias. */
	function single_eventos($id=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname. self::$innertbl." where id = {$id} LIMIT 1");
		$cur = $mydb->loadSingleResult();
		return $cur;
	}
	
	/* instantiate es un método estático que instancia 
	un objeto eventos (self) a partir de un registro de datos 
	($record). Itera sobre los atributos del registro y los asigna 
	como propiedades del objeto si existen y son accesibles.
	Métodos attributes, sanitized_attributes y has_attribute
	Estos métodos son utilizados internamente para manejar los 
	atributos del objeto eventos y para asegurar que los datos
	estén limpios y listos para ser insertados o actualizados 
	en la base de datos.*/
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
		global $mydb; // Accede a la instancia global de la base de datos
		$attributes = $this->sanitized_attributes($data); // Obtiene los atributos sanitizados a partir de los datos proporcionados
		$sql = "INSERT INTO ".self::$tblname." ("; // Construye la consulta SQL para la inserción
		$sql .= join(", ", array_keys($attributes)); // Agrega los nombres de los campos a la consulta SQL
		$sql .= ") VALUES ('"; // Continúa construyendo la consulta SQL
		$sql .= join("', '", array_values($attributes)); // Agrega los valores de los campos a la consulta SQL
		$sql .= "')"; // Finaliza la consulta SQL
		echo $mydb->setQuery($sql); // Establece la consulta SQL en la instancia de la base de datos
		
		if($mydb->executeQuery()) { // Ejecuta la consulta SQL y verifica si fue exitosa
			$this->id = $mydb->insert_id(); // Obtiene el ID generado por la inserción y lo asigna a la instancia actual
			return true; // Retorna verdadero si la inserción fue exitosa
		} else {
			return false; // Retorna falso si la inserción falló
		}
	}
	
	public function update($data, $id=0) {
		global $mydb; // Accede a la instancia global de la base de datos
		$attributes = $this->sanitized_attributes($data); // Obtiene los atributos sanitizados a partir de los datos proporcionados
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
			$attribute_pairs[] = "{$key}='{$value}'"; // Construye pares atributo-valor para la actualización
		}
		$sql = "UPDATE ".self::$tblname." SET "; // Construye la consulta SQL para la actualización
		$sql .= join(", ", $attribute_pairs); // Agrega los pares atributo-valor a la consulta SQL
		$sql .= " WHERE id =". $id; // Agrega la condición WHERE para la actualización
		echo $mydb->setQuery($sql); // Establece la consulta SQL en la instancia de la base de datos
		
		if($mydb->executeQuery()) { // Ejecuta la consulta SQL y verifica si fue exitosa
			return true; // Retorna verdadero si la actualización fue exitosa
		} else {
			return false; // Retorna falso si la actualización falló
		}   
	}
	
	public function delete($id=0) {
		global $mydb; // Accede a la instancia global de la base de datos
		$sql = "DELETE FROM ".self::$tblname; // Construye la consulta SQL para la eliminación
		$sql .= " WHERE id =". $id; // Agrega la condición WHERE para la eliminación
		$sql .= " LIMIT 1 "; // Limita la eliminación a un solo registro
		echo $mydb->setQuery($sql); // Establece la consulta SQL en la instancia de la base de datos
		
		if($mydb->executeQuery()) { // Ejecuta la consulta SQL y verifica si fue exitosa
			return true; // Retorna verdadero si la eliminación fue exitosa
		} else {
			return false; // Retorna falso si la eliminación falló
		}   
	}
}
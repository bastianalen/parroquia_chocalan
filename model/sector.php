<?php
require_once(__DIR__ ."/../controller/initialize.php");
require_once(LIB_PATH_MODEL.DS.'database.php');

class Sector {

	protected static  $tblname = "tblsector";
	/*function dbfields() {: Define una función llamada dbfields. Esta función no acepta parámetros
	 explícitos y no está asociada a una clase específica, lo que sugiere que podría estar definida en 
	 un contexto global o dentro de una clase que tenga acceso a la variable global $mydb. */
	function dbfields () {
		global $mydb;
		return $mydb->getfieldsononetable(self::$tblname);

	}
	/*Esta función listofsector() es típicamente utilizada en aplicaciones web PHP para obtener una lista de registros 
	(en este caso, todos los campos de todas las filas) de una tabla específica en la base de datos. Es esencial para 
	operaciones como mostrar datos en una interfaz de usuario, exportar datos, o realizar cálculos sobre un conjunto 
	de datos. Asegura que los errores durante la ejecución de la consulta sean manejados adecuadamente y devuelve los
	resultados en un formato útil para su posterior procesamiento o visualización. */
	function listofsector(){
		global $mydb; // Accede a la instancia global de la base de datos
		// Establece la consulta SQL utilizando el nombre de la tabla estática
		$mydb->setQuery("SELECT * FROM ".self::$tblname);
		// Ejecuta la consulta SQL y guarda el resultado en $cur
		$cur = $mydb->executeQuery();
		// Manejo de errores si la ejecución de la consulta falla
		if (!$cur) {
			// Registra un mensaje de error en el registro de errores
			error_log("Error executing query: " . $mydb->error);
			// Devuelve false para indicar que ocurrió un error
			return false;
		}
		// Inicializa un array vacío para almacenar los resultados
		$result = [];
		// Recorre el resultado de la consulta y agrega cada fila al array $result
		while ($row = $cur->fetch_assoc()) {
			$result[] = $row;
		}
		// Devuelve el array $result que contiene todos los registros obtenidos
		return $result;
	}
	/*Esta función find_sector() se utiliza para buscar sectores en una base de datos según el ID del sector o
	 el nombre del sector proporcionados como parámetros. Devuelve el número de filas encontradas que coinciden 
	 con los criterios de búsqueda. Es útil para verificar la existencia de un sector específico en la base de 
	 datos antes de realizar operaciones adicionales o para contar cuántos registros coinciden con los criterios especificados. */
	function find_sector($id="", $name="") {
		global $mydb; // Accede a la instancia global de la base de datos
		// Configura la consulta SQL para buscar un sector por ID o por nombre
		$mydb->setQuery("SELECT * FROM ".self::$tblname." WHERE id_sector = {$id} OR sector = '{$name}'");
		// Ejecuta la consulta SQL y guarda el resultado en $cur
		$cur = $mydb->executeQuery();
		// Obtiene el número de filas devueltas por la consulta
		$row_count = $mydb->num_rows($cur);
		// Devuelve el número de filas encontradas que cumplen con los criterios de búsqueda
		return $row_count;
	}
	/*Esta función single_sector() se utiliza para recuperar un único registro de un sector en la base de datos, 
	basado en el ID proporcionado como parámetro. Es útil cuando se necesita obtener detalles específicos de un 
	sector conocido su ID, por ejemplo, para mostrar información detallada de un sector en una aplicación o sistema. */
	function single_sector($id="") {
		global $mydb; // Accede a la instancia global de la base de datos
		// Configura la consulta SQL para seleccionar un sector por su ID
		$mydb->setQuery("SELECT * FROM ".self::$tblname." where id_sector = {$id} LIMIT 1");
		// Ejecuta la consulta SQL y carga el resultado como un único resultado
		$cur = $mydb->loadSingleResult();
		// Devuelve el resultado único obtenido de la consulta
		return $cur;
	}

	static function instantiate($record) {
		$object = new self; // Crea una nueva instancia del objeto de la clase actual
		foreach ($record as $attribute => $value) {
			// Verifica si el objeto tiene el atributo correspondiente al nombre de $attribute
			if ($object->has_attribute($attribute)) {
				// Asigna el valor de $value al atributo $attribute del objeto
				$object->$attribute = $value;
			}
		}
		return $object; // Devuelve el objeto instanciado con los atributos y valores asignados
	}
	
	/*limpi las filas de datos antes de enviarlas a la base de datos */
	private function has_attribute($attribute) {
	  // We don't care about the value, we just want to know if the key exists
	  // retornara verdadero o false
	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
		global $mydb; // Accede a la instancia global de la base de datos
		$attributes = array(); // Inicializa un array para almacenar los atributos
		// Itera sobre los campos de la base de datos definidos en dbfields()
		foreach ($this->dbfields() as $field) {
			// Verifica si existe una propiedad en la instancia actual con nombre $field
			if (property_exists($this, $field)) {
				// Asigna el valor de la propiedad al array $attributes con clave $field
				$attributes[$field] = $this->$field;
			}
		}
		return $attributes; // Devuelve el array $attributes con los atributos y sus valores
	}
	

	protected function sanitized_attributes() {
		global $mydb; // Accede a la instancia global de la base de datos
		$clean_attributes = array(); // Inicializa un array para almacenar atributos sanitizados
		// Itera sobre los atributos obtenidos mediante el método attributes()
		foreach ($this->attributes() as $key => $value) {
			// Usa el método escape_value() de $mydb para sanitizar el valor del atributo
			$clean_attributes[$key] = $mydb->escape_value($value);
		}
		return $clean_attributes; // Devuelve el array $clean_attributes con atributos sanitizados
	}
	
	
	
	public function save() {
		// Un nuevo registro aún no tendrá un ID.
		// Si el ID está definido, llamamos al método update(); de lo contrario, llamamos a create().
		return isset($this->id) ? $this->update() : $this->create();
	}
	
	public function create() {
		global $mydb; // Accedemos a la conexión global de la base de datos
		// Obtenemos los atributos sanitizados del objeto actual
		$attributes = $this->sanitized_attributes();
		// Construimos la consulta SQL para insertar un nuevo registro
		$sql = "INSERT INTO " . self::$tblname . " (";
		$sql .= join(", ", array_keys($attributes)); // Concatenamos los nombres de las columnas
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes)); // Concatenamos los valores de los atributos
		$sql .= "')";
		// Ejecutamos la consulta SQL a través del método setQuery de la conexión $mydb
		echo $mydb->setQuery($sql);
		// Verificamos si la consulta se ejecutó correctamente
		if ($mydb->executeQuery()) {
			$this->id = $mydb->insert_id(); // Obtenemos el ID generado para el nuevo registro
			return true; // Devolvemos verdadero indicando que la creación fue exitosa
		} else {
			return false; // Devolvemos falso si hubo algún error en la ejecución de la consulta
		}
	}
	

	public function update($id=0) {
		global $mydb; // Accede a la variable global $mydb que probablemente representa una conexión a la base de datos
		// Obtiene los atributos del objeto actual y los sanitiza (probablemente para evitar inyección SQL)
		$attributes = $this->sanitized_attributes();
		// Prepara los pares clave=valor para la actualización en SQL
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
			$attribute_pairs[] = "{$key}='{$value}'";
		}
		// Construye la consulta SQL para actualizar los datos
		$sql = "UPDATE " . self::$tblname . " SET ";
		$sql .= join(", ", $attribute_pairs); // Une los pares clave=valor separados por comas
		$sql .= " WHERE id_sector =" . $id; // Especifica la condición WHERE para actualizar el registro con el ID dado
		// Establece la consulta SQL en la instancia de $mydb (supongo que es un objeto que maneja la conexión y las consultas)
		$mydb->setQuery($sql);
		// Ejecuta la consulta SQL y verifica si fue exitosa
		if (!$mydb->executeQuery()) return false; // Devuelve falso si la ejecución falla
			// Si la consulta se ejecuta correctamente, podría ser buena práctica devolver true o algún otro indicador de éxito
	}
	

	public function delete($id=0) {
		global $mydb; // Accede a la variable global $mydb que probablemente representa una conexión a la base de datos
		// Construye la consulta SQL para eliminar registros
		$sql = "DELETE FROM " . self::$tblname; // Establece la tabla desde donde se eliminarán los registros
		$sql .= " WHERE id_sector =" . $id; // Especifica la condición WHERE para eliminar el registro con el ID dado
		$sql .= " LIMIT 1 "; // Limita la eliminación a un solo registro (por seguridad o eficiencia)
		$mydb->setQuery($sql); // Establece la consulta SQL en la instancia de $mydb
		// Ejecuta la consulta SQL y verifica si fue exitosa
		if (!$mydb->executeQuery()) {
			return false; // Devuelve falso si la ejecución falla
		}
	}


}
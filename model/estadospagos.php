<?php
/*requiere la dependencia del controlador initialize */
require_once(__DIR__ ."/../controller/initialize.php");
/*requiere la libreria que se encuentra dentro de database.php */
require_once(LIB_PATH_MODEL.DS.'database.php');


/*define una clase EstadoPago con una propiedad
estática para el nombre de la tabla de base de datos 
y un método para obtener dinámicamente los nombres
de los campos de esa tabla utilizando una instancia
de conexión a la base de datos.
 */
class EstadoPago {

	protected static  $tblname = "tblestadospagos";

	/*El método dbfields() parece diseñado para
	 obtener dinámicamente los nombres de los 
	 campos de la tabla tblestadospagos desde 
	 la base de datos, utilizando la instancia
	 de conexión a la base de datos ($mydb). */
	function dbfields () {
		global $mydb;
		/*getfieldsononetable() en la clase 
		 $mydb debe manejar adecuadamente la consulta
		 y devolución de los nombres de los campos 
		 de la tabla especificada. */
		return $mydb->getfieldsononetable(self::$tblname);

	}
	function list_of_estado_pago(){
		global $mydb;

		/*setQuery() establece la consulta SQL
		 que selecciona todos los campos (*) de 
		 la tabla especificada (self::$tblname).
		executeQuery() ejecuta la consulta SQL contra la
		base de datos y devuelve un resultado ($cur) 
		que puede ser iterado para obtener filas de resultados. */
		$mydb->setQuery("SELECT * FROM ".self::$tblname);
		$cur = $mydb->executeQuery();
		/*Verifica si la ejecución de la consulta 
		($cur) fue exitosa. Si no lo fue, se registra
		un mensaje de error en el registro de errores
		(error_log) y la función devuelve false. */
		if (!$cur) {
			// Manejo de errores
			error_log("Error executing query: " . $mydb->error);
			return false;
		}
		/*Inicializa un arreglo vacío $result donde se almacenarán las filas de resultados.
		Utiliza un bucle while para iterar sobre cada fila devuelta por $cur (usando fetch_assoc() para obtener cada fila como un arreglo asociativo).
		Agrega cada fila al arreglo $result. */
		$result = [];
		while ($row = $cur->fetch_assoc()) {
			$result[] = $row;
		}

		return $result;
	}


	function find_estado_pago($id="",$name=""){
		global $mydb;
		/*El propósito de esta función es buscar registros 
		en una tabla de base de datos (self::$tblname) 
		que coincidan con uno de los siguientes criterios:
		id_estado_pago igual al valor proporcionado en $id.
		estado_pago igual al valor proporcionado en $name.
		La función cuenta el número de filas que cumplen 
		con alguno de estos criterios y devuelve ese número. */
		/*setQuery() establece la consulta SQL para seleccionar 
		todos los campos (*) de la tabla especificada 
		(self::$tblname) donde id_estado_pago es igual 
		al valor de $id o estado_pago es igual al valor 
		de $name.
		El uso de llaves {} en $id en el caso de id_estado_pago
		y comillas simples alrededor de $name en estado_pago
		asegura que los valores sean correctamente
		interpretados dentro de la cadena SQL. */
		$mydb->setQuery("SELECT * FROM ".self::$tblname." WHERE id_estado_pago = {$id} OR estado_pago = '{$name}'");
		/*executeQuery() ejecuta la consulta SQL
		 contra la base de datos y devuelve un cursor 
		 ($cur) que contiene el resultado de la consulta. */
		$cur = $mydb->executeQuery();
		/*num_rows($cur) cuenta el número de filas
		 devueltas por la consulta ejecutada y almacena 
		 este valor en $row_count. */
		$row_count = $mydb->num_rows($cur);
		/*num_rows($cur) cuenta el número de filas 
		devueltas por la consulta ejecutada y almacena 
		este valor en $row_count. */
		return $row_count;
	}
	 
	function single_estado_pago($id=""){
		global $mydb;

		/*setQuery() establece la consulta SQL para 
		seleccionar todos los campos (*) de la tabla
		especificada (self::$tblname) donde id_estado_pago
		es igual al valor de $id.
		LIMIT 1 asegura que solo se devuelva un único resultado, 
		aunque $id debería ser único si id_estado_pago es una 
		clave primaria. */
		$mydb->setQuery("SELECT * FROM ".self::$tblname." where id_estado_pago = {$id} LIMIT 1");
		$cur = $mydb->loadSingleResult();
		return $cur;
	}
	
	/*El propósito de este método instantiate() es crear
	una instancia del objeto actual (self) y asignar valores 
	a sus atributos basados en un arreglo asociativo $record
	proporcionado como argumento.*/
	static function instantiate($record) {
		/*Crea una nueva instancia del objeto de la propia
		 clase (self). Esto significa que el método estático 
		 instantiate() pertenece a la misma clase en la que se define. */
		$object = new self;
		/*Itera a través de cada par clave-valor en el arreglo $record. 
		$attribute representa el nombre del atributo y $value representa 
		el valor asociado con ese atributo en el arreglo $record.
		Para cada atributo $attribute, verifica si el objeto ($object) tiene
		ese atributo utilizando el método has_attribute($attribute).
		Si el objeto tiene ese atributo (es decir, has_attribute($attribute) 
		devuelve true), asigna el valor $value al atributo correspondiente del
		objeto ($object->$attribute = $value). */
		foreach($record as $attribute=>$value){
			/*Este método debería estar definido en la misma clase 
			o ser accesible desde la misma clase. Su función es verificar 
			si el objeto tiene un atributo específico, posiblemente utilizando 
			la función property_exists() u otro método similar. */
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		} 

		/*Devuelve el objeto $object, que ahora tiene sus atributos 
		inicializados con los valores del arreglo $record. */
		return $object;
	}
	
	
	/*--Cleaning the raw data before submitting to Database--*/
	private function has_attribute($attribute) {
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false

	  /*Propósito: Este método privado verifica si un atributo 
	  específico existe en el objeto actual ($this). Utiliza el
	   método attributes() para obtener un arreglo de todos 
	   los atributos del objeto y luego verifica si $attribute 
	   está presente como clave en ese arreglo.
		Funcionamiento: Devuelve true si el atributo $attribute existe
		en el objeto actual, false si no. */
	  return array_key_exists($attribute, $this->attributes());
	}
	/*Propósito: Devuelve un arreglo asociativo de todos los 
	atributos y sus valores del objeto actual.
		Funcionamiento:
		Itera sobre los campos de la base de datos 
		($this->dbfields()), que suponemos que devuelve los nombres de 
		los campos de la tabla asociada.
		Verifica si cada campo ($field) existe como propiedad del objeto 
		(property_exists($this, $field)).
		Si existe, agrega el nombre del campo como clave y su valor correspondiente
		$this->$field) como valor al arreglo $attributes.
		Finalmente, devuelve el arreglo $attributes que contiene todos los
		atributos del objeto y sus valores actuales. */
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
		/*Propósito: Devuelve un arreglo de atributos del objeto con sus valores sanitizados antes de ser utilizados en operaciones con la base de datos.
		Funcionamiento:
		Utiliza el método attributes() para obtener todos los atributos del objeto con sus valores actuales.
		Itera sobre cada atributo ($key => $value) en el arreglo devuelto por attributes().
		Utiliza $mydb->escape_value($value) para escapar o limpiar el valor $value antes de almacenarlo en $clean_attributes.
		Devuelve $clean_attributes, que contiene todos los atributos del objeto con valores sanitizados.
		*/
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
	/*Propósito: Este método decide si se debe crear un nuevo 
	registro en la base de datos o actualizar uno existente, 
	dependiendo de si el objeto ya tiene un id definido.
	Funcionamiento:
	Verifica si $this->id está definido (isset($this->id)).
	Si $this->id está definido, llama al método update() para 
	actualizar el registro existente.
	Si $this->id no está definido (es null o no está establecido), 
	llama al método create() para insertar un nuevo registro en la base de datos. */
	
	/*--Create,Update and Delete methods--*/
	public function save() {
	  // A new record won't have an id yet.
	  return isset($this->id) ? $this->update() : $this->create();
	}
	/*Propósito: Este método realiza la inserción de un nuevo registro en la base de datos utilizando los atributos actuales del objeto.
		Funcionamiento:
		Llama al método sanitized_attributes() para obtener un arreglo de atributos sanitizados y preparados para la inserción.
		Construye la consulta SQL de inserción usando los nombres de los campos (array_keys($attributes)) y los valores de los campos (array_values($attributes)).
		Utiliza $mydb->setQuery($sql) para establecer la consulta SQL en la instancia global de la base de datos.
		Ejecuta la consulta SQL con $mydb->executeQuery(). Si la inserción es exitosa, guarda el id del registro insertado en $this->id y devuelve true. En caso contrario, devuelve false. */
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
	/*Propósito: Actualiza un registro existente en la base de datos utilizando los atributos actuales del objeto.
	Funcionamiento:
	Llama al método sanitized_attributes() para obtener un arreglo de atributos sanitizados y preparados para la actualización.
	Construye la consulta SQL de actualización utilizando los nombres de los campos y sus valores ($attribute_pairs).
	Utiliza $mydb->setQuery($sql) para establecer la consulta SQL en la instancia global de la base de datos.
	Ejecuta la consulta SQL con $mydb->executeQuery(). Si la actualización es exitosa, devuelve true. Si la ejecución de la consulta falla, devuelve false. */
		public function update($id=0) {
	  global $mydb;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$tblname." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE id_estado_pago =". $id;
	  $mydb->setQuery($sql);
	 	if(!$mydb->executeQuery()) return false; 	
		
	}
	/*Propósito: Elimina un registro existente en la base de datos basado en un id proporcionado.
	Funcionamiento:
	Construye la consulta SQL de eliminación utilizando self::$tblname como nombre de la tabla y $id como condición para eliminar el registro específico.
	Utiliza $mydb->setQuery($sql) para establecer la consulta SQL en la instancia global de la base de datos.
	Ejecuta la consulta SQL con $mydb->executeQuery(). Si la eliminación es exitosa, devuelve true. Si la ejecución de la consulta falla, devuelve false. */
	public function delete($id=0) {
		global $mydb;
		  $sql = "DELETE FROM ".self::$tblname;
		  $sql .= " WHERE id_estado_pago =". $id;
		  $sql .= " LIMIT 1 ";
		  $mydb->setQuery($sql);
		  
			if(!$mydb->executeQuery()) return false; 	
	
	}	


}
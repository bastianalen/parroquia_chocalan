<?php
/*incluir el controlador initialize que tiene la configuracion */
require_once(__DIR__ ."/../controller/initialize.php");
/*require_once: Es una función en PHP utilizada para incluir y 
 evaluar un archivo especificado durante la ejecución del script.
 La palabra clave require_once asegura que el archivo se incluya 
 solo una vez. Si el archivo ya se ha incluido anteriormente en el 
 script (o en uno de los scripts incluidos), no se volverá a incluir. */
require_once(LIB_PATH_MODEL.DS.'database.php');

/*Este código PHP define una clase llamada TipoTumba, que parece 
estar diseñada para interactuar con la tabla tbltipotumba en una base 
de datos. Aquí está el análisis detallado del código proporcionado: */
class TipoTumba {
/*protected static $tblname = "tbltipotumba";

protected static: Esto indica que la propiedad $tblname es accesible
solo dentro de la clase TipoTumba y sus clases derivadas. Además, al 
ser estática, la propiedad pertenece a la clase en sí misma en lugar 
de a una instancia específica de la clase.
$tblname = "tbltipotumba";: Esta variable estática almacena el nombre 
de la tabla de base de datos con la que la clase TipoTumba interactuará. 
En este caso, tbltipotumba parece ser el nombre de una tabla que contiene 
información sobre tipos de tumbas. */
	protected static  $tblname = "tbltipotumba";
/*function dbfields () { ... }

Este es un método de la clase TipoTumba llamado dbfields.
Funcionalidad:
global $mydb;: Esto permite que el método acceda a la variable
global $mydb, que probablemente se refiere a una instancia de
una clase que maneja la conexión y las consultas a la base de datos.
$mydb->getfieldsononetable(self::$tblname);: Llama al método getfieldsononetable
de la instancia $mydb, pasando $tblname como argumento. Este método probablemente 
está diseñado para obtener los nombres de los campos (columnas) de la tabla especificada por $tblname. */
	function dbfields () {
		global $mydb;
		return $mydb->getfieldsononetable(self::$tblname);

	}
	/*El código proporcionado define una función llamada listoftipotumba(), que
	 parece estar diseñada para obtener y devolver todos los registros de una 
	 tabla específica de la base de datos. Aquí está el análisis detallado del código: */
	function listoftipotumba(){
		global $mydb;
		/*$mydb->setQuery("SELECT * FROM ".self::$tblname);
		setQuery() es un método de la instancia $mydb que establece la 
		consulta SQL que se va a ejecutar. En este caso, la consulta 
		selecciona todos los campos (*) de la tabla especificada por self::$tblname.
		self::$tblname se refiere a una propiedad estática de la clase actual 
		(TipoTumba en este contexto), que almacena el 
		nombre de la tabla (tbltipotumba en este caso). */
		$mydb->setQuery("SELECT * FROM ".self::$tblname);
		/*executeQuery() es un método que probablemente ejecuta la consulta SQL establecida por setQuery(). */
		$cur = $mydb->executeQuery();
		/*if (!$cur) { ... }: Esta condición verifica si la ejecución de la 
		consulta SQL falló ($cur es false). En ese caso, se registra un mensaje 
		de error en el archivo de registro de errores (error_log()) y la función 
		devuelve false, indicando que hubo un problema al ejecutar la consulta. */
		if (!$cur) {
			// Manejo de errores
			error_log("Error executing query: " . $mydb->error);
			return false;
		}
		
		/*Si la ejecución de la consulta fue exitosa, se inicializa un arreglo 
		vacío $result para almacenar los resultados de la consulta.
		while ($row = $cur->fetch_assoc()) { ... }: Itera a través de los resultados 
		devueltos por la consulta y agrega cada fila como un arreglo asociativo $row al arreglo $result. */
		$result = [];
		while ($row = $cur->fetch_assoc()) {
			$result[] = $row;
		}
		/*Finalmente, la función retorna $result, que contiene todos los
		registros obtenidos de la tabla tbltipotumba como arreglos asociativos. */
		return $result;
	}
	/*Este código define una función llamada find_tumba() 
	que realiza una consulta condicional a una tabla específica 
	de la base de datos para buscar registros que
	 coincidan con ciertos criterios (ID y/o nombre). */
	function find_tumba($id="",$name=""){ 
		global $mydb;
		$sql= "SELECT * FROM ".self::$tblname." 
		WHERE 1=1";
		if ($id !== "") {
			$sql .= " AND id_tipo_tumba = '{$id}'";
		}
		if ($name !== "") {
			$sql .= " AND tipo = '{$name}'";
		}
		$mydb->setQuery($sql);
		$cur = $mydb->executeQuery();
		$results= [];
		while ($row = $cur->fetch_assoc()) {
			$results[] = $row;
		}
		return $results;
	}
	/*Este código define una función llamada single_tumba($id="") 
	que se encarga de realizar una consulta SQL para obtener un
	único registro de una tabla específica en la base de datos, 
	basado en un ID proporcionado como parámetro */
	function single_tumba($id=""){
		global $mydb;
		/*$mydb->setQuery("SELECT * FROM ".self::$tblname." where id_tipo_tumba = {$id} LIMIT 1");
		self::$tblname se refiere a una propiedad estática de la clase actual 
		(TipoTumba en este contexto), que almacena el nombre de la tabla de base 
		de datos (tbltipotumba en este caso).
		SELECT * FROM tbltipotumba where id_tipo_tumba = {$id} LIMIT 1: Esta 
		es la consulta SQL que selecciona todos los campos (*) de la tabla
		tbltipotumba donde el id_tipo_tumba sea igual al valor proporcionado
		por $id. El LIMIT 1 asegura que solo se devolverá un único resultado. */
		$mydb->setQuery("SELECT * FROM ".self::$tblname." where id_tipo_tumba = {$id} LIMIT 1");
		/*$cur = $mydb->loadSingleResult();
		loadSingleResult() es un método que probablemente ejecuta la consulta SQL establecida por 
		setQuery() y devuelve un solo resultado (en forma de arreglo asociativo) si la consulta tiene éxito. 
		Si no hay resultados que coincidan con la consulta, $cur será null. */
		$cur = $mydb->loadSingleResult();
		return $cur;
	}
	
	/*Declaración del Método Estático: static function instantiate($record) {

	Este método es estático, lo que significa que puede ser llamado 
	sin necesidad de crear una instancia de la clase donde está definido (self).
	Instanciación de un Objeto: $object = new self;

	Crea una nueva instancia de la propia clase (self se refiere 
	a la clase donde está definido este código). Por lo tanto, $object será una instancia de esa clase. */
	static function instantiate($record) {
		$object = new self;
		/*foreach($record as $attribute => $value): Itera sobre cada elemento 
		del array $record, donde $attribute es la clave (nombre del atributo) 
		y $value es el valor asociado a ese atributo. */
		foreach($record as $attribute=>$value){
			/*if($object->has_attribute($attribute)): Verifica si el objeto 
			$object tiene un atributo llamado $attribute. Esta verificación suele 
			realizarse utilizando un método has_attribute que devuelve true si el 
			atributo existe en el objeto.
			$object->$attribute = $value;: Si el atributo existe en el objeto, se asigna el 
			valor $value al atributo correspondiente ($attribute) del objeto $object. */
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		} 
		/*Devuelve el objeto $object después de haber completado la asignación
		 de todos los atributos del array $record que existen en el objeto. */
		return $object;
	}
	
	/*private function: Indica que este método solo puede ser accedido dentro de la misma 
	clase y no desde fuera de ella ni por clases derivadas (subclases). Es una
	encapsulación que limita el acceso al método. */
	private function has_attribute($attribute) {
	/*array_key_exists($attribute, $this->attributes()): Esta función 
	de PHP comprueba si existe una clave ($attribute) dentro del array 
	devuelto por el método $this->attributes().
	$this->attributes(): Llama al método attributes() dentro de la misma
	clase para obtener un array que probablemente contiene los nombres 
	de los atributos o propiedades de la clase. */
	  return array_key_exists($attribute, $this->attributes());
	}
	/*protected function attributes() {: Define un método protegido llamado attributes.
	Uso de global $mydb;:
	global $mydb;: Hace referencia a una variable global llamada $mydb, que probablemente representa una conexión a una base de datos u otro recurso compartido.
	Inicialización de $attributes:
	$attributes = array();: Inicializa un array vacío llamado $attributes que se utilizará para almacenar los atributos válidos del objeto.
	Iteración sobre dbfields():
	foreach($this->dbfields() as $field) {: Itera sobre los campos devueltos por el método dbfields() de la clase actual ($this).
	Verificación y Asignación de Atributos:
	if(property_exists($this, $field)) {: Verifica si el objeto actual ($this) tiene una propiedad correspondiente al campo $field.
	$attributes[$field] = $this->$field;: Si el campo es una propiedad válida del objeto, asigna su valor al array $attributes usando el nombre del campo como clave.
	Retorno de $attributes:
	return $attributes;: Devuelve el array $attributes, que contiene todos los atributos válidos del objeto. */
	protected function attributes() { 
		
	  global $mydb;
	  $attributes = array();
	  foreach($this->dbfields() as $field) {
	    if(property_exists($this, $field)) {
			$attributes[$field] = $this->$field;
		}
	  }
	  return $attributes;
	}
	/*Declaración del Método Protegido:
	protected function sanitized_attributes() {: Define un método protegido llamado sanitized_attributes.
	Uso de global $mydb;:
	global $mydb;: Hace referencia a una variable global $mydb, que probablemente representa una instancia de una clase ($mydb) que maneja la conexión a una base de datos.
	Inicialización de $clean_attributes:
	$clean_attributes = array();: Inicializa un array vacío llamado $clean_attributes que se utilizará para almacenar los atributos sanitizados del objeto.
	Iteración sobre attributes():
	foreach($this->attributes() as $key => $value) {: Itera sobre los atributos del objeto actual ($this) obtenidos mediante el método attributes().
	Llamada a escape_value():
	$clean_attributes[$key] = $mydb->escape_value($value);: Para cada atributo del objeto, se utiliza $mydb->escape_value($value) para sanitizar el valor $value. Esto supone que escape_value() es un método de la clase $mydb que realiza la limpieza o escape de datos para prevenir inyecciones SQL u otros problemas de seguridad en consultas a la base de datos.
	Retorno de $clean_attributes:
	return $clean_attributes;: Devuelve el array $clean_attributes, que contiene los atributos del objeto después de ser sanitizados. */
	protected function sanitized_attributes() {
	  global $mydb;
	  $clean_attributes = array();
	 
	  foreach($this->attributes() as $key => $value){
	    $clean_attributes[$key] = $mydb->escape_value($value);
	  }
	  return $clean_attributes;
	}
	
	
	/*Declaración del Método Público:
	public function save() {: Define un método público llamado save() que probablemente forma parte de una clase que maneja la persistencia de datos, como un modelo en un sistema MVC (Model-View-Controller) o en un sistema ORM (Object-Relational Mapping).
	Operador Ternario (?:):
	return isset($this->id) ? $this->update() : $this->create();
	isset($this->id): Verifica si la propiedad $id del objeto actual ($this) está definida y no es null.
	Si $this->id está definido (isset($this->id) es verdadero):
	$this->update(): Llama al método update(), que probablemente actualiza los datos existentes en la base de datos.
	Si $this->id no está definido (isset($this->id) es falso):
	$this->create(): Llama al método create(), que probablemente crea un nuevo registro en la base de datos con los datos del objeto actual. */
	public function save() {
	
	  return isset($this->id) ? $this->update() : $this->create();
	}
	/*
Este código PHP define un método público llamado create() 
dentro de una clase */
	public function create() {
		/*Uso de global $mydb;:
		global $mydb;: Permite acceder a una instancia global de la clase $mydb, 
		que generalmente representa una conexión a la base de datos o un objeto de acceso a datos.
		Sanitización de Atributos:

		$attributes = $this->sanitized_attributes();: Llama al método sanitized_attributes()
		para obtener un array de atributos limpios y seguros, 
		preparados para ser insertados en la base de datos. */
		global $mydb;
		$attributes = $this->sanitized_attributes();
		/*self::$tblname: Hace referencia al nombre de la tabla de base de datos donde se realizará la inserción.
		array_keys($attributes): Obtiene los nombres de los atributos como claves del array $attributes.
		array_values($attributes): Obtiene los valores de los atributos como valores del array $attributes.
		join(): Combina los elementos del array con comas para formar la lista de columnas y valores en la consulta SQL. */
		$sql = "INSERT INTO ".self::$tblname." (";
		$sql .= join(", ", array_keys($attributes));
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
		/*echo $mydb->setQuery($sql);: Establece la consulta SQL
		 en el objeto $mydb y la imprime. Esto puede ser útil para 
		 depuración o seguimiento de la consulta generada. */
		echo $mydb->setQuery($sql);
		/* if ($mydb->executeQuery()) {: Llama al método executeQuery() en $mydb para ejecutar la consulta SQL.
		Si la consulta se ejecuta correctamente:
		$this->id = $mydb->insert_id();: Asigna el ID generado por autoincremento (si hay) a la propiedad $id del objeto actual.
		Retorna true, indicando que la inserción fue exitosa.
		Si la consulta no se ejecuta correctamente:
		Retorna false, indicando que la inserción falló.*/
	 if($mydb->executeQuery()) {
	    $this->id = $mydb->insert_id();
	    return true;
	  } else {
	    return false;
	  }
	}
	/*Este código PHP define un método público llamado update() dentro de una clase */
	public function update($id=0) {
		/*global $mydb;: Permite acceder a una instancia global de la clase
		 $mydb, que generalmente representa una conexión a la base de datos o un objeto de acceso a datos */
	  global $mydb;
		/*$attributes = $this->sanitized_attributes();: Llama al método 
		sanitized_attributes() para obtener un array de atributos limpios 
		y seguros, preparados para ser actualizados en la base de datos. */
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		/*foreach($attributes as $key => $value) { ... }: Itera sobre el array
		 de atributos $attributes y construye pares clave-valor en formato de 
		 cadena ({$key}='{$value}') para cada atributo. Estos pares serán 
		 utilizados en la cláusula SET de la consulta SQL. */
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		/*self::$tblname: Hace referencia al nombre de la tabla de base de datos donde
		se realizará la actualización.
		join(", ", $attribute_pairs): Combina los pares de atributos en formato 
		de cadena separados por comas para formar la lista de asignaciones en la cláusula SET.
		WHERE id_tipo_tumba = $id: Filtra los registros a actualizar, 
		especificando el ID ($id) proporcionado como parámetro. */
		$sql = "UPDATE ".self::$tblname." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE id_tipo_tumba =". $id;
		/*$mydb->setQuery($sql);: Establece la consulta SQL en el objeto $mydb.
		if (!$mydb->executeQuery()) { return false; }: Llama al método executeQuery() 
		en $mydb para ejecutar la consulta SQL. Si la consulta no se ejecuta correctamente, 
		devuelve false, indicando que la actualización falló. */
	  $mydb->setQuery($sql);
	 	if(!$mydb->executeQuery()) return false; 	
		
	}
	/*define un método público llamado delete() dentro de una clase. */
	public function delete($id=0) {
		/*global $mydb;: Permite acceder a una instancia global de la clase $mydb,
		 que generalmente representa una conexión a la base de datos o un objeto de acceso a datos. */
		global $mydb;
		/*self::$tblname: Hace referencia al nombre de la tabla de base 
		de datos desde la cual se eliminará el registro.
		WHERE id_tipo_tumba = $id: Filtra los registros a eliminar,
		especificando el ID ($id) proporcionado como parámetro.
		LIMIT 1: Limita la eliminación a un solo registro. Esto es una práctica
		común cuando se espera que $id identifique un único registro único a eliminar. */
		  $sql = "DELETE FROM ".self::$tblname;
		  $sql .= " WHERE id_tipo_tumba =". $id;
		  $sql .= " LIMIT 1 ";
		  $mydb->setQuery($sql);
		  /*if (!$mydb->executeQuery()) { return false; }: Llama al método executeQuery()
		   en $mydb para ejecutar la consulta SQL. Si la consulta no se ejecuta correctamente, 
		   devuelve false, indicando que la eliminación falló. */
			if(!$mydb->executeQuery()) return false; 	
	
	}	


}
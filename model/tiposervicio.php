<?php
// se incluye el archivo initialize.php que contiene configuraciones 
/*Este código en PHP establece varias constantes y carga archivos de
 configuración y funciones necesarios para una aplicación.  */
require_once(__DIR__ ."/../controller/initialize.php");

/*Se incluye el archivo database.php que contiene configuraciones, librerias 
y funciones necesarias para poder ejecutar alguna funcion en este archivo*/
require_once(LIB_PATH_MODEL.DS.'database.php');
/*Se declara una clase llamada tipoServicio que contiene funciones y metodos asociados a la clase*/
class TipoServicio {
	/*Se declara una variables $tblname de caracter static*/
	protected static  $tblname = "tbltiposervicio";
	//Se declara la funcion dbfields()
	/*Global $mydb: Esta línea indica que la función usa una variable global llamada
	$mydb, que probablemente es una instancia de una clase que maneja conexiones y consultas a la base de datos.
	$mydb->getfieldsononetable(self::$tblname): Aquí se llama a un método getfieldsononetable()
	en el objeto $mydb. Este método toma un parámetro, que en este caso es self::$tblname.
	self::$tblname: Este probablemente sea un nombre de clase estático ($tblname) que hace
	referencia al nombre de la tabla de la base de datos para la cual se desean obtener los campos.
	return: La función devuelve lo que retorna el método getfieldsononetable() de la instancia $mydb. */
	function dbfields () {
		global $mydb;
		return $mydb->getfieldsononetable(self::$tblname);

	}
	/*Global $mydb: Esta línea indica que la función utiliza una instancia global de la base de datos $mydb,
	probablemente una instancia de una clase que maneja conexiones y consultas a la base de datos.
	$mydb->setQuery("SELECT * FROM " . self::$tblname);: Aquí se establece la consulta SQL que se va 
	a ejecutar. El código construye dinámicamente una consulta para seleccionar todos los campos (*) 
	de una tabla cuyo nombre está almacenado en self::$tblname.
	self::$tblname: Esto probablemente sea una propiedad estática de la clase donde se encuentra esta
	función, que contiene el nombre de la tabla en la base de datos sobre la cual se realizará la consulta.
	$mydb->executeQuery(): Este método probablemente ejecuta la consulta SQL que se configuró previamente con
	setQuery(). Devuelve un cursor (o un objeto similar) que contiene los resultados de la consulta.
	Verificación de errores: Después de ejecutar la consulta, el código verifica si ocurrió algún error. 
	Si $cur es false (es decir, si la ejecución de la consulta falló), se registra un mensaje de error
	en el registro de errores (error_log()) y la función devuelve false para indicar que hubo
	un problema durante la ejecución de la consulta. */
	function listoftiposervicio(){
		global $mydb;
		$mydb->setQuery("SELECT * FROM " . self::$tblname);
		$cur = $mydb->executeQuery();

		if (!$cur) {
			// Manejo de errores
			error_log("Error executing query: " . $mydb->error);
			return false;
		}
		/*Inicialización del array $result: Se inicializa un array vacío $result donde se almacenarán los resultados de la consulta.
		Iteración a través de los resultados: Se utiliza un bucle while para iterar a través de los resultados 
		devueltos por la consulta ejecutada anteriormente ($cur). La función fetch_assoc() devuelve cada fila de
		resultados como un array asociativo donde las claves son los nombres de las
		columnas de la tabla y los valores son los datos de cada fila.
		Almacenamiento de cada fila en $result: En cada iteración del bucle while, la variable 
		$row contiene los datos de una fila de resultados. Estos datos se añaden como un nuevo 
		elemento al array $result utilizando la sintaxis $result[] = $row;. Esto significa que 
		cada elemento del array $result será un array asociativo que representa una fila de la tabla de la base de datos.
		Retorno de los resultados: Una vez que se han iterado todas las filas de resultados y se han almacenado 
		en $result, la función devuelve $result. Esto significa que la función listoftiposervicio()
		devuelve un array que contiene todos los resultados de la consulta SQL ejecutada anteriormente. */
		$result = [];
		while ($row = $cur->fetch_assoc()) {
			$result[] = $row;
		}

		return $result;
	}
	/*Parámetros de la función: La función find_tiposervicio() acepta dos parámetros opcionales:
	$id: Este parámetro se usa para filtrar los resultados por un identificador específico (id_servicio en la tabla).
	$name: Este parámetro se usa para filtrar los resultados por un nombre específico de tipo de servicio (tipo en la tabla).
	Global $mydb: Se usa una instancia global de la clase de base de datos $mydb, lo que sugiere que esta función opera
	dentro de un contexto donde ya se ha establecido y configurado una conexión a la base de datos.
	$mydb->setQuery("SELECT * FROM " . self::$tblname . " WHERE id_servicio = {$id} OR tipo = '{$name}'");: Aquí 
	se establece la consulta SQL que se va a ejecutar. La consulta selecciona todos los campos (*) de la tabla cuyo 
	nombre está almacenado en self::$tblname y filtra los resultados usando la cláusula WHERE. Dependiendo de los valores
	de $id y $name, se pueden aplicar uno o ambos filtros (id_servicio = {$id} o tipo = '{$name}').
	self::$tblname: Esto probablemente sea una propiedad estática de la clase donde se encuentra esta función, que contiene 
	el nombre de la tabla en la base de datos.
	$mydb->executeQuery(): Este método ejecuta la consulta SQL configurada previamente con setQuery(). Devuelve un cursor 
	(o un objeto similar) que contiene los resultados de la consulta.
	$mydb->num_rows($cur): Después de ejecutar la consulta, se llama al método num_rows() de la instancia $mydb para obtener
	el número de filas que devuelve la consulta.
	Retorno de resultados: La función devuelve el número de filas encontradas que cumplen con los criterios de búsqueda 
	especificados por $id y $name. Esto puede ser útil para verificar cuántos registros coinciden con los criterios de búsqueda dados. */
	function find_tiposervicio($id="",$name=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." WHERE id_servicio = {$id} OR tipo = '{$name}'");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);
		return $row_count;
	}
	/*Parámetro de la función: La función single_tiposervicio() acepta un parámetro opcional:
	$id: Este parámetro se utiliza para filtrar el resultado por un identificador específico (id_servicio en la tabla).
	Global $mydb: Se utiliza una instancia global de la clase de base de datos $mydb, lo que indica que esta función opera
	dentro de un contexto donde ya se ha establecido y configurado una conexión a la base de datos.
	$mydb->setQuery("SELECT * FROM " . self::$tblname . " WHERE id_servicio = {$id} LIMIT 1");: Aquí se establece
	la consulta SQL que se va a ejecutar. La consulta selecciona todos los campos (*) de la tabla cuyo nombre está
	almacenado en self::$tblname y filtra los resultados utilizando la cláusula WHERE para obtener solo el registro 
	que tenga el id_servicio igual a $id. La cláusula LIMIT 1 asegura que se obtenga solo un registro como resultado.
	self::$tblname: Esto probablemente sea una propiedad estática de la clase donde se encuentra esta función, que contiene
	el nombre de la tabla en la base de datos.
	$mydb->loadSingleResult(): Después de configurar la consulta SQL, se llama al método loadSingleResult() de la instancia 
	$mydb para ejecutar la consulta y cargar el resultado único en la variable $cur.
	Retorno del resultado: Finalmente, la función devuelve el resultado obtenido de la consulta. Este resultado puede ser
	un array asociativo que representa la fila de la tabla que cumple con el criterio de búsqueda (id_servicio = {$id}), o null 
	si no se encuentra ningún registro que coincida. */
	function single_tiposervicio($id=""){
		global $mydb;
			$mydb->setQuery("SELECT * FROM ".self::$tblname." where id_servicio = {$id} LIMIT 1");
		$cur = $mydb->loadSingleResult();
		return $cur;
	}
	/*método estático dentro de una clase (probablemente una clase que representa un modelo de datos), y 
	su propósito es crear una instancia del objeto (modelo) y asignarle atributos basados
	en un arreglo de datos proporcionado ($record). */
	static function instantiate($record) {
		// Crea una nueva instancia de la clase actual (self se refiere a la clase actual)
		$object = new self;
	
		// Itera sobre cada par clave-valor en el arreglo $record
		foreach($record as $attribute => $value){
			// Verifica si la instancia actual tiene un atributo con el nombre $attribute
			if($object->has_attribute($attribute)) {
				// Asigna el valor $value al atributo $attribute del objeto
				$object->$attribute = $value;
			}
		}
	
		// retornar la instancia del objeto creado
		return $object;
	}
	

	private function has_attribute($attribute) {
    // Método privado que verifica si el atributo especificado ($attribute) existe en el arreglo de atributos del objeto.
    return array_key_exists($attribute, $this->attributes());
}

/*define una funcion protegida que contiene un arreglo de atributos */
protected function attributes() {
    // Accede a la base de datos global $mydb para obtener los campos de la tabla asociada a este objeto
    global $mydb;
    
    // Inicializa un arreglo vacío para almacenar los atributos y sus valores
    $attributes = array();
    
    // Itera sobre los campos de la base de datos definidos en dbfields()
    foreach($this->dbfields() as $field) {
        // Verifica si existe una propiedad con el nombre $field en este objeto
        if(property_exists($this, $field)) {
        	// Asigna el valor de la propiedad $field al arreglo de atributos
            $attributes[$field] = $this->$field;
        }
    }
    // Retorna el arreglo que contiene los atributos y sus valores correspondientes
    return $attributes;
}
	
/*define una funcion que sanitiza los atributos dentro de un array */
protected function sanitized_attributes() {
    // Accede a la base de datos global $mydb para sanitizar los valores
    global $mydb;
    
    // Inicializa un arreglo vacío para almacenar los atributos sanitizados
    $clean_attributes = array();
    
    // Itera sobre los atributos y sus valores obtenidos del método attributes()
    foreach($this->attributes() as $key => $value) {
        // Utiliza el método escape_value de $mydb para sanitizar el valor de cada atributo
        $clean_attributes[$key] = $mydb->escape_value($value);
    }
    
    // Retorna el arreglo que contiene los atributos sanitizados
    return $clean_attributes;
}
	
	
	
/*Guarda el objeto en la base de datos.
* Si el objeto ya tiene un ID (es decir, ya existe en la base de datos), se llama al método update().
* Si el objeto no tiene un ID (es decir, es nuevo), se llama al método create().
* El resultado de llamar a uno de los métodos: update() o create().*/
public function save() {
    // Operador ternario que decide si llamar a update() o create() basado en si el objeto tiene un ID ($this->id)
    return isset($this->id) ? $this->update() : $this->create();
}
/*Crea un nuevo registro en la base de datos con los atributos del objeto actual.
 * Utiliza los atributos sanitizados del objeto para construir y ejecutar una consulta de inserción SQL.
 * Después de la inserción exitosa, actualiza el ID del objeto con el ID generado por la base de datos.
 *Retorna true si la inserción fue exitosa, de lo contrario retorna false.*/
public function create() {
    // Accede a la base de datos global $mydb
    global $mydb;
    
    // Obtiene los atributos sanitizados del objeto
    $attributes = $this->sanitized_attributes();
    
    // Construye la consulta de inserción SQL
    $sql = "INSERT INTO " . self::$tblname . " ("; // Nombre de la tabla obtenido de la clase actual
    $sql .= join(", ", array_keys($attributes)); // Agrega los nombres de los atributos como columnas
    $sql .= ") VALUES ('";
    $sql .= join("', '", array_values($attributes)); // Agrega los valores de los atributos como valores de la inserción
    $sql .= "')";
    
    // Imprime la consulta SQL para propósitos de depuración (echo $mydb->setQuery($sql);)
    echo $mydb->setQuery($sql);
    
    // Ejecuta la consulta SQL
    if ($mydb->executeQuery()) {
        // Si la inserción fue exitosa, actualiza el ID del objeto con el ID generado por la base de datos
        $this->id = $mydb->insert_id();
        return true;
    } else {
        // Si la inserción falló, retorna false
        return false;
    }
}

/*Actualiza un registro en la base de datos con los atributos del objeto actual.
 *Utiliza los atributos sanitizados del objeto para construir y ejecutar una consulta de actualización SQL.
 *El registro que se actualiza está determinado por el ID especificado.
 *int $id El ID del registro que se desea actualizar.
 *Retorna true si la actualización fue exitosa, de lo contrario retorna false.*/
public function update($id = 0) {
    // Accede a la base de datos global $mydb
    global $mydb;
    // Obtiene los atributos sanitizados del objeto
    $attributes = $this->sanitized_attributes();
    // Inicializa un arreglo para almacenar pares atributo-valor para la actualización
    $attribute_pairs = array();
    // Itera sobre los atributos y sus valores sanitizados para construir los pares atributo-valor
    foreach ($attributes as $key => $value) {
        $attribute_pairs[] = "{$key}='{$value}'";
    }
    // Construye la consulta de actualización SQL
    $sql = "UPDATE " . self::$tblname . " SET ";
    $sql .= join(", ", $attribute_pairs); // Agrega los pares atributo-valor separados por comas
    $sql .= " WHERE id_servicio =" . $id; // Condición WHERE para especificar qué registro actualizar
    // Establece la consulta SQL en el objeto de base de datos $mydb
    $mydb->setQuery($sql);
    // Ejecuta la consulta SQL y verifica si la consulta falla retorna false
    if (!$mydb->executeQuery()) return false;

}

	/**
 * Elimina un registro de la base de datos.
 *
 * Construye y ejecuta una consulta SQL DELETE para eliminar el registro con el ID especificado.
 *
 * @param int $id El ID del registro que se desea eliminar.
 * @return bool Retorna true si la eliminación fue exitosa, de lo contrario retorna false.
 */
public function delete($id = 0) {
    // Accede a la base de datos global $mydb
    global $mydb;
    
    // Construye la consulta SQL DELETE
    $sql = "DELETE FROM " . self::$tblname; // Nombre de la tabla obtenido de la clase actual
    $sql .= " WHERE id_servicio =" . $id; // Condición WHERE para especificar qué registro eliminar
    $sql .= " LIMIT 1"; // Limita la eliminación a un solo registro
    
    // Establece la consulta SQL en el objeto de base de datos $mydb
    $mydb->setQuery($sql);
    
    // Ejecuta la consulta SQL y verifica si fue exitosa
    if (!$mydb->executeQuery()) return false;
        // Si la ejecución de la consulta falla, retorna false
        
    }
    // Si la ejecución de la consulta fue exitosa, retorna true
    // Nota: No se devuelve explícitamente true aquí, ya que la función termina si no se ejecuta el retorno falso


}
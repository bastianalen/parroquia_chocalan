<?php
require_once(__DIR__ ."/../controller/initialize.php");
require_once(LIB_PATH_MODEL.DS.'database.php');

class TipoCalendario {
	/*Devuelve los nombres de los campos de la tabla especificada.
	*Utiliza el método getfieldsononetable() del objeto de base de datos global $mydb para obtener
	*los nombres de los campos de la tabla especificada en la propiedad estática $tblname.
	*retorna un arreglo de nombres de campos de la tabla especificada.
	*/
protected static $tblname = "tbltipocalendario"; // Nombre de la tabla almacenado como propiedad estática

function dbfields() {
    // Accede al objeto de base de datos global $mydb
    global $mydb;
    // Llama al método getfieldsononetable() de $mydb para obtener los nombres de los campos de la tabla
    return $mydb->getfieldsononetable(self::$tblname);
}
	/* Obtiene una lista de todos los registros de la tabla especificada.
	* Ejecuta una consulta SQL SELECT para obtener todos los registros de la tabla especificada en self::$tblname.
	* Retorna un arreglo que contiene todos los registros obtenidos de la base de datos.
	* retorna Un arreglo de registros si la consulta fue exitosa, o false si ocurrió un error.*/
function list_of_tipocalendario() {
    // Accede al objeto de base de datos global $mydb
    global $mydb;
    // Establece la consulta SQL SELECT para obtener todos los registros de la tabla especificada
    $mydb->setQuery("SELECT * FROM " . self::$tblname);
    // Ejecuta la consulta SQL y obtiene el resultado
    $cur = $mydb->executeQuery();
    // Verifica si la ejecución de la consulta fue exitosa
    if (!$cur) {
        // Si la consulta falla, registra un mensaje de error y retorna false
        error_log("Error executing query: " . $mydb->error);
        return false;
    }
    // Inicializa un arreglo para almacenar los resultados de la consulta
    $result = [];
    // Itera sobre cada fila obtenida del resultado y la agrega al arreglo $result
    while ($row = $cur->fetch_assoc()) {
        $result[] = $row;
    }
    // Retorna el arreglo de resultados
    return $result;
}

	/* Busca registros en la tabla especificada basados en el ID o nombre del tipo de calendario.
	* Ejecuta una consulta SQL SELECT para buscar registros en la tabla especificada (self::$tblname)
	* donde el ID del tipo sea igual a $id o el nombre del tipo sea igual a $name.
	* Retorna el número de filas encontradas que cumplen con los criterios de búsqueda.
	* parametro mixed $id El ID del tipo de calendario a buscar.
	* parametro string $name El nombre del tipo de calendario a buscar.
	* retorna int El número de filas encontradas que cumplen con los criterios de búsqueda.*/
function find_tipocalendario($id = "", $name = "") {
    // Accede al objeto de base de datos global $mydb
    global $mydb;
    // Construye la consulta SQL SELECT para buscar registros en la tabla especificada
    // donde el ID del tipo sea igual a $id o el nombre del tipo sea igual a $name
    $mydb->setQuery("SELECT * FROM " . self::$tblname . " WHERE id_tipo = {$id} OR tipo = '{$name}'");
    // Ejecuta la consulta SQL y obtiene el resultado
    $cur = $mydb->executeQuery();
    // Obtiene el número de filas encontradas que cumplen con los criterios de búsqueda
    $row_count = $mydb->num_rows($cur);
    // Retorna el número de filas encontradas
    return $row_count;
}
	 
/* Obtiene un solo registro de la tabla especificada basado en el ID del tipo de calendario.
 * Ejecuta una consulta SQL SELECT para obtener un solo registro de la tabla especificada (self::$tblname)
 * donde el ID del tipo sea igual a $id.
 * Retorna el registro encontrado como un arreglo asociativo, o null si no se encuentra ningún registro.
 * @param mixed $id El ID del tipo de calendario a buscar.
 * @return array|null El registro encontrado como un arreglo asociativo, o null si no se encuentra ningún registro.*/
function single_tipocalendario($id = "") {
    // Accede al objeto de base de datos global $mydb
    global $mydb;
    // Construye la consulta SQL SELECT para obtener un solo registro de la tabla especificada
    // donde el ID del tipo sea igual a $id, limitando la búsqueda a un solo resultado
    $mydb->setQuery("SELECT * FROM " . self::$tblname . " WHERE id_tipo = {$id} LIMIT 1");
    // Ejecuta la consulta SQL y carga el resultado como un solo registro
    $cur = $mydb->loadSingleResult();
    // Retorna el registro encontrado (un arreglo asociativo) o null si no se encontró ningún registro
    return $cur;
}

/* Crea una nueva instancia del objeto actual y asigna valores de atributos basados en un arreglo dado.
 * Crea una nueva instancia del objeto actual (utilizando "self" para referirse a la clase actual).
 * Itera sobre cada par atributo-valor en el arreglo $record proporcionado.
 * Si el objeto actual tiene el atributo especificado, asigna el valor correspondiente al atributo del objeto.
 * Retorna la instancia del objeto actual con los atributos actualizados.
 * parametro array $record Un arreglo asociativo donde las claves son nombres de atributos y los valores son los valores correspondientes.
 * retorna self una instancia del objeto actual (clase estática) con los atributos actualizados según el arreglo $record.*/
static function instantiate($record) {
    // Crea una nueva instancia del objeto actual
    $object = new self;
    // Itera sobre cada par atributo-valor en el arreglo $record proporcionado
    foreach ($record as $attribute => $value) {
        // Verifica si el objeto actual tiene el atributo especificado
        if ($object->has_attribute($attribute)) {
            // Asigna el valor del atributo al objeto actual
            $object->$attribute = $value;
        }
    }
    // Retorna la instancia del objeto actual con los atributos actualizados
    return $object;
}

/* Verifica si un atributo específico existe en el arreglo de atributos del objeto.
 * Este método privado verifica si un atributo especificado ($attribute) existe como clave en el arreglo
 * de atributos del objeto actual. Utiliza la función array_key_exists() para determinar la existencia del
 * atributo como clave en el arreglo de atributos.
 * parametro string $attribute El nombre del atributo a verificar.
 * retorno bool Devuelve true si el atributo existe como clave en el arreglo de atributos, de lo contrario devuelve false.*/
private function has_attribute($attribute) {
    // No nos importa el valor, solo queremos saber si la clave existe
    // Devolverá true o false
    return array_key_exists($attribute, $this->attributes());
}

/* Retorna un arreglo de nombres de atributos y sus valores del objeto actual.
 * Este método protegido retorna un arreglo asociativo que contiene los nombres de atributos
 * del objeto actual y sus respectivos valores. Utiliza la lista de campos de la base de datos
 * del objeto ($this->dbfields()) para determinar qué atributos incluir en el arreglo.
 * retorno array Un arreglo asociativo donde las claves son nombres de atributos y los valores son los valores correspondientes.*/
protected function attributes() { 
    // Accede al objeto de base de datos global $mydb
    global $mydb;
    // Inicializa un arreglo para almacenar los atributos y sus valores
    $attributes = array();
    // Itera sobre cada campo de la base de datos del objeto
    foreach ($this->dbfields() as $field) {
        // Verifica si el objeto actual tiene una propiedad con el nombre de campo
        if (property_exists($this, $field)) {
            // Asigna el valor de la propiedad al arreglo de atributos con el nombre de campo como clave
            $attributes[$field] = $this->$field;
        }
    }
    // Retorna el arreglo de atributos con nombres y valores
    return $attributes;
}
/*Retorna un arreglo de atributos sanitizados del objeto actual.
 * Este método protegido utiliza el objeto de base de datos global `$mydb` para obtener
 * un arreglo de atributos del objeto actual utilizando el método `attributes()`. Luego,
 * itera sobre estos atributos y aplica la función de escape `escape_value()` del objeto `$mydb`
 * para sanear (limpiar y preparar) los valores antes de ser enviados o utilizados en consultas SQL.
 * retorno array Un arreglo asociativo donde las claves son nombres de atributos y los valores son los valores sanitizados correspondientes.*/
protected function sanitized_attributes() {
    // Accede al objeto de base de datos global $mydb
    global $mydb;
    // Inicializa un arreglo para almacenar los atributos sanitizados
    $clean_attributes = array();
    // Itera sobre cada atributo del objeto actual obtenido mediante el método attributes()
    foreach ($this->attributes() as $key => $value) {
        // Utiliza $mydb->escape_value() para sanear el valor del atributo y almacenarlo en $clean_attributes
        $clean_attributes[$key] = $mydb->escape_value($value);
    }
    // Retorna el arreglo de atributos sanitizados
    return $clean_attributes;
}
	
/*Guarda o actualiza el objeto en la base de datos.
 * Este método público determina si el objeto ya tiene un ID asignado (`$this->id`).
 * Si `$this->id` está definido (es decir, el objeto ya existe en la base de datos),
 * llama al método `update()` para actualizar los datos del objeto en la base de datos.
 * Si `$this->id` no está definido (es decir, el objeto es nuevo y aún no está en la base de datos),
 * llama al método `create()` para insertar un nuevo registro del objeto en la base de datos.
 * retorna bool Devuelve true si la operación de guardar o actualizar fue exitosa, de lo contrario devuelve false.*/
public function save() {
    // Operador ternario: determina si $this->id está definido
    return isset($this->id) ? $this->update() : $this->create();
}

	/*
	* Crea un nuevo registro del objeto en la base de datos.
	* Este método público utiliza el objeto de base de datos global `$mydb` para insertar un nuevo registro
	* del objeto actual en la tabla especificada por `self::$tblname`. Primero, obtiene los atributos sanitizados
	* del objeto llamando al método `sanitized_attributes()`. Luego, construye y ejecuta una consulta SQL de inserción
	* utilizando estos atributos. Finalmente, si la inserción fue exitosa, actualiza el ID del objeto con el ID generado
	* por la base de datos y devuelve true. Si la inserción falla, devuelve false.
	* retorna bool Devuelve true si la inserción del nuevo registro fue exitosa, de lo contrario devuelve false.
	*/
public function create() {
    // Accede al objeto de base de datos global $mydb
    global $mydb;
    // Obtiene los atributos sanitizados del objeto actual
    $attributes = $this->sanitized_attributes();
    // Construye la consulta SQL de inserción
    $sql = "INSERT INTO " . self::$tblname . " (";
    $sql .= join(", ", array_keys($attributes)); // Agrega los nombres de los atributos como columnas
    $sql .= ") VALUES ('";
    $sql .= join("', '", array_values($attributes)); // Agrega los valores de los atributos como valores de inserción
    $sql .= "')";
    // Imprime la consulta SQL (esto puede ser útil para depuración)
    echo $mydb->setQuery($sql);
    // Ejecuta la consulta SQL utilizando el objeto de base de datos $mydb
    if ($mydb->executeQuery()) {
        // Si la consulta se ejecutó correctamente, actualiza el ID del objeto con el ID generado por la base de datos
        $this->id = $mydb->insert_id();
        return true; // Retorna true indicando que la inserción fue exitosa
    } else {
        return false; // Retorna false indicando que la inserción falló
    }
}

/* Actualiza un registro en la base de datos utilizando los atributos sanitizados del objeto.
 * Este método público utiliza el objeto de base de datos global `$mydb` para ejecutar una consulta SQL
 * de actualización en la tabla especificada por `self::$tblname`. Primero, obtiene los atributos sanitizados
 * del objeto llamando al método `sanitized_attributes()`. Luego, construye una lista de pares atributo-valor
 * para usar en la cláusula SET de la consulta SQL de actualización. Finalmente, ejecuta la consulta SQL utilizando
 * `$mydb` y retorna true si la actualización fue exitosa, o false si falló.
 * retorna int $id El ID del registro que se va a actualizar.
 * retorna bool Devuelve true si la actualización del registro fue exitosa, de lo contrario devuelve false.*/
public function update($id = 0) {
    // Accede al objeto de base de datos global $mydb
    global $mydb;
    // Obtiene los atributos sanitizados del objeto actual
    $attributes = $this->sanitized_attributes();
    // Inicializa un arreglo para almacenar los pares atributo-valor
    $attribute_pairs = array();
    // Construye los pares atributo-valor para la consulta SQL de actualización
    foreach ($attributes as $key => $value) {
        $attribute_pairs[] = "{$key}='{$value}'";
    }
    // Construye la consulta SQL de actualización
    $sql = "UPDATE " . self::$tblname . " SET ";
    $sql .= join(", ", $attribute_pairs); // Agrega los pares atributo-valor separados por coma
    $sql .= " WHERE id_tipo =" . $id; // Condición WHERE para actualizar el registro específico
    // Establece la consulta SQL en el objeto de base de datos $mydb
    $mydb->setQuery($sql);
    // Ejecuta la consulta SQL utilizando el objeto de base de datos $mydb
    if (!$mydb->executeQuery()) return false; // Retorna false si la consulta de actualización falla
}

/* Elimina un registro de la base de datos.
 * Este método público utiliza el objeto de base de datos global `$mydb` para ejecutar una consulta SQL
 * de eliminación en la tabla especificada por `self::$tblname`. Construye la consulta SQL de eliminación
 * utilizando el ID proporcionado (`$id`). Luego, ejecuta la consulta SQL utilizando `$mydb` y retorna true
 * si la eliminación fue exitosa, o false si falló.
 * retorna int $id El ID del registro que se va a eliminar.
 * retorna bool Devuelve true si la eliminación del registro fue exitosa, de lo contrario devuelve false.*/
public function delete($id = 0) {
    // Accede al objeto de base de datos global $mydb
    global $mydb;
    // Construye la consulta SQL de eliminación
    $sql = "DELETE FROM " . self::$tblname;
    $sql .= " WHERE id_tipo =" . $id; // Agrega la condición WHERE para eliminar el registro específico
    $sql .= " LIMIT 1 "; // Limita la eliminación a un solo registro (opcional, depende del caso de uso)
    // Establece la consulta SQL en el objeto de base de datos $mydb
    $mydb->setQuery($sql);
    // Ejecuta la consulta SQL utilizando el objeto de base de datos $mydb
    if (!$mydb->executeQuery())return false; // Retorna false si la consulta de eliminación falla
}



}
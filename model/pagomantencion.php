<?php
/* La línea `require_once(__DIR__ ."/../controller/initialize.php");` incluye el archivo
`initialize.php` de una ruta de directorio específica relativa al archivo actual. */
require_once(__DIR__ ."/../controller/initialize.php");
/* La línea `require_once(LIB_PATH_MODEL.DS.'database.php');` incluye el archivo `database.php` de una
ruta de directorio específica definida por la constante `LIB_PATH_MODEL` y la constante separadora
de directorio `DS`. Esta es una práctica común en PHP para incluir archivos o dependencias
necesarias en un script para funciones o definiciones de clases. */
require_once(LIB_PATH_MODEL.DS.'database.php');
/* La `clase PagosMantencion` es una clase PHP que representa un modelo para manejar pagos relacionados
con mantenimiento. Contiene métodos para interactuar con una tabla de base de datos llamada
`tblpagosmantencion`. Aquí hay un resumen de lo que está haciendo la clase: */
class PagoMantencion {
	/* La línea `protected static  = "tblpagosmantencion";` en la clase PHP `PagosMantencion` está
	declarando una propiedad estática protegida llamada `` con el valor `"tblpagosmantencion"`. */
	protected static  $tblname = "tblpagomantencion";
	protected static  $tblinner = " pm
								INNER JOIN tblpersonas per ON pm.id_persona=per.id_persona
								INNER JOIN tblanios a ON a.id_anio=pm.id_anio
								";
	/**
	 * La función `dbfields` recupera los campos de una tabla especificada de la base de datos.
	 * 
	 * retorna La función `dbfields()` devuelve los campos de una tabla especificada por la propiedad
	 * `self::` usando el método `getfieldsononetable()` del objeto ``.
	 */
	function dbfields () {
		global $mydb;
		return $mydb->getfieldsononetable(self::$tblname);

	}
	
	/*
	 * La función "listofpagosmantencion" recupera todos los registros de una tabla de base de datos y los
	 * devuelve como una matriz.
	 * 
	 * retorno se está devolviendo un arreglo de filas que contienen datos de la tabla "pagosmantencion".
	 * Cada fila se representa como una matriz asociativa dentro de la matriz principal.
	 */
	function listofpagomantencion(){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname.self::$tblinner);
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
	/**
	 * La función `find_pagosmantencion` busca registros en una tabla de base de datos basándose en un
	 * número de registro o nombre de propietario y devuelve el recuento de filas coincidentes.
	 * 
	 * parametro id La función `find_pagosmantencion` está diseñada para buscar registros en una tabla de
	 * base de datos en función de los parámetros proporcionados. En este caso, la función toma dos
	 * parámetros:
	 * parametro name La función `find_pagosmantencion` está diseñada para buscar registros en una tabla de
	 * base de datos en función de los parámetros proporcionados.
	 * 
	 * return la función `find_pagosmantencion` devuelve el número de filas que coinciden con los
	 * criterios dados en la tabla de la base de datos especificada por `self::`.
	 */
	function listofpagomantencion_distinct(){
		global $mydb;
		$sql = "
        SELECT pm.*, per.*, a.*
        FROM " . self::$tblname . self::$tblinner . "
        GROUP BY pm.id_persona";
		$mydb->setQuery($sql);
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

	/*Esta función find_pagomantencion() 
	se utiliza para buscar registros en una 
	base de datos basándose en dos criterios 
	posibles: un ID específico ($id) o un nombre
	de propietario ($name). Utiliza un objeto global
	$mydb para construir y ejecutar la consulta SQL, y 
	luego retorna el número total de filas que coinciden
	con los criterios de búsqueda especificados. */
	function find_pagomantencion($id="",$name=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname.self::$tblinner." WHERE pm.id_pago = {$id} OR pm.propietario = '{$name}'");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);
		return $row_count;
	}
	/*Esta función find_pagos_persona() 
	busca en la base de datos registros relacionados
	con los pagos de una persona específica, identificada
	por su $id. Utiliza un objeto global $mydb para construir 
	y ejecutar una consulta SQL, luego retorna un arreglo que 
	contiene todas las filas de resultados recuperadas de la 
	base de datos. Si la consulta falla, registra un mensaje
	de error y retorna falso.*/
	function find_pagos_persona($id=""){
		global $mydb;
		$mydb->setQuery("SELECT DISTINCT * FROM ".self::$tblname.self::$tblinner." WHERE pm.id_persona = {$id} ORDER BY pm.id_anio ASC");
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
	/*Esta función find_pagos_realizados() 
	busca registros en la base de datos basados en los criterios
	opcionales proporcionados: ID de pago ($id) y/o ID de persona
	($id_persona). Utiliza un objeto global $mydb para construir
	y ejecutar una consulta SQL dinámica, luego retorna un arreglo
	que contiene todas las filas de resultados recuperadas de la
	base de datos. Si no se proporcionan criterios de búsqueda, 
	la consulta selecciona todos los registros.*/
	function find_pagos_realizados($id="",$id_persona=""){
		global $mydb;
		$sql= "SELECT * FROM ".self::$tblname.self::$tblinner." 
        WHERE 1=1";
        if ($id !== "") {
            $sql .= " AND pm.id_pago = '{$id}'";
        }
        if ($id_persona !== "") {
            $sql .= " AND pm.id_persona = '{$id_persona}'";
        }
        $mydb->setQuery($sql);
		$cur = $mydb->executeQuery();
        $results= [];
		while ($row = $cur->fetch_assoc()) {
            $results[] = $row;
        }
		return $results;
	}
	
	/*la función find_pagomantenciones busca y devuelve
	 registros de pagos de mantenimientos basados en un 
	 criterio de búsqueda proporcionado, utilizando una 
	 consulta SQL dinámica para filtrar varios 
	 campos de la base de datos. */
	function find_pagomantenciones($where=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname.self::$tblinner." WHERE pm.id_pago Like '%{$where}%' or per.rut Like '%{$where}%' or per.propietario Like '%{$where}%' or per.pnombre Like '%{$where}%' or per.nro_tumba Like '%{$where}%' or pm.fecha_pago Like '%{$where}%' or pm.monto Like '%{$where}%' or pm.estado Like '%{$where}%' GROUP BY pm.id_persona");
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
	
	/*la función single_pagomantencion está diseñada 
	para recuperar y devolver un solo registro de una
	tabla de base de datos según el id_pago proporcionado. */
	function single_pagomantencion($id=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." where id_pago = {$id} LIMIT 1");
		$cur = $mydb->loadSingleResult();
		return $cur;
	}
	
	/*la función instantiate permite crear y configurar
	objetos de la clase actual (self) utilizando datos 
	almacenados en un arreglo asociativo, lo cual es útil
	en escenarios donde se necesita convertir datos externos
	en objetos de modelo dentro de una aplicación PHP */
	static function instantiate($record) {
		$object = new self;

		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		} 
		return $object;
	}
	
	
	/*función privada llamada has_attribute. Esta función 
	verifica si un atributo específico está presente
	en el arreglo de atributos de un objeto. Aquí está el desglose detallado: */
	/*la función has_attribute proporciona una forma segura y controlada de verificar
	la existencia de un atributo específico dentro de un objeto en PHP, utilizando 
	la función array_key_exists para realizar esta verificación en el arreglo de
	atributos del objeto.*/
	private function has_attribute($attribute) {
	 
	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
		// return an array of attribute names and their values
	  global $mydb;
	  /*Se inicializa un arreglo vacío llamado $attributes 
	  que se utilizará para almacenar los nombres de 
	  los atributos y sus valores asociados. */
	  $attributes = array();

	  	/*Utiliza un bucle foreach para iterar sobre los valores
	   	devueltos por $this->dbfields(). Esto asume que dbfields()
	    es un método o una propiedad que devuelve un arreglo con
		los nombres de los campos relevantes de la base de datos
		o de la estructura de la clase. */
	  foreach($this->dbfields() as $field) {
		/*property_exists($this, $field): Esta función verifica si el 
		objeto actual ($this) tiene una propiedad con el nombre especificado 
		por $field. Si la propiedad existe en el objeto, entonces 
		asigna su valor ($this->$field) al arreglo $attributes 
		utilizando $field como clave. */
	    if(property_exists($this, $field)) {
			$attributes[$field] = $this->$field;
		}
	  }
	  	/*Finalmente, devuelve el arreglo $attributes que 
	  	contiene todos los nombres de los atributos y sus
		valores asociados que existen en el objeto actual. */
	  return $attributes;
	}
	
	/*la función sanitized_attributes() proporciona una 
	manera de obtener una copia de los atributos de un objeto 
	con sus valores sanitizados, utilizando un método de escape
	adecuado para garantizar la integridad y seguridad de los datos
	antes de su uso en la aplicación. */
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
	
	
	
	public function save() {
	  
		/*isset($this->id_pago): Verifica si la propiedad 
		$id_pago del objeto actual está definida y no es null.
		Esto se utiliza para determinar si el objeto ya existe
		en la base de datos (es decir, tiene un identificador único asignado).
		Decisión basada en el resultado de isset($this->id_pago):

		Si isset($this->id_pago) devuelve true (es decir, el objeto ya tiene un id_pago asignado), entonces llama al método $this->update().
		Si isset($this->id_pago) devuelve false (es decir, el objeto no tiene un id_pago asignado), entonces llama al método $this->create(). */
	  return isset($this->id_pago) ? $this->update() : $this->create();
	}
	
	public function create() {
		/*instancia a la base de datos */
		global $mydb;
		/*sanitized_attributes() del objeto actual para 
		obtener un arreglo de atributos sanitizados. Estos atributos 
		están preparados para ser utilizados en la consulta SQL de inserción. */
		$attributes = $this->sanitized_attributes();

		/*self::$tblname se asume que es una propiedad estática
		que contiene el nombre de la tabla donde se realizará la inserción.
		array_keys($attributes) devuelve un arreglo con los nombres 
		de los atributos sanitizados, que se unen con join(", ", ...) 
		para formar la lista de columnas en la consulta INSERT INTO.
		array_values($attributes) devuelve un arreglo con los valores 
		sanitizados de los atributos, que se unen con join("', '", ...) para 
		formar la lista de valores en la consulta INSERT INTO. */
		$sql = "INSERT INTO ".self::$tblname." (";
		$sql .= join(", ", array_keys($attributes));
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
		/*setQuery($sql) establece la consulta SQL construida 
		en el objeto de base de datos $mydb. La función echo 
		aquí parece ser un intento de depuración para mostrar
		la consulta SQL que se va a ejecutar. */
		echo $mydb->setQuery($sql);
	/*executeQuery() ejecuta la consulta SQL contra la base de datos. 
	Si la inserción tiene éxito (executeQuery() devuelve true), se 
	asigna el ID generado por la base de datos (insert_id()) a la
	propiedad $id_pago del objeto actual.
	Se devuelve true para indicar que la inserción fue exitosa.
	Si la inserción falla, executeQuery() devolverá false y se devuelve false desde la función create(). */
	 if($mydb->executeQuery()) {
	    $this->id_pago = $mydb->insert_id();
	    return true;
	  } else {
	    return false;
	  }
	}
	/*El propósito de este método es ejecutar una consulta SQL 
	para actualizar un registro en la base de datos con los valores 
	de los atributos del objeto actual. */
	public function update($id_pago=0) {
	  global $mydb;
		$attributes = $this->sanitized_attributes();

		/*Itera sobre los atributos sanitizados y construye 
		pares clave-valor en formato "clave='valor'". Esto prepara 
		la parte de la consulta SQL que actualiza los valores de los atributos. */
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}

		/*self::$tblname se asume que es una propiedad
		estática que contiene el nombre de la tabla donde se 
		realizará la actualización.
		join(", ", $attribute_pairs) une los pares clave-valor 
		del arreglo $attribute_pairs con comas para formar la lista 
		de asignaciones en la consulta UPDATE.
		WHERE id_pago = $id_pago asegura que la actualización se 
		realice solo en el registro con el id_pago especificado. */

		$sql = "UPDATE ".self::$tblname." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE id_pago =". $id_pago;

		/*setQuery($sql) establece la consulta SQL construida 
		en el objeto de base de datos $mydb.
		executeQuery() ejecuta la consulta SQL contra la base de datos. 
		Si la ejecución falla (executeQuery() devuelve false), se devuelve 
		false desde el método update() para indicar que 
		la actualización no fue exitosa. */
	  $mydb->setQuery($sql);
	 	if(!$mydb->executeQuery()) return false; 	
		
	}

	/*función para eliminar registros de la base de datos 
	y un manejo de solicitudes AJAX para buscar y manipular
	datos relacionados con pagos y años pagados. */

	public function delete($id=0) {
		global $mydb;

		/*$sql = "DELETE FROM ".self::$tblname;: self::$tblname se asume 
		que es una propiedad estática que contiene el nombre 
		de la tabla donde se realizará la eliminación.
		$sql .= " WHERE id_pago =". $id;: Concatena el filtro WHERE 
		para especificar que se elimine el registro donde el id_pago 
		sea igual al valor pasado como parámetro $id.
		$sql .= " LIMIT 1 ";: Añade LIMIT 1 para asegurarse de que solo
		se elimine un solo registro, aunque debería ser innecesario si 
		id_pago es una clave primaria única. */
		  $sql = "DELETE FROM ".self::$tblname;
		  $sql .= " WHERE id_pago =". $id;
		  $sql .= " LIMIT 1 ";

		/*$mydb->setQuery($sql);: Establece la consulta SQL construida 
		en el objeto de base de datos $mydb.
		if(!$mydb->executeQuery()) return false;: Ejecuta la consulta 
		SQL y devuelve false si la operación de eliminación falla. */
		  $mydb->setQuery($sql);
		  
			if(!$mydb->executeQuery()) return false; 	
	
	}	


}

// Manejo de solicitudes AJAX
if (isset($_POST['find_pago'])) {
    $id_pago = $_POST['id_pago'];
    $id_persona = $_POST['id_persona'];
	if ($id_pago == 0){
		$id_pago = "";
	}
	$pago = new PagoMantencion();
	$resultados = $pago->find_pagos_realizados($id_pago, $id_persona);
	echo json_encode($resultados);
    exit;
}

	/*Esta parte del código maneja una solicitud POST 
	con los parámetros id_pago e id_persona. Llama al 
	método find_pagos_realizados() de la clase PagoMantencion 
	para encontrar los pagos realizados basados en los parámetros 
	proporcionados y devuelve los resultados como JSON.
	Solicitud para encontrar años pagados (find_anios_pagados):

	Esta sección maneja una solicitud POST para encontrar años pagados.
	Divide una cadena de id_pagos en un arreglo, y luego compara estos
	años con los años obtenidos del método list_of_anio() de la
	clase Anio. Se generan opciones HTML basadas en si cada año está pagado o no. */
	// Manejo de solicitudes AJAX

if (isset($_POST['find_anios_pagados'])) {
	/* verifica que la lista no este vacia o que contenga datos si encuentra datos 
	ejecuta la accion $pagos_array 
	sino envia la lista vacia*/
	if (!empty($_POST['id_pagos'])) {
		$pagos_array = explode(",",$_POST['id_pagos']);
	} else {
		$pagos_array = array();
	}
    $anios = new Anio();
	$cur = $anios->list_of_anio();
	echo "console.log(".json_encode($cur).")";
    foreach ($cur as $result) {
        $encontrado = false;
        foreach ($pagos_array as $anio_result) {
            if ($result['id_anio'] == $anio_result) {
                $encontrado = true;
                break;
                
            }
        }
        if ($encontrado) {
            echo '<option value="' . $result['id_anio'] . '" class="option" disabled>' . $result['id_anio'] . ' Pagado </option>';
        }else {
            echo '<option value="' . $result['id_anio'] . '" class="option">' . $result['id_anio'] . '</option>';
        }
    }
}
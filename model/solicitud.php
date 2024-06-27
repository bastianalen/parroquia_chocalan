<?php
require_once(__DIR__ ."/../controller/initialize.php");
// require_once(LIB_PATH_MODEL.DS.'database.php');
class Solicitud {
	// Nombre de la tabla principal para las solicitudes.
	protected static  $tblname = "tblsolicitudes";
	/*Tablas internas para realizar JOINs en consultas SQL.
 	Incluye JOINs con tablas de estado de solicitud, hora de solicitud y tipo de servicio. */
	protected static  $innertbl = " ts INNER JOIN tblestadosolicitud tes ON ts.estado = tes.id_estado 
								  INNER JOIN tblhorasolicitud ths ON ts.hora_solicitud = ths.id_hora 
								  INNER JOIN tbltiposervicio tts ON ts.tipo_servicio = tts.id_servicio";
	//se declara la funcion dbfields()
	function dbfields () {
		//se llama la a la variable $mydb que contiene configuraciones y conexion a la base de datos
		global $mydb;
		// retorno por la variable $mydb  que captura fieldsonenable y los $tblname.
		return $mydb->getfieldsononetable(self::$tblname);

	}
	/* Se declara la funcion list_of_solicitud donde se realiza una consulta*/ 
	function list_of_solicitud(){
		global $mydb;
		/*se realiza una consulta a $mydb que contiene la consulta que une con innertbl */
		$mydb->setQuery("SELECT * FROM ".self::$tblname.self::$innertbl);
		/*se declara en la variable $cur la consuta que se esta haciendo a $mydb y ejecuta la Query */
		$cur = $mydb->executeQuery();
		/*si la variable  $cur no encuentra datos al realizar la consulta
		devuelve un error y un valor booleano false */
		if (!$cur) {
			// Manejo de errores
			error_log("Error executing query: " . $mydb->error);
			return false;
		}
		/*Se almacenan los resultados en un array dentro de la variable $resul */
		$result = [];
		/*while recore las columnas contenidas en $cur y asigna los resultados
		a la variable $row */
		while ($row = $cur->fetch_assoc()) {
			/*se asignan los resultados contenidos en la variable $row en un array 
			dentro de la variable $resul[]
			 */
			$result[] = $row;
		}
		//retorno del array en la variable $result
		return $result;
	}
	/*Se declara la funcion find_solicitud que contiene $id y $fecha*/
	/*Esta función permite buscar solicitudes en una tabla de base de datos filtrando opcionalmente por id_solicitud y/o 
	fecha_solicitud. Dependiendo de si se proporcionan los parámetros $id y/o $fecha, se construye dinámicamente una consulta 
	SQL que luego se ejecuta contra la base de datos. Los resultados se devuelven como un array de arrays asociativos, donde cada
	 elemento del array representa una fila de resultados. */
	function find_solicitud($id="", $fecha="") {
		// Accede a la variable global $mydb (probablemente un objeto de base de datos)
		global $mydb;
		// Construye la consulta SQL base
		$sql = "SELECT * FROM " . self::$tblname . " WHERE 1=1";
		// Agrega condición a la consulta si se proporciona el parámetro $id
		if ($id !== "") {
			$sql .= " AND id_solicitud = '{$id}'";
		}
		// Agrega condición a la consulta si se proporciona el parámetro $fecha
		if ($fecha !== "") {
			$sql .= " AND fecha_solicitud = '{$fecha}'";
		}
		// Establece la consulta SQL en el objeto de base de datos
		$mydb->setQuery($sql);
		// Ejecuta la consulta y obtiene el resultado
		$cur = $mydb->executeQuery();
		// Inicializa un array para almacenar los resultados
		$results= [];
		// Itera sobre cada fila obtenida y la agrega al array de resultados
		while ($row = $cur->fetch_assoc()) {
			$results[] = $row;
		}
		// Retorna el array de resultados
		return $results;
		}
	/*Esta función single_solicitud se utiliza para recuperar una sola solicitud de una base de datos
	basada en su id_solicitud. Utiliza una consulta SQL SELECT para seleccionar la fila correspondiente 
	a ese ID específico. El resultado se devuelve directamente como una sola entidad (un array asociativo o un objeto), 
	lo que facilita la recuperación y el uso directo de los datos de esa solicitud específica en el código que llama a esta función. */
	function single_solicitud($id="") {
		// Accede a la variable global $mydb (probablemente un objeto de base de datos)
		global $mydb;
		// Construye la consulta SQL para seleccionar una sola solicitud por su ID
		$mydb->setQuery("SELECT * FROM " . self::$tblname . self::$innertbl . " WHERE id_solicitud = '{$id}' LIMIT 1");
		// Ejecuta la consulta y carga el resultado como una única fila
		$cur = $mydb->loadSingleResult();
		// Retorna la fila obtenida (o NULL si no hay resultados)
		return $cur;
	}
	
	/*Este método estático instantiate se utiliza para crear una instancia del objeto de la clase actual y
	luego inicializar sus atributos utilizando los datos proporcionados en el array $record. Es útil en 
	situaciones donde se necesita crear y poblar objetos de una clase con datos obtenidos de una fuente externa,
	como una base de datos o un servicio web. La función has_attribute juega un papel crucial al asegurarse de
	que solo se asignen valores a atributos que realmente existen en la clase, evitando errores de asignación
	o de tipo en tiempo de ejecución. */
	static function instantiate($record) {
		// Crea una nueva instancia del objeto actual (self se refiere a la propia clase)
		$object = new self;
	
		// Itera sobre cada par clave-valor en el array $record
		foreach($record as $attribute => $value) {
			// Verifica si la instancia actual tiene un atributo con el nombre $attribute
			if ($object->has_attribute($attribute)) {
				// Asigna el valor $value al atributo $attribute del objeto
				$object->$attribute = $value;
			}
		} 
	
		// Retorna el objeto instanciado con los valores asignados
		return $object;
	}
	
	
	/*Este método has_attribute es utilizado para comprobar si un atributo específico existe en el contexto
	del objeto actual. Es útil en clases que gestionan datos dinámicos o que interactúan con estructuras de datos
	(como arrays asociativos) donde es necesario verificar la existencia de ciertos atributos antes de acceder a ellos o manipularlos.
	Al ser un método privado, su alcance está limitado a la misma clase donde se define, lo que significa que solo
	los métodos dentro de esa clase pueden llamar a has_attribute para realizar esta verificación. Esto ayuda a encapsular
	la lógica de verificación de atributos dentro de la clase y mantener una interfaz pública más limpia y coherente para
	el acceso y manipulación de datos. */
	private function has_attribute($attribute) {
		// Retorna true si la clave $attribute existe en el array devuelto por $this->attributes()
		return array_key_exists($attribute, $this->attributes());
	}
	/*Este método attributes se utiliza para obtener un array que representa los atributos válidos y sus valores
	asociados de la instancia actual de la clase. Es útil en situaciones donde se necesita acceder a todos 
	los atributos definidos dinámicamente en una instancia de objeto, como en modelos de datos o clases ORM (Object-Relational Mapping).
	Global $mydb: En este contexto, parece estar presente pero no está siendo utilizado directamente en la
	lógica del método. Es posible que esté preparado para utilizar en versiones futuras */
		protected function attributes() {
		// Accede a la variable global $mydb (probablemente un objeto de base de datos)
		global $mydb;
		// Inicializa un array vacío para almacenar los atributos
		$attributes = array();
		// Itera sobre cada campo obtenido del método dbfields() de la clase actual
		foreach ($this->dbfields() as $field) {
			// Verifica si la propiedad $field existe en la instancia actual (this)
			if (property_exists($this, $field)) {
				// Asigna al array $attributes el nombre del campo como clave y su valor correspondiente
				$attributes[$field] = $this->$field;
			}
		}
		// Retorna el array $attributes que contiene los atributos válidos de la instancia actual
		return $attributes;
	}
	
	/*Este método sanitized_attributes se utiliza para obtener un array que representa los atributos
	de la instancia actual con valores escapados o sanitizados. El proceso de escape se realiza utilizando
	el método escape_value() del objeto de la base de datos ($mydb), que debería estar diseñado para manejar
	adecuadamente los caracteres especiales y las consultas SQL seguras.
	Uso de $mydb->escape_value($value): Este método es crucial para asegurar que los datos ingresados en la base de datos estén
	correctamente formateados y protegidos contra intentos maliciosos de manipulación de datos. Es común en aplicaciones web que
	manejan datos de entrada del usuario y necesitan prevenir ataques de inyección SQL. */
	protected function sanitized_attributes() {
		// Accede a la variable global $mydb (un objeto de base de datos)
		global $mydb;
		// Inicializa un array vacío para almacenar los atributos sanitizados
		$clean_attributes = array();
		// Itera sobre cada atributo obtenido del método attributes() de la instancia actual
		foreach ($this->attributes() as $key => $value) {
			// Usa el método escape_value() de $mydb para escapar el valor de cada atributo
			$clean_attributes[$key] = $mydb->escape_value($value);
		}
		// Retorna el array $clean_attributes que contiene los atributos sanitizados
		return $clean_attributes;
	}
	
	
	/*save() es un método clave en la manipulación de objetos dentro de una aplicación PHP orientada a objetos, 
	permitiendo una gestión eficiente y clara de las operaciones CRUD (Crear, Leer, Actualizar, Eliminar) en la base de datos */
	public function save() {
    // Si el atributo $this->id está definido (existe un ID), llama al método update()
    // de lo contrario, llama al método create()
    return isset($this->id) ? $this->update() : $this->create();
}
/*se declara la funcion create
create() es un método fundamental en la lógica de operaciones CRUD en aplicaciones PHP orientadas a objetos */
public function create() {
    global $mydb;
    // Obtiene los atributos sanitizados del objeto actual
    $attributes = $this->sanitized_attributes();
    // Construye la consulta SQL de inserción
    $sql = "INSERT INTO " . self::$tblname . " (";
    $sql .= join(", ", array_keys($attributes)); // Obtiene los nombres de los atributos como columnas
    $sql .= ") VALUES ('";
    $sql .= join("', '", array_values($attributes)); // Obtiene los valores de los atributos
    $sql .= "')";
    // Establece la consulta SQL en el objeto de la base de datos ($mydb)
    $mydb->setQuery($sql);
    // Ejecuta la consulta SQL
    if ($mydb->executeQuery()) {
        // Si la inserción fue exitosa, establece el ID generado automáticamente
        $this->id = $mydb->insert_id();
        return true; // Retorna verdadero para indicar éxito en la operación de creación
    } else {
        return false; // Retorna falso si la inserción falló
    }
}

/*Se declara la funcion Update */
public function update($id = 0) {
    global $mydb;
    // Obtiene los atributos sanitizados del objeto actual
    $attributes = $this->sanitized_attributes();
    // Inicializa un array para almacenar pares atributo-valor para la actualización
    $attribute_pairs = array();
    // Construye pares atributo-valor para la actualización
    foreach ($attributes as $key => $value) {
        $attribute_pairs[] = "{$key}='{$value}'";
    }
    // Construye la consulta SQL de actualización
    $sql = "UPDATE " . self::$tblname . " SET ";
    $sql .= join(", ", $attribute_pairs); // Une los pares atributo-valor con comas
    // Añade la condición WHERE para especificar el registro a actualizar
    $sql .= " WHERE id_solicitud=" . $id;
    // Establece la consulta SQL en el objeto de la base de datos ($mydb)
    $mydb->setQuery($sql);
    // Ejecuta la consulta SQL
    if (!$mydb->executeQuery()) return false; // Retorna falso si la actualización falló
    
}
/*public function delete($id = 0) {: Define un método público llamado delete() que acepta
 un parámetro opcional $id. Este método se utiliza para eliminar un registro en la base de datos. */
public function delete($id = 0) {
    global $mydb;
    
    // Construye la consulta SQL para eliminar el registro
    $sql = "DELETE FROM " . self::$tblname;
    $sql .= " WHERE id_solicitud=" . $id;
    $sql .= " LIMIT 1";
    
    // Establece la consulta SQL en el objeto de la base de datos ($mydb)
    $mydb->setQuery($sql);
    
    // Ejecuta la consulta SQL
    if (!$mydb->executeQuery()) {
        return false; // Retorna falso si la eliminación falló
    }
}
}

// Manejo de solicitudes AJAX
if (isset($_POST['find_solicitud'])) {
    $id_solicitud = $_POST['id_solicitud'];
	if ($id_solicitud == 0){
		$id_solicitud = "";
	}
	$fecha = $_POST['fecha'];
	$solicitud = new Solicitud();
	$resultados = $solicitud->find_solicitud($id_solicitud, $fecha);
	echo json_encode($resultados);
    exit;
}


// Manejo de solicitudes AJAX
if (isset($_POST['find_solicitud_horas'])) {
	if (!empty($_POST['id_horas'])) {
		$hora_array = explode(",",$_POST['id_horas']);
	} else {
		$hora_array = array();
	}

    $mydb->setQuery("SELECT * FROM tblhorasolicitud");
    $cur = $mydb->loadResultList();
    foreach ($cur as $result) {
        $encontrado = false;
        foreach ($hora_array as $hora) {
            if ($result->id_hora == $hora) {
                $encontrado = true;
                break;
                
            }
        }
        if ($encontrado) {
            echo '<option value="' . $result->id_hora . '" class="option" disabled>' . $result->hora . ' Tomada </option>';
        }else {
            echo '<option value="' . $result->id_hora . '" class="option">' . $result->hora . '</option>';
        }
    }
}
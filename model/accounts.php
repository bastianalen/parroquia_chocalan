<?php

/* La línea `require_once(__DIR__ ."/../controller/initialize.php");` incluye el archivo
`initialize.php` del directorio `controller` que se encuentra un nivel por encima del directorio
actual del script. La constante `__DIR__` representa el directorio del archivo actual, y al usar
`../` estamos navegando hacia arriba un nivel en la estructura del directorio antes de acceder al
archivo `initialize.php`. Esta declaración garantiza que el código de inicialización y las
configuraciones necesarias de `initialize.php` se carguen antes de que se ejecute el resto del
código en el script PHP. */
require_once(__DIR__ ."/../controller/initialize.php");
/* La línea `require_once(LIB_PATH_MODEL.DS.'database.php');` incluye el archivo `database.php` de una
ruta específica definida por la constante `LIB_PATH_MODEL` concatenada con la constante separadora
de directorio `DS`. */
require_once(LIB_PATH_MODEL.DS.'database.php');
/* La `clase Usuario` en el código PHP proporcionado es una clase modelo que representa una entidad de
usuario en la aplicación. Aquí hay un desglose de lo que está haciendo la clase: */
class User {
	/* La línea `protected static  = "tblcuentauser";` en el fragmento de código PHP define una
	propiedad estática protegida dentro de la clase `Usuario`. Esta propiedad contiene el nombre de la
	tabla de la base de datos asociada con la clase `Usuario`, específicamente la tabla denominada
	"tblcuentauser". */
	protected static  $tblname = "tblcuentauser";
	/* La línea `protected static  = " tcu INNER JOIN tblroluser tru ON tcu.id_rol = tru.id_rol
	";` en el fragmento de código PHP proporcionado define una propiedad estática protegida dentro de
	la clase `Usuario`. Esta propiedad contiene un valor de cadena que representa una operación SQL
	JOIN entre dos tablas de base de datos `tblcuentauser` (alias `tcu`) y `tblroluser` (alias `tru`)
	según la condición de que la columna `id_rol` en `tcu `es igual a la columna `id_rol` en `tru`. */

	protected static  $innertbl = " tcu INNER JOIN tblroluser tru ON tcu.id_rol = tru.id_rol ";
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
	/* La función `listofuser()` en el código PHP proporcionado es responsable de obtener una lista de
	usuarios de la base de datos. A continuación se muestra un desglose de lo que hace la función: */
	function listofuser(){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname.self::$innertbl);
		$cur = $mydb->executeQuery();
		/* El bloque de código `if (!) { ... }` en el script PHP proporcionado maneja errores
		relacionados con la ejecución de una consulta de base de datos. Aquí hay un desglose de lo que
		hace: */
		if (!$cur) {
			// Manejo de errores
			error_log("Error executing query: " . $mydb->error);
			return false;
		}
		/* En el fragmento de código PHP proporcionado, la línea ` = [];` está inicializando una
		matriz vacía llamada ``. Esta sintaxis es específica de PHP 5.4 y versiones posteriores,
		donde las matrices vacías se pueden declarar usando corchetes `[]` en lugar de usar la
		construcción `array()`. */
		$result = [];
		/* La línea ` while ( = ->fetch_assoc()) {` en el fragmento de código PHP proporcionado es
		parte de un bucle que itera sobre el conjunto de resultados obtenido al ejecutar una consulta de
		base de datos. Aquí hay un desglose de lo que hace: */
		while ($row = $cur->fetch_assoc()) {
			/* En el fragmento de código PHP proporcionado, la línea `[] = ;` agrega la matriz
			asociativa `` al final de la matriz ``. */
			$result[] = $row;
		}

		return $result;
	}
 	/**
	 * La función `find_user` en PHP busca un usuario en una tabla de base de datos según su ID de usuario
	 * o nombre de usuario y devuelve el número de filas coincidentes.
	 * 
	 * parametro id La función `find_user` está diseñada para buscar un usuario en una tabla de base de datos
	 * según los parámetros proporcionados. La función toma dos parámetros:
	 * parametro user_name La función `find_user` que proporcionó se utiliza para buscar un usuario basándose
	 * en su `user_id` o `user_nom` (asumiendo que `user_nom` es el campo de nombre de usuario). La
	 * función toma dos parámetros, `` y ``, que pueden usarse para buscar
	 * 
	 * retorna La función `find_user` devuelve el número de filas que coinciden con el ID de usuario o el
	 * nombre de usuario dado en la tabla de la base de datos.
	 */
	function find_user($id="",$user_name=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname.self::$innertbl." 
			WHERE user_id = {$id} OR user_nom = '{$user_name}'");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);
		return $row_count;
	}
	/* La `función estática userAuthentication(,){` en el código PHP proporcionado es
	un método estático dentro de la clase `User` que es responsable de autenticar a un usuario según el
	nombre de usuario y la contraseña proporcionados. */
	static function userAuthentication($user_nom,$user_contra){
		global $mydb;
		/* La línea `->setQuery("SELECT * FROM tblcuentauser WHERE user_nom = '".  ."' and
		user_contra = '".  ."'");` está configurando una consulta SQL para seleccionar todas
		las columnas (`*`) de la tabla denominada `tblcuentauser` donde la columna `user_nom` coincide con
		el valor de la variable `` y la columna `user_contra` coincide con el valor de la
		variable ``. */
		$mydb->setQuery("SELECT * FROM tblcuentauser WHERE user_nom = '". $user_nom ."' and user_contra = '". $user_contra ."'");
		/* La línea ` = ->executeQuery();` en el código PHP proporcionado ejecuta una consulta de
		base de datos utilizando el objeto de conexión de base de datos `` y almacena el conjunto de
		resultados en la variable ``. Esta línea se usa normalmente después de configurar la consulta
		usando `->setQuery("SQL_QUERY_HERE");` para enviar la consulta al servidor de la base de
		datos para su ejecución. */
		$cur = $mydb->executeQuery();
		/* El fragmento de código `if(==false){
			morir(mysql_error());
		}` es una declaración condicional en PHP que verifica si la variable `` es igual a `false`. Si
		esta condición es verdadera, ejecuta la función `die()` con `mysql_error()` como argumento. */
		if($cur==false){
			/* La línea `die(mysql_error());` en el código PHP proporcionado se utiliza para finalizar
			inmediatamente la ejecución del script y mostrar el mensaje de error generado por la base de
			datos MySQL. */
			die(mysql_error());
		}
		/* El bloque de código que proporcionó es parte del método `userAuthentication` dentro de la clase
		`User` en PHP. Analicemos lo que hace este código: */
		$row_count = $mydb->num_rows($cur);//get the number of count
		 if ($row_count == 1){
		 $user_found = $mydb->loadSingleResult();
		 	$_SESSION['user_id']   		= $user_found->user_id;
		 	$_SESSION['nombre']      	= $user_found->nombre;
		 	$_SESSION['user_nom'] 	= $user_found->user_nom;
		 	$_SESSION['user_contra'] 		= $user_found->user_contra;
		 	$_SESSION['id_rol'] 		= $user_found->id_rol;
		   return true;
		 }else{
		 	return false;
		 }
	}
	/**
	 * Esta función PHP recupera los datos de un único usuario en función del ID de usuario proporcionado.
	 * 
	 * parametro id La función `single_user` es una función PHP que recupera un registro de usuario único de
	 * una tabla de base de datos según el `id` proporcionado. La función toma un parámetro opcional
	 * ``, que se utiliza para especificar el ID de usuario para el cual se debe recuperar el registro.
	 * 
	 * retorna La función `single_user` devuelve una sola fila de datos de la tabla de la base de datos
	 * especificada por `self::` donde la columna `user_id` coincide con el `` proporcionado.
	 * La función utiliza el `` proporcionado para recuperar un único registro de usuario de la base de
	 * datos y lo devuelve como una matriz asociativa.
	 */
	function single_user($id=""){
			global $mydb;
			$mydb->setQuery("SELECT * FROM ".self::$tblname." 
				Where user_id= '{$id}' LIMIT 1");
			$cur = $mydb->loadSingleResult();
			return $cur;
	}
	/**
	 * Esta función PHP recupera una función de usuario única según el ID de función proporcionado.
	 * 
	 * parametro id_rol La función `single_user_rol` se utiliza para recuperar un rol de usuario único basado
	 * en el `id_rol` proporcionado. La función consulta la tabla de la base de datos especificada por
	 * `self::` para obtener el rol del usuario con el `id_rol` dado y devuelve el resultado.
	 * 
	 * retorna La función `single_user_rol(="")` devuelve una sola fila de datos de la tabla de la
	 * base de datos especificada por `self::` donde la columna `id_rol` coincide con el valor
	 * `` proporcionado. La función limita el resultado a una sola fila usando `LIMIT 1`.
	 */
	function single_user_rol($id_rol=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." 
			Where id_rol= '{$id_rol}' LIMIT 1");
		$cur = $mydb->loadSingleResult();
		return $cur;
	}
	/* El código PHP anterior es un método estático dentro de una clase que se utiliza para crear una
	instancia de un objeto y establecer sus atributos en función de los valores proporcionados en la
	matriz . Recorre cada par clave-valor en la matriz , verifica si el objeto tiene un
	atributo con el mismo nombre que la clave y, si lo tiene, establece el atributo del objeto en el
	valor correspondiente de la matriz . . Finalmente, devuelve el objeto instanciado con los
	atributos establecidos. */
	static function instantiate($record) {
		$object = new self;

		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		} 
		return $object;
	}
	/**
	 * La función `has_attribute` comprueba si existe una clave específica en la matriz de atributos y
	 * devuelve verdadero o falso según el resultado.
	 * 
	 * parametro attribute La función `has_attribute` es una función privada que verifica si existe un
	 * atributo específico en la matriz de atributos del objeto actual. La función toma un parámetro
	 * ``, que es la clave cuya existencia queremos verificar en la matriz de atributos.
	 * 
	 * retorna La función `has_attribute` devuelve un valor booleano (verdadero o falso) en función de si
	 * la clave de atributo especificada existe en la matriz de atributos.
	 */
	private function has_attribute($attribute) {
	  /* El código anterior es una función PHP que verifica si un atributo determinado existe en la matriz
	  de atributos devueltos por el método `attributes()` del objeto actual. Utiliza la función
	  `array_key_exists()` para realizar esta verificación y devuelve un valor booleano que indica si
	  el atributo existe o no. */
	  return array_key_exists($attribute, $this->attributes());
	}
	/**
	 * La función `atributos()` devuelve una matriz de nombres de atributos y sus valores basados en los
	 * campos de la base de datos del objeto.
	 * 
	 * retorna La función `attributes()` devuelve una matriz de nombres de atributos y sus valores.
	 */
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
	/* El código anterior es una función PHP que probablemente sea parte de una clase. Se llama
	"sanitized_attributes" y está marcado como "protegido", lo que significa que solo se puede acceder
	a él dentro de la clase o sus subclases. La función es responsable de desinfectar los atributos, lo
	que generalmente implica limpiar y validar los datos de entrada para evitar vulnerabilidades de
	seguridad como la inyección SQL o ataques de secuencias de comandos entre sitios (XSS). Sin
	embargo, la implementación real de la desinfección de atributos no se muestra en el fragmento de
	código proporcionado. */
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
	
	
	/*--Crear metodos create y update--*/
	public function save() {
	  // A new record won't have an id yet.
	  return isset($this->id) ? $this->update() : $this->create();
	}
	


	/*public function create(): Define un método público llamado create(). Este método probablemente esté destinado a insertar un nuevo registro en la base de datos.

global $mydb;: Hace referencia a una variable global llamada $mydb. Esto sugiere que $mydb es un objeto que maneja la conexión y las consultas a la base de datos. Es una práctica común en PHP utilizar una variable global para acceder a un objeto de base de datos.

$attributes = $this->sanitized_attributes();: Llama al método sanitized_attributes() de la instancia actual de la clase para obtener un array asociativo de atributos del objeto, probablemente después de haber sido sanitizados (limpiados y validados).

Construcción de la consulta SQL:

$sql = "INSERT INTO ".self::$tblname." (: Comienza a construir la consulta SQL de inserción, utilizando self::$tblname` para referirse al nombre de la tabla asociada a esta clase.
$sql .= join(", ", array_keys($attributes));: Agrega los nombres de las columnas (atributos) al SQL. Usa array_keys($attributes) para obtener un arreglo con los nombres de los atributos como columnas.
$sql .= ") VALUES ('";: Completa la parte inicial de la sentencia SQL para la inserción de datos.
$sql .= join("', '", array_values($attributes));: Agrega los valores de los atributos al SQL. Utiliza array_values($attributes) para obtener un arreglo con los valores de los atributos.
$sql .= "')";: Completa la sentencia SQL de inserción.
echo $mydb->setQuery($sql);: Imprime la consulta SQL generada. Esto puede ser útil para propósitos de depuración o seguimiento, pero en producción normalmente no se haría así.

Ejecución de la consulta:

if($mydb->executeQuery()) { ... } else { ... }: Llama al método executeQuery() en $mydb, que ejecuta la consulta SQL generada anteriormente.
$mydb->insert_id(): Si la inserción fue exitosa (executeQuery() retorna verdadero), se utiliza $mydb->insert_id() para obtener el ID generado automáticamente por la base de datos (si aplica, por ejemplo, para columnas autoincrementales en MySQL).
$this->id = $mydb->insert_id();: Asigna el ID generado a la propiedad id del objeto actual.
return true;: Retorna verdadero para indicar que la inserción fue exitosa.
return false;: Retorna falso si la inserción no fue exitosa.
En resumen, este método create() realiza lo siguiente:

Construye una consulta SQL de inserción basada en los atributos de la instancia actual de la clase.
Utiliza un objeto de base de datos ($mydb) para ejecutar la consulta SQL.
Retorna verdadero si la inserción fue exitosa, asignando el ID generado a la instancia del objeto. Retorna falso si no lo fue.
Es importante destacar que este código asume que $mydb está correctamente configurado para manejar la conexión a la base de datos y las consultas SQL de manera segura para evitar ataques de inyección SQL. */
	public function create() {
		global $mydb;
		/* se llama la funcion attributes para devolver los valores de un array con los atributos
		del objeto*/ 
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
/* public function update($id=0): Define un método público llamado update() que acepta un parámetro opcional $id. Este $id generalmente sería el identificador único del registro que se desea actualizar en la base de datos.

global $mydb;: Al igual que en el primer código, hace referencia a una variable global llamada $mydb que presumiblemente contiene el objeto de conexión a la base de datos y métodos relacionados.

$attributes = $this->sanitized_attributes();: Llama al método sanitized_attributes() de la instancia actual de la clase para obtener un array asociativo de atributos del objeto, probablemente después de haber sido sanitizados.

Construcción de los pares clave-valor para la actualización:

$attribute_pairs = array();: Inicializa un arreglo $attribute_pairs donde se almacenarán las claves y valores de los atributos formateados para la consulta SQL.
foreach($attributes as $key => $value) { ... }: Itera sobre el arreglo de atributos ($attributes) para construir pares clave-valor en el formato "clave='valor'". Esto prepara los datos para la actualización en la consulta SQL.
Construcción de la consulta SQL de actualización:

$sql = "UPDATE ".self::$tblname." SET ";: Inicia la construcción de la consulta SQL de actualización utilizando el nombre de tabla almacenado en self::$tblname.
$sql .= join(", ", $attribute_pairs);: Agrega los pares clave-valor formateados al SQL separados por comas para especificar qué campos y valores se actualizarán.
$sql .= " WHERE user_id=". $id;: Agrega una cláusula WHERE a la consulta SQL para especificar que el registro a actualizar debe tener un ID específico ($id).
Ejecución de la consulta SQL:

$mydb->setQuery($sql);: Establece la consulta SQL construida en el objeto de base de datos $mydb.
if(!$mydb->executeQuery()) return false;: Ejecuta la consulta SQL mediante $mydb->executeQuery(). Si la ejecución de la consulta falla (retorna falso), el método update() también retorna falso, indicando que la actualización no fue exitosa.
Diferencias con el código anterior:
Propósito:

El primer código (create()) está diseñado para insertar un nuevo registro en la base de datos.
El segundo código (update()) está diseñado para actualizar un registro existente en la base de datos.
Consulta SQL:

En create(), se construye una consulta de inserción (INSERT INTO ... VALUES ...).
En update(), se construye una consulta de actualización (UPDATE ... SET ... WHERE ...).
Manejo de atributos:

En create(), se utilizan los atributos de la instancia actual para construir los valores a insertar.
En update(), también se utilizan los atributos de la instancia actual para construir los pares clave-valor a actualizar.
Retorno:

create() retorna verdadero si la inserción es exitosa y falso si falla.
update() retorna falso si la actualización falla, pero no hay un manejo explícito para un caso de éxito en el código proporcionado.
En resumen, mientras create() se centra en insertar nuevos registros, update() se enfoca en actualizar registros existentes en la base de datos utilizando los atributos de la instancia actual de la clase. Ambos métodos interactúan con la base de datos a través del objeto $mydb, ejecutando consultas SQL construidas  */
	public function update($id=0) {
	  global $mydb;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$tblname." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE user_id=". $id;
	  $mydb->setQuery($sql);
	 	if(!$mydb->executeQuery()) return false; 	
		
	}

	public function delete($id=0) {
		global $mydb;
		  $sql = "DELETE FROM ".self::$tblname;
		  $sql .= " WHERE user_id=". $id;
		  $sql .= " LIMIT 1 ";
		  $mydb->setQuery($sql);
		  
			if(!$mydb->executeQuery()) return false; 	
	
	}	


}
?>
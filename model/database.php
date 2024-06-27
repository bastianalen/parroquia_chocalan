<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(LIB_PATH.DS."config.php");
require_once(LIB_PATH.DS."conexion.php");
/*Propiedades de la clase:
$sql_string: Almacena la cadena SQL que se va a ejecutar.
$error_no y $error_msg: Guardan el número de error y el mensaje de error en caso de que ocurra un problema durante la ejecución de una consulta.
$conn: Almacena la conexión a la base de datos.
$last_query: Guarda la última consulta ejecutada.
$magic_quotes_active y $real_escape_string_exists: Variables para determinar si las funciones magic_quotes_gpc y mysqli_real_escape_string están disponibles y activas.
Constructor (__construct()):
Inicializa la conexión a la base de datos llamando al método open_connection().
Determina si las funciones magic_quotes_gpc y mysqli_real_escape_string están disponibles y activas. */
class Database {
    var $sql_string = '';
    var $error_no = 0;
    var $error_msg = '';
    private $conn;
    public $last_query;
    private $magic_quotes_active;
    private $real_escape_string_exists;

    /*Constructor (__construct()):
Inicializa la conexión a la base de datos llamando al método open_connection().
Determina si las funciones magic_quotes_gpc y mysqli_real_escape_string están disponibles y activas. */
    function __construct() {
        $this->open_connection();
        $this->magic_quotes_active = function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc();
        $this->real_escape_string_exists = function_exists("mysqli_real_escape_string");
    }
    /* Establece la conexión a la base de datos utilizando los parámetros definidos (server, user, pass, database_name, 3306).
    Si no puede establecer la conexión (mysqli_connect devuelve false), lanza una excepción (mysqli_sql_exception) con un mensaje de error.
    Si la conexión se establece correctamente pero no puede seleccionar la base de datos (mysqli_select_db devuelve false), también lanza una excepción con un mensaje de error.
    Método setQuery($sql=''):
    Establece la cadena SQL que se va a ejecutar.
    Método executeQuery():
    Ejecuta la consulta SQL almacenada en $sql_string utilizando mysqli_query.
    Si la consulta no se ejecuta correctamente (mysqli_query devuelve false), lanza una excepción con el mensaje de error de MySQL.
    Llama al método confirm_query() para verificar si la consulta fue exitosa.
    Devuelve el resultado de la consulta ($result).
    Método confirm_query($result):
    Verifica si la consulta $result es exitosa.
    Si $result es false, guarda el número de error y el mensaje de error utilizando funciones de mysqli.
    Retorna false si la consulta no fue exitosa, de lo contrario retorna $result.*/
    public function open_connection() {
    /*open_connection():
    Establece la conexión a la base de datos utilizando los parámetros definidos (server, user, pass, database_name, 3306).
    Si no puede establecer la conexión (mysqli_connect devuelve false), lanza una excepción (mysqli_sql_exception) con un mensaje de error.
    Si la conexión se establece correctamente pero no puede seleccionar la base de datos (mysqli_select_db devuelve false), también lanza una excepción con un mensaje de error. */
        $this->conn = mysqli_connect(server, user, pass,database_name,3306);
        if (!$this->conn) {
            throw new mysqli_sql_exception("Problem in database connection! Contact administrator!");
        } else {
            $db_select = mysqli_select_db($this->conn, database_name);
            if (!$db_select) {
                throw new mysqli_sql_exception("Problem in selecting database! Contact administrator!");
            }
        }
    }
    // Método para establecer la consulta SQL a ejecutar
    function setQuery($sql='') {
        $this->sql_string = $sql;
    }

    // Método para ejecutar la consulta SQL
    function executeQuery() {
        try {
            $result = mysqli_query($this->conn, $this->sql_string); // Ejecuta la consulta
            if (!$result) {
                throw new mysqli_sql_exception(mysqli_error($this->conn)); // Lanza una excepción si hay error
            }
            $this->confirm_query($result); // Confirma la ejecución de la consulta
            return $result; // Retorna el resultado de la consulta
        } catch (mysqli_sql_exception $e) {
            echo 'Error ejecutando la consulta: ' . $e->getMessage(); // Maneja la excepción de la consulta SQL
        }
    }

    // Método privado para confirmar la ejecución de la consulta
    private function confirm_query($result) {
        if (!$result) {
            $this->error_no = mysqli_errno($this->conn); // Obtiene el número de error
            $this->error_msg = mysqli_error($this->conn); // Obtiene el mensaje de error
            return false;
        }
        return $result;
    }

    // Método para cargar una lista de resultados en forma de array
    function loadResultList($key='') {
        $cur = $this->executeQuery(); // Ejecuta la consulta SQL

        $array = array();
        while ($row = mysqli_fetch_object($cur)) {
            if ($key) {
                $array[$row->$key] = $row; // Asigna los resultados al array usando la clave especificada
            } else {
                $array[] = $row; // Agrega los resultados al array
            }
        }
        mysqli_free_result($cur); // Libera la memoria del resultado
        return $array; // Retorna el array de resultados
    }

    // Método para cargar un único resultado
    function loadSingleResult() {
        $cur = $this->executeQuery(); // Ejecuta la consulta SQL

        while ($row = mysqli_fetch_object($cur)) {
            return $row; // Retorna el primer resultado encontrado
        }
        mysqli_free_result($cur); // Libera la memoria del resultado
    }

    // Método para obtener los nombres de campo de una tabla
    function getFieldsOnOneTable($tbl_name) {
        $this->setQuery("DESC ".$tbl_name); // Establece la consulta DESCRIBE para obtener los campos
        $rows = $this->loadResultList(); // Carga la lista de resultados

        $f = array();
        for ($x = 0; $x < count($rows); $x++) {
            $f[] = $rows[$x]->Field; // Obtiene los nombres de los campos y los agrega al array
        }

        return $f; // Retorna el array de nombres de campos
    }

    // Método para obtener una fila como un array asociativo
    public function fetch_array($result) {
        return mysqli_fetch_array($result); // Retorna la fila como un array asociativo
    }

    // Método para obtener el número de filas afectadas por la última consulta
    public function num_rows($result_set) {
        if ($result_set) {
            return mysqli_num_rows($result_set); // Retorna el número de filas afectadas
        } else {
            return 0; // Retorna cero si no hay filas afectadas
        }
    }

    // Método para obtener el ID generado por la última inserción
    public function insert_id() {
        return mysqli_insert_id($this->conn); // Retorna el ID generado por la última inserción
    }

    // Método para obtener el número de filas afectadas por la última consulta
    public function affected_rows() {
        return mysqli_affected_rows($this->conn); // Retorna el número de filas afectadas
    }

    // Método para escapar los valores antes de usarlos en consultas SQL para prevenir inyección SQL
    public function escape_value($value) {
        if ($this->real_escape_string_exists) {
            if ($this->magic_quotes_active) { $value = stripslashes($value); }
            $value = mysqli_real_escape_string($this->conn, $value); // Escapa el valor
        } else {
            if (!$this->magic_quotes_active) { $value = addslashes($value); } // Escapa el valor
        }
        return $value; // Retorna el valor escapado
    }

    // Método para cerrar la conexión a la base de datos
    public function close_connection() {
        if (isset($this->conn)) {
            mysqli_close($this->conn); // Cierra la conexión
            unset($this->conn); // Elimina la conexión
        }
    }
}

$mydb = new Database(); // Instancia de la clase Database para utilizarla como $mydb

<?php
// require_once(LIB_PATH.DS.'database.php');
require_once("../../public/include/initialize.php");
class Solicitud {
	protected static  $tblname = "tblsolicitudes";

	function dbfields () {
		global $mydb;
		return $mydb->getfieldsononetable(self::$tblname);

	}
	function listofsolicitud(){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname);
		return $cur;
	}
	function find_solicitud($id="",$fecha=""){
        global $mydb;
		$sql= "SELECT * FROM ".self::$tblname." 
        WHERE 1=1";
        if ($id !== "") {
            $sql .= " AND id_solicitud = '{$id}'";
        }
        if ($fecha !== "") {
            $sql .= " AND fecha_solicitud = '{$fecha}'";
        }
        $mydb->setQuery($sql);
		$cur = $mydb->executeQuery();
        $results= [];
		while ($row = $cur->fetch_assoc()) {
            $results[] = $row;
        }
		return $results;
	}
	
	function single_solicitud($id=""){
			global $mydb;
			$mydb->setQuery("SELECT * FROM ".self::$tblname." 
				ts INNER JOIN tblestadosolicitud tes ON ts.estado = tes.id_estado 
				INNER JOIN tblhorasolicitud ths ON ts.hora_solicitud = ths.id_hora 
				INNER JOIN tbltiposervicio tts ON ts.tipo_servicio = tts.id_servicio 
				Where id_solicitud= '{$id}' LIMIT 1");
			$cur = $mydb->loadSingleResult();
			return $cur;
	}
	/*---Instantiation of Object dynamically---*/
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
	
	
	/*--Create,Update and Delete methods--*/
	public function save() {
	  // A new record won't have an id yet.
	  return isset($this->id) ? $this->update() : $this->create();
	}
	
	public function create() {
		global $mydb;
		// Don't forget your SQL syntax and good habits:
		// - INSERT INTO table (key, key) VALUES ('value', 'value')
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
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

	public function update($id=0) {
	  global $mydb;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$tblname." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE id_solicitud=". $id;
	  $mydb->setQuery($sql);
	 	if(!$mydb->executeQuery()) return false; 	
		
	}

	public function delete($id=0) {
		global $mydb;
		  $sql = "DELETE FROM ".self::$tblname;
		  $sql .= " WHERE id_solicitud=". $id;
		  $sql .= " LIMIT 1 ";
		  $mydb->setQuery($sql);
		  
			if(!$mydb->executeQuery()) return false; 	
	
	}	


}

// Manejo de solicitudes AJAX
if (isset($_POST['find_solicitud'])) {
    $id_solicitud = $_POST['id_solicitud'];
    $fecha = $_POST['fecha'];
    $solicitud = new Solicitud();
    $resultados = $solicitud->find_solicitud($id_solicitud, $fecha);
    echo json_encode($resultados);
    exit;
}


// Manejo de solicitudes AJAX
if (isset($_POST['find_solicitud_horas'])) {

    $hora_array = explode(",",$_POST['id_horas']);
    foreach ($cur2 as $result2) {
        $hora_array .= $result2->id_hora;
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
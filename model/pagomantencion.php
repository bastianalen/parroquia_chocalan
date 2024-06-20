<?php
require_once(__DIR__ ."/../controller/initialize.php");
require_once(LIB_PATH_MODEL.DS.'database.php');

class PagoMantencion {

	protected static  $tblname = "tblpagomantencion";
	protected static  $tblinner = " pm
								INNER JOIN tblpersonas per ON pm.id_persona=per.id_persona
								INNER JOIN tblanios a ON a.id_anio=pm.id_anio
								";
	function dbfields () {
		global $mydb;
		return $mydb->getfieldsononetable(self::$tblname);

	}
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
	function find_pagomantencion($id="",$name=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname.self::$tblinner." WHERE pm.id_pago = {$id} OR pm.propietario = '{$name}'");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);
		return $row_count;
	}

	function find_pagos_persona($id=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname.self::$tblinner." WHERE pm.id_persona = {$id} ORDER BY pm.id_anio ASC");
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
		echo "<script>console.log(".json_encode($result).")</script>";

		return $result;
	}

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
	 
	function single_pagomantencion($id=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." where id_pago = {$id} LIMIT 1");
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
	  return isset($this->id_pago) ? $this->update() : $this->create();
	}
	
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
	    $this->id_pago = $mydb->insert_id();
	    return true;
	  } else {
	    return false;
	  }
	}

	public function update($id_pago=0) {
	  global $mydb;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$tblname." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE id_pago =". $id_pago;
	  $mydb->setQuery($sql);
	 	if(!$mydb->executeQuery()) return false; 	
		
	}

	public function delete($id=0) {
		global $mydb;
		  $sql = "DELETE FROM ".self::$tblname;
		  $sql .= " WHERE id_pago =". $id;
		  $sql .= " LIMIT 1 ";
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


// Manejo de solicitudes AJAX
if (isset($_POST['find_anios_pagados'])) {
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
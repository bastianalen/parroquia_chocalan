<?php
require_once("../../public/include/initialize.php");


function generarCadenaAleatoria($longitud = 20)
{
	$caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$cadena = '';
	for ($i = 0; $i < $longitud; $i++) {
		$indice = rand(0, strlen($caracteres) - 1);
		$cadena .= $caracteres[$indice];
	}
	return $cadena;
}







$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add':
		doInsert();
		break;

	case 'edit':
		doEdit();
		break;

	case 'delete':
		doDelete();
		break;

}


function doInsert()
{
	global $mydb;
	if (isset($_POST['save'])) {


		$borndate = $_POST['BORNDATE'];
		$dieddate = $_POST['DIEDDATE'];

		if (isset($_FILES['ESCRITURA'])) {
			$archivo_nombre = $_FILES['ESCRITURA']['name'];
			$archivo_tmp = $_FILES['ESCRITURA']['tmp_name'];
			$archivo_tipo = $_FILES['ESCRITURA']['type'];
			$archivo_tamanio = $_FILES['ESCRITURA']['size'];

			// Verificar si se cargó un archivo
			if (!empty($archivo_nombre)) {

				// Obtener la extensión del archivo
				$archivo_extension = pathinfo($archivo_nombre, PATHINFO_EXTENSION);

				// Ejemplo de uso
				$archivo_nombre = generarCadenaAleatoria();
				$archivo_nombre = $archivo_nombre . "." . $archivo_extension;

				// Ruta donde se guardará el archivo
				$carpeta_destino = 'archivos/';
				// Crear una carpeta si no existe
				if (!file_exists($carpeta_destino)) {
					mkdir($carpeta_destino, 0777, true);
				}
				// Mover el archivo cargado a la carpeta de destino
				$archivo_destino = $carpeta_destino . $archivo_nombre;
				move_uploaded_file($archivo_tmp, $archivo_destino);

			}
		}


		if ($_POST['FNAME'] == "") {
			$messageStats = false;
			message("¡Todos los campos son obligatorios!", "error");
			redirect('index.php?view=add');
		} else {

			$sql = "SELECT * FROM `tblpeople` WHERE `GRAVENO`= '" . $_POST['GRAVENO'] . "'  AND  `CATEGORIES`='" . $_POST['CATEGORIES'] . "' AND `TIPO_TUMBA`='" . $_POST['TIPO_TUMBA'] . "'";
			$mydb->setQuery($sql);
			$cur = $mydb->loadSingleResult();

			$autonumber = new Autonumber();
				$res = $autonumber->set_autonumber('PEOPLEID');

				$p = new Person();
				$p->PEOPLEID = $res->AUTO;
				$p->FNAME = $_POST['FNAME'];
				$p->PROPIETARIO = $_POST['PROPIETARIO'];
				$p->MNAME = $_POST['MNAME'];
				$p->CATEGORIES = $_POST['CATEGORIES'];
				$p->BORNDATE = $borndate;
				$p->DIEDDATE = $dieddate;
				$p->TIPO_TUMBA = $_POST['TIPO_TUMBA'];
				$p->GRAVENO = $_POST['GRAVENO'];
				$p->ESCRITURA = $archivo_destino;
				$p->create();
				// }



				$autonumber = new Autonumber();
				$autonumber->auto_update('PEOPLEID');



				message("¡Nuevo registro creado exitosamente!", "exito");
				redirect("index.php");
				


		}

	}
}


function doEdit()
{


	if (isset($_POST['save'])) {

		// $borndate =  ($_POST['BORNDATE'] !='' || $_POST['BORNDATE'] !='0m/dd/yyyy') ? @date_format(date_create($_POST['BORNDATE']), "Y-m-d"): '0000-00-00';
		// $dieddate =  ($_POST['DIEDDATE'] !='' || $_POST['DIEDDATE'] !='0m/dd/yyyy') ? @date_format(date_create($_POST['DIEDDATE']), "Y-m-d") : '0000-00-00';
		$borndate = $_POST['BORNDATE'];
		$dieddate = $_POST['DIEDDATE'];

		$p = new Person();
		$p->FNAME = $_POST['FNAME'];
		$p->PROPIETARIO = $_POST['PROPIETARIO'];
		$p->MNAME = $_POST['MNAME'];
		$p->CATEGORIES = $_POST['CATEGORIES'];
		$p->BORNDATE = $borndate;
		$p->DIEDDATE = $dieddate;
		$p->GRAVENO = $_POST['GRAVENO'];
		$p->TIPO_TUMBA = $_POST['TIPO_TUMBA'];
		$p->update($_POST['PEOPLEID']);


		message("Record has been updated!", "success");
		redirect("index.php");
	}
}

function doDelete()
{
	global $mydb;



	if (isset($_POST['selector']) == '') {
		message("¡Seleccione los registros primero antes de eliminarlos!", "error");
		redirect('index.php');
	} else {

		$id = $_POST['selector'];
		$key = count($id);

		for ($i = 0; $i < $key; $i++) {

			$person = new Person();
			$person->delete($id[$i]);


			message("¡El registro ha sido eliminado!");
			redirect('index.php');

		}
	}

}


?>
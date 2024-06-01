<?php
require_once("../../model/initialize.php");


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


		// Separación de nacimiento
		$fecha_nacimiento = $_POST['fecha_nacimiento'];
		$partes_fecha_nacimiento = explode("/", $fecha_nacimiento);
		$dd_nacimiento = $partes_fecha_nacimiento[0];
		$mm_nacimiento = $partes_fecha_nacimiento[1];
		$yyyy_nacimiento = $partes_fecha_nacimiento[2];
		
		// Separación de muerte
		$fecha_muerte = $_POST['fecha_muerte'];
		$partes_fecha_muerte = explode("/", $fecha_muerte);
		$dd_muerte = $partes_fecha_muerte[0];
		$mm_muerte = $partes_fecha_muerte[1];
		$yyyy_muerte = $partes_fecha_muerte[2];

		if (isset($_FILES['escritura'])) {
			$archivo_nombre = $_FILES['escritura']['name'];
			$archivo_tmp = $_FILES['escritura']['tmp_name'];
			$archivo_tipo = $_FILES['escritura']['type'];
			$archivo_tamanio = $_FILES['escritura']['size'];

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


		if ($_POST['pnombre'] == "") {
			$messageStats = false;
			message("¡Todos los campos son obligatorios!", "error");
			redirect('index.php?view=add');
		} else {

			$sql = "SELECT * FROM `tblpersonas` WHERE `nro_tumba`= '" . $_POST['nro_tumba'] . "'  AND  `id_sector`='" . $_POST['id_sector'] . "' AND `tipo_tumba`='" . $_POST['tipo_tumba'] . "'";
			$mydb->setQuery($sql);
			$cur = $mydb->loadSingleResult();

			$autonumber = new Autonumber();
				$res = $autonumber->set_autonumber('rut');

				$p = new Person();
				$p->rut = $res->AUTO;
				$p->nro_tumba = $_POST['nro_tumba'];
				$p->pnombre = $_POST['pnombre'];
				$p->id_sector = $_POST['id_sector'];
				$p->tipo_tumba = $_POST['tipo_tumba'];
				$p->propietario = $_POST['propietario'];
				$p->caracteristicas = $_POST['caracteristicas'];
				$p->dd_nacimiento = $dd_nacimiento;
				$p->mm_nacimiento = $mm_nacimiento;
				$p->yyyy_nacimiento = $yyyy_nacimiento;
				$p->dd_muerte = $dd_muerte;
				$p->mm_muerte = $mm_muerte;
				$p->yyyy_muerte = $yyyy_muerte;
				$p->escritura = $archivo_destino;
				$p->create();
				// }



				$autonumber = new Autonumber();
				$autonumber->auto_update('rut');



				message("¡Nuevo registro creado exitosamente!", "exito");
				redirect("index.php");
				


		}

	}
}


function doEdit()
{


	if (isset($_POST['save'])) {

		// Separación de nacimiento
		$fecha_nacimiento = $_POST['fecha_nacimiento'];
		$partes_fecha_nacimiento = explode("/", $fecha_nacimiento);
		$dd_nacimiento = $partes_fecha_nacimiento[0];
		$mm_nacimiento = $partes_fecha_nacimiento[1];
		$yyyy_nacimiento = $partes_fecha_nacimiento[2];
		
		// Separación de muerte
		$fecha_muerte = $_POST['fecha_muerte'];
		$partes_fecha_muerte = explode("/", $fecha_muerte);
		$dd_muerte = $partes_fecha_muerte[0];
		$mm_muerte = $partes_fecha_muerte[1];
		$yyyy_muerte = $partes_fecha_muerte[2];

		// Actualización de documentos
		$archivo_destino_escritura = actualizarArchivo('escritura', 'escritura_antigua', 'escritura');
        $archivo_destino_new_escritura = actualizarArchivo('new_escritura', 'new_escritura_antigua', 'escritura actualizada');
		$archivo_destino_pase_sepul = actualizarArchivo('pase_sepul', 'pase_sepul_antiguo', 'pase de sepultacion');

		$p = new Person();
		$p->nro_tumba = $_POST['nro_tumba'];
		$p->pnombre = $_POST['pnombre'];
		$p->id_sector = $_POST['id_sector'];
		$p->tipo_tumba = $_POST['tipo_tumba'];
		$p->propietario = $_POST['propietario'];
		$p->caracteristicas = $_POST['caracteristicas'];
		$p->dd_nacimiento = $dd_nacimiento;
		$p->mm_nacimiento = $mm_nacimiento;
		$p->yyyy_nacimiento = $yyyy_nacimiento;
		$p->dd_muerte = $dd_muerte;
		$p->mm_muerte = $mm_muerte;
		$p->yyyy_muerte = $yyyy_muerte;
		// Actualización de archivos
        if (!empty($archivo_destino_escritura)) {
            $p->escritura = $archivo_destino_escritura;
        }
		if (!empty($archivo_destino_new_escritura)) {
            $p->new_escritura = $archivo_destino_new_escritura;
        }
		if (!empty($archivo_destino_pase_sepul)) {
            $p->pase_sepul = $archivo_destino_pase_sepul;
        }

		$p->update($_POST['rut']);


		message("¡El registro ha sido actualizado!", "éxito");
		// redirect("index.php");
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


// Funcion para actualizar los archivos
function actualizarArchivo($nombreCampo, $nuevoNombreCarpeta , $nombreFaltanteBD) {
    $archivo_destino = '';
    if (isset($_FILES[$nombreCampo])) {
        $archivo_nombre = $_FILES[$nombreCampo]['name'];
        $archivo_tmp = $_FILES[$nombreCampo]['tmp_name'];
        $archivo_tipo = $_FILES[$nombreCampo]['type'];
        $archivo_tamanio = $_FILES[$nombreCampo]['size'];

        // Verificar si se cargó un archivo
        if (!empty($archivo_nombre)) {
            // Obtener la extensión del archivo
            $archivo_extension = pathinfo($archivo_nombre, PATHINFO_EXTENSION);

            // Generar un nuevo nombre para el archivo
            $archivo_nombre = generarCadenaAleatoria() . "." . $archivo_extension;

            // Ruta donde se guardará el archivo
            $carpeta_destino = 'archivos/';
            // Crear una carpeta si no existe
            if (!file_exists($carpeta_destino)) {
                mkdir($carpeta_destino, 0777, true);
            }

            // Mover el archivo antiguo a otra carpeta archivo_antiguo
            $person = new Person();
            $s = $person->single_people($_POST['rut']);
            $archivo_antiguo = $s->$nombreCampo;
			echo "<script>console.log('antiguo " . $archivo_antiguo . " ')</script>";
			
            if (!empty($archivo_antiguo) && file_exists($archivo_antiguo)) {
				$carpeta_antiguos = 'archivos_antiguos_' . $nombreCampo . '/';
				echo "<script>console.log('carpeta " . $carpeta_antiguos . " ')</script>";
                if (!file_exists($carpeta_antiguos)) {
                    mkdir($carpeta_antiguos, 0777, true);
                }
                $nombre_archivo_antiguo = $carpeta_antiguos . $s->pnombre . '_' . time() . '.' . pathinfo($archivo_antiguo, PATHINFO_EXTENSION);
                rename($archivo_antiguo, $nombre_archivo_antiguo);
            }

            // Mover el archivo cargado a la carpeta de destino
            $archivo_destino = $carpeta_destino . $archivo_nombre;
            move_uploaded_file($archivo_tmp, $archivo_destino);
        }
    }
    return $archivo_destino;
}
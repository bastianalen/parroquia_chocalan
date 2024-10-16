<?php
require_once("initialize.php");


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


		// Actualización de documentos
		$archivo_destino_escritura = actualizarArchivo('escritura', '');
        $archivo_destino_new_escritura = actualizarArchivo('new_escritura', '');
		$archivo_destino_pase_sepul = actualizarArchivo('pase_sepul', '');

		# Transforma el rut y deja solo numeros
		if (str_contains($_POST['rut'], ".") || str_contains($_POST['rut'], "-")) {
			$rut = str_replace(['.', '-'], '', $_POST['rut']);
		} else {
			$rut = $_POST['rut'];
		}

		$pnombre = $_POST['pnombre'];
		$sector = $_POST['sector'];
		$tipo_tumba = $_POST['tipo_tumba'];

		$errores = validarDatos($rut, $pnombre , $sector, $tipo_tumba);

		if (!empty($errores)) {
			message("¡Todos los campos son obligatorios!", "error");
			redirect("../view/admin/personas_fallecidas/index.php?view=add");
		} else {

			
			echo "<script>console.log('rut:  " . $rut . " ')</script>";
			echo "<script>console.log('sector:  " . $_POST['sector'] . " ')</script>";
			echo "<script>console.log('tipo tumba:  " . $_POST['tipo_tumba'] . " ')</script>";

			$sql = "SELECT * FROM tblpersonas WHERE rut= '" . $rut . "'";
			$mydb->setQuery($sql);
			$cur = $mydb->loadSingleResult();

			if(!empty($cur)){
				message("¡Esta persona ya esta registrada!", "error");

			}else {
				$p = new Persona();
				$p->rut = $rut;
				$p->nro_tumba = $_POST['nro_tumba'];
				$p->pnombre = $_POST['pnombre'];
				$p->id_sector = $_POST['sector'];
				$p->tipo_tumba = $_POST['tipo_tumba'];
				$p->propietario = $_POST['propietario'];
				$p->caracteristicas = $_POST['caracteristicas'];
				$p->dd_nacimiento = $dd_nacimiento;
				$p->mm_nacimiento = $mm_nacimiento;
				$p->yyyy_nacimiento = $yyyy_nacimiento;
				$p->dd_muerte = $dd_muerte;
				$p->mm_muerte = $mm_muerte;
				$p->yyyy_muerte = $yyyy_muerte;
				$p->escritura = $archivo_destino_escritura;
				$p->new_escritura = $archivo_destino_new_escritura;
				$p->pase_sepul = $archivo_destino_pase_sepul;
				$p->create();
				message("¡Nuevo registro creado exitosamente!", "success");
			}

			redirect("../view/admin/personas_fallecidas/index.php");

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
		$archivo_destino_escritura = actualizarArchivo('escritura', 'escritura_antigua');
        $archivo_destino_new_escritura = actualizarArchivo('new_escritura', 'new_escritura_antigua');
		$archivo_destino_pase_sepul = actualizarArchivo('pase_sepul', 'pase_sepul_antiguo');

		$p = new Persona();
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
		redirect("../view/admin/personas_fallecidas/index.php");
	}
}

function doDelete()
{
	global $mydb;



	if (isset($_POST['selector']) == '') {
		message("¡Seleccione los registros primero antes de eliminarlos!", "error");
		redirect("../view/admin/personas_fallecidas/index.php");
	} else {

		$id = $_POST['selector'];
		$key = count($id);

		for ($i = 0; $i < $key; $i++) {

			$person = new Persona();
			$person->delete($id[$i]);


			message("¡El registro ha sido eliminado!");
			redirect("../view/admin/personas_fallecidas/index.php");

		}
	}

}


// Funcion para actualizar los archivos
function actualizarArchivo($nombreCampo, $nuevoNombreCarpeta) {
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

			if ($nuevoNombreCarpeta !== "") {
				// Mover el archivo antiguo a otra carpeta archivo_antiguo
				$person = new Persona();
				$s = $person->single_people($_POST['rut']);
				$archivo_antiguo = $s->$nombreCampo;
				
				if (!empty($archivo_antiguo) && file_exists($archivo_antiguo)) {
					$carpeta_antiguos = 'archivos_antiguos_' . $nombreCampo . '/';
					if (!file_exists($carpeta_antiguos)) {
						mkdir($carpeta_antiguos, 0777, true);
					}
					$nombre_archivo_antiguo = $carpeta_antiguos . $s->pnombre . '_' . time() . '.' . pathinfo($archivo_antiguo, PATHINFO_EXTENSION);
					rename($archivo_antiguo, $nombre_archivo_antiguo);
				}
			}

            // Mover el archivo cargado a la carpeta de destino
            $archivo_destino = $carpeta_destino . $archivo_nombre;
            move_uploaded_file($archivo_tmp, $archivo_destino);
        }
    }
    return $archivo_destino;
}

# Funcion para validar datos
function validarDatos($rut, $pnombre, $sector, $tipo_tumba) {
    $errores = [];

    // Validar Rut (no vacío)
    if (empty($rut)) {
        $errores[] = "El Rut no puede estar vacío.";
    }

    // Validar Fallecido (no vacío)
    if (empty($pnombre)) {
        $errores[] = "El campo 'Fallecido' no puede estar vacío.";
    }

    // Validar Patio (distinto de 0)
    if ($sector == 0) {
        $errores[] = "Debe seleccionar un patio válido.";
    }

    // Validar Tipo Tumba (distinto de 0)
    if ($tipo_tumba == 0) {
        $errores[] = "Debe seleccionar un tipo de tumba válido.";
    }

    // Retornar errores (si los hay)
    return $errores;
}
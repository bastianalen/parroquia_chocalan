<?php

require_once ("initialize.php");
if (!isset($_SESSION['user_id'])){
 redirect(web_root."view/admin/index.php");
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

// // CONEXION A LA BASE DE DATOS PARROQUIA_CHOCALAN
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "parroquia_chocalan";

// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     die("Conexión fallida: " . $conn->connect_error);
// }

// // OBTENER RESULTADOS DE LA BUSQUEDA FILTRAR POR N_REGISTRO,NOMBRE,RUT,N_TUMBA,PATIO
// // AQUI CON ISSET DEFINO LA VARIABLE PARA LUEGO LLAMAR LA FUNCION EN ESTE CASO QUERY CONTIENE LA CONSULTA
// $query = isset($_GET['query']) ? $_GET['query'] : '';

// // BUSCADOR  DEFINIR O FILTRAR CONSULTA A LA TABLA list.php POR LOS SIGUIENTES DATOS A BUSCAR
// $sql = "SELECT N_REGISTRO, RUT, N_TUMBA, PATIO, PROPIETARIO, FECHA_PAGO, MONTO, ESTADO_PAGO
//         FROM tblpagosmantencion 
//         WHERE N_REGISTRO LIKE ? OR PROPIETARIO LIKE ? OR RUT LIKE ? OR N_TUMBA LIKE ? OR PATIO LIKE ? OR FECHA_PAGO LIKE?";
// $stmt = $conn->prepare($sql);
// $search = "%$query%";
// $stmt->bind_param("ssssss", $search, $search, $search, $search, $search, $search);
// $stmt->execute();
// $result = $stmt->get_result();



// function connectDB() {
//     $servername = "localhost"; // Cambia esto a tu configuración
//     $username = "root"; // Cambia esto a tu configuración
//     $password = ""; // Cambia esto a tu configuración
//     $dbname = "parroquia_chocalan"; // Cambia esto a tu configuración

//     // Crear conexión
//     $conn = new mysqli($servername, $username, $password, $dbname);

//     // Verificar conexión
//     if ($conn->connect_error) {
//         die("Conexión fallida: " . $conn->connect_error);
//     }

//     return $conn;
// }

// FUNCION PARA INSERTAR DATOS A LA BASE DE DATOS *ADD.PHP*
// function doInsert() {
//     // Verificar si todos los campos están llenos
//     if (empty($_POST['RUT']) || empty($_POST['N_TUMBA']) || empty($_POST['PATIO']) || empty($_POST['PROPIETARIO']) || empty($_POST['FECHA_PAGO']) || empty($_POST['MONTO']) || empty($_POST['ESTADO_PAGO'])) {
//         $messageStats = false;
//         message("Debes llenar todos los datos", "error");
//         redirect('../view/admin/pagos_mantencion/index.php?view=add');
//     } else {
//         // Conectar a la base de datos
//         $conn = connectDB();

//         $RUT = $_POST['RUT'];
//         $N_TUMBA = $_POST['N_TUMBA'];
//         $PATIO = $_POST['PATIO'];
//         $PROPIETARIO = $_POST['PROPIETARIO'];
//         $FECHA_PAGO = $_POST['FECHA_PAGO'];
//         $MONTO = $_POST['MONTO'];
//         $ESTADO_PAGO = $_POST['ESTADO_PAGO'];

//         // Preparar la consulta SQL para insertar los datos
//         $sql = "INSERT INTO tblpagosmantencion (RUT, N_TUMBA, PATIO, PROPIETARIO, FECHA_PAGO, MONTO, ESTADO_PAGO) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
//         $stmt = $conn->prepare($sql);
//         $stmt->bind_param("sssssss", $RUT, $N_TUMBA, $PATIO, $PROPIETARIO, $FECHA_PAGO, $MONTO, $ESTADO_PAGO);

//         if ($stmt->execute()) {
//             message("¡Nuevo registro creado exitosamente!", "success");
//             redirect("../view/admin/pagos_mantencion/index.php");
//         } else {
//             message("Error al insertar los datos: " . $stmt->error, "error");
//             redirect('../view/admin/pagos_mantencion/index.php?view=add');
//         }

//         // Cerrar la conexión
//         $stmt->close();
//         $conn->close();
//     }


    
//     return;
// }


function doInsert(){
	echo"<script>console.log('kjaskjsajksakj')</script>";
	if(isset($_POST['save'])){
		
		
			$pagosmantencion = new PagosMantencion();
			// echo "<script> console.log(' ". $_POST['pagosmantencion'] ." ') </script>";
			
			$pagosmantencion->rut	= $_POST['rut'];
			$pagosmantencion->propietario	= $_POST['propietario'];
			$pagosmantencion->n_tumba	= $_POST['n_tumba'];
			$pagosmantencion->patio	= $_POST['patio'];
			$pagosmantencion->fecha_pago	= $_POST['fecha_pago'];
			$pagosmantencion->monto	= $_POST['monto'];
			$pagosmantencion->estado_pago	= $_POST['estado_pago'];
			// echo"<script>console.log(".json_encode($pagosmantencion) .")</script>";
			$pagosmantencion->create();
			// echo"<script>console.log(".json_encode($_POST['n_registro']) .")</script>";
			message("¡Nueva Sección creada exitosamente!", "success");
			redirect("../view/admin/pagos_mantencion/index.php");
			
		
	}
}

function doEdit(){
	if(isset($_POST['update'])){
		$pagosmantencion = new PagosMantencion();
		$pagosmantencion->rut	= $_POST['rut'];
		$pagosmantencion->propietario	= $_POST['propietario'];
		$pagosmantencion->n_tumba	= $_POST['n_tumba'];
		$pagosmantencion->patio	= $_POST['patio'];
		$pagosmantencion->fecha_pago	= $_POST['fecha_pago'];
		$pagosmantencion->monto	= $_POST['monto'];
		$pagosmantencion->estado_pago	= $_POST['estado_pago'];
		// echo"<script>console.log(".json_encode($pagosmantencion) .")</script>";
		$pagosmantencion->update($_POST['n_registro']);
		// echo"<script>console.log(".json_encode($_POST['n_registro']) .")</script>";
		message("¡Seccion actualizada!", "success");
		redirect("../view/admin/pagos_mantencion/index.php");
	}
}

function doDelete(){
		$n_registro = $_GET['n_registro'];
		$pagosmantencion = new PagosMantencion();
		$pagosmantencion->delete($n_registro);
		message("¡Pago eliminado!","info");
		redirect('../view/admin/pagos_mantencion/index.php');
	
}

?>












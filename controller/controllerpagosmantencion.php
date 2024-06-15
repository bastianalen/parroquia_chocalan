<?php

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

// Definir la función message 
if (!function_exists('message')) {
    function message($text) {
        echo $text;
    }
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
    case 'view' : 
        $content    = 'view.php';
        break;
}

// CONEXION A LA BASE DE DATOS PARROQUIA_CHOCALAN
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parroquia_chocalan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// OBTENER RESULTADOS DE LA BUSQUEDA FILTRAR POR N_REGISTRO,NOMBRE,RUT,N_TUMBA,PATIO
// AQUI CON ISSET DEFINO LA VARIABLE PARA LUEGO LLAMAR LA FUNCION EN ESTE CASO QUERY CONTIENE LA CONSULTA
$query = isset($_GET['query']) ? $_GET['query'] : '';

// BUSCADOR  DEFINIR O FILTRAR CONSULTA A LA TABLA list.php POR LOS SIGUIENTES DATOS A BUSCAR
$sql = "SELECT N_REGISTRO, RUT, N_TUMBA, PATIO, PROPIETARIO, FECHA_PAGO, MONTO, ESTADO_PAGO
        FROM tblpagosmantencion 
        WHERE PROPIETARIO LIKE ? OR RUT LIKE ? OR N_TUMBA LIKE ? OR PATIO LIKE ? OR FECHA_PAGO LIKE?";
$stmt = $conn->prepare($sql);
$search = "%$query%";
$stmt->bind_param("sssss", $search, $search, $search, $search, $search);
$stmt->execute();
$result = $stmt->get_result();




// FUNCION PARA CONECTAR A LA BASE DE DATOS
function connectDB() {
    $servername = "localhost"; // Cambia esto a tu configuración
    $username = "root"; // Cambia esto a tu configuración
    $password = ""; // Cambia esto a tu configuración
    $dbname = "parroquia_chocalan"; // Cambia esto a tu configuración

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn;
}


// FUNCION PARA INSERTAR DATOS A LA BASE DE DATOS *ADD.PHP*
function doInsert() {
    // Conectar a la base de datos
    $conn = connectDB();

	$RUT = $_POST['RUT'];
    $N_TUMBA = $_POST['N_TUMBA'];
    $PATIO = $_POST['PATIO'];
    $PROPIETARIO = $_POST['PROPIETARIO'];
    $FECHA_PAGO = $_POST['FECHA_PAGO'];
    $MONTO = $_POST['MONTO'];
    $ESTADO_PAGO = $_POST['ESTADO_PAGO'];

	// EN ESTE CODIGO DEFINIREMOS LOS CAMPOS DEL FORMULARIO ADD Y SEAN OBLIGATORIOS DE RELLENAR
	if ($RUT === '' || $N_TUMBA === '' || $PATIO === '' || $PROPIETARIO === ''|| $FECHA_PAGO === '' || $MONTO === '' || $ESTADO_PAGO === '') {
        message('Todos los campos son obligatorios.');
        return;
    }

	// ADD INSERTAR INSERT INTO A LA TABLA TBLPAGOSMANTENCION
    // Crear la consulta de inserción
    $sql = "INSERT INTO tblpagosmantencion ( RUT,  N_TUMBA, PATIO, PROPIETARIO, FECHA_PAGO, MONTO, ESTADO_PAGO ) VALUES ( '$RUT', '$N_TUMBA','$PATIO', '$PROPIETARIO', '$FECHA_PAGO', '$MONTO', '$ESTADO_PAGO')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        message("Nuevo registro creado exitosamente");
    } else {
        message("Error: " . $sql . "<br>" . $conn->error);
    }

    // Cerrar la conexión
    $conn->close();
}

function getRecordById($N_REGISTRO) {
    $db = connectDB();
    $sql = "SELECT * FROM tblpagosmantencion WHERE N_REGISTRO = '$N_REGISTRO'";
    $result = $db->query($sql);
    $db->close();
    return $result->fetch_assoc();
}

function updateRecord($data) {
    $db = connectDB();
    
    $N_REGISTRO = $data['N_REGISTRO'];
    $RUT = $data['RUT'];
    $N_TUMBA = $data['N_TUMBA'];
    $PATIO = $data['PATIO'];
    $PROPIETARIO = $data['PROPIETARIO'];
    $FECHA_PAGO = $data['FECHA_PAGO'];
    $MONTO = $data['MONTO'];
    $ESTADO_PAGO = $data['ESTADO_PAGO'];
    
    $sql = "UPDATE tblpagosmantencion SET 
            RUT='$RUT', 
            N_TUMBA='$N_TUMBA', 
            PATIO='$PATIO', 
            PROPIETARIO='$PROPIETARIO', 
            FECHA_PAGO='$FECHA_PAGO', 
            MONTO='$MONTO', 
            ESTADO_PAGO='$ESTADO_PAGO' 
            WHERE N_REGISTRO='$N_REGISTRO'";
    
    $db->query($sql);
    $db->close();	
}

function deleteRecord($N_REGISTRO) {
    $db = connectDB();
    $sql = "DELETE FROM tblpagosmantencion WHERE N_REGISTRO = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $N_REGISTRO);
    $stmt->execute();
    $stmt->close();
    $db->close();
}


?>





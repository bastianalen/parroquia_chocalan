
<?php
class ReporteModel {
    public function getReporte($section) {
        global $mydb;
        $query = "SELECT * FROM `tblpeople` WHERE CATEGORIES='{$section}'";
        $mydb->setQuery($query);
        return $mydb->loadResultList();
    }
}

// variables de conexión a la base de datos
$nombredeservidor = "localhost";
$nombreusuario = "root";
$contraseña = "";
$dbname = "parroquia_chocalan";

// nueva conexión a la base de datos
$conn = new mysqli($nombredeservidor, $nombreusuario, $contraseña, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

echo "Conexión exitosa";

// Cerrar la conexión
$conn->close();
?>

<?php
/*Define una clase ReporteModel que se utiliza 
para interactuar con la base de datos y obtener datos relacionados con reportes. */
class ReporteModel {
    /*Método getReporte($section):
    Toma un parámetro $section, que se espera sea el ID de un sector.
    Utiliza una variable global $mydb (presumiblemente una instancia de
    una clase de manejo de base de datos, como mysqli o una clase 
    personalizada que extiende funcionalidades de base de datos). */
    public function getReporte($section) {
        global $mydb;
        /*Construye una consulta SQL para seleccionar todos los registros de la tabla 
        tblpersonas donde el campo id_sector coincide con el valor de $section. */
        $query = "SELECT * FROM `tblpersonas` WHERE id_sector='{$section}'";
        /*Llama a métodos (setQuery() y loadResultList()) en $mydb para ejecutar la consulta y devolver los resultados obtenidos. */
        $mydb->setQuery($query);
        return $mydb->loadResultList();
    }
}
/*Define variables que almacenan los detalles de la conexión a la base de datos:
 $nombredeservidor, $nombreusuario, $contraseña, y $dbname. */
// variables de conexión a la base de datos
$nombredeservidor = "localhost";
$nombreusuario = "root";
$contraseña = "";
$dbname = "parroquia_chocalan";

/*Crea una nueva instancia de conexión a la base de datos utilizando mysqli con los detalles proporcionados. */
// nueva conexión a la base de datos
$conn = new mysqli($nombredeservidor, $nombreusuario, $contraseña, $dbname);

/*Verifica si la conexión fue exitosa utilizando connect_error de mysqli.
 Si hay un error, se muestra un mensaje de error y se termina el script. */
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
/*Si la conexión es exitosa, muestra "Conexión exitosa". */
echo "Conexión exitosa";

// Cerrar la conexión
$conn->close();
?>
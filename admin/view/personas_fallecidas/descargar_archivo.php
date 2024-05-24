<?php
// Verificar si se proporcionó un nombre de archivo para descargar
if (isset($_GET['archivo'])) {
    // Obtener el nombre del archivo desde la URL
    $archivo = $_GET['archivo'];
    
    // Ruta del directorio donde se almacenan los archivos
    $directorio = './';
    
    // Ruta completa del archivo
    $ruta_archivo = $directorio . $archivo;
    
    // Verificar si el archivo existe
    if (file_exists($ruta_archivo)) {
        // Definir las cabeceras para forzar la descarga del archivo
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($ruta_archivo) . '"');
        header('Content-Length: ' . filesize($ruta_archivo));
            
        // Leer y enviar el contenido del archivo
        readfile($ruta_archivo);
        exit;
    } else {
        // El archivo no existe, mostrar un mensaje de error
        echo "El archivo no existe.";
    }
} else {
    // No se proporcionó un nombre de archivo, mostrar un mensaje de error
    echo "No se proporcionó un nombre de archivo.";
}
?>

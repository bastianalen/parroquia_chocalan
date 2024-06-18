
<?php
require_once("../model/initialize.php");

// *************************************************************************************************
// ENVIO DE CORREO
function enviarCorreo() {

    header('Content-Type: text/html; charset=UTF-8');
        
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $para             = $_POST['correo'];
        $mensaje_personal = $_POST['mensaje'];
        $nombre           = $_POST['rut'];
        $nombre           = $_POST['nombre'];
        $titulo           = 'Parroquia Chocalan';
        
        $persona = new Persona();
        $datos_persona = $persona->find_propietario($_POST['rut'],$_POST['propietario']);
        
        foreach($datos_persona as $result) {
            // Verificar si la consulta fue exitosa
            if ($result) {
                // Asignar los valores a las variables
                $nombre = $result['propietario'];
                $rut = $result['rut'];
                $correo = $result['correo'];
                $rol = $result['rol'];
            } else {
                // Mostrar error si la consulta falla
                // echo "Error: " . $sqlselect . "<br>" . $conn->error;
                // Muestra la alerta y redirige con JavaScript
                echo '<script> alert("Error 2.");  ';
                echo 'window.location.href = "index.html"; </script> ';
            }
        }
                
                
        $mensaje = 'Gracias ' . $nombre . ' por comunicarte con nosotros, ya recibimos tu mensaje y te contactaremos pronto.';
        $mensaje .= ' "' . $mensaje_personal . '" '. "\r\n" ;
        $mensaje .= ' Apellido: "' . $apellido . '" ' . "\r\n" .' Contraseña: "' . $contrasenna . '" ' . "\r\n" .' Correo: "' . $correo . '" ' . "\r\n" .' Rol: "' . $rol . '" ';
        $mensaje .= "\r\n \r\n" . "<img src='./images/logo/Logo.jpg' alt='Logo Jobbys.cl'>";
        
        // Encabezado MIME para un mensaje HTML
        $cabeceras = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $cabeceras = 'From: bastianalen3@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        
        // Envía el correo electrónico
        mail($para, $titulo, $mensaje, $cabeceras);
        
        // Muestra la alerta y redirige con JavaScript
        echo '<script> alert("Tu correo ha sido enviado y almacenado en la base de datos correctamente. Pronto te contactaremos para ayudarte.");  ';
        echo 'window.location.href = "index.html"; </script> ';
        
        // Cierra la conexión a la base de datos
        $conn->close();
            
    }
}
                // *************************************************************************************************
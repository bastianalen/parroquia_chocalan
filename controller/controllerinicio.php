
<?php
require_once("../model/initialize.php");

// *************************************************************************************************
// Enviar correo
/*Se define una función enviarCorreo() que se encargará del proceso de envío de correo electrónico. */
function enviarCorreo() {
/*Cabecera y verificación de solicitud POST: Configura la cabecera para el tipo de contenido HTML UTF-8. Verifica si la solicitud es POST para proceder con el envío del correo electrónico.
Recopilación de datos del formulario: Obtiene los datos del formulario, incluidos el correo electrónico ($para), el mensaje personalizado ($mensaje_personal), y el nombre ($nombre y $rut).
Consulta a la base de datos: Utiliza un objeto Persona y llama al método find_propietario() para buscar información específica en la base de datos. Los resultados se asignan a variables locales ($nombre, $rut, $correo).
Construcción del mensaje: Prepara el mensaje de correo electrónico concatenando las variables recuperadas del formulario y de la consulta.
Envío del correo electrónico: Utiliza la función mail() para enviar el correo electrónico. Se especifica el destinatario ($para), el asunto ($titulo), el cuerpo del mensaje ($mensaje), y los encabezados MIME ($cabeceras).
Alerta y redirección: Después de enviar el correo, muestra una alerta al usuario utilizando JavaScript y redirige al usuario de vuelta a index.html. */
    header('Content-Type: text/html; charset=UTF-8');
        
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Procesa el formulario cuando se envía por POST
        // Recoge los datos del formulario
        $para             = $_POST['correo'];
        $mensaje_personal = $_POST['mensaje'];
        $nombre           = $_POST['rut'];
        $nombre           = $_POST['nombre'];
        $titulo           = 'Parroquia Chocalan';
        // Crea un objeto Persona y realiza una consulta
        $persona = new Persona();
        $datos_persona = $persona->find_propietario($_POST['rut'],$_POST['propietario']);
        
        foreach($datos_persona as $result) {
            // Verificar si la consulta fue exitosa
            if ($result) {
                // Asignar los valores a las variables
                $nombre = $result['propietario'];
                $rut = $result['rut'];
                $correo = $result['correo'];
            } else {
                // Mostrar error si la consulta falla
                // echo "Error: " . $sqlselect . "<br>" . $conn->error;
                // Muestra la alerta y redirige con JavaScript
                echo '<script> alert("Error 2.");  ';
                echo 'window.location.href = "index.html"; </script> ';
            }
        }
                
                
        $mensaje = 'Gracias ' . $nombre . ' por comunicarte con nosotros.';
        $mensaje .= 'Tu mensaje a sido enviado y te contactaremos lo antes posible.'. "\r\n";
        $mensaje .= 'El mensaje enviado es el siguiente:.';
        $mensaje .= ' "' . $mensaje_personal . '" '. "\r\n" ;
        $mensaje .= "\r\n \r\n" . "<img src='../public/img/Logo.png' alt='Logo Parroquia Chocalan'>";
        
        // Encabezado MIME para un mensaje HTML
        $cabeceras = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $cabeceras = 'From: bastianalen3@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        
        // Envía el correo electrónico
        mail($para, $titulo, $mensaje, $cabeceras);
        
        // Muestra la alerta y redirige con JavaScript
        echo '<script> alert("Tu correo ha sido enviado correctamente. Pronto te contactaremos para ayudarte.");  ';
        echo 'window.location.href = "../index.html"; </script> ';
        
        // Cierra la conexión a la base de datos
        $conn->close();
            
    }
}
// *************************************************************************************************
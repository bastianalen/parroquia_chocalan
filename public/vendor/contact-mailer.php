<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_POST) {

    require_once "PHPMailer/Exception.php";
    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/POP3.php";
    require_once "PHPMailer/OAuth.php";

    $mail = new PHPMailer(true);

    $your_email = "parroquiachocalan@parroquiachocalan.cl";
    $your_old = "parroquiachocalan@gmail.cl";


    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {

        //exit script outputting json data
        $output = json_encode(
            array(
                'type'=>'error',
                'text' => 'La solicitud debe ser desde AJAX'
            ));

        die($output);
    }

    //check $_POST vars are set, exit if any missing
    //Sanitize input data using PHP filter_var().

    if(isset($_POST["userName"])) {
        if(!isset($_POST["userName"])){
            $output = json_encode(array('type'=>'error', 'text' => 'Campo vacío!'));
            die($output);
        }
        else {
            $user_Name = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
        }
    }
    // if(isset($_POST["firstName"]) && isset($_POST["lastName"])) {
    //     if(!isset($_POST["firstName"]) && !isset($_POST["lastName"]))
    //     {
    //         $output = json_encode(array('type'=>'error', 'text' => 'Campo vacío!'));
    //         die($output);
    //     }
    //     else {
    //         $user_Name = filter_var($_POST["firstName"], FILTER_SANITIZE_STRING) . " " . filter_var($_POST["lastName"], FILTER_SANITIZE_STRING);
    //     }
    // }
    //education
    // if(isset($_POST["fatherName"])) {
    //     if(!isset($_POST["fatherName"]))
    //     {
    //         $output = json_encode(array('type'=>'error', 'text' => 'Campo vacío!'));
    //         die($output);
    //     }
    //     else {
    //         $father_Name = filter_var($_POST["fatherName"], FILTER_SANITIZE_STRING);
    //     }
    // }
    // if(isset($_POST["quoteName"])) {
    //     if(!isset($_POST["quoteName"]))
    //     {
    //         $output = json_encode(array('type'=>'error', 'text' => 'Campo vacío!'));
    //         die($output);
    //     }
    //     else {
    //         $quote_Name = filter_var($_POST["quoteName"], FILTER_SANITIZE_STRING);
    //     }
    // }
    // if(isset($_POST["userAddress"])) {
    //     if(!isset($_POST["userAddress"]))
    //     {
    //         $output = json_encode(array('type'=>'error', 'text' => 'Campo vacío!'));
    //         die($output);
    //     }
    //     else {
    //         $user_Address = filter_var($_POST["userAddress"], FILTER_SANITIZE_STRING);
    //     }
    // }
    // if(isset($_POST["course"])) {
    //     if(!isset($_POST["course"]))
    //     {
    //         $output = json_encode(array('type'=>'error', 'text' => 'Campo vacío!'));
    //         die($output);
    //     }
    //     else {
    //         $applied_Course = filter_var($_POST["course"], FILTER_SANITIZE_STRING);
    //     }
    // }

    if(isset($_POST["userEmail"])) {
        if(!isset($_POST["userEmail"]))
        {
            $output = json_encode(array('type'=>'error', 'text' => 'Campo vacío!'));
            die($output);
        }
        else {
            $user_Email = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);
        }
    }
    if(isset($_POST["userPhone"])){
        if(!isset($_POST["userPhone"]))
        {
            $output = json_encode(array('type'=>'error', 'text' => 'Campo vacío!'));
            die($output);
        }
        else {
            $user_Phone = $_POST["userPhone"];
        }
    }
    // if(isset($_POST["userSubject"])) {
    //     if(!isset($_POST["userSubject"]))
    //     {
    //         $output = json_encode(array('type'=>'error', 'text' => 'Campo vacío!'));
    //         die($output);
    //     }
    //     else {
    //         $user_Subject = $_POST["userSubject"];
    //     }
    // }
    // if(isset($_POST["userCity"])) {
    //     if(!isset($_POST["userCity"]))
    //     {
    //         $output = json_encode(array('type'=>'error', 'text' => 'Campo vacío!'));
    //         die($output);
    //     }
    //     else {
    //         $user_City = $_POST["userCity"];
    //     }
    // }
    // if(isset($_POST["projectType"])) {
    //     if(!isset($_POST["projectType"]))
    //     {
    //         $output = json_encode(array('type'=>'error', 'text' => 'Campo vacío!'));
    //         die($output);
    //     }
    //     else {
    //         $pro_type = $_POST["projectType"];
    //     }
    // }

    //Directory listing
    // if(isset($_POST["propertyId"])) {
    //     if(!isset($_POST["propertyId"]))
    //     {
    //         $output = json_encode(array('type'=>'error', 'text' => 'Campo vacío!'));
    //         die($output);
    //     }
    //     else {
    //         $property_id = $_POST["propertyId"];
    //     }
    // }
    // if(isset($_POST["propertyType"])) {
    //     if(!isset($_POST["propertyType"]))
    //     {
    //         $output = json_encode(array('type'=>'error', 'text' => 'Campo vacío!'));
    //         die($output);
    //     }
    //     else {
    //         $property_type = $_POST["propertyType"];
    //     }
    // }
    // if(isset($_POST["quoteBudget"])) {
    //     if(!isset($_POST["quoteBudget"]))
    //     {
    //         $output = json_encode(array('type'=>'error', 'text' => 'Campo vacío!'));
    //         die($output);
    //     }
    //     else {
    //         $budget = $_POST["quoteBudget"];
    //     }
    // }
    // //consultant template
    // if(isset($_POST["service"])) {
    //     if(!isset($_POST["service"]))
    //     {
    //         $output = json_encode(array('type'=>'error', 'text' => 'Campo vacío!'));
    //         die($output);
    //     }
    //     else {
    //         $service = $_POST["service"];
    //     }
    // }
    //Reservation template
    // if(isset($_POST["reservationDate"])) {
    //     if(!isset($_POST["reservationDate"]))
    //     {
    //         $output = json_encode(array('type'=>'error', 'text' => 'Campo vacío!'));
    //         die($output);
    //     }
    //     else {
    //         $res_date = $_POST["reservationDate"];
    //     }
    // }
    // if(isset($_POST["totalPeople"])) {
    //     if(!isset($_POST["totalPeople"]))
    //     {
    //         $output = json_encode(array('type'=>'error', 'text' => 'Campo vacío!'));
    //         die($output);
    //     }
    //     else {
    //         $total_people = $_POST["totalPeople"];
    //     }
    // }
    // //spa
    // if(isset($_POST["reserveTime"])) {
    //     if(!isset($_POST["reserveTime"]))
    //     {
    //         $output = json_encode(array('type'=>'error', 'text' => 'Campo vacío!'));
    //         die($output);
    //     }
    //     else {
    //         $res_time = $_POST["reserveTime"];
    //     }
    // }

    //medical
    // if(isset($_POST["userGender"])) {
    //     if(!isset($_POST["userGender"]))
    //     {
    //         $output = json_encode(array('type'=>'error', 'text' => 'Campo vacío!'));
    //         die($output);
    //     }
    //     else {
    //         $user_gender = $_POST["userGender"];
    //     }
    // }
    if(isset($_POST["userMessage"])) {
        if(!isset($_POST["userMessage"]))
        {
            $output = json_encode(array('type'=>'error', 'text' => 'Campo vacío!'));
            die($output);
        }
        else {
            $user_Message = filter_var($_POST["userMessage"], FILTER_SANITIZE_STRING);
        }
    }


    //additional php validation
    if(isset($user_Name)) {
        if (strlen($user_Name) < 3) // If length is less than 3 it will throw an HTTP error.
        {
            $output = json_encode(array('type' => 'error', 'text' => 'Nombre demasiado corto o no ingresado!'));
            die($output);
        }
    }
    if(isset($_POST["userEmail"])) {
        if (!filter_var($user_Email, FILTER_VALIDATE_EMAIL)) //email validation
        {
            $output = json_encode(array('type' => 'error', 'text' => 'Porfavor ingresa un correo valido!'));
            die($output);
        }
    }
    if(isset($_POST["userMessage"])) {
        if (strlen($user_Message) < 5) //check emtpy message
        {
            $output = json_encode(array('type' => 'error', 'text' => 'Mensaje demasiado corto! Porfavor ingresa algun mensaje.'));
            die($output);
        }
    }

    if(isset($_POST["asunto"])) {
        if(!isset($_POST["asunto"])){
            $output = json_encode(array('type'=>'error', 'text' => 'Campo vacío!'));
            die($output);
        }
        else {
            $asunto = filter_var($_POST["asunto"], FILTER_SANITIZE_STRING);
        }
    }
    if($asunto != ''){
        if($asunto == 'Confirmación de contacto'){
            $mensaje_asunto = "Este es un correo predeterminado que confirma su contacto con Parroquia Santa Rosa de Lima de Chocalan, Pronto nos contactaremos.";
        }elseif ($asunto == "solicitud de hora") {
            $mensaje_asunto = "Este es un correo predeterminado que confirma su solicitud de hora con Parroquia Santa Rosa de Lima de Chocalan, Pronto nos contactaremos.";
        }else {
            $mensaje_asunto = "";
        }
    }
    try {
        //Server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'mail.parroquiachocalan.cl';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'parroquiachocalan@parroquiachocalan.cl';                     // SMTP username
        $mail->Password   = 'Pmanuelquiroz';                         // SMTP password
        $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted

        $mail->CharSet    = 'UTF-8';
        $mail->Port       = 465;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom($your_email,'Parroquia Santa Rosa de Lima Chocalan');
        $mail->addAddress($user_Email, $user_Name);     // Add a recipient
        $mail->addReplyTo($your_old, 'Administrador@');

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Respuesta desde Parroquia Santa Rosa de Lima de Chocalán, ' . $asunto;
        $mail->Body  = "<h4 style='text-align: center;padding: 25px 15px;background-color: #0c6c9e;color: #FFFFFF;font-size:16px;width:90%;border-radius: 10px;'>Hola! Tienes una nueva respuesta desde el sitio web parroquiachocalan.cl.</h4><br><br>";
        $mail->Body .= "<p>".$mensaje_asunto."</p><br>";
        $mail->Body .= "<img src='https://parroquiachocalan.cl/public/img/logito.png' alt='Logo' class='img-load' style='width: 250px;'><br>";

        $mail->Body .= "<h3>Tu informaci&oacute;n: </h3><br>";
        if(isset($_POST["userEmail"])) {
            $mail->Body .= "<strong>Correo: </strong>" . $user_Email . "<br>";
        }
        //education
        // if(isset($_POST["fatherName"])) {
        //     $mail->Body .= "<strong>Nombre del padre: </strong>" . $father_Name . "<br>";
        // }
        // if(isset($_POST["userAddress"])) {
        //     $mail->Body .= "<strong>Dirección: </strong>" . $user_Address . "<br>";
        // }
        // if(isset($_POST["course"])) {
        //     $mail->Body .= "<strong>Curso aplicado: </strong>" . $applied_Course . "<br>";
        // }
        if(isset($_POST["userPhone"])) {
            $mail->Body .= "<strong>Tel&eacute;fono: </strong>" . $user_Phone . "<br>";
        }
        // if(isset($_POST["userSubject"])) {
        //     $mail->Body .= "<strong>Sujeto: </strong>" . $user_Subject . "<br>";
        // }
        // if(isset($_POST["userCity"])) {
        //     $mail->Body .= "<strong>Ciudad o país: </strong>" . $user_City . "<br>";
        // }
        // if(isset($_POST["projectType"])) {
        //     $mail->Body .= "<strong>Tipo de proyecto: </strong>" . $pro_type . "<br>";
        // }
        // if(isset($_POST["quoteBudget"])) {
        //     $mail->Body .= "<strong>Presupuesto: </strong>" . $budget . "<br>";
        // }
        // //Directory listing
        // if(isset($_POST["propertyId"])) {
        //     $mail->Body .= "<strong>Id de propiedad: </strong>" . $property_id . "<br>";
        // }
        // if(isset($_POST["propertyType"])) {
        //     $mail->Body .= "<strong>Tipo de propiedad: </strong>" . $property_type . "<br>";
        // }
        // // dental
        // if(isset($_POST["service"])) {
        //     $mail->Body .= "<strong>Tipo de servicio: </strong>" . $service . "<br>";
        // }
        // //Reservation , spa , medical template
        // if(isset($_POST["reservationDate"])) {
        //     $mail->Body .= "<strong>Fecha de reservación: </strong>" . $res_date . "<br>";
        // }
        // //spa
        // if(isset($_POST["reserveTime"])) {
        //     $mail->Body .= "<strong>Hora reservada: </strong>" . $res_time . "<br>";
        // }
        // if(isset($_POST["totalPeople"])) {
        //     $mail->Body .= "<strong>Total de personas: </strong>" . $total_people . "<br>";
        // }
        // //medical
        // if(isset($_POST["userGender"])) {
        //     $mail->Body .= "<strong>Género: </strong>" . $user_gender . "<br>";
        // }
        $mail->Body .= '<br>';

        if(isset($_POST["userMessage"])) {
            $mail->Body .= "<strong>Mensaje: </strong><br><br><div style='background-color: #EDEFF2;padding:30px 15px;border-radius:10px;min-height:50px;width:90%;'>" . $user_Message . "</div><br>";
        }
        $mail->Body .= '<strong>Atentamente para,</strong><br>';

        if(isset($user_Name)) {
            $mail->Body .= $user_Name . "<br>";
        }
        // if(isset($_POST["quoteName"])) {
        //     $mail->Body .= "<strong>Quote Name: </strong>" . $quote_Name . "<br>";
        // }
        $mail->AltBody = 'Este es el cuerpo del correo para clientes sin mostrar formato HTML';


        if(!$mail->send())
        {
            $output = json_encode(array('type'=>'error', 'text' => 'No se ah podido enviar el correo! Porfavor revisa tu configuración de PHP correo.'));
            die($output);
        }else{
            $output = json_encode(array('type'=>'message', 'text' => 'Hola '.$user_Name .' Gracias por contactarte con nosotros.'));
            die($output);
        }
    } catch (Exception $e){
        echo "Ocurrio un error en el envio del correo: {$mail->ErrorInfo}";
    }
}
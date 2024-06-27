<?php
/* Inicia la sesión PHP, lo cual es necesario para almacenar y recuperar variables de sesión en todo el sitio. */
session_start(); 


function logged_in()
{
  /*Verifica si la variable de sesión user_id está definida. 
  Retorna true si está definida, indicando que el usuario
  está autenticado; de lo contrario, retorna false. */
  return isset($_SESSION['user_id']);

}
//this function if session member is not set then it will be redirected to login.php
function confirm_logged_in()
{
  /*Verifica si el usuario está autenticado (logged_in()). 
  Si no lo está, redirige automáticamente a login.php utilizando JavaScript. */
  if (!logged_in()) { ?>

    <script type="text/javascript">
      window.location = "login.php";
    </script>

    <?php
  }
}

/*Similar a confirm_logged_in(), pero específicamente
 para un usuario administrador. Si la sesión user_id no está definida, redirige a login.php. */
function admin_confirm_logged_in()
{
  if (@!$_SESSION['user_id']) { ?>
    <script type="text/javascript"> window.location = "login.php";</script>

    <?php
  }
}

function studlogged_in()
{
  return isset($_SESSION['CUSID']);

}
function studconfirm_logged_in()
{
  if (!studlogged_in()) { ?>
    <script type="text/javascript">
      window.location = "index.php";
    </script>

    <?php
  }
}
  /*Permite establecer mensajes ($msg) y tipos de mensajes 
  ($msgtype) en variables de sesión ($_SESSION['message'] y $_SESSION['msgtype']).
  Si se llama sin argumentos ($msg vacío), devuelve
  el mensaje almacenado en $_SESSION['message']. */
function message($msg = "", $msgtype = "")
{
  /*si existe un msg entonces retorna el message y el tipo de mensaje */
  if (!empty($msg)) {
    
    $_SESSION['message'] = $msg;
    $_SESSION['msgtype'] = $msgtype;
  } else {

    return $message;
  }
}
// funcion de alerta comprueba si el cliente ingresa correctamente sus credenciales al login
function check_message()
{
  /*Verifica si hay un mensaje ($_SESSION['message']) y un tipo de mensaje ($_SESSION['msgtype']).
  Imprime el mensaje con el formato de alerta adecuado (info, error, o success) utilizando etiquetas HTML según el tipo de mensaje.
  Limpia (unset) las variables de sesión después de mostrar el mensaje para asegurar que no se muestre más de una vez. */
  if (isset($_SESSION['message'])) {
    if (isset($_SESSION['msgtype'])) {
      if ($_SESSION['msgtype'] == "info") {
        echo '<label class="alert alert-info" style="width:100%;padding:5px">' . $_SESSION['message'] . '</label>';

      } elseif ($_SESSION['msgtype'] == "error") {
        echo '<label class="alert alert-danger" style="width:100%;padding:5px">' . $_SESSION['message'] . '</label>';

      } elseif ($_SESSION['msgtype'] == "success") {
        echo '<label class="alert alert-success" style="width:100%;padding:5px">' . $_SESSION['message'] . '</label>';
      }
      unset($_SESSION['message']);
      unset($_SESSION['msgtype']);
    }

  }

}





?>
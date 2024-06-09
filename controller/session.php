<?php
session_start(); //before we store information of our member, we need to start first the session

//create a new function to check if the session variable member_id is on set
function logged_in()
{
  return isset($_SESSION['user_id']);

}
//this function if session member is not set then it will be redirected to login.php
function confirm_logged_in()
{
  if (!logged_in()) { ?>

    <script type="text/javascript">
      window.location = "login.php";
    </script>

    <?php
  }
}
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

function message($msg = "", $msgtype = "")
{
  if (!empty($msg)) {
    // then this is "set message"
    // make sure you understand why $this->message=$msg wouldn't work
    $_SESSION['message'] = $msg;
    $_SESSION['msgtype'] = $msgtype;
  } else {
    // then this is "get message"
    return $message;
  }
}
// funcion de alerta comprueba si el cliente ingresa correctamente sus credenciales al login
function check_message()
{

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
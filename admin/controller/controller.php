<?php
// este include llama al controler y ejecuta el login
if (isset($_POST['btnLogin'])) {
  $email = trim($_POST['user_email']);
  $upass = trim($_POST['user_pass']);
  $h_upass = sha1($upass);

  if ($email == '' or $upass == '') {

    message("¡correo y contraseña inválidos!", "error");
    redirect("admin/view/login.php");

  } else {
    $user = new User();
    $res = $user::userAuthentication($email, $h_upass);
    if ($res == true) {
      message("Has iniciado sesión como " . $_SESSION['U_ROLE'] . ".", "success");
      if ($_SESSION['U_ROLE'] == 'Administrador') {
        redirect(web_root . "admin/view/index.php");
      } else {
        redirect(web_root . "admin/view/login.php");
      }
    } else {
      message("¡La cuenta no existe! Por favor contacte al Administrador.", "error");
      redirect(web_root . "admin/view/login.php");
    }
  }
}
?>
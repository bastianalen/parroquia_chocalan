<?php
// este include llama al controler y ejecuta el login
if (isset($_POST['btnLogin'])) {
  $email = trim($_POST['user_email']);
  $upass = trim($_POST['user_pass']);
  $h_upass = sha1($upass);

  if ($email == '' or $upass == '') {

    message("¡correo y contraseña inválidos!", "error");
    redirect("view/admin/login.php");

  } else {
    $user = new User();
    $res = $user::userAuthentication($email, $h_upass);
    // echo "<script>console.log('id_rol: " .$_SESSION['id_rol'] . "');</script>";
    if ($res == true) {
      message("Has iniciado sesión como " . $_SESSION['nombre'] . ".", "success");
      if ($_SESSION['id_rol'] == 1 or $_SESSION['id_rol'] == 2) {
        redirect(web_root . "view/admin/index.php");
      } else {
        message("¡La cuenta no posee los permisos para ingresar! Por favor contacte al Administrador.", "error");
        redirect(web_root . "view/admin/login.php");
      }
    } else {
      message("¡La cuenta no existe! Por favor contacte al Administrador.", "error");
      redirect(web_root . "view/admin/login.php");
    }
  }
}
?>
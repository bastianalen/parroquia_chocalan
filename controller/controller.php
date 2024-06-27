<?php
// este include llama al controler y ejecuta el login
/*Comprueba si el botón de inicio de sesión (btnLogin) ha sido presionado y, por lo tanto, se ha enviado el formulario. */
if (isset($_POST['btnLogin'])) {
  /*Obtiene los valores del correo electrónico (user_email) y la contraseña (user_pass) enviados a través del formulario.
   trim() se utiliza para eliminar espacios en blanco adicionales alrededor de los datos. 
   sha1() se utiliza para cifrar la contraseña en formato SHA-1 antes de compararla. */
  $email = trim($_POST['user_email']);
  $upass = trim($_POST['user_pass']);
  $h_upass = sha1($upass);
  /*Verifica si alguno de los campos de correo electrónico o contraseña está vacío. 
  Si es así, muestra un mensaje de error y redirige al usuario de vuelta a la página
  de inicio de sesión (login.php). */
  if ($email == '' or $upass == '') {

    message("¡correo y contraseña inválidos!", "error");
    redirect("view/admin/login.php");

  } else {
    /*Crea una instancia del objeto User y llama al método estático userAuthentication() 
    para verificar las credenciales del usuario. $h_upass contiene la contraseña cifrada SHA-1. */
    $user = new User();
    $res = $user::userAuthentication($email, $h_upass);
    // echo "<script>console.log('id_rol: " .$_SESSION['id_rol'] . "');</script>";
    /*Si la autenticación es exitosa ($res == true),
    muestra un mensaje de éxito indicando el rol del usuario
     ($_SESSION['id_rol']) y redirige al usuario a la página principal 
     del panel de administración (index.php). Si el rol no es 1, redirige 
     de vuelta a la página de inicio de sesión.
    Si la autenticación falla, muestra un mensaje de error indicando
    que la cuenta no existe y redirige de vuelta a la página de inicio de sesión. */
    if ($res == true) {
      message("Has iniciado sesión como " . $_SESSION['id_rol'] . ".", "success");
      if ($_SESSION['id_rol'] == 1) {
        redirect(web_root . "view/admin/index.php");
      } else {
        redirect(web_root . "view/admin/login.php");
      }
    } else {
      message("¡La cuenta no existe! Por favor contacte al Administrador.", "error");
      redirect(web_root . "view/admin/login.php");
    }
  }
}
?>
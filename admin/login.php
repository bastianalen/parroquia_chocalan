<?php
require_once("../include/initialize.php");

?>
<?php
// login confirmation
if (isset($_SESSION['USERID'])) {
  redirect(web_root . "admin/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Login Cementerio Parroquial</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo web_root; ?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo web_root; ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo web_root; ?>css/dataTables.bootstrap.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" type="text/css" href="<?php echo web_root; ?>css/jquery.dataTables.css">
  <link href="<?php echo web_root; ?>css/bootstrap.css" rel="stylesheet" media="screen">

  <link href="<?php echo web_root; ?>fonts/font-awesome.min.css" rel="stylesheet" media="screen">
  <!-- Plugins -->
  <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>js/jquery.js"></script>
  <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>js/jquery.dataTables.js"></script>
  <!-- <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>js/fixnmix.js"></script> / -->
  <link rel="icon" href="../home/vista/img/logosinletras.png" type="image/x-icon">
  <style>
    @CHARSET "UTF-8";

    .progress-bar {
      color: #333;
    }


    * {
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      outline: none;
    }

    .form-control {
      position: relative;
      font-size: 16px;
      height: auto;
      padding: 10px;
      @include box-sizing(border-box);

      &:focus {
        z-index: 2;
      }
    }

    body {
      background-color: #eee;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }

    .login-form {
      margin-top: 60px;
    }

    form[role=login] {
      color: #5d5d5d;
      background: #fff;
      padding: 26px;
      border-radius: 10px;
      -moz-border-radius: 10px;
      -webkit-border-radius: 10px;
    }

    form[role=login] img {
      display: block;
      margin: 0 auto;
      margin-bottom: 35px;
      height: 90px;
    }

    form[role=login] input,
    form[role=login] button {
      font-size: 18px;
      margin: 16px 0;
    }

    form[role=login]>div {
      text-align: center;
    }

    .form-links {
      text-align: center;
      margin-top: 1em;
      margin-bottom: 50px;
    }

    .form-links a {
      color: #fff;
    }
  </style>

<body>


  <div class="container">

    <div class="row" id="pwd-container">
      <div class="col-md-4"></div>
      <div class="col-md-4">

        <section class="login-form">
          <? echo check_message(); ?>
          <form method="post" action="" role="login">
            <img src="../img/logo.png" height="25px" class="img-responsive" alt="" />

            <input type="input" name="user_email" placeholder="correo electrónico" required class="form-control input-lg"
              value="" />

            <input type="password" name="user_pass" class="form-control input-lg" id="password" placeholder="contraseña"
              required />
            <div class="pwstrength_viewport_progress"></div>
            <button type="submit" name="btnLogin" class="btn btn-lg btn-primary btn-block">iniciar sesión</button>
          </form>
          <div class="form-links">
          </div>
        </section>
      </div>
      <div class="col-md-4"></div>
    </div>
  </div>
</body>

<?php

if (isset($_POST['btnLogin'])) {
  $email = trim($_POST['user_email']);
  $upass = trim($_POST['user_pass']);
  $h_upass = sha1($upass);

  if ($email == '' or $upass == '') {

    message("¡correo y contraseña inválidos!", "error");
    redirect("login.php");

  } else {
    $user = new User();
    $res = $user::userAuthentication($email, $h_upass);
    if ($res == true) {
      message("Has iniciado sesión como " . $_SESSION['U_ROLE'] . ".", "success");
      if ($_SESSION['U_ROLE'] == 'Administrador') {
        redirect(web_root . "admin/index.php");
      } else {
        redirect(web_root . "admin/login.php");
      }
    } else {
      message("¡La cuenta no existe! Por favor contacte al Administrador.", "error");
      redirect(web_root . "admin/login.php");
    }
  }
}
?>
</head>

</html>
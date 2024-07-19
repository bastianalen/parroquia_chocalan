  <?php
  require_once("../../controller/initialize.php");

  ?>
  <?php
  // login confirmation
  if (isset($_SESSION['user_id'])) {
    redirect(web_root . "view/admin/index.php");
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
    <link href="<?php echo web_root; ?>public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo web_root; ?>public/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo web_root; ?>public/css/dataTables.bootstrap.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo web_root; ?>public/css/jquery.dataTables.css">

    <link href="<?php echo web_root; ?>public/css/bootstrap.css" rel="stylesheet" media="screen">

    <link href="<?php echo web_root; ?>public/font/fonts/font-awesome.min.css" rel="stylesheet" media="screen">
    <!-- Plugins -->
    <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>public/jquery/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>public/js/jquery.dataTables.js"></script>
    <!-- <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>js/fixnmix.js"></script> / -->
    <link rel="icon" href="administradores/photos/logosinletras.png" type="image/x-icon">
    <link href="<?php echo web_root; ?>public/vista/css/custom.css" rel="stylesheet">
  <body>


    <div class="container" id="login-container">

      <div class="row" id="pwd-container">          
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <?php check_message(); ?>

          <section class="login-form">
            <form method="post" action="" role="login">
              <img src="../../public/img/logo.png" height="25px" class="img-responsive" alt="" />

              <input type="input" name="user_email" placeholder="correo electrónico" required class="form-control input-lg"
                value="" />

              <input type="password" name="user_pass" class="form-control input-lg" id="password" placeholder="contraseña"
                required />
              <div class="pwstrength_viewport_progress"></div>
              <button type="submit" name="btnLogin" class="btn btn-lg btn-primary btn-block">iniciar sesión</button>
              <a href="../../" class="btn btn-block">Volver a la página principal</a>
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
  // este include llama al controler y ejecuta el login (validacion)
  include_once '../../controller/controller.php';
  ?>


  </head>

  </html>
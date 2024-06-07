  <?php
  require_once("../model/initialize.php");

  ?>
  <?php
  // login confirmation
  if (isset($_SESSION['user_id'])) {
    redirect(web_root . "../index.php");
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
    <link href="<?php echo web_root; ?>admin/view/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo web_root; ?>admin/view/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo web_root; ?>admin/view/css/dataTables.bootstrap.css" rel="stylesheet" media="screen">
      <link rel="stylesheet" type="text/css" href="<?php echo web_root; ?>admin/view/css/jquery.dataTables.css">

    <link href="<?php echo web_root; ?>admin/view/css/bootstrap.css" rel="stylesheet" media="screen">

    <link href="<?php echo web_root; ?>admin/view/font/fonts/font-awesome.min.css" rel="stylesheet" media="screen">
    <!-- Plugins -->
    <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>admin/view/jquery/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>admin/view/js/jquery.dataTables.js"></script>
    <!-- <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>js/fixnmix.js"></script> / -->
    <link rel="icon" href="administradores/photos/logosinletras.png" type="image/x-icon">
    
  <body>


    <div class="container">

      <div class="row" id="pwd-container">          
        <div class="col-md-4"></div>
        <div class="col-md-4">

          <section class="login-form">
            <? echo check_message(); ?>
            <form method="post" action="" role="login">
              <img src="img/logo.png" height="25px" class="img-responsive" alt="" />

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
  // este include llama al controler y ejecuta el login (validacion)
  include_once '../controller/controller.php';
  ?>


  </head>

  </html>
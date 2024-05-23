<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $title; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo web_root; ?>admin/view/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo web_root; ?>admin/view/css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo web_root; ?>admin/view/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo web_root; ?>admin/view/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo web_root; ?>admin/view/css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo web_root; ?>admin/view/font/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo web_root; ?>admin/view/font/fonts/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="<?php echo web_root; ?>admin/view/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- datetime picker CSS -->
    <link href="<?php echo web_root; ?>admin/view/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo web_root; ?>admin/view/css/datepicker.css" rel="stylesheet" media="screen">

    <link href="<?php echo web_root; ?>admin/view/css/costum.css" rel="stylesheet">

    <link href="<?php echo web_root; ?>admin/view/css/ekko-lightbox.css" rel="stylesheet">

    <!-- Icono de la página -->
    <link rel="icon" href="administradores/photos/logosinletras.png" type="image/x-icon">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="<?php echo web_root; ?>admin/select2/select2.min.css">
  </head>

  <?php
  admin_confirm_logged_in();
  ?>

    <body>
      <div id="wrapper">

        <!-- Barra de navegación -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: #e1e1e1;">
          <div class="navbar-header">
            <!-- Botón para mostrar el menú en dispositivos móviles -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- Logo y nombre de la página -->
            <img src="<?php echo web_root; ?>admin/view/img/logo49.png" style="height: px;">
            <a class="navbar-brand" href="<?php echo web_root; ?>admin/view/index.php"
              style="color: #262878;">Parroquia Santa Rosa de Lima, Chocalán </a>
          </div>
          <!-- Fin de .navbar-header -->

          <!-- -------------------------------------------------------------------------------------- -->
          <!-- -------------------------------------------------------------------------------------- -->


          <!-- NAV DESPLEGABLE +NUEVO SECCIONES(FALLECIDO - PATIO - ADMINISTRADORES) --->
        
              <!-- FIN NAV -->
              <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-plus fa-fw"></i> Nuevo <i class="fa fa-caret-down"></i>
              </a>
              <ul class="dropdown-menu dropdown-user">
                <li><a href="<?php echo web_root; ?>admin/view/personas_fallecidas/index.php?view=add"><i class="fa fa-users fa-fw"></i>
                    Fallecido</a>
                </li>
                <li><a href="<?php echo web_root; ?>admin/view/patios_cementerio/index.php?view=add"><i class="fa fa-list fa-fw"></i>
                    Patio</a>
                </li>
                <li><a href="<?php echo web_root; ?>admin/view/administradores/index.php?view=add"><i class="fa fa-user fa-fw"></i>
                    administradores</a>
                </li>
            </li>
            <?php if ($_SESSION['U_ROLE'] == 'Administrador') {
              # code...
              ?>
            <?php } ?>

          </ul>

          <!-- /.dropdown-user -->
          </li>


          <?php
          $user = new User();
          $singleuser = $user->single_user($_SESSION['USERID']);

          ?>
            
            <!-- MENU DEL LADO DERECHO JUNTO AL LOGO Y BIENVENIDO: USUARIO (NOMRE SUAURIO - EDITAR MI PERFIL - CERRAR SESSION) -->
              <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                Bienvenido
                <?php echo $_SESSION['U_NAME']; ?> <img title="profile image" width="23px" height="17px"
                  src="<?php echo web_root . 'admin/view/administradores/' . $singleuser->USERIMAGE ?>">

              </a>
              
              <!-- -------------------------------------------------------------------------------------- -->
              <!-- -------------------------------------------------------------------------------------- -->

              <!-- NAV BAR-->
              <!-- MENU DESPLEGADO DEL LADO DERECHO-->
              <ul class="dropdown-menu dropdown-acnt">
                <div class="divpic">
                  <!-- IMAGEN DEL PERFIL DEL USUARIO -->
                  <a href="" data-target="#usermodal" data-toggle="modal">
                    <img title="profile image" width="70" height="80"
                      src="<?php echo web_root . 'admin/view/administradores/' . $singleuser->USERIMAGE ?>">
                  </a>
                </div>

                <!-- TEXTO NOMBRE DEL USUARIO APERTURA EN UNA NUEVA PAGINA SE VISUALIZA LA IMAGEN DEL USUARIO-->
                <div class="divtxt">
                  <li><a href="<?php echo web_root; ?>admin/view/administradores/"
                  target="_blank">
                      <?php //echo $_SESSION['USERID']; ?>
                      <?php echo $_SESSION['U_NAME']; ?>
                      </a>
                  </li>

                <!-- EDITAR PERFIL DEL USUARIO -->
                  <li>
                    <a title="Edit"
                      href="<?php echo web_root; ?>admin/view/administradores/index.php?view=edit&id=<?php echo $_SESSION['USERID']; ?>">Editar
                      mi perfil
                    </a>
                  </li>

                  <!-- CERRAR SESION -->
                  <li>
                    <a href="<?php echo web_root; ?>admin/view/logout.php"><i class="fa fa-sign-out fa-fw"></i>Cerrar sesión</a>
                  </li>
                </div>
              </ul>
            </li>
          </ul>
      
        <!-- /.navbar -->

        <!-- ------------------------------------------------------------------------------------------------------------------------------ -->
        
        
        <!-- NAV MENU - LATERAL IZQUIERDO SECCIONES Y APARTADOS DE ADMINISTRACION  -->

          <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
              <ul class="nav" id="side-menu">


                <?php if ($_SESSION['U_ROLE'] == 'Administrador') {
                  # code...
                  ?>
                  <li>
                    <a href="<?php echo web_root; ?>admin/view/administradores/index.php"><i class="fa fa-user"></i> Administradores</a>

                  </li>

                  <li>
                    <a href="<?php echo web_root; ?>admin/view/personas_fallecidas/index.php"><i class="fa fa-plus"></i> Personas Fallecidas</a>

                  </li>

                  <li>
                    <a href="<?php echo web_root; ?>admin/view/patios_cementerio/index.php"><i class="fa fa-map-marker"></i> Patios
                      Cementerio</a>

                  </li>

                  <li>
                    <a href="<?php echo web_root; ?>admin/view/pagos_mantencion/index.php"><i class="fa fa fa-cogs"></i> Manteciones Tumbas</a>

                  </li>

                  <li>
                    <a href="<?php echo web_root; ?>admin/view/calendario_eucaristias/calendario.php"><i class="fa fa-calendar"></i> Calendario
                      Eucaristías</a>

                  </li>
                  <li>
                    <a href="<?php echo web_root; ?>admin/view/reporte/index.php"><i class="fa fa-print"></i> Reporte</a>

                  </li>

                <?php } ?>

              </ul>
            </div>
            <!-- /.sidebar-collapse -->
          </div>
          <!-- /.navbar-static-side -->
        </nav>


        <!-- ------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- ESTE APARTADO DESPLIEGA APARTADO FOTO DE PERFIL LATERAL DERECHO PARA SUBIR IMAGEN DEL PERFIL DE USUARIO -->
      
          <!-- Modal -->
          <div class="modal fade" id="usermodal" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal" type="button"></button>
                  <h4 class="modal-title" id="myModalLabel">Foto de Perfil</h4>
                </div>
                <form action="<?php echo web_root; ?>admin/view/administradores/controller.php?action=photos" enctype="multipart/form-data" method="post">
                  <div class="modal-body">
                    <div class="form-group">
                      <div class="rows">
                        <div class="col-md-12">
                          <div class="rows">
                            <img title="profile image" width="500" height="360" src="<?php echo web_root . 'admin/user/' . $singleuser->USERIMAGE ?>">
                          </div><br />
                        </div>
                        <div class="col-md-12">
                          <div class="rows">
                            <div class="col-md-8">
                              <input type="hidden" name="MIDNO" id="MIDNO" value="<?php echo $_SESSION['USERID']; ?>">
                              <input name="MAX_FILE_SIZE" type="hidden" value="1000000"> 
                              <input id="photo" name="photo" type="file">
                            </div>
                            <div class="col-md-4"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">cerrar</button>
                    <button class="btn btn-primary" name="savephoto" type="submit">subir foto</button>
                  </div>
                </form>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->


          <!-- ------------------------------------------------------------------------------------------------------------------------------ -->


          <!-- ESTE APARTADO ES DEL MENU breadcrumb CONTENIDO EN LINKS CLIC REDIRIGE AL PANEL ADMINISTRADORES y UBICACION ACTUAL EN APARTADOS -->
                
            
              <div id="page-wrapper">

          <div class="row">

            <div class="col-lg-12" style="margin-top: 4%">
              <?php
              if ($title <> 'Panel Administrador') {
                echo '
                          <p class="breadcrumb" >  <a href="' . web_root . '/admin/view/index.php" title="Panel Administrador" >Panel Administrador</a>  / 
                              <a href="index.php" title="' . $title . '" >' . $title . '</a> 
                              ' . (isset($header) ? ' / ' . $header : '') . '   </p>';
              } ?>

              <?php check_message(); ?>
              <?php require_once $content; ?>

            </div>

      
              <!-- /.col-lg-12 -->

            </div>
            <!-- /.row -->

            </div>
            <!-- /#page-wrapper -->

            </div>
            <!-- /#wrapper -->

        
          <!-- ------------------------------------------------------------------------------------------------------------------------------ -->


      <!-- Modal -->
      <div class="modal fade" id="usermodal" tabindex="-1">
        <!-- Código del modal -->
      </div>
    <!-- jQuery -->
    <script src="<?php echo web_root; ?>admin/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo web_root; ?>admin/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo web_root; ?>admin/js/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo web_root; ?>admin/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo web_root; ?>admin/js/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript" src="<?php echo web_root; ?>js/bootstrap-datepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="<?php echo web_root; ?>js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="<?php echo web_root; ?>js/bootstrap-datetimepicker.uk.js"
      charset="UTF-8"></script>

    <script type="text/javascript" language="javascript"
      src="<?php echo web_root; ?>admin/input-mask/jquery.inputmask.js"></script>
    <script type="text/javascript" language="javascript"
      src="<?php echo web_root; ?>admin/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script type="text/javascript" language="javascript"
      src="<?php echo web_root; ?>admin/input-mask/jquery.inputmask.extensions.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo web_root; ?>admin/js/ekko-lightbox.js"></script>
    <script src="<?php echo web_root; ?>admin/js/sb-admin-2.js"></script>

    <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>admin/js/janobe.js"></script>
    <script src="<?php echo web_root; ?>admin/select2/select2.full.min.js"></script>

    </body>
    <footer>
      <!--<div class="row">
        <div class="col-lg-12">
            <img src= /PARROQUIA_CHOCALAN/img/ceenteriofullHD.png alt="Descripción de la imagen" 
            class="img-responsive" style="max-width: 20%; height: auto; margin: 0 auto;">
        </div>
        </div>';-->
      <div style="text-align: center;">&copy; 2024 Made by JennyP@nk</div>
    </footer>

</html>
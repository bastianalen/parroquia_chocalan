<?php 
require_once '../model/initialize.php';
// Four steps to closing a session
// (i.e. logging out)

// 1. Find the session
@session_start();

// 2. Unset all the session variables
unset( $_SESSION['user_id'] );
unset( $_SESSION['nombre'] );
unset( $_SESSION['user_nom'] );
unset( $_SESSION['user_contra'] );
unset( $_SESSION['id_rol'] ); 
// 4. Destroy the session
// session_destroy();
redirect(web_root."admin/view/login.php?logout=1");
?>
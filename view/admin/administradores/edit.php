<?php
if (!isset($_SESSION['user_id'])) {
  redirect(web_root . "view/admin/index.php");
}

@$user_id = $_GET['id'];
if ($user_id == '') {
  redirect("index.php");
}
$user = new User();
$singleuser = $user->single_user($user_id);

$rol = new RolUser();
$roles = $rol->listofroluser();
?>

<form class="form-horizontal span6" action="../../../controller/controlleradministradores.php?action=edit" method="POST">

  <fieldset>
    <legend>
      Actualizar Cuenta de Usuario</legend>


    <input class="form-control input-sm" id="user_id" name="user_id" placeholder="Account Id" type="Hidden"
      value="<?php echo $singleuser->user_id; ?>">

    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="nombre">Nombre y Apellido:</label>

        <div class="col-md-8">
          <input name="deptid" type="hidden" value="">
          <input class="form-control input-sm" id="nombre" name="nombre" placeholder="nombre de la cuenta" type="text"
            value="<?php echo $singleuser->nombre; ?>">
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="user_nom">Correo electrónico:</label>

        <div class="col-md-8">
          <input name="deptid" type="hidden" value="">
          <input class="form-control input-sm" id="user_nom" name="user_nom" placeholder="correo" type="text"
            value="<?php echo $singleuser->user_nom; ?>">
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="user_contra">Contraseña:</label>

        <div class="col-md-8">
          <input name="deptid" type="hidden" value="">
          <input class="form-control input-sm" id="user_contra" name="user_contra" placeholder="contraseña" type="Password"
            value="" required>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="id_rol">Rol:</label>

        <div class="col-md-8">
          <select class="form-control input-sm" name="id_rol" id="id_rol">

            <?php
              foreach ($roles as $result) {
                if ($result['id_rol'] == $singleuser-> id_rol){
                  echo '<option SELECTED value="' . $result['id_rol'] . '" class="option">' . $result['rol_nom'] .'</option>';
                  }else {
                    echo '<option value="' . $result['id_rol'] . '" class="option">' . $result['rol_nom'] .'</option>';
                  }
              }
            ?>

          </select>
        </div>
      </div>
    </div>


    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="idno"></label>

        <div class="col-md-8">
          <button class="btn btn-primary " name="save" type="submit"><span class="fa fa-save fw-fa"></span>
            Save</button>
        </div>
      </div>
    </div>


  </fieldset>

  <div class="form-group">
    <div class="rows">
      <div class="col-md-6">
        <label class="col-md-6 control-label" for="otherperson"></label>

        <div class="col-md-6">

        </div>
      </div>



      </div>

    </div>
  </div>

</form>


</div><!--End of container-->
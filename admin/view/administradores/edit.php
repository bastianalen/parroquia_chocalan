<?php
if (!isset($_SESSION['user_id'])) {
  redirect(web_root . "admin/view/index.php");
}

@$user_id = $_GET['id'];
if ($user_id == '') {
  redirect("index.php");
}
$user = new User();
$singleuser = $user->single_user($user_id);

?>

<form class="form-horizontal span6" action="controller.php?action=edit" method="POST">

  <fieldset>
    <legend>
      Actualizar cuenta de usuario</legend>

    <!-- <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "user_id">User Id:</label> -->

    <!-- <div class="col-md-8"> -->

    <input class="form-control input-sm" id="user_id" name="user_id" placeholder="Account Id" type="Hidden"
      value="<?php echo $singleuser->user_id; ?>">
    <!--    </div>
                    </div>
                  </div>      -->

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
            <option value="Administrator" <?php echo ($singleuser->id_rol == 1) ? 'selected="true"' : ''; ?>>Administrador</option>

            <!-- <option value="Customer">Customer</option> -->
            <!-- <option value="Cashier" <?php echo ($singleuser->id_rol == 2) ? 'selected="true"' : ''; ?>>Cashier</option> -->
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
          <!-- <a href="index.php" class="btn btn-info"><span class="fa fa-arrow-circle-left fw-fa"></span>&nbsp;<strong>List of Users</strong></a> -->
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

      <!-- <div class="col-md-6" align="right"> -->


      </div>

    </div>
  </div>

</form>


</div><!--End of container-->
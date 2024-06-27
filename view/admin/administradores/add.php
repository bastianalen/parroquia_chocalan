<?php
if (!isset($_SESSION['user_id'])) {
  redirect(web_root . "view/admin/index.php");
}

// $autonum = New Autonumber();
// $res = $autonum->single_autonumber(2);

?>
<form class="form-horizontal span6" action="../../../controller/controlleradministradores.php?action=add" method="POST">

  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Agregar Nuevo Usuario</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="nombre">Nombre y Apellido:</label>

      <div class="col-md-8">
        <input name="deptid" type="hidden" value="">
        <input class="form-control input-sm" id="nombre" name="nombre" placeholder="nombre y apellido" type="text" value="">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="user_nom">Correo electrónico:</label>

      <div class="col-md-8">
        <input name="deptid" type="hidden" value="">
        <input class="form-control input-sm" id="user_nom" name="user_nom" placeholder="E-mail" type="text"
          value="">
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
          <option value=1>Administrador</option>
        </select>
      </div>
    </div>
  </div>



  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="idno"></label>

      <div class="col-md-8">
        <button class="btn btn-primary btn-sm" name="save" type="submit"><span class="fa fa-save fw-fa"></span>
          Guardar</button>
        <a href="index.php" class="btn btn-info"><span class="fa fa-arrow-circle-left fw-fa"></span></span>&nbsp;<strong>Atrás</strong></a>
      </div>
    </div>
  </div>


  <div class="form-group">
    <div class="rows">
      <div class="col-md-6">
        <label class="col-md-6 control-label" for="otherperson"></label>

        <div class="col-md-6">

        </div>
      </div>

      <div class="col-md-6" align="right">


      </div>

    </div>
  </div>

</form>
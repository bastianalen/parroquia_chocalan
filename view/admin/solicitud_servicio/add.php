<?php
if (!isset($_SESSION['user_id'])) {
  redirect(web_root . "view/admin/index.php");
}

?>
<form class="form-horizontal span6" action="../../../controller/controllersolicitudservicios.php?action=add" method="POST">

  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Agregar Nuevo Patio</h1>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="sector">Patio:</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="sector" name="sector" placeholder="" type="text" value="">
      </div>
    </div>
  </div>



  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="idno"></label>

      <div class="col-md-8">
        <button class="btn btn-primary btn-sm" name="save" type="submit"><span class="fa fa-save fw-fa"></span>
          Guardar</button>
        <a href="index.php" class="btn btn-info"><span
            class="fa fa-arrow-circle-left fw-fa"></span>&nbsp;<strong>Atrás</strong></a>

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


    </div>
  </div>

</form>
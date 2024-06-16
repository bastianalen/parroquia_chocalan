<?php


if (!isset($_SESSION['user_id'])) {
  redirect(web_root . "admin/view/index.php");
}


?>
<form class="form-horizontal span6" action="../../../controller/controllerpagosmantencion.php?action=add" method="POST" >
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Nuevo pago mantencion</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="rut">rut :</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="rut" name="rut" placeholder="rut"
          type="text" value="">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="n_tumba">n_tumba :</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="n_tumba" name="n_tumba" placeholder="n_tumba"
          type="number" value="">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="patio">patio :</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="patio" name="patio" placeholder="patio"
          type="text" value="">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="propietario">propietario :</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="propietario" name="propietario" placeholder="propietario"
          type="text" value="">
      </div>
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="fecha_pago">fecha_pago :</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="fecha_pago" name="fecha_pago" placeholder="fecha_pago"
          type="date" value="">
      </div>
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="monto">monto :</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="monto" name="monto" placeholder="monto"
          type="number" value="">
      </div>
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="estado_pago">estado_pago :</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="estado_pago" name="estado_pago" placeholder="estado_pago"
          type="text" value="">
      </div>
    </div>
  </div>

  
  
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="idno"></label>

      <div class="col-md-8">
        <button class="btn  btn-primary btn-sm" name="save" type="submit"><span class="fa fa-save fw-fa"></span>
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

      <div class="col-md-6" align="right">


      </div>

    </div>
  </div>
</form>
<?php


if (!isset($_SESSION['user_id'])) {
  redirect(web_root . "admin/view/index.php");
}
$id_persona = $_GET['id_persona'];
$anios_pagados = $_GET['anios'];

$anio = new Anio();
$anios = $anio->list_of_anio();

$persona = new Persona();
$datos_persona = $persona->single_people_id($id_persona);
?>
<form class="form-horizontal span6" action="../../../controller/controllerpagosmantencion.php?action=add" method="post">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Agregar Nuevo Pago Mantención</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <input type="hidden" name="id_persona" id="id_persona" value="<?php echo $id_persona ?>">
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="propietario">Propietario:</label>

      <div class="col-md-8">
        <!--<input class="form-control input-sm" id="n_tumba" name="n_tumba" placeholder="número tumba"
          type="number" value="">-->
        <p><span name="propietario" id="propietario"><?php echo $datos_persona->propietario ?></span></p>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="pnombre">Difunto:</label>

      <div class="col-md-8">
        <!--<input class="form-control input-sm" id="n_tumba" name="n_tumba" placeholder="número tumba"
          type="number" value="">-->
        <p><span name="pnombre" id="pnombre"><?php echo $datos_persona->pnombre ?></span></p>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="monto">Monto:</label>

      <div class="col-md-8">
        <input type="number" name="monto" id="monto">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="anio">Año de Pago:</label>

      <div class="col-md-8">
        <select name="anio" id="anio">

        </select>
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
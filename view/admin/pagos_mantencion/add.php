<?php


if (!isset($_SESSION['user_id'])) {
  redirect(web_root . "admin/view/index.php");
}
$id_sector = $_GET['sector'];
$n_tumba_add = $_GET['n_tumba'];
$anios_pagados = $_GET['anios'];

$sector = new Sector();
$sectores = $sector->single_sector($id_sector);
$anio = new Anio();
$anios = $anio->list_of_anio();

?>
<form class="form-horizontal span6" action="../../../controller/controllerpagosmantencion.php?action=add" method="post">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Agregar Nuevo Pago Mantención</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="n_tumba">Tumba:</label>

      <div class="col-md-8">
        <!--<input class="form-control input-sm" id="n_tumba" name="n_tumba" placeholder="número tumba"
          type="number" value="">-->
        <p name="n_tumba"><?php echo $n_tumba_add ?></p>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="id_sector">Sector:</label>

      <div class="col-md-8">
        <p name="id_sector"><?php echo $sectores->sector; ?></p>
      </div>
    </div>
  </div>


  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="anio">Año de Pago:</label>

      <div class="col-md-8">
        <select name="anio" id="anio">
          <?php
          foreach ($anios as $anio) {
            echo "<script>console.log('pasgos: ".$anios_pagados."')</script>";
            echo "<script>console.log('pasgos: ".json_decode($anios_pagados, true)."')</script>";
            foreach ($anios_pagados as $result) {

              if ($anio == $result) {
                echo '<option value='.$anio["id_anio"].'>'.$anio["anio"].' Pagado</option>';
              } 
              else {
                echo '<option value='.$anio["id_anio"].'>'.$anio["anio"].'</option>';
              }
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
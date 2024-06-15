<?php

include "../../../controller/controllerpagosmantencion.php";
 
// Comprobar si la sesión ya está iniciada


if (!isset($_SESSION['user_id'])) {
   header("Location: index.php");
   exit();
}

?>  

<form class="form-horizontal span6" action="../../../controller/controllerpagosmantencion.php?action=index" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Editar Datos</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="RUT">RUT :</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="RUT" name="RUT" placeholder="RUT"
          type="text" value="<?=$datos->RUT?>">

      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="N_TUMBA">N_TUMBA :</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="N_TUMBA" name="N_TUMBA" placeholder="N_TUMBA"
          type="number"value="<?php echo $record['N_TUMBA']; ?>">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="PATIO">PATIO :</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="PATIO" name="PATIO" placeholder="PATIO"
          type="text" value="<?php echo $record['PATIO']; ?>">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="PROPIETARIO">PROPIETARIO :</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="PROPIETARIO" name="PROPIETARIO" placeholder="PROPIETARIO"
          type="text" value="<?php echo $record['PROPIETARIO']; ?>">

      </div>
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="FECHA PAGO">FECHA PAGO :</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="FECHA_PAGO" name="FECHA_PAGO" placeholder="AÑO"
          type="year" value="<?php echo $record['FECHA_PAGO']; ?>">
      </div>
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="MONTO">MONTO :</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="MONTO" name="MONTO" placeholder="MONTO"
          type="number" value="<?php echo $record['MONTO']; ?>">
      </div>
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="ESTADO_PAGO">ESTADO DE PAGO :</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="ESTADO_PAGO" name="ESTADO_PAGO" placeholder="ESTADO DE PAGO"
          type="text" value="<?php echo $record['ESTADO_PAGO']; ?>">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="idno"></label>

      <div class="col-md-8">
        <button class="btn  btn-primary btn-sm" name="update" type="submit"><span class="fa fa-save fw-fa"></span>
          Actualizar</button>
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
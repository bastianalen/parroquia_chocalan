<?php
if (!isset($_SESSION['user_id'])) {
  redirect(web_root . "view/admin/index.php");
}

// $autonum = New Autonumber();
// $result = $autonum->single_autonumber(4);

?>
<form class="form-horizontal span6" action="../../../controller/controllerpersonafallecida.php?action=add" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Agregar Nuevo Fallecido</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="rut">Rut del fallecido:</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="rut" name="rut" placeholder="11.111.111-1" type="text"
          value="">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="nro_tumba">Tumba:</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="nro_tumba" name="nro_tumba" placeholder="número de tumba" type="text"
          value="">
      </div>
    </div>
  </div>


  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="pnombre">Fallecido:</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="pnombre" name="pnombre" placeholder="nombre completo" type="text" value="">
      </div>
    </div>
  </div>

  <!--  

                  
 -->


  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="fecha_nacimiento">Fecha Nacimiento:</label>

      <div class="col-md-8">
        <div class="input-group" id="">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input id="datemask2" name="fecha_nacimiento" value="" type="text" class="form-control input-sm datemask2"
            data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
        </div>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="fecha_muerte">Fecha Defunción:</label>

      <div class="col-md-8">
        <div class="input-group" id="">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input id="datemask2" name="fecha_muerte" value="" type="text" class="form-control input-sm datemask2"
            data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="sector">Patio:</label>

      <div class="col-md-8">
        <select class="form-control input-sm" name="sector" id="sector">
          <option value="0">ubicación de tumba</option>
          <?php
          //Statement
          $sector = new Sector();
          $sectores = $sector->listofsector();

          foreach ($sectores as $result) {
            echo '<option value=' . $result['id_sector'] . ' >' . $result['sector'] . '</option>';
          }
          ?>

        </select>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="tipo_tumba">Tipo Tumba:</label>
      <div class="col-md-8">

        <select class="form-control input-sm" name="tipo_tumba" id="tipo_tumba">
          <option value="0">seleccionar</option>
          <?php
          //Statement
          $tipotumba = new TipoTumba();
          $tipotumbas = $tipotumba->listoftipotumba();

          foreach ($tipotumbas as $result) {
            echo '<option value=' . $result['id_tipo_tumba'] . ' >' . $result['tipo'] . '</option>';
          }
          ?>

        </select>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="propietario">Propietario:</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="propietario" name="propietario" placeholder="nombre propietario"
          type="text" value="">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="caracteristicas">Características:</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="caracteristicas" name="caracteristicas" placeholder="características" type="text" value="">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="escritura">Escritura:</label>
      <div class="col-md-8">
        
        <input type="file" id="escritura" name="escritura" accept=".pdf, .doc, .docx, .jpg, .png, .jpeg,">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="new_escritura">Renovación de escrituras:</label>
      <div class="col-md-8">
        
        <input type="file" id="new_escritura" name="new_escritura" accept=".pdf, .doc, .docx, .jpg, .png, .jpeg,">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="pase_sepul">Pase de sepultacion:</label>
      <div class="col-md-8">
        
        <input type="file" id="pase_sepul" name="pase_sepul" accept=".pdf, .doc, .docx, .jpg, .png, .jpeg,">
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
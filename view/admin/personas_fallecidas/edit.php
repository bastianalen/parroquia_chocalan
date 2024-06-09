<?php
if (!isset($_SESSION['user_id'])) {
  redirect(web_root . "view/admin/index.php");
}
$rut = $_GET['id'];
$person = new Persona();
$p = $person->single_people($rut);
?>
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">Editar Fallecido</h1>
  </div>
  <!-- /.col-lg-12 -->
</div>
<form class="form-horizontal span6" action="../../../controller/controllerpersonafallecida.php?action=edit" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="nro_tumba">Tumba:</label>
        <div class="col-md-8">
          <input type="hidden" name="rut" value="<?php echo $p->rut; ?>">
          <input class="form-control input-sm" id="nro_tumba" name="nro_tumba" placeholder="Grave Number" type="text"
            value="<?php echo $p->nro_tumba ?>">
        </div>
      </div>
    </div>  
    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="pnombre">Fallecido:</label>
        <div class="col-md-8">
          <input class="form-control input-sm" id="pnombre" name="pnombre" placeholder="Full Name" type="text"
            value="<?php echo $p->pnombre ?>">
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="fecha_nacimiento">Fecha Nacimiento:</label>
        <div class="col-md-8">
          <div class="input-group" id="">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input id="datemask2" name="fecha_nacimiento" 
            value="<?php
            $dd_nacimiento = ($p->dd_nacimiento == "" || $p->dd_nacimiento == 0) ? "--" : $p->dd_nacimiento;
            $mm_nacimiento= ($p->mm_nacimiento == "" || $p->mm_nacimiento == 0) ? "--" : $p->mm_nacimiento;
            $yyyy_nacimiento = ($p->yyyy_nacimiento == "" || $p->yyyy_nacimiento == 0) ? "--" : $p->yyyy_nacimiento;;
            $fecha_nacimiento = $dd_nacimiento . "/" . $mm_nacimiento . "/" . $yyyy_nacimiento;
            echo $fecha_nacimiento ?>"
            type="text" class="form-control input-sm datemask2" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
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
            <input id="datemask2" name="fecha_muerte" value="<?php 
            $dd_muerte = $p->dd_muerte = ($p->dd_muerte == "" || $p->dd_muerte == 0) ? "--" : $p->dd_muerte; 
            $mm_muerte = $p->mm_muerte = ($p->mm_muerte == "" || $p->mm_muerte == 0) ? "--" : $p->mm_muerte;
            $yyyy_muerte = $p->yyyy_muerte = ($p->yyyy_muerte == "" || $p->yyyy_muerte == 0) ? "--" : $p->yyyy_muerte;
            $fecha_muerte = $dd_muerte. "/". $mm_muerte. "/". $yyyy_muerte;
            echo $fecha_muerte?>"
            type="text"
              class="form-control input-sm datemask2" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="sector">Patio:</label>
        <div class="col-md-8">
          <select class="form-control input-sm" name="id_sector" id="sector">
            <option value="None">ubicación de tumba</option>
            <?php
            //Statement
            $sector = new Sector();
            $sectores = $sector->listofsector();
            foreach ($sectores as $result) {
              if ($result['id_sector'] == $p-> id_sector){
                echo '<option SELECTED  value=' . $result['id_sector'] . ' >' . $result['sector'] . '</option>';
              }else {
                echo '<option  value=' . $result['id_sector'] . ' >' . $result['sector'] . '</option>';
              }
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
            <option value="None">seleccionar</option>

            <?php
            //Statement
            $tipotumba = new TipoTumba();
            $tipotumbas = $tipotumba->listoftipotumba();
            foreach ($tipotumbas as $result) {
              if ($result['id_tipo_tumba'] == $p-> tipo_tumba){
                echo '<option SELECTED  value=' . $result['id_tipo_tumba'] . ' >' . $result['tipo'] . '</option>';
              }else {
                echo '<option  value=' . $result['id_tipo_tumba'] . ' >' . $result['tipo'] . '</option>';
              }
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
          <input class="form-control input-sm" id="propietario" name="propietario" placeholder="Last Name" type="text"
            value="<?php echo $p->propietario ?>">
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="caracteristicas">Características:</label>

        <div class="col-md-8">
          <input class="form-control input-sm" id="caracteristicas" name="caracteristicas" placeholder="Middle Name" type="text"
            value="<?php echo $p->caracteristicas ?>">
        </div>
      </div>
    </div>
    <!-- Cargar Escritura -->
    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="escritura">Escritura:</label>
        <div class="col-md-8">
          
          <input type="file" id="escritura" name="escritura" accept=".pdf, .doc, .docx, .jpg, .png, .jpeg,">
        </div>
      </div>
    </div>
    <!-- Cargar Escritura Actualizada-->
    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="new_escritura">Escritura Actualizada:</label>
        <div class="col-md-8">
          
          <input type="file" id="new_escritura" name="new_escritura" accept=".pdf, .doc, .docx, .jpg, .png, .jpeg,">
        </div>
      </div>
    </div>
    <!-- Cargar Pase de sepultacion-->
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
            Save</button>
        </div>
      </div>
    </div>
  </div>
  <!--/.fluid-container-->
</form>
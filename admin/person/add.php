<?php
if (!isset($_SESSION['USERID'])) {
  redirect(web_root . "index.php");
}

// $autonum = New Autonumber();
// $result = $autonum->single_autonumber(4);

?>
<form class="form-horizontal span6" action="controller.php?action=add" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Agregar Nuevo Fallecido</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="GRAVENO">Tumba:</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="GRAVENO" name="GRAVENO" placeholder="número de tumba" type="text"
          value="">
      </div>
    </div>
  </div>


  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="FNAME">Fallecido:</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="FNAME" name="FNAME" placeholder="nombre completo" type="text" value="">
      </div>
    </div>
  </div>

  <!--  

                  
 -->


  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="BORNDATE">Fecha Nacimiento:</label>

      <div class="col-md-8">
        <div class="input-group" id="">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input id="datemask2" name="BORNDATE" value="" type="text" class="form-control input-sm datemask2"
            data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
        </div>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="DIEDDATE">Fecha Defunción:</label>

      <div class="col-md-8">
        <div class="input-group" id="">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input id="datemask2" name="DIEDDATE" value="" type="text" class="form-control input-sm datemask2"
            data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="CATEGORIES">Patio:</label>

      <div class="col-md-8">
        <select class="form-control input-sm" name="CATEGORIES" id="CATEGORIES">
          <option value="None">ubicación de tumba</option>
          <?php
          //Statement
          $mydb->setQuery("SELECT * FROM `tblcategory`");
          $cur = $mydb->loadResultList();

          foreach ($cur as $result) {
            echo '<option value=' . $result->CATEGORIES . ' >' . $result->CATEGORIES . '</option>';
          }
          ?>

        </select>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="TIPO_TUMBA">Tipo Tumba:</label>
      <div class="col-md-8">

        <select class="form-control input-sm" name="TIPO_TUMBA" id="TIPO_TUMBA">
          <option value="None">seleccionar</option>
          <option value="Individual">Individual</option>
          <option value="Familiar">Familiar</option>
          <option value="Individual/Familiar">Individual/Familiar</option>
        </select>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="PROPIETARIO">Propietario:</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="PROPIETARIO" name="PROPIETARIO" placeholder="nombre propietario"
          type="text" value="">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="MNAME">Características:</label>

      <div class="col-md-8">
        <input class="form-control input-sm" id="MNAME" name="MNAME" placeholder="características" type="text" value="">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="ESCRITURA">Escritura:</label>
      <div class="col-md-8">
        
        <input type="file" id="ESCRITURA" name="ESCRITURA" accept=".pdf, .doc, .docx, .jpg, .png, .jpeg,">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="new_escritura">Renobación de escrituras:</label>
      <div class="col-md-8">
        
        <input type="file" id="new_escritura" name="new_escritura" accept=".pdf, .doc, .docx, .jpg, .png, .jpeg,">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="pase_sepultacion">Pase de sepultacion:</label>
      <div class="col-md-8">
        
        <input type="file" id="pase_sepultacion" name="pase_sepultacion" accept=".pdf, .doc, .docx, .jpg, .png, .jpeg,">
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
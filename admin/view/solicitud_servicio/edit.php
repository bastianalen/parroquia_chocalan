<?php
if (!isset($_SESSION['user_id'])){
  redirect(web_root."admin/index.php");
}


$id_solicitud = $_GET['id'];
$solicitud = New Solicitud();
$single_solicitud = $solicitud->single_solicitud($id_solicitud);
?> 
<form class="form-horizontal span6" action="controller.php?action=edit" method="POST">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header"></h1>
    </div> 
  </div> 

  <div class="form-group">
    <div class="col-md-8">
      <!-- <label class="col-md-4 control-label" for="solicitud">Solicitud</label> -->
      <div class="col-md-4"></div>
      <div class="col-md-8">
        <input  id="id_solicitud" name="id_solicitud"   type="HIDDEN" value="<?php echo $single_solicitud->id_solicitud; ?>">
        <input class="form-control input-sm" id="solicitud" name="solicitud" placeholder="Section" type="text" value="<?php echo $single_solicitud->nombre; ?>">
        <label for="servicio">Fecha solicitada: </label>
        <input class="form-control input-sm" id="servicio" name="servicio" placeholder="Section" type="text" value="<?php echo $single_solicitud->fecha_solicitud; ?>">
        <label for="servicio">Tipo de servicio solicitado: </label>
        <input class="form-control input-sm" id="servicio" name="servicio" placeholder="Section" type="text" value="<?php echo $single_solicitud->tipo; ?>">
        <label for="servicio">Hora solicitada: </label>
        <input class="form-control input-sm" id="hora_servicio" name="hora_servicio" placeholder="Section" type="text" value="<?php echo $single_solicitud->hora; ?>">
        
      </div>
    </div>
  </div>


            
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="idno"></label>
      <div class="col-md-8">
        <button class="btn btn-primary btn-sm" name="save" type="submit" ><span class="fa fa-save fw-fa"></span> Guardar</button>
                   
      </div>
    </div>
  </div>

               

  <div class="form-group">
    <div class="rows">
      <div class="col-md-6">
        <label class="col-md-6 control-label" for=
                    "otherperson"></label>

        <div class="col-md-6">
                   
        </div>
      </div>         
    </div>
  </div>
          
</form>
      
 
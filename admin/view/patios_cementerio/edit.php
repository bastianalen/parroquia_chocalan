<?php
    if (!isset($_SESSION['user_id'])){
      redirect(web_root."admin/index.php");
     }


  $id_sector = $_GET['id'];
  $sector = New Sector();
  $singlesector = $sector->single_sector($id_sector);

?> 
 <form class="form-horizontal span6" action="controller.php?action=edit" method="POST">
 
              <div class="row">
         <div class="col-lg-12">
            <h1 class="page-header"></h1>
          </div> 
       </div> 

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for="sector">Patio</label>

                      <div class="col-md-8">
                       <input  id="id_sector" name="id_sector"   type="HIDDEN" value="<?php echo $singlesector->id_sector; ?>">
                         <input class="form-control input-sm" id="sector" name="sector" placeholder=
                            "Section" type="text" value="<?php echo $singlesector->sector; ?>">
                      </div>
                    </div>
                  </div>


            
             <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "idno"></label>

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
      
 
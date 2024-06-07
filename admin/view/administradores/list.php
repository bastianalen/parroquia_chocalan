<?php
	 if (!isset($_SESSION['user_id'])){
      redirect(web_root."../view/index.php");
     }

?>

<div class="row">
       	 <div class="col-lg-12">
            <h1 class="page-header">Lista de Usuarios  <a href="index.php?view=add" class="btn btn-primary btn-xs  ">  <i class="fa fa-plus-circle fw-fa"></i> Nuevo</a>  </h1>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
	 		    <form action="controller.php?action=delete" Method="POST">  
			      <div class="table-responsive">			
				<table id="example" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
				
				  <thead>
				  	<tr>
				  		<!-- <th>#</th> -->
				  		<th>
				  		 <!-- <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');">  -->
				  		 Nombre de cuenta</th>
				  		<th>Nombre de usuario</th>
				  		<th>Rol</th>
				  		<th width="10%" >Acción</th>
				 
				  	</tr>	
				  </thead> 
				  <tbody>
				  	<?php 
				  		// $mydb->setQuery("SELECT * 
								// 			FROM  `tblusers` WHERE TYPE != 'Customer'");
				  		$mydb->setQuery("SELECT * 
											FROM  tblcuentauser tu INNER JOIN tblroluser tr on tu.id_rol = tr.id_rol");
				  		$cur = $mydb->loadResultList();

						foreach ($cur as $result) {
				  		echo '<tr>';
				  		// echo '<td width="5%" align="center"></td>';
				  		echo '<td>' . $result->nombre.'</a></td>';
				  		echo '<td>'. $result->user_nom.'</td>';
				  		echo '<td>'. $result->rol_nom.'</td>';
				  		If($result->user_id==$_SESSION['user_id'] || $result->id_rol== 2 || $result->id_rol== 1 ) {
				  			$active = "Disabled";

				  		}else{
				  			$active = "";

				  		}

				  		echo '<td align="center" > <a title="Editar" href="index.php?view=edit&id='.$result->user_id.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
				  					 <a title="Borrar" href="controller.php?action=delete&id='.$result->user_id.'" class="btn btn-danger btn-xs" ><span class="fa fa-trash-o fw-fa"></span> </a>
				  					 </td>';
				  		echo '</tr>';
				  	} 
				  	?>
				  </tbody>
				</table>
			</div>
				</form>
	

</div> <!---End of container-->
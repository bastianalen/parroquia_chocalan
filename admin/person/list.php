<?php
if (!isset($_SESSION['USERID'])) {
	redirect(web_root . "admin/index.php");
}
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Lista de Fallecidos <a href="index.php?view=add" class="btn btn-primary btn-xs  "> <i
					class="fa fa-plus-circle fw-fa"></i> Nuevo</a> </h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<form action="controller.php?action=delete" Method="POST">
	<div class="table-responsive">
		<table id="dash-table" class="table table-striped table-bordered table-hover" style="font-size: 12px"
			cellspacing="0">
			<thead>
				<tr>
					<th>Selección</th>
					<th>Tumba</th>
					<th>Fallecido</th>
					<th>Fecha Nacimiento</th>
					<th>Fecha Defunción</th>
					<th>Patio</th>
					<th width="10%">Tipo Tumba</th>
					<th>Propietario</th>
					<th>Características</th>
					<th>Escritura</th>
					<th>Acción</th>
				</tr>
			</thead>

			<tbody>
				<?php
				$query = "SELECT * FROM `tblpeople`";
				$mydb->setQuery($query);
				$cur = $mydb->loadResultList();
				foreach ($cur as $result) {
					$borndate = $result->BORNDATE;
					$dieddate = $result->DIEDDATE;
					echo '<tr>';
					echo '<td width="1%" align="center"><input type="checkbox" name="selector[]" id="selector[]" value="' . $result->PEOPLEID . '"/>';
					echo '<td width="1%" align="center">' . $result->GRAVENO . '</td>';
					echo '<td><a title="edit" href="' . web_root . 'admin/person/index.php?view=edit&id=' . $result->PEOPLEID . '"><i class="fa fa-pencil "></i>' . $result->FNAME . '</a></td>';
					echo '<td>' . $borndate . '</td>';
					echo '<td>' . $dieddate . '</td>';
					echo '<td>' . $result->CATEGORIES . '</td>';
					echo '<td>' . $result->TIPO_TUMBA . '</td>';
					// Verificar si PROPIETARIO está definido antes de mostrarlo
					echo '<td>' . (isset($result->PROPIETARIO) ? $result->PROPIETARIO : '') . '</td>';
					// Verificar si MNAME está definido antes de mostrarlo
					echo '<td>' . (isset($result->MNAME) ? $result->MNAME : '') . '</td>';
					// El siguiente bloque if estaba fuera del bucle foreach, corregido para estar dentro
					if (isset($_GET['id'])) {
						$active = ($_GET['id'] == $result->USERID) ? "active" : "";
					} else {
						$active = "";
					}


					echo '<td>';
					if (isset($result->ESCRITURA) && !empty($result->ESCRITURA)) {
						$archivo = $result->ESCRITURA;
						echo '<a href="descargar_archivo.php?archivo=' . $archivo . '" class="btn btn-primary">Descargar</a>';
					} else {
						echo '';
					}
					echo '</td>';





					echo '<td align="center" > <a title="Editar" href="index.php?view=edit&id=' . $result->PEOPLEID . '"  class="btn btn-primary btn-xs ' . $active . '">  <span class="fa fa-edit fw-fa"></span></a>					
					<button type="submit" class="btn btn-danger btn-xs" name="delete"><i class="fa fa-trash fw-fa"></i>
					</button>
                     </td>';
					echo '</tr>';
				}
				?>
			</tbody>
		</table>
		<!--<div class="btn-group">
			 <a href="index.php?view=add" class="btn btn-default">New</a> 
			
		</div>-->
	</div>
</form>
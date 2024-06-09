<?php
if (!isset($_SESSION['user_id'])) {
	redirect(web_root . "view/admin/index.php");
}
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Lista de Fallecidos <a href="index.php?view=add" class="btn btn-primary btn-xs  "> <i
					class="fa fa-plus-circle fw-fa"></i> Nuevo</a> </h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<form action="../../../controller/controllerpersonafallecida.php?action=delete" Method="POST">
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
					<th>Escritura actualizada</th>
					<th>Pase de Sepultación</th>
					<th>Acción</th>
				</tr>
			</thead>

			<tbody>
				<?php

				$persona = new Persona();
				$personas = $persona->listofpeople();
				// funcion para validar precencia de datos
				function format_date_component($component) {
					return ($component == "" || $component == 0) ? "--" : $component;
				}
				foreach ($personas as $result) {
					// Se arma la estructura de las fechas de nacimiento y muerte (Pueden faltar valores)

					// Validación nacimiento
					$dd_nacimiento = format_date_component($result['dd_nacimiento']);
					$mm_nacimiento = format_date_component($result['mm_nacimiento']);
					$yyyy_nacimiento = format_date_component($result['yyyy_nacimiento']);
					// Validación muerte
					$dd_muerte = format_date_component($result['dd_muerte']);
					$mm_muerte = format_date_component($result['mm_muerte']);
					$yyyy_muerte = format_date_component($result['yyyy_muerte']);
					// Estructura de las fechas
					$fecha_nacimiento = $dd_nacimiento . "/" . $mm_nacimiento . "/" . $yyyy_nacimiento;
					$fecha_muerte = $dd_muerte . "/" . $mm_muerte . "/" . $yyyy_muerte;
					echo '<tr>';
					echo '<td width="1%" align="center"><input type="checkbox" name="selector[]" id="selector[]" value="' . $result['rut'] . '"/>';
					echo '<td width="1%" align="center">' . $result['nro_tumba'] . '</td>';
					echo '<td><a title="edit" href="' . web_root . 'view/admin/personas_fallecidas/index.php?view=edit&id=' . $result['rut'] . '"><i class="fa fa-pencil "></i>' . $result['pnombre'] . '</a></td>';
					echo '<td>' . $fecha_nacimiento . '</td>';
					echo '<td>' . $fecha_muerte . '</td>';
					echo '<td>' . $result['sector'] . '</td>';
					echo '<td>' . $result['tipo'] . '</td>';
					// Verificar si PROPIETARIO está definido antes de mostrarlo
					echo '<td>' . (isset($result['propietario']) ? $result['propietario'] : '') . '</td>';
					// Verificar si MNAME está definido antes de mostrarlo
					echo '<td>' . (isset($result['caracteristicas']) ? $result['caracteristicas'] : '') . '</td>';
					// El siguiente bloque if estaba fuera del bucle foreach, corregido para estar dentro
					if (isset($_GET['id'])) {
						$active = ($_GET['id'] == $result['user_id']) ? "active" : "";
					} else {
						$active = "";
					}


					// Escritura antigua (primera)
					echo '<td>';
					if (isset($result['escritura']) && empty($result['escritura']) || $result['escritura'] != 'Sin escritura') {
						$archivo = $result['escritura'];
						echo '<a href="descargar_archivo.php?archivo=' . $archivo . '" class="btn btn-primary">Descargar</a>';
					} else {
						echo '';
					}
					echo '</td>';
					
					// Escritura actualizada (nueva escritura)
					echo '<td>';
					if (isset($result['new_escritura']) && empty($result['new_escritura']) || $result['new_escritura'] != 'Sin escritura actualizada') {
						$archivo_new_escritura = $result['new_escritura'];
						echo '<a href="descargar_archivo.php?archivo=' . $archivo_new_escritura . '" class="btn btn-primary">Descargar</a>';
					} else {
						echo '';
					}
					echo '</td>';
					
					// Escritura actualizada (nueva escritura)
					echo '<td>';
					if (isset($result['pase_sepul']) && empty($result['pase_sepul']) || $result['pase_sepul'] != 'Sin pase de sepultacion') {
						$archivo_pase_sepul = $result['pase_sepul'];
						echo '<a href="descargar_archivo.php?archivo=' . $archivo_pase_sepul . '" class="btn btn-primary">Descargar</a>';
					} else {
						echo '';
					}
					echo '</td>';





					echo '<td align="center" > <a title="Editar" href="index.php?view=edit&id=' . $result['rut'] . '"  class="btn btn-primary btn-xs ' . $active . '">  <span class="fa fa-edit fw-fa"></span></a>					
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
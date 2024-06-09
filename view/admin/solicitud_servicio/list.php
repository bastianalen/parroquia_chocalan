<?php
if (!isset($_SESSION['user_id'])) {
	redirect(web_root . "view/admin/index.php");
}
$solicitud = new Solicitud();
$solicitudes = $solicitud->list_of_solicitud();
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Lista de Solicitudes para Servicios <a href="index.php?view=add" class="btn btn-primary btn-xs  "> <i
					class="fa fa-plus-circle fw-fa"></i> Nuevo</a> </h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<form action="../../../controller/controllersolicitudservicios.php?action=delete" Method="POST">
	<form action="../../../controller/controllersolicitudservicios.php?action=edit" Method="POST">
		<div class="table-responsive">
			<table id="dash-table" class="table table-striped table-bordered table-hover" style="font-size:12px"
				cellspacing="0">

				<thead>
					<tr>
						<!-- <th>No.</th> -->
						<th width="10%" >Nombre solicitante</th>
						<th width="10%" >Hora atencion</th>
						<th width="10%" >Fecha atención</th>
						<th width="10%" >Servicio solicitado</th>
						<th width="10%" >Estado de la solicitud</th>
						<th width="10%" >Acción</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($solicitudes as $result) {
						echo '<tr>';
						echo '<td>' . $result['nombre'] . '</td>';
						echo '<td>' . $result['hora'] . '</td>';
						echo '<td>' . $result['fecha_solicitud'] . '</td>';
						echo '<td>' . $result['tipo'] . '</td>';
						echo '<td>' . $result['estado'] . '</td>';
						echo '<td align="center"><a title="Aceptar" href="../../../controller/controllersolicitudservicios.php?action=edit&id_solicitud=' . $result['id_solicitud'] . '&estado=2" class="btn btn-primary btn-xs" id="Aceptar" name="save">  <span class="fa fa-check fw-fa"> Aceptar</a>
								<a title="Rechazar" href="../../../controller/controllersolicitudservicios.php?action=edit&id_solicitud=' . $result['id_solicitud'] . '&estado=3" class="btn btn-danger btn-xs" id="Rechazar" name="save">  <span class="fa fa-times fw-fa"> Rechazar</a></td>';
						echo '</tr>';
					}
					?>
				</tbody>

			</table>
			<div class="btn-group">
				<?php
				if ($_SESSION['id_rol'] == 1) {
					// echo '<button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button'
					;
				} ?>
			</div>
			
	</form>
</form>
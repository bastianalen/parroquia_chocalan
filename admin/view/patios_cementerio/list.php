<?php
if (!isset($_SESSION['user_id'])) {
	redirect(web_root . "admin/view/index.php");
}
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Lista de Patios <a href="index.php?view=add" class="btn btn-primary btn-xs  "> <i
					class="fa fa-plus-circle fw-fa"></i> Nuevo</a> </h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<form action="controller.php?action=delete" Method="POST">
	<div class="table-responsive">
		<table id="dash-table" class="table table-striped table-bordered table-hover" style="font-size:12px"
			cellspacing="0">

			<thead>
				<tr>
					<!-- <th>No.</th> -->
					<th>
						Patios
					</th>
					<th width="10%" >Acción</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$mydb->setQuery("SELECT * FROM tblsector");
				$cur = $mydb->loadResultList();

				foreach ($cur as $result) {
					echo '<tr>';
					echo '<td>' . $result->sector . '</td>';
					echo '<td align="center"><a title="Edit" href="index.php?view=edit&id=' . $result->id_sector . '" class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></a>
				  		     <a title="Delete" href="controller.php?action=delete&id=' . $result->id_sector . '" class="btn btn-danger btn-xs  ">  <span class="fa  fa-trash-o fw-fa "></a></td>';
					// echo '<td></td>';
					echo '</tr>';
				}
				?>
			</tbody>

		</table>
		<div class="btn-group">
			<!--  <a href="index.php?view=add" class="btn btn-default">New</a> -->
			<?php
			if ($_SESSION['id_rol'] == 1) {
				// echo '<button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button'
				;
			} ?>
		</div>
		
</form>
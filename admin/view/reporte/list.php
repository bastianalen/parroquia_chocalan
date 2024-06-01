<?php
if (!isset($_SESSION['id_rol']) == 1) {
	redirect(web_root . "../view/index.php");
}
?>


<form action="index.php" method="post">
	<div class="row">
		<div class="col-lg-8" style="margin:0px;padding: 0px;float:right;">

			<div class="col-sm-2">
				<label>Patio:</label>
				<select class="form-control" name="SECTION" id="SECTION" style="width: 100%;">
					<?php
					$query = "SELECT * FROM tblsector ORDER BY id_sector ASC";
					$mydb->setQuery($query);
					$cur = $mydb->loadResultList();

					foreach ($cur as $result) {
						echo '<option value="' . $result->sector . '">' . $result->sector . '</option>';
					}
					?>
				</select>
			</div>
			<div class="col-sm-2">
				<div class="input-group" style="margin-top:25px;">
					<button class="btn btn-primary btn-sm" name="submit" type="submit">Buscar <i
							class="fa fa-search"></i>
					</button>
				</div>
			</div>
		</div>
	</div>
	<!-- <div class="row">
		<div class="col-lg-8" style="margin:0px;padding: 0px;float:right;">

			<div class="col-sm-2">
				<label>Tumba:</label>
				<input class="form-control" name="GRAVENO" id="GRAVENO" style="width: 100%;">
				   
				</input>
			</div>
			<div class="col-sm-2">
				<div class="input-group" style="margin-top:25px;">
					<button class="btn btn-primary btn-sm" name="submit" type="submit">Buscar <i class="fa fa-search"></i>
					</button>
				</div>
			</div>
		</div>
	</div> -->
</form>
<?php
//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//  if (isset($_POST['GRAVENO'])) {
//        $graveno = $_POST['GRAVENO'];


//        $query = "SELECT * FROM `tblpeople` WHERE GRAVENO = '{$graveno}'";
//        $mydb->setQuery($query);
//       $cur = $mydb->loadResultList();


//        foreach ($cur as $result) {
//           echo 'GRAVENO: ' . $result->GRAVENO . '<br>';
//          echo 'Nombre del fallecido: ' . $result->FNAME . '<br>';
//          
//      }
//  }
//}
?>



<div class="row">

	<span id="printout">
		<div class="col-md-12">

			<div style="text-align: center;font-size: 20px">Lista de Personas Fallecidas</div>
			<div style="text-align: center;font-size: 12px;">
				<?php echo isset($_POST['TYPES']) ? $_POST['TYPES'] : ""; ?>
			</div>
			<div style="text-align: center;font-size: 12px;">
				<?php echo isset($_POST['SECTION']) ? "Patio:  " . $_POST['SECTION'] : ""; ?>
			</div>
			<form class="" method="POST" action="printreport.php" target="_blank">
				<div style="margin: 0px 0px 15px 0px">
					<input type="hidden" name="tipo_tumba"
						value="<?php echo isset($_POST['tipo_tumba']) ? $_POST['tipo_tumba'] : ''; ?>">
					<input type="hidden" name="SECTION"
						value="<?php echo isset($_POST['SECTION']) ? $_POST['SECTION'] : ''; ?>">
					<!-- <input type="hidden" name="date_pickerfrom" value="<?php echo isset($_POST['date_pickerfrom']) ? date_format(date_create($_POST['date_pickerfrom']), "Y-m-d") : ''; ?>">
			<input type="hidden" name="date_pickerto" value="<?php echo isset($_POST['date_pickerto']) ? date_format(date_create($_POST['date_pickerto']), "Y-m-d") : ""; ?>">  -->
					<button class="btn btn-primary" type="submit"><i class="fa fa-print"></i> imprimir</button>
				</div>
				<div class="">


					<table id="" class="table table-striped table-bordered table-hover " style="font-size:12px"
						cellspacing="0">

						<thead>

							<tr>

								<th>Tumba</th>
								<th>Fallecido</td>
								<th>Fecha Nacimiento</th>
								<th>Fecha Defunción</th>
								<th>Patio</th>
								<th>Tipo Tumba</th>
								<th>Propietario</th>
								<th>Caracteristicas</th>
								<th>Escritura</th>
							</tr>
						</thead>

						<tbody>

							<?php

							$tipo_tumba = isset($_POST['tipo_tumba']) ? $_POST['tipo_tumba'] : "";
							$section = isset($_POST['SECTION']) ? $_POST['SECTION'] : "";

							$query = "SELECT * FROM `tblpersonas` p INNER JOIN tblsector s ON p.id_sector= s.id_sector WHERE  s.sector='{$section}'";
							$mydb->setQuery($query);
							$cur = $mydb->loadResultList();

							foreach ($cur as $result) {

								$fecha_nacimiento = $result->fecha_nacimiento;
								$fecha_muerte = $result->fecha_muerte;

								echo '<tr>';
								echo '<td width="8%" align="center">' . $result->nro_tumba . '</td>';
								echo '<td> ' . $result->pnombre . '</td>';
								echo '<td>' . $fecha_nacimiento . '</td>';
								echo '<td>' . $fecha_muerte . '</td>';
								echo '<td>' . $result->sector . '</td>';
								echo '<td>' . $result->tipo_tumba . '</td>';
								echo '<td>' . $result->propietario . '</td>';
								echo '<td>' . $result->caracteristicas . '</td>';
								echo '<td>' . $result->escritura . '</td>';
								echo '</tr>';
							}
							?>
						</tbody>


					</table>
				</div>
			</form>
		</div>
	</span>

</div>
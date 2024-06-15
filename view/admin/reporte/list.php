<?php
if (!isset($_SESSION['id_rol']) == 1) {
	redirect(web_root . "view/admin/index.php");
}
?>

<div >
<form action="index.php" method="get">
    <div class="row">
        <div class="col-lg-8" style="margin:0px;padding: 0px;float:right;">
            <div class="col-sm-2">
                <label>Nro Tumba:</label>
                <div class="form-group">
                    <input type="text" name="query" class="form-control mr-2" placeholder="Buscar aqui...">
                </div>
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
</form>
<?php
// CONEXION A LA BASE DE DATOS PARROQUIA_CHOCALAN
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parroquia_chocalan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// OBTENER RESULTADOS DE LA BUSQUEDA FILTRAR POR N_REGISTRO,NOMBRE,RUT,N_TUMBA,PATIO
// AQUI CON ISSET DEFINO LA VARIABLE PARA LUEGO LLAMAR LA FUNCION EN ESTE CASO QUERY CONTIENE LA CONSULTA
$query = isset($_GET['query']) ? $_GET['query'] : '';

// BUSCADOR  DEFINIR O FILTRAR CONSULTA A LA TABLA list.php POR LOS SIGUIENTES DATOS A BUSCAR
$sql = "SELECT 	rut, nro_tumba, pnombre, id_sector, tipo_tumba, propietario, caracteristicas, escritura, pase_sepul, new_escritura, dd_nacimiento, mm_muerte, yyyy_muerte
      	FROM tblpersonas 
        WHERE nro_tumba LIKE ? ";
$stmt = $conn->prepare($sql);
$search = "%$query%";
$stmt->bind_param("s", $search);
$stmt->execute();
$result = $stmt->get_result();

?>


<form action="index.php" method="post">
	<div class="row">
		<div class="col-lg-8" style="margin:0px;padding: 0px;float:right;">

			<div class="col-sm-2">
				<label>Patio:</label>
				<select class="form-control" name="sector" id="sector" style="width: 100%;">
					<option value="0">Seleccionar un sector</option>;
					<?php

					$sectores = new Sector();
					$sector = $sectores->listofsector();

					foreach ($sector as $result) {
						echo '<option value="' . $result['id_sector'] . '">' . $result['sector'] . '</option>';
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
</form>
</div>


<div class="row">

	<span id="printout">
		<div class="col-md-12">

			<div style="text-align: center;font-size: 20px">Lista de Personas Fallecidas</div>
			<div style="text-align: center;font-size: 12px;">
				<?php echo isset($_POST['TYPES']) ? $_POST['TYPES'] : ""; ?>
			</div>
			<div style="text-align: center;font-size: 12px;">
				<p name="id_sector"><?php echo isset($_POST['sector']) ? "Patio:  " . $_POST['sector'] : ""; ?></p>
			</div>
			<form class="" method="POST" action="printreport.php" target="_blank">
				<div style="margin: 0px 0px 15px 0px">
					<input type="hidden" name="tipo_tumba"
						value="<?php echo isset($_POST['tipo_tumba']) ? $_POST['tipo_tumba'] : ''; ?>">
					<input type="hidden" name="sector"
						value="<?php echo isset($_POST['sector']) ? $_POST['sector'] : ''; ?>">
					<button class="btn btn-primary" type="submit"><i class="fa fa-print"></i> imprimir</button>
				</div>
				<div class="">

					<table id="" class="table table-striped table-bordered table-hover" style="font-size:12px" cellspacing="0">

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
							$sector = isset($_POST['sector']) ? $_POST['sector'] : "1";

							$persona = new Persona();
							$personaResultado = $persona->find_persona_sector($sector);

							foreach ($personaResultado as $result) {

								$fecha_nacimiento = $result['dd_nacimiento'] . "/" . $result['mm_nacimiento'] . "/" . $result['yyyy_nacimiento'];
								$fecha_muerte = $result['dd_muerte'] . "/" . $result['mm_muerte'] . "/" . $result['yyyy_muerte'];

								echo '<tr>';
								echo '<td width="8%" align="center">' . $result['nro_tumba'] . '</td>';
								echo '<td> ' . $result['pnombre'] . '</td>';
								echo '<td>' . $fecha_nacimiento . '</td>';
								echo '<td>' . $fecha_muerte . '</td>';
								echo '<td>' . $result['id_sector'] . '</td>';
								echo '<td>' . $result['tipo_tumba'] . '</td>';
								echo '<td>' . $result['propietario'] . '</td>';
								echo '<td>' . $result['caracteristicas'] . '</td>';
								echo '<td>' . $result['escritura'] . '</td>';
								echo '<td>' . $result['new_escritura'] . '</td>';
								echo '<td>' . $result['pase_sepul'] . '</td>';
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
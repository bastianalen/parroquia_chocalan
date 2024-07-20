<?php
require_once("../../../controller/initialize.php");
if (!isset($_SESSION['user_id'])) {
  redirect(web_root . "view/admin/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Reporte</title>

  <!-- Bootstrap Core CSS -->
  <link href="<?php echo web_root; ?>public/css/bootstrap.min.css" rel="stylesheet">


  <!-- Custom Fonts -->
  <link href="<?php echo web_root; ?>public/font/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <link href="<?php echo web_root; ?>public/font/fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- DataTables CSS -->
  <link href="<?php echo web_root; ?>public/css/dataTables.bootstrap.css" rel="stylesheet">


</head>

<body onload="window.print()">

  <div id="wrapper">

    <span id="printout">
      <div class="col-md-12">
        <br>
        <br>
        <div class="logo" style="position: absolute; top: 2px; left: 100px; z-index: 999;">
          <img src="../../../public/img/logo49.png" alt="logo" width="100px">
        </div>
        <div style="text-align: center;font-size: 20px">Parroquia Santa Rosa de Lima, Chocalán</div>
        <div style="text-align: center;font-size: 12px;">
          <?php echo isset($_POST['TYPES']) ? $_POST['TYPES'] : ""; ?>
        </div>
        <div style="text-align: center;font-size: 12px;">
          <?php echo isset($_POST['nro_tumba']) ? "Cementerio Parroquial tumba: " . $_POST['nro_tumba'] : ""; ?>
        </div>
        <div style="text-align: center;font-size: 12px;">
          <?php echo isset($_POST['sector']) ? "Patio :" . $_POST['sector'] : "1"; ?>
        </div>
        <br>
        <br>
        <!-- en este apartado se envia el formulario y se de reportes a printreport.php y se abre en una nueva pestaña -->
        <form class="" method="POST" action="printreport.php" target="_blank">

          <table id="dash-table" class="table table-striped table-bordered table-hover " style="font-size:12px"
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
              </tr>
            </thead>

            <tbody>
              <?php
              $nro_tumba = isset($_POST['nro_tumba']) ? $_POST['nro_tumba'] : "";
              $id_sector = isset($_POST['sector']) ? $_POST['sector'] : "1";
              echo "<script> console.log(".json_encode($id_sector).")</script>";
              echo "<script> console.log(".json_encode($nro_tumba).")</script>";
              // echo "<script> console.log(".json_encode($_POST['sector']).")</script>";
              $persona = new Persona();
							$personaResultado = $persona->find_persona_tumba_sector($nro_tumba,$id_sector);

              echo "<script>console.log(".json_encode($personaResultado).")</script>";
              foreach ($personaResultado as $result) {

                $fecha_nacimiento = (isset($result['dd_nacimiento']) && $result['dd_nacimiento'] !== '0' ? $result['dd_nacimiento'] : '--') . "/" . (isset($result['mm_nacimiento']) && $result['mm_nacimiento'] !== '0' ? $result['mm_nacimiento'] : '--') . "/" . (isset($result['yyyy_nacimiento']) && $result['yyyy_nacimiento'] !== '0' ? $result['yyyy_nacimiento'] : '----');
                                $fecha_muerte = (isset($result['dd_muerte']) && $result['dd_muerte'] !== '0' ? $result['dd_muerte'] : '--') . "/" . (isset($result['mm_muerte']) && $result['mm_muerte'] !== '0' ? $result['mm_muerte'] : '--') . "/" . (isset($result['yyyy_muerte']) && $result['yyyy_muerte'] !== '0' ? $result['yyyy_muerte'] : '----');

                echo '<tr>';
								echo '<td width="8%" align="center">' . $result['nro_tumba'] . '</td>';
								echo '<td> ' . $result['pnombre'] . '</td>';
								echo '<td>' . $fecha_nacimiento . '</td>';
								echo '<td>' . $fecha_muerte . '</td>';
								echo '<td>' . $result['sector'] . '</td>';
								echo '<td>' . $result['tipo'] . '</td>';
								echo '<td>' . $result['propietario'] . '</td>';
								echo '<td>' . $result['caracteristicas'] . '</td>';
								echo '</tr>';
              }
              ?>
            </tbody>


          </table>
      </div>
    </span>

  </div>


  <!-- jQuery -->
  <script src="<?php echo web_root; ?>public/jquery/jquery.min.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="<?php echo web_root; ?>public/js/bootstrap.min.js"></script>

  <!-- DataTables JavaScript -->
  <script src="<?php echo web_root; ?>public/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo web_root; ?>public/js/dataTables.bootstrap.min.js"></script>



</body>

</html>
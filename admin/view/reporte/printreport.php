<?php
require_once("../../model/initialize.php");
if (!isset($_SESSION['user_id'])) {
  redirect(web_root . "view/index.php");
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
  <link href="<?php echo web_root; ?>admin/view/css/bootstrap.min.css" rel="stylesheet">


  <!-- Custom Fonts -->
  <link href="<?php echo web_root; ?>admin/view/font/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <link href="<?php echo web_root; ?>admin/view/font/fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- DataTables CSS -->
  <link href="<?php echo web_root; ?>admin/view/css/dataTables.bootstrap.css" rel="stylesheet">


</head>

<body onload="window.print()">

  <div id="wrapper">

    <span id="printout">
      <div class="col-md-12">
        <br>
        <br>
        <div class="logo" style="position: absolute; top: 2px; left: 100px; z-index: 999;">
          <img src="../img/logo49.png" alt="logo" width="100px">
        </div>
        <div style="text-align: center;font-size: 20px">Parroquia Santa Rosa de Lima, Chocalán</div>
        <div style="text-align: center;font-size: 12px;">
          <?php echo isset($_POST['TYPES']) ? $_POST['TYPES'] : ""; ?>
        </div>
        <div style="text-align: center;font-size: 12px;">
          <?php echo isset($_POST['tipo_tumba']) ? "Cementerio Parroquial " . $_POST['tipo_tumba'] : ""; ?>
        </div>
        <div style="text-align: center;font-size: 12px;">
          <?php echo isset($_POST['SECTION']) ? "Patio :" . $_POST['SECTION'] : ""; ?>
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
                <th>Escritura</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $tipo_tumba = isset($_POST['tipo_tumba']) ? $_POST['tipo_tumba'] : "";
              $section = isset($_POST['SECTION']) ? $_POST['SECTION'] : "";

              $query = "SELECT * FROM tblpersonas tp INNER JOIN tblsector ts ON tp.id_sector=ts.id_sector WHERE  ts.sector='{$section}'";
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
    </span>

  </div>
  <!-- /#wrapper -->





  <!-- jQuery -->
  <script src="<?php echo web_root; ?>admin/jquery/jquery.min.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="<?php echo web_root; ?>admin/js/bootstrap.min.js"></script>

  <!-- DataTables JavaScript -->
  <script src="<?php echo web_root; ?>admin/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo web_root; ?>admin/js/dataTables.bootstrap.min.js"></script>



</body>

</html>
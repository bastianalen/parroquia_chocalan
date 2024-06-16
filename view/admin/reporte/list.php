<?php

require_once "../../../controller/controllerpersonafallecida.php";
if (!isset($_SESSION['id_rol']) == 1) {
    redirect(web_root . "view/admin/index.php");
}
?>

<div style="text-align: center-center;">

<form action="index.php" method="post">
    <div class="row justify-content-center">
        <div class="col-lg-4 d-flex justify-content-center" style="margin: 0 auto; padding: 0;">

            <div class="col-sm-6">
                <label>Patio:</label>
                <select class="form-control" name="sector" id="sector" style="width: 100%;">
                    <?php

                    $sectores = new Sector();
                    $sector = $sectores->listofsector();

                    foreach ($sector as $result) {
                        echo '<option value="' . $result['id_sector'] . '">' . $result['sector'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-sm-6">
                <label>Número de Tumba:</label>
                <input type="text" class="form-control" name="nro_tumba" id="nro_tumba" style="width: 100%;">
            </div>
            <div class="col-sm-11" style="margin-top: 10px;">
                <button class="btn btn-primary btn-sm" name="submit" type="submit">Buscar <i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>
</form>
</div>

<div class="row">

    <span id="printout">
        <div class="col-md-12">

            <div style="text-align: center; font-size: 30px;">Lista de Personas Fallecidas</div>
            <div style="text-align: center; font-size: 12px;">
                <?php echo isset($_POST['TYPES']) ? $_POST['TYPES'] : ""; ?>
            </div>
            <div style="text-align: center; font-size: 20px;">
                <?php echo isset($_POST['sector']) ? "Patio:  " . $_POST['sector'] : ""; ?>
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
                            $nro_tumba = isset($_POST['nro_tumba']) ? $_POST['nro_tumba'] : "";

                            $persona = new Persona();
                            if (!empty($nro_tumba)) {
                                $personaResultado = $persona->find_persona_tumba($nro_tumba);
                            } else {
                                $personaResultado = $persona->find_persona_sector($sector);
                            }

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

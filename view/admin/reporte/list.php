<?php
// Llama al controllador de la vista y valida que el usuario tenga la cuenta ingresada
require_once "../../../controller/controllerpersonafallecida.php";
if (!isset($_SESSION['id_rol']) == 1) {
    redirect(web_root . "view/admin/index.php");
}
// Obtiene los datos que se utilizaran mas adelante (tipo_tumba,id_sector,nro_tumba)
$tipo_tumba = isset($_POST['tipo_tumba']) ? $_POST['tipo_tumba'] : "";
$sector = isset($_POST['sector']) ? $_POST['sector'] : "0";
$nro_tumba = isset($_POST['nro_tumba']) ? $_POST['nro_tumba'] : "";

// Inicializa la clase Persona
$persona = new Persona();

// Encuentra los datos de las personas segun los datos que se ingresen en los filtros
if (!empty($nro_tumba) and $sector != 0){
    $personaResultado = $persona->find_persona_tumba_sector($nro_tumba,$sector);
    $id_sector = $sector;

}else if (!empty($nro_tumba) and $sector == 0) {
    $personaResultado = $persona->find_persona_tumba($nro_tumba);
    $id_sector = $personaResultado[0]['id_sector'];

} else if ($sector != 0){
    $personaResultado = $persona->find_persona_sector($sector);
    $id_sector = $sector;
} else {
    $personaResultado = $persona->listofpeople();
    $id_sector = $sector;
}
?>

<div style="text-align: center-center;">

<form action="index.php" method="post">
    <div class="row justify-content-center">
        <div class="col-lg-4 d-flex justify-content-center" style="margin: 0 auto; padding: 0;">

            <div class="col-sm-6">
                <label>Patio:</label>
                <select class="form-control" name="sector" id="sector" style="width: 100%;">
                    <option value="0">Seleccionar un patio</option>
                    <?php
                    // Inicializa la clase Sector y llama a la consulta listofsector del model
                    $sectores = new Sector();
                    $sector = $sectores->listofsector();

                    // Recorre los resultados obtenidos y crea opciones para el select
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
                <p name="id_sector"><?php echo isset($_POST['TYPES']) ? $_POST['TYPES'] : ""; ?></p>
            </div>
            <div style="text-align: center; font-size: 20px;">
                <?php echo isset($_POST['sector']) ? "Patio:  " . $_POST['sector'] : ""; ?>
            </div>
            <form class="" method="POST" action="printreport.php" target="_blank">
                <div style="margin: 0px 0px 15px 0px">
                    <input type="hidden" name="tipo_tumba"
                        value="<?php echo isset($_POST['tipo_tumba']) ? $_POST['tipo_tumba'] : ''; ?>">
                    <input type="hidden" name="sector"
                        value="<?php echo  $id_sector ?>">
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
                            </tr>
                        </thead>

                        <tbody>

                            <?php

                            // Recorre los resultados obtenidos y almacenados en la variable $personaResultado e inserta filas en la tabla con los datos obtenidos
                            foreach ($personaResultado as $result) {

                                $fecha_nacimiento = (isset($result['dd_nacimiento']) && $result['dd_nacimiento'] !== '0' ? $result['dd_nacimiento'] : '--') . "/" . (isset($result['mm_nacimiento']) && $result['mm_nacimiento'] !== '0' ? $result['mm_nacimiento'] : '--') . "/" . (isset($result['yyyy_nacimiento']) && $result['yyyy_nacimiento'] !== '0' ? $result['yyyy_nacimiento'] : '----');
                                $fecha_muerte = (isset($result['dd_muerte']) && $result['dd_muerte'] !== '0' ? $result['dd_muerte'] : '--') . "/" . (isset($result['mm_muerte']) && $result['mm_muerte'] !== '0' ? $result['mm_muerte'] : '--') . "/" . (isset($result['yyyy_muerte']) && $result['yyyy_muerte'] !== '0' ? $result['yyyy_muerte'] : '----');

                                echo '<tr>';
                                echo '<td width="8%" align="center">' . (isset($result['nro_tumba']) ? $result['nro_tumba'] : '--') . '</td>';
                                echo '<td>' . (isset($result['pnombre']) ? $result['pnombre'] : '--') . '</td>';
                                echo '<td>' . $fecha_nacimiento . '</td>';
                                echo '<td>' . $fecha_muerte . '</td>';
                                echo '<td>' . (isset($result['sector']) ? $result['sector'] : '--') . '</td>';
                                echo '<td>' . (isset($result['tipo']) ? $result['tipo'] : '--') . '</td>';
                                echo '<td>' . (isset($result['propietario']) ? $result['propietario'] : '--') . '</td>';
                                echo '<td>' . (isset($result['caracteristicas']) ? $result['caracteristicas'] : '--') . '</td>';
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

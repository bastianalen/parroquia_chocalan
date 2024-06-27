<?php
require_once("../../../controller/initialize.php");
if(!isset($_SESSION['user_id'])){
	redirect(web_root."view/admin/index.php");
}
// Obtiene los tipos de calendario
$tipocalendario = new TipoCalendario();
$tiposcalendarios= $tipocalendario->list_of_tipocalendario();

// Obtiene los tipos de servicios
$tiposervicio = new TipoServicio();
$tiposservicios = $tiposervicio->listoftiposervicio();
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="../../../public/js/jquery.min.js"></script>
    <script src="../../../public/js/moment.min.js"></script>
    <script src="../../../public/js/fullcalendar.min.js"></script>
    <!--full calendario-->
    <link rel="stylesheet" href="../../../public/css/fullcalendar.min.css">
    <script src="../../../public/js/es.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="../../../public/js/bootstrap-clockpicker.js"></script>
    <link rel="stylesheet" href="../../../public/css/bootstrap-clockpicker.css">
    <link rel="stylesheet" href="calendarioPersonal.css">
</head>
<body>
    <div id="filtro_tipo_calendario">
        <h4 >Seleccionar el calendario que desea ver:</h4>
        <select id="tipo_calendario" class="form-control">
            <option value="0" class="option">Seleccione una opci&oacute;n</option>
            <?php
            

            foreach ($tiposcalendarios as $result) {
                echo '<option value="' . $result['id_tipo'] . '" class="option">' . $result['tipo'] .'</option>';
            }
            ?>
        </select>
    </div>
    <div class="container">
        <div id="CalendarioWeb" style="padding: 3vh;"></div>
    </div>
    

<!-- Modal (agregar, modificar, eliminar)-->
    <div class="modal fade" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloEvento"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="txtID" name="txtID">
                    <input type="hidden" id="txtFecha" name="txtFecha" />

                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label>Título:</label>
                            <input type="text" id="txtTitulo" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Hora del evento:</label>
                            <div class="input-group clockpicker" data-autoclose="true">
                                <input type="text" id="txtHora" name="inicio" value="" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Descripcion:</label>
                        <textarea id="txtDescripcion" row="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tipo de servicio:</label>
                        <select id="tipo_servicio" class="form-control">
                            <option value="0" class="option">Seleccione una opci&oacute;n</option>
                            <?php
                            foreach ($tiposservicios as $result) {
                                echo '<option value="' . $result['id_servicio'] . '" class="option">' . $result['tipo'] .'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mostrar en calendario :</label>
                        <select id="tipo_calendario_consultas" class="form-control">
                            <option value="0" class="option">Seleccione una opci&oacute;n</option>
                            <?php

                            foreach ($tiposcalendarios as $result) {
                                echo '<option value="' . $result['id_tipo'] . '" class="option">' . $result['tipo'] .'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Color:</label>
                        <input type="color" value="#000000" id="txtColor" class="form-control" style="height: 36px;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
                    <button type="button" id="btnModificar" class="btn btn-success">Modificar</button>
                    <button type="button" id="btnEliminar" class="btn btn-danger">Borrar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="calendarioPersonal.js"></script>

</body>

</html>


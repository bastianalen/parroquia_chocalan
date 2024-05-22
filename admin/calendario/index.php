<?php
require_once("../../public/include/initialize.php");
if(!isset($_SESSION['USERID'])){
	redirect(web_root."admin/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <!-- General links-->
    <?php include_once '../links.php'; ?>
    <!-- Personal link -->
    <link rel="stylesheet" href="css/calendarioPersonal.css">

</head>

<body>

    <div class="container">
        <!-- <div class="row">
            <div class="col"></div>
            <div class="col-lg-8 col-md-10 col-sm-12"> -->
                <div id="CalendarioWeb" style="padding: 3vh;"></div>
            <!-- </div>
            <div class="col"></div>
        </div> -->
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
                                <input type="text" id="txtHora" value="10:30" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Descripcion:</label>
                        <textarea id="txtDescripcion" row="3" class="form-control"></textarea>
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

    <!-- JS Personalizado del calendario -->
    <script src="js/calendarioPersonal.js"></script>

</body>

</html>


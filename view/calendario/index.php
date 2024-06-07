<?php
require_once("../../admin/model/initialize.php");
?>
<!DOCTYPE html>
<html lang="en">
    
    <?php 
            include_once("../partials/headCalendario.php");
    ?>
    <body data-spy="scroll" data-target=".navbar" data-offset="90">
        <?php 
            include_once("../partials/header.php");
        ?>
        <div class="container container-calendario">
            <div id="CalendarioWeb" style="padding: 3vh;"></div>
        </div>
        
        <script>
            $(document).ready(function () {
                $('#CalendarioWeb').fullCalendar({
                    header: {
                        left: 'today,prev,next',
                        center: 'title',
                        right: 'month, basicWeek, basicDay, agendaWeek, agendaDay'
                    },
                    
                    events: {
                        url: 'http://localhost/parroquia_chocalan/view/calendario/eventos.php',
                        success: function(response) {
                            var events = response.map(function(event) {
                                return {
                                    id: event.id,
                                    title: event.titulo,
                                    start: event.inicio,
                                    end: event.fin,
                                    color: event.color,
                                    textColor: event.colorTexto,
                                    tipo_servicio: event.tipo_servicio,
                                    descripcion: event.descripcion
                                };
                            });
                            return events;
                        },
                        error: function(response) {
                            console.error("Error al cargar eventos:", response);
                        }
                    }
                });
            });
        
        </script>

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
                                $mydb->setQuery("SELECT * FROM  tbltiposervicio tts");
                                $cur = $mydb->loadResultList();
                                foreach ($cur as $result) {
                                    echo '<option value="' . $result->id_servicio . '" class="option">' . $result->tipo .'</option>';
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
        
        <?php 
            include_once("../partials/footer.php");
            include_once("../../public/linkCalendarios.php");
        ?>

    </body>

</html>


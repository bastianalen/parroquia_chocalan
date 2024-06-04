<?php
require_once("../../public/include/initialize.php");
?>
<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Calendario</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/moment.min.js"></script>

        <link rel="stylesheet" href="css/fullcalendar.min.css">
        <script src="js/fullcalendar.min.js"></script>
        <script src="js/es.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="js/bootstrap-clockpicker.js"></script>
        <link rel="stylesheet" href="css/bootstrap-clockpicker.css">
        <script src="js/funcionSolicitud.js"></script>
    </head>
    <body>
        
        <div class="container">
            <div id="CalendarioWeb" style="padding: 3vh;"></div>
        </div>
        <script src="js/funcionSolicitud.js"></script>
    <script>$(document).ready(function () {
                $('#CalendarioWeb').fullCalendar({
                    header: {
                        left: 'today,prev,next',
                        center: 'title',
                        right: 'month, basicWeek, basicDay, agendaWeek, agendaDay'
                    },
                    
                    dayClick: function (date, jsEvent, view) {
                        /*estos hacen que cuando pongas agregar moficar o borrar los otros botones se oculten */
                        $('#btnAgregar').prop("disabled", false);
                        $('#btnModificar').prop("disabled", true);
                        $('#btnEliminar').prop("disabled", true);
                        
                        limpiarFormulario();
                        $('#txtFecha').val(date.format());
                        $("#ModalEventos").modal();
                    },
                    
                    events: {
                        url: 'http://localhost/parroquia_chocalan/admin/view/solicitarhora/funcionSolicitud.php',
                        success: function(response) {
                            var events = response.map(function(event) {
                                return {
                                    id: event.id,
                                    title: event.titulo,
                                    start: event.inicio,
                                    end: event.fin,
                                    color: event.color,
                                    textColor: event.colorTexto,
                                    descripcion: event.descripcion
                                };
                            });
                            return events;
                        },
                        error: function(response) {
                            console.error("Error al cargar eventos:", response);
                        }
                    },
                
                
                    eventClick: function (calEvent, jsEvent, view) {
                        $('#btnAgregar').prop("disabled", true);
                        $('#btnModificar').prop("disabled", false);
                        $('#btnEliminar').prop("disabled", false);
                        
                        $('#tituloEvento').html(calEvent.title);
                        /*mostrar la informacion del evento en los inputs*/
                        $('#txtDescripcion').val(calEvent.descripcion);
                        $('#txtID').val(calEvent.id);
                        $('#txtTitulo').val(calEvent.title);
                        $('#txtColor').val(calEvent.color);
                        $('#txtHora').val(calEvent.start.format('HH:mm'));
                        
                        FechaHora = calEvent.start.format().split("T");
                        $('#txtFecha').val(FechaHora[0]);
                        /*$('#txtHora').val(FechaHora[1]);*/
                        
                        
                        $("#ModalEventos").modal();
                    },
                    editable: true,
                    eventDrop: function (calEvent) {
                        $('#txtID').val(calEvent.id);
                        $('#txtTitulo').html(calEvent.title);
                        $('#txtColor').val(calEvent.color);
                        $('#txtDescripcion').val(calEvent.descripcion);
                        var fechaHora = calEvent.start.format().split("T");
                        $('#txtFecha').val(fechaHora[0]);
                        $('#txtHora').val(calEvent.start);
                        
                        RecolectarDatosGUI();
                        EnviarInformacion('modificar', NuevoEvento, true);
                    }
                });
            });</script>

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

        <script src="js/calendarioPersonal.js"></script>
        <?php
            include_once 'funcionSolicitud.php'; 
        ?>
    </body>

</html>


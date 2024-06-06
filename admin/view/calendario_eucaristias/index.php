<?php
require_once("../../model/initialize.php");
if(!isset($_SESSION['user_id'])){
	redirect(web_root."../view/index.php");
}
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
    <!--full calendario-->
    <link rel="stylesheet" href="css/fullcalendar.min.css">
    <script src="js/fullcalendar.min.js"></script>
    <script src="js/es.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="js/bootstrap-clockpicker.js"></script>
    <link rel="stylesheet" href="css/bootstrap-clockpicker.css">
    <link rel="stylesheet" href="css/calendarioPersonal.css">
</head>
<body>
    <div id="filtro_tipo_calendario">
        <h4 >Seleccionar el calendario que desea ver:</h4>
        <select id="tipo_calendario" class="form-control">
            <option value="0" class="option">Seleccione una opci&oacute;n</option>
            <?php
            $mydb->setQuery("SELECT * FROM  tbltipocalendario tts");
            $cur = $mydb->loadResultList();
            foreach ($cur as $result) {
                echo '<option value="' . $result->id_tipo . '" class="option">' . $result->tipo .'</option>';
            }
            ?>
        </select>
    </div>
    <div class="container">
        <div id="CalendarioWeb" style="padding: 3vh;"></div>
    </div>
    
    <script>
        $(document).ready(function () {
            tipo_calendario = 1;
            cargarCalendario(tipo_calendario);

            // Actualización del calendario segun cambio del filtro
            $('#tipo_calendario').on('change', function () {
                tipo_calendario = $(this).val();
                // Destruir el calendario existente
                $('#CalendarioWeb').fullCalendar('destroy'); 
                // Cargar nuevamente el calendario
                cargarCalendario(tipo_calendario);
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
                        <label>Mostrar en calendario :</label>
                        <select id="tipo_calendario_consultas" class="form-control">
                            <option value="0" class="option">Seleccione una opci&oacute;n</option>
                            <?php
                            $mydb->setQuery("SELECT * FROM  tbltipocalendario ttc");
                            $cur = $mydb->loadResultList();
                            foreach ($cur as $result) {
                                echo '<option value="' . $result->id_tipo . '" class="option">' . $result->tipo .'</option>';
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
    <script>
        function cargarCalendario(tipo_calendario) {
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
                    url: 'http://localhost/parroquia_chocalan/admin/view/calendario_eucaristias/eventos.php',
                    type: 'POST',
                    data: function() {
                        return {
                            tipo_calendario: tipo_calendario
                        };
                    },
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
                                descripcion: event.descripcion,
                                tipo_calendario: event.tipo_calendario
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


                    // Aquí se asegura que el if se ejecute después de cargar todos los datos
                    var id = $('#txtID').val();
                    $('#tipo_servicio option').each(function() {
                        var idOption = $(this).val();
                        if (id == idOption) {
                            $(this).prop('selected', true);
                        }
                    });
                    

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
                    $('#tipo_servicio').val(calEvent.tipo_servicio);
                    $('#tipo_calendario_consultas').val(calEvent.tipo_calendario);
                    var fechaHora = calEvent.start.format().split("T");
                    $('#txtFecha').val(fechaHora[0]);
                    $('#txtHora').val(calEvent.start);
                    
                    RecolectarDatosGUI();
                    EnviarInformacion('modificar', NuevoEvento, true);
                }
            });
        }


        var NuevoEvento;

        $('#btnAgregar').click(function () {
            RecolectarDatosGUI();
            EnviarInformacion('agregar', NuevoEvento);

        });
        $('#btnEliminar').click(function () {
            RecolectarDatosGUI();
            /*EnviarInformacion('agregar', NuevoEvento);*/
            EnviarInformacion('eliminar', NuevoEvento);

        });
        $('#btnModificar').click(function () {
            RecolectarDatosGUI();
            /*EnviarInformacion('agregar', NuevoEvento);*/
            EnviarInformacion('modificar', NuevoEvento);

        });

        function RecolectarDatosGUI() {
            
            NuevoEvento = {
                id: $('#txtID').val(),
                titulo: $('#txtTitulo').val(),
                inicio: $('#txtFecha').val() + " " + $('#txtHora').val(),
                color: $('#txtColor').val(),
                descripcion: $('#txtDescripcion').val(),
                colorTexto: "#FFFFFF",
                tipo_servicio: $('#tipo_servicio').val(),
                fin: $('#txtFecha').val() + " " + $('#txtHora').val(),
                tipo_calendario: $('#tipo_calendario_consultas').val(),
            };
        }

        function EnviarInformacion(accion, objEvento, modal) {

            $.ajax({
                type: 'POST',
                url: 'http://localhost/parroquia_chocalan/admin/view/calendario_eucaristias/eventos.php?accion=' + accion,
                data: objEvento,
                success: function (msg) {
                    if (msg) {
                        $('#CalendarioWeb').fullCalendar('refetchEvents');
                        if (!modal) {
                            $("#ModalEventos").modal('toggle');
                        }
                    }
                },
                error: function () {
                    alert("Error en la solicitud enviar informacion.");
                }
            },);
        }
        $('.clockpicker').clockpicker();
        function limpiarFormulario() {
            $('#txtID').val();
            $('#txtTitulo').html();
            $('#txtColor').html();
            $('#txtDescripcion').val();
        }
    </script>

</body>

</html>


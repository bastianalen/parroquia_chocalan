<?php
require_once("../../include/initialize.php");
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

    <style>
        .fc th {
            padding: 10px 0px;

            background: #f2f2f2;
        }

        .fc-toolbar h2 {
            margin-top: 10px;
            /* Ajusta el margen superior según sea necesario */
        }
    </style>
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

    <script>
        $(document).ready(function () {
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

                events: 'http://localhost/parroquia_chocalan/admin/calendario/eventos.php',


                eventClick: function (calEvent, jsEvent, view) {
                    $('#btnAgregar').prop("disabled", true);
                    $('#btnModificar').prop("disabled", false);
                    $('#btnEliminar').prop("disabled", false);

                    $('#tituloEvento').html(calEvent.title);
                    /*mostrar la informacion del evento en los inputs*/
                    $('#txtDescripcion').val(calEvent.descripcion);
                    $('#txtID').val(calEvent.id);
                    $('#txtTitulo').val(calEvent.title);
                    $('#txtColor').html(calEvent.color);

                    FechaHora = calEvent.start._i.split(" ");
                    $('#txtFecha').val(FechaHora[0]);
                    /*$('#txtHora').val(FechaHora[1]);*/


                    $("#ModalEventos").modal();
                },
                editable: true,
                eventDrop: function (calEvent) {
                    $('#txtID').val(calEvent.id);
                    $('#txtTitulo').html(calEvent.title);
                    $('#txtColor').html(calEvent.color);
                    $('#txtDescripcion').val(calEvent.descripcion);

                    var fechaHora = calEvent.start.format().split("T");
                    $('#txtFecha').val(fechaHora[0]);
                    $('#txtHora').val(fechaHora[1]);

                    RecolectarDatosGUI();
                    EnviarInformacion('modificar', NuevoEvento, true);
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
    <script>
        var NuevoEvento;

        $('#btnAgregar').click(function () {
            RecolectarDatosGUI();
            /*EnviarInformacion('agregar', NuevoEvento);*/
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
                title: $('#txtTitulo').val(),
                start: $('#txtFecha').val() + " " + $('#txtHora').val(),
                color: $('#txtColor').val(),
                descripcion: $('#txtDescripcion').val(),
                textColor: "#FFFFFF",
                end: $('#txtFecha').val() + " " + $('#txtHora').val(),
            };
        }
        function EnviarInformacion(accion, objEvento, modal) {
            $.ajax({
                type: 'POST',
                url: 'http://localhost/parroquia_chocalan/admin/calendario/eventos.php?accion=' + accion,
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
                    alert("Hay un error..");
                }
            });
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


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

function cargarCalendario(tipo_calendario) {
    $('#CalendarioWeb').fullCalendar({
        header: {
            left: 'today,prev,next',
            center: 'title',
            right: 'month, basicWeek, basicDay'
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
            url: '../../../controller/eventoscalendarioadmin.php',
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
        
        eventRender: function(event, element) {
            var startTime = event.start.format('HH:mm');
            element.html(
                '<div class="fc-content">' +
                '<span class="fc-time">' + startTime + '</span><br/>' +
                    '<span class="fc-title">' + event.title + '</span><br/>' +
                    '<span class="fc-description">' + event.descripcion + '</span>' +
                '</div>'
            );
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
            var id = calEvent.tipo_servicio;
            $('#tipo_servicio option').each(function() {
                var idOption = $(this).val();
                if (id == idOption) {
                    $(this).prop('selected', true);
                }
            });
                    
            var idCalendario = calEvent.tipo_calendario;
            $('#tipo_calendario_consultas option').each(function() {
                var idOptionCalendario = $(this).val();
                if (idCalendario == idOptionCalendario) {
                    $(this).prop('selected', true);
                }
            });
            

            FechaHora = calEvent.start.format().split("T");
            $('#txtFecha').val(FechaHora[0]);
            /*$('#txtHora').val(FechaHora[1]);*/
            
            
            $("#ModalEventos").modal();
        },
        editable: false,
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

function EnviarInformacion(accion, objEvento, modal = false) {
    $.ajax({
        type: 'POST',
        url: '../../../controller/eventoscalendarioadmin.php?accion=' + accion,
        data: objEvento,
        success: function (response) {
            try {
                console.log(response);
                let msg = JSON.parse(response);
                console.log(msg);
                if (msg) {
                    $('#CalendarioWeb').fullCalendar('refetchEvents');
                    if (!modal) {
                        $("#ModalEventos").modal('toggle');
                    }
                }
            } catch (e) {
                console.error("Error parsing response:", response);
                alert("Error: Invalid server response.");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error details:', {
                jqXHR: jqXHR,
                textStatus: textStatus,
                errorThrown: errorThrown
            });
            alert("Error en la solicitud enviar informacion.");
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

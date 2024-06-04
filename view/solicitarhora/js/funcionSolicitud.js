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
        
        events: {
            url: 'http://localhost/parroquia_chocalan/admin/view/calendario_eucaristias/eventos.php',
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
});


// var NuevoEvento;

// $('#btnAgregar').click(function () {
//     RecolectarDatosGUI();
//     EnviarInformacion('agregar', NuevoEvento);
// });
// $('#btnEliminar').click(function () {
//     RecolectarDatosGUI();
//     /*EnviarInformacion('agregar', NuevoEvento);*/
//     EnviarInformacion('eliminar', NuevoEvento);
// });
// $('#btnModificar').click(function () {
//     RecolectarDatosGUI();
//     /*EnviarInformacion('agregar', NuevoEvento);*/
//     EnviarInformacion('modificar', NuevoEvento);
// });
// function RecolectarDatosGUI() {
    
//     NuevoEvento = {
//         id: $('#txtID').val(),
//         titulo: $('#txtTitulo').val(),
//         inicio: $('#txtFecha').val() + " " + $('#txtHora').val(),
//         color: $('#txtColor').val(),
//         descripcion: $('#txtDescripcion').val(),
//         colorTexto: "#FFFFFF",
//         fin: $('#txtFecha').val() + " " + $('#txtHora').val(),
//     };
// }
// function EnviarInformacion(accion, objEvento, modal) {
//     $.ajax({
//         type: 'POST',
//         url: 'http://localhost/parroquia_chocalan/admin/view/calendario_eucaristias/eventos.php?accion=' + accion,
//         data: objEvento,
//         success: function (msg) {
//             if (msg) {
//                 $('#CalendarioWeb').fullCalendar('refetchEvents');
//                 if (!modal) {
//                     $("#ModalEventos").modal('toggle');
//                 }
//             }
//         },
//         error: function () {
//             alert("Error en la solicitud.");
//         }
//     },);
// }
// $('.clockpicker').clockpicker();
// function limpiarFormulario() {
//     $('#txtID').val();
//     $('#txtTitulo').html();
//     $('#txtColor').html();
//     $('#txtDescripcion').val();
// }
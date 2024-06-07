// $(document).ready(function () {
//     $('#CalendarioWeb').fullCalendar({
//         header: {
//             left: 'today,prev,next',
//             center: 'title',
//             right: 'month, basicWeek, basicDay, agendaWeek, agendaDay'
//         },
        
//         dayClick: function (date, jsEvent, view) {
//             /*estos hacen que cuando pongas agregar moficar o borrar los otros botones se oculten */
//             $('#btnAgregar').prop("disabled", false);
//             $('#btnModificar').prop("disabled", true);
//             $('#btnEliminar').prop("disabled", true);

//             limpiarFormulario();
//             $('#txtFecha').val(date.format());
//             $("#ModalEventos").modal();
//         },

//         events: 'http://localhost/parroquia_chocalan/admin/calendario/eventos.php',


//         eventClick: function (calEvent, jsEvent, view) {
//             $('#btnAgregar').prop("disabled", true);
//             $('#btnModificar').prop("disabled", false);
//             $('#btnEliminar').prop("disabled", false);

//             $('#tituloEvento').html(calEvent.title);
//             /*mostrar la informacion del evento en los inputs*/
//             $('#txtDescripcion').val(calEvent.descripcion);
//             $('#txtID').val(calEvent.id);
//             $('#txtTitulo').val(calEvent.titulo);
//             $('#txtColor').html(calEvent.color);

//             FechaHora = calEvent.inicio._i.split(" ");
//             $('#txtFecha').val(FechaHora[0]);
//             /*$('#txtHora').val(FechaHora[1]);*/


//             $("#ModalEventos").modal();
//         },
//         editable: true,
//         eventDrop: function (calEvent) {
//             $('#txtID').val(calEvent.id);
//             $('#txtTitulo').html(calEvent.titulo);
//             $('#txtColor').html(calEvent.color);
//             $('#txtDescripcion').val(calEvent.descripcion);

//             var fechaHora = calEvent.inicio.format().split("T");
//             $('#txtFecha').val(fechaHora[0]);
//             $('#txtHora').val(fechaHora[1]);

//             RecolectarDatosGUI();
//             EnviarInformacion('modificar', NuevoEvento, true);
//         }
//     });
// });

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
            titulo: $('#txtTitulo').val(),
            inicio: $('#txtFecha').val() + " " + $('#txtHora').val(),
            color: $('#txtColor').val(),
            descripcion: $('#txtDescripcion').val(),
            colorTexto: "#FFFFFF",
            fin: $('#txtFecha').val() + " " + $('#txtHora').val(),
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
$(document).ready(function () {
    $('#CalendarioWeb').fullCalendar({
        header: {
            left: 'today,prev,next',
            center: 'title',
            right: 'month, basicWeek, basicDay, agendaWeek, agendaDay'
        },
        
        events: {
            url: 'http://localhost/parroquia_chocalan/controller/eventoscalendarioseguidor.php',
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
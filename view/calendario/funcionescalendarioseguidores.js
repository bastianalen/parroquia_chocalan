$(document).ready(function () {
    $('#CalendarioWeb').fullCalendar({
        header: {
            left: 'today,prev,next',
            center: 'title',
            right: 'month, basicWeek, basicDay, agendaWeek, agendaDay'
        },
        
        events: {
            url: '../../controller/eventoscalendarioseguidor.php',
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
        }
    });
});
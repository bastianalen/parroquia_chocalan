// Al terminar de cargar la vista se ejecuta lo siguiente
$(document).ready(function () {
    // Se realiza una petición AJAX para obtener las horas de atención tomadas de la fecha seleccionada
    // Se llama a la consulta find_solicitud en el archivo solicitud.php y se envia la fecha seleccionada

    // Obtener el elemento con id "id_persona"
    var id_persona = document.getElementById("id_persona").value;
    $.ajax({
        url: '../../../model/pagomantencion.php',
        type: 'POST',
        data: { find_pago: '', id_pago: 0, id_persona: id_persona },
        dataType: 'json', // Esperamos recibir JSON como respuesta
        success: function (response) {
            // Se obtiene la respuesta y se valida la recepcion de datos de la base de datos
            if (response.length > 0) {
                // Si tiene datos los almacena en un array para luego diferenciarlos en la respuesta
                var options = [];
                response.forEach(function (anio) {
                    if (options.length == 0) {
                        options += anio.anio;
                    }else {
                        options += "," + anio.anio;
                    }

                });
                console.log(options)
                $.ajax({
                    url: '../../../model/pagomantencion.php',
                    type: 'POST',
                    data: { find_anios_pagados: '', id_pagos: options },
                    dataType: 'html', // Esperamos recibir HTML como respuesta
                    success: function (response) {
                        $('#anio').html(response);
                    },
                    error: function (e) {
                        console.log(e);
                        alert('Error al obtener los años de pago.');
                    }
                });
            } else {
                // No habia ninguna solicitud para la fecha seleccionada (Todas las horas disponibles)
                $.ajax({
                    url: '../../../model/pagomantencion.php',
                    type: 'POST',
                    data: { find_anios_pagados: '', id_persona: id_persona },
                    dataType: 'html', // Esperamos recibir HTML como respuesta
                    success: function (response) {
                        $('#anio').html(response);
                    },
                    error: function (e) {
                        console.log(e);
                        alert('Error al obtener el listado de los años de pago.');
                    }
                });
            }
        },
        error: function (e) {
            console.log(e)
            alert('Error al obtener los pagos de las mantenciones.');
        }
    });
});



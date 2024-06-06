// Al terminar de cargar la vista se ejecuta lo siguiente
$(document).ready(function () {
    // Si se cambia el valor de la etiqueda con id="fecha"
    $('#fecha').on('change', function () {
        // Se obtiene el valor de la etiqueta
        var fechaSeleccionada = $(this).val();
        if (fechaSeleccionada) {
            // Se realiza una petición AJAX para obtener las horas de atención tomadas de la fecha seleccionada
            // Se llama a la consulta find_solicitud en el archivo solicitud.php y se envia la fecha seleccionada
            $.ajax({
                url: '../../public/include/solicitud.php',
                type: 'POST',
                data: { find_solicitud: '', fecha: fechaSeleccionada },
                dataType: 'json', // Esperamos recibir JSON como respuesta
                success: function (response) {
                    // Se obtiene la respuesta y se valida la recepcion de datos de la base de datos
                    if (response.length > 0) {
                        // Si tiene datos los almacena en un array para luego diferenciarlos en la respuesta
                        var options = [];
                        response.forEach(function (hora) {
                            if (options.length == 0) {
                                options += hora.hora_solicitud;
                            }else {
                                options += "," + hora.hora_solicitud;
                            }
                        });
                        console.log(options)
                        $.ajax({
                            url: '../../public/include/solicitud.php',
                            type: 'POST',
                            data: { find_solicitud_horas: '', id_horas: options },
                            dataType: 'html', // Esperamos recibir HTML como respuesta
                            success: function (response) {
                                $('#hora_solicitud').html(response);
                            },
                            error: function (e) {
                                console.log(e);
                                alert('Error al obtener las horas de solicitud.');
                            }
                        });
                    } else {
                        // No habia ninguna solicitud para la fecha seleccionada (Todas las horas disponibles)
                        $.ajax({
                            url: '../../public/include/solicitud.php',
                            type: 'POST',
                            data: { find_solicitud_horas: '', fecha: fechaSeleccionada },
                            dataType: 'html', // Esperamos recibir HTML como respuesta
                            success: function (response) {
                                $('#hora_solicitud').html(response);
                            },
                            error: function (e) {
                                console.log(e);
                                alert('Error al obtener las horas de solicitud completas.');
                            }
                        });
                    }
                },
                error: function (e) {
                    console.log(e)
                    alert('Error al obtener las solicitudes.');
                }
            });
        } else {
            $('#hora_solicitud').html('<option value="0" class="optionhora">Seleccione fecha de atención</option>');
        }
    });
});



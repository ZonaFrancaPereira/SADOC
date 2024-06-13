$(document).ready(iniciar_codificacion);

function iniciar_codificacion() {
    $("#enviar_solicitud_codificacion").on("click", enviar_solicitud_codificacion);
    $("#respuesta_codificacion_sig").on("click", respuesta_codificacion_sig);
    $('input').on('input', function () {

        $('input').each(function () {

            var boton = $('#enviar_solicitud_codificacion');
            var esta_vacio = $(this).prop('value') === '';

            boton.prop('disabled', esta_vacio);
        });

    });

    $('button').on('click', function () {
        console.log('Enviado!!');
    });
}

function enviar_solicitud_codificacion() {

    var vigencia = $("#vigencia").val();
    var fecha_solicitud_cod = $("#fecha_solicitud_cod").val();
    var usuario_solicitud_cod = $("#usuario_solicitud_cod").val();
    var cargo_solicitud_cod = $("#cargo_solicitud_cod").val();
    var correo_solicitante = $("#correo_solicitante").val();
    var nombre_documento = $("#nombre_documento").val();
    var codigo = $("#codigo").val();
    var descripcion_cambio = $("#descripcion_cambio").val();
    var link_formato_codificacion = $("#link_formato_codificacion").val();
    var elabora_nombre = $("#elabora_nombre").val();
    var elabora_correo = $("#elabora_correo").val();
    var revisa_nombre = $("#revisa_nombre").val();
    var revisa_correo = $("#revisa_correo").val();
    var aprueba_nombre = $("#aprueba_nombre").val();
    var aprueba_correo = $("#aprueba_correo").val();
    var codigo_doc_afectado = [];
        $("input[name='codigo_doc_afectado[]']").each(function() {
            codigo_doc_afectado.push($(this).val());
        });

    var nombre_doc_afectado = [];
        $("input[name='nombre_doc_afectado[]']").each(function() {
            nombre_doc_afectado.push($(this).val());
        });

    var afecta = [];
        $("select[name='afecta[]']").each(function() {
            afecta.push($(this).val());
        });
    var todos_colaboradores = $('input[name="todos_colaboradores"]:checked').val() === 'Si' ? 'Si' : 'No';
    var solo_lider = $('input[name="solo_lider"]:checked').val() === 'Si' ? 'Si' : 'No';
    var miembros_proceso = $('input[name="miembros_proceso"]:checked').val() === 'Si' ? 'Si' : 'No';
    var colaborador_especifico = $('input[name="colaborador_especifico"]:checked').val() === 'Si' ? 'Si' : 'No';
    var nombre_interna = [];
        $("input[name='nombre_interna[]']").each(function() {
            nombre_interna.push($(this).val());
        });

    var correo_interna = [];
        $("input[name='correo_interna[]']").each(function() {
            correo_interna.push($(this).val());
        });

    var nombre_externa = [];
        $("input[name='nombre_externa[]']").each(function() {
            nombre_externa.push($(this).val());
        });

    var correo_externa = [];
        $("input[name='correo_externa[]']").each(function() {
            correo_externa.push($(this).val());
        });
    var enviar_copia = $('input[name="enviar_copia"]:checked').val() === 'Si' ? 'Si' : 'No';

    alert (vigencia+fecha_solicitud_cod+usuario_solicitud_cod+cargo_solicitud_cod+nombre_documento+codigo+descripcion_cambio+link_formato_codificacion+elabora_nombre+elabora_correo+revisa_nombre+revisa_correo+aprueba_nombre+aprueba_correo+codigo_doc_afectado+nombre_doc_afectado+afecta+todos_colaboradores+solo_lider+miembros_proceso+colaborador_especifico+nombre_interna+correo_interna+nombre_externa+correo_externa+enviar_copia)

    if ( nombre_documento == "" || codigo == "") {
        Swal.fire(
            'Atención',
            'Debes diligenciar todos los campos para poder continuar',
            'error'
        )
    } else {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: '¿Estas segur@ que quieres Radicar esta Solicitud?',
            text: "Recuerda que una vez enviada quedara a disposicion de SIG",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, Radicar',
            cancelButtonText: 'No, Cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                var json = {

                    'vigencia': vigencia,
                    'fecha_solicitud_cod': fecha_solicitud_cod,
                    'usuario_solicitud_cod': usuario_solicitud_cod,
                    'cargo_solicitud_cod': cargo_solicitud_cod,
                    'correo_solicitante' : correo_solicitante,
                    'nombre_documento': nombre_documento,
                    'codigo': codigo,
                    'descripcion_cambio': descripcion_cambio,
                    'link_formato_codificacion': link_formato_codificacion,
                    'elabora_nombre': elabora_nombre,
                    'elabora_correo': elabora_correo,
                    'revisa_nombre': revisa_nombre,
                    'revisa_correo': revisa_correo,
                    'aprueba_nombre': aprueba_nombre,
                    'aprueba_correo': aprueba_correo,
                    'codigo_doc_afectado': codigo_doc_afectado,
                    'nombre_doc_afectado': nombre_doc_afectado,
                    'afecta': afecta,
                    'todos_colaboradores': todos_colaboradores,
                    'solo_lider': solo_lider,
                    'miembros_proceso': miembros_proceso,
                    'colaborador_especifico': colaborador_especifico,
                    'nombre_interna': nombre_interna,
                    'correo_interna': correo_interna,
                    'nombre_externa': nombre_externa,
                    'correo_externa': correo_externa,
                    'enviar_copia': enviar_copia
                }
                $.ajax({
                    type: "POST",
                    data: json,
                    url: 'php/insertar_codificacion.php',
                    success: function (resultactividad) {
                        Swal.fire({
                            title: 'Buen Trabajo',
                            text: 'Se registró la actividad con éxito',
                            icon: 'success',
                        }).then((result) => {
                            // Redirige a la página después de cerrar el SweetAlert
                            if (result.isConfirmed) {
                                window.location.href = 'codificar.php';
                            }
                        });
                    }
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Envio Cancelado',
                    'Aun estas a salvo :)',
                    'error'
                )
            }
        })

    }



}

function respuesta_codificacion_sig() {
    // Obtener los valores de los campos del formulario
    var id_codificacion = $('#id_codificacion').val();
    var estado_sig_codificacion = $('#estado_sig_codificacion').val();
    var fecha_sig_codificacion = $('#fecha_sig_codificacion').val();
    var responsable_sig_codificacion = $('#responsable_sig_codificacion').val();
    var causa_rechazo_codificacion = $('#causa_rechazo_codificacion').val();

    // Obtener el contenido de Quill
    var quill = new Quill('#editor1');
    var evidencia_difucion = quill.root.innerHTML; // Obtener el contenido de Quill

    // Alerta para verificar que se están obteniendo los valores correctamente
    alert(id_codificacion + estado_sig_codificacion + fecha_sig_codificacion + responsable_sig_codificacion + causa_rechazo_codificacion + evidencia_difucion);

    // Enviar la solicitud AJAX para actualizar el estado del usuario
    if (estado_sig_codificacion == "" || fecha_sig_codificacion == "") {
        Swal.fire(
            'Atención',
            'Debes diligenciar todos los campos para poder continuar',
            'error'
        )
    } else {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: '¿Estas segur@ que quieres Agregar esta Respuesta?',
            text: "Recuerda que una vez guardada esta respuesta, no se podrá modificar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, Agregar',
            cancelButtonText: 'No, Cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                var json = {
                    'id_codificacion': id_codificacion,
                    'estado_sig_codificacion': estado_sig_codificacion,
                    'fecha_sig_codificacion': fecha_sig_codificacion,
                    'responsable_sig_codificacion': responsable_sig_codificacion,
                    'causa_rechazo_codificacion': causa_rechazo_codificacion,
                    'evidencia_difucion': evidencia_difucion
                }
                $.ajax({
                    type: 'POST',
                    data: json,
                    url: 'php/insertar_respuesta_codificacion.php',
                    success: function (resultacpm) {
                        Swal.fire({
                            title: 'Buen Trabajo',
                            text: 'Respuesta Guardada Correctamente',
                            icon: 'success',
                        }).then((result) => {
                            // Redirige a la página después de cerrar el SweetAlert
                            if (result.isConfirmed) {
                                window.location.href = '';
                            }
                        });
                    }
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Envio Cancelado',
                    'Aun estas a salvo :)',
                    'error'
                )
            }
        })

    }
}

$(document).ready(iniciar_actividad);

function iniciar_actividad() {
    $("#asignacion").on("click", insertar_detalles);
    $("#guardar_asignacion").on("click", guardar_asignacion);
    
}

function insertar_detalles() {
    var id_activo_fk = $("#id_activo_fk").val();
    var msd = $("#msd").val();
    var antivirus = $("#antivirus").val();
    var visio_pro = $("#visio_pro").val();
    var mac_osx = $("#mac_osx").val();
    var windows = $("#windows").val();
    var autocad = $("#autocad").val();
    var office = $("#office").val();
    var appolo = $("#appolo").val();
    var zeus = $("#zeus").val();
    var otros = $("#otros").val();
    var procesador = $("#procesador").val();
    var disco_duro = $("#disco_duro").val();
    var memoria_ram = $("#memoria_ram").val();
    var cd_dvd = $("#cd_dvd").val();
    var tarjeta_video = $("#tarjeta_video").val();
    var tarjeta_red = $("#tarjeta_red").val();
    var tipo_red = $("#tipo_red").val();
    var tiempo_bloqueo = $("#tiempo_bloqueo").val();
    var usuario = $("#usuario").val();
    var clave = $("#clave").val();
    var zfip = $("#zfip").val();
    var privilegios = $("#privilegios").val();
    var backup = $("#backup").val();
    var dia_backup = $("#dia_backup").val();
    var realiza_backup = $("#realiza_backup").val();
    var justificacion_backup = $("#justificacion_backup").val();
    if (id_activo_fk == "" ) {
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
            title: '¿Estas segur@ que quieres registrar las características de este equipo',
            text: "Este equipo ya no aparecerá en este espacio, debido a que ya tiene características",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, Registrar',
            cancelButtonText: 'No, Cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Creando el JSON con los valores capturados
                var json = {
                    'id_activo_fk': id_activo_fk,
                    'msd': msd,
                    'antivirus': antivirus,
                    'visio_pro': visio_pro,
                    'mac_osx': mac_osx,
                    'windows': windows,
                    'autocad': autocad,
                    'office': office,
                    'appolo': appolo,
                    'zeus': zeus,
                    'otros': otros,
                    'procesador': procesador,
                    'disco_duro': disco_duro,
                    'memoria_ram': memoria_ram,
                    'cd_dvd': cd_dvd,
                    'tarjeta_video': tarjeta_video,
                    'tarjeta_red': tarjeta_red,
                    'tipo_red': tipo_red,
                    'tiempo_bloqueo': tiempo_bloqueo,
                    'usuario': usuario,
                    'clave': clave,
                    'zfip': zfip,
                    'privilegios': privilegios,
                    'backup': backup,
                    'dia_backup': dia_backup,
                    'realiza_backup': realiza_backup,
                    'justificacion_backup': justificacion_backup
                };

                // Mostrando el JSON en la consola
                console.log(json);

                // Opcional: Convertir el JSON a una cadena y mostrar en un alert
                //alert(JSON.stringify(json));
                $.ajax({
                    type: "POST",
                    data: json,
                    url: 'php/insertar_detalles.php',
                    success: function (resultactividad) {
                        
                        Swal.fire({
                            title: 'Buen Trabajo',
                            text: 'Se registró la actividad con éxito',
                            icon: 'success',
                        }).then((result) => {
                            // Redirige a la página después de cerrar el SweetAlert
                            if (result.isConfirmed) {
                                window.location.href = 'asignacion_ti.php';
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

function guardar_asignacion(){
    var fecha_asignacion = $("#fecha_asignacion").val();
    var id_activoa_fk = $("#id_activoa_fk").val();
    var id_usuario_fk = $("#id_usuario_fk").val();
    var observaciones_asignacion = $("#observaciones_asignacion").val();
   alert(id_usuario_fk+fecha_asignacion+observaciones_asignacion);
    if (id_activo_fk == "" ) {
        Swal.fire(
            'Atención',
            'Debes diligenciar todos los campos para poder continuaaaar',
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
            title: '¿Estas segur@ que quieres registrar las características de este equipo',
            text: "Este equipo ya no aparecerá en este espacio, debido a que ya tiene características",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, Registrar',
            cancelButtonText: 'No, Cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Creando el JSON con los valores capturados
                var json = {
                    'id_activoa_fk': id_activoa_fk,
                    'id_usuario_fk': id_usuario_fk,
                    'fecha_asignacion': fecha_asignacion,
                    'observaciones_asignacion': observaciones_asignacion
                 
                };

                // Mostrando el JSON en la consola
                console.log(json);

                // Opcional: Convertir el JSON a una cadena y mostrar en un alert
                //alert(JSON.stringify(json));
                $.ajax({
                    type: "POST",
                    data: json,
                    url: 'php/insertar_asignacion.php',
                    success: function (resultactividad) {
                        
                        Swal.fire({
                            title: 'Buen Trabajo',
                            text: 'Se registró la actividad con éxito',
                            icon: 'success',
                        }).then((result) => {
                            // Redirige a la página después de cerrar el SweetAlert
                            if (result.isConfirmed) {
                                $('#form-asignacion').trigger('reset');
                                $("a").removeClass("active");
                                $("#equipos_nav").addClass("active");
                                var tabToShow = $('#asignar');
                                tabToShow.tab('show');
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

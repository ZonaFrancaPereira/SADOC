$(document).ready(gestion_ti);

function gestion_ti() {
	$("#editarUsuario").on("click", editarUsuario);
    $("#actualizar").on("click", actualizarEstadoUsuario);
	$("#nuevo_usuario").on("click", nuevoUsuario);
	$("#enviar_formulario_mantenimiento").on("click", enviarFormularioMantenimiento);
	$("#enviar_formulario_impresoras").on("click", enviarFormularioImpresoras);
	$("#enviar_formulario_general").on("click", enviarFormularioGeneral);


	$('input').on('input', function () {

		$('input').each(function () {

			var boton = $('#enviar_acpm');
			var esta_vacio = $(this).prop('value') === '';

			boton.prop('disabled', esta_vacio);
		});
	});
	$('button').on('click', function () {
		console.log('Enviado!!');
	});
}

function editarUsuario(id, correo, contrasena, nombre, apellidos, estado, proceso, cargo, tipo) {
    // Abrir el modal
    $('#modal-editar').modal('show');
    // Llenar los campos del formulario con los datos del usuario
    $('#id_usuario').val(id);
    $('#correo_usuario').val(correo);
    $('#contrasena_usuario').val(contrasena);
    $('#nombre_usuario_equipo').val(nombre);
    $('#apellidos_usuario').val(apellidos);
    $('#estado_usuario').val(estado);
    $('#proceso_usuario_fk').val(proceso);
    $('#id_cargo_fk').val(cargo);
    $('#tipo_usuario_fk').val(tipo);
}

function actualizarEstadoUsuario() {
    // Obtener los valores de los campos del formulario
    var id_usuario = $('#id_usuario').val();
    var estado_usuario = $('#estado_usuario').val();
        //alert (id_usuario + estado_usuario);
    // Enviar la solicitud AJAX para actualizar el estado del usuario
	if (id_usuario == "" || estado_usuario == "") {
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
			title: '¿Estas segur@ que quieres Actualizar este Usuario?',
			text: "Recuerda que una vez desactivado el usuario no podrá ingresar al sistema",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Si, Actualizar',
			cancelButtonText: 'No, Cancelar!',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				var json = {
                    'id_usuario': id_usuario,
                    'estado_usuario': estado_usuario
				}
                $.ajax({
                    type: 'POST',
                    data: json,
                    url: 'php/actualizar_usuario.php',
					success: function (resultacpm) {
						Swal.fire({
							title: 'Buen Trabajo',
							text: 'Se actualizo el usuario correctamente',
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

function nuevoUsuario() {
    // Obtener los valores de los campos del formulario
    var  correo_usuario2= $('#correo_usuario2').val();
	var  contrasena_usuario2 = $('#contrasena_usuario2').val();
	var  nombre_usuario2 = $('#nombre_usuario2').val();
	var  apellidos_usuario2 = $('#apellidos_usuario2').val();
	var  estado_usuario_nuevo = $('#estado_usuario_nuevo').val();
	var  proceso_usuario_fk2= $('#proceso_usuario_fk2').val();
	var  id_cargo_fk2= $('#id_cargo_fk2').val();
	var  tipo_usuario_fk2= $('#tipo_usuario_fk2').val();

     //   alert (estado_usuario_nuevo + correo_usuario2 + contrasena_usuario2 + nombre_usuario2 + apellidos_usuario2 + proceso_usuario_fk2 + id_cargo_fk2 + tipo_usuario_fk2);
    // Enviar la solicitud AJAX para actualizar el estado del usuario
	if (correo_usuario2 == "" || nombre_usuario2 == "") {
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
			title: '¿Estas segur@ que quieres Agregar este Usuario?',
			text: "Recuerda que una vez Agregado el usuario podrá ingresar al sistema",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Si, Agregar',
			cancelButtonText: 'No, Cancelar!',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				var json = {
                    'correo_usuario2': correo_usuario2 ,
					'contrasena_usuario2': contrasena_usuario2,
					'nombre_usuario2': nombre_usuario2,
					'apellidos_usuario2': apellidos_usuario2,
					'estado_usuario_nuevo': estado_usuario_nuevo,
					'proceso_usuario_fk2': proceso_usuario_fk2,
					'id_cargo_fk2': id_cargo_fk2,
                    'tipo_usuario_fk2': tipo_usuario_fk2
				}
                $.ajax({
                    type: 'POST',
                    data: json,
                    url: 'php/agregar_usuario.php',
					success: function (resultacpm) {
						Swal.fire({
							title: 'Buen Trabajo',
							text: 'Se Agrego el usuario correctamente',
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

function enviarFormularioMantenimiento() {
    // Obtener los valores de los campos del formulario
	var id_proceso_fk= $('#id_proceso_fk').val();
	var fecha_mantenimiento= $('#fecha_mantenimiento').val();
	var Id_usuario_fk= $('#Id_usuario_fk').val();
	var id_cargo_fk= $('#id_cargo_fk').val();
	var correo_destinatario= $('#correo_destinatario').val();
	var marca= $('#marca').val();
	var modelo= $('#modelo').val();
	var serie= $('#serie').val();
	var nombre_usuario= $('#nombre_usuario').val();
	var soplar_partes_externas= $('#soplar_partes_externas').val();
	var verificar_usuario= $('#verificar_usuario').val();
	var liberar_espacio= $('#liberar_espacio').val();
	var actualizar_logos= $('#actualizar_logos').val();
	var lubricar_puertos= $('#lubricar_puertos').val();
	var verificar_contraseñas= $('#verificar_contraseñas').val();
	var desinstalar_programas= $('#desinstalar_programas').val();
	var organizar_cableado= $('#organizar_cableado').val();
	var limpieza_equipo= $('#limpieza_equipo').val();
	var formato_asignacion_equipo= $('#formato_asignacion_equipo').val();
	var desfragmentar= $('#desfragmentar').val();
	var limpiar_partes_interna= $('#limpiar_partes_interna').val();
	var depurar_temporales= $('#depurar_temporales').val();
	var verificar_actualizaciones= $('#verificar_actualizaciones').val();
	var usuario = $('#usuario').is(':checked') ? 'SI' : 'NO';
	var clave = $('#clave').is(':checked') ? 'SI' : 'NO';
	var estandar = $('#estandar').is(':checked') ? 'SI' : 'NO';
	var administrador = $('#administrador').is(':checked') ? 'SI' : 'NO';
	var analisis_completo = $('#analisis_completo').is(':checked') ? 'SI' : 'NO';
	var bloqueo_usb = $('#bloqueo_usb').is(':checked') ? 'SI' : 'NO';
	var dominio_zfip = $('#dominio_zfip').is(':checked') ? 'SI' : 'NO';
	var apagar_pantalla = $('#apagar_pantalla').is(':checked') ? 'SI' : 'NO';
	var estado_suspension = $('#estado_suspension').is(':checked') ? 'SI' : 'NO';
	var firma= $('#firma').val();
	var estado_mantenimiento_equipo= $('#estado_mantenimiento_equipo').val();


	
    // alert (id_proceso_fk + fecha_mantenimiento + Id_usuario_fk + id_cargo_fk + correo_destinatario + marca + modelo + serie + nombre_usuario + soplar_partes_externas + verificar_usuario + liberar_espacio + actualizar_logos + lubricar_puertos + verificar_contraseñas + desinstalar_programas + organizar_cableado + limpieza_equipo + formato_asignacion_equipo + desfragmentar + limpiar_partes_interna + depurar_temporales + verificar_actualizaciones + usuario + clave + estandar + administrador + analisis_completo + bloqueo_usb + dominio_zfip + apagar_pantalla + estado_suspension + firma);
    // Enviar la solicitud AJAX para actualizar el estado del usuario
	if (id_cargo_fk == "" || fecha_mantenimiento == "") {
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
			title: '¿Estas segur@ que quieres guardar este mantenimiento?',
			text: "Recuerda que una vez guardado este no podrá ser eliminado",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Si, Agregar',
			cancelButtonText: 'No, Cancelar!',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				var json = {
					'id_proceso_fk': id_proceso_fk,
					'fecha_mantenimiento': fecha_mantenimiento,
					'Id_usuario_fk': Id_usuario_fk,
					'id_cargo_fk': id_cargo_fk,
					'correo_destinatario': correo_destinatario,
					'marca': marca,
					'modelo': modelo,
					'serie': serie,
					'nombre_usuario': nombre_usuario,
					'soplar_partes_externas': soplar_partes_externas,
					'verificar_usuario': verificar_usuario,
					'liberar_espacio': liberar_espacio,
					'actualizar_logos': actualizar_logos,
					'lubricar_puertos': lubricar_puertos,
					'verificar_contraseñas': verificar_contraseñas,
					'desinstalar_programas': desinstalar_programas,
					'organizar_cableado': organizar_cableado,
					'limpieza_equipo': limpieza_equipo,
					'formato_asignacion_equipo': formato_asignacion_equipo,
					'desfragmentar': desfragmentar,
					'limpiar_partes_interna': limpiar_partes_interna,
					'depurar_temporales': depurar_temporales,
					'verificar_actualizaciones': verificar_actualizaciones,
					'usuario': usuario,
					'clave': clave,
					'estandar': estandar,
					'administrador': administrador,
					'analisis_completo': analisis_completo,
					'bloqueo_usb': bloqueo_usb,
					'dominio_zfip': dominio_zfip,
					'apagar_pantalla': apagar_pantalla,
					'estado_suspension': estado_suspension,
					'firma': firma,
					'estado_mantenimiento_equipo': estado_mantenimiento_equipo
					
				}
                $.ajax({
                    type: 'POST',
                    data: json,
                    url: 'php/insertar_mantenimiento.php',
					success: function (resultacpm) {
						Swal.fire({
							title: 'Buen Trabajo',
							text: 'Se guardo el mantenimiento correctamente',
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

function enviarFormularioImpresoras() {
    // Obtener los valores de los campos del formulario
	var id_proceso_fk_2= $('#id_proceso_fk_2').val();
	var fecha_mantenimiento_impresora= $('#fecha_mantenimiento_impresora').val();
	var Id_usuario_fk2= $('#Id_usuario_fk2').val();
	var id_cargo_fk2= $('#id_cargo_fk2').val();
	var correo_destinatario1= $('#correo_destinatario1').val();
	var nombre_impresora= $('#nombre_impresora').val();
	var marca_impresora= $('#marca_impresora').val();
	var modelo_impresora= $('#modelo_impresora').val();
	var serial_impresora= $('#serial_impresora').val();
	var soplar_exterior= $('#soplar_exterior').val();
	var isopropilico= $('#isopropilico').val();
	var toner= $('#toner').val();
	var alinear= $('#alinear').val();
	var verificar_cableado= $('#verificar_cableado').val();
	var rodillos= $('#rodillos').val();
	var reemplazar= $('#reemplazar').val();
	var limpiar= $('#limpiar').val();
	var imprimir= $('#imprimir').val();
	var verificar= $('#verificar').val();
	var estado_mantenimiento_impresora= $('#estado_mantenimiento_impresora').val();


    // alert (id_proceso_fk_2 + fecha_mantenimiento_impresora + Id_usuario_fk2 + id_cargo_fk2 + correo_destinatario1 + nombre_impresora + marca_impresora + modelo_impresora + serial_impresora + soplar_exterior + isopropilico + toner + alinear + verificar_cableado + rodillos + reemplazar + limpiar + imprimir + verificar);
    // Enviar la solicitud AJAX para actualizar el estado del usuario
	if (id_cargo_fk2 == "" || fecha_mantenimiento_impresora == "") {
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
			title: '¿Estas segur@ que quieres guardar este mantenimiento?',
			text: "Recuerda que una vez guardado este no podrá ser eliminado",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Si, Agregar',
			cancelButtonText: 'No, Cancelar!',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				var json = {
					'id_proceso_fk_2': id_proceso_fk_2,
					'fecha_mantenimiento_impresora': fecha_mantenimiento_impresora,
					'Id_usuario_fk2': Id_usuario_fk2,
					'id_cargo_fk2': id_cargo_fk2,
					'correo_destinatario1': correo_destinatario1,
					'nombre_impresora': nombre_impresora,
					'marca_impresora': marca_impresora,
					'modelo_impresora': modelo_impresora,
					'serial_impresora': serial_impresora,
					'soplar_exterior': soplar_exterior,
					'isopropilico': isopropilico,
					'toner': toner,
					'alinear': alinear,
					'verificar_cableado': verificar_cableado,
					'rodillos': rodillos,
					'reemplazar': reemplazar,
					'limpiar': limpiar,
					'imprimir': imprimir,
					'verificar': verificar,
					'estado_mantenimiento_impresora': estado_mantenimiento_impresora

				}
                $.ajax({
                    type: 'POST',
                    data: json,
                    url: 'php/insertar_mantenimiento_impresora.php',
					success: function (resultacpm) {
						Swal.fire({
							title: 'Buen Trabajo',
							text: 'Se guardo el mantenimiento correctamente',
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

function enviarFormularioGeneral() {
    // Obtener los valores de los campos del formulario
	var id_proceso_fk_3= $('#id_proceso_fk_3').val();
	var fecha_mantenimiento3= $('#fecha_mantenimiento3').val();
	var Id_usuario_fk3= $('#Id_usuario_fk3').val();
	var id_cargo_fk3= $('#id_cargo_fk3').val();
	var correo_destinatario2= $('#correo_destinatario2').val();
	var articulo= $('#articulo').val();
	var marca_general= $('#marca_general').val();
	var modelo_general= $('#modelo_general').val();
	var serial_general= $('#serial_general').val();
	var partes_externas= $('#partes_externas').val();
	var condiciones_fisicas= $('#condiciones_fisicas').val();
	var cableado_verificar= $('#cableado_verificar').val();
	var dispositivo= $('#dispositivo').val();
	var estado_general= $('#estado_general').val();


    // alert (id_proceso_fk_3 + fecha_mantenimiento3 + Id_usuario_fk3 + id_cargo_fk3 + correo_destinatario2 + articulo + marca_general + modelo_general + serial_general + partes_externas + condiciones_fisicas + cableado_verificar + dispositivo );
    // Enviar la solicitud AJAX para actualizar el estado del usuario
	if (id_cargo_fk3 == "" || fecha_mantenimiento3 == "") {
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
			title: '¿Estas segur@ que quieres guardar este mantenimiento?',
			text: "Recuerda que una vez guardado este no podrá ser eliminado",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Si, Agregar',
			cancelButtonText: 'No, Cancelar!',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				var json = {
					'id_proceso_fk_3': id_proceso_fk_3,
					'fecha_mantenimiento3': fecha_mantenimiento3,
					'Id_usuario_fk3': Id_usuario_fk3,
					'id_cargo_fk3': id_cargo_fk3,
					'correo_destinatario2': correo_destinatario2,
					'articulo': articulo,
					'marca_general': marca_general,
					'modelo_general': modelo_general,
					'serial_general': serial_general,
					'partes_externas': partes_externas,
					'condiciones_fisicas': condiciones_fisicas,
					'cableado_verificar': cableado_verificar,
					'dispositivo': dispositivo,
					'estado_general': estado_general
				}
                $.ajax({
                    type: 'POST',
                    data: json,
                    url: 'php/insertar_mantenimiento_general.php',
					success: function (resultacpm) {
						Swal.fire({
							title: 'Buen Trabajo',
							text: 'Se guardo el mantenimiento correctamente',
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

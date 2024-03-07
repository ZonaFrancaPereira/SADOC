$(document).ready(iniciar_acpm);

function iniciar_acpm() {
	$("#enviar_acpm").on("click", insertar_acpm);
	$("#guardar_sig").on("click", guardar_sig);
	$("#rechazar_sig").on("click", rechazar_sig);
	$("#modificar_fecha").on("click", modificar_fecha);


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
function insertar_acpm() {
	var origen_acpm = $("#origen_acpm").val();
	var fuente_acpm = $("#fuente_acpm").val();
	var descripcion_fuente = $("#descripcion_fuente").val();
	var tipo_acpm = $("#tipo_acpm").val();
	var descripcion_acpm = $("#descripcion_acpm").val();
	var causa_acpm = $("#causa_acpm").val();
	var nc_similar = $("#nc_similar").val();
	var descripcion_nsc = $("#descripcion_nsc").val();
	var correccion_acpm = $("#correccion_acpm").val();
	var fecha_correccion = $("#fecha_correccion").val();
	var riesgo_acpm = $("#riesgo_acpm").val();
	var justificacion_riesgo = $("#justificacion_riesgo").val();
	var fecha_finalizacion = $("#fecha_finalizacion").val();
	var id_usuario_fk = $("#id_usuario_fk").val();
	//alert(origen_acpm+fuente_acpm+descripcion_fuente+tipo_acpm+descripcion_nsc+causa_acpm+nc_similar+descripcion_nsc+correccion_acpm+fecha_correccion+riesgo_acpm+justificacion_riesgo);
	if (origen_acpm == "" || fuente_acpm == "") {
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
			title: '¿Estas segur@ que quieres Radicar esta ACPM?',
			text: "Recuerda que una vez enviada quedara a disposicion de SIG para desmontarla",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Si, Radicar',
			cancelButtonText: 'No, Cancelar!',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				var json = {
					'origen_acpm': origen_acpm,
					'fuente_acpm': fuente_acpm,
					'descripcion_fuente': descripcion_fuente,
					'tipo_acpm': tipo_acpm,
					'descripcion_acpm': descripcion_acpm,
					'causa_acpm': causa_acpm,
					'nc_similar': nc_similar,
					'descripcion_nsc': descripcion_nsc,
					'correccion_acpm': correccion_acpm,
					'fecha_correccion': fecha_correccion,
					'riesgo_acpm': riesgo_acpm,
					'justificacion_riesgo': justificacion_riesgo,
					'fecha_finalizacion': fecha_finalizacion,
					'id_usuario_fk': id_usuario_fk
				}
				$.ajax({
					type: "POST",
					data: json,
					url: 'php/insertar_acpm.php',
					success: function (resultacpm) {
						Swal.fire({
							title: 'Buen Trabajo',
							text: 'Se registró la ACPM con éxito',
							icon: 'success',
						}).then((result) => {
							// Redirige a la página después de cerrar el SweetAlert
							if (result.isConfirmed) {
								window.location.href = 'acpm.php';
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

function guardar_sig() {
	var id_acpm = $("#id_acpm_sig").val();
	var riesgo_acpm = $("#riesgo_acpm_sig").val();
	var justificacion_riesgo = $("#justificacion_riesgo_sig").val();
	var cambios_sig = $("#cambios_sig").val();
	var justificacion_sig = $("#justificacion_sig").val();
	var conforme_sig = $("#conforme_sig").val();
	var justificacion_conforme_sig = $("#justificacion_conforme_sig").val();
	var fecha_estado = $("#fecha_estado_sig").val();

	if (fecha_estado == "" || justificacion_conforme_sig == "") {
		Swal.fire(
			'Atención',
			'Debes diligenciar todos los campos para poder continuar',
			'error'
		);
	} else {
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger'
			},
			buttonsStyling: false
		});

		swalWithBootstrapButtons.fire({
			title: '¿Estas segur@ que quieres enviar esta Respuesta?',
			text: 'Recuerda que una vez enviada NO SE PUEDE DESMONTAR',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Si, Enviar',
			cancelButtonText: 'No, Cancelar!',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				var json = {
					'id_acpm_sig': id_acpm,
					'riesgo_acpm_sig': riesgo_acpm,
					'justificacion_riesgo_sig': justificacion_riesgo,
					'cambios_sig': cambios_sig,
					'justificacion_sig': justificacion_sig,
					'conforme_sig': conforme_sig,
					'justificacion_conforme_sig': justificacion_conforme_sig,
					'fecha_estado_sig': fecha_estado
				};

				$.ajax({
					type: 'POST',
					url: 'php/insertar_acpmsig.php',
					data: json,
					success: function (resultacpm) {
						Swal.fire({
							title: 'Buen Trabajo',
							text: 'Su respuesta se registro con éxito',
							icon: 'success',
						}).then((result) => {
							// Redirige a la página después de cerrar el SweetAlert
							if (result.isConfirmed) {
								window.location.href = '';
							}
						});
					}
				});
			} else if (result.dismiss === Swal.DismissReason.cancel) {
				swalWithBootstrapButtons.fire(
					'Envio Cancelado',
					'Aun estas a salvo :)',
					'error'
				);
			}
		});
	}
}

function rechazar_sig() {
	var descripcion_rechazo_sig = $("#descripcion_rechazo_sig").val();
	var id_acpm_fk_sig = $("#id_acpm_fk_sig").val();

	if (descripcion_rechazo_sig == "" || id_acpm_fk_sig == "") {
		Swal.fire(
			'Atención',
			'Debes diligenciar todos los campos para poder continuar',
			'error'
		);
	} else {
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger'
			},
			buttonsStyling: false
		});

		swalWithBootstrapButtons.fire({
			title: '¿Estas segur@ que quieres RECHAZAR ESTA ACPM?',
			text: 'Recuerda que NO ABRA RETORNO',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Si, Enviar',
			cancelButtonText: 'No, Cancelar!',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				var json = {
					'descripcion_rechazo_sig': descripcion_rechazo_sig,
    				'id_acpm_fk_sig': id_acpm_fk_sig
				};

				$.ajax({
					type: 'POST',
					url: 'php/acpm_rechazada.php',
					data: json,
					success: function (resultacpm) {
						Swal.fire({
							title: 'Buen Trabajo',
							text: 'Su respuesta se registro con éxito',
							icon: 'success',
						}).then((result) => {
							// Redirige a la página después de cerrar el SweetAlert
							if (result.isConfirmed) {
								window.location.href = '';
							}
						});
					}
				});
			} else if (result.dismiss === Swal.DismissReason.cancel) {
				swalWithBootstrapButtons.fire(
					'Envio Cancelado',
					'Aun estas a salvo :)',
					'error'
				);
			}
		});
	}
}

function modificar_fecha() {
	var id_acpm_fk1 = $("#id_acpm_fk1").val();
	var fecha_modificar = $("#fecha_modificar").val();

	if (id_acpm_fk1 == "" || fecha_modificar == "") {
		Swal.fire(
			'Atención',
			'Debes diligenciar todos los campos para poder continuar',
			'error'
		);
	} else {
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger'
			},
			buttonsStyling: false
		});

		swalWithBootstrapButtons.fire({
			title: '¿Estas segur@ que quieres Modificar la Fecha de esta ACPM?',
			text: 'Recuerda que una vez modificada se cambiara automáticamente la fecha',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Si, Enviar',
			cancelButtonText: 'No, Cancelar!',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				var json = {
					'id_acpm_fk1': id_acpm_fk1,
    				'fecha_modificar': fecha_modificar
				};

				$.ajax({
					type: 'POST',
					url: 'php/actualizar_fecha.php',
					data: json,
					success: function (resultacpm) {
						Swal.fire({
							title: 'Buen Trabajo',
							text: 'Se actualizo la fecha con exito',
							icon: 'success',
						}).then((result) => {
							// Redirige a la página después de cerrar el SweetAlert
							if (result.isConfirmed) {
								window.location.href = '';
							}
						});
					}
				});
			} else if (result.dismiss === Swal.DismissReason.cancel) {
				swalWithBootstrapButtons.fire(
					'Envio Cancelado',
					'Aun estas a salvo :)',
					'error'
				);
			}
		});
	}
}



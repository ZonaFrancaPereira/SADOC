$(document).ready(iniciar_actividad);

function iniciar_actividad() {
	$("#enviar_actividad").on("click", insertar_actividad);
	$("#modificar_fecha_actividad").on("click", modificar_fecha_actividad);
	$('input').on('input', function () {

		$('input').each(function () {

			var boton = $('#enviar_actividad');
			var esta_vacio = $(this).prop('value') === '';

			boton.prop('disabled', esta_vacio);
		});

	});

	$('button').on('click', function () {
		console.log('Enviado!!');
	});
}

function insertar_actividad() {
	var fecha_actividad = $("#fecha_actividad").val();
	var descripcion_actividad = $("#descripcion_actividad").val();
	var tipo_actividad = $("#tipo_actividad").val();
	var estado_actividad = $("#estado_actividad").val();
	var id_usuario_fk_6 = $("#id_usuario_fk_6").val();
	var id_acpm = $("#id_acpm_fk").val();
	//alert(fecha_actividad + descripcion_actividad + tipo_actividad + estado_actividad + id_usuario_fk_6 + id_acpm);

	if (descripcion_actividad == "" || id_usuario_fk_6 == "") {
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
			title: '¿Estas segur@ que quieres Asignar esta ACTIVIDAD?',
			text: "Recuerda que una vez enviada quedara a disposicion de SIG para desmontarla",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Si, Radicar',
			cancelButtonText: 'No, Cancelar!',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				var json = {
					'fecha_actividad': fecha_actividad,
					'descripcion_actividad': descripcion_actividad,
					'tipo_actividad': tipo_actividad,
					'estado_actividad': estado_actividad,
					'id_usuario_fk_6': id_usuario_fk_6,
					'id_acpm_fk': id_acpm
				}
				$.ajax({
					type: "POST",
					data: json,
					url: 'php/insertar_actividad.php',
					success: function (resultactividad){
						Swal.fire({
							title: 'Buen Trabajo',
							text: 'Se registró la actividad con éxito',
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
function modificar_fecha_actividad() {
	var id_actividad = $("#id_actividad").val();
	var fecha_modificar_actividad = $("#fecha_modificar_actividad").val();

	if (id_actividad == "" || fecha_modificar_actividad == "") {
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
			title: '¿Estas segur@ que quieres Modificar la Fecha de esta Actividad?',
			text: 'Recuerda que una vez modificada se cambiara automáticamente la fecha',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Si, Enviar',
			cancelButtonText: 'No, Cancelar!',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				var json = {
					'id_actividad': id_actividad,
    				'fecha_modificar_actividad': fecha_modificar_actividad
				};

				$.ajax({
					type: 'POST',
					url: 'php/actualizar_fecha_actividad.php',
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
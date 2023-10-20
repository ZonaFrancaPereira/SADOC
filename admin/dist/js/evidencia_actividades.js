$(document).ready(enviar_evidencia);

function enviar_evidencia() {
	$("#subir_evidencia").on("click", insertar_evidencia_actividad);
	$('input').on('input', function () {

		$('input').each(function () {

			var boton = $('#subir_evidencia');
			var esta_vacio = $(this).prop('value') === '';

			boton.prop('disabled', esta_vacio);
		});

	});

	$('button').on('click', function () {
		console.log('Enviado!!');
	});
}
function insertar_evidencia_actividad() {
	var fecha_evidencia = $("#fecha_evidencia").val();
	var evidencia = $("#evidencia").val();
	var recursos = $("#recursos").val();
	var id_actividad_fk = $("#id_actividad").val();
	var id_usuario_e_fk= $("#id_usuario_e_fk").val();
        
	//alert(fecha_evidencia+evidencia+recursos+id_actividad_fk+id_usuario_e_fk);
	if (fecha_evidencia == "" || recursos == "") {
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
			title: '¿Estas segur@ que quieres Subir esta Evidencia?',
			text: "Recuerda que una vez enviada quedara a disposicion de SIG para desmontarla",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Si, Radicar',
			cancelButtonText: 'No, Cancelar!',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				var json = {
					'fecha_evidencia': fecha_evidencia,
					'evidencia': evidencia,
					'recursos': recursos,
					'id_actividad_fk': id_actividad_fk,
					'id_usuario_e_fk': id_usuario_e_fk
				}
				$.ajax({
					type: "POST",
					data: json,
					url: 'php/insertar_evidencia_actividad.php',
					success: function (resultaactividad) {
						if (resultaactividad == "1") {
							Swal.fire(
								'Buen Trabajo',
								'Se Subio la Evidencia con exito',
								'success'
							)
							$("#evidencia_actividad").load(location.href + " #evidencia_actividad");
						} else {
							Swal.fire(
								'Ups',
								'No se Subio la evidencia Correctamente',
								'error'
							)
						}
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
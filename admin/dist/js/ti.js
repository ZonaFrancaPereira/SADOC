$(document).ready(gestion_ti);

function gestion_ti() {
	$("#editarUsuario").on("click", editarUsuario);
    $("#actualizar").on("click", actualizarEstadoUsuario);
	$("#nuevo_usuario").on("click", nuevoUsuario);


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
    $('#nombre_usuario').val(nombre);
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

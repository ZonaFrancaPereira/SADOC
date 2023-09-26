$(document).ready(iniciar_acpm);

function iniciar_acpm() {
	$("#enviar_acpm").on("click", insertar_acpm);
	$('input').on('input', function(){

		$('input').each(function() {

			var boton      = $( '#enviar_acpm' );
			var esta_vacio = $( this ).prop( 'value' ) === '';

			boton.prop('disabled', esta_vacio);        
		});
	});

	$('button').on('click', function(){  
		console.log('Enviado!!');
	});
}	
function insertar_acpm(){

	var origen_acpm = $("#origen_acpm").val();
	var fuente_acpm = $("#fuente_acpm").val();
	var descripcion_fuente = $("#descripcion_fuente").val();
	var tipo_acpm = $("#tipo_acpm").val();
	var descripcion_acpm = $("#descripcion_acpm").val();
	var causa_acpm =  $("#causa_acpm").val();
	var nc_similar = $("#nc_similar").val();
	var descripcion_nsc=$("#descripcion_nsc").val();
	var correccion_acpm =$("#correccion_acpm").val();
	var fecha_correccion =$("#fecha_correccion").val();
	var riesgo_acpm = $("#riesgo_acpm").val();
	var justificacion_riesgo = $("#justificacion_riesgo").val();
	var fecha_finalizacion = $("#fecha_finalizacion").val();
	var id_usuario_fk = $("#id_usuario_fk").val();
	//alert(origen_acpm+fuente_acpm+descripcion_fuente+tipo_acpm+descripcion_nsc+causa_acpm+nc_similar+descripcion_nsc+correccion_acpm+fecha_correccion+riesgo_acpm+justificacion_riesgo);
	if(origen_acpm=="" || fuente_acpm==""  ){
		Swal.fire(
			'Atención',
			'Debes diligenciar todos los campos para poder continuar',
			'error'
			)
	}else{
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
					'origen_acpm':origen_acpm,
					'fuente_acpm':fuente_acpm,
					'descripcion_fuente':descripcion_fuente,
					'tipo_acpm':tipo_acpm,
					'descripcion_acpm':descripcion_acpm,
					'causa_acpm':causa_acpm,
					'nc_similar':nc_similar,
					'descripcion_nsc':descripcion_nsc,
					'correccion_acpm':correccion_acpm,
					'fecha_correccion':fecha_correccion,
					'riesgo_acpm':riesgo_acpm,
					'justificacion_riesgo':justificacion_riesgo,
					'fecha_finalizacion':fecha_finalizacion,
					'id_usuario_fk':id_usuario_fk
				}
				$.ajax({
					type:"POST",
					data:json,
					url:'php/insertar_acpm.php',    
					success: function (resultacpm) {
						if(resultacpm=="1"){
							Swal.fire(
								'Buen Trabajo',
								'Se registro la ACPM con exito',
								'success'
								)
						$("#acpm").load(location.href + " #acpm");
						}else{
								Swal.fire(
								'Ups',
								'No se registro la ACPM',
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
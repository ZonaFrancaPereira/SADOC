$(document).ready(iniciar);

function iniciar() {

	$("#registro_User").hide();

	$("#mostrar_registro").on("click", mostrar_form_registro);
	
}
function mostrar_form_registro(){ 

	$("#user").val("");
	$("#pass").val("");

	$("#registro_User").show();  
	$("#caja_login").hide();

	$("#cancelar_registro").on("click", cancelar_form_registro);
}
function cancelar_form_registro(){ 

	$("#new_nombre").val("");
	$("#new_apellido").val("");
	$("#new_correo").val("");
	$("#new_contrasena").val("");

	$("#registro_User").hide();  
	$("#caja_login").show();
}
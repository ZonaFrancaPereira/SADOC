$(document).ready(iniciar_ordenes);
function iniciar_ordenes(){
    $('button').on('click', function(){  
		console.log('Enviado!!');
	});
  $(".aprobar").on("click", aprobar);
}
function aprobar(){
    alert("dd");
}
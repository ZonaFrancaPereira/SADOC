$(document).ready(iniciar_ordenes);
function iniciar_ordenes() {
  $('.eliminar-proveedor').on('click', eliminar_proveedor);
}

function eliminar_proveedor() {
  var id_proveedor = $(this).data('id_proveedor');
  
  // Realiza una solicitud AJAX para eliminar el proveedor
  $.ajax({
    url: 'php/eliminar_proveedor.php', // Coloca la URL correcta de tu script PHP para eliminar proveedor
    type: 'POST',
    data: { 'id_proveedor': id_proveedor },
    success: function (response) {
      // Si la eliminación fue exitosa, actualiza la tabla
      if (response === 'success') {
       // Muestra la notificación de éxito
       Swal.fire({
        title: 'Buen Trabajo',
        text: 'Se elimino el proveedor con éxito',
        icon: 'success',
      }).then((result) => {
        // Redirige a la página después de cerrar el SweetAlert
        if (result.isConfirmed) {
          window.location.href = 'ordenes.php';
        }
      });
       
      } else {
        console.log('Error al eliminar el proveedor');
      }
    },
    error: function (xhr, status, error) {
      console.log('Error en la solicitud AJAX:', error);
    }
  });
}

<?php
session_start();
if ($_SESSION['ingreso'] == true) {
  require('php/conexion.php');
  require('plantilla.php');
  $id_acpm = $_GET['id_acpm'];
  $descripcion = $_GET['descripcion'];
  $id_actividad = 0;
?>
  <footer>
    <small class="bg-teal">SADOC 3.0 &copy; Copyright 2022, ZFIP SAS</small>
  </footer>
  <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
  </aside>
<?php
  //require('include/footer.php');

} else {
  session_unset();
  session_destroy();
  header('location: index.php');
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div id="wrapper" class="toggled">
    <div id="page-content-wrapper">
      <div class="container-fluid">
        <div class="tab-content card">
          <!-- DIV DONDE SE MUESTRA TODA LA INFORMACION DE INTERES DE LAS ACPM PARA CADA USUARIO -->
          <div class="tab-pane  show active" id="panelc">
            <div id="" class="tab-pane">
              <div class="card" class="">
                <div class="col-md-12">
                  <div class="card bg-primary collapsed-card">
                    <div class="card-header">
                      <h3 class="card-title col-md-10">ID ACPM: <?php echo $id_acpm ?> </h3>


                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                      </div>
                      <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      DESCRIPCION ACPM: <?php echo $descripcion ?>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead class="bg-info">
                      <tr>
                        <th>#</th>
                        <th>Descripción de la actividad</th>
                        <th>Responsable</th>
                        <th>Fecha Vencimiento</th>
                        <th>Estado</th>
                        <th>Subir evidencia</th>
                        <th>Visualizar Evidencias</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $id_usuario = $_SESSION['Id'];
                      foreach ($conn->query("SELECT * 
                      FROM actividades_acpm a 
                      INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario 
                      WHERE a.id_usuario_fk = $id_usuario;") as $row) { {
                          $id_actividad = $row['id_actividad'];
                          $estado_actividad = $row["estado_actividad"];

                      ?>
                          <tr style=text-align:center>
                            <td><?php echo $row["id_actividad"] ?></td>
                            <td><?php echo $row["descripcion_actividad"] ?></td>
                            <td><?php echo $row["nombre_usuario"] . " " . $row["apellidos_usuario"] ?></td>
                            <td><?php echo $row["fecha_actividad"] ?></td>
                            <td><?php echo $row["estado_actividad"] ?></td>
                            <td><button type="button" class="btn bg-info" data-toggle="modal" data-target="#modal-success" data-id_actividad="<?php echo $row['id_actividad'] ?>"><i class="fas fa-folder-plus"></i></button></td>
                            <td><button type="button" class="btn bg-info" data-toggle="modal" data-target="#modal-evidencia" data-id_actividad="<?php echo $row['id_actividad'] ?>"><i class="fas fa-eye"></i></button></td>
                          </tr>
                      <?php }
                      } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Id actividad</th>
                        <th>Descripción de la actividad</th>
                        <th>Nombre del responsable</th>
                        <th>Fecha de la actividad</th>
                        <th>Estado actividad</th>
                        <th>Subir evidencia</th>
                        <th>Visualizar Evidencias</th>
                      </tr>
                    </tfoot>
                  </table>

                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
        <?php
        // Utiliza sentencias preparadas para evitar inyección de SQL
        $stmt = $conn->prepare("
                UPDATE actividades_acpm
                SET estado_actividad = 'Completa'
                WHERE id_actividad = :id_actividad
                AND EXISTS (
                    SELECT 1
                    FROM detalle_actividad
                    WHERE id_actividad_fk = :id_actividad
                )
            ");
        // Asigna valores a los parámetros
        $stmt->bindParam(':id_actividad', $id_actividad, PDO::PARAM_INT);

        // Ejecuta la consulta preparada
        $stmt->execute();
        ?>

        <!-- MODAL PARA SUBIR EVIDENCIA -->
        <section class="content">
          <div class="modal fade" id="modal-success">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header btn btn-success btn-block">
                  <h4 class="modal-title ">SUBIR EVIDENCIA ACTIVIDAD </h4>
                </div>
                <div class="modal-body">
                  <form id="" method="POST">
                    <div class="card card-navy">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-12 col-xs-12 col-sm-12">
                            <label for="fecha_evidencia">Fecha Actividad</label>
                            <input type="date" name="fecha_evidencia" class="form-control" id="fecha_evidencia" required>
                          </div>
                          <div class="col-md-12 col-xs-12 col-sm-12">
                            <br>
                            <textarea class="editor" id="evidencia" name="evidencia" style="display: none;"></textarea>
                            <!-- Contenedor para el contenido de Quill -->
                            <div class="quill-content"></div>
                            <!-- Create the editor container -->
                          </div>
                          <!-- /.SUBIR EVIDENCIAS -->
                          <!-- /.card-header -->
                          <div class="col-md-12 col-xs-12 col-sm-12">
                            <br><br><br><label>Recursos</label>
                            <select class="form-control" id="recursos" name="recursos" required>
                              <option>Selecciona una Opcion</option>
                              <option value="Humanos">Humanos</option>
                              <option value="Tecnologicos">Tecnologicos</option>
                            </select>
                          </div>
                          <!-- /.content -->

                          <div class="col-md-12 col-xs-12 col-sm-12">
                            <br>
                            <div class="form-group">
                              <label>Numero de la Actividad</label>
                              <input type="number" id="id_actividad" class="form-control" readonly>
                            </div>
                            <!-- /.form-group -->
                          </div>
                          <!-- /.SUBIR EVIDENCIAS -->
                          <div class="col-md-6 col-xs-6 col-sm-6" hidden>
                            <label>Id Usuario</label>
                            <input type="hidden" name="id_usuario_e_fk" id="id_usuario_e_fk" value="<?php echo $_SESSION['Id'] ?>" class="form-control" readonly>
                          </div>
                          <div class="col-md-12 col-xs-12 col-sm-12">
                            <button type="button" class="btn btn-success btn-block" id="subir_evidencia" name="subir_evidencia">SUBIR EVIDENCIA</button>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                        <!-- /.card-body -->
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </section>
        <!-- /.CIERRE DE MODAL -->
        <!-- MODAL PARA VISUALIZAR LA EVIDENCIA -->
        <section class="content">
          <div class="modal fade" id="modal-evidencia">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">

                <div class="modal-body">
                  <div id="div_detalle">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- /.CIERRE DE MODAL -->
      </div>
    </div>

  </div>

</div>

<?php require('footer.php'); ?>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

</div>

<style>
  .ql-toolbar {
    background-color: white;
    /* Cambiar el color de fondo de la barra de herramientas */
    color: white;
    /* Cambiar el color del texto en la barra de herramientas */
  }
</style>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Page specific script -->

<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('.select2').select2()

  });

  $('#modal-success').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id_actividad = button.data('id_actividad'); // Extract info from data-* attributes
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);

    modal.find('.modal-body #id_actividad').val(id_actividad);

  });

  $('#modal-evidencia').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id_actividad = button.data('id_actividad'); // Extract info from data-* attributes
    var modal = $(this);
    var json = {
      'id_actividad': id_actividad

    }
    $.ajax({
      type: "POST",
      data: json,
      url: 'php/consultar_detallea.php',
      success: function(data) {
        modal.find('.modal-body #div_detalle').html(data);
      }
    });
  });

  // Obtener el elemento enviar_sig por su ID
  var enviar_sig = document.getElementById("enviar_sig");

  // Obtener el estado de la actividad desde el atributo de datos
  var estado_actividad = enviar_sig.dataset.estado;
  var id_acpm_fk = enviar_sig.dataset.id_acpm;

  // Verificar el estado y deshabilitar el botón si es "Incompleta"
  if (estado_actividad === 'Incompleta') {
    enviar_sig.disabled = true;
  }

  // Agregar un event listener para ejecutar la función cuando el botón se hace clic
  enviar_sig.addEventListener("click", function() {
    // Verificar si la actividad está completa
    if (estado_actividad === 'Completa') {
      // Si está completa, realizar la acción deseada (enviar a SIG, en este caso)
      enviarASIG(id_acpm_fk);
    } else {
      // Si no está completa, mostrar un mensaje o realizar otra acción
      alert("La actividad está incompleta. No se puede enviar a SIG.");
    }
  });

  // Función para simular el envío a SIG
  function enviarASIG(id_acpm_fk) {

    
    const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger'
			},
			buttonsStyling: false
		})

		swalWithBootstrapButtons.fire({
			title: '¿Estas segur@ que quieres enviar esto a revision por SIG?',
			text: "Recuerda que una vez enviada quedara a disposición de SIG para desmontarla.",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Si, Enviar',
			cancelButtonText: 'No, Cancelar!',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
        var id_acpm = id_acpm_fk;
    alert(id_acpm);
        var json = {
					'id_acpm': id_acpm
				}
				$.ajax({
					type: "POST",
					data: json,
					url: 'php/estado_acpm.php',
					success: function (resultactividad){
						Swal.fire({
							title: 'Buen Trabajo',
							text: 'Se envio correctamente la ACPM a SIG',
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
</script>

</body>

</html>
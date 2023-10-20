<?php
session_start();
if ($_SESSION['ingreso'] == true) {
  require('php/conexion.php');
  require('plantilla.php');
  $id_acpm = $_GET['id_acpm'];
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
            <div id="actividades_abiertas" class="tab-pane">
              <div class="card" class="">
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Id actividad</th>
                        <th>Id acpm</th>
                        <th>descripcion de la actividad</th>
                        <th>nombre del responsable</th>
                        <th>fecha de la actividad</th>
                        <th>estado actividad</th>
                        <th>Subir evidencia</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($conn->query("SELECT * from actividades_acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario WHERE id_acpm_fk = $id_acpm") as $row) { { ?>
                          <tr style=text-align:center>
                            <td><?php echo $row["id_actividad"] ?></td>
                            <td><?php echo $row["id_acpm_fk"] ?></td>
                            <td><?php echo $row["descripcion_actividad"] ?></td>
                            <td><?php echo $row["nombre_usuario"] . " " . $row["apellidos_usuario"] ?></td>
                            <td><?php echo $row["fecha_actividad"] ?></td>
                            <td><?php echo $row["estado_actividad"] ?></td>
                            <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success" data-id_actividad="<?php echo $row['id_actividad'] ?>">Subir Evidencia</button></td>
                          </tr>
                      <?php }
                      } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Id actividad</th>
                        <th>Id acpm</th>
                        <th>descripcion de la actividad</th>
                        <th>nombre del responsable</th>
                        <th>fecha de la activida</th>
                        <th>estado actividad</th>
                        <th>subir evidencia</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- Main content -->
          <section class="content">
            <div class="modal fade" id="modal-success">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header btn btn-success btn-block">
                    <h4 class="modal-title ">SUBIR EVIDENCIA</h4>
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
                              <label></label>
                              <textarea id="evidencia" name="evidencia" class="textarea" required>
                              </textarea>
                            </div>
                            <!-- /.SUBIR EVIDENCIAS -->
                            <!-- /.card-header -->
                            <div class="col-md-12 col-xs-12 col-sm-12">
                              <label>Recursos</label>
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
                              <input type="text" name="id_usuario_e_fk" id="id_usuario_e_fk" value="<?php echo $_SESSION['Id'] ?>" class="form-control" readonly>
                            </div>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                              <button type="button" class="btn btn-success btn-block" id="subir_evidencia" name="subir_evidencia">Asignar Actividad</button>
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
        </div>
      </div>
    </div>
  </div>
</div>
<?php require('footer.php'); ?>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>

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
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });

    $('.select2').select2()

  });

  $('#modal-success').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id_actividad = button.data('id_actividad'); // Extract info from data-* attributes

    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);

    modal.find('.modal-body #id_actividad').val(id_actividad);


  });
</script>

</body>

</html>
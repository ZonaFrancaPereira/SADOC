<?php
session_start();
if ($_SESSION['ingreso']==true) {
 require('php/conexion.php');
 require('plantilla.php');
 ?>
<footer >
  <small class="bg-teal">SADOC 3.0 &copy; Copyright 2022, ZFIP SAS</small>
</footer>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
<?php
  //require('include/footer.php');

}else{
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
          <div  class="tab-pane  show active" id="panelc">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

            <div id="actividades_abiertas" class="tab-pane">
        <div class="card" class="">
              <div class="card-header">
                <h3 class="card-title">actividades</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>#</th>
                    <th>descripcion de la actividad</th>
                    <th>nombre del responsable</th>
                    <th>fecha de la actividad</th>
                    <th>Subior evidencia</th>
                  </tr>
                  </thead>
                  <tbody>
                      <tr style=text-align:center>
                        <td></td>
                        <td>actividades</td>
                        <td>actividades</td>
                        <td>actividades</td>
                        <td><button type="button" data-toggle="tab" class="btn btn-success" id="subir" name="subir"  href="#subir_actividades">Subir Evidencia</button></td>
                      </tr>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>descripcion de la actividad</th>
                    <th>nombre del responsable</th>
                    <th>fecha de la activida</th>
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

                <!-- /.SUBIR EVIDENCIAS -->

                <div id="subir_actividades" class="tab-pane">
                    <!-- Main content -->
                    <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                            <h3 class="card-title">
                                Summernote
                            </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            <textarea id="summernote">
                                Place <em>some</em> <u>text</u> <strong>here</strong>
                            </textarea>
                            </div>
                        </div>
                        </div>
                        <!-- /.col-->
                    </div>
                    <!-- ./row -->
                    </section>

                </div>
                  <!-- /.SUBIR EVIDENCIAS -->
        </div>
        </div>
        </div>
      </div>
    </div>
    <?php  require('footer.php'); ?>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- CodeMirror -->
<script src="../../plugins/codemirror/codemirror.js"></script>
<script src="../../plugins/codemirror/mode/css/css.js"></script>
<script src="../../plugins/codemirror/mode/xml/xml.js"></script>
<script src="../../plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
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
  })
</script>

</body>
</html>

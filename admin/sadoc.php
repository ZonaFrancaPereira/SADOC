<?php
session_start();
if ($_SESSION['ingreso'] == true) {
  require('php/conexion.php');
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>SADOC Gestor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Shortcut Icon" href="favicon.ico" type="image/x-icon" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/sweetalert2/6.4.1/sweetalert2.css" rel="stylesheet" />
    <!-- jQuery -->
    <script src="dist/js/jquery-3.2.1.js"></script>
    <!-- AdminLTE for demo purposes -->

    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.jsdelivr.net/sweetalert2/6.4.1/sweetalert2.js"></script>
    <script src="dist/js/document.js"></script>
    
    <script>
      $(document).ready(function() {
        $('.display').DataTable({
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
          },
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
          "order": [
            [1, "asc"]
          ]
        });

      });
    </script>

    <script>
      $(document).ready(function() {
        $('#table_id').DataTable({
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
          },
          "order": [
            [1, "asc"]
          ]
        });
      });
    </script>


  </head>

  <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <!-- Navbar PARA CERRAR SESION Y AÑADIR OPCIONES DENTRO DEL SISTEMA -->
    <nav class="main-header navbar navbar-expand navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="accesor.php" class="nav-link" target="_blank">Acceso Rapido</a>
        </li>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">

            <i class="fas fa-cogs"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <i class="dropdown-item dropdown-header">Opciones</i>
            <div class="dropdown-divider"></div>
            <a href="close.php" class="dropdown-item">
              <i class="fas fa-sign-in-alt mr-2"></i> Cerrar Sesion

            </a>
            <div class="dropdown-divider"></div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>

      </ul>
    </nav>
    <!-- Main Sidebar Container -->

    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed;">
      <!-- Brand Logo -->
      <a href="sadoc.php" class="brand-link">
        <img src="img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SADOC ZFIP</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

          <div class="info text-center">
            <B>
              <a href="#" class="d-block "><?php echo $_SESSION['nombre_usuario']; ?></a>
            </B>
          </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item En_linea 1" role="presentation">
              <a href="#accesoRapido" class="nav-link " data-toggle="tab">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Acceso Rapido

                </p>
              </a>
            </li>
            <li class="nav-item En_linea 1" role="presentation">
              <a data-toggle="tab" href="#menu10" class="nav-link">
                <i class="nav-icon fas fa-user-tie"></i>
                <p>
                  Gerencia
                </p>
              </a>
            </li>
            <li class="nav-item En_linea 12" role="presentation">
              <a data-toggle="tab" href="#menu12" class="nav-link">
                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                <p>
                  Planeacion Estrategica
                </p>
              </a>
            </li>
            <!-- SIG LISTA LA INTERFAZ -->
            <li class="nav-item En_linea 1" role="presentation">
              <a data-toggle="tab" href="#menu1" class="nav-link">
                <i class="nav-icon fas fa-poll"></i>
                <p>
                  SIG
                </p>
              </a>
            </li>
            <li class="nav-item En_linea 9" role="presentation">
              <a data-toggle="tab" href="#menu9" class="nav-link">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>SST</p>
              </a>
            </li>
            <li class="nav-item En_linea 2" role="presentation">
              <a data-toggle="tab" href="#menu2" class="nav-link">
                <i class="nav-icon fas fa-laptop-code"></i>
                <p>
                  Gestion T.I
                </p>
              </a>
            </li>
            <li class="nav-item En_linea 3" role="presentation">
              <a data-toggle="tab" href="#menu3" class="nav-link">
                <i class="nav-icon fas fa-hand-holding-usd"></i>
                <p>Gestión Contable y Financiera</p>
              </a>
            </li>

            <li class="nav-item En_linea 4" role="presentation">
              <a data-toggle="tab" href="#menu4" class="nav-link">
                <i class="nav-icon fas fa-wrench"></i>
                <p>Gestión Técnica</p>
              </a>
            </li>

            <li class="nav-item En_linea 5" role="presentation">
              <a data-toggle="tab" href="#menu5" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Gestión Administrativa</p>
              </a>
            </li>
            <li class="nav-item En_linea 6" role="presentation">
              <a data-toggle="tab" href="#menu6" class="nav-link">
                <i class="nav-icon fas fa-folder-open"></i>
                <p>Gestión Documental</p>
              </a>
            </li>
            <li class="nav-item En_linea 7" role="presentation">
              <a data-toggle="tab" href="#menu7" class="nav-link">
                <i class="nav-icon fas fa-people-carry"></i>
                <p>Gestión Operaciones</p>
              </a>
            </li>
            <li class="nav-item En_linea 8" role="presentation">
              <a data-toggle="tab" href="#menuJR" class="nav-link">
                <i class="nav-icon fas fa-gavel"></i>
                <p>Gestión Jurídica </p>
              </a>
            </li>
            <li class="nav-item En_linea 8" role="presentation">
              <a data-toggle="tab" href="#menu8" class="nav-link">
                <i class="nav-icon fas fa-shield-alt"></i>
                <p>Seguridad </p>
              </a>
            </li>


          </ul>

        </nav>
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
  <div class="content-wrapper">
    <div id="wrapper" class="toggled">

      <div id="page-content-wrapper">
        <div class="container-fluid">
          <div class="tab-content card">
            <!-- DESPLIEGUE DE INFORMACION ACEESO RAPIDO ARCHIVOS Y RUTAS -->
            <div id="accesoRapido" class="tab-pane fade">


              <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12">
                      <br>
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Busqueda General de Archivos</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <div class="card">
                            <div class="card-header p-2">
                              <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#gerencia" data-toggle="tab">Gerencia</a></li>
                                <li class="nav-item"><a class="nav-link" href="#planeacion" data-toggle="tab">Planeacion Estrategica</a></li>
                                <li class="nav-item"><a class="nav-link" href="#sig" data-toggle="tab">SIG</a></li>
                                <li class="nav-item"><a class="nav-link" href="#ti" data-toggle="tab"> Gestión T.I</a></li>
                                <li class="nav-item"><a class="nav-link" href="#contabilidad" data-toggle="tab">Gestión Contable y Financiera</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tecnica" data-toggle="tab">Gestión Técnica</a></li>
                                <li class="nav-item"><a class="nav-link" href="#gh" data-toggle="tab">Gestión Administrativa</a></li>
                                <li class="nav-item"><a class="nav-link" href="#documental" data-toggle="tab">Gestión Documental</a></li>
                                <li class="nav-item"><a class="nav-link" href="#op" data-toggle="tab">Gestión de Operaciones</a></li>
                                <li class="nav-item"><a class="nav-link" href="#ph" data-toggle="tab">Seguridad</a></li>
                                <li class="nav-item"><a class="nav-link" href="#sst" data-toggle="tab">SST</a></li>
                              </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                              <div class="tab-content">

                                <div class="active tab-pane" id="gerencia">
                                  <table id="" class="display col-12">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Nombre del Archivo</th>
                                        <th>Fecha de Actualización</th>
                                        <th>Ruta</th>
                                        <th>Opciones</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      try {
                                        $stmt = $conn->prepare('SELECT * FROM  sadoc WHERE id_proceso_fk="10" and estado = "activo" ');
                                        $stmt->execute();
                                        $registros = 1;
                                        if ($stmt->rowCount() > 0) {

                                          while ($row = $stmt->fetch()) {
                                            $nombre = basename($row["ruta"]);
                                            $previo = $row["ruta"];
                                            $id = $row["id"];

                                            echo "<tr class='sobras'>";
                                            echo "<td >" . $registros . "</td>";
                                            echo "<td >" . $nombre . "</td>";
                                            echo "<td>" . $row["Fecha_Subida"] . "</td>";
                                            echo "<td>" . $row["ruta"] . "</td>";
                                            echo "<td>";
                                            echo '<a href="php/descarga_Archivos.php?archivo=' . $nombre . '&ruta=' . $previo . '" target="_blank" ><button class="btn bg-navy">Vista Previa  <span class="fa fa-eye" aria-hidden="true"></span></button></a>';
                                            echo "</td>";
                                            echo "</tr>";
                                            $registros++;
                                          }
                                        }
                                      } catch (PDOException $e) {
                                        echo "Error en el servidor";
                                      } ?>


                                    </tbody>
                                  </table>
                                </div>

                                <div class="tab-pane" id="planeacion">
                                  <table id="" class="display col-12">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Nombre del Archivo</th>
                                        <th>Fecha de Actualización</th>
                                        <th>Ruta</th>
                                        <th>Opciones</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      try {
                                        $stmt = $conn->prepare('SELECT * FROM  sadoc WHERE id_proceso_fk="21" and estado = "activo" ');
                                        $stmt->execute();
                                        $registros = 1;
                                        if ($stmt->rowCount() > 0) {

                                          while ($row = $stmt->fetch()) {
                                            $nombre = basename($row["ruta"]);
                                            $previo = $row["ruta"];
                                            $id = $row["id"];

                                            echo "<tr class='sobras'>";
                                            echo "<td >" . $registros . "</td>";
                                            echo "<td >" . $nombre . "</td>";
                                            echo "<td>" . $row["Fecha_Subida"] . "</td>";
                                            echo "<td>" . $row["ruta"] . "</td>";
                                            echo "<td>";
                                            echo '<a href="php/descarga_Archivos.php?archivo=' . $nombre . '&ruta=' . $previo . '" target="_blank" ><button class="btn bg-navy">Vista Previa  <span class="fa fa-eye" aria-hidden="true"></span></button></a>';
                                            echo "</td>";
                                            echo "</tr>";
                                            $registros++;
                                          }
                                        }
                                      } catch (PDOException $e) {
                                        echo "Error en el servidor";
                                      } ?>


                                    </tbody>
                                  </table>
                                </div>
                                <div class="tab-pane" id="sig">
                                  <table id="" class="display col-12">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Nombre del Archivo</th>
                                        <th>Fecha de Actualización</th>
                                        <th>Ruta</th>
                                        <th>Opciones</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      try {
                                        $stmt = $conn->prepare('SELECT * FROM  sadoc WHERE id_proceso_fk="1" and estado = "activo" ');
                                        $stmt->execute();
                                        $registros = 1;
                                        if ($stmt->rowCount() > 0) {

                                          while ($row = $stmt->fetch()) {
                                            $nombre = basename($row["ruta"]);
                                            $previo = $row["ruta"];
                                            $id = $row["id"];

                                            echo "<tr class='sobras'>";
                                            echo "<td >" . $registros . "</td>";
                                            echo "<td >" . $nombre . "</td>";
                                            echo "<td>" . $row["Fecha_Subida"] . "</td>";
                                            echo "<td>" . $row["ruta"] . "</td>";
                                            echo "<td>";
                                            echo '<a href="php/descarga_Archivos.php?archivo=' . $nombre . '&ruta=' . $previo . '" target="_blank" ><button class="btn bg-navy">Vista Previa  <span class="fa fa-eye" aria-hidden="true"></span></button></a>';
                                            echo "</td>";
                                            echo "</tr>";
                                            $registros++;
                                          }
                                        }
                                      } catch (PDOException $e) {
                                        echo "Error en el servidor";
                                      } ?>


                                    </tbody>
                                  </table>
                                </div>
                                <div class="tab-pane" id="ti">
                                  <table id="" class="display col-12">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Nombre del Archivo</th>
                                        <th>Fecha de Actualización</th>
                                        <th>Ruta</th>
                                        <th>Opciones</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      try {
                                        $stmt = $conn->prepare('SELECT * FROM  sadoc WHERE id_proceso_fk="2" and estado = "activo" ');
                                        $stmt->execute();
                                        $registros = 1;
                                        if ($stmt->rowCount() > 0) {

                                          while ($row = $stmt->fetch()) {
                                            $nombre = basename($row["ruta"]);
                                            $previo = $row["ruta"];
                                            $id = $row["id"];

                                            echo "<tr class='sobras'>";
                                            echo "<td >" . $registros . "</td>";
                                            echo "<td >" . $nombre . "</td>";
                                            echo "<td>" . $row["Fecha_Subida"] . "</td>";
                                            echo "<td>" . $row["ruta"] . "</td>";
                                            echo "<td>";
                                            echo '<a href="php/descarga_Archivos.php?archivo=' . $nombre . '&ruta=' . $previo . '" target="_blank" ><button class="btn bg-navy">Vista Previa  <span class="fa fa-eye" aria-hidden="true"></span></button></a>';
                                            echo "</td>";
                                            echo "</tr>";
                                            $registros++;
                                          }
                                        }
                                      } catch (PDOException $e) {
                                        echo "Error en el servidor";
                                      } ?>


                                    </tbody>
                                  </table>
                                </div>
                                <div class="tab-pane" id="contabilidad">
                                  <table id="" class="display col-12">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Nombre del Archivo</th>
                                        <th>Fecha de Actualización</th>
                                        <th>Ruta</th>
                                        <th>Opciones</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      try {
                                        $stmt = $conn->prepare('SELECT * FROM  sadoc WHERE id_proceso_fk="3" and estado = "activo" ');
                                        $stmt->execute();
                                        $registros = 1;
                                        if ($stmt->rowCount() > 0) {

                                          while ($row = $stmt->fetch()) {
                                            $nombre = basename($row["ruta"]);
                                            $previo = $row["ruta"];
                                            $id = $row["id"];

                                            echo "<tr class='sobras'>";
                                            echo "<td >" . $registros . "</td>";
                                            echo "<td >" . $nombre . "</td>";
                                            echo "<td>" . $row["Fecha_Subida"] . "</td>";
                                            echo "<td>" . $row["ruta"] . "</td>";
                                            echo "<td>";
                                            echo '<a href="php/descarga_Archivos.php?archivo=' . $nombre . '&ruta=' . $previo . '" target="_blank" ><button class="btn bg-navy">Vista Previa  <span class="fa fa-eye" aria-hidden="true"></span></button></a>';
                                            echo "</td>";
                                            echo "</tr>";
                                            $registros++;
                                          }
                                        }
                                      } catch (PDOException $e) {
                                        echo "Error en el servidor";
                                      } ?>


                                    </tbody>
                                  </table>
                                </div>
                                <div class="tab-pane" id="tecnica">
                                  <table id="" class="display col-12">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Nombre del Archivo</th>
                                        <th>Fecha de Actualización</th>
                                        <th>Ruta</th>
                                        <th>Opciones</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      try {
                                        $stmt = $conn->prepare('SELECT * FROM  sadoc WHERE id_proceso_fk="4" and estado = "activo" ');
                                        $stmt->execute();
                                        $registros = 1;
                                        if ($stmt->rowCount() > 0) {

                                          while ($row = $stmt->fetch()) {
                                            $nombre = basename($row["ruta"]);
                                            $previo = $row["ruta"];
                                            $id = $row["id"];

                                            echo "<tr class='sobras'>";
                                            echo "<td >" . $registros . "</td>";
                                            echo "<td >" . $nombre . "</td>";
                                            echo "<td>" . $row["Fecha_Subida"] . "</td>";
                                            echo "<td>" . $row["ruta"] . "</td>";
                                            echo "<td>";
                                            echo '<a href="php/descarga_Archivos.php?archivo=' . $nombre . '&ruta=' . $previo . '" target="_blank" ><button class="btn bg-navy">Vista Previa  <span class="fa fa-eye" aria-hidden="true"></span></button></a>';
                                            echo "</td>";
                                            echo "</tr>";
                                            $registros++;
                                          }
                                        }
                                      } catch (PDOException $e) {
                                        echo "Error en el servidor";
                                      }
                                      ?>


                                    </tbody>
                                  </table>
                                </div>
                                <div class="tab-pane" id="gh">
                                  <table id="" class="display col-12">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Nombre del Archivo</th>
                                        <th>Fecha de Actualización</th>
                                        <th>Ruta</th>
                                        <th>Opciones</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      try {
                                        $stmt = $conn->prepare('SELECT * FROM  sadoc WHERE id_proceso_fk="5" and estado = "activo" ');
                                        $stmt->execute();
                                        $registros = 1;
                                        if ($stmt->rowCount() > 0) {

                                          while ($row = $stmt->fetch()) {
                                            $nombre = basename($row["ruta"]);
                                            $previo = $row["ruta"];
                                            $id = $row["id"];

                                            echo "<tr class='sobras'>";
                                            echo "<td >" . $registros . "</td>";
                                            echo "<td >" . $nombre . "</td>";
                                            echo "<td>" . $row["Fecha_Subida"] . "</td>";
                                            echo "<td>" . $row["ruta"] . "</td>";
                                            echo "<td>";
                                            echo '<a href="php/descarga_Archivos.php?archivo=' . $nombre . '&ruta=' . $previo . '" target="_blank" ><button class="btn bg-navy">Vista Previa  <span class="fa fa-eye" aria-hidden="true"></span></button></a>';
                                            echo "</td>";
                                            echo "</tr>";
                                            $registros++;
                                          }
                                        }
                                      } catch (PDOException $e) {
                                        echo "Error en el servidor";
                                      } ?>


                                    </tbody>
                                  </table>
                                </div>
                                <div class="tab-pane" id="documental">
                                  <table id="" class="display col-12">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Nombre del Archivo</th>
                                        <th>Fecha de Actualización</th>
                                        <th>Ruta</th>
                                        <th>Opciones</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      try {
                                        $stmt = $conn->prepare('SELECT * FROM  sadoc WHERE id_proceso_fk="22" and estado = "activo" ');
                                        $stmt->execute();
                                        $registros = 1;
                                        if ($stmt->rowCount() > 0) {

                                          while ($row = $stmt->fetch()) {
                                            $nombre = basename($row["ruta"]);
                                            $previo = $row["ruta"];
                                            $id = $row["id"];

                                            echo "<tr class='sobras'>";
                                            echo "<td >" . $registros . "</td>";
                                            echo "<td >" . $nombre . "</td>";
                                            echo "<td>" . $row["Fecha_Subida"] . "</td>";
                                            echo "<td>" . $row["ruta"] . "</td>";
                                            echo "<td>";
                                            echo '<a href="php/descarga_Archivos.php?archivo=' . $nombre . '&ruta=' . $previo . '" target="_blank" ><button class="btn bg-navy">Vista Previa  <span class="fa fa-eye" aria-hidden="true"></span></button></a>';
                                            echo "</td>";
                                            echo "</tr>";
                                            $registros++;
                                          }
                                        }
                                      } catch (PDOException $e) {
                                        echo "Error en el servidor";
                                      } ?>


                                    </tbody>
                                  </table>
                                </div>
                                <div class="tab-pane" id="op">
                                  <table id="" class="display col-12">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Nombre del Archivo</th>
                                        <th>Fecha de Actualización</th>
                                        <th>Ruta</th>
                                        <th>Opciones</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      try {
                                        $stmt = $conn->prepare('SELECT * FROM  sadoc WHERE id_proceso_fk="7" and estado = "activo" ');
                                        $stmt->execute();
                                        $registros = 1;
                                        if ($stmt->rowCount() > 0) {

                                          while ($row = $stmt->fetch()) {
                                            $nombre = basename($row["ruta"]);
                                            $previo = $row["ruta"];
                                            $id = $row["id"];

                                            echo "<tr class='sobras'>";
                                            echo "<td >" . $registros . "</td>";
                                            echo "<td >" . $nombre . "</td>";
                                            echo "<td>" . $row["Fecha_Subida"] . "</td>";
                                            echo "<td>" . $row["ruta"] . "</td>";
                                            echo "<td>";
                                            echo '<a href="php/descarga_Archivos.php?archivo=' . $nombre . '&ruta=' . $previo . '" target="_blank" ><button class="btn bg-navy">Vista Previa  <span class="fa fa-eye" aria-hidden="true"></span></button></a>';
                                            echo "</td>";
                                            echo "</tr>";
                                            $registros++;
                                          }
                                        }
                                      } catch (PDOException $e) {
                                        echo "Error en el servidor";
                                      } ?>


                                    </tbody>
                                  </table>
                                </div>
                                <div class="tab-pane" id="ph">
                                  <table id="" class="display col-12">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Nombre del Archivo</th>
                                        <th>Fecha de Actualización</th>
                                        <th>Ruta</th>
                                        <th>Opciones</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      try {
                                        $stmt = $conn->prepare('SELECT * FROM  sadoc WHERE id_proceso_fk="8" and estado = "activo" ');
                                        $stmt->execute();
                                        $registros = 1;
                                        if ($stmt->rowCount() > 0) {

                                          while ($row = $stmt->fetch()) {
                                            $nombre = basename($row["ruta"]);
                                            $previo = $row["ruta"];
                                            $id = $row["id"];

                                            echo "<tr class='sobras'>";
                                            echo "<td >" . $registros . "</td>";
                                            echo "<td >" . $nombre . "</td>";
                                            echo "<td>" . $row["Fecha_Subida"] . "</td>";
                                            echo "<td>" . $row["ruta"] . "</td>";
                                            echo "<td>";
                                            echo '<a href="php/descarga_Archivos.php?archivo=' . $nombre . '&ruta=' . $previo . '" target="_blank" ><button class="btn bg-navy">Vista Previa  <span class="fa fa-eye" aria-hidden="true"></span></button></a>';
                                            echo "</td>";
                                            echo "</tr>";
                                            $registros++;
                                          }
                                        }
                                      } catch (PDOException $e) {
                                        echo "Error en el servidor";
                                      } ?>


                                    </tbody>
                                  </table>
                                </div>
                                <div class="tab-pane" id="sst">
                                  <table id="" class="display col-12">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Nombre del Archivo</th>
                                        <th>Fecha de Actualización</th>
                                        <th>Ruta</th>
                                        <th>Opciones</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      try {
                                        $stmt = $conn->prepare('SELECT * FROM  sadoc WHERE id_proceso_fk="9" and estado = "activo" ');
                                        $stmt->execute();
                                        $registros = 1;
                                        if ($stmt->rowCount() > 0) {

                                          while ($row = $stmt->fetch()) {
                                            $nombre = basename($row["ruta"]);
                                            $previo = $row["ruta"];
                                            $id = $row["id"];

                                            echo "<tr class='sobras'>";
                                            echo "<td >" . $registros . "</td>";
                                            echo "<td >" . $nombre . "</td>";
                                            echo "<td>" . $row["Fecha_Subida"] . "</td>";
                                            echo "<td>" . $row["ruta"] . "</td>";
                                            echo "<td>";
                                            echo '<a href="php/descarga_Archivos.php?archivo=' . $nombre . '&ruta=' . $previo . '" target="_blank" ><button class="btn bg-navy">Vista Previa  <span class="fa fa-eye" aria-hidden="true"></span></button></a>';
                                            echo "</td>";
                                            echo "</tr>";
                                            $registros++;
                                          }
                                        }
                                      } catch (PDOException $e) {
                                        echo "Error en el servidor";
                                      } ?>


                                    </tbody>
                                  </table>
                                </div>
                                <!-- /.tab-pane -->
                              </div>
                              <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                          </div>

                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->

                    </div>
                  </div>
                </div>
            </div>
            </section>
            <!-- Despliegue de información...#menu1 SIG TERMINADO -->


            <div id="menu1" class="tab-pane fade">
              <div id="sesion_SIG" class="bg-info">
                <div class="borde2 col-xs-12 col-sm-12 col-md-12 col-lg-12 ">

                  <div id="subida_archivo" class=" pt-3 pb-2">
                    <center>
                      <form class="form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12" action="#" name="upload" method="POST" enctype="multipart/form-data">
                        <h3>Adjuntar Archivos : </h3>
                        <div class="form-group mx-sm-3 mb-2">

                          <input type="file" name="archivo" class="form-control" required>
                          <input type="hidden" name="id_proceso_fk" value="1" id="archivo_sig" class="form-control" required>
                          <input type="hidden" name="proceso" value="SIG" id="proceso_sig" class="form-control" required>

                        </div>
                        <button type="submit" class="btn btn-success mb-2" name="subir">
                          <span class=' fa fa-upload' aria-hidden='true'></span>
                          Subir Archivo
                        </button>
                      </form>
                    </center>
                    <?php
                    include_once("php/upload_sadoc.php");
                    ?>
                  </div>

                </div>
                <div id="archivos_SIG" class="borde3 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="include_SIG">
                    <?php
                    include_once("php/upload_sadoc_folder.php");
                    ?>
                  </div>
                </div>
                <hr>
                <legend></legend>
              </div>

              <div class="borde col-xs-12 col-sm-12 col-md-12 col-lg-12 panel panel-default">
                <div class="col-lg-1"></div>
                <div class="card-header text-center bg-success">
                  <h3><B>SIG - Descarga de Archivos :</B></h3>
                </div>
                <div style="margin-top: 10px;" class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                  <button type="submit" id="SIG" class="new_folder_SIG gly btn btn-primary btn-block col-lg-8">
                    <i class="fa fa-folder"></i>
                    Crear Carpeta
                  </button>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-6">
                    <table class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info text-center">#</th>
                          <th class="bg-info">
                            <h3><B>Carpetas</B></h3>
                          </th>
                          <th class="bg-info text-center">
                            <div id="panel">
                              <center>
                                <a id='volver_SIG'>
                                  <button class='volver_SIG btn btn-info'>
                                    <i class='fa fa-chevron-left'></i>
                                    Volver
                                  </button>
                                </a>

                                <a id='recargar_SIG'>
                                  <button class='volver_SIG btn btn-success'>
                                    <i class="fa fa-home"></i>
                                    Panel Principal
                                  </button>
                                </a>
                              </center>
                            </div>
                          </th>
                        </tr>
                      </thead>
                      <tbody id="folder_SIG">
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class=" informacion margen col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover ">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info">#</th>
                          <th class="bg-info">Nombre del Archivo</th>
                          <th class="bg-info">Fecha de Actualización</th>
                          <th class="bg-info text-center">Vista Previa</th>
                          <th class="bg-info text-center">X</th>
                        </tr>
                      </thead>
                      <tbody id="descargas_SIG">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>


            <!-- Despliegue de información...#menu2 -->

            <div id="menu2" class="tab-pane fade">
              <div id="sesion_TI" class="bg-info">
                <div class="borde2 col-xs-12 col-sm-12 col-md-12 col-lg-12 ">

                  <div id="subida_archivo_TI" class=" pt-3 pb-2">
                    <center>
                      <form class="form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12" action="#" name="upload" method="POST" enctype="multipart/form-data">
                        <h3>Adjuntar Archivos : </h3>
                        <div class="form-group mx-sm-3 mb-2">

                          <input type="file" name="archivo" id="archivo_TI" class="form-control" required>
                          <input type='hidden' value="2" name='id_proceso_fk'>
                        </div>
                        <button type="submit" class="btn btn-success mb-2" name="subir">
                          <span class=' fa fa-upload' aria-hidden='true'></span>
                          Subir Archivo
                        </button>
                      </form>
                    </center>
                    <?php
                    include_once("php/upload_sadoc.php");
                    ?>
                  </div>

                </div>
                <div id="archivos_TI" class="borde3 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="include_TI">
                    <?php
                    include_once("php/upload_sadoc_folder.php");
                    ?>
                  </div>
                </div>
                <hr>
                <legend></legend>
              </div>

              <div class="borde col-xs-12 col-sm-12 col-md-12 col-lg-12 panel panel-default">
                <div class="col-lg-1"></div>
                <div class="card-header text-center bg-success">
                  <h3><B>TI - Descarga de Archivos :</B></h3>
                </div>
                <div style="margin-top: 10px;" class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                  <button type="submit" id="TI" class="new_folder_TI gly btn btn-primary btn-block col-lg-8">
                    <i class="fa fa-folder"></i>
                    Crear Carpeta
                  </button>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-6">
                    <table class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info text-center">#</th>
                          <th class="bg-info"><B>Carpetas</B></th>
                          <th class="bg-info text-center">
                            <div id="panel_TI">
                              <center>
                                <a id='volver_TI'>
                                  <button class='volver_TI btn btn-info'>
                                    <i class='fa fa-chevron-left'></i>
                                    Volver
                                  </button>
                                </a>

                                <a id='recargar_TI'>
                                  <button class='volver_TI btn btn-success'>
                                    <i class="fa fa-home"></i>
                                    Panel Principal
                                  </button>
                                </a>
                              </center>
                            </div>
                          </th>
                        </tr>
                      </thead>
                      <tbody id="folder_TI">
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class=" informacion margen col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover ">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info">#</th>
                          <th class="bg-info">Nombre del Archivo</th>
                          <th class="bg-info">Fecha de Actualización</th>
                          <th class="bg-info text-center">Vista Previa</th>
                          <th class="bg-info text-center">X</th>
                        </tr>
                      </thead>
                      <tbody id="descargas_TI">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <!-- Despliegue de información...#menu4 -->
            <div id="menu3" class="tab-pane fade">
              <div id="sesion_CT" class="bg-info">
                <div class="borde2 col-xs-12 col-sm-12 col-md-12 col-lg-12 ">

                  <div id="subida_archivo_CT" class=" pt-3 pb-2">
                    <center>
                      <form class="form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12" action="#" name="upload" method="POST" enctype="multipart/form-data">
                        <h3>Adjuntar Archivos : </h3>
                        <div class="form-group mx-sm-3 mb-2">

                          <input type="file" name="archivo" class="form-control" required>
                          <input type="hidden" name="id_proceso_fk" value="3" id="archivo_ct" class="form-control" required>
                          <input type="hidden" name="proceso" value="conta" id="proceso_ct" class="form-control" required>

                        </div>
                        <button type="submit" class="btn btn-success mb-2" name="subir">
                          <span class=' fa fa-upload' aria-hidden='true'></span>
                          Subir Archivo
                        </button>
                      </form>
                    </center>
                    <?php include_once("php/upload_sadoc.php"); ?>
                  </div>
                </div>
                <div id="archivos_CT" class="borde3 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="include_CT">
                    <?php
                    include_once("php/upload_sadoc_folder.php");
                    ?>
                  </div>
                </div>
                <hr>
                <legend></legend>
              </div>

              <div class="borde col-xs-12 col-sm-12 col-md-12 col-lg-12 panel panel-default">

                <div class="card-header text-center bg-success">
                  <h3><B>Contabilidad - Descarga de Archivos : </B></h3>
                </div>
                <div style="margin-top: 10px;" class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                  <button type="submit" id="CT" class="new_folder_CT gly btn btn-primary btn-block col-lg-8">
                    <i class="fa fa-folder"></i>
                    Crear Carpeta
                  </button>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-6">
                    <table class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info text-center">#</th>
                          <th class="bg-info"><B>Carpetas</B></th>
                          <th class="bg-info text-center">
                            <div id="panel_CT">
                              <center>
                                <a id='volver_CT'>
                                  <button class='volver_CT btn btn-info'>
                                    <i class='fa fa-chevron-left'></i>
                                    Volver
                                  </button>
                                </a>

                                <a id='recargar_CT'>
                                  <button class='volve_CT btn btn-success'>
                                    <i class="fa fa-home"></i>
                                    Panel Principal
                                  </button>
                                </a>
                              </center>
                            </div>
                          </th>
                        </tr>
                      </thead>
                      <tbody id="folder_CT">
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class=" informacion margen col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover ">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info">#</th>
                          <th class="bg-info">Nombre del Archivo</th>
                          <th class="bg-info">Fecha de Actualización</th>
                          <th class="bg-info text-center">Vista Previa</th>
                          <th class="bg-info text-center">X</th>
                        </tr>
                      </thead>
                      <tbody id="descargas_CT">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- Despliegue de información...#menu4 -->
            <div id="menu4" class="tab-pane fade">
              <div id="sesion_TEC" class="bg-info">
                <div class="borde2 col-xs-12 col-sm-12 col-md-12 col-lg-12 ">

                  <div id="subida_archivo_TEC" class=" pt-3 pb-2">
                    <center>
                      <form class="form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12" action="#" name="upload" method="POST" enctype="multipart/form-data">
                        <h3>Adjuntar Archivos : </h3>
                        <div class="form-group mx-sm-3 mb-2">

                          <input type="file" name="archivo" class="form-control" required>
                          <input type="hidden" name="id_proceso_fk" value="4" class="form-control" required>
                          <input type="hidden" name="proceso" value="Tecnico" class="form-control" required>

                        </div>
                        <button type="submit" class="btn btn-success mb-2" name="subir">
                          <span class=' fa fa-upload' aria-hidden='true'></span>
                          Subir Archivo
                        </button>
                      </form>
                    </center>
                    <?php include_once("php/upload_sadoc.php"); ?>
                  </div>
                </div>
                <div id="archivos_TEC" class="borde3 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="include_TEC">
                    <?php
                    include_once("php/upload_sadoc_folder.php");
                    ?>
                  </div>
                </div>
                <hr>
                <legend></legend>
              </div>


              <div class="borde col-xs-12 col-sm-12 col-md-12 col-lg-12 panel panel-default">
                <div class="col-lg-1"></div>
                <div class="card-header text-center bg-success">
                  <h3><B>Técnico - Descarga de Archivos : </B></h3>
                </div>
                <div style="margin-top: 10px;" class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                  <button type="submit" id="TEC" class="new_folder_TEC gly btn btn-primary btn-block col-lg-8">
                    <i class="fa fa-folder"></i>
                    Crear Carpeta
                  </button>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-6">
                    <table class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info text-center">#</th>
                          <th class="bg-info"><B>Carpetas</B></th>
                          <th class="bg-info text-center">
                            <div id="panel_TEC">
                              <center>
                                <a id='volver_TEC'>
                                  <button class='volver_TEC btn btn-info'>
                                    <i class='fa fa-chevron-left'></i>
                                    Volver
                                  </button>
                                </a>

                                <a id='recargar_TEC'>
                                  <button class='volve_TEC btn btn-success'>
                                    <i class="fa fa-home"></i>
                                    Panel Principal
                                  </button>
                                </a>
                              </center>
                            </div>
                          </th>
                        </tr>
                      </thead>
                      <tbody id="folder_TEC">
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class=" informacion margen col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover ">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info">#</th>
                          <th class="bg-info">Nombre del Archivo</th>
                          <th class="bg-info">Fecha de Actualización</th>
                          <th class="bg-info text-center">Vista Previa</th>
                          <th class="bg-info text-center">X</th>
                        </tr>
                      </thead>
                      <tbody id="descargas_TEC">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>


            <!-- Despliegue de información...#menu5 -->

            <div id="menu5" class="tab-pane fade">
              <div id="sesion_GH" class="bg-info">
                <div class="borde2 col-xs-12 col-sm-12 col-md-12 col-lg-12 ">

                  <div id="subida_archivo_GH" class=" pt-3 pb-2">
                    <center>
                      <form class="form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12" action="#" name="upload" method="POST" enctype="multipart/form-data">
                        <h3>Adjuntar Archivos : </h3>
                        <div class="form-group mx-sm-3 mb-2">

                          <input type="file" name="archivo" class="form-control" required>
                          <input type="hidden" name="id_proceso_fk" value="5" class="form-control" required>
                          <input type="hidden" name="proceso" value="GH" class="form-control" required>

                        </div>
                        <button type="submit" class="btn btn-success mb-2" name="subir">
                          <span class=' fa fa-upload' aria-hidden='true'></span>
                          Subir Archivo
                        </button>
                      </form>
                    </center>
                    <?php include_once("php/upload_sadoc.php"); ?>
                  </div>
                </div>
                <div id="archivos_GH" class="borde3 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="include_GH">
                    <?php
                    include_once("php/upload_sadoc_folder.php");
                    ?>
                  </div>
                </div>
                <hr>
                <legend></legend>
              </div>


              <div class="borde col-xs-12 col-sm-12 col-md-12 col-lg-12 panel panel-default">
                <div class="col-lg-1"></div>
                <div class="card-header text-center bg-success">
                  <h3><B>Gestión Humana - Descarga de Archivos : </B></h3>
                </div>
                <div style="margin-top: 10px;" class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                  <button type="submit" id="GH" class="new_folder_GH gly btn btn-primary btn-block col-lg-8">
                    <i class="fa fa-folder"></i>
                    Crear Carpeta
                  </button>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-6">
                    <table class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info text-center">#</th>
                          <th class="bg-info"><B>Carpetas</B></th>
                          <th class="bg-info text-center">
                            <div id="panel_GH">
                              <center>
                                <a id='volver_GH'>
                                  <button class='volver_GH btn btn-info'>
                                    <i class='fa fa-chevron-left'></i>
                                    Volver
                                  </button>
                                </a>

                                <a id='recargar_GH'>
                                  <button class='volver_GH btn btn-success'>
                                    <i class="fa fa-home"></i>
                                    Panel Principal
                                  </button>
                                </a>
                              </center>
                            </div>
                          </th>
                        </tr>
                      </thead>
                      <tbody id="folder_GH">
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class=" informacion margen col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover ">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info">#</th>
                          <th class="bg-info">Nombre del Archivo</th>
                          <th class="bg-info">Fecha de Actualización</th>
                          <th class="bg-info text-center">Vista Previa</th>
                          <th class="bg-info text-center">X</th>
                        </tr>
                      </thead>
                      <tbody id="descargas_GH">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- Despliegue de información...#menu6 -->
            <div id="menu6" class="tab-pane fade">
              <div id="sesion_GD" class="bg-info">
                <div class="borde2 col-xs-12 col-sm-12 col-md-12 col-lg-12 ">

                  <div id="subida_archivo_GD" class=" pt-3 pb-2">
                    <center>
                      <form class="form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12" action="#" name="upload" method="POST" enctype="multipart/form-data">
                        <h3>Adjuntar Archivos : </h3>
                        <div class="form-group mx-sm-3 mb-2">

                          <input type="file" name="archivo" class="form-control" required>
                          <input type="hidden" name="id_proceso_fk" value="6" class="form-control" required>
                          <input type="hidden" name="proceso" value="GD" class="form-control" required>

                        </div>
                        <button type="submit" class="btn btn-success mb-2" name="subir">
                          <span class=' fa fa-upload' aria-hidden='true'></span>
                          Subir Archivo
                        </button>
                      </form>
                    </center>
                    <?php include_once("php/upload_sadoc.php"); ?>
                  </div>
                </div>
                <div id="archivos_GD" class="borde3 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="include_GD">
                    <?php
                    include_once("php/upload_sadoc_folder.php");
                    ?>
                  </div>
                </div>
                <hr>
                <legend></legend>
              </div>


              <div class="borde col-xs-12 col-sm-12 col-md-12 col-lg-12 panel panel-default">
                <div class="col-lg-1"></div>
                <div class="card-header text-center bg-success">
                  <h3><B>Gestión Documental - Descarga de Archivos : </B></h3>
                </div>
                <div style="margin-top: 10px;" class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                  <button type="submit" id="GD" class="new_folder_GD gly btn btn-primary btn-block col-lg-8">
                    <i class="fa fa-folder"></i>
                    Crear Carpeta
                  </button>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-6">
                    <table class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover">
                      <thead class="thead-light ">
                        <tr>
                          <th class="text-center bg-info">#</th>
                          <th class="bg-info"><B>Carpetas</B></th>
                          <th class="bg-info text-center">
                            <div id="panel_GD">
                              <center>
                                <a id='volver_GD'>
                                  <button class='volver_GD btn btn-info'>
                                    <i class='fa fa-chevron-left'></i>
                                    Volver
                                  </button>
                                </a>

                                <a id='recargar_GD'>
                                  <button class='volver_GD btn btn-success'>
                                    <i class="fa fa-home"></i>
                                    Panel Principal
                                  </button>
                                </a>
                              </center>
                            </div>
                          </th>
                        </tr>
                      </thead>
                      <tbody id="folder_GD">
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class=" informacion margen col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover ">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info">#</th>
                          <th class="bg-info">Nombre del Archivo</th>
                          <th class="bg-info">Fecha de Actualización</th>
                          <th class="text-center bg-info">Vista Previa</th>
                          <th class="text-center bg-info">X</th>
                        </tr>
                      </thead>
                      <tbody id="descargas_GD">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <!-- Despliegue de información...#menu7 -->

            <div id="menu7" class="tab-pane fade">
              <div id="sesion_OP" class="bg-info">
                <div class="borde2 col-xs-12 col-sm-12 col-md-12 col-lg-12 ">

                  <div id="subida_archivo_OP" class=" pt-3 pb-2">
                    <center>
                      <form class="form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12" action="#" name="upload" method="POST" enctype="multipart/form-data">
                        <h3>Adjuntar Archivos : </h3>
                        <div class="form-group mx-sm-3 mb-2">

                          <input type="file" name="archivo" class="form-control" required>
                          <input type="hidden" name="id_proceso_fk" value="7" class="form-control" required>
                          <input type="hidden" name="proceso" value="Operaciones" class="form-control" required>


                        </div>
                        <button type="submit" class="btn btn-success mb-2" name="subir">
                          <span class=' fa fa-upload' aria-hidden='true'></span>
                          Subir Archivo
                        </button>
                      </form>
                    </center>
                    <?php include_once("php/upload_sadoc.php"); ?>
                  </div>
                </div>
                <div id="archivos_OP" class="borde3 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="include_OP">
                    <?php
                    include_once("php/upload_OP_folder.php");
                    ?>
                  </div>
                </div>
                <hr>
                <legend></legend>
              </div>


              <div class="borde col-xs-12 col-sm-12 col-md-12 col-lg-12 panel panel-default">
                <div class="col-lg-1"></div>
                <div class="card-header text-center bg-success">
                  <h3><B>Operaciones - Descarga de Archivos : </B></h3>
                </div>
                <div style="margin-top: 10px;" class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                  <button type="submit" id="OP" class="new_folder_OP gly btn btn-primary btn-block col-lg-8">
                    <i class="fa fa-folder"></i>
                    Crear Carpeta
                  </button>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-6">
                    <table class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info text-center">#</th>
                          <th class="bg-info"><B>Carpetas</B></th>
                          <th class=" bg-info text-center">
                            <div id="panel_OP">
                              <center>
                                <a id='volver_OP'>
                                  <button class='volver_OP btn btn-info'>
                                    <i class='fa fa-chevron-left'></i>
                                    Volver
                                  </button>
                                </a>

                                <a id='recargar_OP'>
                                  <button class='volver_OP btn btn-success'>
                                    <i class="fa fa-home"></i>
                                    Panel Principal
                                  </button>
                                </a>
                              </center>
                            </div>
                          </th>
                        </tr>
                      </thead>
                      <tbody id="folder_OP">
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class=" informacion margen col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover ">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info">#</th>
                          <th class="bg-info">Nombre del Archivo</th>
                          <th class="bg-info">Fecha de Actualización</th>
                          <th class="bg-info text-center">Vista Previa</th>
                          <th class="bg-info text-center">X</th>
                        </tr>
                      </thead>
                      <tbody id="descargas_OP">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <!-- Despliegue de información...#menu8 -->

            <div id="menuJR" class="tab-pane fade">
              <div id="sesion_JR" class="bg-info">
                <div class="borde2 col-xs-12 col-sm-12 col-md-12 col-lg-12 ">

                  <div id="subida_archivo_JR" class=" pt-3 pb-2">
                    <center>
                      <form class="form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12" action="#" name="upload" method="POST" enctype="multipart/form-data">
                        <h3>Adjuntar Archivos : </h3>
                        <div class="form-group mx-sm-3 mb-2">

                          <input type="file" name="archivo" id="archivo" class="form-control" required>
                          <input type="hidden" name="id_proceso_fk" value="11" class="form-control" required>
                          <input type="hidden" name="proceso" value="JR" class="form-control" required>


                        </div>
                        <button type="submit" class="btn btn-success mb-2" name="subir">
                          <span class=' fa fa-upload' aria-hidden='true'></span>
                          Subir Archivo
                        </button>
                      </form>
                    </center>
                    <?php include_once("php/upload_sadoc.php"); ?>
                  </div>
                </div>
                <div id="archivos_JR" class="borde3 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="include_JR">
                    <?php
                    include_once("php/upload_sadoc_folder.php");
                    ?>
                  </div>
                </div>
                <hr>
                <legend></legend>
              </div>


              <div class="borde col-xs-12 col-sm-12 col-md-12 col-lg-12 panel panel-default">
                <div class="col-lg-1"></div>
                <div class="card-header text-center bg-success">
                  <h3><B>Gestión Juridica - Descarga de Archivos : </B></h3>
                </div>
                <div style="margin-top: 10px;" class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                  <button type="submit" id="JR" class="new_folder_JR gly btn btn-primary btn-block col-lg-8">
                    <i class="fa fa-folder"></i>
                    Crear Carpeta
                  </button>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-6">
                    <table class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info text-center">#</th>
                          <th class="bg-info"><B>Carpetas</B></th>
                          <th class="bg-info text-center">
                            <div id="panel_JR">
                              <center>
                                <a id='volver_JR'>
                                  <button class='volver_JR btn btn-info'>
                                    <i class='fa fa-chevron-left'></i>
                                    Volver
                                  </button>
                                </a>

                                <a id='recargar_JR'>
                                  <button class='volver_JR btn btn-success'>
                                    <i class="fa fa-home"></i>
                                    Panel Principal
                                  </button>
                                </a>
                              </center>
                            </div>
                          </th>
                        </tr>
                      </thead>
                      <tbody id="folder_JR">
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class=" informacion margen col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover ">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info">#</th>
                          <th class="bg-info">Nombre del Archivo</th>
                          <th class="bg-info">Fecha de Actualización</th>
                          <th class="bg-info text-center">Vista Previa</th>
                          <th class="bg-info text-center">X</th>
                        </tr>
                      </thead>
                      <tbody id="descargas_JR">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- Despliegue de información...#menuph -->

            <div id="menu8" class="tab-pane fade">
              <div id="sesion_PH" class="bg-info">
                <div class="borde2 col-xs-12 col-sm-12 col-md-12 col-lg-12 ">

                  <div id="subida_archivo_PH" class=" pt-3 pb-2">
                    <center>
                      <form class="form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12" action="#" name="upload" method="POST" enctype="multipart/form-data">
                        <h3>Adjuntar Archivos : </h3>
                        <div class="form-group mx-sm-3 mb-2">

                          <input type="file" name="archivo_PH" id="archivo_PH" class="form-control" required>
                          <input type="hidden" name="id_proceso_fk" value="8" class="form-control" required>
                          <input type="hidden" name="proceso" value="PH" class="form-control" required>

                        </div>
                        <button type="submit" class="btn btn-success mb-2" name="subir_PH">
                          <span class=' fa fa-upload' aria-hidden='true'></span>
                          Subir Archivo
                        </button>
                      </form>
                    </center>
                    <?php include_once("php/upload_sadoc.php"); ?>
                  </div>
                </div>
                <div id="archivos_PH" class="borde3 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="include_PH">
                    <?php
                    include_once("php/upload_sadoc_folder.php");
                    ?>
                  </div>
                </div>
                <hr>
                <legend></legend>
              </div>


              <div class="borde col-xs-12 col-sm-12 col-md-12 col-lg-12 panel panel-default">
                <div class="col-lg-1"></div>
                <div class="card-header text-center bg-success">
                  <h3><B>Seguridad - Descarga de Archivos : </B></h3>
                </div>
                <div style="margin-top: 10px;" class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                  <button type="submit" id="PH" class="new_folder_PH gly btn btn-primary btn-block col-lg-8">
                    <i class="fa fa-folder"></i>
                    Crear Carpeta
                  </button>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-6">
                    <table class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info text-center">#</th>
                          <th class="bg-info"><B>Carpetas</B></th>
                          <th class="bg-info text-center">
                            <div id="panel_PH">
                              <center>
                                <a id='volver_PH'>
                                  <button class='volver_PH btn btn-info'>
                                    <i class='fa fa-chevron-left'></i>
                                    Volver
                                  </button>
                                </a>

                                <a id='recargar_PH'>
                                  <button class='volver_PH btn btn-success'>
                                    <i class="fa fa-home"></i>
                                    Panel Principal
                                  </button>
                                </a>
                              </center>
                            </div>
                          </th>
                        </tr>
                      </thead>
                      <tbody id="folder_PH">
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class=" informacion margen col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover ">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info">#</th>
                          <th class="bg-info">Nombre del Archivo</th>
                          <th class="bg-info">Fecha de Actualización</th>
                          <th class="bg-info text-center">Vista Previa</th>
                          <th class="bg-info text-center">X</th>
                        </tr>
                      </thead>
                      <tbody id="descargas_PH">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- Despliegue de información...#menu9 -->
            <div id="menu9" class="tab-pane fade">
              <div id="sesion_SST" class="bg-info">
                <div class="borde2 col-xs-12 col-sm-12 col-md-12 col-lg-12 ">

                  <div id="subida_archivo_SST" class=" pt-3 pb-2">
                    <center>
                      <form class="form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12" action="#" name="upload" method="POST" enctype="multipart/form-data">
                        <h3>Adjuntar Archivos : </h3>
                        <div class="form-group mx-sm-3 mb-2">

                          <input type="file" name="archivo" id="archivo" class="form-control" required>
                          <input type="hidden" name="id_proceso_fk" value="9" class="form-control" required>
                          <input type="hidden" name="proceso" value="SST" class="form-control" required>

                        </div>
                        <button type="submit" class="btn btn-success mb-2" name="subir_SST">
                          <span class=' fa fa-upload' aria-hidden='true'></span>
                          Subir Archivo
                        </button>
                      </form>
                    </center>
                    <?php include_once("php/upload_sadoc.php"); ?>
                  </div>
                </div>
                <div id="archivos_SST" class="borde3 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="include_SST">
                    <?php
                    include_once("php/upload_sadoc_folder.php");
                    ?>
                  </div>
                </div>
                <hr>
                <legend></legend>
              </div>


              <div class="borde col-xs-12 col-sm-12 col-md-12 col-lg-12 panel panel-default">
                <div class="col-lg-1"></div>
                <div class="card-header text-center bg-success">
                  <h3><B>SST - Descarga de Archivos : </B></h3>
                </div>
                <div style="margin-top: 10px;" class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                  <button type="submit" id="SST" class="new_folder_SST gly btn btn-primary btn-block col-lg-8">
                    <i class="fa fa-folder"></i>
                    Crear Carpeta
                  </button>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-6">
                    <table class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info text-center">#</th>
                          <th class="bg-info"><B>Carpetas</B></th>
                          <th class="bg-info text-center">
                            <div id="panel_SST">
                              <center>
                                <a id='volver_SST'>
                                  <button class='volver_SST btn btn-info'>
                                    <i class='fa fa-chevron-left'></i>
                                    Volver
                                  </button>
                                </a>

                                <a id='recargar_SST'>
                                  <button class='volver_SST btn btn-success'>
                                    <i class="fa fa-home"></i>
                                    Panel Principal
                                  </button>
                                </a>
                              </center>
                            </div>
                          </th>
                        </tr>
                      </thead>
                      <tbody id="folder_SST">
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class=" informacion margen col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover ">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info">#</th>
                          <th class="bg-info">Nombre del Archivo</th>
                          <th class="bg-info">Fecha de Actualización</th>
                          <th class="bg-info text-center">Vista Previa</th>
                          <th class="bg-info text-center">X</th>
                        </tr>
                      </thead>
                      <tbody id="descargas_SST">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <!-- Despliegue de información...#menu10 GERENCIA TERMINADO -->
            <div id="menu10" class="tab-pane fade">
              <div id="sesion_GR" class="bg-info">
                <div class="borde2 col-xs-12 col-sm-12 col-md-12 col-lg-12 ">

                  <div id="subida_archivo_GR" class=" pt-3 pb-2">
                    <center>
                      <form class="form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12" action="#" name="upload" method="POST" enctype="multipart/form-data">
                        <h3>Adjuntar Archivos : </h3>
                        <div class="form-group mx-sm-3 mb-2">

                          <input type="file" name="archivo" id="archivo" class="form-control" required>
                          <input type="hidden" name="id_proceso_fk" value="10" class="form-control" required>
                          <input type="hidden" name="proceso" value="Gerencia" class="form-control" required>

                        </div>
                        <button type="submit" class="btn btn-success mb-2" name="subir">
                          <span class=' fa fa-upload' aria-hidden='true'></span>
                          Subir Archivo
                        </button>
                      </form>
                    </center>
                    <?php
                    include_once("php/upload_sadoc.php");
                    ?>
                  </div>

                </div>
                <div id="archivos_GR" class="borde3 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="include_GR">
                    <?php
                    include_once("php/upload_sadoc_folder.php");
                    ?>
                  </div>
                </div>
                <hr>
                <legend></legend>
              </div>

              <div class="borde col-xs-12 col-sm-12 col-md-12 col-lg-12 panel panel-default">
                <div class="col-lg-1"></div>
                <div class="card-header text-center bg-success">
                  <h3><B>Gerencia - Descarga de Archivos :</B></h3>
                </div>
                <div style="margin-top: 10px;" class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                  <button type="submit" id="GR" class="new_folder_GR gly btn btn-primary btn-block col-lg-8">
                    <i class="fa fa-folder"></i>
                    Crear Carpeta
                  </button>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-6">
                    <table class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info text-center">#</th>
                          <th class="bg-info"><B>Carpetas</B></th>
                          <th class="bg-info text-center">
                            <div id="panel_GR">
                              <center>
                                <a id='volver_GR'>
                                  <button class='volver_GR btn btn-info'>
                                    <i class='fa fa-chevron-left'></i>
                                    Volver
                                  </button>
                                </a>

                                <a id='recargar_GR'>
                                  <button class='volver_GR btn btn-success'>
                                    <i class="fa fa-home"></i>
                                    Panel Principal
                                  </button>
                                </a>
                              </center>
                            </div>


                          </th>
                        </tr>
                      </thead>
                      <tbody id="folder_GR">
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class=" informacion margen col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover ">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info">#</th>
                          <th class="bg-info">Nombre del Archivo</th>
                          <th class="bg-info">Fecha de Actualización</th>
                          <th class="bg-info text-center">Vista Previa</th>
                          <th class="bg-info text-center">X</th>
                        </tr>
                      </thead>
                      <tbody id="descargas_GR">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- Despliegue de información...#menu11 -->
            <div id="menu11" class="tab-pane fade">
              <div class="col-md-3"></div>
              <form class="col-md-6" action="#" id="registro_user">
                <div class="form-group">
                  <label>Nombre :</label>
                  <input class="form-control" type="text" name="nom" placeholder="Ingrese su nombre...">
                </div>
                <div class="form-group">
                  <label>Apellidos :</label>
                  <input class="form-control" type="text" name="ape" placeholder="Ingrese sus Apellidos...">
                </div>
                <div class="form-group">
                  <label>Correo :</label>
                  <input class="form-control" type="email" name="email" placeholder="Example@example.com...">
                </div>
                <div class="form-group">
                  <label>Contraseña :</label>
                  <input class="form-control" type="password" name="pass" placeholder="Password...">
                </div>
                <div class="form-group">
                  <label>Cargo :</label>
                  <select class="form-control" name="proceso_fk" id="proceso_fk"></select>
                </div>
                <button id="registrar_Usuario" class="btn btn-success">Registrar</button>
              </form>
              <div class="col-md-3"></div>
            </div>

            <!-- Despliegue de información...#menu12 GERENCIA TERMINADO -->
            <div id="menu12" class="tab-pane fade">
              <div id="sesion_PLE" class="bg-info">
                <div class="borde2 col-xs-12 col-sm-12 col-md-12 col-lg-12 ">

                  <div id="subida_archivo_PLE" class=" pt-3 pb-2">
                    <center>
                      <form class="form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12" action="#" name="upload" method="POST" enctype="multipart/form-data">
                        <h3>Adjuntar Archivos : </h3>
                        <div class="form-group mx-sm-3 mb-2">

                          <input type="file" name="archivo" id="archivo" class="form-control" required>
                          <input type="hidden" name="id_proceso_fk" value="12" class="form-control" required>
                          <input type="hidden" name="proceso" value="PLE" class="form-control" required>

                        </div>
                        <button type="submit" class="btn btn-success mb-2" name="subir">
                          <span class=' fa fa-upload' aria-hidden='true'></span>
                          Subir Archivo
                        </button>
                      </form>
                    </center>
                    <?php
                    include_once("php/upload_sadoc.php");
                    ?>
                  </div>

                </div>
                <div id="archivos_PLE" class="borde3 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="include_PLE">
                    <?php
                    include_once("php/upload_sadoc_folder.php");
                    ?>
                  </div>
                </div>
                <hr>
                <legend></legend>
              </div>

              <div class="borde col-xs-12 col-sm-12 col-md-12 col-lg-12 panel panel-default">
                <div class="col-lg-1"></div>
                <div class="card-header text-center bg-success">
                  <h3><B>Gerencia - Descarga de Archivos :</B></h3>
                </div>
                <div style="margin-top: 10px;" class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                  <button type="submit" id="PLE" class="new_folder_PLE gly btn btn-primary btn-block col-lg-8">
                    <i class="fa fa-folder"></i>
                    Crear Carpeta
                  </button>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-6">
                    <table class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info text-center">#</th>
                          <th class="bg-info"><B>Carpetas</B></th>
                          <th class="bg-info text-center">
                            <div id="panel_PLE">
                              <center>
                                <a id='volver_PLE'>
                                  <button class='volver_PLE btn btn-info'>
                                    <i class='fa fa-chevron-left'></i>
                                    Volver
                                  </button>
                                </a>

                                <a id='recargar_PLE'>
                                  <button class='volver_PLE btn btn-success'>
                                    <i class="fa fa-home"></i>
                                    Panel Principal
                                  </button>
                                </a>
                              </center>
                            </div>


                          </th>
                        </tr>
                      </thead>
                      <tbody id="folder_PLE">
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class=" informacion margen col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover ">
                      <thead class="thead-light ">
                        <tr>
                          <th class="bg-info">#</th>
                          <th class="bg-info">Nombre del Archivo</th>
                          <th class="bg-info">Fecha de Actualización</th>
                          <th class="bg-info text-center">Vista Previa</th>
                          <th class="bg-info text-center">X</th>
                        </tr>
                      </thead>
                      <tbody id="descargas_PLE">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- SESION DE MATRICES  -->

            <!-- Despliegue de información...#menu13 -->
            <div id="menu13" class="tab-pane fade">
              <div id="_SIG" class="bg-info">
                <div class="borde2 col-xs-12 col-sm-12 col-md-12 col-lg-12 ">

                  <div id="subida_archivo_Matriz_SIG" class=" pt-3 pb-2">
                    <center>
                      <form class="form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12" action="#" name="upload" method="POST" enctype="multipart/form-data">
                        <h3>Adjuntar Matriz: </h3>
                        <div class="form-group mx-sm-3 mb-2">

                          <input type="file" name="archivo_Matriz_SIG" id="archivo_Matriz_SIG" class="form-control" required>

                        </div>
                        <button type="submit" class="btn btn-success mb-2" name="subir_Matriz_SIG">
                          <span class=' fa fa-upload' aria-hidden='true'></span>
                          Subir Archivo
                        </button>
                      </form>
                    </center>
                    <?php
                    include_once("php/upload_MT_SIG.php");
                    ?>
                  </div>

                </div>


                <div id="archivos_Matriz_SIG" class="borde3 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="include_Matriz_SIG">
                    <?php
                    include_once("php/upload_Matriz_SIG_folder.php");
                    ?>
                  </div>
                </div>
                <br />
                <legend></legend>
              </div>

              <div class="borde col-xs-12 col-sm-12 col-md-12 col-lg-12 panel panel-default">
                <div class="col-lg-2"></div>
                <div class="card-header text-center bg-teal">
                  <h3><B>Listado de Matrices Gestión Juridica</B></h3>
                </div>
                <div class="col-lg-1"></div>
                <table class=" informacion margen col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover ">
                  <thead class="thead-light ">
                    <tr>
                      <th>#</th>
                      <th>Nombre del Archivo</th>
                      <th>Fecha de Actualización</th>
                      <th class="text-center">Vista Previa</th>
                      <th class="text-center">X</th>
                    </tr>
                  </thead>
                  <tbody id="descargas_MT_SIG">
                  </tbody>
                </table>

              </div>
            </div>

            <!-- Despliegue de información...#menu15 -->
            <div id="menu15" class="tab-pane fade">
              <div id="Matriz_GH" class="bg-info">
                <div class="borde2 col-xs-12 col-sm-12 col-md-12 col-lg-12 ">

                  <div id="subida_archivo_Matriz_GH" class=" pt-3 pb-2">
                    <center>
                      <form class="form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12" action="#" name="upload" method="POST" enctype="multipart/form-data">
                        <h3>Adjuntar Matriz: </h3>
                        <div class="form-group mx-sm-3 mb-2">

                          <input type="file" name="archivo_Matriz_GH" id="archivo_Matriz_GH" class="form-control" required>

                        </div>
                        <button type="submit" class="btn btn-success mb-2" name="subir_Matriz_GH">
                          <span class=' fa fa-upload' aria-hidden='true'></span>
                          Subir Archivo
                        </button>
                      </form>
                    </center>
                    <?php
                    include_once("php/upload_Matriz_GH.php");
                    ?>
                  </div>

                </div>


                <div id="archivos_Matriz_GH" class="borde3 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="include_Matriz_GH">
                    <?php
                    include_once("php/upload_Matriz_GH_folder.php");
                    ?>
                  </div>
                </div>
                <br />
                <legend></legend>
              </div>

              <div class="borde col-xs-12 col-sm-12 col-md-12 col-lg-12 panel panel-default">
                <div class="col-lg-2"></div>
                <div class="card-header text-center bg-teal">
                  <h3><B>Listado de Matrices Gestión Administrativa</B></h3>
                </div>
                <div class="col-lg-1"></div>
                <table class=" informacion margen col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover ">
                  <thead class="thead-light ">
                    <tr>
                      <th>#</th>
                      <th>Nombre del Archivo</th>
                      <th>Fecha de Actualización</th>
                      <th class="text-center">Vista Previa</th>
                      <th class="text-center">X</th>
                    </tr>
                  </thead>
                  <tbody id="descargas_MT_GH">
                  </tbody>
                </table>

              </div>
            </div>

            <!-- Despliegue de información...#menu18 -->
            <div id="menu18" class="tab-pane fade">
              <div id="Matriz_PH" class="bg-info">
                <div class="borde2 col-xs-12 col-sm-12 col-md-12 col-lg-12 ">

                  <div id="subida_archivo_Matriz_PH" class=" pt-3 pb-2">
                    <center>
                      <form class="form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12" action="#" name="upload" method="POST" enctype="multipart/form-data">
                        <h3>Adjuntar Matriz: </h3>
                        <div class="form-group mx-sm-3 mb-2">

                          <input type="file" name="archivo_Matriz_PH" id="archivo_Matriz_PH" class="form-control" required>

                        </div>
                        <button type="submit" class="btn btn-success mb-2" name="subir_Matriz_PH">
                          <span class=' fa fa-upload' aria-hidden='true'></span>
                          Subir Archivo
                        </button>
                      </form>
                    </center>
                    <?php
                    include_once("php/upload_MT_PH.php");
                    ?>
                  </div>

                </div>


                <div id="archivos_Matriz_PH" class="borde3 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="include_Matriz_PH">
                    <?php
                    include_once("php/upload_MT_PH_folder.php");
                    ?>
                  </div>
                </div>
                <br />
                <legend></legend>
              </div>

              <div class="borde col-xs-12 col-sm-12 col-md-12 col-lg-12 panel panel-default">
                <div class="col-lg-2"></div>
                <div class="card-header text-center bg-teal">
                  <h3><B>Listado de Matrices Seguridad :</B></h3>
                </div>
                <div class="col-lg-1"></div>
                <table class=" informacion margen col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover ">
                  <thead class="thead-light ">
                    <tr>
                      <th>#</th>
                      <th>Nombre del Archivo</th>
                      <th>Fecha de Actualización</th>
                      <th class="text-center">Vista Previa</th>
                      <th class="text-center">X</th>
                    </tr>
                  </thead>
                  <tbody id="descargas_MT_PH">
                  </tbody>
                </table>

              </div>
            </div>







            <!-- MATRICES QUE YA NO SE UTILIZAN PERO POR SI ACASO -->
            <!-- Despliegue de información...#menu14 -->
            <div id="menu14" class="tab-pane fade">
              <div id="Matriz_TI">
                <div class="borde2 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="subida_archivo_Matriz_TI">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                      <i>
                        <h3>Adjuntar Matriz : </h3>
                      </i>
                    </div>
                    <form class="col-md-9 col-lg-8 col-sm-12 col-xs-12" action="#" name="upload" method="POST" enctype="multipart/form-data">
                      <br />
                      <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12 form-group">
                        <input type="file" name="archivo_Matriz_TI" id="archivo_Matriz_TI" class="form-control" required>
                      </div>
                      <div class="col-xs-1"></div>
                      <div class="col-lg-6 col-md-6 col-sm-5 col-xs-10 form-group">
                        <button type="submit" class="btn btn-primary btn-block" name="subir_Matriz_TI">
                          <span class='gly glyphicon glyphicon-cloud-upload' aria-hidden='true'></span>
                          Actualizar Matriz
                        </button>
                      </div>
                      <div class="col-xs-1 col-sm-2"></div>
                      <br />
                    </form>
                    <?php
                    include_once("php/upload_MT_TI.php");
                    ?>
                  </div>
                </div>
                <div id="archivos_Matriz_TI" class="borde3 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="include_Matriz_TI">
                    <?php
                    include_once("php/upload_Matriz_TI_folder.php");
                    ?>
                  </div>
                </div>
                <br />
                <legend></legend>
              </div>

              <div class="borde col-xs-12 col-sm-12 col-md-12 col-lg-12 panel panel-default">
                <div class="col-lg-2"></div>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-5">
                  <i>
                    <h3>Listado de Matrices TI : </h3>
                  </i>
                </div>
                <div class="col-lg-1"></div>
                <table class="informacion margen col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover">
                  <thead>
                    <tr>
                      <th scope="col" class="col-xs-1 col-sm-1 col-md-1 col-lg-1">#</th>
                      <th class="col-xs-5 col-sm-5 col-md-4 col-lg-4" scope="col"><i>Nombre del Archivo</i></th>
                      <th class="col-xs-3 col-sm-3 col-md-3 col-lg-3" scope="col"><i>Fecha de Actualización</i></th>
                      <th scope="col" class="col-xs-3 col-sm-3 col-md-4 col-lg-4"><i>Options</i></th>
                    </tr>
                  </thead>
                  <tbody id="descargas_MT_TI">

                  </tbody>
                </table>
              </div>
            </div>
            <!-- Despliegue de información...#menu16 -->
            <div id="menu16" class="tab-pane fade">
              <div id="Matriz_TEC">
                <div class="borde2 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="subida_archivo_Matriz_TEC">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                      <i>
                        <h3>Adjuntar Matriz : </h3>
                      </i>
                    </div>
                    <form class="col-md-9 col-lg-8 col-sm-12 col-xs-12" action="#" name="upload" method="POST" enctype="multipart/form-data">
                      <br />
                      <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12 form-group">
                        <input type="file" name="archivo_Matriz_TEC" id="archivo_Matriz_TEC" class="form-control" required>
                      </div>
                      <div class="col-xs-1"></div>
                      <div class="col-lg-6 col-md-6 col-sm-5 col-xs-10 form-group">
                        <button type="submit" class="btn btn-primary btn-block" name="subir_Matriz_TEC">
                          <span class='gly glyphicon glyphicon-cloud-upload' aria-hidden='true'></span>
                          Actualizar Matriz
                        </button>
                      </div>
                      <div class="col-xs-1 col-sm-2"></div>
                      <br />
                    </form>
                    <?php
                    include_once("php/upload_MT_TEC.php");
                    ?>
                  </div>
                </div>
                <div id="archivos_Matriz_TEC" class="borde3 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="include_Matriz_TEC">
                    <?php
                    include_once("php/upload_Matriz_TEC_folder.php");
                    ?>
                  </div>
                </div>
                <br />
                <legend></legend>
              </div>

              <div class="borde col-xs-12 col-sm-12 col-md-12 col-lg-12 panel panel-default">
                <div class="col-lg-2"></div>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-5">
                  <i>
                    <h3>Listado de Matrices Gestion Técnica : </h3>
                  </i>
                </div>
                <div class="col-lg-1"></div>
                <table class="informacion margen col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover">
                  <thead>
                    <tr>
                      <th scope="col" class="col-xs-1 col-sm-1 col-md-1 col-lg-1">#</th>
                      <th class="col-xs-5 col-sm-5 col-md-4 col-lg-4" scope="col"><i>Nombre del Archivo</i></th>
                      <th class="col-xs-3 col-sm-3 col-md-3 col-lg-3" scope="col"><i>Fecha de Actualización</i></th>
                      <th scope="col" class="col-xs-3 col-sm-3 col-md-4 col-lg-4"><i>Options</i></th>
                    </tr>
                  </thead>
                  <tbody id="descargas_MT_TEC">

                  </tbody>
                </table>
              </div>
            </div>
            <!-- Despliegue de información...#menu17 -->
            <div id="menu17" class="tab-pane fade">
              <div id="Matriz_CT">
                <div class="borde2 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="subida_archivo_Matriz_CT">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                      <i>
                        <h3>Adjuntar Matriz : </h3>
                      </i>
                    </div>
                    <form class="col-md-9 col-lg-8 col-sm-12 col-xs-12" action="#" name="upload" method="POST" enctype="multipart/form-data">
                      <br />
                      <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12 form-group">
                        <input type="file" name="archivo_Matriz_CT" id="archivo_Matriz_CT" class="form-control" required>
                      </div>
                      <div class="col-xs-1"></div>
                      <div class="col-lg-6 col-md-6 col-sm-5 col-xs-10 form-group">
                        <button type="submit" class="btn btn-primary btn-block" name="subir_Matriz_CT">
                          <span class='gly glyphicon glyphicon-cloud-upload' aria-hidden='true'></span>
                          Actualizar Matriz
                        </button>
                      </div>
                      <div class="col-xs-1 col-sm-2"></div>
                      <br />
                    </form>
                    <?php
                    include_once("php/upload_MT_CT.php");
                    ?>
                  </div>
                </div>
                <div id="archivos_Matriz_CT" class="borde3 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="include_Matriz_CT">
                    <?php
                    include_once("php/upload_Matriz_CT_folder.php");
                    ?>
                  </div>
                </div>
                <br />
                <legend></legend>
              </div>

              <div class="borde col-xs-12 col-sm-12 col-md-12 col-lg-12 panel panel-default">
                <div class="col-lg-2"></div>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-5">
                  <i>
                    <h3>Listado de Matrices Gestion Contable y Financiera : </h3>
                  </i>
                </div>
                <div class="col-lg-1"></div>
                <table class="informacion margen col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover">
                  <thead>
                    <tr>
                      <th scope="col" class="col-xs-1 col-sm-1 col-md-1 col-lg-1">#</th>
                      <th class="col-xs-5 col-sm-5 col-md-4 col-lg-4" scope="col"><i>Nombre del Archivo</i></th>
                      <th class="col-xs-3 col-sm-3 col-md-3 col-lg-3" scope="col"><i>Fecha de Actualización</i></th>
                      <th scope="col" class="col-xs-3 col-sm-3 col-md-4 col-lg-4"><i>Options</i></th>
                    </tr>
                  </thead>
                  <tbody id="descargas_MT_CT">

                  </tbody>
                </table>
              </div>
            </div>
            <!-- Despliegue de información...#menu19 -->
            <div id="menu19" class="tab-pane fade">
              <div id="Matriz_GR">
                <div class="borde2 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="subida_archivo_Matriz_GR">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                      <i>
                        <h3>Adjuntar Matriz : </h3>
                      </i>
                    </div>
                    <form class="col-md-9 col-lg-8 col-sm-12 col-xs-12" action="#" name="upload" method="POST" enctype="multipart/form-data">
                      <br />
                      <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12 form-group">
                        <input type="file" name="archivo_Matriz_GR" id="archivo_Matriz_GR" class="form-control" required>
                      </div>
                      <div class="col-xs-1"></div>
                      <div class="col-lg-6 col-md-6 col-sm-5 col-xs-10 form-group">
                        <button type="submit" class="btn btn-primary btn-block" name="subir_Matriz_GR">
                          <span class='gly glyphicon glyphicon-cloud-upload' aria-hidden='true'></span>
                          Actualizar Matriz
                        </button>
                      </div>
                      <div class="col-xs-1 col-sm-2"></div>
                      <br />
                    </form>
                    <?php
                    include_once("php/upload_MT_GR.php");
                    ?>
                  </div>
                </div>
                <div id="archivos_Matriz_GR" class="borde3 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="include_Matriz_GR">
                    <?php
                    include_once("php/upload_Matriz_GR_folder.php");
                    ?>
                  </div>
                </div>
                <br />
                <legend></legend>
              </div>

              <div class="borde col-xs-12 col-sm-12 col-md-12 col-lg-12 panel panel-default">
                <div class="col-lg-2"></div>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-5">
                  <i>
                    <h3>Listado de Matrices Gerencia : </h3>
                  </i>
                </div>
                <div class="col-lg-1"></div>
                <table class="informacion margen col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombre del Archivo</th>
                      <th>Fecha de Actualización</th>
                      <th>Vista Previa</th>
                      <th>X</th>
                    </tr>
                  </thead>
                  <tbody id="descargas_MT_GR">

                  </tbody>
                </table>
              </div>
            </div>
            <!-- Despliegue de información...#menu20 -->
            <div id="menu20" class="tab-pane fade">
              <div id="Matriz_GD" class="bg-info ">
                <div class="borde2 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="subida_archivo_Matriz_GD" class="pt-3">
                    <center>
                      <form class="form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12" action="#" name="upload" method="POST" enctype="multipart/form-data">
                        <h3>Adjuntar Matriz: </h3>
                        <div class="form-group mx-sm-3 mb-2">

                          <input type="file" name="archivo_Matriz_GD" id="archivo_Matriz_GD" class="form-control" required>

                        </div>
                        <button type="submit" class="btn btn-success mb-2" name="subir_Matriz_GD">
                          <span class=' fa fa-upload' aria-hidden='true'></span>
                          Subir Archivo
                        </button>
                      </form>
                    </center>

                    <?php
                    include_once("php/upload_MT_GD.php");
                    ?>
                  </div>
                </div>
                <div id="archivos_Matriz_GD" class="borde3 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="include_Matriz_GD">
                    <?php
                    include_once("php/upload_Matriz_GD_folder.php");
                    ?>
                  </div>
                </div>
                <br />
                <legend></legend>
              </div>

              <div class="borde col-xs-12 col-sm-12 col-md-12 col-lg-12 panel panel-default">
                <div class="col-lg-2"></div>
                <div class="card-header text-center bg-teal">
                  <h3><B>Listado de Matrices Gestión Juridica</B></h3>
                </div>
                <div class="col-lg-1"></div>
                <table class="informacion margen col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover">
                  <thead>
                    <tr class="text-center">
                      <th>#</th>
                      <th>Nombre del Archivo</th>
                      <th>Fecha de Actualización</th>
                      <th>Vista Previa</th>
                      <th>X</th>
                    </tr>
                  </thead>
                  <tbody id="descargas_MT_GD">

                  </tbody>
                </table>
              </div>
            </div>
            <!-- Despliegue de información...#menu21 -->
            <div id="menu21" class="tab-pane fade">
              <div id="Matriz_OP">
                <div class="borde2 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="subida_archivo_Matriz_OP">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                      <i>
                        <h3>Adjuntar Matriz : </h3>
                      </i>
                    </div>
                    <form class="col-md-9 col-lg-8 col-sm-12 col-xs-12" action="#" name="upload" method="POST" enctype="multipart/form-data">
                      <br />
                      <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12 form-group">
                        <input type="file" name="archivo_Matriz_OP" id="archivo_Matriz_OP" class="form-control" required>
                      </div>
                      <div class="col-xs-1"></div>
                      <div class="col-lg-6 col-md-6 col-sm-5 col-xs-10 form-group">
                        <button type="submit" class="btn btn-primary btn-block" name="subir_Matriz_OP">
                          <span class='gly glyphicon glyphicon-cloud-upload' aria-hidden='true'></span>
                          Actualizar Matriz
                        </button>
                      </div>
                      <div class="col-xs-1 col-sm-2"></div>
                      <br />
                    </form>
                    <?php
                    include_once("php/upload_MT_OP.php");
                    ?>
                  </div>
                </div>
                <div id="archivos_Matriz_OP" class="borde3 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div id="include_Matriz_OP">
                    <?php
                    include_once("php/upload_Matriz_OP_folder.php");
                    ?>
                  </div>
                </div>
                <br />
                <legend></legend>
              </div>

              <div class="borde col-xs-12 col-sm-12 col-md-12 col-lg-12 panel panel-default">
                <div class="col-lg-2"></div>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-5">
                  <i>
                    <h3>Listado de Matrices Operaciones : </h3>
                  </i>
                </div>
                <div class="col-lg-1"></div>
                <table class=" informacion margen col-xs-12 col-sm-12 col-md-12 col-lg-12 table table-hover ">
                  <thead class="thead-light ">
                    <tr>
                      <th>#</th>
                      <th>Nombre del Archivo</th>
                      <th>Fecha de Actualización</th>
                      <th class="text-center">Vista Previa</th>
                      <th class="text-center">X</th>
                    </tr>
                  </thead>
                  <tbody id="descargas_MT_OP">

                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
 
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>

  <?php

  if ($_SESSION['proceso_fk'] == "JR") {
  ?>
    <script language='javascript'>
      activar_menus("JR");
    </script>
    <?php

  } else {


    if ($_SESSION['proceso_fk'] == "TI") {
    ?>
      <script language='javascript'>
        activar_menus("TI");
      </script>
      <?php

    } else {

      if ($_SESSION['proceso_fk'] == "CT") {
      ?>
        <script language='javascript'>
          activar_menus("CT");
        </script>
        <?php

      } else {

        if ($_SESSION['proceso_fk'] == "TEC") {
        ?>
          <script language='javascript'>
            activar_menus("TEC");
          </script>
          <?php

        } else {

          if ($_SESSION['proceso_fk'] == "GH") {
          ?>
            <script language='javascript'>
              activar_menus("GH");
            </script>
            <?php

          } else {

            if ($_SESSION['proceso_fk'] == "GD") {
            ?>
              <script language='javascript'>
                activar_menus("GD");
              </script>
              <?php

            } else {

              if ($_SESSION['proceso_fk'] == "OP") {
              ?>
                <script language='javascript'>
                  activar_menus("OP");
                </script>
                <?php

              } else {

                if ($_SESSION['proceso_fk'] == "PH") {
                ?>
                  <script language='javascript'>
                    activar_menus("PH");
                  </script>
                  <?php

                } else {

                  if ($_SESSION['proceso_fk'] == "GR") {
                  ?>
                    <script language='javascript'>
                      activar_menus("GR");
                    </script>
                    <?php

                  } else {

                    if ($_SESSION['proceso_fk'] == "SST") {
                    ?>
                      <script language='javascript'>
                        activar_menus("SST");
                      </script>
                      <?php

                    } else {

                      if ($_SESSION['proceso_fk'] == "SIG") {
                      ?>
                        <script language='javascript'>
                          activar_menus("SIG");
                        </script>
                        <?php

                      } else {

                        if ($_SESSION['proceso_fk'] != "SIG" && $_SESSION['proceso_fk'] != "SST" && $_SESSION['proceso_fk'] != "GR" && $_SESSION['proceso_fk'] != "PH" && $_SESSION['proceso_fk'] != "OP" && $_SESSION['proceso_fk'] != "GD" && $_SESSION['proceso_fk'] != "GH" && $_SESSION['proceso_fk'] != "TEC" && $_SESSION['proceso_fk'] != "CT" && $_SESSION['proceso_fk'] != "TI" && $_SESSION['proceso_fk'] != "JR") {
                        ?>
                          <script language='javascript'>
                            Desactivar_listado("<?php echo $_SESSION['proceso_fk']; ?>");
                          </script>
  <?php

                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }
  ?>
  </body>

  </html>
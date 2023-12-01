  <?php
  session_start();
  if ($_SESSION['ingreso'] == true) {
    require('php/conexion.php');
    require('plantilla.php');
  ?>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item En_linea 1" role="presentation">
          <a data-toggle="tab" href="#acpm" class="nav-link">
            <i class="nav-icon far fa-smile-wink"></i>
            <p>
              Novedades
            </p>
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
    </div>
  <?php
    //require('include/footer.php');

  } else {
    session_unset();
    session_destroy();
    header('location: ../index.php');
  }
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Dashboard </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- NUMEROS DE ACTIVOS -->

        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-info">
              <span class="info-box-icon"><i class="fas fa-tv"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Activos Fijos</span>
                <h3><?= $cantidad_activos ?></h3>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  Cantidad de Activos Asignados
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
              <span class="info-box-icon"><i class="fas fa-dollar-sign"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Ordenes de Compra</span>
                <h3>150</h3>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  Esperando aprobación
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-warning">
              <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Actividades </span>
                <h3>150</h3>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  Proximas a Vencer
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-danger">
              <span class="info-box-icon"><i class="fas fa-skull"></i></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Urgente</span>
                <h3><?= $total_actividades_vencidas ?></h3>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  Actividades Vencidas
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


          <div class="card col-md-4 col-sm-6 col-12">
            <div class="card-header">
              <h3 class="card-title">Ultimos Documentos SADOC</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <ul class="products-list product-list-in-card pl-2 pr-2">

                <?php
                try {
                  $stmt = $conn->prepare("SELECT id, ruta,
                  REVERSE(SUBSTRING_INDEX(REVERSE(ruta), '/', 1)) AS nombre_archivo, ruta_principal, Fecha_Subida, estado, sub_Carpeta, id_proceso_fk
                          FROM sadoc
                          ORDER BY Fecha_Subida DESC
                          LIMIT 5");
                  $stmt->execute();
                  $registros = 1;
                  if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch()) {
                      $fecha_subida = $row["Fecha_Subida"];
                      $nombre_archivo = $row["nombre_archivo"];
                      $ruta_principal = $row["ruta_principal"];
                      
                ?>

                      <li class="item">
                        <div class="product-img">
                          <button class="btn btn-lg"><i class="far fa-file-alt"></i></button>
                        </div>
                        <div class="product-info">
                          <a href="javascript:void(0)" class="product-title"><?= $nombre_archivo ?>
                            <span class="badge badge-success float-right">Nuevo</span></a>
                          <span class="product-description">
                            <?= $ruta_principal ?>
                          </span>
                        </div>
                      </li>

                <?php
                    }
                  }
                } catch (PDOException $e) {
                  echo "Error en el servidor";
                }
                ?>


                <!-- /.item -->
              </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <a href="sadoc.php" class="uppercase" target="_blank">Ir a SADOC</a>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>
  <?php require('footer.php'); ?>
  <!-- ./wrapper -->


  </body>

  </html>
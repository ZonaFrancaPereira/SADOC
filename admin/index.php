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
        <!-- NÚMEROS DE ACTIVOS -->

        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-info">
              <span class="info-box-icon"><i class="fas fa-tv"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Activos Fijos</span>
                <h3><?= $cantidad_activos; ?></h3>

                <div class="progress">
                  <div class="progress-bar" style="width: <?= $cantidad_activos; ?>%"></div>
                </div>
                <span class="progress-description">
                  Cantidad de Activos Asignados
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- ORDENES DE COMPRA EXCLUYEN LOS AUX -->
          <?php
          if($_SESSION['rol_usuario']=="admin_sig" || $_SESSION['rol_usuario']=="directivo" ||
           $_SESSION['rol_usuario']=="superadmin" || $_SESSION['rol_usuario']=="directivo" || $_SESSION['rol_usuario']=="gerencia" || $_SESSION['rol_usuario']=="admin_contable"){
          ?>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
              <span class="info-box-icon"><i class="fas fa-dollar-sign"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Ordenes de Compra</span>
                <h3><?= $cantidad_orden ?></h3>
                <div class="progress">
                  <div class="progress-bar" style="width: <?= $cantidad_orden ?>%"></div>
                </div>
                <span class="progress-description">
                  Esperando aprobación
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <?php
}
          ?>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-warning">
              <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Actividades </span>

                <h3><?= $proxima_vencer; ?></h3>

                <div class="progress">
                  <div class="progress-bar" style="width: <?= $proxima_vencer; ?>%"></div>
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
                <h3><?= $total_actividades_vencidas; ?></h3>

                <div class="progress">
                  <div class="progress-bar" style="width: <?= $total_actividades_vencidas; ?>%"></div>
                </div>
                <span class="progress-description">
                  Actividades Vencidas
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <!-- /ESTA TARJETA ES PARA LA GERENTE -->
          <?php if ($_SESSION['firmar_orden'] == "Si") { ?>
            <div class="col-md-8 col-sm-12 col-12">
              <!-- /.card -->
              <div class="card">
                <div class="card-header border-0">
                  <h3 class="card-title">Ordenes por Aprobar</h3>
                  <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-sm">
                      <i class="fas fa-download"></i>
                    </a>
                    <a href="#" class="btn btn-tool btn-sm">
                      <i class="fas fa-bars"></i>
                    </a>
                  </div>
                </div>
                <div class="card-body table-responsive p-0">
                  <table class="display table table-striped table-valign-middle">
                    <thead>
                      <tr>
                        <th># Orden</th>
                        <th>Cotizante</th>
                        <th>Fecha</th>
                        <th>Valor</th>
                        <th>Ver</th>
                        <th>Aprobar</th>
                        <th>Rechazar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      try {
                        $stmt = $conn->prepare('SELECT c.id_orden,c.fecha_orden,c.proveedor_recurrente,c.forma_pago,
                                   c.tiempo_pago,c.porcentaje_anticipo,c.condiciones_negociacion,c.comentario_orden,c.tiempo_entrega,
                                   c.total_orden,c.analisis_cotizacion,c.estado_orden,c.id_cotizante,c.id_proveedor_fk,u.Id_usuario, u.correo_usuario,
                                   u.contrasena_usuario, u.nombre_usuario,u.apellidos_usuario, u.siglas_usuario, u.estado_usuario, u.firma_usuario,
                                    u.proceso_usuario_fk, u.id_cargo_fk, u.tipo_usuario_fk,p.id_proveedor,p.nombre_proveedor,p.contacto_proveedor,p.telefono_proveedor,p.id_usuario_fk
                                    FROM  orden_compra c
                                    INNER JOIN usuarios u
                                    ON c.id_cotizante=u.Id_usuario
                                    INNER JOIN proveedor_compras p
                                    ON c.id_proveedor_fk= p.id_proveedor
                                     WHERE  c.estado_orden = "Proceso" ');
                        $stmt->execute();
                        $registros = 1;
                        if ($stmt->rowCount() > 0) {

                          while ($row = $stmt->fetch()) {

                            $id_orden = $row["id_orden"];
                            $nombre_usuario = $row["nombre_usuario"];
                            $apellidos_usuario = $row["apellidos_usuario"];
                            $fecha_orden = $row["fecha_orden"];
                            $total_orden = $row["total_orden"];
                            $correo_usuario = $row["correo_usuario"];
                            echo "<tr>";
                            echo "<td >" . $id_orden . "</td>";
                            echo "<td >" . $nombre_usuario . " " . $apellidos_usuario . "</td>";
                            echo "<td>" . $row["fecha_orden"] . "</td>";
                            echo "<td>$ " . number_format($row["total_orden"]) . "</td>";
                            echo "<td> <a href='orden_pdf.php?id_orden=$id_orden' target='_blank'> <button class='btn btn-danger'><i class='fas fa-file-pdf'></i> </button></a></td>";
                            echo "<td><a href='editar_estado.php?id_orden=$id_orden&estado_orden=Aprobada&nombre_usuario=$nombre_usuario&apellidos_usuario=$apellidos_usuario&fecha_orden=$fecha_orden&total_orden=$total_orden'><button class='btn btn-success'><i class='fas fa-thumbs-up'></i></button></a></td>";
                            echo "<td><a href='editar_estado.php?id_orden=$id_orden&estado_orden=Denegada&nombre_usuario=$nombre_usuario&apellidos_usuario=$apellidos_usuario&fecha_orden=$fecha_orden&total_orden=$total_orden&correo_usuario=$correo_usuario'><button class='btn btn-danger'><i class='fas fa-times-circle'></i> </button></a></td>";
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
              </div>
              <!-- /.card -->
            </div>
          <?php } ?>
          <!-- /ESTA TARJETA ES PARA VER LOS ULTIMOS DOCUMENTOS SUBIDOS A SADOC -->
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
            <div class="card card-footer text-center bg-primary">
              <a href="sadoc.php" class="uppercase" target="_blank">Ir a SADOC</a>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /ESTA TARJETA ES PARA VER LAS 5 ULTIMAS ACCIONES POR REVISAR SOLO SIG-->
          <?php
          if($_SESSION['rol_usuario']=="admin_sig"){
          ?>
          <div class="card col-md-8 col-sm-8 col-12">
            <div class="card-header">
              <h3 class="card-title">Ultimos ACPM Por Aprobación</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <ul class="products-list product-list-in-card pl-2 pr-2">

                <?php
                try {

                  $stmt = $conn->prepare("SELECT * FROM acpm a
                  INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
                  INNER JOIN proceso p ON p.id_proceso = u.proceso_usuario_fk
                  INNER JOIN cargos c ON c.id_cargo = u.id_cargo_fk WHERE a.estado_acpm = 'Proceso'
                  ORDER BY a.fecha_finalizacion DESC
                  LIMIT 5");

                  $stmt->execute();
                  $registros = 1;
                  if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch()) {
                      $fecha_finalizacion = $row["fecha_finalizacion"];
                      $nombre_usuario = $row["nombre_usuario"];
                      $apellidos_usuario = $row["apellidos_usuario"];
                      $tipo_acpm = $row["tipo_acpm"];
                      $descripcion_acpm = $row["descripcion_acpm"];
                      $nombre_proceso = $row["nombre_proceso"];

                ?>

                      <li class="item">
                        <div class="product-img">
                          <button class="btn bg-warning"><i class="fas fa-calendar-check"></i></button>
                        </div>
                        <div class="product-info">
                          <a href="javascript:void(0)" class="product-title"><?= $nombre_usuario ?> <?= $apellidos_usuario ?> - <?= $nombre_proceso ?>
                            <span class="badge badge-success float-right"><?= $tipo_acpm ?></span></a>
                          <span class="product-description">
                            <B> Fecha de Finalizacion : </B><?= $fecha_finalizacion ?><br>
                            <?= $descripcion_acpm ?>
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
            <div class="card card-footer text-center bg-primary">
              <a href="acpm.php" class="uppercase">VER TODAS</a>
            </div>
            <!-- /.card-footer -->
          </div>
<?php } ?>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

  </div>


  <?php require('footer.php'); ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- ./wrapper -->


  </body>

  </html>
<?php
require('seguridad.php');
?>

<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a data-toggle="tab" href="#panela" class="nav-link active">
        <i class="nav-icon fas fa-tachometer-alt"></i>

        <p>
          Panel de Control
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a data-toggle="tab" href="#asignar" class="nav-link" id="equipos_nav">

        <i class="nav-icon fas fa-laptop-medical"></i>
        <p>
          Asignar Equipo
        </p>
      </a>
    </li>

    <li class="nav-item">
      <a data-toggle="tab" href="#detalles" class="nav-link ">

        <i class="nav-icon  fas fa-sim-card"></i>
        <p>
          Detalles del Equipo
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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div id="wrapper" class="toggled">
    <div id="page-content-wrapper">
      <div class="container-fluid">
        <div class="tab-content ">
          <!-- DIV DONDE SE MUESTRAN TODOS LOS ACTIVOS -->
          <div class="tab-pane  show active" id="panela">
            <div class="row">
              <div class="col-lg-12">
                <!-- /.card -->
                <div class="card">


                  Gestiona tus activos

                  <!-- /.card-footer -->
                </div>
              </div>
            </div>
          </div>
          <!-- DIV DONDE SE VAN A REALIZAR LA ASIGNACION DE EQUIPOS -->
          <div class="tab-pane  " id="asignar">
            <div class="row">
              <div class="col-lg-12">
                <!-- /.card -->
                <div class="card">
                  <div class="card">
                    <!-- Boton modal Asignar Equipo -->
                    <button type="button" class="btn bg-primary" data-toggle="modal" data-target="#ModalAsignarE">
                      Asignar Equipo de Computo
                    </button>
                    <div class="card-body table-responsive p-4">
                  <table class="display table table-striped table-valign-middle " width="100%">
                        <thead>
                          <tr>
                            <th># Asignación</th>
                            <th>Fecha</th>
                            <th>Entrega</th>
                            <th>Recibe</th>
                            <th>Observaciones</th>
                            <th>Soporte</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          try {
                            $stmt = $conn->prepare('SELECT u.*,r.*,ti.nombre_usuario AS nombre_ti, ti.apellidos_usuario AS apellidos_ti
                                  FROM  asignacion_equipos r
                                  INNER JOIN usuarios u
                                  ON r.id_usuario_fk=u.Id_usuario
                                  INNER JOIN usuarios ti
                                  ON r.id_ti_fk=ti.Id_usuario                             
                                  WHERE  r.estado_asignacion = "Activa" ');
                            $stmt->execute();
                            $registros = 1;
                            if ($stmt->rowCount() > 0) {

                              while ($row = $stmt->fetch()) {
                                $id_usuario= $row["Id_usuario"];
                                $id_asignacion = $row["id_asignacion"];
                                $fecha_asignacion = $row["fecha_asignacion"];
                                $nombre_ti = $row["nombre_ti"];
                                $apellidos_ti = $row["apellidos_ti"];
                                $nombre_usuario = $row["nombre_usuario"];
                                $apellidos_usuario = $row["apellidos_usuario"];
                                $observaciones_asignacion = $row["observaciones_asignacion"];
                             
                           
                                echo "<tr>";
                                echo "<td >" . $id_asignacion . "</td>";
                                echo "<td>" . $fecha_asignacion . "</td>";
                                echo "<td >" . $nombre_ti . " " . $apellidos_ti . "</td>";
                                echo "<td >" . $nombre_usuario . " " . $apellidos_usuario . "</td>";
                                echo "<td>" . $observaciones_asignacion . "</td>";
                                echo "<td> <a href='asignacion_ti_pdf.php?id_usuario=$id_usuario' target='_blank'> <button class='btn btn-danger'><i class='fas fa-file-pdf'></i> </button></a></td>";

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
                </div>
              </div>
            </div>
          </div>
          <!-- DIV DONDE SE PUEDEN INGRESAR Y ASIGNAR NUEVOS ACTIVOS-->
          <div class="tab-pane " id="detalles">
            <div class="container mt-5">
              <form action="" method="post">

                <div class="row">

                  <!-- Primera Columna -->
                  <div class="col-md-6">

                    <div class="form-group">
                      <label for="id_activo_fk">Activo</label>
                      <input class="form-control" list="datalistActivo" id="id_activo_fk" placeholder="Equipo de Computo" name="id_activo_fk" required>
                      <datalist id="datalistActivo">
                        <?php
                        try {
                          $recursos = "Computador";
                          $stmt = $conn->prepare('
        SELECT a.*, u.*
        FROM activos a
        INNER JOIN usuarios u ON a.id_usuario_fk = u.Id_usuario
        WHERE a.recurso_tecnologico = :recursos
        AND a.id_activo NOT IN (SELECT id_activo_fk FROM detalles_equipos)
    ');
                          $stmt->bindParam(':recursos', $recursos, PDO::PARAM_STR);
                          $stmt->execute();

                          if ($stmt->rowCount() > 0) {
                            while ($row = $stmt->fetch()) {
                              $id_activo = $row["id_activo"];
                              $nombre_articulo = $row["nombre_articulo"];
                              $nombre_usuario = $row["nombre_usuario"];
                              $apellidos_usuario = $row["apellidos_usuario"];
                              $lugar_articulo = $row["lugar_articulo"];

                              echo "<option value='" . $id_activo . "'>" . $id_activo . " - " . $nombre_articulo . " - " . $nombre_usuario . " " . $apellidos_usuario . " - " . $lugar_articulo . "</option>";
                            }
                          } else {
                            echo '<option value="0">No existen Usuarios </option>';
                          }
                        } catch (PDOException $e) {
                          echo "Error en el servidor";
                        }
                        ?>
                      </datalist>
                    </div>

                    <div class="form-group">
                      <label for="msd">MSD</label>
                      <input type="text" class="form-control" id="msd" name="msd" placeholder="MSD">
                    </div>

                    <div class="form-group">
                      <label for="antivirus">Antivirus</label>
                      <input type="text" class="form-control" id="antivirus" name="antivirus" placeholder="Antivirus">
                    </div>

                    <div class="form-group">
                      <label for="visio_pro">Visio Pro</label>
                      <input type="text" class="form-control" id="visio_pro" name="visio_pro" placeholder="Visio Pro">
                    </div>

                    <div class="form-group">
                      <label for="mac_osx">Mac OSX</label>
                      <input type="text" class="form-control" id="mac_osx" name="mac_osx" placeholder="Mac OSX">
                    </div>

                    <div class="form-group">
                      <label for="windows">Windows</label>
                      <input type="text" class="form-control" id="windows" name="windows" placeholder="Windows">
                    </div>

                    <div class="form-group">
                      <label for="autocad">AutoCAD</label>
                      <input type="text" class="form-control" id="autocad" name="autocad" placeholder="AutoCAD">
                    </div>

                    <div class="form-group">
                      <label for="office">Office</label>
                      <input type="text" class="form-control" id="office" name="office" placeholder="Office">
                    </div>

                    <!-- Agrega más campos según sea necesario -->

                  </div>

                  <!-- Segunda Columna -->
                  <div class="col-md-6">

                    <div class="form-group">
                      <label for="appolo">Appolo</label>
                      <select class="form-control" id="appolo" name="appolo">
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="zeus">Zeus</label>
                      <select class="form-control" id="zeus" name="zeus">
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="otros">Otros</label>
                      <textarea class="form-control" id="otros" name="otros" placeholder="Otros"></textarea>
                    </div>

                    <div class="form-group">
                      <label for="procesador">Procesador</label>
                      <input type="text" class="form-control" id="procesador" name="procesador" placeholder="Procesador">
                    </div>

                    <div class="form-group">
                      <label for="disco_duro">Disco Duro</label>
                      <input type="text" class="form-control" id="disco_duro" name="disco_duro" placeholder="Disco Duro">
                    </div>

                    <div class="form-group">
                      <label for="memoria_ram">Memoria RAM</label>
                      <input type="text" class="form-control" id="memoria_ram" name="memoria_ram" placeholder="Memoria RAM">
                    </div>

                    <div class="form-group">
                      <label for="cd_dvd">CD/DVD</label>
                      <input type="text" class="form-control" id="cd_dvd" name="cd_dvd" placeholder="CD/DVD">
                    </div>
                    <!-- Agrega más campos según sea necesario -->
                  </div>
                </div>
                <div class="row">
                  <!-- Tercera Columna -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tarjeta_video">Tarjeta de Video</label>
                      <input type="text" class="form-control" id="tarjeta_video" name="tarjeta_video" placeholder="Tarjeta de Video">
                    </div>
                    <div class="form-group">
                      <label for="tarjeta_red">Tarjeta de Red</label>
                      <input type="text" class="form-control" id="tarjeta_red" name="tarjeta_red" placeholder="Tarjeta de Red">
                    </div>
                    <div class="form-group">
                      <label for="tipo_red">Tipo de Red</label>
                      <select class="form-control" id="tipo_red" name="tipo_red">
                        <option value="Cableada">Cableada</option>
                        <option value="Wifi">Wifi</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="tiempo_bloqueo">Tiempo de Bloqueo</label>
                      <select class="form-control" id="tiempo_bloqueo" name="tiempo_bloqueo">
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                    <!-- Agrega más campos según sea necesario -->
                  </div>
                  <!-- Cuarta Columna -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="usuario">Usuario</label>
                      <select class="form-control" id="usuario" name="usuario">
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="clave">Clave</label>
                      <select class="form-control" id="clave" name="clave">
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="zfip">ZFIP</label>
                      <select class="form-control" id="zfip" name="zfip">
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="privilegios">Privilegios</label>
                      <select class="form-control" id="privilegios" name="privilegios">
                        <option value="Estandar">Estandar</option>
                        <option value="Administrador">Administrador</option>
                      </select>
                    </div>
                    <!-- Agrega más campos según sea necesario -->
                  </div>
                </div>
                <div class="row">
                  <!-- Quinta Columna -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="backup">Backup</label>
                      <input type="text" class="form-control" id="backup" name="backup" placeholder="Backup">
                    </div>
                    <div class="form-group">
                      <label for="dia_backup">Día de Backup</label>
                      <select class="form-control" id="dia_backup" name="dia_backup">
                        <option value="Lunes">Lunes</option>
                        <option value="Martes">Martes</option>
                        <option value="Miercoles">Miércoles</option>
                        <option value="Jueves">Jueves</option>
                        <option value="Viernes">Viernes</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="realiza_backup">¿Realiza copias de seguridad en otro equipo?</label>
                      <select class="form-control" id="realiza_backup" name="realiza_backup">
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                  </div>
                  <!-- Sexta Columna -->
                  <div class="col-md-6">

                    <div class="form-group">
                      <label for="justificacion_backup">Justificación del Backup</label>
                      <textarea class="form-control" id="justificacion_backup" name="justificacion_backup" placeholder="Justificación del Backup"></textarea>
                    </div>


                    <!-- Agrega más campos según sea necesario -->
                  </div>
                </div>

                <!-- Botones -->
                <div class="form-group">
                  <button type="button" class="btn btn-success" id="asignacion">Enviar</button>
                  <button type="reset" class="btn btn-secondary">Limpiar</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
         

        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.content-wrapper -->
<?php require('footer.php'); ?>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>

<!-- ./wrapper -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>



<!-- MODAL PARA ASIGNAR EQUIPO DE COMPUTO -->


<div class="modal fade" id="ModalAsignarE" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asignación de Equipo de Computo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-asignacion">
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Fecha</label>
              <input type="date" class="form-control"  id="fecha_asignacion"  name="fecha_asignacion" required>
        </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Usuario Responsable</label>
              <input   class="form-control" list="datalistOptions" id="id_usuario_fk" placeholder="ID Usuario" name="id_usuario_fk" required>
              <datalist id="datalistOptions">
                <?php
                try {
                  $stmt = $conn->prepare('SELECT * FROM  usuarios');
                  $stmt->execute();
                  $registros = 1;
                  if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch()) {
                      $Id_usuario = $row["Id_usuario"];
                      $nombre_usuario = $row["nombre_usuario"];
                      $apellidos_usuario = $row["apellidos_usuario"];
                      echo "<option value=" . $Id_usuario . ">" . $nombre_usuario . " " . $apellidos_usuario . " </option>";
                    }
                  } else {
                    echo '<option value="0">No existen Usuarios </option>';
                  }
                } catch (PDOException $e) {
                  echo "Error en el servidor";
                }
                ?>
              </datalist>
            </div>
            <div class="form-group col-md-12">
              <label for="inputEmail4">Observaciones</label>
              <textarea class="form-control" name="observaciones_asignacion" id="observaciones_asignacion"></textarea>
          </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-danger" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn bg-success" id="guardar_asignacion" data-dismiss="modal">Asignar Equipo</button>
        </div>
      </form>
    </div>
  </div>
</div>
</body>

</html>
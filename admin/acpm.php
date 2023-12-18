<?php
session_start();
if ($_SESSION['ingreso'] == true) {
  require('php/conexion.php');
  require('plantilla.php');

  if (isset($_POST['enviar_verificacion'])) {
    $id_consecutivo = $_POST['id_acpm'];
    try {
     
        // Construye y ejecuta la consulta UPDATE con parámetros
        $stmt = $conn->prepare("UPDATE acpm
        SET estado_acpm = 'abierta'
        WHERE id_consecutivo  = :id_acpm");
        
        $stmt->bindParam(':id_acpm', $id_consecutivo, PDO::PARAM_INT);
        $stmt->execute();
    
        $registros = $stmt->rowCount();
    
        if ($registros > 0) {
            echo "<script>
            Swal.fire({
							title: 'Buen Trabajo',
							text: 'Su respuesta se registro con éxito',
							icon: 'success',
						}).then((result) => {
							// Redirige a la página después de cerrar el SweetAlert
							if (result.isConfirmed) {
								window.location.href = '';
							}
						});
            </script>";
        }
        
    } catch (Exception $e) {
        echo "ERROR: " . $e->getMessage();
    
    }
    
    }
?>


  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a data-toggle="tab" href="#panelc" class="nav-link active">
          <i class="nav-icon fas fa-tachometer-alt"></i>

          <p>
            Panel de Control
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a data-toggle="tab" href="#acpm" class="nav-link ">
          <i class="nav-icon fas fa-file-medical"></i>
          <p>
            Nueva ACPM
            <span class="right badge badge-success">Nueva</span>
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-search-plus"></i>
          <p>
            Consultas
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item" name="verificacion">
            <a data-toggle="tab" href="#verificacion" class="nav-link">
              <i class="nav-icon fas fa-sync-alt"></i>
              <p>Acciones en Verificación</p>
            </a>
          </li>
          <li class="nav-item">
            <a data-toggle="tab" href="#abiertas" class="nav-link">
              <i class="nav-icon far fa-question-circle"></i>
              <p>Acciones Abiertas</p>
            </a>
          </li>
          <li class="nav-item" name="cerradas">
            <a data-toggle="tab" href="#cerradas" class="nav-link">
              <i class="nav-icon far fa-check-circle"></i>
              <p>Acciones Cerradas</p>
            </a>
          </li>
          <li class="nav-item" name="rechazadas">
            <a data-toggle="tab" href="#rechazadas" class="nav-link">
              <i class="nav-icon far fa-times-circle"></i>
              <p>Acciones Rechazadas</p>
            </a>
          </li>
          <li class="nav-item" name="proceso">
            <a data-toggle="tab" href="#proceso" class="nav-link">
              <i class="nav-icon fas fa-sync-alt"></i>
              <p>Acciones en Proceso</p>
            </a>
          </li>

        </ul>
      </li>
      <li class="nav-item" name="actividades_asignadas">
            <a data-toggle="tab" href="javascript:void(0);" onclick="redirectActividadesUsuario()" class="nav-link">
            <i class="nav-icon fas fa-user-check"></i>
              Actividades Asignadas
            </a>
          </li>
      <!-- /.ESTA PARTE PERTENECE SOLO A SIG -->
      <li class="nav-item">
        <a data-toggle="tab" href="#aceptar_acpm" class="nav-link ">
          <i class="nav-icon fas fa-question-circle"></i>
          <p>
            Aprobar ACPM
            <span class="right badge badge-danger">Urgente</span>
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a data-toggle="tab" href="#aprobacion" class="nav-link ">
          <i class="nav-icon fas fa-clipboard-check"></i>
          <p>
            Verificar ACPM
            <span class="right badge badge-danger">Urgente</span>
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
          <div class="col-lg-12 col-md-12">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">TUS ACPM</h3>
                  <a href="javascript:void(0);">Ver Reporte</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 
                    </span>
                    <span class="text-muted">Completa las Metas</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="sales-chart" height="200"></canvas>
                </div>

               
              </div>
            </div>
            
          </div>
          </div>
          <!-- DIV DONDE SE MOSTRARA EL FORMULARIO PARA UNA NUEVA ACPM -->
          <div class="tab-pane " id="acpm">
            <form id="form_acpm" method="POST">
              <div class="card card-navy">
                <div class="card-header">
                  <center>
                    <h4>Nueva Accion Correctiva, Preventiva o de Mejora</h4>
                  </center>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 col-xs-6 col-sm-6" hidden>
                      <label>Id Usuario</label>
                      <input type="text" name="id_usuario_fk" id="id_usuario_fk" value="<?php echo $_SESSION['Id'] ?>" class="form-control" readonly>
                    </div>
                    <div class="col-md-6 col-xs-6 col-sm-6">
                      <label>Nombre del Resposable</label>
                      <input type="text" name="" value="<?php echo $_SESSION['nombre_usuario'] . " " . $_SESSION['apellidos_usuario'] ?>" class="form-control" readonly>
                    </div>
                    <div class="col-md-6 col-xs-6 col-sm-6">
                      <label>Cargo</label>
                      <input type="text" name="" value="<?php echo $_SESSION['nombre_cargo'] ?>" class="form-control" readonly>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12">
                      <label>Origen ACPM</label>
                      <textarea class="form-control" id="origen_acpm" name="origen_acpm" rows="3" required></textarea>
                    </div>
                    <div class="col-2 col-xs-12 col-sm-12">
                      <label>Fuente</label>
                      <select class="form-control" id="fuente_acpm" name="fuente_acpm" required>
                        <option value="AI">Auditoria Interna</option>
                        <option value="AE">Auditoria Externa</option>
                        <option value="Otros">Otros</option>
                      </select>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12" id="fuente">
                      <label>Descripcion Fuente</label>
                      <textarea class="form-control" id="descripcion_fuente" name="descripcion_fuente" rows="3"></textarea>
                    </div>
                    <div class="col-2 col-xs-12 col-sm-12">
                      <label>Tipo de Reporte</label>
                      <select class="form-control" id="tipo_acpm" name="tipo_acpm" required>
                        <option value="AM">Acción de Mejora</option>
                        <option value="AC">Acción Correctiva</option>
                        <option value="AP">Acción Preventiva</option>

                      </select>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12">
                      <label>Descripción ACPM</label>
                      <textarea class="form-control" id="descripcion_acpm" name="descripcion_acpm" rows="3" required></textarea>
                    </div>
                    <div class="col-12 bg-navy pt-2 mt-3 col-xs-12 col-sm-12">
                      <center>
                        <h5>Análisis del Hallazgo</h5>
                      </center>

                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12">
                      <label>Análisis de Causa (Técnicas de los por ques, espina de pescado, lluvia de ideas, etc)</label>
                      <textarea class="form-control" id="causa_acpm" name="causa_acpm" rows="3"></textarea>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12">
                      <label>¿Se identifican No Conformidades similares o que potencialmente puedan ocurrir en otro proceso?</label>
                      <select class="form-control" id="nc_similar" name="nc_similar" required>
                        <option>Selecciona una Opcion</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12" id="similares">
                      <label>Describe cuales y en que proceso</label>
                      <textarea class="form-control" id="descripcion_nsc" name="descripcion_nsc" rows="3"></textarea>
                    </div>
                    <div class="col-12 bg-navy pt-2 mt-3 col-xs-12 col-sm-12">
                      <center>
                        <h5>Plan de Mejora</h5>
                      </center>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12" id="correccion">
                      <div class="col-md-12 col-xs-12 col-sm-12">
                        <label>Fecha Correcion</label>
                        <input type="date" name="fecha_correccion" class="form-control" id="fecha_correccion" required>
                      </div>
                      <div class="col-md-12 col-xs-12 col-sm-12">
                        <label>Corrección ACPM</label>
                        <textarea class="form-control" id="correccion_acpm" name="correccion_acpm" rows="3" required></textarea>
                      </div>
                    </div>

                    <div class="col-md-12 col-xs-12 col-sm-12">
                      <label>Se identificó peligros de SST nuevos o que han cambiado, o la necesidad de generar controles nuevos o modificar los existentes</label>
                      <select class="form-control" id="riesgo_acpm" name="riesgo_acpm" required>
                        <option>Selecciona una Opcion</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12" id="riesgos">
                      <label>Describa cuales son los riegos</label>
                      <textarea class="form-control" id="justificacion_riesgo" name="justificacion_riesgo" rows="3"></textarea>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12">
                      <label>Fecha Finalización (Fecha en la cual la acción debe estar cerrada)</label>
                      <input type="date" name="fecha_finalizacion" class="form-control" id="fecha_finalizacion" required>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="col-md-12 col-xs-12 col-sm-12">
                  <button type="button" class="btn btn-success btn-block " id="enviar_acpm" name="enviar_acpm">Radicar ACPM</button>
                </div>
              </div>

            </form>
            <!-- /.card -->
          </div>
          <!-- DIV DONDE TERMINA EL FORMULARIO DE ACPM-->
          <div class="tab-pane  show " id="verificacion">
            <div class="row">
              <div class="col-lg-12 ">
                <div class="card">
                  <div class="card-header border-0 bg-primary">
                    <h3 class="card-title">ACPM en Verificación</h3>

                  </div>
                  <div class="card-body table-responsive p-0">
                    <table class="display table table-striped table-valign-middle " width="100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nombre del responsable</th>
                          <th>Origen Acpm</th>
                          <th>Fuente</th>
                          <th>Tipo de Reporte</th>
                          <th>Descripcion Acpm</th>
                          <th>Fecha Correcion</th>
                          <th>Fecha Finalizacion</th>
                          <th>Estado</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($conn->query("SELECT * from acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario WHERE estado_acpm = 'Verificacion' AND a.id_usuario_fk ='" . $id_usuario_fk . "'") as $row) { { ?>
                            <tr style=text-align:center>
                              <td><?php echo $row["id_consecutivo"] ?></td>
                              <td><?php echo $row["nombre_usuario"] . " " . $row["apellidos_usuario"] ?></td>
                              <td>
                                <p class="text-break" style="width: 10rem">
                                  <?php
                                  $origen_acpm = $row["origen_acpm"];
                                  $max_caracteres = 50; // Cambia esto al número máximo de caracteres que deseas mostrar
                                  echo strlen($origen_acpm) > $max_caracteres ? substr($origen_acpm, 0, $max_caracteres) . "..." : $origen_acpm;
                                  ?>
                                </p>
                              </td>
                              <td><?php echo $row["fuente_acpm"] ?></td>
                              <td><?php echo $row["tipo_acpm"] ?></td>
                              <td>
                                <p class="text-break" style="width: 10rem">
                                  <?php
                                  $descripcion_acpm = $row["descripcion_acpm"];
                                  $max_caracteres = 50; // Cambia esto al número máximo de caracteres que deseas mostrar
                                  echo strlen($descripcion_acpm) > $max_caracteres ? substr($descripcion_acpm, 0, $max_caracteres) . "..." : $descripcion_acpm;
                                  ?>
                                </p>
                              </td>
                              <td><?php echo $row["fecha_correccion"] ?></td>
                              <td><?php echo $row["fecha_finalizacion"] ?></td>
                              <td><?php echo $row["estado_acpm"] ?></td>
                            </tr>
                        <?php }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- DIV DONDE SE MUESTRAN LAS ACCIONES ABIERTAS DE CADA USUARIO-->
          <div id="abiertas" class="tab-pane">
            <div class="row">
              <div class="col-lg-12 ">
                <div class="card">
                  <div class="card-header border-0 bg-primary">
                    <h3 class="card-title">ACPM Abiertas</h3>
                    <div class="card-tools">
                    </div>
                  </div>
                  <div class="card-body table-responsive p-0">
                    <table class="display table table-striped table-valign-middle " width="100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Origen</th>
                          <th>Fuente</th>
                          <th>Tipo de Reporte</th>
                          <th>Descripción </th>
                          <th>Fecha Corrección</th>
                          <th>Fecha Finalización</th>
                          <th>Estado</th>
                          <th>Informe</th>
                          <th>Asignar</th>
                          <th>Actividades</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($conn->query("SELECT * from acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario WHERE estado_acpm = 'Abierta' AND a.id_usuario_fk ='" . $id_usuario_fk . "'") as $row) { {
                            $id_acpm = $row["id_consecutivo"];
                            $descripcion = $row["descripcion_acpm"];
                        ?>
                            <tr style=text-align:center>
                              <td><?php echo $row["id_consecutivo"] ?></td>
                              <td>
                                <p class="text-break" style="width: 10rem">
                                  <?php
                                  $origen_acpm = $row["origen_acpm"];
                                  $max_caracteres = 50; // Cambia esto al número máximo de caracteres que deseas mostrar
                                  echo strlen($origen_acpm) > $max_caracteres ? substr($origen_acpm, 0, $max_caracteres) . "..." : $origen_acpm;
                                  ?>
                                </p>
                              </td>
                              <td><?php echo $row["fuente_acpm"] ?></td>
                              <td><?php echo $row["tipo_acpm"] ?></td>
                              <td>
                                <p class="text-break" style="width: 10rem">
                                  <?php
                                  $descripcion_acpm = $row["descripcion_acpm"];
                                  $max_caracteres = 50; // Cambia esto al número máximo de caracteres que deseas mostrar
                                  echo strlen($descripcion_acpm) > $max_caracteres ? substr($descripcion_acpm, 0, $max_caracteres) . "..." : $descripcion_acpm;
                                  ?>
                                </p>
                              </td>
                              <td><?php echo $row["fecha_correccion"] ?></td>
                              <td><?php echo $row["fecha_finalizacion"] ?></td>
                              <td><?php echo $row["estado_acpm"] ?></td>
                              <td><a href='informe_acpm.php?id_acpm=<?php echo $id_acpm; ?>' target='_blank'> <button class='btn bg-danger'><i class="far fa-file-pdf"></i> </button></a></td>

                              <td><button type="button" class="btn bg-warning" id="asignar_actividad" name="asignar_actividad" data-toggle="modal" data-target="#modal-success" data-id_acpm_fk="<?php echo $row['id_consecutivo'] ?>"><i class="fas fa-user-check"></i></button></a></td>
                              <td><a href="enviar_actividades.php?id_acpm=<?php echo $id_acpm; ?>&descripcion=<?php echo $descripcion; ?>"><button type="button" class="btn bg-info" id="idConsecutivo" name="idConsecutivo"><i class="fas fa-clipboard-list"></i></button></a></td>
                            </tr>
                        <?php }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <!-- /.card -->
          </div>
          <!-- /.modal -->
          <section class="content">
            <div class="modal fade" id="modal-success">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header btn bg-info btn-block">
                    <h4 class="modal-title">ASIGNAR ACTIVIDAD</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <form id="form_actividades" method="POST">
                        <div class="card">
                          <div class="card-header">
                            <label>Desea Asignar actividades a la siguiente ACPM:</label><input type="text" class="form-control" value="" name="id_acpm_fk" id="id_acpm_fk" readonly>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-12 col-xs-12 col-sm-12">
                                <label for="fecha_actividad">Fecha vencimiento de la Actividad</label>
                                <input type="date" name="fecha_actividad" class="form-control" id="fecha_actividad" required>
                              </div>
                              <div class="col-md-12 col-xs-12 col-sm-12" id="fuente">
                                <label for="descripcion_actividad">Descripción de la Actividad</label>
                                <textarea class="form-control" id="descripcion_actividad" name="descripcion_actividad"></textarea>
                              </div>
                              <div class="col-2 col-xs-12 col-sm-12">
                                <label for="estado_actividad">Estado de la Actividad</label><input type="text" class="form-control" value="incompleta" name="estado_actividad" id="estado_actividad" readonly>
                              </div>
                              <div class="col-2 col-xs-12 col-sm-12">
                                <label for="id_usuario">Nombre del Responsable:</label>
                                <input list="browsers" id="id_responsable" name="id_responsable" class="form-control" placeholder="Nombre del responsable" required>
                                <datalist id="browsers">
                                  <?php
                                  try {
                                    $stmt = $conn->prepare('SELECT * FROM  usuarios ');
                                    $stmt->execute();
                                    if ($stmt->rowCount() > 0) {
                                      while ($row = $stmt->fetch()) {
                                        $id_usuario = $row["Id_usuario"];
                                        $nombre_usuario = $row["nombre_usuario"];
                                        $apellidos_usuario = $row["apellidos_usuario"];
                                        echo '<option value=' . $id_usuario . '>' . $nombre_usuario . ' ' . $apellidos_usuario . '</option>';
                                      }
                                    }
                                  } catch (PDOException $e) {
                                    echo "Error en el servidor";
                                  }
                                  ?>
                                </datalist>
                              </div>
                              <div class="col-2 col-xs-12 col-sm-12" hidden>
                                <label for="id_acpm">ID acpm</label>
                                <input type="number" class="form-control" value="<?php echo $id_acpm; ?>" name="id_acpm" id="id_acpm_fk">
                              </div>
                            </div>
                            <!-- /.card-body -->
                            <br>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                              <button type="button" class="btn bg-info btn-block " id="enviar_actividad" name="enviar_actividad">Asignar Actividad</button>
                            </div>
                          </div>
                      </form>
                      <!-- /.modal-content -->
                      <!-- /.card-body -->
                    </div>
                  </div>
                  <!-- /.modal-dialog -->
                </div>
              </div>
              <!-- /.modal -->
          </section>
          <!-- TERMINA LAS ACPM ABIERTAS-->
          <!-- DIV DONDE SE MUESTRAN LAS ACCIONES CERRADAS DE CADA USUARIO-->
          <div id="cerradas" class="tab-pane ">
            <div class="row">
              <div class="col-lg-12 ">
                <div class="card">
                  <div class="card-header border-0 bg-primary">
                    <h3 class="card-title">ACPM Cerradas</h3>
                    <div class="card-tools">
                    </div>
                  </div>
                  <div class="card-body table-responsive p-0">
                    <table class="display table table-striped table-valign-middle " width="100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nombre del responsable</th>
                          <th>Origen Acpm</th>
                          <th>Fuente</th>
                          <th>Tipo de Reporte</th>
                          <th>Descripcion Acpm</th>
                          <th>Fecha Correcion</th>
                          <th>Fecha Finalizacion</th>
                          <th>Estado</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($conn->query("SELECT * from acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario WHERE estado_acpm = 'Cerrada' AND a.id_usuario_fk ='" . $id_usuario_fk . "'") as $row) { { ?>
                            <tr style=text-align:center>
                              <td><?php echo $row["id_consecutivo"] ?></td>
                              <td><?php echo $row["nombre_usuario"] . " " . $row["apellidos_usuario"] ?></td>
                              <td>
                                <p class="text-break" style="width: 10rem">
                                  <?php
                                  $origen_acpm = $row["origen_acpm"];
                                  $max_caracteres = 50; // Cambia esto al número máximo de caracteres que deseas mostrar
                                  echo strlen($origen_acpm) > $max_caracteres ? substr($origen_acpm, 0, $max_caracteres) . "..." : $origen_acpm;
                                  ?>
                                </p>
                              </td>
                              <td><?php echo $row["fuente_acpm"] ?></td>
                              <td><?php echo $row["tipo_acpm"] ?></td>
                              <td>
                                <p class="text-break" style="width: 10rem">
                                  <?php
                                  $descripcion_acpm = $row["descripcion_acpm"];
                                  $max_caracteres = 50; // Cambia esto al número máximo de caracteres que deseas mostrar
                                  echo strlen($descripcion_acpm) > $max_caracteres ? substr($descripcion_acpm, 0, $max_caracteres) . "..." : $descripcion_acpm;
                                  ?>
                                </p>
                              </td>
                              <td><?php echo $row["fecha_correccion"] ?></td>
                              <td><?php echo $row["fecha_finalizacion"] ?></td>
                              <td><?php echo $row["estado_acpm"] ?></td>
                            </tr>
                        <?php }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <!-- DIV DONDE SE MUESTRAN LAS ACCIONES RECHAZADAS DE CADA USUARIO-->
          <div id="rechazadas" class="tab-pane">
            <div class="row">
              <div class="col-lg-12 ">
                <div class="card">
                  <div class="card-header border-0 bg-primary">
                    <h3 class="card-title">ACPM Rechazadas</h3>
                    <div class="card-tools">
                    </div>
                  </div>
                  <div class="card-body table-responsive p-0">
                    <table class="display table table-striped table-valign-middle " width="100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nombre del responsable</th>
                          <th>Origen Acpm</th>
                          <th>Fuente</th>
                          <th>Tipo de Reporte</th>
                          <th>Descripcion Acpm</th>
                          <th>Fecha Finalizacion</th>
                          <th>Estado</th>
                          <th>Editar</th>
                          <th>Actividades</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($conn->query("SELECT * from acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario WHERE estado_acpm = 'Rechazada' AND a.id_usuario_fk ='" . $id_usuario_fk . "'") as $row) { { ?>
                            <tr style=text-align:center>
                              <td><?php echo $row["id_consecutivo"] ?></td>
                              <td><?php echo $row["nombre_usuario"] . " " . $row["apellidos_usuario"] ?></td>
                              <td>
                                <p class="text-break" style="width: 10rem">
                                  <?php
                                  $origen_acpm = $row["origen_acpm"];
                                  $max_caracteres = 50; // Cambia esto al número máximo de caracteres que deseas mostrar
                                  echo strlen($origen_acpm) > $max_caracteres ? substr($origen_acpm, 0, $max_caracteres) . "..." : $origen_acpm;
                                  ?>
                                </p>
                              </td>
                              <td><?php echo $row["fuente_acpm"] ?></td>
                              <td><?php echo $row["tipo_acpm"] ?></td>
                              <td>
                                <p class="text-break" style="width: 10rem">
                                  <?php
                                  $descripcion_acpm = $row["descripcion_acpm"];
                                  $max_caracteres = 50; // Cambia esto al número máximo de caracteres que deseas mostrar
                                  echo strlen($descripcion_acpm) > $max_caracteres ? substr($descripcion_acpm, 0, $max_caracteres) . "..." : $descripcion_acpm;
                                  ?>
                                </p>
                              </td>
                           
                              <td><?php echo $row["fecha_finalizacion"] ?></td>
                              <td><?php echo $row["estado_acpm"] ?></td>
                              <td>Boton editar</td>
                              <td><a href="enviar_actividades.php?id_acpm=<?php echo $id_acpm; ?>&descripcion=<?php echo $descripcion; ?>"><button type="button" class="btn bg-warning" id="idConsecutivo" name="idConsecutivo"><i class="fas fa-edit"></i></button></a></td>
                            </tr>
                        <?php }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- DIV DONDE SE MUESTRAN LAS ACCIONES EN PROCESO DE CADA USUARIO YA CUENTA CON RESPONSIVE-->
          <div id="proceso" class="tab-pane">
            <div class="row">
              <div class="col-lg-12 ">
                <div class="card">
                  <div class="card-header border-0 bg-primary">
                    <h3 class="card-title">ACPM en Proceso</h3>
                    <div class="card-tools">
                    </div>
                  </div>
                  <div class="card-body table-responsive p-0">
                    <table class="display table table-striped table-valign-middle " width="100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nombre del responsable</th>
                          <th>Origen Acpm</th>
                          <th>Fuente</th>
                          <th>Tipo de Reporte</th>
                          <th>Descripcion Acpm</th>
                          <th>Fecha Correcion</th>
                          <th>Fecha Finalizacion</th>
                          <th>Estado</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($conn->query("SELECT * from acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario WHERE estado_acpm = 'Proceso' AND a.id_usuario_fk ='" . $id_usuario_fk . "'") as $row) { { ?>
                            <tr style=text-align:center>
                              <td><?php echo $row["id_consecutivo"] ?></td>
                              <td><?php echo $row["nombre_usuario"] . " " . $row["apellidos_usuario"] ?></td>
                              <td>
                                <p class="text-break" style="width: 10rem">
                                  <?php
                                  $origen_acpm = $row["origen_acpm"];
                                  $max_caracteres = 20; // Cambia esto al número máximo de caracteres que deseas mostrar
                                  echo strlen($origen_acpm) > $max_caracteres ? substr($origen_acpm, 0, $max_caracteres) . "..." : $origen_acpm;
                                  ?>
                                </p>
                              </td>
                              <td><?php echo $row["fuente_acpm"] ?></td>
                              <td><?php echo $row["tipo_acpm"] ?></td>
                              <td>
                                <p class="text-break" style="width: 10rem">
                                  <?php
                                  $descripcion_acpm = $row["descripcion_acpm"];
                                  $max_caracteres = 50; // Cambia esto al número máximo de caracteres que deseas mostrar
                                  echo strlen($descripcion_acpm) > $max_caracteres ? substr($descripcion_acpm, 0, $max_caracteres) . "..." : $descripcion_acpm;
                                  ?>
                                </p>
                              </td>
                              <td><?php echo $row["fecha_correccion"] ?></td>
                              <td><?php echo $row["fecha_finalizacion"] ?></td>
                              <td><span class="badge badge-warning"><?php echo $row["estado_acpm"] ?></span></td>
                            </tr>
                        <?php }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- DIV DONDE SE MUESTRAN LAS ACTIVIDADES ASIGNADAS AL USUARIO-->
          <div id="actividades_asignadas" class="tab-pane">
            <div class="row">
              <div class="col-lg-12 ">
                <div class="card">
                  <div class="card-header border-0 bg-primary">
                    <h3 class="card-title">Actividades Asignadas</h3>
                    <div class="card-tools">
                    </div>
                  </div>
                  <div class="card-body table-responsive p-0">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- DIV DONDE SE MUESTRAN LAS ACCIONES POR VERIFICAR DE CADA USUARIO-->
          <div id="aprobacion" class="tab-pane">
            <div class="row">
              <div class="col-lg-12 ">
                <div class="card">
                  <div class="card-header border-0 bg-primary">
                    <h3 class="card-title">Verificar ACPM</h3>
                    <div class="card-tools">
                    </div>
                  </div>
                  <div class="card-body table-responsive p-0">
                    <table class="display table table-striped table-valign-middle " width="100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nombre del responsable</th>
                          <th>Origen Acpm</th>
                          <th>Fuente</th>
                          <th>Tipo de Reporte</th>
                          <th>Descripción Acpm</th>
                          <th>Fecha Finalización</th>
                          <th>Estado</th>
                          <th>Informe</th>
                          <th>Responder</th>
                          <th>Rechazar</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($conn->query("SELECT * from acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario WHERE estado_acpm = 'Proceso'") as $row) { {
                            $id_acpm = $row["id_consecutivo"];
                            $estado_acpm_sig = $row["estado_acpm"];
                            $fechaOriginal = $row["fecha_finalizacion"];
                            // Crear un objeto DateTime con la fecha original
                            $fechaObjeto = new DateTime($fechaOriginal);
                            // Formatear la fecha al formato deseado
                            $fecha_finalizacion = $fechaObjeto->format('d/m/Y');
                        ?>
                            <tr style=text-align:center>
                              <td><?php echo $row["id_consecutivo"] ?></td>
                              <td><?php echo $row["nombre_usuario"] . " " . $row["apellidos_usuario"] ?></td>
                              <td>
                                <p class="text-break" style="width: 10rem">
                                  <?php
                                  $origen_acpm = $row["origen_acpm"];
                                  $max_caracteres = 50; // Cambia esto al número máximo de caracteres que deseas mostrar
                                  echo strlen($origen_acpm) > $max_caracteres ? substr($origen_acpm, 0, $max_caracteres) . "..." : $origen_acpm;
                                  ?>
                                </p>
                              </td>
                              <td><?php echo $row["fuente_acpm"] ?></td>
                              <td><?php echo $row["tipo_acpm"] ?></td>
                              <td>
                                <p class="text-break" style="width: 10rem">
                                  <?php
                                  $descripcion_acpm = $row["descripcion_acpm"];
                                  $max_caracteres = 50; // Cambia esto al número máximo de caracteres que deseas mostrar
                                  echo strlen($descripcion_acpm) > $max_caracteres ? substr($descripcion_acpm, 0, $max_caracteres) . "..." : $descripcion_acpm;
                                  ?>
                                </p>
                              </td>

                              <td><?php echo $fecha_finalizacion ?></td>
                              <td><?php echo $row["estado_acpm"] ?></td>
                              <td><a href='informe_acpm.php?id_acpm=<?php echo $id_acpm; ?>' target='_blank'> <button class='btn bg-danger'><i class="far fa-file-pdf"></i> </button></a></td>
                              <td><button class='btn btn-success' data-toggle="modal" data-target="#modal-respuesta"><i class="far fa-solid fa-paper-plane"></i></button></td>
                              <td><button class='btn bg-danger' data-toggle="modal" data-target="#modal-rechazo" id="rechazar" data-id_acpm_fk_sig="<?php echo $row['id_consecutivo'] ?>"><i class="fas fa-bomb"></i></button></td>
                            </tr>
                        <?php }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <div id="aceptar_acpm" class="tab-pane">
            <div class="row">
              <div class="col-lg-12 ">
                <div class="card">
                  <div class="card-header border-0 bg-primary">
                    <h3 class="card-title">Aprobar ACPM</h3>
                    <div class="card-tools">
                    </div>
                  </div>
                  <div class="card-body table-responsive p-0">
                    <table class="display table table-striped table-valign-middle " width="100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nombre del responsable</th>
                          <th>Origen Acpm</th>
                          <th>Fuente</th>
                          <th>Tipo de Reporte</th>
                          <th>Descripción Acpm</th>
                          <th>Fecha Finalización</th>
                          <th>Estado</th>
                          <th>Informe</th>
                          <th>Aprobar</th>
                          <th>Rechazar</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($conn->query("SELECT * from acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario WHERE estado_acpm = 'Verificacion'") as $row) { {
                            $id_acpm = $row["id_consecutivo"];
                            $id_consecutivo = $row["id_consecutivo"];
                            $estado_acpm_sig = $row["estado_acpm"];
                            $fechaOriginal = $row["fecha_finalizacion"];
                            // Crear un objeto DateTime con la fecha original
                            $fechaObjeto = new DateTime($fechaOriginal);
                            // Formatear la fecha al formato deseado
                            $fecha_finalizacion = $fechaObjeto->format('d/m/Y');
                        ?>
                            <tr style=text-align:center>
                              <td><?php echo $row["id_consecutivo"] ?></td>
                              <td><?php echo $row["nombre_usuario"] . " " . $row["apellidos_usuario"] ?></td>
                              <td>
                                <p class="text-break" style="width: 10rem">
                                  <?php
                                  $origen_acpm = $row["origen_acpm"];
                                  $max_caracteres = 50; // Cambia esto al número máximo de caracteres que deseas mostrar
                                  echo strlen($origen_acpm) > $max_caracteres ? substr($origen_acpm, 0, $max_caracteres) . "..." : $origen_acpm;
                                  ?>
                                </p>
                              </td>
                              <td><?php echo $row["fuente_acpm"] ?></td>
                              <td><?php echo $row["tipo_acpm"] ?></td>
                              <td>
                                <p class="text-break" style="width: 10rem">
                                  <?php
                                  $descripcion_acpm = $row["descripcion_acpm"];
                                  $max_caracteres = 50; // Cambia esto al número máximo de caracteres que deseas mostrar
                                  echo strlen($descripcion_acpm) > $max_caracteres ? substr($descripcion_acpm, 0, $max_caracteres) . "..." : $descripcion_acpm;
                                  ?>
                                </p>
                              </td>

                              <td><?php echo $fecha_finalizacion ?></td>
                              <td><?php echo $row["estado_acpm"] ?></td>
                              <td><a href='informe_acpm.php?id_acpm=<?php echo $id_acpm; ?>' target='_blank'> <button class='btn bg-danger'><i class="far fa-file-pdf"></i> </button></a></td>

                              <td>
                                <form action="" method="POST">
                                  <input type="number" name="id_acpm" value="<?php echo $row["id_consecutivo"] ?>" hidden>
                                  <button type="submit" class="btn btn-success "  name="enviar_verificacion"><i class="fas fa-user-check"></i></button>
                                </form>
                              </td>
                              <td><button class='btn bg-danger' data-toggle="modal" data-target="#modal-rechazo" id="rechazar" data-id_acpm_fk_sig="<?php echo $row['id_consecutivo'] ?>"><i class="fas fa-bomb"></i></button></td>
                            </tr>
                        <?php }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>

          <!-- /Modal para sig -->
          <section class="content">
            <div class="modal fade" id="modal-respuesta">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class=" btn btn-success btn-block">
                    <h4 class="modal-title ">EFICACIA</h4>
                  </div>
                  <div class="modal-body">
                    <form id="" method="POST" action="">
                      <div class="card card-navy">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                              <input type="text" value="<?php echo $id_acpm; ?>" name="id_acpm_sig" id="id_acpm_sig" hidden>
                              <label>SI (Conforme) NO (No conforme)</label>
                              <select class="form-control" id="riesgo_acpm_sig" name="riesgo_acpm_sig" required>
                                <option>Selecciona una Opcion</option>
                                <option value="Si">SI</option>
                                <option value="No">NO</option>
                              </select>
                            </div>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                              <br>
                              <div class="form-group">
                                <label>Justifique por que es o no es conforme</label>
                                <textarea type="text" id="justificacion_riesgo_sig" name="justificacion_riesgo_sig" class="form-control" required></textarea>
                              </div>
                            </div>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                              <label>¿Es necesario hacer cambios al sistema de gestión? (gestión del cambio) (SI - NO)</label>
                              <select class="form-control" id="cambios_sig" name="cambios_sig" required>
                                <option>Selecciona una Opcion</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                              </select>
                            </div>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                              <br>
                              <div class="form-group">
                                <label>¿Qué cambios se deben contemplar y documentar? Describa brevemente</label>
                                <textarea type="text" id="justificacion_sig" name="justificacion_sig" class="form-control" required></textarea>
                              </div>
                            </div>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                              <label>Conforme</label>
                              <select class="form-control" id="conforme_sig" name="conforme_sig" required>
                                <option>Selecciona una Opcion</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                              </select>
                            </div>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                              <br>
                              <div class="form-group">
                                <label>Justificacion Conforme o No conforme</label>
                                <textarea type="text" id="justificacion_conforme_sig" name="justificacion_conforme_sig" class="form-control" required></textarea>
                              </div>
                            </div>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                              <label for="fecha_estado">Fecha de Verificacion</label>
                              <input type="date" name="fecha_estado_sig" class="form-control" id="fecha_estado_sig" required>
                            </div>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                              <br>
                              <div class="form-group">
                                <td style="text-align: center;">
                                  <button type="button" class='btn btn-success' style="width: 100%;" id="guardar_sig" name="guardar">
                                    <i class="far fa-regular fa-thumbs-up">ENVIAR</i>
                                  </button>
                                </td>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
          </section>

          <section class="content">
            <div class="modal fade" id="modal-rechazo">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class=" btn bg-danger btn-block">
                    <h4 class="modal-title ">RECHAZAR</h4>
                  </div>
                  <div class="modal-body">
                    <form id="" method="POST" action="">
                      <div class="card card-navy">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                              <br>
                              <div class="form-group" style="text-align: center;">
                                <label>Describa el porque del rechazo</label>
                                <textarea type="text" id="descripcion_rechazo_sig" name="descripcion_rechazo_sig" class="form-control" required></textarea>
                              </div>
                            </div>
                            <div class="form-group">
                              <input type="text" name="id_acpm_fk_sig" id="id_acpm_fk_sig" class="form-control" hidden>
                            </div>
                            <br>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                              <br>
                              <div class="form-group">
                                <td style="text-align: center;">
                                  <button type="button" class='btn bg-danger' style="width: 100%;" id="rechazar_sig" name="rechazar_sig">
                                    <i class="fas fa-skull"> RECHAZAR</i>
                                  </button>
                                </td>
                              </div>
                            </div>
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
      <!-- CIERRE DEL TAB -->
    </div>
  </div>
</div>
</div>
<!-- /.content-wrapper -->
<?php require('footer.php'); ?>
<script>
    function redirectActividadesUsuario() {
        // Obtener los valores de las variables PHP
        var id_acpm = <?php echo json_encode($id_acpm); ?>;
        var descripcion = <?php echo json_encode($descripcion); ?>;

        // Redireccionar con las variables
        window.location.href = "actividades_usuario.php?id_acpm=" + id_acpm + "&descripcion=" + descripcion;
    }
</script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- ./wrapper -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<script>
  $(document).ready(function() {
    $("#similares").hide();
    $("#fuente").hide();
    $("#riesgos").hide();
    $("#correccion").hide();


    $("#nc_similar").change(function() {
      var seleccion = $(this).val();

      if (seleccion === "Si") {
        $("#similares").show();
      } else {
        $("#similares").hide();
      }
    });
    $("#fuente_acpm").change(function() {
      var seleccion = $(this).val();

      if (seleccion === "Otros") {
        $("#fuente").show();
      } else {
        $("#fuente").hide();
      }
    });
    $("#riesgo_acpm").change(function() {
      var seleccion = $(this).val();

      if (seleccion === "Si") {
        $("#riesgos").show();
      } else {
        $("#riesgos").hide();
      }
    });
    $("#tipo_acpm").change(function() {
      var seleccion = $(this).val();

      if (seleccion === "AC" || seleccion === "AP") {
        $("#correccion").show();
      } else {
        $("#correccion").hide();
      }
    });
  });
  $('#modal-evidencia').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id_actividad = button.data('id_actividad'); // Extract info from data-* attributes

    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);

    modal.find('.modal-body #id_actividad').val(id_actividad);
  });
  $('#modal-success').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id_acpm_fk = button.data('id_acpm_fk'); // Extract info from data-* attributes

    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);

    modal.find('.modal-body #id_acpm_fk').val(id_acpm_fk);
  });

  $('#modal-rechazo').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id_acpm_fk_sig = button.data('id_acpm_fk_sig'); // Extract info from data-* attributes

    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);

    modal.find('.modal-body #id_acpm_fk_sig').val(id_acpm_fk_sig);
  });

  $(document).ready(function() {
    $(".btn-aprobado").on("click", function() {
      var id_consecutivo = $(this).data("id");

      // Redirigir a la página de actualización con el id_consecutivo
      window.location.href = "php/estado_abierta.php?id_consecutivo=" + id_consecutivo;
    });
  });
</script>
<script>
  $(function () {

'use strict';

var ticksStyle = {
  fontColor: '#FFFFFF',
  fontStyle: 'bold',
};

var mode = 'index';
var intersect = true;

var $salesChart = $('#sales-chart');
// eslint-disable-next-line no-unused-vars
var salesChart = new Chart($salesChart, {
  type: 'bar',
  data: {
    labels: ['Meta (2 Mejora - 1 Preventiva)', 'Auditoria Interna', 'Auditoria Externa'],
    datasets: [
      {
        label: 'Acciones Correctivas',
        backgroundColor: '#FF6060',
        borderColor: '#FF6060',
        
        data: [
          <?php 
         $correctiva_interna=1;
         $correctiva_externa=2;
          foreach ($conn->query("SELECT COUNT(*) AS total_correctiva_c
          FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
           WHERE  a.tipo_acpm = 'AC' AND a.fuente_acpm = 'Otros' AND a.id_usuario_fk ='" . $id_usuario_fk . "'") as $row) { {
              $total_correctiva_c = $row["total_correctiva_c"];
           }}
            ?>
            '<?php echo $total_correctiva_c; ?>','<?php echo $correctiva_interna; ?>','<?php echo $correctiva_externa; ?>'

        ],
      },
      {
        label: 'Acciones Correctivas Realizadas',
        backgroundColor: '#dc3545',
        borderColor: '#dc3545',
       
        data: [5, 5, 10],
      },
      {
        label: 'Acciones Preventivas',
        backgroundColor: '#FEE960',
        borderColor: '#FEE960',
        
        data: [18, 5, 3],
      },
      {
        label: 'Acciones Preventivas Realizadas',
        backgroundColor: '#ffc107',
        borderColor: '#ffc107',
        data: [9, 2, 2],
      },
      {
        label: 'Acciones de Mejora',
        backgroundColor: '#71FE60',
        borderColor: '#71FE60',
        data: [10, 9, 4],
      },
      {
        label: 'Acciones de Mejora Realizadas',
        backgroundColor: '#28a745',
        borderColor: '#28a745',
        data: [8, 2, 1],
      },
    ],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      mode: mode,
      intersect: intersect,
    },
    hover: {
      mode: mode,
      intersect: intersect,
    },
    legend: {
      display: true,
    },
    scales: {
      yAxes: [
        {
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .1)',
            zeroLineColor: 'transparent',
          },
          ticks: $.extend(
            {
              beginAtZero: true,
              max: 20,
              stepSize: 1,
            },
            ticksStyle
          ),
        },
      ],
      xAxes: [
        {
          display: true,
          gridLines: {
            display: false,
          },
          ticks: ticksStyle,
        },
      ],
    },
  },
  
  plugins: {
    datalabels: {},
  },
  // Agregar etiquetas manualmente
  plugins: [{
    afterDatasetsDraw: function(chart) {
      var ctx = chart.ctx;

      chart.data.datasets.forEach(function(dataset, datasetIndex) {
        var meta = chart.getDatasetMeta(datasetIndex);
        if (!meta.hidden) {
          meta.data.forEach(function(element, index) {
            var model = element._model;
            var yPos = model.y - 10; // Ajusta la posición vertical de la etiqueta
            ctx.fillStyle = '#FFFFFF';
            ctx.font = ticksStyle.fontStyle + ' ' + ticksStyle.fontColor;
            ctx.fillText(dataset.data[index], model.x, yPos);
          });
        }
      });
    }
  }]
});
});
</script>

</body>

</html>
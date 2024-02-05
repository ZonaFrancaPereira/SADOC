<?php
session_start();
if ($_SESSION['ingreso'] == true) {
    require('php/conexion.php');
    require('plantilla.php');
?>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a data-toggle="tab" href="ti.php" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Panel de Control
                    </p>
                </a>
            </li>
            <?php
            if ($_SESSION['rol_usuario'] == "admin_sig" || $_SESSION['rol_usuario'] == "directivo" || $_SESSION['rol_usuario'] == "admin_contable" || $_SESSION['rol_usuario'] == "gerencia") {
            ?>

            <?php
            }
            ?>
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
<!-- /TABLA  -->
<div class="content-wrapper">
    <div id="wrapper" class="toggled">
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="tab-content card">
                    <div id="panel-ti" class="tab-pane  show active">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#mantenimientos_firma">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#mantenimientos_realizados">Realizados</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#agregar_mantenimiento">Equipos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#impresoras">Impresoras</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#general">General</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- /MANTENIMIENTOS PARA FIRMAR CADA USUARIO  -->
                            <div id="mantenimientos_firma" class="tab-pane fade ">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title" style="font-family: serif;">MANTENIMIENTOS POR FIRMAR</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-body table-responsive p-0">
                                            <table class="display table table-striped table-valign-middle " width="100%">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>#</th>
                                                        <th>Fecha Mantenimiento</th>
                                                        <th>Estado</th>
                                                        <th>Formato</th>
                                                        <th>Firma</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $id_usuario = $_SESSION['Id'];
                                                    foreach ($conn->query("SELECT m.*, p.nombre_proceso, u.nombre_usuario, c.nombre_cargo
                                                        FROM mantenimientos m
                                                        INNER JOIN proceso p ON m.id_proceso_fk = p.id_proceso
                                                        INNER JOIN usuarios u ON m.Id_usuario_fk = u.id_usuario
                                                        INNER JOIN cargos c ON m.id_cargo_fk = c.id_cargo
                                                        WHERE m.Id_usuario_fk = $id_usuario;") as $row) { {
                                                            $id_mantenimiento_equipo = $row["id_mantenimiento"];
                                                    ?>
                                                            <tr style=text-align:center>
                                                                <td><?php echo $row["id_mantenimiento"] ?></td>
                                                                <td><?php echo $row["fecha_mantenimiento"] ?></td>
                                                                <td><?php echo $row["estado_mantenimiento_equipo"] ?></td>
                                                                <td><a href='equipospdf.php?id_mantenimiento_equipo=<?php echo $id_mantenimiento_equipo; ?>' target='_blank'> <button class='btn bg-danger'><i class="far fa-file-pdf"></i> </button></a></td>
                                                                <td><button type="button" class='btn bg-primary' id="firma"><i class="fas fa-file-signature"></i></button></td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                                
                                                <tbody>
                                                    <?php
                                                    foreach ($conn->query("SELECT * FROM mantenimiento_impresora a 
                                                    INNER JOIN proceso b ON b.id_proceso = a.id_proceso_fk_2
                                                    INNER JOIN usuarios d ON d.Id_usuario = a.Id_usuario_fk2
                                                    INNER JOIN cargos e ON e.id_cargo = a.id_cargo_fk2
                                                    WHERE a.Id_usuario_fk2 = $id_usuario;") as $row) {
                                                        $id_mantenimiento_impresora = $row["id_impresora"];
                                                    ?>
                                                        <tr style="text-align:center">
                                                            <td><?php echo $row["id_impresora"] ?></td>
                                                            <td><?php echo $row["nombre_proceso"] ?></td>
                                                            <td><?php echo $row["fecha_mantenimiento_impresora"] ?></td>
                                                            <td><?php echo $row["nombre_usuario"] ?></td>
                                                            <td><?php echo $row["nombre_cargo"] ?></td>
                                                            <td><a href='impresorapdf.php?id_mantenimiento_impresora=<?php echo $id_mantenimiento_impresora; ?>' target='_blank'> <button class='btn bg-danger'><i class="far fa-file-pdf"></i> </button></a></td>
                                                            <td><button class='btn bg-primary'><i class="fas fa-file-signature"></i> </button></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                                <tbody>
                                                    <?php
                                                    foreach ($conn->query("SELECT * FROM mantenimiento_general f
                                                    INNER JOIN proceso g ON g.id_proceso = f.id_proceso_fk_3
                                                    INNER JOIN usuarios h ON h.Id_usuario = f.Id_usuario_fk3
                                                    INNER JOIN cargos i ON i.id_cargo = f.id_cargo_fk3
                                                    WHERE f.Id_usuario_fk3 = $id_usuario;") as $row) { {
                                                            $id_mantenimiento_general = $row["id_general"];
                                                    ?>
                                                            <tr style=text-align:center>
                                                                <td><?php echo $row["id_general"] ?></td>
                                                                <td><?php echo $row["nombre_proceso"] ?></td>
                                                                <td><?php echo $row["fecha_mantenimiento3"] ?></td>
                                                                <td><?php echo $row["nombre_usuario"] ?></td>
                                                                <td><?php echo $row["nombre_cargo"] ?></td>
                                                                <td><a href='generalpdf.php?id_mantenimiento_general=<?php echo $id_mantenimiento_general; ?>' target='_blank'> <button class='btn bg-danger'><i class="far fa-file-pdf"></i> </button></a></td>
                                                                <td><button class='btn bg-primary'><i class="fas fa-file-signature"></i> </button></td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /MANRTENIMIENTOS REALIZADOS -->
                            <div id="mantenimientos_realizados" class="tab-pane fade">
                                <div class="card card-lightblue">
                                    <div class="card-header">
                                        <h3 class="card-title" style="font-family: serif;">MANTENIMIENTOS EQUIPOS DE COMPUTO</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-body table-responsive p-0">
                                            <table class="display table table-striped table-valign-middle " width="100%">
                                                <thead>
                                                <tr style="text-align: center;">
                                                        <th>#</th>
                                                        <th>Proceso</th>
                                                        <th>Fecha Mantenimiento</th>
                                                        <th>Responsable</th>
                                                        <th>Cargo</th>
                                                        <th>Formato</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($conn->query("SELECT m.*, p.nombre_proceso, u.nombre_usuario, c.nombre_cargo
                                                        FROM mantenimientos m
                                                        INNER JOIN proceso p ON m.id_proceso_fk = p.id_proceso
                                                        INNER JOIN usuarios u ON m.Id_usuario_fk = u.id_usuario
                                                        INNER JOIN cargos c ON m.id_cargo_fk = c.id_cargo") as $row) { {
                                                            $id_mantenimiento_equipo = $row["id_mantenimiento"];
                                                                    ?>
                                                            <tr style=text-align:center>
                                                                <td><?php echo $row["id_mantenimiento"] ?></td>
                                                                <td><?php echo $row["nombre_proceso"] ?></td>
                                                                <td><?php echo $row["fecha_mantenimiento"] ?></td>
                                                                <td><?php echo $row["nombre_usuario"] ?></td>
                                                                <td><?php echo $row["nombre_cargo"] ?></td>
                                                                <td><a href='formato_mantenimientospdf.php?id_mantenimiento_equipo=<?php echo $id_mantenimiento_equipo; ?>' target='_blank'> <button class='btn bg-danger'><i class="far fa-file-pdf"></i> </button></a></td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title" style="font-family: serif;">MANTENIMIENTOS DE IMPRESORAS</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-body table-responsive p-0">
                                            <table class="display table table-striped table-valign-middle " width="100%">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>#</th>
                                                        <th>Proceso</th>
                                                        <th>Fecha Mantenimiento</th>
                                                        <th>Responsable</th>
                                                        <th>Cargo</th>
                                                        <th>Formato</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    foreach ($conn->query("SELECT * FROM mantenimiento_impresora a 
                                                    INNER JOIN proceso b ON b.id_proceso = a.id_proceso_fk_2
                                                    INNER JOIN usuarios d ON d.Id_usuario = a.Id_usuario_fk2
                                                    INNER JOIN cargos e ON e.id_cargo = a.id_cargo_fk2") as $row) {
                                                        $id_mantenimiento_impresora = $row["id_impresora"];
                                                ?>
                                                        <tr style="text-align:center">
                                                            <td><?php echo $row["id_impresora"] ?></td>
                                                            <td><?php echo $row["nombre_proceso"] ?></td>
                                                            <td><?php echo $row["fecha_mantenimiento_impresora"] ?></td>
                                                            <td><?php echo $row["nombre_usuario"] ?></td>
                                                            <td><?php echo $row["nombre_cargo"] ?></td>
                                                            <td><a href='formato_mantenimiento_impresorapdf.php?id_mantenimiento_impresora=<?php echo $id_mantenimiento_impresora; ?>' target='_blank'> <button class='btn bg-danger'><i class="far fa-file-pdf"></i> </button></a></td>
                                                        </tr>
                                                <?php
                                                    }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-maroon">
                                    <div class="card-header">
                                        <h3 class="card-title" style="font-family: serif;">MANTENIMIENTOS GENERALES</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-body table-responsive p-0">
                                            <table class="display table table-striped table-valign-middle " width="100%">
                                                <thead>
                                                <tr style="text-align: center;">
                                                        <th>#</th>
                                                        <th>Proceso</th>
                                                        <th>Fecha Mantenimiento</th>
                                                        <th>Responsable</th>
                                                        <th>Cargo</th>
                                                        <th>Formato</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($conn->query("SELECT * FROM mantenimiento_general f
                                                    INNER JOIN proceso g ON g.id_proceso = f.id_proceso_fk_3
                                                    INNER JOIN usuarios h ON h.Id_usuario = f.Id_usuario_fk3
                                                    INNER JOIN cargos i ON i.id_cargo = f.id_cargo_fk3") as $row) { {
                                                        $id_mantenimiento_general = $row["id_general"];
                                                    ?>
                                                            <tr style=text-align:center>
                                                                <td><?php echo $row["id_general"] ?></td>
                                                                <td><?php echo $row["nombre_proceso"] ?></td>
                                                                <td><?php echo $row["fecha_mantenimiento3"] ?></td>
                                                                <td><?php echo $row["nombre_usuario"] ?></td>
                                                                <td><?php echo $row["nombre_cargo"] ?></td>
                                                                <td><a href='formato_mantenimiento_generalpdf.php?id_mantenimiento_general=<?php echo $id_mantenimiento_general; ?>' target='_blank'> <button class='btn bg-danger'><i class="far fa-file-pdf"></i> </button></a></td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /FORMATO DE MANTENIMIENTO EQUIPO DE COMPUTO  -->
                            <div id="agregar_mantenimiento" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-widget widget-user">
                                            <div class="widget-user-header text-white d-flex align-items-center">
                                                <img src="img/logo_zf - copia.png" style="width: 400px; height: auto;" class="ml-3">
                                                <h3 class="widget-user-username text-right flex-grow-1">MANTENIMIENTO PREVENTIVO</h3>
                                            </div>
                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-sm-3 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">CÓDIGO</h5>
                                                            <span class="description-text">FO-TI-02</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">FECHA IMPLEMENTACIÓN</h5>
                                                            <span class="description-text">6/06/2017</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">FECHA DE ACTUALIZACIÓN</h5>
                                                            <span class="description-text">24/07/2023</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">VERSIÓN</h5>
                                                            <span class="description-text">7</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">PÁGINA</h5>
                                                            <span class="description-text">1</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /AGREGAR USUARIO -->

                                                <div class="card card-info">
                                                    <form id="mantenimiento" method="POST">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <br>
                                                                <div class="col-2">
                                                                    <br>
                                                                    <label for="id_proceso_fk">Proceso</label>
                                                                    <input list="proceso_usuario_browsers" class="form-control" id="id_proceso_fk" name="id_proceso_fk" placeholder="Proceso">
                                                                    <datalist id="proceso_usuario_browsers">
                                                                        <?php
                                                                        try {
                                                                            $stmt = $conn->prepare('SELECT * FROM  proceso ');
                                                                            $stmt->execute();
                                                                            if ($stmt->rowCount() > 0) {
                                                                                while ($row = $stmt->fetch()) {
                                                                                    $id_proceso = $row["id_proceso"];
                                                                                    $siglas_proceso = $row["siglas_proceso"];
                                                                                    $nombre_proceso = $row["nombre_proceso"];
                                                                                    echo '<option value=' . $id_proceso . '>' . $siglas_proceso . ' ' . $nombre_proceso . '</option>';
                                                                                }
                                                                            }
                                                                        } catch (PDOException $e) {
                                                                            echo "Error en el servidor";
                                                                        }
                                                                        ?>
                                                                    </datalist>
                                                                </div>
                                                                <div class="col-2"><br>
                                                                    <label for="fecha_mantenimiento">Fecha</label>
                                                                    <input type="date" name="fecha_mantenimiento" class="form-control" id="fecha_mantenimiento" required>
                                                                </div>
                                                                <div class="col-2"><br>
                                                                    <label for="Id_usuario_fk">Responsable</label>
                                                                    <input list="responsable_browsers" class="form-control" id="Id_usuario_fk" name="Id_usuario_fk" placeholder="responsable">
                                                                    <datalist id="responsable_browsers">
                                                                        <?php
                                                                        try {
                                                                            $stmt = $conn->prepare('SELECT * FROM  usuarios ');
                                                                            $stmt->execute();
                                                                            if ($stmt->rowCount() > 0) {
                                                                                while ($row = $stmt->fetch()) {
                                                                                    $id_usuario = $row["Id_usuario"];
                                                                                    $nombre_usuario = $row["nombre_usuario"];
                                                                                    $apellidos_usuario = $row["apellidos_usuario"];
                                                                                    echo '<option value=' . $id_usuario . ' >' . $nombre_usuario . ' ' .  $apellidos_usuario . '</option>';
                                                                                }
                                                                            }
                                                                        } catch (PDOException $e) {
                                                                            echo "Error en el servidor";
                                                                        }
                                                                        ?>
                                                                    </datalist>
                                                                </div>
                                                                <div class="col-2"><br>
                                                                    <label for="id_cargo_fk">Cargo Funcionario</label>
                                                                    <input list="cargo_browsers" class="form-control" id="id_cargo_fk" name="id_cargo_fk" placeholder="Cargo funcionario">
                                                                    <datalist id="cargo_browsers">
                                                                        <?php
                                                                        try {
                                                                            $stmt = $conn->prepare('SELECT * FROM  cargos ');
                                                                            $stmt->execute();
                                                                            if ($stmt->rowCount() > 0) {
                                                                                while ($row = $stmt->fetch()) {
                                                                                    $id_cargo = $row["id_cargo"];
                                                                                    $nombre_cargo = $row["nombre_cargo"];
                                                                                    echo '<option value=' . $id_cargo . '>' . $nombre_cargo . ' </option>';
                                                                                }
                                                                            }
                                                                        } catch (PDOException $e) {
                                                                            echo "Error en el servidor";
                                                                        }
                                                                        ?>
                                                                    </datalist>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="correo_destinatario">Correo</label>
                                                                    <input list="correo_browsers" class="form-control" id="correo_destinatario" name="correo_destinatario">
                                                                    <datalist id="correo_browsers">
                                                                    <?php
                                                                        try {
                                                                            $stmt = $conn->prepare('SELECT * FROM  usuarios ');
                                                                            $stmt->execute();
                                                                            if ($stmt->rowCount() > 0) {
                                                                                while ($row = $stmt->fetch()) {
                                                                                    $correo_usuario = $row["correo_usuario"];
                                                                                    $nombre_usuario = $row["nombre_usuario"];
                                                                                    $apellidos_usuario = $row["apellidos_usuario"];
                                                                                    echo '<option value=' . $correo_usuario . '>' . $nombre_usuario . ' ' .  $apellidos_usuario . '</option>';
                                                                                }
                                                                            }
                                                                        } catch (PDOException $e) {
                                                                            echo "Error en el servidor";
                                                                        }
                                                                        ?>
                                                                    </datalist>
                                                                </div>
                                                                <div class="col-md-12"> <br>
                                                                    <div class="card card-info collapsed-card">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">Equipo de Computo</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="marca">Marca</label>
                                                                    <input type="text" class="form-control" id="marca" name="marca">
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="modelo">Modelo</label>
                                                                    <input id="modelo" name="modelo" class="form-control" placeholder="modelo" required>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="serie">Serie</label>
                                                                    <input  id="serie" name="serie" class="form-control" placeholder="serie" required>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="nombre_usuario">Nombre de Usuario</label>
                                                                    <input  id="nombre_usuario" name="nombre_usuario" class="form-control" placeholder="Nombre usuario" required>
                                                                </div>
                                                                <div class="col-md-12"> <br>
                                                                    <div class="card card-info collapsed-card">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">Equipo de Computo</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="soplar_partes_externas">Soplar partes externas, equipo completo y área de trabajo, telefono.</label>
                                                                    <select class="form-control" id="soplar_partes_externas" name="soplar_partes_externas">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="lubricar_puertos">Lubricar puertos, conectores, contactos y bisagras con CRC o 3 en 1, isopropilico</label>
                                                                    <select class="form-control" id="lubricar_puertos" name="lubricar_puertos">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="limpieza_equipo">Limpieza de equipo completo, cables y accesorios</label>
                                                                    <select class="form-control" id="limpieza_equipo" name="limpieza_equipo">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="limpiar_partes_interna">Soplar y limpiar partes interna equipo completo.</label>
                                                                    <select class="form-control" id="limpiar_partes_interna" name="limpiar_partes_interna">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="verificar_usuario">Verificar usuario estandar y administrador.</label>
                                                                    <select class="form-control" id="verificar_usuario" name="verificar_usuario">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="verificar_contraseñas">Verificar contraseñas guardadas en los navegadores</label>
                                                                    <select class="form-control" id="verificar_contraseñas" name="verificar_contraseñas">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="formato_asignacion_equipo">Verificar y constatar elementos del formato asignación de equipos</label>
                                                                    <select class="form-control" id="formato_asignacion_equipo" name="formato_asignacion_equipo">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="depurar_temporales">Depurar temporales, vaciar Visor de Eventos (temp/ %temp%)</label>
                                                                    <select class="form-control" id="depurar_temporales" name="depurar_temporales">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="liberar_espacio">Liberar espacio en disco</label>
                                                                    <select class="form-control" id="liberar_espacio" name="liberar_espacio">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="desinstalar_programas">Desinstalar programas innecesarios y no licenciados</label>
                                                                    <select class="form-control" id="desinstalar_programas" name="desinstalar_programas">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="desfragmentar">Desfragmentar todas las unidades de disco</label>
                                                                    <select class="form-control" id="desfragmentar" name="desfragmentar">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="verificar_actualizaciones"> Verificar actualizaciones pendientes e instalarlas, reiniciar sistema</label>
                                                                    <select class="form-control" id="verificar_actualizaciones" name="verificar_actualizaciones">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="actualizar_logos">Actualizar logos de perfil de usuarios y cambiar fondos, sincronizar logos y fondos </label>
                                                                    <select class="form-control" id="actualizar_logos" name="actualizar_logos">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="organizar_cableado">Verificar y organizar cableado de red y otros.</label>
                                                                    <select class="form-control" id="organizar_cableado" name="organizar_cableado">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-12"> <br>
                                                                    <div class="card card-info collapsed-card">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">Seguridad Básica de Equipos </h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-1 border-right"><br>
                                                                    <label for="usuario">Usuario</label>
                                                                    <input type="checkbox" id="usuario" name="usuario" value="SI">
                                                                </div>
                                                                <div class="col-sm-1 border-right"><br>
                                                                    <label for="">Clave</label>
                                                                    <input type="checkbox" id="clave" name="clave" value="SI">
                                                                </div>
                                                                <div class="col-sm-1 border-right"><br>
                                                                    <label for="estandar">Estandar</label>
                                                                    <input type="checkbox" id="estandar" name="estandar" value="SI">
                                                                </div>
                                                                <div class="col-sm-2 border-right"><br>
                                                                    <label for="administrador">Administrador</label>
                                                                    <input type="checkbox" id="administrador" name="administrador" value="SI">
                                                                </div>

                                                                <div class="col-sm-2 border-right"><br>
                                                                    <label for="analisis_completo">Analisis Completo</label>
                                                                    <input type="checkbox" id="analisis_completo" name="analisis_completo" value="SI">
                                                                </div>
                                                                <div class="col-sm-3 border-right"><br>
                                                                    <label for="bloqueo_usb">Bloqueo de memorias USB</label>
                                                                    <input type="checkbox" id="bloqueo_usb" name="bloqueo_usb" value="SI">
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <hr style="border: 5px solid #2C9EB2;">
                                                                </div>
                                                                <div class="col-sm-3 border-right"><br>
                                                                    <label for="dominio_zfip">Dentro del Dominio de ZFIP</label>
                                                                    <input type="checkbox" id="dominio_zfip" name="dominio_zfip" value="SI">
                                                                </div>
                                                                <div class="col-sm-3 border-right"><br>
                                                                    <label for="apagar_pantalla">Apagar pantalla a los 3 min</label>
                                                                    <input type="checkbox" id="apagar_pantalla" name="apagar_pantalla" value="SI">
                                                                </div>
                                                                <div class="col-sm-4 border-right"><br>
                                                                    <label for="estado_suspension">Poner el equipo en estado de suspensión 10 minutos</label>
                                                                    <input type="checkbox" id="estado_suspension" name="estado_suspension" value="SI">
                                                                </div>
                                                                <div class="col-3" hidden><br>
                                                                    <label for="firma">Firma</label>
                                                                    <input type="text" class="form-control" id="firma" name="firma" value="1" hidden>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="estado_mantenimiento_equipo">Estado</label>
                                                                    <input list="browsers" id="estado_mantenimiento_equipo" name="estado_mantenimiento_equipo" class="form-control" value="Sin Firmar" readonly>
                                                                </div>
                                                                <div class="col-md-3 col-xs-3 col-sm-3">
                                                                    <br>
                                                                    <button type="button" class="btn bg-info btn-block" id="enviar_formulario_mantenimiento" name="enviar_formulario_mantenimiento" onclick="enviarFormularioMantenimiento()">ENVIAR</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /FORMATO DE MANTENIMIENTO DE IMPRESORAS  -->
                            <div id="impresoras" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-widget widget-user">
                                            <div class="widget-user-header text-white d-flex align-items-center">
                                                <img src="img/logo_zf - copia.png" style="width: 400px; height: auto;" class="ml-3">
                                                <h3 class="widget-user-username text-right flex-grow-1">MANTENIMIENTO PREVENTIVO</h3>
                                            </div>
                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-sm-3 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">CÓDIGO</h5>
                                                            <span class="description-text">FO-TI-02</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">FECHA IMPLEMENTACIÓN</h5>
                                                            <span class="description-text">6/06/2017</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">FECHA DE ACTUALIZACIÓN</h5>
                                                            <span class="description-text">24/07/2023</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">VERSIÓN</h5>
                                                            <span class="description-text">7</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">PÁGINA</h5>
                                                            <span class="description-text">2</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /AGREGAR MANTENIMIENTO IMPRESORA -->

                                                <div class="card card-info">
                                                    <form id="mantenimiento" method="POST">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <br>
                                                                <div class="col-2">
                                                                    <br>
                                                                    <label for="id_proceso_fk_2">Proceso</label>
                                                                    <input list="proceso_usuario_browsers" class="form-control" id="id_proceso_fk_2" name="id_proceso_fk_2" placeholder="Proceso">
                                                                    <datalist id="proceso_usuario_browsers">
                                                                        <?php
                                                                        try {
                                                                            $stmt = $conn->prepare('SELECT * FROM  proceso ');
                                                                            $stmt->execute();
                                                                            if ($stmt->rowCount() > 0) {
                                                                                while ($row = $stmt->fetch()) {
                                                                                    $id_proceso = $row["id_proceso"];
                                                                                    $siglas_proceso = $row["siglas_proceso"];
                                                                                    $nombre_proceso = $row["nombre_proceso"];
                                                                                    echo '<option value=' . $id_proceso . '>' . $siglas_proceso . ' ' . $nombre_proceso . '</option>';
                                                                                }
                                                                            }
                                                                        } catch (PDOException $e) {
                                                                            echo "Error en el servidor";
                                                                        }
                                                                        ?>
                                                                    </datalist>
                                                                </div>
                                                                <div class="col-2"><br>
                                                                    <label for="fecha_mantenimiento_impresora">Fecha</label>
                                                                    <input type="date" name="fecha_mantenimiento_impresora" class="form-control" id="fecha_mantenimiento_impresora" required>
                                                                </div>
                                                                <div class="col-2"><br>
                                                                    <label for="Id_usuario_fk2">Responsable</label>
                                                                    <input list="responsable_browsers" class="form-control" id="Id_usuario_fk2" name="Id_usuario_fk2" placeholder="responsable">
                                                                    <datalist id="responsable_browsers">
                                                                        <?php
                                                                        try {
                                                                            $stmt = $conn->prepare('SELECT * FROM  usuarios ');
                                                                            $stmt->execute();
                                                                            if ($stmt->rowCount() > 0) {
                                                                                while ($row = $stmt->fetch()) {
                                                                                    $id_usuario = $row["Id_usuario"];
                                                                                    $nombre_usuario = $row["nombre_usuario"];
                                                                                    $apellidos_usuario = $row["apellidos_usuario"];
                                                                                    echo '<option value=' . $id_usuario . ' >' . $nombre_usuario . ' ' .  $apellidos_usuario . '</option>';
                                                                                }
                                                                            }
                                                                        } catch (PDOException $e) {
                                                                            echo "Error en el servidor";
                                                                        }
                                                                        ?>
                                                                    </datalist>
                                                                </div>
                                                                <div class="col-2"><br>
                                                                    <label for="id_cargo_fk2">Cargo Funcionario</label>
                                                                    <input list="cargo_browsers" class="form-control" id="id_cargo_fk2" name="id_cargo_fk2" placeholder="Cargo funcionario">
                                                                    <datalist id="cargo_browsers">
                                                                        <?php
                                                                        try {
                                                                            $stmt = $conn->prepare('SELECT * FROM  cargos ');
                                                                            $stmt->execute();
                                                                            if ($stmt->rowCount() > 0) {
                                                                                while ($row = $stmt->fetch()) {
                                                                                    $id_cargo = $row["id_cargo"];
                                                                                    $nombre_cargo = $row["nombre_cargo"];
                                                                                    echo '<option value=' . $id_cargo . '>' . $nombre_cargo . ' </option>';
                                                                                }
                                                                            }
                                                                        } catch (PDOException $e) {
                                                                            echo "Error en el servidor";
                                                                        }
                                                                        ?>
                                                                    </datalist>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="correo_destinatario1">Correo</label>
                                                                    <input list="correo_browsers" class="form-control" id="correo_destinatario1" name="correo_destinatario1">
                                                                    <datalist id="correo_browsers">
                                                                    <?php
                                                                        try {
                                                                            $stmt = $conn->prepare('SELECT * FROM  usuarios ');
                                                                            $stmt->execute();
                                                                            if ($stmt->rowCount() > 0) {
                                                                                while ($row = $stmt->fetch()) {
                                                                                    $correo_usuario = $row["correo_usuario"];
                                                                                    $nombre_usuario = $row["nombre_usuario"];
                                                                                    $apellidos_usuario = $row["apellidos_usuario"];
                                                                                    echo '<option value=' . $correo_usuario . '>' . $nombre_usuario . ' ' .  $apellidos_usuario . '</option>';
                                                                                }
                                                                            }
                                                                        } catch (PDOException $e) {
                                                                            echo "Error en el servidor";
                                                                        }
                                                                        ?>
                                                                    </datalist>
                                                                </div>
                                                                <div class="col-md-12"> <br>
                                                                    <div class="card card-info collapsed-card">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">IMPRESORA</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="nombre_impresora">Nombre de la Impresora</label>
                                                                    <input list="browsers" id="nombre_impresora" name="nombre_impresora" class="form-control" placeholder="Nombre impresora" required>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="marca_impresora">Marca</label>
                                                                    <input type="text" class="form-control" id="marca_impresora" name="marca_impresora">
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="modelo_impresora">Modelo</label>
                                                                    <input list="browsers" id="modelo_impresora" name="modelo_impresora" class="form-control" placeholder="modelo" required>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="serial_impresora">Serial</label>
                                                                    <input list="browsers" id="serial_impresora" name="serial_impresora" class="form-control" placeholder="serial" required>
                                                                </div>
                                                                <div class="col-md-12"> <br>
                                                                    <div class="card card-info collapsed-card">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">IMPRESORA</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="soplar_exterior">Soplar y limpiar el exterior de la impresora</label>
                                                                    <select class="form-control" id="soplar_exterior" name="soplar_exterior">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="isopropilico">Limpiar el interior de la impresora con alcohol isopropilico</label>
                                                                    <select class="form-control" id="isopropilico" name="isopropilico">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br><br>
                                                                    <label for="toner">Revisar los niveles de tinta o tóner.</label>
                                                                    <select class="form-control" id="toner" name="toner">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="alinear">Alinear el cabezal de impresión y ajustar la calidad de impresión </label>
                                                                    <select class="form-control" id="alinear" name="alinear">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="verificar_cableado">Verificar que todos los cables estén correctamente conectados y en buen estado</label>
                                                                    <select class="form-control" id="verificar_cableado" name="verificar_cableado">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br><br>
                                                                    <label for="rodillos">Limpiar los rodillos de alimentación del papel con un paño húmedo.</label>
                                                                    <select class="form-control" id="rodillos" name="rodillos">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br><br>
                                                                    <label for="reemplazar">Reemplazar los cartuchos de tinta o tóner según sea necesario</label>
                                                                    <select class="form-control" id="reemplazar" name="reemplazar">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="limpiar">Ejecutar la función de limpieza del cabezal de impresión para eliminar posibles obstrucciones.</label>
                                                                    <select class="form-control" id="limpiar" name="limpiar">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br><br>
                                                                    <label for="imprimir">Imprimir una página de prueba para verificar que la impresora funcione correctamente.</label>
                                                                    <select class="form-control" id="imprimir" name="imprimir">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="verificar">Verificar el funcionamiento de las funciones adicionales de la impresora, como la escaneo o la copia, si están disponibles en los equipos</label>
                                                                    <select class="form-control" id="verificar" name="verificar">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br><br><br><br>
                                                                    <label for="estado_mantenimiento_impresora">Estado</label>
                                                                    <input list="browsers" id="estado_mantenimiento_impresora" name="estado_mantenimiento_impresora" class="form-control" value="Sin Firmar" readonly>
                                                                </div>
                                                                <div class="col-3">
                                                                </div>
                                                                <div class="col-md-3 col-xs-3 col-sm-3"><br>
                                                                    <br>
                                                                    <button type="button" class="btn bg-info btn-block" id="enviar_formulario_impresoras" name="enviar_formulario_impresoras" onclick="enviarFormularioImpresoras()">ENVIAR</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /FORMATO DE MANTENIMIENTO GENERAL  -->
                            <div id="general" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-widget widget-user">
                                            <div class="widget-user-header text-white d-flex align-items-center">
                                                <img src="img/logo_zf - copia.png" style="width: 400px; height: auto;" class="ml-3">
                                                <h3 class="widget-user-username text-right flex-grow-1">MANTENIMIENTO PREVENTIVO</h3>
                                            </div>
                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-sm-3 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">CÓDIGO</h5>
                                                            <span class="description-text">FO-TI-02</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">FECHA IMPLEMENTACIÓN</h5>
                                                            <span class="description-text">6/06/2017</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">FECHA DE ACTUALIZACIÓN</h5>
                                                            <span class="description-text">24/07/2023</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">VERSIÓN</h5>
                                                            <span class="description-text">7</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">PÁGINA</h5>
                                                            <span class="description-text">3</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /AGREGAR MANTENIMIENTO GENERAL -->
                                                <div class="card card-info">
                                                    <form id="mantenimiento" method="POST">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <br>
                                                                <div class="col-2">
                                                                    <br>
                                                                    <label for="id_proceso_fk_3">Proceso</label>
                                                                    <input list="proceso_usuario_browsers" class="form-control" id="id_proceso_fk_3" name="id_proceso_fk_3" placeholder="Proceso">
                                                                    <datalist id="proceso_usuario_browsers">
                                                                        <?php
                                                                        try {
                                                                            $stmt = $conn->prepare('SELECT * FROM  proceso ');
                                                                            $stmt->execute();
                                                                            if ($stmt->rowCount() > 0) {
                                                                                while ($row = $stmt->fetch()) {
                                                                                    $id_proceso = $row["id_proceso"];
                                                                                    $siglas_proceso = $row["siglas_proceso"];
                                                                                    $nombre_proceso = $row["nombre_proceso"];
                                                                                    echo '<option value=' . $id_proceso . '>' . $siglas_proceso . ' ' . $nombre_proceso . '</option>';
                                                                                }
                                                                            }
                                                                        } catch (PDOException $e) {
                                                                            echo "Error en el servidor";
                                                                        }
                                                                        ?>
                                                                    </datalist>
                                                                </div>
                                                                <div class="col-2"><br>
                                                                    <label for="fecha_mantenimiento3">Fecha</label>
                                                                    <input type="date" name="fecha_mantenimiento3" class="form-control" id="fecha_mantenimiento3" required>
                                                                </div>
                                                                <div class="col-2"><br>
                                                                    <label for="Id_usuario_fk3">Responsable</label>
                                                                    <input list="responsable_browsers" class="form-control" id="Id_usuario_fk3" name="Id_usuario_fk3" placeholder="responsable">
                                                                    <datalist id="responsable_browsers">
                                                                        <?php
                                                                        try {
                                                                            $stmt = $conn->prepare('SELECT * FROM  usuarios ');
                                                                            $stmt->execute();
                                                                            if ($stmt->rowCount() > 0) {
                                                                                while ($row = $stmt->fetch()) {
                                                                                    $id_usuario = $row["Id_usuario"];
                                                                                    $nombre_usuario = $row["nombre_usuario"];
                                                                                    $apellidos_usuario = $row["apellidos_usuario"];
                                                                                    echo '<option value=' . $id_usuario . ' >' . $nombre_usuario . ' ' .  $apellidos_usuario . '</option>';
                                                                                }
                                                                            }
                                                                        } catch (PDOException $e) {
                                                                            echo "Error en el servidor";
                                                                        }
                                                                        ?>
                                                                    </datalist>
                                                                </div>
                                                                <div class="col-2"><br>
                                                                    <label for="id_cargo_fk3">Cargo Funcionario</label>
                                                                    <input list="cargo_browsers" class="form-control" id="id_cargo_fk3" name="id_cargo_fk3" placeholder="Cargo funcionario">
                                                                    <datalist id="cargo_browsers">
                                                                        <?php
                                                                        try {
                                                                            $stmt = $conn->prepare('SELECT * FROM  cargos ');
                                                                            $stmt->execute();
                                                                            if ($stmt->rowCount() > 0) {
                                                                                while ($row = $stmt->fetch()) {
                                                                                    $id_cargo = $row["id_cargo"];
                                                                                    $nombre_cargo = $row["nombre_cargo"];
                                                                                    echo '<option value=' . $id_cargo . '>' . $nombre_cargo . ' </option>';
                                                                                }
                                                                            }
                                                                        } catch (PDOException $e) {
                                                                            echo "Error en el servidor";
                                                                        }
                                                                        ?>
                                                                    </datalist>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="correo_destinatario2">Correo</label>
                                                                    <input list="general_browsers" class="form-control" id="correo_destinatario2" name="correo_destinatario2">
                                                                    <datalist id="general_browsers">
                                                                    <?php
                                                                        try {
                                                                            $stmt = $conn->prepare('SELECT * FROM  usuarios ');
                                                                            $stmt->execute();
                                                                            if ($stmt->rowCount() > 0) {
                                                                                while ($row = $stmt->fetch()) {
                                                                                    $correo_usuario = $row["correo_usuario"];
                                                                                    $nombre_usuario = $row["nombre_usuario"];
                                                                                    $apellidos_usuario = $row["apellidos_usuario"];
                                                                                    echo '<option value=' . $correo_usuario . '>' . $nombre_usuario . ' ' .  $apellidos_usuario . '</option>';
                                                                                }
                                                                            }
                                                                        } catch (PDOException $e) {
                                                                            echo "Error en el servidor";
                                                                        }
                                                                        ?>
                                                                    </datalist>
                                                                </div>
                                                                <div class="col-md-12"> <br>
                                                                    <div class="card card-info collapsed-card">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">GENERAL</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="articulo">Articulo</label>
                                                                    <input list="browsers" id="articulo" name="articulo" class="form-control" placeholder="Nombre impresora" required>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="marca_general">Marca</label>
                                                                    <input type="text" class="form-control" id="marca_general" name="marca_general">
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="modelo_general">Modelo</label>
                                                                    <input list="browsers" id="modelo_general" name="modelo_general" class="form-control" placeholder="modelo" required>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="serial_general">Serial</label>
                                                                    <input list="browsers" id="serial_general" name="serial_general" class="form-control" placeholder="serial" required>
                                                                </div>
                                                                <div class="col-md-12"> <br>
                                                                    <div class="card card-info collapsed-card">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">GENERAL</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="partes_externas">Soplar y limpiar partes externas (Utilizar insumos adecuadados para el dispositivo / articulo)</label>
                                                                    <select class="form-control" id="partes_externas" name="partes_externas">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br><br>
                                                                    <label for="condiciones_fisicas">Verificar las condiciones fisicas del dispositivo / articulo</label>
                                                                    <select class="form-control" id="condiciones_fisicas" name="condiciones_fisicas">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="cableado_verificar">Dependiendo del dispositivo si cuenta con cableado verificar su estado, limpiar y organizar cableado.</label>
                                                                    <select class="form-control" id="cableado_verificar" name="cableado_verificar">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br><br>
                                                                    <label for="dispositivo">Soplar y limpiar lugar donde se encuentra ubicado el dispositivo / articulo </label>
                                                                    <select class="form-control" id="dispositivo" name="dispositivo">
                                                                        <option value="SI">SI</option>
                                                                        <option value="NO">NO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3"><br>
                                                                    <label for="estado_general">Estado</label>
                                                                    <input list="browsers" id="estado_general" name="estado_general" class="form-control" value="Sin Firmar" readonly>
                                                                </div>
                                                                <div class="col-md-3 col-xs-3 col-sm-3"><br>
                                                                    <br>
                                                                    <button type="button" class="btn bg-info btn-block" id="enviar_formulario_general" name="enviar_formulario_general" onclick="enviarFormularioGeneral()">ENVIAR</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /MANTENIMIENTOS PARA FIRMAR CADA USUARIO  -->
                    <div id="panel-mantenimiento" class="tab-pane">
                    <div class="card card-lightblue">
                                    <div class="card-header">
                                        <h3 class="card-title" style="font-family: serif;">MANTENIMIENTOS EQUIPOS DE COMPUTO</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-body table-responsive p-0">
                                            <table class="display table table-striped table-valign-middle " width="100%">
                                                <thead>
                                                <tr style="text-align: center;">
                                                        <th>#</th>
                                                        <th>Proceso</th>
                                                        <th>Fecha Mantenimiento</th>
                                                        <th>Responsable</th>
                                                        <th>Cargo</th>
                                                        <th>Formato</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($conn->query("SELECT m.*, p.nombre_proceso, u.nombre_usuario, c.nombre_cargo
                                                        FROM mantenimientos m
                                                        INNER JOIN proceso p ON m.id_proceso_fk = p.id_proceso
                                                        INNER JOIN usuarios u ON m.Id_usuario_fk = u.id_usuario
                                                        INNER JOIN cargos c ON m.id_cargo_fk = c.id_cargo") as $row) { {
                                                            $id_mantenimiento_equipo = $row["id_mantenimiento"];
                                                                    ?>
                                                            <tr style=text-align:center>
                                                                <td><?php echo $row["id_mantenimiento"] ?></td>
                                                                <td><?php echo $row["nombre_proceso"] ?></td>
                                                                <td><?php echo $row["fecha_mantenimiento"] ?></td>
                                                                <td><?php echo $row["nombre_usuario"] ?></td>
                                                                <td><?php echo $row["nombre_cargo"] ?></td>
                                                                <td><a href='formato_mantenimientospdf.php?id_mantenimiento_equipo=<?php echo $id_mantenimiento_equipo; ?>' target='_blank'> <button class='btn bg-danger'><i class="far fa-file-pdf"></i> </button></a></td>
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
            </div>
        </div>
    </div>
</div>

<?php require('footer.php'); ?>

</body>

</html>
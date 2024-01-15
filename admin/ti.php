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
                <a data-toggle="tab" href="#panelc" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>

                    <p>
                        Panel de Control
                    </p>
                </a>
            </li>
            <?php
            if ($_SESSION['rol_usuario'] == "admin_sig" || $_SESSION['rol_usuario'] == "directivo" || $_SESSION['rol_usuario'] == "admin_contable" || $_SESSION['rol_usuario'] == "gerencia") {
            ?>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-search-plus"></i>
                        <p>
                            Usuarios
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" name="actualizar_usuario">
                            <a data-toggle="tab" href="#actualizar_usuario" class="nav-link">
                                <i class="nav-icon fas fa-sync-alt"></i>
                                <p>Actualizar Usuario</p>
                            </a>
                        </li>
                        <li class="nav-item" name="agregar_usuario">
                            <a data-toggle="tab" href="#agregar" class="nav-link">
                                <i class="nav-icon fas fa-sync-alt"></i>
                                <p>Agregar Usuario</p>
                            </a>
                        </li>
                    </ul>
                </li>
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
                    <!-- /ACTUALIZAR USUARIO -->
                    <div id="actualizar_usuario" class="tab-pane">
                        <table id="actualizar_usuario" class="display table table-bordered table-striped">
                            <thead class="bg-info">
                                <tr>
                                    <th>#</th>
                                    <th>Correo</th>
                                    <th>Contraseña</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Estado</th>
                                    <th>Proceso</th>
                                    <th>Cargo</th>
                                    <th>Tipo Usuario</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($conn->query("SELECT * from usuarios ") as $row) {
                                    $id_usuario = $row["Id_usuario"];
                                ?>

                                    <tr style=text-align:center>
                                        <td><?php echo $row["Id_usuario"] ?></td>
                                        <td><?php echo $row["correo_usuario"] ?></td>
                                        <td><?php echo $row["contrasena_usuario"] ?></td>
                                        <td><?php echo $row["nombre_usuario"] ?></td>
                                        <td><?php echo $row["apellidos_usuario"] ?></td>
                                        <td><?php echo $row["estado_usuario"] ?></td>
                                        <td><?php echo $row["proceso_usuario_fk"] ?></td>
                                        <td><?php echo $row["id_cargo_fk"] ?></td>
                                        <td><?php echo $row["tipo_usuario_fk"] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-info" id="editarUsuario" onclick="editarUsuario(
                                            '<?php echo $row["Id_usuario"] ?>',
                                            '<?php echo $row["correo_usuario"] ?>',
                                            '<?php echo $row["contrasena_usuario"] ?>',
                                            '<?php echo $row["nombre_usuario"] ?>',
                                            '<?php echo $row["apellidos_usuario"] ?>',
                                            '<?php echo $row["estado_usuario"] ?>',
                                            '<?php echo $row["proceso_usuario_fk"] ?>',
                                            '<?php echo $row["id_cargo_fk"] ?>',
                                            '<?php echo $row["tipo_usuario_fk"] ?>'
                                        )"><i class="fas fa-user-edit"></i></button>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- MODAL PARA EDITAR USUARIO -->
                    <section class="content">
                        <div class="modal fade" id="modal-editar">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form id="actualizar usuario" method="POST">
                                            <div class="card card-navy">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6 col-xs-6 col-sm-6">
                                                            <label for="usuario">Id Usuario</label>
                                                            <input type="number" name="id_usuario" class="form-control" id="id_usuario" readonly>
                                                        </div>
                                                        <div class="col-md-6 col-xs-6 col-sm-6">
                                                            <label for="correo_usuario">Correo</label>
                                                            <input type="text" name="correo_usuario" class="form-control" id="correo_usuario" readonly>
                                                        </div>
                                                        <div class="col-md-6 col-xs-6 col-sm-6">
                                                            <label for="contrasena_usuario">Contraseña</label>
                                                            <input type="text" name="contrasena_usuario" class="form-control" id="contrasena_usuario" readonly>
                                                        </div>
                                                        <div class="col-md-6 col-xs-6 col-sm-6">
                                                            <label for="nombre_usuario">Nombre</label>
                                                            <input type="text" name="nombre_usuario" class="form-control" id="nombre_usuario" readonly>
                                                        </div>
                                                        <div class="col-md-6 col-xs-6 col-sm-6">
                                                            <label for="apellidos_usuario">Apellidos</label>
                                                            <input type="text" name="apellidos_usuario" id="apellidos_usuario" value="" class="form-control" readonly>
                                                        </div>
                                                        <div class="col-md-6 col-xs-6 col-sm-6">
                                                            <label for="">Estado</label>
                                                            <select class="form-control" id="estado_usuario" name="estado_usuario">
                                                                <option>Selecciona una Opción</option>
                                                                <option value="activo">Activo</option>
                                                                <option value="inactivo">Inactivo</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-xs-6 col-sm-6">
                                                            <label for="proceso_usuario_fk">Proceso</label>
                                                            <input type="text" name="proceso_usuario_fk" id="proceso_usuario_fk" value="" class="form-control" readonly>
                                                        </div>
                                                        <div class="col-md-6 col-xs-6 col-sm-6">
                                                            <label for="id_cargo_fk">Cargo</label>
                                                            <input type="text" name="id_cargo_fk" id="id_cargo_fk" value="" class="form-control" readonly>
                                                        </div>
                                                        <div class="col-md-6 col-xs-6 col-sm-6">
                                                            <label for="tipo_usuario_fk">Tipo Usuario</label>
                                                            <input type="text" name="tipo_usuario_fk" id="tipo_usuario_fk" value="" class="form-control" readonly>
                                                        </div>
                                                        <div class="col-md-3 col-xs-3 col-sm-3">
                                                            <br>
                                                            <button type="button" class="btn bg-info btn-block" id="actualizar" name="actualizar" onclick="actualizarEstadoUsuario()">ACTUALIZAR</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </section>
                    
                    <!-- /AGREGAR USUARIO -->
                    <div id="agregar" class="tab-pane">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">AGREGAR USUARIO</h3>
                            </div>
                            <form id="agregar_usuario" method="POST">
                                <div class="card-body">
                                    <div class="row">
                                        <br>
                                        <div class="col-3"><br>
                                            <label for="correo_usuario2">Correo</label>
                                            <input type="text" class="form-control" id="correo_usuario2" name="correo_usuario2" placeholder="ingresa tu correo electronico">
                                        </div>
                                        <div class="col-3"><br>
                                            <label for="contrasena_usuario2">Contraeña</label>
                                            <input type="text" class="form-control" id="contrasena_usuario2" name="contrasena_usuario2" placeholder="Contraseña">
                                        </div>
                                        <div class="col-3"><br>
                                            <label for="nombre_usuario2">Nombre</label>
                                            <input type="text" class="form-control" id="nombre_usuario2" name="nombre_usuario2" placeholder="Nombre">
                                        </div>
                                        <div class="col-3"><br>
                                            <label for="apellidos_usuario2">Apellidos</label>
                                            <input type="text" class="form-control" id="apellidos_usuario2" name="apellidos_usuario2" placeholder="Apellidos">
                                        </div>
                                        <div class="col-3"><br>
                                            <label for="estado_usuario_nuevo">Estado</label>
                                            <input type="text" class="form-control" id="estado_usuario_nuevo" name="estado_usuario_nuevo" value="Activo" readonly>
                                        </div>
                                        <div class="col-3"><br>
                                            <label for="proceso_usuario_fk2">Proceso</label>
                                            <input list="browsers" id="proceso_usuario_fk2" name="proceso_usuario_fk2" class="form-control" placeholder="Proceso" required>
                                            <datalist id="browsers">
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
                                        <div class="col-3"><br>
                                            <label for="id_cargo_fk2">Cargo</label>
                                            <input list="browsers" id="id_cargo_fk2" name="id_cargo_fk2" class="form-control" placeholder="Cargo" required>
                                            <datalist id="browsers">
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
                                            <label for="tipo_usuario_fk2">Tipo Usuario</label>
                                            <input list="browsers" id="tipo_usuario_fk2" name="tipo_usuario_fk2" class="form-control" placeholder="Cargo" required>
                                            <datalist id="browsers">
                                                <?php
                                                try {
                                                    $stmt = $conn->prepare('SELECT * FROM  cargos ');
                                                    $stmt->execute();
                                                    if ($stmt->rowCount() > 0) {
                                                        while ($row = $stmt->fetch()) {
                                                            $id_tipo_usuario = $row["id_tipo_usuario"];
                                                            $rol_usuario = $row["rol_usuario"];
                                                            echo '<option value=' . $id_tipo_usuario . '>' . $rol_usuario . ' </option>';
                                                        }
                                                    }
                                                } catch (PDOException $e) {
                                                    echo "Error en el servidor";
                                                }
                                                ?>
                                            </datalist>
                                        </div>
                                        <div class="col-md-3 col-xs-3 col-sm-3">
                                            <br>
                                            <button type="button" class="btn bg-info btn-block" id="nuevo_usuario" name="nuevo_usuario" onclick="nuevoUsuario()">AGREGAR</button>
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

<?php require('footer.php'); ?>

</body>

</html>
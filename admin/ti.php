<?php
session_start();
if ($_SESSION['ingreso'] == true) {
    require('php/conexion.php');
    require('plantilla.php');
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
                    <div id="agregar_usuario" class="tab-pane">
                       412
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php require('footer.php'); ?>
<script>

</script>
</body>

</html>
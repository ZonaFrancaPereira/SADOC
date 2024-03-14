<?php
require('seguridad.php');
$id_acpm = $_GET['id_acpm'];
$descripcion = $_GET['descripcion'];
$id_actividad = 0;
?>
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
                <div class="tab-content card">
                    <!-- DIV DONDE SE MUESTRA TODA LA INFORMACION DE INTERES DE LAS ACPM PARA CADA USUARIO -->
                    <div class="tab-pane  show active" id="panelc">
                        <div id="actividades_abiertas" class="tab-pane">
                            <div class="card" class="">
                                <div class="col-md-12">
                                    <div class="card bg-primary collapsed-card">
                                        <div class="card-header">
                                            <h3 class="card-title col-md-10">ID ACPM: <?php echo $id_acpm ?> </h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                            <!-- /.card-tools -->
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead class="bg-info">
                                            <tr>
                                                <th>#</th>
                                                <th>Descripción de la actividad</th>
                                                <th>Responsable</th>
                                                <th>Fecha Vencimiento</th>
                                                <th>Estado</th>
                                                <th>Modificar fecha </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($conn->query("SELECT * from actividades_acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario WHERE id_acpm_fk = $id_acpm") as $row) {
                                                $id_actividad = $row['id_actividad'];
                                                $estado_actividad = $row["estado_actividad"];
                                            ?>
                                                <tr style=text-align:center>
                                                    <td><?php echo $row["id_actividad"] ?></td>
                                                    <td><?php echo $row["descripcion_actividad"] ?></td>
                                                    <td><?php echo $row["nombre_usuario"] . " " . $row["apellidos_usuario"] ?></td>
                                                    <td><?php echo $row["fecha_actividad"] ?></td>
                                                    <td><?php echo $row["estado_actividad"] ?></td>
                                                    <td><button class="btn  bg-danger" data-toggle="modal" data-target="#modal-fecha_actividad" data-id_actividad="<?php echo $row['id_actividad'] ?>"><i class="fas fa-calendar-alt"></i></button></td>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <section class="content">
                            <div class="modal fade" id="modal-fecha_actividad">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header btn bg-info btn-block">
                                            <h4 class="modal-title">Modificar Fecha</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <form id="form_modificar_sig" method="POST">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <label>Desea Modificar la fecha de la siguiente Actividad:</label><input type="text" class="form-control" value="" name="id_actividad" id="id_actividad" readonly>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-12 col-xs-12 col-sm-12">
                                                                    <label for="fecha_modificar_actividad">Modificar fecha de vencimiento de la Actividad</label>
                                                                    <input type="date" name="fecha_modificar_actividad" class="form-control" id="fecha_modificar_actividad" required>
                                                                </div>
                                                                <div class="col-md-12 col-xs-12 col-sm-12"><br>
                                                                    <br>
                                                                    <button type="button" class="btn bg-info btn-block" id="modificar_fecha_actividad" name="modificar_fecha_actividad">Actualizar Fecha</button>
                                                                </div>
                                                            </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<?php require('footer.php'); ?>
</div>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('.select2').select2()

    });

    $('#modal-fecha_actividad').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id_actividad = button.data('id_actividad'); // Extract info from data-* attributes

        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);

        modal.find('.modal-body #id_actividad').val(id_actividad);
    });
</script>
</body>

</html>
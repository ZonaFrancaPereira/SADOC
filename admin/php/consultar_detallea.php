<?php
require('conexion.php');
$id_actividad = $_POST['id_actividad'];


$query = "SELECT * FROM detalle_actividad a INNER JOIN actividades_acpm u ON a.id_actividad_fk = u.id_actividad WHERE u.id_actividad = $id_actividad";
$result = $conn->query($query);
// Verificar si hay resultados
if ($result->rowCount() > 0) {
    foreach ($result as $row) {
?>

        <div class="btn bg-info btn-block">
            <h4 class="modal-title">NUMERO DE ACTIVIDAD: <?php echo $row["id_actividad"] ?></h4>
        </div>
        <div class="card-body">
            <div class="col-md-12 bg-info">
                <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user" style="background-color: white; color: black;">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-black" style="background: url('../dist/img/photo1.png') center center;">
                        <h3 class="widget-user-username text-center" style="background-color: white; color: black;">EVIDENCIA</h3>
                        <h5 class="widget-user-desc text-center">
                            <p class="text-break" style="max-width,background-color: white; color: black;"><?php echo $row["evidencia"] ?></p>
                        </h5>
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-6 border-right">
                                
                                <div class="description-block">
                                    <h5 class="description-header">FECHA EVIDENCIA</h5>
                                    <span class="description-text"><?php echo $row["fecha_evidencia"] ?></span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">RECURSOS</h5>
                                    <span class="description-text"><?php echo $row["recursos"] ?></span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        </div>
<?php
    }
} else {
    // Mensaje si no hay resultados
    echo "No se encontraron resultados.";
}
?>

</body>

</html>
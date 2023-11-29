<?php
require('conexion.php');
$id_actividad = $_POST['id_actividad'];

$query = "SELECT * FROM detalle_actividad a INNER JOIN actividades_acpm u ON a.id_actividad_fk = u.id_actividad WHERE u.id_actividad = $id_actividad";
$result = $conn->query($query);
// Verificar si hay resultados
if ($result->rowCount() > 0) {
    foreach ($result as $row) {
?>
        <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>Fecha de Evidencia</th>
                        <th>Evidencia</th>
                        <th>Recursos</th>
                        <th>Id de la Actividad</th>
                    </tr>
                </thead>
                <tbody>
                    <td><?php echo $row["fecha_evidencia"] ?></td>
                    <td><p class="text-break" style="width: 6rem"><?php echo $row["evidencia"] ?></td></p>
                    <td><?php echo $row["recursos"] ?></td>
                    <td><?php echo $row["id_actividad"] ?></td>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Fecha de Evidencia</th>
                        <th>Evidencia</th>
                        <th>Recursos</th>
                        <th>Id de la Actividad</th>
                    </tr>
                </tfoot>
            </table>
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
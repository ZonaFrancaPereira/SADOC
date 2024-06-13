<?php 
include_once("conexion.php");

$fecha_evidencia = $_POST["fecha_evidencia"];
$evidencia = $_POST["evidencia"];
$contenidoSinParrafos = strip_tags($evidencia, '<a><b><strong><i><em><u><s><strike><code>');

$recursos = $_POST["recursos"];
$id_actividad_fk = $_POST["id_actividad_fk"];
$id_usuario_e_fk = $_POST["id_usuario_e_fk"];
$estado_actividad = "completa";

try {
    // Iniciar una transacción
    $conn->beginTransaction();

    // Insertar la evidencia en detalle_actividad
    $stmt = $conn->prepare('INSERT INTO detalle_actividad(fecha_evidencia, evidencia, recursos, id_actividad_fk, id_usuario_e_fk) VALUES(?,?,?,?,?)');
    $stmt->bindParam(1, $fecha_evidencia);
    $stmt->bindParam(2, $contenidoSinParrafos);
    $stmt->bindParam(3, $recursos);
    $stmt->bindParam(4, $id_actividad_fk);
    $stmt->bindParam(5, $id_usuario_e_fk);

    if ($stmt->execute()) {
        // Actualizar el estado de la actividad en actividades_acpm
        $stmt_update = $conn->prepare('UPDATE actividades_acpm SET estado_actividad = ? WHERE id_actividad = ?');
        $stmt_update->bindParam(1, $estado_actividad);
        $stmt_update->bindParam(2, $id_actividad_fk);

        if ($stmt_update->execute()) {
            // Confirmar la transacción
            $conn->commit();
            echo "1";
        } else {
            // Revertir la transacción si falla la actualización
            $conn->rollBack();
            echo "ERROR";
        }
    } else {
        // Revertir la transacción si falla la inserción
        $conn->rollBack();
        echo "ERROR";
    }
} catch (PDOException $e) {
    // Revertir la transacción en caso de error
    $conn->rollBack();
    echo "Se ha producido un error al intentar conectar al servidor MySQL: " . $e->getMessage();
}
?>

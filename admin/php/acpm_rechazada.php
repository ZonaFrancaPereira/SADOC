<?php
include_once("conexion.php");

// Obtener datos del formulario
$estado_acpm = "Rechazada";
$fecha_rechazo_sig = $_POST['fecha_rechazo_sig'];
$descripcion_rechazo_sig = $_POST['descripcion_rechazo_sig'];
$id_acpm_fk = $_POST['id_acpm_fk'];

try {
    $stmt = $conn->prepare('INSERT INTO acpm_rechazada(fecha_rechazo, descripcion_rechazo, id_acpm_fk) VALUES(?,?,?)');
    $stmt->bindParam(1, $fecha_rechazo_sig); // Cambié $riesgo_acpm a $fecha_rechazo_sig
    $stmt->bindParam(2, $descripcion_rechazo_sig); // Cambié $justificacion_riesgo a $descripcion_rechazo_sig
    $stmt->bindParam(3, $id_acpm_fk);

    if ($stmt->execute()) {
        echo "1";
    } else {
        echo "ERROR";
    }
} catch (PDOException $e) {
    echo "Se ha producido un error al intentar conectar al servidor MySQL: " . $e->getMessage();
}
?>
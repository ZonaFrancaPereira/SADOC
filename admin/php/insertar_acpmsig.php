<?php 
include_once("conexion.php");
// Obtener datos del formulario
$id_acpm_sig = $_POST['id_acpm_sig'];
$riesgo_acpm_sig = $_POST['riesgo_acpm_sig'];
$justificacion_riesgo_sig = $_POST['justificacion_riesgo_sig'];
$cambios_sig = $_POST['cambios_sig'];
$justificacion_sig = $_POST['justificacion_sig'];
$conforme_sig = $_POST['conforme_sig'];
$justificacion_conforme_sig = $_POST['justificacion_conforme_sig'];
$fecha_estado_sig = $_POST['fecha_estado_sig'];

try {
    // Asumiendo que $id_acpm contiene el identificador único
    $stmt = $conn->prepare('UPDATE acpm SET riesgo_acpm=?, justificacion_riesgo=?, cambios_sig=?, justificacion_sig=?, conforme_sig=?, justificacion_conforme_sig=?, fecha_estado=? WHERE id_consecutivo=?');

    $stmt->bindParam(1, $riesgo_acpm_sig);
    $stmt->bindParam(2, $justificacion_riesgo_sig);
    $stmt->bindParam(3, $cambios_sig);
    $stmt->bindParam(4, $justificacion_sig);
    $stmt->bindParam(5, $conforme_sig);
    $stmt->bindParam(6, $justificacion_conforme_sig);
    $stmt->bindParam(7, $fecha_estado_sig);
    $stmt->bindParam(8, $id_acpm_sig); // Este es el nuevo parámetro para la cláusula WHERE

    if ($stmt->execute()) {
        echo "1"; // Éxito
    } else {
        echo "Error al ejecutar la consulta.";
    }
} catch (PDOException $e) {
    echo "Error de PDO: " . $e->getMessage();
}
?>
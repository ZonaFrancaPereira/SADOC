<?php
include_once("conexion.php");

// Obtener el id_consecutivo de la URL
$id_consecutivo = isset($_GET['id_consecutivo']) ? $_GET['id_consecutivo'] : null;

try {
    // Verificar que el id_consecutivo está presente
    if (!$id_consecutivo) {
        throw new Exception("ID de consecutivo no proporcionado");
    }

    // Consulta SQL para actualizar el estado en la tabla acpm
    $sqlUpdate = "UPDATE acpm
                  SET estado_acpm = 'abierta'
                  WHERE id_consecutivo = ?";

    // Preparar la consulta de actualización
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bindParam(1, $id_consecutivo, PDO::PARAM_INT);

    // Ejecutar la consulta de actualización
    $updateSuccess = $stmtUpdate->execute();

    // Verificar si la actualización fue exitosa
    if (!$updateSuccess) {
        throw new Exception("Error al actualizar el estado en la tabla acpm.");
    }

    echo "Actualización exitosa";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
} finally {
    // Cerrar la conexión
    $conn = null;
}
?>

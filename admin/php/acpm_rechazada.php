<?php
include_once("conexion.php");

// Obtener datos del formulario
$descripcion_rechazo_sig = $_POST['descripcion_rechazo_sig'];
$id_acpm_fk_sig = $_POST['id_acpm_fk_sig'];

try {
    // Comenzar una transacción
    $conn->beginTransaction();

    // Insertar datos en la tabla acpm_rechazada
    $stmtInsert = $conn->prepare('INSERT INTO acpm_rechazada(fecha_rechazo, descripcion_rechazo, id_acpm_fk) VALUES(NOW(), ?, ?)');
    $stmtInsert->bindParam(1, $descripcion_rechazo_sig); 
    $stmtInsert->bindParam(2, $id_acpm_fk_sig); 

    // Ejecutar la inserción
    $insertSuccess = $stmtInsert->execute();

    // Verificar si la inserción fue exitosa
    if (!$insertSuccess) {
        throw new Exception("Error al insertar datos en la tabla acpm_rechazada.");
    }

    // Consulta SQL para actualizar la tabla acpm
    $sqlUpdate = "UPDATE acpm
                  JOIN acpm_rechazada ON acpm.id_consecutivo = acpm_rechazada.id_acpm_fk
                  SET acpm.estado_acpm = 'rechazada'
                  WHERE acpm.id_consecutivo = ?";

    // Preparar la consulta de actualización
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bindParam(1, $id_acpm_fk_sig);

    // Ejecutar la consulta de actualización
    $updateSuccess = $stmtUpdate->execute();

    // Verificar si la actualización fue exitosa
    if (!$updateSuccess) {
        throw new Exception("Error al actualizar el estado en la tabla acpm.");
    }

    // Confirmar la transacción si ambas consultas se ejecutan con éxito
    $conn->commit();
    echo "1";
} catch (Exception $e) {
    // Revertir la transacción en caso de cualquier error
    $conn->rollBack();
    echo "ERROR: " . $e->getMessage();
} finally {
    // Cerrar la conexión
    $conn = null;
}
?>